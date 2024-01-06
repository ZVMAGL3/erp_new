<head>
<link href='../style/leftmenu.css' rel='stylesheet' type='text/css' />
<link href='../style/menuimage.css' rel='stylesheet' type='text/css' />
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
</head>
<body>

<h1>Menu</h1>
<ul class='menu verticalalign'>
<li onClick="JavaScript:Gongsi_Edit(this)"><i class="fa fa-jigou"></i>我的</li>
<!--
<li onClick="JavaScript:BuMen_Edit(this)"><i class="fa fa-jigou"></i>部门</li>
<li onClick="JavaScript:ZhiLeng_Edit(this)"><i class="fa fa-sitting-ziduan"></i>职能分配</li>
!-->
<li onClick="JavaScript:ZhiZheQuanXian(this)"><i class="fa fa-lock-02"></i>职责、权限</li>
<li onClick="JavaScript:YunHuiYuan_Edit(this)"><i class="fa fa-mixcloud"></i>云帐户</li>
<li onClick="JavaScript:password_Edit(this)"><i class="fa fa-8-3"></i>密码</li>
<li onClick="JavaScript:back()"><i class="fa fa-fanhui-02"></i>返 回</li>
</ul>
</body>
</html>
<script src="../js/jquery-1.8.3.min.js"  charset="utf-8"></script>
<script>
	
function Gongsi_Edit(ths){      //公司管理
	window.parent.document.getElementById('attachucp').cols='10%,90%,0,*';
	
	window.parent.leftmenu_edit.callmenu_gongsi();
	//licheck(ths);//这里为背景选中变色
	}

	
function ZhiLeng_Edit(ths){
	window.parent.document.getElementById('attachucp').cols='10%,90%,0,*';
	window.parent.leftmenu_edit.callmenu('ZhiLeng_Edit','<i class="fa fa-edit-ul"></i> 职能分配','462','0');
	licheck(ths);//这里为背景选中变色
	}

function ZhiZheQuanXian(ths){
	window.parent.document.getElementById('attachucp').cols='10%,90%,0,*';
	window.parent.leftmenu_edit.callmenu('ZhiZheQuanXian','<i class="fa fa-edit-ul"></i> 职责、权限','258','0');
	licheck(ths);//这里为背景选中变色
	
	//parent.leftmenu_edit.callmenu('bigmenu','Sys_Zu_ZhiWei','zu','TwoMenuclose','职权分配','BigMenuEditNo','BigMenuAddNo','smallmenu','0');
	}
	
	
function RenMing_Edit(ths){
	window.parent.document.getElementById('attachucp').cols='10%,90%,0,*';
	window.parent.leftmenu_edit.callmenu_renming();
	//licheck(ths);//这里为背景选中变色
	}
function YunHuiYuan_Edit(ths){
	window.parent.document.getElementById('attachucp').cols='10%,90%,0,*';
	window.parent.leftmenu_edit.callmenu('YunHuiYuan_Edit','<i class="fa fa-edit-ul"></i> 云帐户','256','0');
	licheck(ths);//这里为背景选中变色
	}
	


function password_Edit(ths){
	window.parent.document.getElementById('attachucp').cols='10%,90%,0,*';
	window.parent.leftmenu_edit.callmenu('mima','<i class="fa fa-edit-ul"></i> 密码修改','251','0');
	licheck(ths);//这里为背景选中变色
	}
function back(){//返回系统
	window.parent.document.getElementById('attachucp').cols='0,0,77,*';
	window.parent.topFrame.$("#headindextop").show();
	}
$(document).ready(function() {
	$("li:first").addClass("licheck");
    $("li").click(function(){licheck(this);});
	});
function licheck(ths){//返回系统
	$(".menu li").removeClass("licheck");$(ths).addClass("licheck");
	}
	
</script>