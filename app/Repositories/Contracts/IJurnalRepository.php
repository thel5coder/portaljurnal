<?php

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\Pagination\PaginationParam;
use App\Repositories\Contracts\Pagination\PaginationResult;
interface IJurnalRepository extends IBaseRepository
{
    public function UpdateTahap($tahap, $id);

    public function Status($status, $id);

    public function UploadCover($id,$cover);

    public function paginationByTahap(PaginationParam $param,$tahap);
}