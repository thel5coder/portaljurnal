<?php

/**
 * Created by PhpStorm.
 * User: AhmadShobirin
 * Date: 02/06/2017
 * Time: 17:13
 */
use App\Models\PjPenulisJurnal;
class PenulisJurnal implements \App\Repository\Contract\IPenulisJurnal
{

    public function create($input)
    {
        $create = new PjPenulisJurnal();
        $create->jurnal_id  = $input['jurnalId'];
        $create->unik_id = $input['unikID'];
        $create->nama_penulis = $input['nama_penulis'];
        return $create->save();
    }

    public function update($input)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function read($id)
    {
        // TODO: Implement read() method.
    }

    public function showAll()
    {
        // TODO: Implement showAll() method.
    }

    public function paginationData(\App\Repository\Contract\Pagination\PaginationParam $param)
    {
        // TODO: Implement paginationData() method.
    }

    public function ShowAllPenulis($jurnalId)
    {
        $result = PjPenulisJurnal::find($jurnalId)->count();
        return ($result > 0);
    }
}