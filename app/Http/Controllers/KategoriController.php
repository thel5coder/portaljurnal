<?php

namespace App\Http\Controllers;

use App\Services\KategoriService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    protected $kategoriService;

    public function __construct(KategoriService $kategoriService)
    {
        $this->kategoriService = $kategoriService;
    }

    public function pagination(){
        $param = $this->getPaginationParams();
        $result = $this->kategoriService->pagination($param);

        return $this->parsePaginationResultToGridJson($result);
    }

    public function create(Request $request){
        $result = $this->kategoriService->create($request->all());

        return $this->getJsonResponse($result);
    }

    public function read($id){
        $result = $this->kategoriService->read($id)->getResult();
        $data = [
            'id'=>$result->id,
            'namaKategori'=>$result->nama_kategori
        ];

        return response()->json($data);
    }

    public function showAll(){
        $result = $this->kategoriService->showAll()->getResult();

        for($i=0;$i<count($result);$i++){
            $data[] = [
                'kategoriId'=>$result[$i]->id,
                'namaKategori'=>$result[$i]->nama_kategori
            ];
        }

        return response()->json($data);
    }

    public function update(Request $request){
        $result = $this->kategoriService->update($request);

        return $this->getJsonResponse($result);
    }

    public function delete($id){
        $result = $this->kategoriService->delete($id);

        return $this->getJsonResponse($result);
    }
}
