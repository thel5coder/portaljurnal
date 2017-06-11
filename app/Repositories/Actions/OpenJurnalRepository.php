<?php
namespace App\Repositories\Actions;

use App\Models\PjOpenJurnalModel;
use App\Repositories\Contracts\Pagination\PaginationResult;
use App\Repositories\Contracts\IOpenJurnalRepository;
use DB;

class OpenJurnalRepository implements IOpenJurnalRepository
{

    public function create($input)
    {
        $create = new PjOpenJurnalModel();
        $create->tgl_buka = $input['tglBuka'];
        $create->tgl_tutup = $input['tglTutup'];
        $create->volume = $input['volume'];
        $create->nomor = $input['nomor'];
        return $create->save();
    }

    public function update($input)
    {
        $update = PjOpenJurnalModel::find($input['id']);
        $update->tgl_buka = $input['tglBuka'];
        $update->tgl_tutup = $input['tglTutup'];
        $update->volume = $input['volume'];
        $update->nomor = $input['nomor'];
        return $update->save();
    }

    public function delete($id)
    {
        return PjOpenJurnalModel::find($id)->delete();
    }

    public function read($id)
    {
        return PjOpenJurnalModel::find($id);
    }

    public function showAll()
    {
        return PjOpenJurnalModel::all();
    }

    public function paginationData(\App\Repositories\Contracts\Pagination\PaginationParam $param)
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
        $result->setTotalCount(PjOpenJurnalModel::count());

        //get data
        if ($param->getKeyword() == '') {

            if ($skipCount == 0) {
                $data = PjOpenJurnalModel::take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            } else {
                $data = PjOpenJurnalModel::skip($skipCount)->take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            }
        } else {
            if ($skipCount == 0) {
                $data = PjOpenJurnalModel::where('tgl_buka', 'like', '%' . $param->getKeyword() . '%')
                    ->where('tgl_tutup', 'like', '%' . $param->getKeyword() . '%')
                    ->where('volume', 'like', '%' . $param->getKeyword() . '%')
                    ->take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            } else {
                $data =  PjOpenJurnalModel::where('tgl_buka', 'like', '%' . $param->getKeyword() . '%')
                    ->where('tgl_tutup', 'like', '%' . $param->getKeyword() . '%')
                    ->where('volume', 'like', '%' . $param->getKeyword() . '%')
                    ->orderBy($sortBy, $sortOrder)
                    ->skip($skipCount)->take($param->getPageSize())
                    ->get();
            }
        }

        $result->setCurrentPageIndex($param->getPageIndex());
        $result->setCurrentPageSize($param->getPageSize());
        $result->setResult($data);

        return $result;
    }
}