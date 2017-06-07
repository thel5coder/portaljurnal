<?php
/**
 * Created by PhpStorm.
 * User: AhmadShobirin
 * Date: 31/05/2017
 * Time: 15:15
 */

namespace App\Repositories\Contracts;

interface IUserRepository extends IBaseRepository
{
    public function CekEmail($email);
    public function CekPassword($password,$email);
    public function UpdatePassword($password,$id);
}