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
require_once __DIR__ . '/../../models/service/adminService.php';

    $allowedExts = array("csv","txt");
    $temp = explode(".", $_FILES["file"]["name"]);

    echo $_FILES["file"]["size"];
    $extension = end($temp);     // 获取文件后缀名

    if (in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "错误：: " . $_FILES["file"]["error"] . "<br>";
        }

        else
        {
            echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
            echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
            echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";

            $tmp_name = $_FILES["file"]["tmp_name"];
            $size = $_FILES["file"]["size"];

            $fp = fopen($tmp_name,'r');
            $content = file_get_contents($tmp_name);

            $path = "../../mapfiles/".$_FILES["file"]["name"];
            $file = fopen($path,"w") or die("!!!");
            fwrite($file,$content);
            fclose($file);

            $filename = $_FILES["file"]["name"];

            $adminService = new adminService();
            $adminService->addMapfileOrUpdate($filename);

/*            echo "<script language='JavaScript'>
                            alert('上传映射表成功!'); 
                            self.location='../../views/admin/adminIndex.php'; 
                          </script> ";*/
        }
    }
    else
    {
        echo "非法的文件格式";
    }
