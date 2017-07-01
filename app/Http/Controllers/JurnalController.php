<?php

namespace App\Http\Controllers;

use App\Models\PjJurnal;
use App\Models\PjPenulisJurnal;
use App\Services\PjJurnalService;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class JurnalController extends Controller
{
    protected $jurnalService;

    public function __construct(PjJurnalService $jurnalService)
    {
        $this->jurnalService = $jurnalService;
    }

    public function pagination(){
        $param = $this->getPaginationParams();
        $response = $this->jurnalService->pagination($param);

        return $this->parsePaginationResultToGridJson($response);

//        $data = PjJurnal::join('pj_kategori','pj_kategori.id','=','pj_jurnal.kategori_id')
//            ->select('pj_jurnal.*','pj_kategori.nama_kategori')
//            ->where('created_by','=',7)
//            ->get();

//        $result = PjJurnal::join('pj_kategori','pj_kategori.id','=','pj_jurnal.kategori_id')
//            ->select('pj_jurnal.*','pj_kategori.nama_kategori')
//            ->get();
//       for($i=0;$i<count($result);$i++){
//           $daftarPenulis='';
//           $idJurnal = $result[$i]['id'];
//           $penulis = PjPenulisJurnal::where('jurnal_id','=',$idJurnal)->get();
//           for($j=0;$j<count($penulis);$j++){
//               if(($j++)!=count($penulis)){
//                   $daftarPenulis .= $penulis[$j]['nama_penulis'].",";
//               }
//               $daftarPenulis .= $penulis[$j]['nama_penulis'];
//           }
//           $result[$i]['penulis']=$daftarPenulis;
//       }

        return response()->json($data);
    }

    public function create(Request $request){
        $result = $this->jurnalService->create($request->all());

        return $this->getJsonResponse($result);

//        return response()->json(Input::file('fileJurnal')->getClientOriginalName());

    }

    public function read($id){
        $jurnal = $this->jurnalService->readJurnal($id)->getResult();

        $dataJurnal = [
            'id'=>$jurnal->id,
            'openJurnalId'=>$jurnal->open_jurnal_id,
            'volume'=>$jurnal->volume,
            'nomor'=>$jurnal->nomor,
            'judul'=>$jurnal->judul,
            'abstrak'=>$jurnal->abstrak,
            'jurusan'=>$jurnal->jurusan,
            'instansi'=>$jurnal->instansi,
            'namaKategori'=>$jurnal->nama_kategori,
            'kategoriId'=>$jurnal->kategori_id,
            'fileJurnal'=>$jurnal->file_jurnal
        ];


        return response()->json($dataJurnal);
    }

    public function readPenulisJurnal($id){
        $penulis = $this->jurnalService->readPenulis($id)->getResult();
        $dataPenulis=array();

        for($i=0;$i<count($penulis);$i++){
            $dataPenulis[]=[
                'idPenulisJurnal'=>$penulis[$i]->id,
                'namaPenulis'=>$penulis[$i]->nama_penulis
            ];
        }

        return response()->json($dataPenulis);

    }

    public function update(){
        $response = $this->jurnalService->update(Input::all());

        return $this->getJsonResponse($response);
    }

    public function delete($id){
        $response = $this->jurnalService->delete($id);

        return $this->getJsonResponse($response);
    }

    public function paginationJurnalUsulan(){
        $param = $this->getPaginationParams();
        $response = $this->jurnalService->paginationByTahap($param);

        return $this->parsePaginationResultToGridJson($response);
    }
}
