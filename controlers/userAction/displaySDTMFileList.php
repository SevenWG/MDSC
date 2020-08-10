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

    $userService = new userService();

    $fileInfoArray = $userService->findAllSdtmFlieByUid($userid);

    echo json_encode($fileInfoArray);