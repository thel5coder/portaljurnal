<?php
namespace App\Repositories\Actions;

use App\Models\PjJurnal;
use App\Models\PjPenulisJurnal;
use App\Repositories\Contracts\Pagination\PaginationParam;
use App\Repositories\Contracts\Pagination\PaginationResult;
use App\Repositories\Contracts\IJurnalRepository;

class JurnalRepository implements IJurnalRepository
{

    public function create($input)
    {
        $create = new PjJurnal();
        $create->open_jurnal_id = $input['openJurnalId'];
        $create->judul = $input['judul'];
        $create->abstrak = $input['abstrak'];
        $create->jurusan = $input['jurusan'];
        $create->instansi = $input['instansi'];
        $create->kategori_id = $input['kategoriId'];
        $create->file_Jurnal = $input['fileJurnal'];
        $create->cover_jurnal = '';
        $create->status = 'Open';
        $create->tahap = 'Received';
        $create->created_by = auth()->user()->id;
        $create->save();

        return $create->id;
    }

    public function update($input)
    {
        $update = PjJurnal::find($input['id']);
        $create->judul = $input['judul'];
        $create->abstrak = $input['abstrak'];
        $create->jurusan = $input['jurusan'];
        $create->instansi = $input['instansi'];
        $create->kategori_id = $input['kategoriId'];
        $create->file_Jurnal = $input['fileJurnal'];
        $create->status = 'Open';
        $create->tahap = 'Received';
        $create->created_by = auth()->user()->id;

        return $update->save();
    }

    public function delete($id)
    {
        return PjJurnal::find($id)->delete();
    }

    public function read($id)
    {
        return PjJurnal::join('pj_kategori','pj_kategori.id','=','pj_jurnal.kategori_id')
            ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
            ->select('pj_jurnal.*','pj_kategori.nama_kategori','pj_open_jurnal.volume','pj_open_jurnal.nomor')
            ->where('pj_jurnal.id','=',$id)
            ->first();
    }

    public function showAll()
    {
        return PjJurnal::all();
    }

    public function paginationData(PaginationParam $param)
    {
        $result = new PaginationResult();

        $sortBy = ($param->getSortBy() == '' ? 'id' : $param->getSortBy());
        $sortOrder = ($param->getSortOrder() == '' ? 'asc' : $param->getSortOrder());

        //setup skip data for paging
        if ($param->getPageSize() == -1) {
            $skipCount = 0;
        } else {
            $skipCount = ($param->getPageIndex() * $param->getPageSize());
        }
        //get total count data
        $result->setTotalCount(PjJurnal::join('pj_kategori','pj_kategori.id','=','pj_jurnal.kategori_id')
            ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
            ->where('pj_jurnal.created_by','=',auth()->user()->id)->count());

        //get data
        if ($param->getKeyword() == '') {

            if ($skipCount == 0) {
                $data = PjJurnal::join('pj_kategori','pj_kategori.id','=','pj_jurnal.kategori_id')
                    ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
                    ->select('pj_jurnal.*','pj_kategori.nama_kategori','pj_open_jurnal.volume','pj_open_jurnal.nomor')
                    ->where('pj_jurnal.created_by','=',auth()->user()->id)
                    ->take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            } else {
                $data = PjJurnal::join('pj_kategori','pj_kategori.id','=','pj_jurnal.kategori_id')
                    ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
                    ->select('pj_jurnal.*','pj_kategori.nama_kategori','pj_open_jurnal.volume','pj_open_jurnal.nomor')
                    ->where('pj_jurnal.created_by','=',auth()->user()->id)
                    ->skip($skipCount)->take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            }
        } else {
            if ($skipCount == 0) {
                $data = PjJurnal::join('pj_kategori','pj_kategori.id','=','pj_jurnal.kategori_id')
                    ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
                    ->select('pj_jurnal.*','pj_kategori.nama_kategori','pj_open_jurnal.volume','pj_open_jurnal.nomor')
                    ->where('pj_jurnal.created_by','=',auth()->user()->id)
                    ->where(function ($q)use($param){
                        $q->where('pj_jurnal.udul', 'like', '%' . $param->getKeyword() . '%')
                            ->where('pj_kategori.nama_kategori', 'like', '%' . $param->getKeyword() . '%')
                            ->where('pj_open_jurnal.volume', 'like', '%' . $param->getKeyword() . '%');
                    })
                    ->take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            } else {
                $data =  PjJurnal::join('pj_kategori','pj_kategori.id','=','pj_jurnal.kategori_id')
                    ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
                    ->select('pj_jurnal.*','pj_kategori.nama_kategori','pj_open_jurnal.volume','pj_open_jurnal.nomor')
                    ->where('pj_jurnal.created_by','=',auth()->user()->id)
                    ->where(function ($q)use($param){
                        $q->where('pj_jurnal.udul', 'like', '%' . $param->getKeyword() . '%')
                            ->where('pj_kategori.nama_kategori', 'like', '%' . $param->getKeyword() . '%')
                            ->where('pj_open_jurnal.volume', 'like', '%' . $param->getKeyword() . '%');
                    })
                    ->orderBy($sortBy, $sortOrder)
                    ->skip($skipCount)->take($param->getPageSize())
                    ->get();
            }
        }

        for($i=0;$i<count($data);$i++){
            $daftarPenulis='';
            $idJurnal = $data[$i]['id'];
            $penulis = PjPenulisJurnal::where('jurnal_id','=',$idJurnal)->get();
            for($j=0;$j<count($penulis);$j++){
                if(($j++)!=count($penulis)){
                    $daftarPenulis .= $penulis[$j]['nama_penulis'].",";
                }
                $daftarPenulis .= $penulis[$j]['nama_penulis'];
            }
            $data[$i]['penulis']=$daftarPenulis;
        }


        $result->setCurrentPageIndex($param->getPageIndex());
        $result->setCurrentPageSize($param->getPageSize());
        $result->setResult($data);

        return $result;
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

    public function UploadCover($id,$cover)
    {
        $cover = PjJurnal::find($id);
        $cover->cover_jurnal = $cover;

        return $cover->save();
    }

    public function paginationByTahap(PaginationParam $param, $tahap)
    {
        $result = new PaginationResult();

        $sortBy = ($param->getSortBy() == '' ? 'id' : $param->getSortBy());
        $sortOrder = ($param->getSortOrder() == '' ? 'asc' : $param->getSortOrder());

        //setup skip data for paging
        if ($param->getPageSize() == -1) {
            $skipCount = 0;
        } else {
            $skipCount = ($param->getPageIndex() * $param->getPageSize());
        }
        //get total count data
        $result->setTotalCount(PjJurnal::join('pj_kategori','pj_kategori.id','=','pj_jurnal.kategori_id')
            ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
            ->where('pj_jurnal.tahap','=',$tahap)->count());

        //get data
        if ($param->getKeyword() == '') {

            if ($skipCount == 0) {
                $data = PjJurnal::join('pj_kategori','pj_kategori.id','=','pj_jurnal.kategori_id')
                    ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
                    ->select('pj_jurnal.*','pj_kategori.nama_kategori','pj_open_jurnal.volume','pj_open_jurnal.nomor')
                    ->where('pj_jurnal.tahap','=',$tahap)
                    ->take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            } else {
                $data = PjJurnal::join('pj_kategori','pj_kategori.id','=','pj_jurnal.kategori_id')
                    ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
                    ->select('pj_jurnal.*','pj_kategori.nama_kategori','pj_open_jurnal.volume','pj_open_jurnal.nomor')
                    ->where('pj_jurnal.tahap','=',$tahap)
                    ->skip($skipCount)->take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            }
        } else {
            if ($skipCount == 0) {
                $data = PjJurnal::join('pj_kategori','pj_kategori.id','=','pj_jurnal.kategori_id')
                    ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
                    ->select('pj_jurnal.*','pj_kategori.nama_kategori','pj_open_jurnal.volume','pj_open_jurnal.nomor')
                    ->where('pj_jurnal.tahap','=',$tahap)
                    ->where(function ($q)use($param){
                        $q->where('pj_jurnal.udul', 'like', '%' . $param->getKeyword() . '%')
                            ->where('pj_kategori.nama_kategori', 'like', '%' . $param->getKeyword() . '%')
                            ->where('pj_open_jurnal.volume', 'like', '%' . $param->getKeyword() . '%');
                    })
                    ->take($param->getPageSize())
                    ->orderBy($sortBy, $sortOrder)
                    ->get();
            } else {
                $data =  PjJurnal::join('pj_kategori','pj_kategori.id','=','pj_jurnal.kategori_id')
                    ->join('pj_open_jurnal','pj_open_jurnal.id','=','pj_jurnal.open_jurnal_id')
                    ->select('pj_jurnal.*','pj_kategori.nama_kategori','pj_open_jurnal.volume','pj_open_jurnal.nomor')
                    ->where('pj_jurnal.tahap','=',$tahap)
                    ->where(function ($q)use($param){
                        $q->where('pj_jurnal.udul', 'like', '%' . $param->getKeyword() . '%')
                            ->where('pj_kategori.nama_kategori', 'like', '%' . $param->getKeyword() . '%')
                            ->where('pj_open_jurnal.volume', 'like', '%' . $param->getKeyword() . '%');
                    })
                    ->orderBy($sortBy, $sortOrder)
                    ->skip($skipCount)->take($param->getPageSize())
                    ->get();
            }
        }

        for($i=0;$i<count($data);$i++){
            $daftarPenulis='';
            $idJurnal = $data[$i]['id'];
            $penulis = PjPenulisJurnal::where('jurnal_id','=',$idJurnal)->get();
            for($j=0;$j<count($penulis);$j++){
                if(($j++)!=count($penulis)){
                    $daftarPenulis .= $penulis[$j]['nama_penulis'].",";
                }
                $daftarPenulis .= $penulis[$j]['nama_penulis'];
            }
            $data[$i]['penulis']=$daftarPenulis;
        }


        $result->setCurrentPageIndex($param->getPageIndex());
        $result->setCurrentPageSize($param->getPageSize());
        $result->setResult($data);

        return $result;
    }
}