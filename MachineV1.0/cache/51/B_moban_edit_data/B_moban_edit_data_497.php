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
    if( isset($_POST["ZD_XiangXiMiaoShu"]) ){$ZD_XiangXiMiaoShu=$_POST["ZD_XiangXiMiaoShu"];}else{$ZD_XiangXiMiaoShu='';};       //详细描述
    if( isset($_POST["ZD_HuiBaoRen"]) ){$ZD_HuiBaoRen=$_POST["ZD_HuiBaoRen"];}else{$ZD_HuiBaoRen='';};       //汇报人
    if( isset($_POST["ZD_HuiBaoRiQi"]) ){$ZD_HuiBaoRiQi=$_POST["ZD_HuiBaoRiQi"];}else{$ZD_HuiBaoRiQi='';};       //汇报日期
    if( isset($_POST["ZD_WanChengQingKuang"]) ){$ZD_WanChengQingKuang=$_POST["ZD_WanChengQingKuang"];}else{$ZD_WanChengQingKuang='';};       //完成情况
    if( isset($_POST["ZD_JiFen"]) ){$ZD_JiFen=$_POST["ZD_JiFen"];}else{$ZD_JiFen='';};       //积分
    if( isset($_POST["ZD_ShenYueRen"]) ){$ZD_ShenYueRen=$_POST["ZD_ShenYueRen"];}else{$ZD_ShenYueRen='';};       //审阅人
    if( isset($_POST["ZD_ShenYueShiJian"]) ){$ZD_ShenYueShiJian=$_POST["ZD_ShenYueShiJian"];}else{$ZD_ShenYueShiJian='';};       //审阅时间

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_MeiRiGongZuoHuiBaoBiao`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_XiangXiMiaoShu=$row2['ZD_XiangXiMiaoShu'];
    $Y_ZD_HuiBaoRen=$row2['ZD_HuiBaoRen'];
    $Y_ZD_HuiBaoRiQi=$row2['ZD_HuiBaoRiQi'];
    $Y_ZD_WanChengQingKuang=$row2['ZD_WanChengQingKuang'];
    $Y_ZD_JiFen=$row2['ZD_JiFen'];
    $Y_ZD_ShenYueRen=$row2['ZD_ShenYueRen'];
    $Y_ZD_ShenYueShiJian=$row2['ZD_ShenYueShiJian'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_MeiRiGongZuoHuiBaoBiao`  set `ZD_XiangXiMiaoShu`='$ZD_XiangXiMiaoShu',`ZD_HuiBaoRen`='$ZD_HuiBaoRen',`ZD_HuiBaoRiQi`='$ZD_HuiBaoRiQi',`ZD_WanChengQingKuang`='$ZD_WanChengQingKuang',`ZD_JiFen`='$ZD_JiFen',`ZD_ShenYueRen`='$ZD_ShenYueRen',`ZD_ShenYueShiJian`='$ZD_ShenYueShiJian',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_XiangXiMiaoShu!=$ZD_XiangXiMiaoShu){
		$sys_editcontent.='详细描述:  '.$Y_ZD_XiangXiMiaoShu.'=>'.$ZD_XiangXiMiaoShu.';</br>';
	};
	if($Y_ZD_HuiBaoRen!=$ZD_HuiBaoRen){
		$sys_editcontent.='汇报人:  '.$Y_ZD_HuiBaoRen.'=>'.$ZD_HuiBaoRen.';</br>';
	};
	if($Y_ZD_HuiBaoRiQi!=$ZD_HuiBaoRiQi){
		$sys_editcontent.='汇报日期:  '.$Y_ZD_HuiBaoRiQi.'=>'.$ZD_HuiBaoRiQi.';</br>';
	};
	if($Y_ZD_WanChengQingKuang!=$ZD_WanChengQingKuang){
		$sys_editcontent.='完成情况:  '.$Y_ZD_WanChengQingKuang.'=>'.$ZD_WanChengQingKuang.';</br>';
	};
	if($Y_ZD_JiFen!=$ZD_JiFen){
		$sys_editcontent.='积分:  '.$Y_ZD_JiFen.'=>'.$ZD_JiFen.';</br>';
	};
	if($Y_ZD_ShenYueRen!=$ZD_ShenYueRen){
		$sys_editcontent.='审阅人:  '.$Y_ZD_ShenYueRen.'=>'.$ZD_ShenYueRen.';</br>';
	};
	if($Y_ZD_ShenYueShiJian!=$ZD_ShenYueShiJian){
		$sys_editcontent.='审阅时间:  '.$Y_ZD_ShenYueShiJian.'=>'.$ZD_ShenYueShiJian.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'497','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(497,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(497,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
