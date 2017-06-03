<?php
/**
 * Created by PhpStorm.
 * User: AhmadShobirin
 * Date: 02/06/2017
 * Time: 11:09
 */

namespace App\Services;
use App\Repository\Contract\IPjJurnalRepositroy;
use App\Services\Response\ServiceResponseDto;

class PjJurnalService extends BaseService
{
    protected $PjJurnal;
    public function __construct(IPjJurnalRepositroy $pjJurnal)
    {
        $this->PjJurnal = $pjJurnal;
    }

    public function create($input)
    {
        $response = new ServiceResponseDto();
        if(!$this->PjJurnal->create($input))
        {
            $message = ['gagal menambah data'];
            $response->addErrorMessage($message);
        }
        return $response;
    }

    public function update($input)
    {
        $response = new ServiceResponseDto();
        if(!$this->PjJurnal->update($input))
        {
            $message = ['gagal mengupdate data'];
            $response->addErrorMessage($message);
        }
        return $response;
    }

    public function all()
    {
        return $this->getAllObject($this->PjJurnal);
    }

    public  function read($id)
    {
        return $this->readObject($this->PjJurnal,$id);
    }

    public function delete($id)
    {
        return $this->deleteObject($this->PjJurnal,$id);
    }

    public function UpdateTahap($input)
    {
        $response = new ServiceResponseDto();
        if(!$this->PjJurnal->UpdateTahap($input['tahap'],$input['id']))
        {
            $message = ['Update Tahap Gagal'];
            $response->addErrorMessage($message);
        }
        return $response;
    }

    public function UpdateStatus($input)
    {
        $response = new ServiceResponseDto();
        if (!$this->PjJurnal->Status($input['status'],$input['id']))
        {
            $message = ['Update Status Gagal'];
            $response->addErrorMessage($message);
        }
        return $response;
    }
}