<?php
/**
 * Created by PhpStorm.
 * User: syaikhul
 * Date: 11/06/2017
 * Time: 23.39
 */

namespace App\Repositories\Actions;


use App\Models\PjKategoriModel;
use App\Repositories\Contracts\IKategoriRepository;
use App\Repositories\Contracts\Pagination\PaginationParam;
use App\Repositories\Contracts\Pagination\PaginationResult;

class KategoriRepository implements IKategoriRepository
{
    public function create($input)
    {
        $kategori = new PjKategoriModel();
        $kategori->nama_kategori = $input['namaKategori'];

        return $kategori->save();
    }

    public function update($input)
    {
        $kategori = PjKategoriModel::find($input['id']);
        $kategori->nama_kategori = $input['namaKategori'];

        return $kategori->save();
    }

    public function delete($id)
    {
        return PjKategoriModel::find($id)->delete();
    }

    public function read($id)
    {
        return PjKategoriModel::find($id);
    }

    public function showAll()
    {
        return PjKategoriModel::all();
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
        $result->setTotalCount(PjKategoriModel::count());

        //get data
        if ($param->getKeyword() == '') {

            if ($skipCount == 0) {
                $data = PjKategoriModel::take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            } else {
                $data = PjKategoriModel::skip($skipCount)->take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            }
        } else {
            if ($skipCount == 0) {
                $data = PjKategoriModel::where('nama_kategori', 'like', '%' . $param->getKeyword() . '%')
                    ->take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            } else {
                $data =  PjKategoriModel::where('nama_kategori', 'like', '%' . $param->getKeyword() . '%')
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