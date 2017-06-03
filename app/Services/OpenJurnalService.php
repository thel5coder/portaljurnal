<?php
/**
 * Created by PhpStorm.
 * User: AhmadShobirin
 * Date: 01/06/2017
 * Time: 1:18
 */

namespace App\Services;


use App\Repository\Contract\IOpenJurnalRepository;
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
        if(!$this->openJurnalRepository->create($input)){
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

    public function delete($id)
    {
        return $this->deleteObject($this->openJurnalRepository,$id);
    }

}