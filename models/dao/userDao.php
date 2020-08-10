<?php
	/**
	*user DAO
	*/
	require_once __DIR__.'/../entity/user.php';
	require_once __DIR__.'/../../commons/dbConnect.php';

	class userDao{

		/*
		查看用户信息
		input:用户account
		return: user 对象
		*/
		public function findUserInfoByAccount($user_account){
			/*
			新建user对象
			*/
			$user = new user();

			/*
			新建数据库连接
			*/
			$dbCon = new dbConnect();
			$dbCon->initConnnect();
			$con = $dbCon->connect;


			$sql = "SELECT * FROM userinfo WHERE uaccount='".$user_account."';";
			$result = null;
			$result = mysqli_query($con, $sql);
  			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

  			/*
			将从数据库找到的user信息赋值给user对象
			由于写过set方法，private属性可以直接赋值
			*/

			$user->userid = $row['userid'];
  			$user->uaccount = $row['uaccount'];
  			$user->upwd = $row['upwd'];
  			$user->authority = $row['authority'];

  			/*
			关闭数据库连接
			*/
  			$dbCon->closeConnect();

  			/*
			将user对象返回给service类
			*/
  			return $user;

		}

        public function findUserInfoById($userid){
            /*
            新建user对象
            */
            $user = new user();

            /*
            新建数据库连接
            */
            $dbCon = new dbConnect();
            $dbCon->initConnnect();
            $con = $dbCon->connect;


            $sql = "SELECT * FROM userinfo WHERE userid='".$userid."';";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

            /*
          将从数据库找到的user信息赋值给user对象
          由于写过set方法，private属性可以直接赋值
          */

            $user->userid = $row['userid'];
            $user->uaccount = $row['uaccount'];
            $user->upwd = $row['upwd'];
            $user->authority = $row['authority'];

            /*
          关闭数据库连接
          */
            $dbCon->closeConnect();

            /*
          将user对象返回给service类
          */
            return $user;

        }

        public function findUserIdByAccount($uaccount){
            $dbCon = new dbConnect();
            $dbCon->initConnnect();
            $con = $dbCon->connect;

            $sql = "SELECT userid FROM userinfo WHERE uaccount='$uaccount';";

            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $userid = $row['userid'];

            $dbCon->closeConnect();

            return $userid;
        }

		public function findUserInfo($authority1){
	
			$dbCon = new dbConnect();
			$dbCon->initConnnect();
			$con = $dbCon->connect;

			$sql = "SELECT * FROM userinfo WHERE authority='$authority1';";
			$result = null;
			$result = mysqli_query($con, $sql);
			$arrayall =array();

  			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
  			{
/*  		    $user = new user();
				$user->userid = $row['userid'];
  				$user->uaccount = $row['uaccount'];
  				$user->upwd = $row['upwd'];
  				$user->authority = $row['authority'];*/

  				array_push($arrayall, $row);
			}
  			$dbCon->closeConnect();

  			return $arrayall;

		}


		/*
		添加用户
		input:user 对象
		return:是否添加成功
		*/
		public function addUser($user){
			$dbCon = new dbConnect();
			$dbCon->initConnnect();
			$con = $dbCon->connect;
			
			$sql = "INSERT INTO userinfo(
			        uaccount,
				 	upwd,
				 	authority) VALUES (
					'$user->uaccount',
					'$user->upwd',
					'$user->authority');";
			if (mysqli_query($con, $sql)){
				return true;
			}
			else{
				echo "error:".$sql."</br>".mysqli_error($con);
				return false;
			}
		}


		public function deleteUser($userid){
			$dbCon = new dbConnect();
			$dbCon->initConnnect();
			$con = $dbCon->connect;

			$sql = "DELETE FROM userinfo WHERE userid = '$userid';";

			if (mysqli_query($con, $sql)) {
				return true;
			}
			else{
				echo "error:".$sql."</br>".mysqli_error($con);
				return false;
			}

            $dbCon->closeConnect();
		}

		/*
		用于更新用户信息
		input: $user
		return:是否成功
		*/
		public function updateUserPassword($user)
		{
			$dbCon = new dbConnect();
			$dbCon->initConnnect();
			$con = $dbCon->connect;

			$sql="UPDATE userinfo SET
					upwd = '$user->upwd'
					WHERE use = '$user->userid';";


			if (mysqli_query($con, $sql)) 
			{
				return true;
			}
			else
			{
				echo "error:".$sql."</br>".mysqli_error($con);
				return false;
			}
            $dbCon->closeConnect();
		}

	}
?>