<?php
/**
 *
 *
 *
 * @see
 * @author weiwei<@weiwei>
 * @license proprietary
 * @copyright Copyright (c) duxze.com
 */
    require_once __DIR__.'/../../models/service/userService.php';

    $fileid = $_POST['fileid'];

    $userService = new userService();

    $tempFileArr = $userService->downloadFile($fileid);

    $tempFileName = $tempFileArr['filename'];

    $filePath = "D:/wamp/www/SevenWG/files/".$tempFileName;


/*
    $tempFile = fopen($filePath,"w") or die("!!!!");

    fwrite($tempFile,$tempFileArr['content']);
    fclose($tempFile);*/

/*    $downloadCdash = new downloadCdash();
    $downloadCdash->download();*/

    $downloadFileName = $tempFileName;
    $downloadFile = fopen($filePath,"r");

    header("Content-type: application/octet-stream");
    header("Content-Disposition:attachment;filename = ".$downloadFileName);
    header("Accept-Ranges: bytes");
    header("Accept-length:".filesize($downloadFile));
    readfile($downloadFile);


