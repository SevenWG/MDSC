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

require_once __DIR__.'/../entity/file1.php';
require_once __DIR__.'/../../commons/dbConnect.php';
class file1Dao
{
    public function addFile($file)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "INSERT INTO file1(content,inputtime,filename) VALUES ('$file->content','$file->inputtime','$file->filename');";
        if (mysqli_query($con, $sql)){
            $fileid = $this->findFileId($file->filename);
            $dbCon->closeConnect();
            return $fileid;
        }
        else{
            echo "error:".$sql."</br>".mysqli_error($con);
            $dbCon->closeConnect();
            return false;
        }
    }

    public function findFileId($filename)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "SELECT * FROM file1 WHERE filename='".$filename."';";
        $result = null;
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        $fileid = $row['fileid'];
        $dbCon->closeConnect();
        return $fileid;
    }

    public function findFileById($fileid)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "SELECT * FROM file1 WHERE fileid='".$fileid."';";

        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $file = new file();

        $file->fileid = $row['fileid'];
        $file->content = $row['content'];
        $file->inputtime = $row['inputtime'];
        $file->filename = $row['filename'];

        $dbCon->closeConnect();
        return $file;
    }

    public function deleteFileById($fileid)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "DELETE FROM file1 WHERE fileid='".$fileid."';";
        if (mysqli_query($con, $sql)) {
            $dbCon->closeConnect();
            return true;
        } else {
            echo "error:" . $sql . "</br>" . mysqli_error($con);
            $dbCon->closeConnect();
            return false;
        }
    }

    public function getSingleFile($fileid)
    {
        $dbCon = new dbConnect();
        $dbCon->initConnnect();
        $con = $dbCon->connect;

        $sql = "SELECT * FROM file1 WHERE fileid ='".$fileid."';";

        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        return $row;
    }

}