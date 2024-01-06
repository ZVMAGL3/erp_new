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
    if( isset($_POST["ZD_WenJianMingChen"]) ){$ZD_WenJianMingChen=$_POST["ZD_WenJianMingChen"];}else{$ZD_WenJianMingChen='';};       //文件名称
    if( isset($_POST["ZD_FuJian"]) ){$ZD_FuJian=$_POST["ZD_FuJian"];}else{$ZD_FuJian='';};       //附件
    if( isset($_POST["sys_gx_id_198"]) ){$sys_gx_id_198=$_POST["sys_gx_id_198"];}else{$sys_gx_id_198='';};       //[关系]质量记录归档登记表ID

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_WenKongZhongXin`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_WenJianMingChen=$row2['ZD_WenJianMingChen'];
    $Y_ZD_FuJian=$row2['ZD_FuJian'];
    $Y_sys_gx_id_198=$row2['sys_gx_id_198'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_WenKongZhongXin`  set `ZD_WenJianMingChen`='$ZD_WenJianMingChen',`ZD_FuJian`='$ZD_FuJian',`sys_gx_id_198`='$sys_gx_id_198',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_WenJianMingChen!=$ZD_WenJianMingChen){
		$sys_editcontent.='文件名称:  '.$Y_ZD_WenJianMingChen.'=>'.$ZD_WenJianMingChen.';</br>';
	};
	if($Y_ZD_FuJian!=$ZD_FuJian){
		$sys_editcontent.='附件:  '.$Y_ZD_FuJian.'=>'.$ZD_FuJian.';</br>';
	};
	// if($Y_sys_gx_id_198!=$sys_gx_id_198){
	// 	$sys_editcontent.='[关系]质量记录归档登记表ID:  '.$Y_sys_gx_id_198.'=>'.$sys_gx_id_198.';</br>';
	// };
// if($sys_editcontent!=''){
//     $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
// 	$sys_postvalue_list = "'404','$strmk_id','$sys_editcontent'";		
// 	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
// 	LiYi_Add(404,$strmk_id,535,'+');       //利益函数 这里奖励货币
// }


    // Sys_XuanYongMoban(404,$strmk_id);//利益函数 这里奖励货币 


}
// echo "<script>sys_count('198','404','$sys_gx_id_198');</script>";
mysqli_close( $Conn ); //关闭数据库
?>
