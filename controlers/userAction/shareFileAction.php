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

    $userid = $_SESSION['userid'];

    $userService = new userService();

    if($userService->shareFile($userid, $fileid)) {
        $data = 1;
        echo json_encode($data);
    }
    else {
        $data = 0;
        echo json_encode($data);
    }