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

    session_start();
    $_SESSION['mapfileid'] = $_POST['fileid'];
    $_SESSION['mapfilename'] = $_POST['filename'];

    if($_SESSION['mapfileid'] != NULL && $_SESSION['mapfilename'] != NULL) {
        echo json_encode(1);
    }
    else {
        echo json_encode(0);
    }
