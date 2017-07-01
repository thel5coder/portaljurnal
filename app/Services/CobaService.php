<?php
/**
 * Created by PhpStorm.
 * User: AhmadShobirin
 * Date: 09/06/2017
 * Time: 15:23
 */

namespace App\Services;


use App\Events\NewListingPost;
use App\Events\ResultModerationListing;
use App\Repositories\Contracts\IImagesLmRepository;
use App\Repositories\Contracts\IListingMobilRepository;
use App\Services\Response\ServiceResponseDto;
use Illuminate\Support\Facades\Event;

class ListingMobilService extends BaseService
{
    protected $listingMobilRepository;
    protected $imageLisitngMobilRepository;

    public function __construct(IListingMobilRepository $listingMobilRepository, IImagesLmRepository $imagesLmRepository)
    {
        $this->listingMobilRepository = $listingMobilRepository;
        $this->imageLisitngMobilRepository = $imagesLmRepository;
    }

    public function create($input)
    {
        $response = new ServiceResponseDto();

        $result = $this->listingMobilRepository->create($input);
        if ($result) {
            for ($i = 0; $i < count($input['carImageList']); $i++) {
                $param = [
                    "listing_mobile_id" => $result,
                    "image" => $input['carImageList'][$i]
                ];
                $this->imageLisitngMobilRepository->create($param);
            }
            Event::fire(new NewListingPost($result, auth()->user()->name, auth()->user()->email));
        } else {
            $message = ['ada error'];
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function update($input)
    {
        $response = new ServiceResponseDto();

        $update = $this->listingMobilRepository->update($input);

        if ($update) {
            for ($i = 0; $i < count($input['carImageList']); $i++) {
                $param = [
                    'id' => $input['idCarImage'][$i],
                    'images' => $input['carImageList'][$i]
                ];
                $this->imageLisitngMobilRepository->update($param);
            }
        } else {
            $message = ['id kosong'];
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function showIklan()
    {
        if (auth()->user()->tipe_user == 'admin') {
            return $this->ShowAll();
        } else {
            return $this->showByUserId();
        }
    }

    public function ShowAll()
    {
        $response = new ServiceResponseDto();

        $dataIklan = $this->getAllObject($this->listingMobilRepository)->getResult();
        $dataGambarIklan = array();
        foreach( $dataIklan as $iklan )
        {
            $dataGambarIklan[$iklan->id] = $this->imageLisitngMobilRepository->showImagesByListingId($iklan->id);
        }
        $dataResult = [
            'iklan' => $dataIklan,
            'gambarIklan' => $dataGambarIklan

        ];
        $response->setResult($dataResult);

        return $response;
    }

    protected function showByUserId()
    {
        $response = new ServiceResponseDto();
        $dataIklan = $this->listingMobilRepository->showByUserId(auth()->user()->id);
        $dataGambarIklan = array();
        foreach ($dataIklan as $iklan) {
            $dataGambarIklan[$iklan->id] = $this->imageLisitngMobilRepository->showImagesByListingId($iklan->id);
        }
        $dataResult = [
            'iklan' => $dataIklan,
            'gambarIklan' => $dataGambarIklan
        ];

        $response->setResult($dataResult);

        return $response;
    }

    public function delete($id)
    {
        $response = new ServiceResponseDto();
        if ($this->deleteObject($this->listingMobilRepository, $id)->isSuccess()) {
            if (!$this->deleteObject($this->imageLisitngMobilRepository, $id)->isSuccess()) {
                $message = ['gagal hapus gambar'];
                $response->addErrorMessage($message);
            }
        } else {
            $message = ['gagal hapus iklan'];
            $response->addErrorMessage($message);
        }

        return $response;
    }

    public function pagination($param)
    {
        return $this->getPaginationObject($this->listingMobilRepository, $param);
    }

    public function read($id)
    {
        $response = new ServiceResponseDto();
        $dataIklan = $this->readObject($this->listingMobilRepository, $id)->getResult();
        $gambarIklan = $this->readObject($this->imageLisitngMobilRepository, $id)->getResult();

        $result = [
            'iklan' => $dataIklan,
            'gambar' => $gambarIklan
        ];

        $response->setResult($result);

        return $response;
    }

    public function setStatusIklan($input)
    {
        $response = new ServiceResponseDto();
        $alasan = (isset($input['alasan'])) ? $input['alasan'] : '';
        $param = [
            'id' => $input['id'],
            'alasan' => $alasan,
            'status' => $input['status']
        ];
        $this->listingMobilRepository->setStatusIklanMobil($param);
        Event::fire(new ResultModerationListing($input['id'], $alasan, $input['status'], $input['email'], $input['name']));
        return $response;
    }

    public function showToHome()
    {
        $response = new ServiceResponseDto();

        $dataIklan = $this->listingMobilRepository->showToHome();
        $dataGambarIklan = $this->imageLisitngMobilRepository->showImagesFirstByListingId($dataIklan->id);
        $dataResult = [
            'iklan' => $dataIklan,
            'gambarIklan' => $dataGambarIklan

        ];
        $response->setResult($dataResult);

        return $response;
    }
}