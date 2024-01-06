<?php
header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once( '../inc/B_connadmin.php' );
include_once( '../inc/B_conn.php' );
$username = $colsname = $password = $act =$hy= "";

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
 $hy=$_SESSION[ "hy" ];
 //----------------------------------------------------------------------------------------公司号的获得END


//-----------------------------------------------------------手机号接收
if ( isset( $_POST[ 'username' ] ) ) {
	$username = intval( $_POST[ 'username' ] );
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
		username();
		break;
	case 'useradd': //------------------------- 添加用户信息
		useradd();
		break;
	
	default:
		echo '对不起，没有指令';
}



function username(){
	global $Connadmin,$SYS_UserName,$username,$SYS_Email,$SYS_PassWord,$hy ;
	//以下为验证注册用户是否正确
	//echo '$username:'. $username .'+$colsname:'. $colsname .'+$password:'. $password;
	$sql = "select id From `msc_user_reg` where SYS_ShouJi='$username' and  SYS_reg_num='$hy'"; //用户登录表
	//echo $sql;
	$rs = mysqli_query( $Connadmin, $sql );
	$countrows = mysqli_num_rows( $rs ); //得到数量
	mysqli_free_result( $rs ); //释放内存
    echo $countrows;
	
}
function useradd(){
	global $Connadmin,$Conn,$SYS_UserName,$username,$SYS_Email,$SYS_PassWord,$hy ;
	date_default_timezone_set('PRC');
	//以下为验证注册用户是否正确
	$nowtime=date('Y-m-d H:i:s');
	 //echo 'username:'. $username .'+SYS_Email:'. $SYS_Email .'+SYS_PassWord:'. $SYS_PassWord;
	//-----------------------------------------------------------------------------------------用户信息查询是否重复
	$sql = "select id From `msc_user_reg` where SYS_UserName='$SYS_UserName' and SYS_ShouJi='$username'  and SYS_Email='$SYS_Email'  and SYS_PassWord='$SYS_PassWord' and  SYS_reg_num='$hy'"; //用户登录表
	//echo $sql;
	$rs = mysqli_query( $Connadmin, $sql );
	$countrows = mysqli_num_rows( $rs ); //得到数量
	if ($countrows>0){
		echo '对不起，已添加过该用户了。';
	}else{
		//--------------------------------------以下为查询到表的信息
	    $sql05 = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='sys_yuangongdanganbiao' ";
	    //echo $sql05;
	    $rs05 = mysqli_query( $Conn , $sql05 );
	    $row05 = mysqli_fetch_array( $rs05 );
	    $r_zt = $row05[ 'sys_zt' ];                           //设定的字头
	    //if($r_zt.'1'=='1'){ $r_zt=0 };
        $r_zt_bianhao = $row05[ 'sys_zt_bianhao' ];           //设定的字头编号
	    if($r_zt_bianhao.'1'=='1'){ $r_zt_bianhao=0; }; 
	    //echo $r_zt;
	    mysqli_free_result( $rs05 );                          //释放内存
	
	    //--------------------------------------以下为查询到自动编号
	    $sql06 = "select MAX(SYS_GongHao) AS SYS_GongHao From `sys_yuangongdanganbiao` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
	    //echo $sql06;
	    $rs06 = mysqli_query( $Conn , $sql06 );
	    $row06 = mysqli_fetch_array( $rs06 );
		$maxbh=$row06[ "SYS_GongHao" ];
		//echo $maxbh;
	    if ( $maxbh == "" ) {
		    $bh_y = $r_zt_bianhao;                            //字头
	    } else {
		    $bh_y = $maxbh + 1;                               //编号+1
	    };
	    $nowbh = $r_zt . $bh_y;
		mysqli_free_result( $rs06 );                          //释放内存
		
		//-----------------------------------------------------------------------------------------执行注册添加
	    if('1'.$username!='1' and '1'.$SYS_Email!='1' and '1'.$SYS_PassWord!='1'){//三个参数均不为空时
		    $sqlADD = "insert into `msc_user_reg` (SYS_UserName,SYS_ShouJi,SYS_Email,SYS_PassWord,sys_web_shenpi,sys_adddate,SYS_reg_num,SYS_GongHao,sys_yfzuid,sys_shenpi) values ('$SYS_UserName','$username','$SYS_Email','$SYS_PassWord','1','$nowtime','$hy','$nowbh','$hy',0)";
	    //echo $sqlADD;
		mysqli_query( $Connadmin ,$sqlADD ); //执行添加
			
	    //-----------------------------------------------------------------------------------------执行员工档案添加
		$sqlADD02 = "insert into `sys_yuangongdanganbiao` (SYS_UserName,SYS_ShouJi,SYS_Email,SYS_PassWord,sys_web_shenpi,sys_adddate,sys_yfzuid,SYS_GongHao,sys_zt_bianhao,sys_zt,sys_nowbh,sys_bh) values ('$SYS_UserName','$username','$SYS_Email','$SYS_PassWord','1','$nowtime','$hy','$nowbh','$r_zt_bianhao','$r_zt','$nowbh','$bh_y')";
		//echo $sqlADD02;
		mysqli_query( $Conn ,$sqlADD02 ); //执行添加员工档案
	    echo '会员注册成功。';
	    //echo"<script>alert($sqlADD)</script>";
	    }
	}
	//echo '转接中..';
	//header("Location: ../index.php");
}

mysqli_close( $Connadmin ); //关闭数据库

?>