<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>医疗数据标准转换系统-管理员端</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../../assets/css/bootstrap-datetimepicker.min.css" type="text/css">
</head>
<body>
<?php
require 'header.php';
?>
<div class="container" style="font-family:Microsoft YaHei;">
    <div class="table-responsive" style="padding: 50px 0px;">
        <table class="table">
            <caption><h2 align="center">映射表详情页</h2></caption>
            <thead>
            <tr>
                <th>域名</th>
                <th>ODM_ID</th>
                <th>CDASH变量</th>
                <th>SDTM变量</th>
            </tr>
            </thead>
            <tbody id = "J_TbData">

            </tbody>
        </table>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../../assets/js/jquery.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="../../assets/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="../../assets/js/MapCheck.js"></script>
</body>
</html>
