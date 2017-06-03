<?php
/**
 * Created by PhpStorm.
 * User: AhmadShobirin
 * Date: 02/06/2017
 * Time: 9:52
 */

namespace App\Repository\Contract;
interface IPjJurnalRepositroy extends IBaseRepository
{
    public function UpdateTahap($tahap,$id);
    public function Status($status,$id);
    public function Download($pdf,$id);
    public function UploadCover($id);
}