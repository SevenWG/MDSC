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
    require_once __DIR__.'/../dao/fileDao.php';
    require_once __DIR__.'/../dao/file1Dao.php';
    require_once __DIR__.'/../entity/user.php';
    require_once __DIR__ . '/../dao/userDao.php';
    require_once __DIR__ . '/../dao/userfileDao.php';
    require_once __DIR__ . '/../dao/userfile1Dao.php';
    require_once __DIR__ . '/../dao/userfile2Dao.php';
    require_once __DIR__ . '/../dao/mapfileDao.php';

class adminService
{
    public function getAllUsers()
    {
        $userDao = new userDao();

        $userArray = $userDao->findUserInfo(0);

        return $userArray;
    }

    public function deleteSingleUser($userid)
    {
        $userDao = new userDao();

        $res = $userDao->deleteUser($userid);

        return $res;
    }

    public function getAllUserFile()
    {
        $userfileDao = new userfileDao();
        $userDao = new userDao();
        $fileDao = new fileDao();

        $array = $userfileDao->findAllInfo();

        $responseArray = array();

        for($i = 0; $i < count($array); $i++){
            $row = $array[$i];

            $user = $userDao->findUserInfoById($row['userid']);
            $file = $fileDao->findFileById($row['fileid']);

            $temp = array('uaccount' => $user->uaccount,
                'userid' => $user->userid,
                'fileid' =>$file->fileid,
                'filename' => $file->filename,
                'inputtime' => $file->inputtime
                );

            array_push($responseArray,$temp);
        }

        return $responseArray;
    }

    public function deleteSingleFile($fileid)
    {
        $fileDao = new fileDao();
        $userfileDao = new userfileDao();
        $userfile2Dao = new userfile2Dao();

        $fileDao->deleteFileById($fileid);
        $userfileDao->deleteSingleRowById($fileid);

        if($userfile2Dao->findFileByFileid($fileid)) {
            $userfile2Dao->deleteSingleRowByFileId($fileid);
        }

        return true;
    }

    public function getAllSdtmFile()
    {
        $userfile1Dao = new userfile1Dao();
        $userDao = new userDao();
        $file1Dao = new file1Dao();

        $array = $userfile1Dao->findAllInfo();

        $responseArray = array();

        for($i = 0; $i < count($array); $i++){
            $row = $array[$i];

            $user = $userDao->findUserInfoById($row['userid']);
            $file = $file1Dao->findFileById($row['fileid']);

            $temp = array('uaccount' => $user->uaccount,
                'userid' => $user->userid,
                'fileid' =>$file->fileid,
                'filename' => $file->filename,
                'inputtime' => $file->inputtime
            );

            array_push($responseArray,$temp);
        }

        return $responseArray;
    }

    public function deleteSingleSdtmFile($fileid)
    {
        $file1Dao = new file1Dao();
        $userfile1Dao = new userfile1Dao();
        $userfile3Dao = new userfile3Dao();

        $file1Dao->deleteFileById($fileid);
        $userfile1Dao->deleteSingleRowById($fileid);

        if($userfile3Dao->findFileByFileid($fileid)) {
            $userfile3Dao->deleteSingleRowByFileId($fileid);
        }

        return true;
    }

    public function getAllMapFile()
    {
        $mapfileDao = new mapfileDao();

        return $mapfileDao->getAllMapFile();
    }

    public function addMapfileOrUpdate($filename)
    {
        $mapfileDao = new mapfileDao();

        if(!$mapfileDao->findMapFileByName($filename)) {
            $inputtime = date("Y-m-d h:i:sa");
            if($mapfileDao->addMapFile($filename, $inputtime) != false) {
                return true;
            }
            else return false;
        }
        else {
            $inputtime = date("Y-m-d h:i:sa");
            return $mapfileDao->UpdateMapFileByName($filename, $inputtime);
        }


    }

    public function deleteMapfile($fileid)
    {
        $mapfileDao = new mapfileDao();

        return $mapfileDao->deleteMapFileById($fileid);
    }
}