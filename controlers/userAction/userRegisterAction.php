<?php 
	require_once __DIR__.'/../../models/entity/user.php';
	require_once __DIR__.'/../../models/service/userService.php';
	session_start();

	if (isset($_POST["rsubmit"])) 
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{

			$uaccount = test_input($_POST["raccount"]);
			$upwd = test_input($_POST["rpwd"]);
			$rupwd = test_input($_POST["rrpwd"]);

			if($upwd != $rupwd) {
				echo "<script language='JavaScript'> 
      			alert('两次输入密码不一致！'); 
				self.location='../../views/user/userRegister.php'; </script> ";
			}
			else{

				$userService = new userService();
				$user = new user();

				$user->uaccount = $uaccount;
				$user->upwd = $upwd;
				$user->authority = 0;

				$result = $userService->userRegister($user);
				if($result == true){
					echo "<script language='JavaScript'> 
      				alert('注册成功！');  
					self.location='../../index.php'; </script> ";
				}else{
					echo "<script language='JavaScript'> 
      				alert('用户已存在！'); 
					self.location='../../index.php'; </script> ";
				}
			}

			
		}
	}

	function test_input($data) 
	{
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
 ?>