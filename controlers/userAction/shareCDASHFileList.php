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

    $userService = new userService();

    $data = $userService->findAllShareFile();

    echo json_encode($data);