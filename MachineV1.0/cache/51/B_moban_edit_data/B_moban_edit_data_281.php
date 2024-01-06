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
    if( isset($_POST["ZD_WangZhanMingChen"]) ){$ZD_WangZhanMingChen=$_POST["ZD_WangZhanMingChen"];}else{$ZD_WangZhanMingChen='';};       //网站名称
    if( isset($_POST["ZD_WangZhi"]) ){$ZD_WangZhi=$_POST["ZD_WangZhi"];}else{$ZD_WangZhi='';};       //网址
    if( isset($_POST["ZD_WangZhanZhangHaoMiMa"]) ){$ZD_WangZhanZhangHaoMiMa=$_POST["ZD_WangZhanZhangHaoMiMa"];}else{$ZD_WangZhanZhangHaoMiMa='';};       //网站帐号密码
    if( isset($_POST["sys_gx_id_321"]) ){$sys_gx_id_321=$_POST["sys_gx_id_321"];}else{$sys_gx_id_321='';};       //关系字段:sys_gx_id_321
    if( isset($_POST["sys_gx_id_198"]) ){$sys_gx_id_198=$_POST["sys_gx_id_198"];}else{$sys_gx_id_198='';};       //[关系]质量记录归档登记表ID

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_ChangYongWangZhi`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_WangZhanMingChen=$row2['ZD_WangZhanMingChen'];
    $Y_ZD_WangZhi=$row2['ZD_WangZhi'];
    $Y_ZD_WangZhanZhangHaoMiMa=$row2['ZD_WangZhanZhangHaoMiMa'];
    $Y_sys_gx_id_321=$row2['sys_gx_id_321'];
    $Y_sys_gx_id_198=$row2['sys_gx_id_198'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_ChangYongWangZhi`  set `ZD_WangZhanMingChen`='$ZD_WangZhanMingChen',`ZD_WangZhi`='$ZD_WangZhi',`ZD_WangZhanZhangHaoMiMa`='$ZD_WangZhanZhangHaoMiMa',`sys_gx_id_198`='$sys_gx_id_198',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_WangZhanMingChen!=$ZD_WangZhanMingChen){
		$sys_editcontent.='网站名称:  '.$Y_ZD_WangZhanMingChen.'=>'.$ZD_WangZhanMingChen.';</br>';
	};
	if($Y_ZD_WangZhi!=$ZD_WangZhi){
		$sys_editcontent.='网址:  '.$Y_ZD_WangZhi.'=>'.$ZD_WangZhi.';</br>';
	};
	if($Y_ZD_WangZhanZhangHaoMiMa!=$ZD_WangZhanZhangHaoMiMa){
		$sys_editcontent.='网站帐号密码:  '.$Y_ZD_WangZhanZhangHaoMiMa.'=>'.$ZD_WangZhanZhangHaoMiMa.';</br>';
	};
	if($Y_sys_gx_id_321!=$sys_gx_id_321){
		$sys_editcontent.='关系字段:sys_gx_id_321:  '.$Y_sys_gx_id_321.'=>'.$sys_gx_id_321.';</br>';
	};
	if($Y_sys_gx_id_198!=$sys_gx_id_198){
		$sys_editcontent.='[关系]质量记录归档登记表ID:  '.$Y_sys_gx_id_198.'=>'.$sys_gx_id_198.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'281','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(281,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(281,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script>sys_count('321','281','$sys_gx_id_321');sys_count('198','281','$sys_gx_id_198');</script>";
mysqli_close( $Conn ); //关闭数据库
?>
