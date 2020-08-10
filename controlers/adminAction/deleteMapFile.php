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
    $filename = "../../mapfiles/".$_POST['filename'];

    if(!unlink($filename)) {
        echo json_encode(2);
    }
    $adminService = new adminService();

    if($adminService->deleteMapfile($fileid)) {
        echo json_encode(1);
    }
    else {
        echo json_encode(2);
    }
