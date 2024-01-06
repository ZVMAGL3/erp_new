<?php

header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once '../session.php';
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php';//执行接收参数及配置
include_once '../inc/B_conn.php';
include_once '../inc/B_connadmin.php';
include_once '../inc/Sub_All.php';

//接收参数开始

$act = '';

//=========================================================================================
if ( isset( $_POST[ 'act' ] ) )$act = $_POST[ 'act' ]; //act接收

switch ( $act ) {
	case 'Conn_sys': //------------------------- 链接表
		Conn_sys();
		break;
	case 'deldir': //----------------------- 清除生成的php文件
		global $SYS_Company_id;
		$path = "cache/$SYS_Company_id/B_moban_add/";
		deldir($path);
		$path = "cache/$SYS_Company_id/B_moban_add_data/";
		deldir($path);
		$path = "cache/$SYS_Company_id/B_moban_edit/";
		deldir($path);
		$path = "cache/$SYS_Company_id/B_moban_edit_data/";
		deldir($path);
		$path = "cache/$SYS_Company_id/B_moban_list/";
		deldir($path);
		
		break;
	case 'deldir_onepage': //----------------------- 清除单页面生成的php文件
		global $SYS_Company_id,$re_id;
		$path = "cache/$SYS_Company_id/B_moban_add/B_moban_add_".$re_id.".php";
		//echo $path;
		unlink($path);
		$path = "cache/$SYS_Company_id/B_moban_add_data/B_moban_add_data_".$re_id.".php";
		unlink($path);
		$path = "cache/$SYS_Company_id/B_moban_edit/B_moban_edit_".$re_id.".php";
		unlink($path);
		$path = "cache/$SYS_Company_id/B_moban_edit_data/B_moban_edit_data_".$re_id.".php";
		unlink($path);
		$path = "cache/$SYS_Company_id/B_moban_list/B_moban_list_".$re_id.".php";
		unlink($path);
		
		break;
	default:
		echo NoZhiLing();
};


//【ok】=========================================================================================初始化所有表的系统字段
function Conn_sys() {
	global $Conn,$Connadmin;
	if (isset( $_POST['connname' ])){
		$connname = $_POST[ 'connname' ]; 
	}

	if($connname=='Connadmin'){
		Conn_table_cols_sys('Connadmin');//执行修正
		mysqli_close($Connadmin);//关闭云数据库
	}else{
		Conn_table_cols_sys('Conn');//执行修正
		mysqli_close($Conn);//关闭数据库
	};
	/**/
	
};

//============================================================================================================ 删除指定文件夹以及文件夹下的所有文件
//设置需要删除的文件夹
  //$path = "./Application/Runtime/";
  //清空文件夹函数和清空文件夹后删除空文件夹函数的处理

  //清空文件夹函数和清空文件夹后删除空文件夹函数的处理
  function deldir($path){
	  //$path = "cache/51/B_moban_add/";
   //如果是目录则继续
   if(is_dir($path)){
    //扫描一个文件夹内的所有文件夹和文件并返回数组
   $p = scandir($path);
	   //echo $p;
   foreach($p as $val){
    //排除目录中的.和..
	   //echo $val.";"."/n";
    if($val !="." && $val !=".."){
     //如果是目录则递归子目录，继续操作
     if(is_dir($path.$val)){
      //子目录中操作删除文件夹和文件
      deldir($path.$val.'/');
      //目录清空后删除空文件夹
      @rmdir($path.$val.'/');
     }else{
      //如果是文件直接删除
      unlink($path.$val);
     }
    }
   }
  }
  }
 


?>