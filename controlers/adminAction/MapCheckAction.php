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
    $fileName = "../../mapfiles/".$_SESSION['mapfilename'];
    $dataArr = array();
    if(!file_exists($fileName)) {
        echo "<script language='JavaScript'>alert('找不到文件!');self.location='../../views/admin/MapFileList.php'</script> ";
    }
    else {
        $mapFile = fopen($fileName,"r");

        while(!feof($mapFile)) {
            $tempArr = fgetcsv($mapFile);
            $newArr = array('domain'=> $tempArr[0], 'odmId' => $tempArr[1], 'cdashVar' => $tempArr[2], 'sdtmVar' => $tempArr[3]);
            array_push($dataArr, $newArr);
/*            unset($_SESSION['mapfilename']);
            unset($_SESSION['mapfileid']);*/
        }
        echo json_encode($dataArr);
    }