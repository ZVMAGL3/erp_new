<?php
header('Content-type: text/html; charset=utf-8');//设定本页编码
include_once '../session.php' ;
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php';//执行接收参数及配置

include_once '../inc/B_conn.php';


$act=$strmkzd=$strmk="";
if(isset($_REQUEST["act"])){
   $act=trim($_REQUEST["act"]);                                 //接收参数开始
}
if(isset($_REQUEST["strmkzd"])){
	$strmkzd=htmlspecialchars(trim($_REQUEST["strmkzd"]));      //更新动态接收
}
if(isset($_REQUEST["strmk"])){
	$strmk=htmlspecialchars(trim($_REQUEST["strmk"]));          //更新动态接收
}


if ($act=="list"){
  lists();
}elseif($act=="edit"){
  edit();
};

function lists(){
  echo ("<form id='post_form' autocomplete='off'><div id='mobanaddbox' class='NowULTable' style='text-align:right;width:600px;height:325px;'>");
  echo ("<ul><li style='text-align:right;width:20%;'>&nbsp;</li><li style='width:80%'>请选择您要共享的权限</li></ul>");
  echo ("<ul><li style='text-align:right;width:20%;'>&nbsp;</li><li style='width:80%'><label><input name='sys_shenpi_all' type='radio' id='sys_shenpi_all_0' value='1'/>部门共享（仅本部门人员可查看）</label></li></ul>");
  echo ("<ul><li style='text-align:right;width:20%;'>&nbsp;</li><li style='width:80%'><label><input name='sys_shenpi_all' type='radio' id='sys_shenpi_all_1' value='2' checked='checked'/>公司共享（部门及全公司人员可查看）</label></li></ul>");
  echo ("<ul><li style='text-align:right;width:20%;'>&nbsp;</li><li style='width:80%'><label><input name='sys_shenpi_all' type='radio' id='sys_shenpi_all_2' value='3'/>分支共享（部门、公司、及分公司所有人员可查看）</label></li></ul>");
  echo ("<ul><li style='text-align:right;width:20%;'>&nbsp;</li><li style='width:80%'></li></ul>");
  echo ("<ul><li style='text-align:right;width:20%'>&nbsp;</li><li style='width:80%;height:60px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value=''/><input id='SYS_submit' value='&nbsp;确定共享&nbsp;' type='button' title='Ctrl+Enter提交' class='button'  onkeydown='' onclick=''/></li></ul>");
  echo ("</div></form>");
};
//=========================================================================================添加记录
function edit(){
    
};
  
  mysqli_close($Conn);//关闭数据库
  //mysqli_close($Connadmin);//关闭云数据库
?>
