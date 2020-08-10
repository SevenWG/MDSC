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

    session_start();

    $fileid = $_POST['fileid'];
    $filename = $_POST['filename'];
    $uaccount = $_SESSION['uaccount'];
    $file = "../../files1/".$uaccount."/".$filename;


    if(!unlink($file)) {
        echo json_encode(0);
    }

    $userService = new userService();

    if($userService->deleteSdtmFile($fileid)) {
        $data = 1;
        echo json_encode($data);
    }
    else {
        $data = 0;
        echo json_encode($data);
    }