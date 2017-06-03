<?php

use App\Models\PjOpenJurnalModel;
class OpenJurnalRepository implements \App\Repository\Contract\IOpenJurnalRepository
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
        return $create->save();
    }

    public function delete($id)
    {
        return PjOpenJurnalModel::find($id);
    }

    public function read($id)
    {
        return PjOpenJurnalModel::find($id);
    }

    public function showAll()
    {
        return PjOpenJurnalModel::all();
    }

    public function paginationData(\App\Repository\Contract\Pagination\PaginationParam $param)
    {
        // TODO: Implement paginationData() method.
    }
}