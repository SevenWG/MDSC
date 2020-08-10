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

require_once __DIR__.'/../entity/userfile1.php';
require_once __DIR__.'/../../commons/dbConnect.php';

class userfile1Dao
{
    public function findAllInfo() {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "SELECT * FROM userfile1 ;";

        $result = mysqli_query($con, $sql);
        $arrayall =array();

        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            array_push($arrayall,$row);
        }

        $dbCon->closeConnect();

        return $arrayall;
    }

    public function addUserFile($fileid,$userid){
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "INSERT INTO userfile1(fileid,userid) VALUES ('$fileid','$userid');";
        if (mysqli_query($con, $sql)){
            $dbCon->closeConnect();
            return true;
        }
        else{
            echo "error:".$sql."</br>".mysqli_error($con);
            $dbCon->closeConnect();
            return false;
        }

    }

    public function findInfoByUid($userid){
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "SELECT fileid FROM userfile1 WHERE userid='$userid';";

        $result = mysqli_query($con, $sql);
        $arrayall =array();

        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $fileid = $row['fileid'];

            array_push($arrayall,$fileid);
        }

        $dbCon->closeConnect();

        return $arrayall;
    }

    public function deleteSingleRowById($fileid){
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "DELETE FROM userfile1 WHERE fileid='".$fileid."';";
        if (mysqli_query($con, $sql)){
            $dbCon->closeConnect();
            return true;
        }else{
            echo "error:".$sql."</br>".mysqli_error($con);
            $dbCon->closeConnect();
            return false;
        }
    }

}