<?php

use App\Models\PjJurnal;

class JurnalRepository implements \App\Repository\Contract\IPjJurnalRepositroy
{

    public function create($input)
    {
        $create = new PjJurnal();
        $create->open_jurnal_id = $input['openJurnalId'];
        $create->jurnal = $input['judul'];
        $create->abstrak = $input['absrak'];
        $create->jurusan = $input['jurusan'];
        $create->instansi = $input['instansi'];
        $create->kategori_id = $input['kategoriId'];
        $create->file_Jurnal = $input['fileJurnal'];
        $create->cover_jurnal = '';
        $create->status = '';
        return $create->save();
    }

    public function update($input)
    {
        $update = PjJurnal::find($input['id']);
        $update->open_jurnla_id = $input['openJurnalId'];
        $update->jurnal = $input['jurnal'];
        $update->abstrak = $input['abstrak'];
        $update->jurusan = $input['jurusan'];
        $update->instansi = $input['instansi'];
        $update->kategori_id = $input['kategoriId'];
        $update->file_jurnal = $input['fileJurnal'];
        return $update->save();
    }

    public function delete($id)
    {
        return PjJurnal::find($id)->delete();
    }

    public function read($id)
    {
        return PjJurnal::find($id);
    }

    public function showAll()
    {
        return PjJurnal::all();
    }

    public function paginationData(\App\Repository\Contract\Pagination\PaginationParam $param)
    {
        // TODO: Implement paginationData() method.
    }

    public function UpdateTahap($tahap, $id)
    {
        $updateTahap = PjJurnal::find($id);
        $updateTahap->tahap = $tahap;
        return $updateTahap->save();
    }

    public function Status($status, $id)
    {
        $updateStatusJurnal = PjJurnal::find($id);
        $updateStatusJurnal->status = $status;
        return $updateStatusJurnal->save();
    }

    public function Download($pdf, $id)
    {
        // TODO: Implement Download() method.
    }

    public function UploadCover($id)
    {
        // TODO: Implement UploadCover() method.
    }
}