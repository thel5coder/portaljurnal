<?php
/**
 * Created by PhpStorm.
 * User: AhmadShobirin
 * Date: 02/06/2017
 * Time: 17:11
 */

namespace App\Repository\Contract;


interface IPenulisJurnal extends IBaseRepository
{
    public function ShowAllPenulis($jurnalId);
}