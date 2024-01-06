<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">



<head>

<title>阳光质造管理系统--注册页面</title>
<link href="style/style_login.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body class="regback">

<form action="index_save.php?action=login" method="post" name="form1" id="form1">
<div class="cong">
<div class="huiyuanzhuche">会员注册.registration</div>



<ul><li class="lione">mob：</li><li><input name="username"  tabindex="2" id="username" value="" title="Mobile"  onblur="passthis(this);if(this.value==''){this.value='Mobile';this.style.color='#999';}"  onfocus="this.style.backgroundColor='#FBCFCF';if(this.value=='Mobile'){this.value=''}" onmouseover="this.style.backgroundColor='#FBCFCF'" onmouseout="this.style.backgroundColor=''" onkeyup="passthis(this);RegExpression_s(this,1);this.style.color='#000';"/><div class="rightdiv"></div></li></ul>

<ul><li class="lione">邮箱/email：</li><li><input name="email"  tabindex="3" id="email" value="" title="Mobile"  onblur="passthis(this);if(this.value==''){this.value='Job number / Mobile / Email';this.style.color='#999';}"  onfocus="this.style.backgroundColor='#FBCFCF';if(this.value=='Mobile'){this.value=''}" onmouseover="this.style.backgroundColor='#FBCFCF'" onmouseout="this.style.backgroundColor=''" onkeyup="passthis(this);RegExpression_s(this,1);this.style.color='#000';"/><div class="rightdiv"></div></li></ul>

<ul><li class="lione">Password：</li><li><input name="SYS_PassWord"  tabindex="4"  type="password" id="SYS_PassWord" value=""  onblur="passthis(this);" onfocus="this.style.backgroundColor='#FBCFCF'" onmouseover="this.style.backgroundColor='#FBCFCF'" onmouseout="this.style.backgroundColor=''" tabindex="3" onkeyup="passthis(this);RegExpression_s(this,2);this.style.color='#000';" /><div class="rightdiv"></div></li></ul>

<ul><li class="lione">code：</li><li style="width:70px;"><span id="code" class="nocode">验证码</span><input name="Y_codeinput" id="Y_codeinput" value="" type="hidden"/></li><li style="width:202px;"><input name="codeinput" id="codeinput" value=""  onfocus="this.style.backgroundColor='#FBCFCF'" onmouseover="this.style.backgroundColor='#FBCFCF'" onmouseout="this.style.backgroundColor=''" tabindex="4" onkeyup="RegExpression_s(this,2);this.style.color='#000';" style="width:242px;" /><div id="CodeDiv" class="rightdiv" tit=""></div></li></ul>

<ul class="ullogin"><input name="Submit" type="submit" tabindex="5"  title="可按Enter键提交！" onchange="form1.submit()" src="images/f_bg_h.gif" value="Enter" alt="ENTER"/></ul>
</div>
</form>

<div class='set_right_bottom'><a href="#"><ul><img src='images/sitting.png' /></br>设定.setting</ul></a><a href="#"><ul><img src='images/help_24.png' /></br>关于.about</ul></a><a href="index.php"><ul><img src='images/back.png' /></br>返回主页.INDEX</ul></a></div>
</body>
</html>
<script src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/B_code.js"></script>
<script>
function RegExpression_s(obj,i){//正则表达式
 switch (i){
   case 1 :{regs=/[\*\^\|\~\!\#\$\%\&amp;\(\)\{\}\[\]\?\&lt;\&gt;\.\,\'\;\\\/\=\ ]+/;break;};   //不允许输入各种符号
   case 2 :{regs=/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/;break;} // email
   case 3 :{regs=/^[01]?[- .]?(\([2-9]\d{2}\)|[2-9]\d{2})[- .]?\d{3}[- .]?\d{4}$/;break;}; //phoneNumberUS
   case 4 :{regs=/[\x80-\xff_a-zA-Z0-9]+/;break;}; //phoneNumberUS
   case 5 :{regs=/^http:\/\/[a-zA-Z0-9]+\.[a-zA-Z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/;break;}; //网址
   case 6 :{regs=/^(\+\d{2,3}\-)?\d{11}$/;break;}; //手机号
   case 7 :{regs=/^[a-zA-Z]+$/;break;}; //只能输入字母
   case 8 :{regs=/^\w{3,}@\w+(\.\w+)+$/;break;}; //邮箱地址
   case 9 :{regs=/^(\d{3,4}\-)?[1-9]\d{6,7}$/;break;}; //电话号码
   case 10 :{regs =/(^\s*)|(\s*$)/g;break;}; //不为空格
   case 11 :{regs =/^[a-zA-Z\u0391-\uFFE5].{15}$/;break;}; //不为以数字开头
   case 12 :{regs =/[^\d]/;break;}; //只能输入数(
   default:{regs=/[\*\^\|\~\!\#\$\%\&amp;\(\)\{\}\[\]\?\&lt;\&gt;\.\,\'\;\\\/\=\ ]+/;};   //不允许输入各种符号
  };
   obj.value=obj.value.replace(regs,'');
    }
//correctPNG();
function passthis(ths){
		if($(ths).val() != "" && $(ths).val() != "Mobile"){
			 $(ths).next("div").html('<img src="images/Fugue_1905.png" width="16" height="16" alt="pass"/>');
			 $(ths).next("div").attr("tit",$(ths).val());
			}else{
			 $(ths).next("div").html('<img src="images/Fugue_874.png" width="16" height="16" alt="No Pass"/>');
			 $(ths).next("div").attr("tit","");
			};
		//alert($(ths).val());
	}
</script>

