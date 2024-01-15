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
    if( isset($_POST["ZhiWu"]) ){$ZhiWu=$_POST["ZhiWu"];}else{$ZhiWu='';};       //职务
    if( isset($_POST["ZD_ShenQingRen"]) ){$ZD_ShenQingRen=$_POST["ZD_ShenQingRen"];}else{$ZD_ShenQingRen='';};       //申请人
    if( isset($_POST["sys_id_zu"]) ){$sys_id_zu=$_POST["sys_id_zu"];}else{$sys_id_zu='';};       //分类
    if( isset($_POST["ZD_ShenQingShiJian"]) ){$ZD_ShenQingShiJian=$_POST["ZD_ShenQingShiJian"];}else{$ZD_ShenQingShiJian='';};       //申请时间
    if( isset($_POST["ShiYou"]) ){$ShiYou=$_POST["ShiYou"];}else{$ShiYou='';};       //事由
    if( isset($_POST["ZD_BeiZhu"]) ){$ZD_BeiZhu=$_POST["ZD_BeiZhu"];}else{$ZD_BeiZhu='';};       //备注
    if( isset($_POST["sys_shenpi"]) ){$sys_shenpi=$_POST["sys_shenpi"];}else{$sys_shenpi='';};       //审核
    if( isset($_POST["sys_shenpi_all"]) ){$sys_shenpi_all=$_POST["sys_shenpi_all"];}else{$sys_shenpi_all='';};       //批准

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_QingJiaDiaoXiuJiaBanWaiChuDan`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZhiWu=$row2['ZhiWu'];
    $Y_ZD_ShenQingRen=$row2['ZD_ShenQingRen'];
    $Y_sys_id_zu=$row2['sys_id_zu'];
    $Y_ZD_ShenQingShiJian=$row2['ZD_ShenQingShiJian'];
    $Y_ShiYou=$row2['ShiYou'];
    $Y_ZD_BeiZhu=$row2['ZD_BeiZhu'];
    $Y_sys_shenpi=$row2['sys_shenpi'];
    $Y_sys_shenpi_all=$row2['sys_shenpi_all'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_QingJiaDiaoXiuJiaBanWaiChuDan`  set `ZhiWu`='$ZhiWu',`ZD_ShenQingRen`='$ZD_ShenQingRen',`sys_id_zu`='$sys_id_zu',`ZD_ShenQingShiJian`='$ZD_ShenQingShiJian',`ShiYou`='$ShiYou',`ZD_BeiZhu`='$ZD_BeiZhu',`sys_shenpi`='$sys_shenpi',`sys_shenpi_all`='$sys_shenpi_all',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZhiWu!=$ZhiWu){
		$sys_editcontent.='职务:  '.$Y_ZhiWu.'=>'.$ZhiWu.';</br>';
	};
	if($Y_ZD_ShenQingRen!=$ZD_ShenQingRen){
		$sys_editcontent.='申请人:  '.$Y_ZD_ShenQingRen.'=>'.$ZD_ShenQingRen.';</br>';
	};
	if($Y_sys_id_zu!=$sys_id_zu){
		$sys_editcontent.='分类:  '.$Y_sys_id_zu.'=>'.$sys_id_zu.';</br>';
	};
	if($Y_ZD_ShenQingShiJian!=$ZD_ShenQingShiJian){
		$sys_editcontent.='申请时间:  '.$Y_ZD_ShenQingShiJian.'=>'.$ZD_ShenQingShiJian.';</br>';
	};
	if($Y_ShiYou!=$ShiYou){
		$sys_editcontent.='事由:  '.$Y_ShiYou.'=>'.$ShiYou.';</br>';
	};
	if($Y_ZD_BeiZhu!=$ZD_BeiZhu){
		$sys_editcontent.='备注:  '.$Y_ZD_BeiZhu.'=>'.$ZD_BeiZhu.';</br>';
	};
	if($Y_sys_shenpi!=$sys_shenpi){
		$sys_editcontent.='审核:  '.$Y_sys_shenpi.'=>'.$sys_shenpi.';</br>';
	};
	if($Y_sys_shenpi_all!=$sys_shenpi_all){
		$sys_editcontent.='批准:  '.$Y_sys_shenpi_all.'=>'.$sys_shenpi_all.';</br>';
	};
	echo $sys_editcontent;
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'494','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(494,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(494,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
