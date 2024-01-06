<?php
 if(!session_id()) session_start();	//初始化会话数据
 $cuow=$username=$SYS_PassWord='';
 if(isset($_COOKIE["username"])){
	 $username=$_COOKIE["username"];
 }
 if(isset($_COOKIE["SYS_PassWord"])){
	 $SYS_PassWord=$_COOKIE["SYS_PassWord"];
 }
 //这里得到错误有情登录次数
 if(isset($_SESSION["cuow"])){
   $cuow=intval($_SESSION["cuow"]);
 }else{
   $cuow=0;
 };
?>
<!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>

	<title>SQP Certificate Mobile</title>
	<link href="Machine_MobileV1.0/theme/style.css" rel="stylesheet" type="text/css"/>
	
</head>

<body>
	<div id="wrapper">
		
		<div id="header">
        <!--
			<em class="logo"><img src="../../images/logo-sqp.png"></em>
            !-->
			<em class="eleft">&nbsp;&nbsp;♛ SQP LOGIN</em>
			<a href="#" class="siteMap"></a>
		</div>
		<div class="headpadd"></div>
		<div id="index">
			
<!--
			<div id="mainNav" class="top_bottom_line">
				<ul>
            		<li><a href="product.php">我们的服务</a></li>
		

                 <li><a href='#'>000</a></li>
				</ul>
			</div>
       
  
      !-->   
            <div  class="incBox_login">
            <form action="../index_save.php?action=login" method="post" name="form1" id="form1">
				<div class="LoginBox">
					<div class="divcss5"><img src="../../images/logo-sqp.png" class="logo" /><br /><b>User Login For SQP</b></div>
					
                    <ul class="boxshadow" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" ><li class="lione">手机.Mob</li><li class="lioneright"><input name="username"  tabindex="2" id="username" value="<?php echo $username?>" title="Mobile"  onblur="passthis(this);if(this.value==''){this.value='Mobile';}"  onfocus="if(this.value=='Mobile'){this.value=''}" onkeydown="passthis(this);RegExpression_s(this,6);this.style.color='#000';" maxlength="11"/></li><div class="rightdiv"></div></ul>

                    <ul class="boxshadow" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" ><li class="lione">密码 .PW</li><li class="lioneright"><input name="SYS_PassWord" type="password" id="SYS_PassWord" value="<?php echo $SYS_PassWord?>"  onblur="passthis(this);this.style.color='';"  tabindex="3" onkeydown="passthis(this);RegExpression_s(this,2);this.style.color='#000';" maxlength="30"/></li><div class="rightdiv"></div></ul>
      <?php
      if($cuow>=4){
      ?>
                    <ul class="boxshadow" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" ><li class="lione">验证码.code</li><li  class="lioneright" style="width:20%;"><span id="code" class="nocode">验证码</span><input name="Y_codeinput" id="Y_codeinput" value="" type="hidden"/></li><li  class="lioneright" style="width:60%;"><input name="codeinput" id="codeinput" value="" onblur="this.style.color='';"  onfocus="this.style.backgroundColor='#FFF'" tabindex="4" onkeydown="RegExpression_s(this,2);this.style.color='#000';" style="width:242px;" /></li><div id="CodeDiv" class="rightdiv" tit=""></div></ul>
      <?php
	     }
      ?>
                    <ul class="ullogin" ><input name="Submit" type="submit" class="boxshadow" tabindex="5" title="可按Enter键提交！"   onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#999';" onchange="form1.submit()" src="images/f_bg_h.gif"  value="Enter" alt="ENTER"/></ul>
                    
				</div>
            </form>
            </div> 
			
			
			
			<!--!-->
			<div id="catalog">
            <ul>
	          <li><a href="M_reg.php">注册.Reg</a></li>
	          <li><a href="Machine_MobileV1.0/M_about.php">关于.About SQP</a></li> 
            </ul>
 </div>
			
		</div>
		<?php include_once( 'M_reg_foot.php' );?>
	</div>
</body>

</html>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../js/B_code.js"></script>
<script type="text/javascript" src="../js/B_login_fnction.js"></script>


