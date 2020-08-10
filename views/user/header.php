<!-- 会员端顶部导航栏
不同页面通用 -->

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="systemIndex.php">
        <span class="glyphicon glyphicon-home" aria-hidden="true">医疗数据标准转换系统</span>
      </a>
    </div>

    <!--     
      根据用户状态（游客或会员）
      显示不同导航栏 
    -->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
		<!-- <li><a href="roomList.php">房间信息查询</a></li> -->
		<?php 
			session_start();
			if (isset($_SESSION['uaccount']))
			{
		 ?>
		<!-- <li id="showRoom"><a href="">房间预订</a></li> -->
		<li><a href="CDASHFileList.php">CDASH数据文件列表</a></li>
          <li><a href="SDTMFileList.php">SDTM数据文件列表</a></li>
          <li><a href="shareCDASHFileList.php">共享CDASH文件列表</a></li>
          <li><a href="shareSDTMFileList.php">共享SDTM文件列表</a></li>
      </ul>
      <!-- <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
      </form> -->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="myShareCDASHList.php">个人CDASH文件分享列表</a></li>
          <li><a href="myShareSDTMList.php">个人SDTM文件分享列表</a></li>
        <li><a href="../../controlers/userAction/userLogoffAction.php">注销</a></li>
        <li><a><?php echo "欢迎您! ".$_SESSION['uaccount']; ?></a></li>
      </ul>
      <?php } else{?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="userLogin.php">登录</a></li>
      </ul>
      <?php } ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- <div id="change"></div> -->
