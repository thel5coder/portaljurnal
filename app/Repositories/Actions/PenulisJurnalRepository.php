<?php

namespace App\Repositories\Actions;


use App\Repositories\Contracts\IPenulisJurnalRepository;
use App\Repositories\Contracts\Pagination\PaginationParam;
use App\Repositories\Contracts\Pagination\PaginationResult;
use App\Models\PjPenulisJurnal;

class PenulisJurnalRepository implements IPenulisJurnalRepository
{

    public function create($input)
    {
        $create = new PjPenulisJurnal();
        $create->jurnal_id  = $input['jurnalId'];
        $create->nama_penulis = $input['namaPenulis'];
        return $create->save();
    }

    public function update($input)
    {
        $penulisJurnal = PjPenulisJurnal::find($input['id']);
        $penulisJurnal->nama_penulis = $input['namaPenulis'];
        return $penulisJurnal->save();
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function read($id)
    {
        return PjPenulisJurnal::where('jurnal_id','=',$id)->get();
    }

    public function showAll()
    {
        // TODO: Implement showAll() method.
    }

    public function paginationData(PaginationParam $param)
    {
        // TODO: Implement paginationData() method.
    }

    public function deleteByJurnal($jurnalId)
    {
        return PjPenulisJurnal::where('jurnal_id','=',$jurnalId)->delete();
    }


}