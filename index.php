<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
if(!session_id()) session_start();	//初始化会话数据
include_once 'inc/B_connadmin.php';//连上注册数据库

include ("ismobile.php");//判断是否为手机
 //ob_start();      	//打开缓冲区


$cuow=$username=$SYS_PassWord='';
//===========================================================================================公司号的获得START
$hy=9007;
if(isset($_REQUEST['hy'])){//当有设定企业码时执行
	$_SESSION[ "hy" ] = $_REQUEST['hy'];                                          //公司号   9007
}else{
	$_SESSION[ "hy" ] = $hy;
}
$hy=$_SESSION[ "hy" ];

//===========================================================================================查询到公司信息

$query =  "select id,gongsimingceng,data_use From `msc_huiyuan_reg` where reg_num = ? ";
$params = array($hy);
$queryResult = $db->query($query, $params);
$result = mysqli_fetch_assoc($queryResult['result']);

$gongsimingceng = $result[ "gongsimingceng" ];      	//公司名
$data_use = $result[ "data_use" ];                  	//使用数据库

$_SESSION[ "data_use" ]=$data_use;              	//数据库存储

//===========================================================================================其它信息
if(isset($_COOKIE["username"])){
	$username=$_COOKIE["username"];
}
if(isset($_COOKIE["SYS_PassWord"])){
	$SYS_PassWord=$_COOKIE["SYS_PassWord"];
}

//echo $hy;
//这里得到错误有情登录次数
if(isset($_SESSION["cuow"])){
$cuow=intval($_SESSION["cuow"]);
}else{
$cuow=0;
}

?>

<head>


<title>阳光质造管理系统  欢迎您！</title>
<link href="style/style_login.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body class="loginback">

<form action="index_save.php?action=login&nowtype=pc" method="post" name="form1" id="form1">
<div class="cong">
<div class="divcss5"><img src="images/logo-sqp.png" class="logo" /><br /><b>User Login For SQP-AMS</b></div>

<ul class="boxshadow"><li class="lione">手机号 / Mobile</li><li><input name="username"  tabindex="2" id="username" value="<?php echo $username?>" title="Mobile"  onblur="passthis(this);if(this.value==''){this.value='Mobile';this.style.color='';}"  onfocus="this.style.backgroundColor='#FFF';if(this.value=='Mobile'){this.value=''}" onmouseover="this.style.backgroundColor='#999';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" onkeydown="passthis(this);RegExpression_s(this,6);this.style.color='#000';" maxlength="11" /><div class="rightdiv"></div></li></ul>

<ul class="boxshadow"><li class="lione">密码 / Password</li><li><input name="SYS_PassWord" type="password" id="SYS_PassWord" value="<?php echo $SYS_PassWord?>"  onblur="passthis(this);this.style.color='';" onfocus="this.style.backgroundColor='#FFF'" onmouseover="this.style.backgroundColor='#999';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF'" tabindex="3" onkeydown="passthis(this);RegExpression_s(this,2);this.style.color='#000';" maxlength="30"/><div class="rightdiv"></div></li></ul>
<?php
      if($cuow>=4){
?>
<ul class="boxshadow"><li class="lione">验证码 / code</li><li style="width:70px;"><span id="code" class="nocode">验证码</span><input name="Y_codeinput" id="Y_codeinput" value="" type="hidden"/></li><li style="width:202px;"><input name="codeinput" id="codeinput" value="" onblur="this.style.color='';"  onfocus="this.style.backgroundColor='#FFF'" onmouseover="this.style.backgroundColor='#999'" onmouseout="this.style.backgroundColor='#FFF'" tabindex="4" onkeydown="RegExpression_s(this,2);this.style.color='#000';" style="width:242px;" /><div id="CodeDiv" class="rightdiv" tit=""></div></li></ul>
<?php
	  }
?>
<ul class="ullogin boxshadow"><input name="Submit" type="submit" tabindex="5"  title="可按Enter键提交！" onmouseover="this.style.backgroundColor='#666';this.style.color='#000';" onmouseout="this.style.backgroundColor=''" onchange="form1.submit()" src="images/f_bg_h.gif" value="Enter" alt="ENTER"/></ul>
</div>
</form>
<div class='copyright'>Copy Right (C) <?php echo $gongsimingceng; ?></div>

<div class='set_right_bottom'><a href="#"><ul><img src='images/help_24.png' /></br>关于.about</ul></a><a href="m/M_reg.php"><ul><img src='images/reg.png' /></br>注册.Reg</ul></a><a href="m/index.php"><ul><img src='images/mobile.png' /></br>手机版.Mobile</ul></a></div>

</body>
</html>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/B_code.js"></script>
<script type="text/javascript" src="js/B_login_fnction.js"></script>
