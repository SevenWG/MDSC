<?php 
	require_once __DIR__ . '/../dao/userDao.php';
    require_once __DIR__.'/../dao/fileDao.php';
    require_once __DIR__ . '/../dao/userfileDao.php';
    require_once __DIR__.'/../entity/user.php';
    require_once __DIR__.'/../entity/file.php';
    require_once __DIR__.'/../dao/file1Dao.php';
    require_once __DIR__.'/../dao/userfile1Dao.php';
    require_once __DIR__.'/../dao/userfile2Dao.php';
    require_once __DIR__.'/../dao/userfile3Dao.php';

	/**
	* services for user
	*/
	class userService{
		
		public function userRegister($user)
        {
			$userDao = new userDao();
			$userdb = new user();
			$userdb = $userDao->findUserInfoByAccount($user->uaccount);

			if($userdb->userid==null){
				$userDao->addUser($user);
				return true;
			}
			else {
				echo "error:the useraccount already exist";
				return false;
			}
		}

        public function getUserId($uaccount)
        {

            $userDao = new userDao();
            $userid = $userDao->findUserIdByAccount($uaccount);

            if($userid==null){
                echo "error:the account does not exist";
                return 0;
            }
            else{
                return $userid;
            }
        }

		/*
		*会员，管理员，超级管理员登陆   
		*input：user实体
		*return：账户不存在：0 密码错误：1 权限错误：2 登陆成功：3
		*/
		public function userLogin($user)
        {

			/*传入的user:scanSingleUser函数返回的user变量；
			userdb：userDao类中findUserInfoByAccount函数返回的user变量*/

			$userDao = new userDao();
			$userdb = new user();
			$userdb = $userDao->findUserInfoByAccount($user->uaccount);

			if($userdb->userid==null){
				echo "error:the account does not exist";
				return 0;
			}
			else if($userdb->upwd!=$user->upwd){
				echo "Password error";
				return 1;
			}
			else{
				echo "success";
				return 3;
			}
		}

        public function adminLogin($user)
        {

            /*传入的user:scanSingleUser函数返回的user变量；
            userdb：userDao类中findUserInfoByAccount函数返回的user变量*/

            $userDao = new userDao();
            $userdb = new user();
            $userdb = $userDao->findUserInfoByAccount($user->uaccount);

            if($userdb->userid==null){
                echo "error:the account does not exist";
                return 0;
            }
            else if($userdb->upwd!=$user->upwd){
                echo "Password error";
                return 1;
            }
            else if($userdb->authority!=1){
                echo "Authority error";
                return 2;
            }

            else{
                echo "success";
                return 3;
            }
        }

        public function uploadFile($content,$filename,$userid)
        {
            $fileDao = new fileDao();
            $file = new file();
            $userfileDao = new userfileDao();

            $file->content = $content;
            $file->filename = $filename;
            $file->inputtime = date("Y-m-d h:i:sa");

            $fileid = $fileDao->addFile($file);

            $userfileDao->addUserFile($fileid,$userid);

        }

        public function uploadSdtmFile($content,$filename,$userid)
        {
            $file1Dao = new file1Dao();
            $file1 = new file1();
            $userfile1Dao = new userfile1Dao();

            $file1->content = $content;
            $file1->filename = $filename;
            $file1->inputtime = date("Y-m-d h:i:sa");

            $fileid = $file1Dao->addFile($file1);

            $userfile1Dao->addUserFile($fileid,$userid);

        }

        public function shareFile($userid, $fileid)
        {
            $userfile2Dao = new userfile2Dao();

            $result = $userfile2Dao->addUserFile($fileid, $userid);

            return $result;
        }

        public function shareSdtmFile($userid, $fileid)
        {
            $userfile3Dao = new userfile3Dao();

            $result = $userfile3Dao->addUserFile($fileid, $userid);

            return $result;
        }

        public function findAllFlieByUid($userid)
        {
		    $userfileDao = new userfileDao();
		    $fileDao = new fileDao();

		    $fileIdArray = $userfileDao->findInfoByUid($userid);

		    $fileInfoArray = array();
		    for($i = 0; $i < count($fileIdArray); $i++){
		        $file = $fileDao->findFileById($fileIdArray[$i]);

		        $temp = array('fileid' => $file->fileid, 'filename' => $file->filename, 'inputtime' => $file->inputtime);

		        array_push($fileInfoArray,$temp);
            }

            return $fileInfoArray;
        }

        public function findAllShareFile()
        {
            $userfile2Dao = new userfile2Dao();
            $fileDao = new fileDao();
            $userDao = new userDao();

            $userFileArray = $userfile2Dao->findAllInfo();

            $userfileInfoArray = array();

            for($i = 0; $i < count($userFileArray); $i++){
                $file = $fileDao->findFileById($userFileArray[$i]->fileid);
                $user = $userDao->findUserInfoById($userFileArray[$i]->userid);

                $temp = array('fileid' => $file->fileid, 'filename' => $file->filename,
                    'inputtime' => $file->inputtime, 'uaccount' => $user->uaccount);

                array_push($userfileInfoArray,$temp);
            }

            return $userfileInfoArray;
        }

        public function findAllShareFileById($userid) {
            $userfile2Dao = new userfile2Dao();
            $fileDao = new fileDao();

            $fileIdArray = $userfile2Dao->findInfoByUid($userid);
            $fileInfoArray = array();

            for($i = 0; $i < count($fileIdArray); $i++) {
                $file = $fileDao->findFileById($fileIdArray[$i]);

                $temp = array('fileid' => $file->fileid, 'filename' => $file->filename,
                    'inputtime' => $file->inputtime);

                array_push($fileInfoArray, $temp);
            }
            return $fileInfoArray;
        }

        public function removeFromShareList($fileid, $userid) {
            $userfile2Dao = new userfile2Dao();

            $result = $userfile2Dao->deleteSingleRowById($fileid, $userid);

            return $result;
        }

        public function findAllShareSdtmFile()
        {
            $userfile3Dao = new userfile3Dao();
            $file1Dao = new file1Dao();
            $userDao = new userDao();

            $userFileArray = $userfile3Dao->findAllInfo();

            $userfileInfoArray = array();

            for($i = 0; $i < count($userFileArray); $i++){
                $file = $file1Dao->findFileById($userFileArray[$i]->fileid);
                $user = $userDao->findUserInfoById($userFileArray[$i]->userid);

                $temp = array('fileid' => $file->fileid, 'filename' => $file->filename,
                    'inputtime' => $file->inputtime, 'uaccount' => $user->uaccount);

                array_push($userfileInfoArray,$temp);
            }

            return $userfileInfoArray;
        }

        public function findAllShareSDTMFileById($userid) {
            $userfile3Dao = new userfile3Dao();
            $file1Dao = new file1Dao();

            $fileIdArray = $userfile3Dao->findInfoByUid($userid);
            $fileInfoArray = array();

            for($i = 0; $i < count($fileIdArray); $i++) {
                $file = $file1Dao->findFileById($fileIdArray[$i]);

                $temp = array('fileid' => $file->fileid, 'filename' => $file->filename,
                    'inputtime' => $file->inputtime);

                array_push($fileInfoArray, $temp);
            }
            return $fileInfoArray;
        }

        public function removeFromSDTMShareList($fileid, $userid) {
            $userfile3Dao = new userfile3Dao();

            $result = $userfile3Dao->deleteSingleRowById($fileid, $userid);

            return $result;
        }

        public function findAllSdtmFlieByUid($userid){
            $userfile1Dao = new userfile1Dao();
            $file1Dao = new file1Dao();

            $fileIdArray = $userfile1Dao->findInfoByUid($userid);

            $fileInfoArray = array();
            for($i = 0; $i < count($fileIdArray); $i++){
                $file = $file1Dao->findFileById($fileIdArray[$i]);

                $temp = array('fileid' => $file->fileid, 'filename' => $file->filename, 'inputtime' => $file->inputtime);

                array_push($fileInfoArray,$temp);
            }

            return $fileInfoArray;
        }

        public function deleteFile($fileid){
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

        public function deleteSdtmFile($fileid){
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

        public function downloadFile($fileid){
		    $fileDao = new fileDao();

		    $fileArr = $fileDao->getSingleFile($fileid);

		    return $fileArr;
        }

        public function downloadSdtmFile($fileid){
            $file1Dao = new file1Dao();

            $fileArr = $file1Dao->getSingleFile($fileid);

            return $fileArr;
        }

        public function RealSaveFunction($sdtmStr, $newDataTable, $nonMapTitleStr, $deleteDataTable, $domainName)
        {
            $uaccount = $_SESSION['uaccount'];
            $userid = $_SESSION['userid'];
            $time = date("Y-m-d-h-i-s");

            $op = "\r\n";
            $fileName = $uaccount."-".$time."-"."SDTM-".$domainName."(Submit Verison).csv";
            $path = "../../files1/".$uaccount;
            if(!file_exists($path)) {
                mkdir($path);
            }
            $path = "../../files1/".$uaccount."/".$fileName;
            $file = fopen($path, "w");
            fwrite($file, $sdtmStr);
            fwrite($file, $op);
            foreach ($newDataTable as $item) {
                fwrite($file, $item);
                fwrite($file, $op);
            }
            $newFile = fopen($path,"r");
            $content = file_get_contents($path);
            $this->uploadSdtmFile($content,$fileName,$userid);


            $op = "\r\n";
            $fileName = $uaccount."-".$time."-"."SDTM-".$domainName."(with deleted data).csv";
            $path = "../../files1/".$uaccount;
            if(!file_exists($path)) {
                mkdir($path);
            }
            $path = "../../files1/".$uaccount."/".$fileName;
            $file = fopen($path, "w");
            fwrite($file, $sdtmStr);
            fwrite($file, $op);
            foreach ($newDataTable as $item) {
                fwrite($file, $item);
                fwrite($file, $op);
            }
            fwrite($file,"Deleted Data:");
            fwrite($file, $op);
            fwrite($file, $nonMapTitleStr);
            fwrite($file, $op);
            foreach ($deleteDataTable as $i) {
                fwrite($file, $i);
                fwrite($file, $op);
            }
            $newFile = fopen($path,"r");
            $content = file_get_contents($path);
            $this->uploadSdtmFile($content,$fileName,$userid);
        }

	}
 ?>