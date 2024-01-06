<!DOCTYPE HTML>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>
	<link rel="apple-touch-icon-precomposed" href="Machine_MobileV1.0/data/logo-icon.png">
	<title>SQP Certificate Mobile</title>
	<link href="Machine_MobileV1.0/theme/style.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="Machine_MobileV1.0/theme/default/images/jquery.min.js"></script>
</head>

<body>
	<div id="wrapper">
		
		<div id="header">
			<a href="javascript:history.go(-1)" class="home"></a>
	        <em class="eleft">User Registration</em>
			<a href="#" class="siteMap"></a>
		</div>
		<div id="index5">
            <div  class="incBox_login" id="form1_reg">
				<div class="LoginBox">
					<div class="divcss5"><img src="../images/logo-sqp02.png" class="logo" /><br />手机号注册.Mobile No Reg<br /><br /></div>
                    <ul class="boxshadow" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" ><li class="lione">Mobile：</li><li class="lioneright"><input name="username"  tabindex="1" id="username" value="" title="Mobile"  onblur="if(this.value==''){this.value='Mobile';}"  onfocus="if(this.value=='Mobile'){this.value=''}" onkeydown="RegExpression_s(this,6);this.style.color='#000';" onChange="YanZengChongFu_mobile(this,'#form1_reg')" maxlength="11"/></li><div class="rightdiv"></div></ul>
                    <ul class="ullogin" ><input id='Submit01' name="Submit" type="Submit" class="boxshadow" tabindex="5" title="可按Enter键提交！"   onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#999';" onclick="OpenBox('#form1_reg2')"  value="NEXT" alt="NEXT"  disabled /></ul>
				</div>
            </div> 
				

			<div >
				<div  class="incBox_login"  id="form1_reg2">
					<div class="LoginBox">
						<div class="divcss5"><img src="../images/logo-sqp02.png" class="logo" /><br />输入资料.fill your info <br /><br /></div>
						<ul class="boxshadow" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" ><li class="lione">姓名：</li><li class="lioneright"><input name="SYS_UserName"  tabindex="1" id="SYS_UserName" value="" title="请输入姓名"  onblur="passthis(this);"  onkeydown="passthis(this);this.style.color='#000';" maxlength="38"/></li><div class="rightdiv"></div></ul>
						<ul class="boxshadow" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" ><li class="lione">E_mail：</li><li class="lioneright"><input name="SYS_Email"  tabindex="2" id="SYS_Email" value="" title="请输入邮箱地址"  onblur="passthis(this);"  onkeydown="passthis(this);this.style.color='#000';" maxlength="38"/></li><div class="rightdiv"></div></ul>
						<ul class="ullogin" ><input name="Submit" type="input" class="boxshadow" tabindex="3" title="可按Enter键提交！"   onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#999';" onclick="OpenBox('#form1_reg3')" src="Machine_MobileV1.0/images/f_bg_h.gif"  value="NEXT" alt="NEXT" readonly /></ul>
					</div>
					<div id="catalog">
						<ul>
							<li><a href="#" onClick="OpenBox('#form1_reg')">返回上一页</a></li> 
						</ul>
					</div>
				</div>
			</div>
			<div >
				<div  class="incBox_login"  id="form1_reg3">
					<div class="LoginBox">
						<div class="divcss5"><img src="../images/logo-sqp02.png" class="logo" /><br />输入密码.file passwrod <br /><font color="#999" size='-1'>请输入两次密码以确定密码一致性。</font><br /></div>
						<ul class="boxshadow" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" ><li class="lione">password (1)：</li><li class="lioneright"><input name="SYS_PassWord"  tabindex="2" id="SYS_PassWord" value="" title="请输入邮箱地址"  onblur="passthis(this);"  onkeydown="passthis(this);this.style.color='#000';" maxlength="38"/></li><div class="rightdiv"></div></ul>
						<ul class="boxshadow" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" ><li class="lione">password (2)：</li><li class="lioneright"><input name="SYS_PassWord2"  tabindex="2" id="SYS_PassWord2" value="" title="请输入邮箱地址"  onblur="passthis(this);"  onkeydown="passthis(this);this.style.color='#000';" maxlength="38"/></li><div class="rightdiv"></div></ul>
						<ul class="ullogin" ><input name="Submit" type="input" class="boxshadow" tabindex="5" title="可按Enter键提交！"   onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#999';" onclick="ZhuCheUser()" src="Machine_MobileV1.0/images/f_bg_h.gif"  value=" 提交 .Enter" alt="NEXT" readonly /></ul>
					</div>
					<div id="catalog">
						<ul>
							<li><a href="#" onClick="OpenBox('#form1_reg2')" style="text-align: left;">返回上一页</a></li> 
						</ul>
					</div>
				</div> 
			</div>

			<div id="catalog">
				<ul>
					<li><a href="index.php">登录.Login</a></li>
					<li><a href="Machine_MobileV1.0/M_about.php">关于.About SQP</a></li> 
				</ul>
            </div>
			<?php include_once( 'M_reg_foot.php' );?>
		</div>
	</div>
</body>

</html>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../js/B_code.js"></script>
<script type="text/javascript" src="../js/B_login_fnction.js"></script>
<script type="text/javascript">
   OpenBox('#form1_reg');//默认打开注册手机开始
</script>

