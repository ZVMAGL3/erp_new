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
    if( isset($_POST["sys_gx_id_321"]) ){$sys_gx_id_321=$_POST["sys_gx_id_321"];}else{$sys_gx_id_321='';};       //sys_gx_id_321
    if( isset($_POST["sys_jilu"]) ){$sys_jilu=$_POST["sys_jilu"];}else{$sys_jilu='';};       //交流内容
    if( isset($_POST["sys_gx_id_223"]) ){$sys_gx_id_223=$_POST["sys_gx_id_223"];}else{$sys_gx_id_223='';};       //关系字段:sys_gx_id_223
    if( isset($_POST["sys_gx_id_495"]) ){$sys_gx_id_495=$_POST["sys_gx_id_495"];}else{$sys_gx_id_495='';};       //[关系]服务流程单ID
    if( isset($_POST["sys_gx_id_308"]) ){$sys_gx_id_308=$_POST["sys_gx_id_308"];}else{$sys_gx_id_308='';};       //[关系]顾客财产清单ID
    if( isset($_POST["sys_gx_id_497"]) ){$sys_gx_id_497=$_POST["sys_gx_id_497"];}else{$sys_gx_id_497='';};       //[关系]每日工作汇报表ID
    if( isset($_POST["sys_gx_id_204"]) ){$sys_gx_id_204=$_POST["sys_gx_id_204"];}else{$sys_gx_id_204='';};       //[关系]员工档案ID

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `sys_msn`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_sys_gx_id_321=$row2['sys_gx_id_321'];
    $Y_sys_jilu=$row2['sys_jilu'];
    $Y_sys_gx_id_223=$row2['sys_gx_id_223'];
    $Y_sys_gx_id_495=$row2['sys_gx_id_495'];
    $Y_sys_gx_id_308=$row2['sys_gx_id_308'];
    $Y_sys_gx_id_497=$row2['sys_gx_id_497'];
    $Y_sys_gx_id_204=$row2['sys_gx_id_204'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `sys_msn`  set `sys_gx_id_321`='$sys_gx_id_321',`sys_jilu`='$sys_jilu',`sys_gx_id_223`='$sys_gx_id_223',`sys_gx_id_495`='$sys_gx_id_495',`sys_gx_id_308`='$sys_gx_id_308',`sys_gx_id_497`='$sys_gx_id_497',`sys_gx_id_204`='$sys_gx_id_204',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_sys_gx_id_321!=$sys_gx_id_321){
		$sys_editcontent.='sys_gx_id_321:  '.$Y_sys_gx_id_321.'=>'.$sys_gx_id_321.';</br>';
	};
	if($Y_sys_jilu!=$sys_jilu){
		$sys_editcontent.='交流内容:  '.$Y_sys_jilu.'=>'.$sys_jilu.';</br>';
	};
	if($Y_sys_gx_id_223!=$sys_gx_id_223){
		$sys_editcontent.='关系字段:sys_gx_id_223:  '.$Y_sys_gx_id_223.'=>'.$sys_gx_id_223.';</br>';
	};
	if($Y_sys_gx_id_495!=$sys_gx_id_495){
		$sys_editcontent.='[关系]服务流程单ID:  '.$Y_sys_gx_id_495.'=>'.$sys_gx_id_495.';</br>';
	};
	if($Y_sys_gx_id_308!=$sys_gx_id_308){
		$sys_editcontent.='[关系]顾客财产清单ID:  '.$Y_sys_gx_id_308.'=>'.$sys_gx_id_308.';</br>';
	};
	if($Y_sys_gx_id_497!=$sys_gx_id_497){
		$sys_editcontent.='[关系]每日工作汇报表ID:  '.$Y_sys_gx_id_497.'=>'.$sys_gx_id_497.';</br>';
	};
	if($Y_sys_gx_id_204!=$sys_gx_id_204){
		$sys_editcontent.='[关系]员工档案ID:  '.$Y_sys_gx_id_204.'=>'.$sys_gx_id_204.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'264','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(264,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(264,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script>sys_count('321','264','$sys_gx_id_321');sys_count('223','264','$sys_gx_id_223');sys_count('495','264','$sys_gx_id_495');sys_count('308','264','$sys_gx_id_308');sys_count('497','264','$sys_gx_id_497');sys_count('204','264','$sys_gx_id_204');</script>";
mysqli_close( $Conn ); //关闭数据库
?>
