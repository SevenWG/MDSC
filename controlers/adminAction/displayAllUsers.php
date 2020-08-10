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

    $data = $adminService->getAllUsers();

    echo json_encode($data);