<?php
namespace App\Services;

use App\Repositories\Contracts\IUserRepository;
use App\Services\Response\ServiceResponseDto;
use Illuminate\Support\Facades\Auth;

class UserService extends BaseService
{
    protected $userRepository;

    public function __construct(IUserRepository $user)
    {
        $this->userRepository = $user;
    }

    protected function isEmailExist($email)
    {
        $response = new ServiceResponseDto();
        $response->setResult($this->userRepository->CekEmail($email));
        return $response;
    }

    protected function isPasswordValid($password, $email)
    {
        $response = new ServiceResponseDto();
        $response->setResult($this->userRepository->CekPassword($password, $email));
        return $response;
    }

    public function Autentikasi($email, $password, $remember)
    {
        $response = new ServiceResponseDto();
        $isEmailExist = $this->isEmailExist($email);
        if ($isEmailExist->getResult()) {
            $isPasswordValid = $this->isPasswordValid($password, $email);
            if ($isPasswordValid->getResult()) {
                if ($remember == 1) {
                    Auth::attempt(['email' => $email, 'password' => $password], true);
                }

                Auth::attempt(['email' => $email, 'password' => $password]);
            } else {
                $message = ['Password Salah'];
                $response->addErrorMessage($message);
            }
        } else {
            $message = ['Email Belum Terdaftar'];
            $response->addErrorMessage($message);
        }
        return $response;
    }

    public function UpdatePassword($password, $id)
    {
        $response = new ServiceResponseDto();
        $this->userRepository->UpdatePassword($password, $id);
        return $response;
    }

    public function AddUser($input)
    {
        $response = new ServiceResponseDto();
        $isEmailExist = $this->isEmailExist($input['email']);
        if ($isEmailExist->getResult()) {
            $message = ['Email Sudah Digunakan'];
            $response->addErrorMessage($message);
        } else {
            $param = [
                'unikId' => (isset($input['unikId']) ? $input['unikId'] : ''),
                'name' => (isset($input['name']) ? $input['name'] : ''),
                'email' => (isset($input['email'])) ? $input['email'] : '',
                'password' => (isset($input['password'])) ? bcrypt($input['password'] ): '',
                'jurusan' => (isset($input['jurusan'])) ? $input['jurusan'] : '',
                'instansi' => (isset($input['instansi'])) ? $input['instansi'] : '',
                'alamat' => (isset($input['alamat'])) ? $input['alamat'] : '',
                'userLevel' => $input['userLevel']
            ];
            $this->userRepository->create($param);
        }
        return $response;
    }

    public function UpdateUser($input)
    {
        $response = new ServiceResponseDto();
        $param = [
            'unikId' => (isset($input['unikId']) ? $input['unikId'] : ''),
            'name' => (isset($input['username']) ? $input['username'] : ''),
            'email' => (isset($input['email'])) ? $input['email'] : '',
            'jurusan' => (isset($input['jurusan'])) ? $input['jurusan'] : '',
            'instansi' => (isset($input['insatansi'])) ? $input['instansi'] : '',
            'alamat' => (isset($input['alamat'])) ? $input['alamat'] : '',
            'userLevel' => $input['userLevel']
        ];
        $this->userRepository->update($param);
        return $response;
    }

    public function all()
    {
        return $this->getAllObject($this->userRepository);
    }

    public function read($id)
    {
        return $this->readObject($this->userRepository, $id);
    }

    public function delete($id)
    {
        return $this->deleteObject($this->userRepository, $id);
    }
}