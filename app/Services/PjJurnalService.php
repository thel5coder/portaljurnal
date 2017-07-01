<?php
/**
 * Created by PhpStorm.
 * User: AhmadShobirin
 * Date: 02/06/2017
 * Time: 11:09
 */

namespace App\Services;
use App\Repositories\Contracts\IBlindReviewRepository;
use App\Repositories\Contracts\IJurnalRepository;
use App\Repositories\Contracts\IPenulisJurnalRepository;
use App\Services\Response\ServicePaginationResponseDto;
use App\Services\Response\ServiceResponseDto;
use Maatwebsite\Excel\Facades\Excel;

class PjJurnalService extends BaseService
{
    protected $jurnalRepository;
    protected $penulisJurnalRepository;
    protected $blindReviewRepository;

    public function __construct(IJurnalRepository $jurnalRepository,IPenulisJurnalRepository $penulisJurnalRepository,IBlindReviewRepository $blindReviewRepository)
    {
        $this->jurnalRepository = $jurnalRepository;
        $this->penulisJurnalRepository = $penulisJurnalRepository;
        $this->blindReviewRepository = $blindReviewRepository;
    }

    public function create($input)
    {
        $response = new ServiceResponseDto();

        $fileJurnal = $this->uploadingFile('fileJurnal')->getResult();
        $paramPendaftaranJurnal = [
            'openJurnalId'=>$input['openJurnalId'],
            'judul'=>$input['judul'],
            'abstrak'=>$input['abstrak'],
            'jurusan'=>$input['jurusan'],
            'instansi'=>$input['instansi'],
            'kategoriId'=>$input['kategoriId'],
            'fileJurnal'=>$fileJurnal,
        ];

        $createJurnalResult = $this->jurnalRepository->create($paramPendaftaranJurnal);

        for($i=1;$i<=intval($input['penulisCount']);$i++){
            $paramPenulisJurnal = [
                'jurnalId'=>$createJurnalResult,
                'namaPenulis'=>$input['penulis'.$i]

            ];
            $this->penulisJurnalRepository->create($paramPenulisJurnal);
        }


        return $response;
    }

    public function update($input)
    {
        $response = new ServiceResponseDto();

        $fileJurnal = $this->uploadingFile('fileJurnal')->getResult();
        $paramUpdateJurnal = [
            'id'=>$input['id'],
            'openJurnalId'=>$input['openJurnalId'],
            'judul'=>$input['judul'],
            'abstrak'=>$input['abstrak'],
            'jurusan'=>$input['jurusan'],
            'instansi'=>$input['instansi'],
            'kategoriId'=>$input['kategoriId'],
            'fileJurnal'=>$fileJurnal,
        ];
        $createJurnalResult = $this->jurnalRepository->update($paramUpdateJurnal);
        if($this->deletePenulisJurnal($input['id'])->isSuccess()){
            for($i=1;$i<=intval($input['penulisCount']);$i++){
                $paramPenulisJurnal = [
                    'id'=>$input['penulisId'.$i],
                    'namaPenulis'=>$input['penulis'.$i]

                ];
                $this->penulisJurnalRepository->update($paramPenulisJurnal);
            }
        }

        return $response;
    }

    public function all()
    {
        return $this->getAllObject($this->jurnalRepository);
    }

    public function readJurnal($id)
    {
        return $this->readObject($this->jurnalRepository,$id);
    }

    public function readPenulis($id){
        return $this->readObject($this->penulisJurnalRepository,$id);
    }


    protected function deleteJurnal($id)
    {
        return $this->deleteObject($this->jurnalRepository,$id);
    }

    protected function deletePenulisJurnal($jurnalId){
        return $this->deleteObject($this->penulisJurnalRepository,$jurnalId);
    }

    public function delete($id){
        $response = new ServiceResponseDto();

        if(!$this->deletePenulisJurnal($id)->isSuccess()){
            $response->addErrorMessage($this->deletePenulisJurnal($id)->getErrorMessages());
        }

        if(!$this->deleteJurnal($id)->isSuccess()){
            $response->addErrorMessage($this->deleteJurnal($id)->getErrorMessages());
        }

        return $response;
    }

    public function updateTahap($tahap,$jurnalId)
    {
        $response = new ServiceResponseDto();
        if(!$this->jurnalRepository->UpdateTahap($tahap,$jurnalId))
        {
            $message = ['Update Tahap Gagal'];
            $response->addErrorMessage($message);
        }
        return $response;
    }

    protected function updateStatus($status,$jurnalId)
    {
        $response = new ServiceResponseDto();
        if (!$this->jurnalRepository->Status($status,$jurnalId))
        {
            $message = ['Update Status Gagal'];
            $response->addErrorMessage($message);
        }
        return $response;
    }

    public function pagination($param){
        return $this->getPaginationObject($this->jurnalRepository,$param);
    }

    public function paginationByTahap($param){
        $response = new ServicePaginationResponseDto();
        $tahap = 'Acc';

        if(auth()->user()->user_level =='tim redaksi'){
            $tahap = 'Received';
        }elseif(auth()->user()->user_level == 'mitra bestari'){
            $tahap = 'Review MB';
        }

        $pagingResult = $this->jurnalRepository->paginationByTahap($this->parsePaginationParam($param),$tahap);
        $response->setCurrentPage($param['pageIndex']);
        $response->setPageSize($param['pageSize']);
        $response->setTotalCount($pagingResult->getTotalCount());
        $response->setResult($pagingResult->getResult());

        return $response;
    }

    public function createBlindReview($input){
        $response = new ServiceResponseDto();

        if($this->blindReviewRepository->create($input)){
            if($input['hasil']==1){
                $status = 'Acc';
            }elseif ($input['hasil']=='2'){
                $status='Revisi';
            }else{
                $status='Reject';
            }

            if($status == 'Acc'){
                $tahap = 'Review MB';
            }elseif ($status =='Revisi'){
                $tahap = 'Blind Review';
            }else{
                $tahap = 'Reject';
            }

            if(!$updateStatus = $this->updateStatus($status,$input['jurnalId'])){
                $response->addErrorMessage($updateStatus->getErrorMessages());
            }

            if(!$updateTahap = $this->updateTahap($tahap,$input['jurnalId'])){
                $response->addErrorMessage($updateTahap->getErrorMessages());
            }
        }else{
            $message = ['Gagal menyimpan blind review'];
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function paginationBlindReview($param){
        return $this->getPaginationObject($this->blindReviewRepository,$param);
    }

    public function readBlindReview($id){
        return $this->readObject($this->blindReviewRepository,$id);
    }

    public function downloadBlindReview($id){
        $response = new ServiceResponseDto();
        $data = $this->readBlindReview($id)->getResult();

        if(!Excel::create($data->judul . '-' . $data->created_at, function ($excel) use ($data) {
            $excel->sheet('Blind Review', function ($sheet) use ($data) {
                $sheet->cell('A1', function ($cell) {
                    $cell->setValue('Judul');
                });
                $sheet->cell('B1', function ($cell) {
                    $cell->setValue(':');
                });
                $sheet->cell('C1',function ($cell)use($data){
                    $cell->setValue($data->judul);
                });
                $sheet->cell('A2', function ($cell) {
                    $cell->setValue('Volume');
                });
                $sheet->cell('B2', function ($cell) {
                    $cell->setValue(':');
                });
                $sheet->cell('C2',function ($cell)use($data){
                    $cell->setValue($data->volume);
                });
                $sheet->cell('A3', function ($cell) {
                    $cell->setValue('Nomor');
                });
                $sheet->cell('B3', function ($cell) {
                    $cell->setValue(':');
                });
                $sheet->cell('C3',function ($cell)use($data){
                    $cell->setValue($data->nomor);
                });

                //penilaian format penulisan
                //begin heading
                $sheet->mergeCells('A5:F5');
                $sheet->cell('A5',function ($cell){
                    $cell->setValue('Format Penulisan');
                    $cell->setFontWeight('bold');
                    $cell->setFontSize('16');
                });

                //begin point name
                $sheet->mergeCells('A6:D6');
                $sheet->cell('A6',function ($cell){
                    $cell->setValue('Jumlah Halaman (12-14)');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A7:D7');
                $sheet->cell('A7',function ($cell){
                    $cell->setValue('Penulisan Judul (Arial 12)');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A8:D8');
                $sheet->cell('A8',function ($cell){
                    $cell->setValue('Penulisan Sesuai EYD');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A9:D9');
                $sheet->cell('A9',function ($cell){
                    $cell->setValue('Penulisan Abstrak (1 Alenia B. Inggris, Maks 200 Kata, Arial 9)');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A10:D10');
                $sheet->cell('A10',function ($cell){
                    $cell->setValue('Kata Kunci( 5 Kata, Arial 9, Huruf Miring)');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A11:D11');
                $sheet->cell('A11',function ($cell){
                    $cell->setValue('Pengutipan Referensi (Nama Belakang, Tahun)');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A12:D12');
                $sheet->cell('A12',function ($cell){
                    $cell->setValue('Isi Naskah (Spasi 1, Arial 9, Kertas A4)');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A13:D13');
                $sheet->cell('A13',function ($cell){
                    $cell->setValue('Penomoran BAB(1.Pendahuluan, Dst.)');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A14:D14');
                $sheet->cell('A14',function ($cell){
                    $cell->setValue('Penomoran Sub Bab(1.1 Latar Bekalang, Dst.)');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A15:D15');
                $sheet->cell('A15',function ($cell){
                    $cell->setValue('Penomoran Rumus(Kanan, Angka Arab, Ket. Rumus)');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A16:D16');
                $sheet->cell('A16',function ($cell){
                    $cell->setValue('Penomoran Table(Atas-Tengah, Angka Arab, Ket. Tabel)');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A17:D17');
                $sheet->cell('A17',function ($cell){
                    $cell->setValue('Penomoran Gambar(Bawah - Tengah, Angka Arab, Ket. Tabel)');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A18:D18');
                $sheet->cell('A18',function ($cell){
                    $cell->setValue('Penulisan Daftar Pustaka(jumlah Buku 3-8)');
                    $cell->setFontWeight('bold');
                });

                //begin separator
                for($i=6;$i<19;$i++){
                    $sheet->cell('E'.$i,function ($cell){
                        $cell->setValue(':');
                    });
                }

                //begin value format penulisan
                $sheet->cell('F6',function ($cell)use($data){
                    $cell->setValue(($data->format_penulisan1 == 1 ? 'Sesuai':'Perbaiki'));
                });
                $sheet->cell('F7',function ($cell)use($data){
                    $cell->setValue(($data->format_penulisan2 == 1 ? 'Sesuai':'Perbaiki'));
                });
                $sheet->cell('F8',function ($cell)use($data){
                    $cell->setValue(($data->format_penulisan3 == 1 ? 'Sesuai':'Perbaiki'));
                });
                $sheet->cell('F9',function ($cell)use($data){
                    $cell->setValue(($data->format_penulisan4 == 1 ? 'Sesuai':'Perbaiki'));
                });
                $sheet->cell('F10',function ($cell)use($data){
                    $cell->setValue(($data->format_penulisan5 == 1 ? 'Sesuai':'Perbaiki'));
                });
                $sheet->cell('F11',function ($cell)use($data){
                    $cell->setValue(($data->format_penulisan6 == 1 ? 'Sesuai':'Perbaiki'));
                });
                $sheet->cell('F12',function ($cell)use($data){
                    $cell->setValue(($data->format_penulisan7 == 1 ? 'Sesuai':'Perbaiki'));
                });
                $sheet->cell('F13',function ($cell)use($data){
                    $cell->setValue(($data->format_penulisan8 == 1 ? 'Sesuai':'Perbaiki'));
                });
                $sheet->cell('F14',function ($cell)use($data){
                    $cell->setValue(($data->format_penulisan9 == 1 ? 'Sesuai':'Perbaiki'));
                });
                $sheet->cell('F15',function ($cell)use($data){
                    $cell->setValue(($data->format_penulisan10 == 1 ? 'Sesuai':'Perbaiki'));
                });
                $sheet->cell('F16',function ($cell)use($data){
                    $cell->setValue(($data->format_penulisan11 == 1 ? 'Sesuai':'Perbaiki'));
                });
                $sheet->cell('F17',function ($cell)use($data){
                    $cell->setValue(($data->format_penulisan12 == 1 ? 'Sesuai':'Perbaiki'));
                });
                $sheet->cell('F18',function ($cell)use($data){
                    $cell->setValue(($data->format_penulisan13 == 1 ? 'Sesuai':'Perbaiki'));
                });

                //penilaian isi tulisan
                //begin heading
                $sheet->mergeCells('A19:F19');
                $sheet->cell('A19',function ($cell){
                    $cell->setValue('Isi Tulisan');
                    $cell->setFontWeight('bold');
                    $cell->setFontSize('16');
                });

                //begin point name

                $sheet->mergeCells('A20:D20');
                $sheet->cell('A20', function ($cell) {
                    $cell->setValue('Apakah Isi Naskah Original?');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A21:D21');
                $sheet->cell('A21', function ($cell) {
                    $cell->setValue('Apakah Judul Mempresentasikan Isi?');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A22:D22');
                $sheet->cell('A22', function ($cell) {
                    $cell->setValue('Apakah Abstrak Merefleksikan Isi?');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A23:D23');
                $sheet->cell('A23', function ($cell) {
                    $cell->setValue('Apakah Kata Kunci Mengidentifikasikan Lingkup Penelitian?');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A24:D24');
                $sheet->cell('A24', function ($cell) {
                    $cell->setValue('Apakah Metodelogi Yang Digunakan Tepat?');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A25:D25');
                $sheet->cell('A25', function ($cell) {
                    $cell->setValue('Apakah Penggunaan Tabel dan Gambar Mendukung Penjelasan?');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A26:D26');
                $sheet->cell('A26', function ($cell) {
                    $cell->setValue('Apakah Analisa Pada Paper Relevan Dengan Hasil Penelitian?');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A27:D27');
                $sheet->cell('A27', function ($cell) {
                    $cell->setValue('Apakah Referensi Yang Digunakan Relevan?');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A28:D28');
                $sheet->cell('A28', function ($cell) {
                    $cell->setValue('Pendapat Anda Tentang Kesimpulan Dan Saran Pada Naskah?');
                    $cell->setFontWeight('bold');
                });

                $sheet->mergeCells('A29:D29');
                $sheet->cell('A29', function ($cell) {
                    $cell->setValue('Pendapat Anda Tentang Ketajaman Bahasan Penulisan Naskah?');
                    $cell->setFontWeight('bold');
                });

                //begin separator
                for($i=20;$i<30;$i++){
                    $sheet->cell('E'.$i,function ($cell){
                        $cell->setValue(':');
                    });
                }

                //begin value isi tulisan
                $sheet->cell('F20',function ($cell)use($data){
                    $cell->setValue(($data->isi_tulisan1 == 1 ? 'Kurang':($data->isi_tulisan1 == 2 ? 'Cukup':($data->isi_tulisan1 == 3 ? 'Baik':'Baik Sekali'))));
                });
                $sheet->cell('F21',function ($cell)use($data){
                    $cell->setValue(($data->isi_tulisan2 == 1 ? 'Kurang':($data->isi_tulisan2 == 2 ? 'Cukup':($data->isi_tulisan2 == 3 ? 'Baik':'Baik Sekali'))));
                });
                $sheet->cell('F22',function ($cell)use($data){
                    $cell->setValue(($data->isi_tulisan3 == 1 ? 'Kurang':($data->isi_tulisan3 == 2 ? 'Cukup':($data->isi_tulisan3 == 3 ? 'Baik':'Baik Sekali'))));
                });
                $sheet->cell('F23',function ($cell)use($data){
                    $cell->setValue(($data->isi_tulisan4 == 1 ? 'Kurang':($data->isi_tulisan4 == 2 ? 'Cukup':($data->isi_tulisan4 == 3 ? 'Baik':'Baik Sekali'))));
                });
                $sheet->cell('F24',function ($cell)use($data){
                    $cell->setValue(($data->isi_tulisan5 == 1 ? 'Kurang':($data->isi_tulisan5 == 2 ? 'Cukup':($data->isi_tulisan5 == 3 ? 'Baik':'Baik Sekali'))));
                });
                $sheet->cell('F25',function ($cell)use($data){
                    $cell->setValue(($data->isi_tulisan6 == 1 ? 'Kurang':($data->isi_tulisan6 == 2 ? 'Cukup':($data->isi_tulisan6 == 3 ? 'Baik':'Baik Sekali'))));
                });
                $sheet->cell('F26',function ($cell)use($data){
                    $cell->setValue(($data->isi_tulisan7 == 1 ? 'Kurang':($data->isi_tulisan7 == 2 ? 'Cukup':($data->isi_tulisan7 == 3 ? 'Baik':'Baik Sekali'))));
                });
                $sheet->cell('F27',function ($cell)use($data){
                    $cell->setValue(($data->isi_tulisan8 == 1 ? 'Kurang':($data->isi_tulisan8 == 2 ? 'Cukup':($data->isi_tulisan8 == 3 ? 'Baik':'Baik Sekali'))));
                });
                $sheet->cell('F28',function ($cell)use($data){
                    $cell->setValue(($data->isi_tulisan9 == 1 ? 'Kurang':($data->isi_tulisan9 == 2 ? 'Cukup':($data->isi_tulisan9 == 3 ? 'Baik':'Baik Sekali'))));
                });
                $sheet->cell('F29',function ($cell)use($data){
                    $cell->setValue(($data->isi_tulisan10 == 1 ? 'Kurang':($data->isi_tulisan10 == 2 ? 'Cukup':($data->isi_tulisan10 == 3 ? 'Baik':'Baik Sekali'))));
                });

                $sheet->mergeCells('A32:D32');
                $sheet->cell('A32',function ($cell){
                    $cell->setValue('TTD');
                    $cell->setAlignment('center');
                });


                $sheet->mergeCells('A36:D36');
                $sheet->cell('A36',function ($cell) use($data){
                    $cell->setFontWeight('bold');
                    $cell->setValue($data->paraf_reviewer);
                    $cell->setAlignment('center');
                });

            });
        })->download('xls')){
            $message = ['Gagal mendownload data blind review'];
            $response->addErrorMessage($message);
        }

        return $response;
    }
}