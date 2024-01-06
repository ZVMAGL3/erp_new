<?php
require('../session.php');
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<link href='style/menu.css' rel='stylesheet' type='text/css' />
<link href='../style/menuimage.css' rel='stylesheet' type='text/css' />
</head>
<body>

<div class='menuul'>
<a href="JavaScript:setparent(this)"><i class="fa fa-setclass"></i></br>set</a>
<!--
<a href="JavaScript:edit_Text_menu(this)"><i class="fa fa-textclass"></i></br>work</a>
!-->
<a href="JavaScript:QQ_menu(this)"><i class="fa fa-chatclass"></i></br>im</a>
<a href="JavaScript:help_menu(this)"><i class="fa fa-helpclass"></i></br>help</a>
<a href="JavaScript:exit()"><i class="fa fa-poweroffclass"></i></br>exit</a>
</div>

</body>

</html>
<script src='../js/jquery-1.8.3.min.js'  charset='utf-8'></script>
<script src='../js/jq.menu.js'></script>
<script src='../js/hztopy-min.js'></script>
<script>
function setparent(ths){
	parent.document.getElementById('attachucp').cols='77,95%,0,*';
	parent.leftmenu.$('li:first').click();
	//$('#headindextop').hide();
	window.parent.topFrame.$('#headindextop').hide();
	//licheck(ths,'li');//这里选中背景样式变换。
	//};
	}
function exit(){//系统退出
	window.parent.location.href='../exit.php';
	}	
function edit_Text_menu(ths){//打开右边记事本
	$ToHtmlID=parent.right.Use_SyS_Div;//得到右边活动页面
	//alert($ToHtmlID);
	parent.right.edit_Text(ths,$ToHtmlID);
	//licheck(ths,'li');//这里选中背景样式变换。
	//};
	}
function QQ_menu(ths){//打开内部QQ
	$ToHtmlID=parent.right.Use_SyS_Div;//得到右边活动页面
	//alert($ToHtmlID);
	parent.right.loodfoot(4,$ToHtmlID);
	//licheck(ths,'li');//这里选中背景样式变换。
	//};
	}
function help_menu(ths){//系统帮助
	var $ToHtmlID=parent.right.Use_SyS_Div;//得到右边活动页面
	//alert($ToHtmlID);
	parent.right.loodfoot(4,$ToHtmlID);
	//licheck(ths,'li');//这里选中背景样式变换。
	//};
	}
function licheck(ths,liname){//
	$(ths).parents('div').find(liname).removeClass('licheck');$(ths).addClass('licheck');
	}

</script>