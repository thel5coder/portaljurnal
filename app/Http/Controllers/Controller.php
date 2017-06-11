<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\Response\ServiceResponseDto;
use Illuminate\Support\Facades\Input;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function getJsonResponse(ServiceResponseDto $response) {
        try {
            if ($response->isSuccess()) {
                return response()->json(['isSuccess'=>true]);
            } else {
                return response()->json(['isSuccess'=>false,'message'=>$response->getErrorMessages()]);
            }
        } catch (\Exception $ex) {
            $message = ['Invalid Proccess'];

            $response->addErrorMessage($message);

            return response()->json(['message' => $ex->getMessage()],500);
        }
    }

    protected function getPaginationParams() {
        $param = [
            'pageIndex' => intval(Input::get('current')), 'pageSize' => intval(Input::get('rowCount')), 'sort' => Input::get('sort'), 'searchPhrase' => Input::get('searchPhrase')
        ];

        return $param;
    }

    protected function parsePaginationResultToGridJson(ServiceResponseDto $paginationResponseDto) {
        $result = [
            'current' => $paginationResponseDto->getCurrentPage(),
            'rowCount' => $paginationResponseDto->getPageSize(),
            'rows' => $paginationResponseDto->getResult(),
            'total' => $paginationResponseDto->getTotalCount(),
        ];

        return response()->json($result);
    }

    protected function getResponseAutoComplete(ServiceResponseDto $response) {
        try {
            if ($response->isSuccess()) {
                return response()->json($response->getResult());
            } else {
                return response()->json(['msg' => $response->getErrorMessages()]);
            }
        } catch (Exception $ex) {
            $message = ['invalid Proccess'];

            $response->addErrorMessage($message);

            return response()->json(['msg' => $response->getErrorMessages()]);
        }
    }
}
