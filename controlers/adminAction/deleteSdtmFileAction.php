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
    require_once __DIR__.'/../../models/service/adminService.php';

    $fileid = $_POST['fileid'];

    $adminService = new adminService();

    if($adminService->deleteSingleSdtmFile($fileid)){
        $data = 1;
        echo json_encode($data);
    }
    else{
        $data = 0;
        echo json_encode($data);
    }