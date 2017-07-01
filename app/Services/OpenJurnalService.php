<?php
/**
 * Created by PhpStorm.
 * User: AhmadShobirin
 * Date: 01/06/2017
 * Time: 1:18
 */

namespace App\Services;


use App\Repositories\Contracts\IOpenJurnalRepository;
use App\Services\Response\ServiceResponseDto;

class OpenJurnalService extends BaseService
{
    protected $openJurnalRepository;

    public function __construct(IOpenJurnalRepository $openJurnalRepository)
    {
        $this->openJurnalRepository = $openJurnalRepository;
    }

    public function create($input)
    {
        $response = new ServiceResponseDto();
        $tglBuka = date('Y-m-d',strtotime($input['tglBuka']));
        $tglTutup = date('Y-m-d',strtotime($input['tglTutup']));

        $param = [
            'tglBuka'=>$tglBuka,
            'tglTutup'=>$tglTutup,
            'volume'=>$input['volume'],
            'nomor'=>$input['nomor']
        ];

        if(!$this->openJurnalRepository->create($param)){
            $message = ['Gagal Menambah Data'];
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function all()
    {
        return $this->getAllObject($this->openJurnalRepository);
    }

    public function read($id)
    {
        return $this->readObject($this->openJurnalRepository,$id);
    }

    public function update($input){
        $response = new ServiceResponseDto();
        $tglBuka = date('Y-m-d',strtotime($input['tglBuka']));
        $tglTutup = date('Y-m-d',strtotime($input['tglTutup']));

        $param = [
            'id'=>$input['id'],
            'tglBuka'=>$tglBuka,
            'tglTutup'=>$tglTutup,
            'volume'=>$input['volume'],
            'nomor'=>$input['nomor']
        ];

        if(!$this->openJurnalRepository->update($param)){
            $message = ['Gagal Mengubah Data'];
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function delete($id)
    {
        return $this->deleteObject($this->openJurnalRepository,$id);
    }

    public function pagination($param){
        return $this->getPaginationObject($this->openJurnalRepository,$param);
    }

    public function getDefaultOpenJurnal(){
        $response = new ServiceResponseDto();

        $response->setResult($this->openJurnalRepository->getDefaultOpenJurnal());

        return $response;
    }

}