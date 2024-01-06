<?php
		header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
		include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
		include_once "{$_SERVER['PATH_TRANSLATED']}/inc/Function_All.php";
		include_once "{$_SERVER['PATH_TRANSLATED']}/inc/Sub_All.php";
		include_once "{$_SERVER['PATH_TRANSLATED']}/phpword/extend/PHPWord/PHPWord.php";              //php处理word替换
		include_once "{$_SERVER['PATH_TRANSLATED']}/phpword/extend/PHPWord/PHPWord/IOFactory.php";    //php处理word替换
		$cache_file="../B_quanxian/B_quanxian_$SYS_QuanXian.php";
		if( file_exists( $cache_file ) ){//文件存在时
		    include_once ($cache_file);
		}else{
		    echo "<script>UpdatePhp_Zw($SYS_QuanXian);</script>";
		}
	
		include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
		global $strmk_id,$Conn,$const_q_xiug,$const_id_login,$bh,$hy,$SYS_UserName,$const_id_fz,$const_id_bumen;
		
		
if ( $const_q_xiug >= 0 ) { //有修改权限时
    if( isset($_POST["QuDaoMingChen"]) ){$QuDaoMingChen=$_POST["QuDaoMingChen"];}else{$QuDaoMingChen='';};       //渠道名称
    if( isset($_POST["WangZhi"]) ){$WangZhi=$_POST["WangZhi"];}else{$WangZhi='';};       //网址
    if( isset($_POST["DiZhi"]) ){$DiZhi=$_POST["DiZhi"];}else{$DiZhi='';};       //地址
    if( isset($_POST["ZhangHaoMiMa"]) ){$ZhangHaoMiMa=$_POST["ZhangHaoMiMa"];}else{$ZhangHaoMiMa='';};       //帐号密码
    if( isset($_POST["LeiXing"]) ){$LeiXing=$_POST["LeiXing"];}else{$LeiXing='';};       //类型
    if( isset($_POST["ZhaoPinJiQiao"]) ){$ZhaoPinJiQiao=$_POST["ZhaoPinJiQiao"];}else{$ZhaoPinJiQiao='';};       //招聘技巧

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_ZhaoPinGongYingShang`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_QuDaoMingChen=$row2['QuDaoMingChen'];
    $Y_WangZhi=$row2['WangZhi'];
    $Y_DiZhi=$row2['DiZhi'];
    $Y_ZhangHaoMiMa=$row2['ZhangHaoMiMa'];
    $Y_LeiXing=$row2['LeiXing'];
    $Y_ZhaoPinJiQiao=$row2['ZhaoPinJiQiao'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_ZhaoPinGongYingShang`  set `QuDaoMingChen`='$QuDaoMingChen',`WangZhi`='$WangZhi',`DiZhi`='$DiZhi',`ZhangHaoMiMa`='$ZhangHaoMiMa',`LeiXing`='$LeiXing',`ZhaoPinJiQiao`='$ZhaoPinJiQiao',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_QuDaoMingChen!=$QuDaoMingChen){
		$sys_editcontent.='渠道名称:  '.$Y_QuDaoMingChen.'=>'.$QuDaoMingChen.';</br>';
	};
	if($Y_WangZhi!=$WangZhi){
		$sys_editcontent.='网址:  '.$Y_WangZhi.'=>'.$WangZhi.';</br>';
	};
	if($Y_DiZhi!=$DiZhi){
		$sys_editcontent.='地址:  '.$Y_DiZhi.'=>'.$DiZhi.';</br>';
	};
	if($Y_ZhangHaoMiMa!=$ZhangHaoMiMa){
		$sys_editcontent.='帐号密码:  '.$Y_ZhangHaoMiMa.'=>'.$ZhangHaoMiMa.';</br>';
	};
	if($Y_LeiXing!=$LeiXing){
		$sys_editcontent.='类型:  '.$Y_LeiXing.'=>'.$LeiXing.';</br>';
	};
	if($Y_ZhaoPinJiQiao!=$ZhaoPinJiQiao){
		$sys_editcontent.='招聘技巧:  '.$Y_ZhaoPinJiQiao.'=>'.$ZhaoPinJiQiao.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'314','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(314,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(314,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
