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

    $userid = $_SESSION['userid'];

    $fileid = $_POST['fileid'];

    $userService = new userService();

    if($userService->removeFromSDTMShareList($fileid, $userid)) {
        $data = 1;
        echo json_encode($data);
    }
    else {
        $data = 0;
        echo json_encode($data);
    }