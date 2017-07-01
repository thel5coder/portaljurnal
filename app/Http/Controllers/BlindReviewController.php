<?php

namespace App\Http\Controllers;

use App\Services\PjJurnalService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class BlindReviewController extends Controller
{
    protected $jurnalService;

    public function __construct(PjJurnalService $jurnalService)
    {
        $this->jurnalService = $jurnalService;
    }

    public function post(Request $request)
    {
        $response = $this->jurnalService->createBlindReview($request->all());

        return $this->getJsonResponse($response);
    }

    public function pagination()
    {
        $param = $this->getPaginationParams();
        $response = $this->jurnalService->paginationBlindReview($param);

        return $this->parsePaginationResultToGridJson($response);
    }

    public function download($id)
    {
        $response = $this->jurnalService->downloadBlindReview($id);

        if($response->isSuccess()){
            return 'berhasil';
        }else{
            return 'gagal';
        }

    }
}
