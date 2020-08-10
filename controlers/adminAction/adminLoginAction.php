<!-- 用户登录Action -->
<?php
require_once __DIR__.'/../../models/entity/user.php';
require_once __DIR__.'/../../models/service/userService.php';
session_start();
$user_account = "";
$user_password = "";
if (isset($_POST["c_submit"]))
{
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $uaccount = test_input($_POST["uaccount"]);
        $upwd = test_input($_POST["upwd"]);

        $userService = new userService();
        $user = new user();

        $user->uaccount = $uaccount;
        $user->upwd = $upwd;

        $loginStatus = $userService->adminLogin($user);

        /*将userLogin函数返回的值进行判断，并显示具体内容*/
        if($loginStatus === 0||$loginStatus === 1)
        {
            echo "<script language='JavaScript'> 
						alert('账号或密码错误'); 
						self.location='../../adminLogin.php';
					  </script> ";
        }
        else if($loginStatus === 2)
        {
            echo "<script language='JavaScript'> 
						alert('权限错误!'); 
						self.location='../../adminLogin.php'; 
					  </script> ";
        }
        else
        {
            $_SESSION['uaccount'] = $user->uaccount;
            $_SESSION['authority'] = $user->authority;
            echo "<script language='JavaScript'> 
						alert('登录成功!'); 
						self.location='../../views/admin/adminIndex.php'; 
					  </script> ";
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