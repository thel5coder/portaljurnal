<?php

namespace App\Repository\Contract;

use App\Repository\Contract\Pagination\PaginationParam;

interface IBaseRepository {

    public function create($input);

    public function update($input);

    public function delete($id);

    public function read($id);

    public function showAll();

    public function paginationData(PaginationParam $param);
}
