<?php
use DB;
Use App\Models\PjUser;

class UserRepository implements \App\Repository\Contract\IUserRepository
{

    public function create($input)
    {
        $user = new PjUser();
        $user->unik_id = $input['unikId'];
        $user->name = $input['username'];
        $user->email = $input['email'];
        $user->password = $input['password'];
        $user->jurusan = $input['jurusan'];
        $user->instansi = $input['instansi'];
        $user->alamat = $input['alamat'];
        $user->user_level = $input['userLevel'];
        return $user->save();
    }

    public function update($input)
    {
        $user = PjUser::find($input['id']);
        $user->unik_id = $input['unikId'];
        $user->name = $input['name'];
        $user->jurusan = $input['jurusan'];
        $user->instansi = $input['instansi'];
        $user->alamat = $input['alamat'];
        return $user->save();
    }

    public function delete($id)
    {
        return PjUser::find($id)->delete();
    }

    public function read($id)
    {
        return PjUser::find($id);
    }

    public function showAll()
    {
        return PjUser::all();
    }

    public function paginationData(\App\Repository\Contract\Pagination\PaginationParam $param)
    {
        // TODO: Implement paginationData() method.
    }

    public function CekEmail($email)
    {
        $result = PjUser::where('email','=',$email)->count();
        return ($result > 0);
    }

    public function CekPassword($password, $email)
    {
        $result = PjUser::where('email','=',$email)->value('password');
        return \Illuminate\Support\Facades\Hash::check($result,$password);
    }

    public function UpdatePassword($password, $id)
    {
        $update = PjUser::find($id);
        $update->password = $password;
        return $update->save();
    }
}