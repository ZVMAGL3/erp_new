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
    if( isset($_POST["MingChen"]) ){$MingChen=$_POST["MingChen"];}else{$MingChen='';};       //名称
    if( isset($_POST["GuiGe"]) ){$GuiGe=$_POST["GuiGe"];}else{$GuiGe='';};       //规格
    if( isset($_POST["ZhiZaoChangShang"]) ){$ZhiZaoChangShang=$_POST["ZhiZaoChangShang"];}else{$ZhiZaoChangShang='';};       //制造厂商
    if( isset($_POST["ChuChangBianHao"]) ){$ChuChangBianHao=$_POST["ChuChangBianHao"];}else{$ChuChangBianHao='';};       //出厂编号
    if( isset($_POST["ShiYongRiQi"]) ){$ShiYongRiQi=$_POST["ShiYongRiQi"];}else{$ShiYongRiQi='';};       //始用日期
    if( isset($_POST["ShiYongBuMen"]) ){$ShiYongBuMen=$_POST["ShiYongBuMen"];}else{$ShiYongBuMen='';};       //使用部门
    if( isset($_POST["GuanLiZeRenRen"]) ){$GuanLiZeRenRen=$_POST["GuanLiZeRenRen"];}else{$GuanLiZeRenRen='';};       //管理责任人
    if( isset($_POST["BaoFeiRiQi"]) ){$BaoFeiRiQi=$_POST["BaoFeiRiQi"];}else{$BaoFeiRiQi='';};       //报废日期

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_JianCeHeCeLiangZiYuanTaiZhang`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_MingChen=$row2['MingChen'];
    $Y_GuiGe=$row2['GuiGe'];
    $Y_ZhiZaoChangShang=$row2['ZhiZaoChangShang'];
    $Y_ChuChangBianHao=$row2['ChuChangBianHao'];
    $Y_ShiYongRiQi=$row2['ShiYongRiQi'];
    $Y_ShiYongBuMen=$row2['ShiYongBuMen'];
    $Y_GuanLiZeRenRen=$row2['GuanLiZeRenRen'];
    $Y_BaoFeiRiQi=$row2['BaoFeiRiQi'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_JianCeHeCeLiangZiYuanTaiZhang`  set `MingChen`='$MingChen',`GuiGe`='$GuiGe',`ZhiZaoChangShang`='$ZhiZaoChangShang',`ChuChangBianHao`='$ChuChangBianHao',`ShiYongRiQi`='$ShiYongRiQi',`ShiYongBuMen`='$ShiYongBuMen',`GuanLiZeRenRen`='$GuanLiZeRenRen',`BaoFeiRiQi`='$BaoFeiRiQi',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_MingChen!=$MingChen){
		$sys_editcontent.='名称:  '.$Y_MingChen.'=>'.$MingChen.';</br>';
	};
	if($Y_GuiGe!=$GuiGe){
		$sys_editcontent.='规格:  '.$Y_GuiGe.'=>'.$GuiGe.';</br>';
	};
	if($Y_ZhiZaoChangShang!=$ZhiZaoChangShang){
		$sys_editcontent.='制造厂商:  '.$Y_ZhiZaoChangShang.'=>'.$ZhiZaoChangShang.';</br>';
	};
	if($Y_ChuChangBianHao!=$ChuChangBianHao){
		$sys_editcontent.='出厂编号:  '.$Y_ChuChangBianHao.'=>'.$ChuChangBianHao.';</br>';
	};
	if($Y_ShiYongRiQi!=$ShiYongRiQi){
		$sys_editcontent.='始用日期:  '.$Y_ShiYongRiQi.'=>'.$ShiYongRiQi.';</br>';
	};
	if($Y_ShiYongBuMen!=$ShiYongBuMen){
		$sys_editcontent.='使用部门:  '.$Y_ShiYongBuMen.'=>'.$ShiYongBuMen.';</br>';
	};
	if($Y_GuanLiZeRenRen!=$GuanLiZeRenRen){
		$sys_editcontent.='管理责任人:  '.$Y_GuanLiZeRenRen.'=>'.$GuanLiZeRenRen.';</br>';
	};
	if($Y_BaoFeiRiQi!=$BaoFeiRiQi){
		$sys_editcontent.='报废日期:  '.$Y_BaoFeiRiQi.'=>'.$BaoFeiRiQi.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'230','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(230,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(230,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
