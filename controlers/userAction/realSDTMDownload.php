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

    $uaccount = $_SESSION['uaccount'];
    $fileName = "../../files1/".$uaccount."/".$_GET['filename'];

    if(!file_exists($fileName)) {
        echo "<script language='JavaScript'>alert('找不到文件!');self.location='../../views/user/SDTMileList.php'</script> ";
    }
    else {
        $downloadFile = fopen($fileName,"r");
        $downloadFileName = $_GET['filename'];

        header("Content-type: application/octet-stream");
        header("Content-Disposition:attachment;filename = ".$downloadFileName);
        header("Accept-Ranges: bytes");

        while(!feof($downloadFile)) {
            $line = fgets($downloadFile);
            echo $line;
        }
        fclose($downloadFile);
    }