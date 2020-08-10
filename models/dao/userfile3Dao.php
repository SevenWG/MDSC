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

require_once __DIR__.'/../entity/userfile3.php';
require_once __DIR__.'/../../commons/dbConnect.php';

class userfile3Dao
{
    public function findAllInfo()
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "SELECT * FROM userfile3 ;";

        $result = mysqli_query($con, $sql);
        $arrayall =array();


        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $userfile3 = new userfile2();
            $userfile3->fileid = $row['fileid'];
            $userfile3->userid = $row['userid'];
            array_push($arrayall,$userfile3);
        }

        $dbCon->closeConnect();

        return $arrayall;
    }

    public function addUserFile($fileid,$userid)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "INSERT INTO userfile3(fileid,userid) VALUES ('$fileid','$userid');";
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

    public function findInfoByUid($userid)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "SELECT fileid FROM userfile3 WHERE userid='$userid';";

        $result = mysqli_query($con, $sql);
        $arrayall =array();

        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $fileid = $row['fileid'];

            array_push($arrayall,$fileid);
        }

        $dbCon->closeConnect();

        return $arrayall;
    }

    public function findFileByFileid($fileid)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "SELECT * FROM userfile3 WHERE fileid='$fileid';";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        $dbCon->closeConnect();

        return $row;
    }

    public function deleteSingleRowById($fileid, $userid)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "DELETE FROM userfile3 WHERE fileid='".$fileid."' AND userid = '$userid';";
        if (mysqli_query($con, $sql)){
            $dbCon->closeConnect();
            return true;
        }else{
            echo "error:".$sql."</br>".mysqli_error($con);
            $dbCon->closeConnect();
            return false;
        }
    }

    public function deleteSingleRowByFileId($fileid)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "DELETE FROM userfile3 WHERE fileid='".$fileid."';";
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