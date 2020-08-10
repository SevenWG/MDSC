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
    $fileName = "../../mapfiles/".$_GET['filename'];
    if(!file_exists($fileName)) {
        echo "<script language='JavaScript'>alert('找不到文件!');self.location='../../views/admin/MapFileList.php'</script> ";
    }
    else {
        $downloadFile = fopen($fileName,"r");
        $downloadFileName = $_GET['filename'];

        header("Content-type: text/csv");
        header("Content-Disposition:attachment;filename = ".$downloadFileName);
        header('Content-Transfer-Encoding: binary');
        header("Accept-Ranges: bytes");
        /*
         * 注释了这一句之后就不会有多的html语句出现在csv文档中了 不知道为什么
         * */
        //header("Accept-length:".filesize($downloadFile));

        while(!feof($downloadFile)) {
            $line = fgets($downloadFile);
            echo $line;
        }
        fclose($downloadFile);
    }