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

    $adminService = new adminService();

    $userid = $_POST['userid'];

    if($adminService->deleteSingleUser($userid)){
        $data = 1;
        echo json_encode($data);
    }else{
        $data = 0;
        echo json_encode($data);
    }