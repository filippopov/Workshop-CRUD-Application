<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 16:47
 */

namespace Service\Upload;


class UploadService implements UploadServiceInterface
{

    public function upload($fileInfo, $destination): string
    {
        $fileName = $destination . '/' . uniqid() . '_' . $fileInfo['name'];

        $result = move_uploaded_file($fileInfo['tmp_name'], $fileName);

        $fileName = dirname($_SERVER['PHP_SELF']) . '/' . $fileName;

        if ($result == false) {
            throw new \Exception('Upload failed');
        }

        return $fileName;
    }
}