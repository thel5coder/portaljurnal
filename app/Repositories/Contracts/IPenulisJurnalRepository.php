<?php
/**
 * Created by PhpStorm.
 * User: AhmadShobirin
 * Date: 02/06/2017
 * Time: 17:11
 */

namespace App\Repositories\Contracts;


interface IPenulisJurnalRepository extends IBaseRepository
{
    public function deleteByJurnal($jurnalId);
}