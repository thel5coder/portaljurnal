<?php
/**
 * Created by PhpStorm.
 * User: syaikhul
 * Date: 11/06/2017
 * Time: 23.44
 */

namespace App\Services;


use App\Repositories\Contracts\IKategoriRepository;
use App\Services\Response\ServiceResponseDto;

class KategoriService extends BaseService
{
    protected $kategoriRepository;

    public function __construct(IKategoriRepository $kategoriRepository)
    {
        $this->kategoriRepository = $kategoriRepository;
    }

    public function create($input){
        $response = new ServiceResponseDto();

        if(!$this->kategoriRepository->create($input)){
            $message = ['Gagal menyimpan'];
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function read($id){
        return $this->readObject($this->kategoriRepository,$id);
    }

    public function showAll(){
        return $this->getAllObject($this->kategoriRepository);
    }

    public function update($input){
        $response = new ServiceResponseDto();

        if(!$this->kategoriRepository->update($input)){
            $message = ['Gagal menyimpan'];
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function delete($id){
        return $this->deleteObject($this->kategoriRepository,$id);
    }

    public function pagination($param){
        return $this->getPaginationObject($this->kategoriRepository,$param);
    }

}