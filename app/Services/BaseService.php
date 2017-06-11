<?php

namespace App\Services;

use App\Repositories\Contracts\IBaseRepository;
use App\Services\Response\ServiceResponseDto as ResponseDto;
use App\Services\Response\ServicePaginationResponseDto as PaginationDto;
use App\Repositories\Contracts\Pagination\PaginationParam;

abstract class BaseService {

    protected function deleteObject(IBaseRepository $repository, $id) {
        $response = new ResponseDto();

        $response->setResult($repository->delete($id));

        return $response;
    }

    protected function readObject(IBaseRepository $repository, $id) {
        $response = new ResponseDto();
        $response->setResult($repository->read($id));

        return $response;
    }

    protected function getAllObject(IBaseRepository $repository) {
        $response = new ResponseDto();
        $response->setResult($repository->showAll());

        return $response;
    }

    protected function getPaginationObject(IBaseRepository $repository, $param) {
        $response = new PaginationDto();
   
        $pagingResult = $repository->paginationData($this->parsePaginationParam($param));
        $response->setCurrentPage($param['pageIndex']);
        $response->setPageSize($param['pageSize']);
        $response->setTotalCount($pagingResult->getTotalCount());
        $response->setResult($pagingResult->getResult());

        return $response;
    }

    protected function parsePaginationParam($param) {
        $paginationParam = new PaginationParam();
        $paginationParam->setKeyword($param['searchPhrase']);
        $paginationParam->setPageIndex($param['pageIndex']);
        $paginationParam->setPageSize($param['pageSize']);

        if ($param['sort'] != '') {
            foreach ($param['sort'] as $key => $value) {
                $paginationParam->setSortBy($key);
                $paginationParam->setSortOrder($value);
            }
        }
        
        return $paginationParam;
    }

}
