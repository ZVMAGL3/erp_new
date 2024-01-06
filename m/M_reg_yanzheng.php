<?php
header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once( '../inc/B_connadmin.php' );
include_once( '../inc/B_conn.php' );
$username = $password = $act = "";

//-----------------------------------------------------------act接收

if ( isset( $_POST[ 'act' ] ) ) {
	$act =  $_POST[ 'act' ] ;
}

//----------------------------------------------------------------------------------------公司号的获得START
//$hy=9007;
//if(isset($_REQUEST['hy'])){//当有设定企业码时执行
//$_SESSION[ "hy" ] = $_REQUEST['hy'];                                          //公司号   9007
//}else{
//$_SESSION[ "hy" ] = $hy;
//}
//----------------------------------------------------------------------------------------公司号的获得END


//-----------------------------------------------------------手机号接收
if ( isset( $_POST[ 'SYS_ShouJi' ] ) ) {
	$SYS_ShouJi =  $_POST[ 'SYS_ShouJi' ] ;
}

//-----------------------------------------------------------姓名接收
if ( isset( $_POST[ 'SYS_UserName' ] ) ) {
	$SYS_UserName =  $_POST[ 'SYS_UserName' ] ;
}

//-----------------------------------------------------------邮箱接收
if ( isset( $_POST[ 'SYS_Email' ] ) ) {
	$SYS_Email =  $_POST[ 'SYS_Email' ] ;
}

//-----------------------------------------------------------密码接收
if ( isset( $_POST[ 'SYS_PassWord' ] ) ) {
	$SYS_PassWord = md5($_POST[ 'SYS_PassWord' ]) ;
}

//echo 'username:'. $username .'+SYS_Email:'. $SYS_Email .'+SYS_PassWord:'. $SYS_PassWord;

switch ( $act ) {
	case 'username': //------------------------- 链接表
		SYS_ShouJi();
		break;
	case 'useradd': //------------------------- 添加用户信息
		useradd();
		break;
	
	default:
		echo '对不起，没有指令';
}



function SYS_ShouJi(){
	global $Connadmin,$SYS_ShouJi;
	$sql = "select id From `msc_user_reg` where SYS_ShouJi='$SYS_ShouJi'"; //用户登录表
	// echo $sql;
	$rs = mysqli_query( $Connadmin, $sql );
	$countrows = mysqli_num_rows( $rs ); //得到数量
	mysqli_free_result( $rs ); //释放内存
    return $countrows;
}

function useradd(){
	global $Connadmin,$SYS_UserName,$SYS_ShouJi,$SYS_Email,$SYS_PassWord ;
	date_default_timezone_set('PRC');
	//-----------------------------------------------------------------------------------------执行注册添加
	if(!SYS_ShouJi()){
		$sql = "
			insert into msc_user_reg 
				(SYS_ShouJi,SYS_PassWord,SYS_UserName,SYS_Email) 
			values 
				('$SYS_ShouJi','$SYS_PassWord','$SYS_UserName','$SYS_Email')
		";
		$result = mysqli_query($Connadmin, $sql);
		if ($result) {
			// 插入操作成功
			echo '200';
		} else {
			// 插入操作失败，输出错误信息
			echo "插入操作失败: " . mysqli_error($Connadmin);
		}
	}else{
		echo "插入操作失败: 改手机号已注册";
	}
}

mysqli_close( $Connadmin ); //关闭数据库

?>