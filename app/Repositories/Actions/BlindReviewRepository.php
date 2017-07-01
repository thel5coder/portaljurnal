<?php
/**
 * Created by PhpStorm.
 * User: syaikhul
 * Date: 24/06/2017
 * Time: 03.58
 */

namespace App\Repositories\Actions;


use App\Models\PjBlindReviewModel;
use App\Models\PjPenulisJurnal;
use App\Repositories\Contracts\IBlindReviewRepository;
use App\Repositories\Contracts\Pagination\PaginationParam;
use App\Repositories\Contracts\Pagination\PaginationResult;

class BlindReviewRepository implements IBlindReviewRepository
{

    public function create($input)
    {
        $blindReview = new PjBlindReviewModel();
        $blindReview->jurnal_id = $input['jurnalId'];
        $blindReview->format_penulisan1 = $input['formatPenulisan1'];
        $blindReview->format_penulisan2 = $input['formatPenulisan2'];
        $blindReview->format_penulisan3 = $input['formatPenulisan3'];
        $blindReview->format_penulisan4 = $input['formatPenulisan4'];
        $blindReview->format_penulisan5 = $input['formatPenulisan5'];
        $blindReview->format_penulisan6 = $input['formatPenulisan6'];
        $blindReview->format_penulisan7 = $input['formatPenulisan7'];
        $blindReview->format_penulisan8 = $input['formatPenulisan8'];
        $blindReview->format_penulisan9 = $input['formatPenulisan9'];
        $blindReview->format_penulisan10 = $input['formatPenulisan10'];
        $blindReview->format_penulisan11 = $input['formatPenulisan11'];
        $blindReview->format_penulisan12 = $input['formatPenulisan12'];
        $blindReview->format_penulisan13 = $input['formatPenulisan13'];
        $blindReview->isi_tulisan1 = $input['isiTulisan1'];
        $blindReview->isi_tulisan2 = $input['isiTulisan2'];
        $blindReview->isi_tulisan3 = $input['isiTulisan3'];
        $blindReview->isi_tulisan4 = $input['isiTulisan4'];
        $blindReview->isi_tulisan5 = $input['isiTulisan5'];
        $blindReview->isi_tulisan6 = $input['isiTulisan6'];
        $blindReview->isi_tulisan7 = $input['isiTulisan7'];
        $blindReview->isi_tulisan8 = $input['isiTulisan8'];
        $blindReview->isi_tulisan9 = $input['isiTulisan9'];
        $blindReview->isi_tulisan10 = $input['isiTulisan10'];
        $blindReview->paraf_reviewer = $input['parafReviewer'];
        $blindReview->hasil = $input['hasil'];

        return $blindReview->save();

    }

    public function update($input)
    {
        $blindReview = PjBlindReviewModel::find($input['id']);
        $blindReview->jurnal_id = $input['jurnalId'];
        $blindReview->format_penulisan1 = $input['formatPenulisan1'];
        $blindReview->format_penulisan2 = $input['formatPenulisan2'];
        $blindReview->format_penulisan3 = $input['formatPenulisan3'];
        $blindReview->format_penulisan4 = $input['formatPenulisan4'];
        $blindReview->format_penulisan5 = $input['formatPenulisan5'];
        $blindReview->format_penulisan6 = $input['formatPenulisan6'];
        $blindReview->format_penulisan7 = $input['formatPenulisan7'];
        $blindReview->format_penulisan8 = $input['formatPenulisan8'];
        $blindReview->format_penulisan9 = $input['formatPenulisan9'];
        $blindReview->format_penulisan10 = $input['formatPenulisan10'];
        $blindReview->format_penulisan11 = $input['formatPenulisan11'];
        $blindReview->format_penulisan12 = $input['formatPenulisan12'];
        $blindReview->format_penulisan13 = $input['formatPenulisan13'];
        $blindReview->isi_tulisan1 = $input['isiTulisan1'];
        $blindReview->isi_tulisan2 = $input['isiTulisan2'];
        $blindReview->isi_tulisan3 = $input['isiTulisan3'];
        $blindReview->isi_tulisan4 = $input['isiTulisan4'];
        $blindReview->isi_tulisan5 = $input['isiTulisan5'];
        $blindReview->isi_tulisan6 = $input['isiTulisan6'];
        $blindReview->isi_tulisan7 = $input['isiTulisan7'];
        $blindReview->isi_tulisan8 = $input['isiTulisan8'];
        $blindReview->isi_tulisan9 = $input['isiTulisan9'];
        $blindReview->isi_tulisan10 = $input['isiTulisan10'];
        $blindReview->paraf_reviewer = $input['parafReviewer'];
        $blindReview->hasil = $input['hasil'];

        return $blindReview->save();
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function read($id)
    {
        return PjBlindReviewModel::join('pj_jurnal', function ($join) {
            $join->on('pj_jurnal.id', '=', 'pj_blind_review.jurnal_id')
                ->where('pj_jurnal.tahap', '=', 'Blind Review')
                ->where('pj_jurnal.created_by', '=', auth()->user()->id);
        })
            ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
            ->select('pj_jurnal.judul','pj_open_jurnal.volume','pj_open_jurnal.nomor','pj_blind_review.format_penulisan1','pj_blind_review.format_penulisan2',
                'pj_blind_review.format_penulisan2','pj_blind_review.format_penulisan3','pj_blind_review.format_penulisan4','pj_blind_review.format_penulisan5'
                ,'pj_blind_review.format_penulisan6','pj_blind_review.format_penulisan7','pj_blind_review.format_penulisan8','pj_blind_review.format_penulisan9'
                ,'pj_blind_review.format_penulisan10','pj_blind_review.format_penulisan11','pj_blind_review.format_penulisan12','pj_blind_review.format_penulisan13'
                ,'pj_blind_review.isi_tulisan1','pj_blind_review.isi_tulisan2','pj_blind_review.isi_tulisan3','pj_blind_review.isi_tulisan4','pj_blind_review.isi_tulisan5'
                ,'pj_blind_review.isi_tulisan6','pj_blind_review.isi_tulisan7','pj_blind_review.isi_tulisan8','pj_blind_review.isi_tulisan9','pj_blind_review.isi_tulisan10'
                ,'pj_blind_review.hasil','pj_blind_review.paraf_reviewer','pj_blind_review.id','pj_jurnal.created_at'
            )
            ->where('pj_blind_review.id','=',$id)
            ->first();
    }

    public function showAll()
    {
        // TODO: Implement showAll() method.
    }

    public function paginationData(PaginationParam $param)
    {
        $result = new PaginationResult();

        $order = $param->getSortOrder();
        $orderBy = $param->getSortBy();

        $sortBy = (isset($orderBy) ? 'id' : $orderBy);
        $sortOrder = ($order == 'asc' ? 'desc' : $order);

        //setup skip data for paging
        if ($param->getPageSize() == -1) {
            $skipCount = 0;
        } else {
            $skipCount = ($param->getPageIndex() * $param->getPageSize());
        }
        //get total count data
        $result->setTotalCount(PjBlindReviewModel::join('pj_jurnal', function ($join) {
            $join->on('pj_jurnal.id', '=', 'pj_blind_review.jurnal_id')
                ->where('pj_jurnal.tahap', '=', 'Blind Review')
                ->where('pj_jurnal.created_by', '=', auth()->user()->id);
        })
            ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
            ->count());

        //get data
        if ($param->getKeyword() == '') {

            if ($skipCount == 0) {
                $data = PjBlindReviewModel::join('pj_jurnal', function ($join) {
                    $join->on('pj_jurnal.id', '=', 'pj_blind_review.jurnal_id')
                        ->where('pj_jurnal.tahap', '=', 'Blind Review');
                })
                    ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
                    ->select('pj_blind_review.id', 'pj_blind_review.jurnal_id', 'pj_open_jurnal.volume', 'pj_open_jurnal.nomor', 'pj_jurnal.judul', 'pj_jurnal.created_at')
                    ->where('pj_jurnal.created_by', '=', auth()->user()->id)
                    ->take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            } else {
                $data = PjBlindReviewModel::join('pj_jurnal', function ($join) {
                    $join->on('pj_jurnal.id', '=', 'pj_blind_review.jurnal_id')
                        ->where('pj_jurnal.tahap', '=', 'Blind Review');
                })
                    ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
                    ->select('pj_blind_review.id', 'pj_blind_review.jurnal_id', 'pj_open_jurnal.volume', 'pj_open_jurnal.nomor', 'pj_jurnal.judul', 'pj_jurnal.created_at')
                    ->where('pj_jurnal.created_by', '=', auth()->user()->id)
                    ->skip($skipCount)->take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            }
        } else {
            if ($skipCount == 0) {
                $data = PjBlindReviewModel::join('pj_jurnal', function ($join) {
                    $join->on('pj_jurnal.id', '=', 'pj_blind_review.jurnal_id')
                        ->where('pj_jurnal.tahap', '=', 'Blind Review');
                })
                    ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
                    ->select('pj_blind_review.id', 'pj_blind_review.jurnal_id', 'pj_open_jurnal.volume', 'pj_open_jurnal.nomor', 'pj_jurnal.judul', 'pj_jurnal.created_at')
                    ->where(function ($q) {
                        $q->where('pj_jurnal.created_by', '=', auth()->user()->id);
                    })
                    ->where('nama_kategori', 'like', '%' . $param->getKeyword() . '%')
                    ->take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            } else {
                $data = PjBlindReviewModel::join('pj_jurnal', function ($join) {
                    $join->on('pj_jurnal.id', '=', 'pj_blind_review.jurnal_id')
                        ->where('pj_jurnal.tahap', '=', 'Blind Review');
                })
                    ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
                    ->select('pj_blind_review.id', 'pj_blind_review.jurnal_id', 'pj_open_jurnal.volume', 'pj_open_jurnal.nomor', 'pj_jurnal.judul', 'pj_jurnal.created_at')
                    ->where(function ($q) {
                        $q->where('pj_jurnal.created_by', '=', auth()->user()->id);
                    })
                    ->where('nama_kategori', 'like', '%' . $param->getKeyword() . '%')
                    ->orderBy($sortBy, $sortOrder)
                    ->skip($skipCount)->take($param->getPageSize())
                    ->get();
            }
        }

        for ($i = 0; $i < count($data); $i++) {
            $daftarPenulis = '';
            $idJurnal = $data[$i]['jurnal_id'];
            $penulis = PjPenulisJurnal::where('jurnal_id', '=', $idJurnal)->get();
            for ($j = 0; $j < count($penulis); $j++) {
                if (($j++) != count($penulis)) {
                    $daftarPenulis .= $penulis[$j]['nama_penulis'] . ",";
                }
                $daftarPenulis .= $penulis[$j]['nama_penulis'];
            }
            $data[$i]['penulis'] = $daftarPenulis;
        }

        $result->setCurrentPageIndex($param->getPageIndex());
        $result->setCurrentPageSize($param->getPageSize());
        $result->setResult($data);

        return $result;
    }
}