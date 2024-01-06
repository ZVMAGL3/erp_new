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
    if( isset($_POST["ZD_test"]) ){$ZD_test=$_POST["ZD_test"];}else{$ZD_test='';};       //test
    if( isset($_POST["ZD_TuoErSiTai"]) ){$ZD_TuoErSiTai=$_POST["ZD_TuoErSiTai"];}else{$ZD_TuoErSiTai='';};       //托尔斯泰
    if( isset($_POST["ZD_test2"]) ){$ZD_test2=$_POST["ZD_test2"];}else{$ZD_test2='';};       //test2

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_NaWaiBuYinSuXiangGuanXinXiYiLanBiao`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_test=$row2['ZD_test'];
    $Y_ZD_TuoErSiTai=$row2['ZD_TuoErSiTai'];
    $Y_ZD_test2=$row2['ZD_test2'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_NaWaiBuYinSuXiangGuanXinXiYiLanBiao`  set `ZD_test`='$ZD_test',`ZD_TuoErSiTai`='$ZD_TuoErSiTai',`ZD_test2`='$ZD_test2',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_test!=$ZD_test){
		$sys_editcontent.='test:  '.$Y_ZD_test.'=>'.$ZD_test.';</br>';
	};
	if($Y_ZD_TuoErSiTai!=$ZD_TuoErSiTai){
		$sys_editcontent.='托尔斯泰:  '.$Y_ZD_TuoErSiTai.'=>'.$ZD_TuoErSiTai.';</br>';
	};
	if($Y_ZD_test2!=$ZD_test2){
		$sys_editcontent.='test2:  '.$Y_ZD_test2.'=>'.$ZD_test2.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'268','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(268,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(268,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
