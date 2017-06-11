<?php

namespace App\Http\Controllers;

use App\Services\OpenJurnalService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class OpenJurnalController extends Controller
{
    protected $openJurnalService;

    public function __construct(OpenJurnalService $openJurnalService)
    {
        $this->openJurnalService = $openJurnalService;
    }

    public function pagination(){
        $param = $this->getPaginationParams();
        $result = $this->openJurnalService->pagination($param);

        return $this->parsePaginationResultToGridJson($result);
    }

    public function create(Request $request){
        $result = $this->openJurnalService->create($request->all());

        return $this->getJsonResponse($result);
    }

    public function read($id){
        $result = $this->openJurnalService->read($id)->getResult();
        $data=[
            'id'=>$result->id,
            'tglBuka'=>date('d-m-Y',strtotime($result->tgl_buka)),
            'tglTutup'=>date('d-m-Y',strtotime($result->tgl_tutup)),
            'volume'=>$result->volume,
            'nomor'=>$result->nomor
        ];

        return response()->json($data);
    }

    public function update(Request $request){
        $result = $this->openJurnalService->update($request->all());

        return $this->getJsonResponse($result);
    }

    public function delete($id){
        $result = $this->openJurnalService->delete($id);

        return $this->getJsonResponse($result);
    }
}
