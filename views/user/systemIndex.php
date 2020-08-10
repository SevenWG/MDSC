<!-- 成绩查询主页面 -->
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>医疗数据标准转换系统</title>
    <link rel="stylesheet" href="../../assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" type="text/css">
  </head>
  <body>
<?php
  require 'header.php';
?>

<div>
    <div class="container-fluid" style="padding: 0px 200px;">
        <form id="form" action="../../controlers/userAction/upLoadFileAction.php" method="post" enctype="multipart/form-data">
            <div class="row form-group">
                <div class="panel panel-primary">
                    <div class="panel-heading" align="center">
                        <label style="text-align: center;font-size: 18px;">医疗数据标准转换系统</label>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12">
                            <input id="input-id" name="file" multiple type="file" data-show-caption="true">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/systemindex.js"></script>
    <script src="../../assets/js/fileinput.js"></script>
    <script src="../../assets/js/fileinput_locale_zh.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../assets/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
