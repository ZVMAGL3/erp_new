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
    if( isset($_POST["sys_gx_id_321"]) ){$sys_gx_id_321=$_POST["sys_gx_id_321"];}else{$sys_gx_id_321='';};       //关系字段:sys_gx_id_321
    if( isset($_POST["ZD_GuKeMingChen"]) ){$ZD_GuKeMingChen=$_POST["ZD_GuKeMingChen"];}else{$ZD_GuKeMingChen='';};       //顾客名称
    if( isset($_POST["ZD_CaiChanMingChen"]) ){$ZD_CaiChanMingChen=$_POST["ZD_CaiChanMingChen"];}else{$ZD_CaiChanMingChen='';};       //财产名称
    if( isset($_POST["ZD_XingHaoGuiGe"]) ){$ZD_XingHaoGuiGe=$_POST["ZD_XingHaoGuiGe"];}else{$ZD_XingHaoGuiGe='';};       //型号/规格
    if( isset($_POST["ZD_BenChangBianHao"]) ){$ZD_BenChangBianHao=$_POST["ZD_BenChangBianHao"];}else{$ZD_BenChangBianHao='';};       //本厂编号
    if( isset($_POST["ZD_ShuLiang"]) ){$ZD_ShuLiang=$_POST["ZD_ShuLiang"];}else{$ZD_ShuLiang='';};       //数量
    if( isset($_POST["ZD_JieShouRiQi"]) ){$ZD_JieShouRiQi=$_POST["ZD_JieShouRiQi"];}else{$ZD_JieShouRiQi='';};       //接收日期
    if( isset($_POST["ZD_ShiYongBuMen"]) ){$ZD_ShiYongBuMen=$_POST["ZD_ShiYongBuMen"];}else{$ZD_ShiYongBuMen='';};       //使用部门
    if( isset($_POST["ZD_WanHaoZhuangTai"]) ){$ZD_WanHaoZhuangTai=$_POST["ZD_WanHaoZhuangTai"];}else{$ZD_WanHaoZhuangTai='';};       //完好状态
    if( isset($_POST["ZD_CunFangDiDian"]) ){$ZD_CunFangDiDian=$_POST["ZD_CunFangDiDian"];}else{$ZD_CunFangDiDian='';};       //存放地点
    if( isset($_POST["ZD_BaoFeiRiQi"]) ){$ZD_BaoFeiRiQi=$_POST["ZD_BaoFeiRiQi"];}else{$ZD_BaoFeiRiQi='';};       //报废日期
    if( isset($_POST["ZD_BeiZhu"]) ){$ZD_BeiZhu=$_POST["ZD_BeiZhu"];}else{$ZD_BeiZhu='';};       //备注

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_GuKeCaiChanQingDan`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_sys_gx_id_321=$row2['sys_gx_id_321'];
    $Y_ZD_GuKeMingChen=$row2['ZD_GuKeMingChen'];
    $Y_ZD_CaiChanMingChen=$row2['ZD_CaiChanMingChen'];
    $Y_ZD_XingHaoGuiGe=$row2['ZD_XingHaoGuiGe'];
    $Y_ZD_BenChangBianHao=$row2['ZD_BenChangBianHao'];
    $Y_ZD_ShuLiang=$row2['ZD_ShuLiang'];
    $Y_ZD_JieShouRiQi=$row2['ZD_JieShouRiQi'];
    $Y_ZD_ShiYongBuMen=$row2['ZD_ShiYongBuMen'];
    $Y_ZD_WanHaoZhuangTai=$row2['ZD_WanHaoZhuangTai'];
    $Y_ZD_CunFangDiDian=$row2['ZD_CunFangDiDian'];
    $Y_ZD_BaoFeiRiQi=$row2['ZD_BaoFeiRiQi'];
    $Y_ZD_BeiZhu=$row2['ZD_BeiZhu'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_GuKeCaiChanQingDan`  set `sys_gx_id_321`='$sys_gx_id_321',`ZD_GuKeMingChen`='$ZD_GuKeMingChen',`ZD_CaiChanMingChen`='$ZD_CaiChanMingChen',`ZD_XingHaoGuiGe`='$ZD_XingHaoGuiGe',`ZD_BenChangBianHao`='$ZD_BenChangBianHao',`ZD_ShuLiang`='$ZD_ShuLiang',`ZD_JieShouRiQi`='$ZD_JieShouRiQi',`ZD_ShiYongBuMen`='$ZD_ShiYongBuMen',`ZD_WanHaoZhuangTai`='$ZD_WanHaoZhuangTai',`ZD_CunFangDiDian`='$ZD_CunFangDiDian',`ZD_BaoFeiRiQi`='$ZD_BaoFeiRiQi',`ZD_BeiZhu`='$ZD_BeiZhu',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_sys_gx_id_321!=$sys_gx_id_321){
		$sys_editcontent.='关系字段:sys_gx_id_321:  '.$Y_sys_gx_id_321.'=>'.$sys_gx_id_321.';</br>';
	};
	if($Y_ZD_GuKeMingChen!=$ZD_GuKeMingChen){
		$sys_editcontent.='顾客名称:  '.$Y_ZD_GuKeMingChen.'=>'.$ZD_GuKeMingChen.';</br>';
	};
	if($Y_ZD_CaiChanMingChen!=$ZD_CaiChanMingChen){
		$sys_editcontent.='财产名称:  '.$Y_ZD_CaiChanMingChen.'=>'.$ZD_CaiChanMingChen.';</br>';
	};
	if($Y_ZD_XingHaoGuiGe!=$ZD_XingHaoGuiGe){
		$sys_editcontent.='型号/规格:  '.$Y_ZD_XingHaoGuiGe.'=>'.$ZD_XingHaoGuiGe.';</br>';
	};
	if($Y_ZD_BenChangBianHao!=$ZD_BenChangBianHao){
		$sys_editcontent.='本厂编号:  '.$Y_ZD_BenChangBianHao.'=>'.$ZD_BenChangBianHao.';</br>';
	};
	if($Y_ZD_ShuLiang!=$ZD_ShuLiang){
		$sys_editcontent.='数量:  '.$Y_ZD_ShuLiang.'=>'.$ZD_ShuLiang.';</br>';
	};
	if($Y_ZD_JieShouRiQi!=$ZD_JieShouRiQi){
		$sys_editcontent.='接收日期:  '.$Y_ZD_JieShouRiQi.'=>'.$ZD_JieShouRiQi.';</br>';
	};
	if($Y_ZD_ShiYongBuMen!=$ZD_ShiYongBuMen){
		$sys_editcontent.='使用部门:  '.$Y_ZD_ShiYongBuMen.'=>'.$ZD_ShiYongBuMen.';</br>';
	};
	if($Y_ZD_WanHaoZhuangTai!=$ZD_WanHaoZhuangTai){
		$sys_editcontent.='完好状态:  '.$Y_ZD_WanHaoZhuangTai.'=>'.$ZD_WanHaoZhuangTai.';</br>';
	};
	if($Y_ZD_CunFangDiDian!=$ZD_CunFangDiDian){
		$sys_editcontent.='存放地点:  '.$Y_ZD_CunFangDiDian.'=>'.$ZD_CunFangDiDian.';</br>';
	};
	if($Y_ZD_BaoFeiRiQi!=$ZD_BaoFeiRiQi){
		$sys_editcontent.='报废日期:  '.$Y_ZD_BaoFeiRiQi.'=>'.$ZD_BaoFeiRiQi.';</br>';
	};
	if($Y_ZD_BeiZhu!=$ZD_BeiZhu){
		$sys_editcontent.='备注:  '.$Y_ZD_BeiZhu.'=>'.$ZD_BeiZhu.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'308','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(308,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(308,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script>sys_count('321','308','$sys_gx_id_321');</script>";
mysqli_close( $Conn ); //关闭数据库
?>
