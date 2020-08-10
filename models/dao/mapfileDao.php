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
require_once __DIR__.'/../entity/mapfile.php';
require_once __DIR__.'/../../commons/dbConnect.php';

class mapfileDao
{

    public function addMapFile($filename, $inputtime)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "INSERT INTO mapfile(filename,inputtime) VALUES ('$filename','$inputtime');";

        if (mysqli_query($con, $sql)){
            return true;
        }
        else{
            echo "error:".$sql."</br>".mysqli_error($con);
            $dbCon->closeConnect();
            return false;
        }
    }

    public function getAllMapFile()
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "SELECT * FROM mapfile";

        $result = mysqli_query($con, $sql);
        $arrayAll =array();

        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            array_push($arrayAll,$row);
        }

        $dbCon->closeConnect();

        return $arrayAll;
    }

    public function findMapFileByName($filename)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "SELECT * FROM mapfile WHERE filename='".$filename."';";

        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        if($row == false || $row == NULL) {
            return false;
        }

        $mapfile = new mapfile();
        $mapfile->fileid = $row['fileid'];
        $mapfile->inputtime = $row['inputtime'];
        $mapfile->filename = $row['filename'];

        $dbCon->closeConnect();
        return $mapfile;
    }

    public function deleteMapFileById($fileid)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "DELETE FROM mapfile WHERE fileid='" . $fileid . "';";
        if (mysqli_query($con, $sql)) {
            $dbCon->closeConnect();
            return true;
        } else {
            echo "error:" . $sql . "</br>" . mysqli_error($con);
            $dbCon->closeConnect();
            return false;
        }
    }

    public function UpdateMapFileByName($filename,$inputtime)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "UPDATE  mapfile SET inputtime = '" . $inputtime . "' WHERE filename='" . $filename . "';";
        if (mysqli_query($con, $sql)) {
            $dbCon->closeConnect();
            return true;
        } else {
            echo "error:" . $sql . "</br>" . mysqli_error($con);
            $dbCon->closeConnect();
            return false;
        }
    }

}