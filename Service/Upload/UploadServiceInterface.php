<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 16:46
 */

namespace Service\Upload;


interface UploadServiceInterface
{
    public function upload($fileInfo, $destination): string;
}