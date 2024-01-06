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
    if( isset($_POST["SheBeiMingChen"]) ){$SheBeiMingChen=$_POST["SheBeiMingChen"];}else{$SheBeiMingChen='';};       //设备名称
    if( isset($_POST["XingHaoGuiGe"]) ){$XingHaoGuiGe=$_POST["XingHaoGuiGe"];}else{$XingHaoGuiGe='';};       //型号规格
    if( isset($_POST["BaoYangZhouQi"]) ){$BaoYangZhouQi=$_POST["BaoYangZhouQi"];}else{$BaoYangZhouQi='';};       //保养周期
    if( isset($_POST["ZD_1Yue"]) ){$ZD_1Yue=$_POST["ZD_1Yue"];}else{$ZD_1Yue='';};       //1月
    if( isset($_POST["ZD_2Yue"]) ){$ZD_2Yue=$_POST["ZD_2Yue"];}else{$ZD_2Yue='';};       //2月
    if( isset($_POST["ZD_3Yue"]) ){$ZD_3Yue=$_POST["ZD_3Yue"];}else{$ZD_3Yue='';};       //3月
    if( isset($_POST["ZD_4Yue"]) ){$ZD_4Yue=$_POST["ZD_4Yue"];}else{$ZD_4Yue='';};       //4月
    if( isset($_POST["ZD_5Yue"]) ){$ZD_5Yue=$_POST["ZD_5Yue"];}else{$ZD_5Yue='';};       //5月
    if( isset($_POST["ZD_6Yue"]) ){$ZD_6Yue=$_POST["ZD_6Yue"];}else{$ZD_6Yue='';};       //6月
    if( isset($_POST["ZD_7Yue"]) ){$ZD_7Yue=$_POST["ZD_7Yue"];}else{$ZD_7Yue='';};       //7月
    if( isset($_POST["ZD_8Yue"]) ){$ZD_8Yue=$_POST["ZD_8Yue"];}else{$ZD_8Yue='';};       //8月
    if( isset($_POST["ZD_9Yue"]) ){$ZD_9Yue=$_POST["ZD_9Yue"];}else{$ZD_9Yue='';};       //9月
    if( isset($_POST["ZD_10Yue"]) ){$ZD_10Yue=$_POST["ZD_10Yue"];}else{$ZD_10Yue='';};       //10月
    if( isset($_POST["ZD_11Yue"]) ){$ZD_11Yue=$_POST["ZD_11Yue"];}else{$ZD_11Yue='';};       //11月
    if( isset($_POST["ZD_12Yue"]) ){$ZD_12Yue=$_POST["ZD_12Yue"];}else{$ZD_12Yue='';};       //12月
    if( isset($_POST["BeiZhu2020730下午324562448"]) ){$BeiZhu2020730下午324562448=$_POST["BeiZhu2020730下午324562448"];}else{$BeiZhu2020730下午324562448='';};       //备注

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_JiChuSheShiBaoYangJiHua`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_SheBeiMingChen=$row2['SheBeiMingChen'];
    $Y_XingHaoGuiGe=$row2['XingHaoGuiGe'];
    $Y_BaoYangZhouQi=$row2['BaoYangZhouQi'];
    $Y_ZD_1Yue=$row2['ZD_1Yue'];
    $Y_ZD_2Yue=$row2['ZD_2Yue'];
    $Y_ZD_3Yue=$row2['ZD_3Yue'];
    $Y_ZD_4Yue=$row2['ZD_4Yue'];
    $Y_ZD_5Yue=$row2['ZD_5Yue'];
    $Y_ZD_6Yue=$row2['ZD_6Yue'];
    $Y_ZD_7Yue=$row2['ZD_7Yue'];
    $Y_ZD_8Yue=$row2['ZD_8Yue'];
    $Y_ZD_9Yue=$row2['ZD_9Yue'];
    $Y_ZD_10Yue=$row2['ZD_10Yue'];
    $Y_ZD_11Yue=$row2['ZD_11Yue'];
    $Y_ZD_12Yue=$row2['ZD_12Yue'];
    $Y_BeiZhu2020730下午324562448=$row2['BeiZhu2020730下午324562448'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_JiChuSheShiBaoYangJiHua`  set `SheBeiMingChen`='$SheBeiMingChen',`XingHaoGuiGe`='$XingHaoGuiGe',`BaoYangZhouQi`='$BaoYangZhouQi',`ZD_1Yue`='$ZD_1Yue',`ZD_2Yue`='$ZD_2Yue',`ZD_3Yue`='$ZD_3Yue',`ZD_4Yue`='$ZD_4Yue',`ZD_5Yue`='$ZD_5Yue',`ZD_6Yue`='$ZD_6Yue',`ZD_7Yue`='$ZD_7Yue',`ZD_8Yue`='$ZD_8Yue',`ZD_9Yue`='$ZD_9Yue',`ZD_10Yue`='$ZD_10Yue',`ZD_11Yue`='$ZD_11Yue',`ZD_12Yue`='$ZD_12Yue',`BeiZhu2020730下午324562448`='$BeiZhu2020730下午324562448',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_SheBeiMingChen!=$SheBeiMingChen){
		$sys_editcontent.='设备名称:  '.$Y_SheBeiMingChen.'=>'.$SheBeiMingChen.';</br>';
	};
	if($Y_XingHaoGuiGe!=$XingHaoGuiGe){
		$sys_editcontent.='型号规格:  '.$Y_XingHaoGuiGe.'=>'.$XingHaoGuiGe.';</br>';
	};
	if($Y_BaoYangZhouQi!=$BaoYangZhouQi){
		$sys_editcontent.='保养周期:  '.$Y_BaoYangZhouQi.'=>'.$BaoYangZhouQi.';</br>';
	};
	if($Y_ZD_1Yue!=$ZD_1Yue){
		$sys_editcontent.='1月:  '.$Y_ZD_1Yue.'=>'.$ZD_1Yue.';</br>';
	};
	if($Y_ZD_2Yue!=$ZD_2Yue){
		$sys_editcontent.='2月:  '.$Y_ZD_2Yue.'=>'.$ZD_2Yue.';</br>';
	};
	if($Y_ZD_3Yue!=$ZD_3Yue){
		$sys_editcontent.='3月:  '.$Y_ZD_3Yue.'=>'.$ZD_3Yue.';</br>';
	};
	if($Y_ZD_4Yue!=$ZD_4Yue){
		$sys_editcontent.='4月:  '.$Y_ZD_4Yue.'=>'.$ZD_4Yue.';</br>';
	};
	if($Y_ZD_5Yue!=$ZD_5Yue){
		$sys_editcontent.='5月:  '.$Y_ZD_5Yue.'=>'.$ZD_5Yue.';</br>';
	};
	if($Y_ZD_6Yue!=$ZD_6Yue){
		$sys_editcontent.='6月:  '.$Y_ZD_6Yue.'=>'.$ZD_6Yue.';</br>';
	};
	if($Y_ZD_7Yue!=$ZD_7Yue){
		$sys_editcontent.='7月:  '.$Y_ZD_7Yue.'=>'.$ZD_7Yue.';</br>';
	};
	if($Y_ZD_8Yue!=$ZD_8Yue){
		$sys_editcontent.='8月:  '.$Y_ZD_8Yue.'=>'.$ZD_8Yue.';</br>';
	};
	if($Y_ZD_9Yue!=$ZD_9Yue){
		$sys_editcontent.='9月:  '.$Y_ZD_9Yue.'=>'.$ZD_9Yue.';</br>';
	};
	if($Y_ZD_10Yue!=$ZD_10Yue){
		$sys_editcontent.='10月:  '.$Y_ZD_10Yue.'=>'.$ZD_10Yue.';</br>';
	};
	if($Y_ZD_11Yue!=$ZD_11Yue){
		$sys_editcontent.='11月:  '.$Y_ZD_11Yue.'=>'.$ZD_11Yue.';</br>';
	};
	if($Y_ZD_12Yue!=$ZD_12Yue){
		$sys_editcontent.='12月:  '.$Y_ZD_12Yue.'=>'.$ZD_12Yue.';</br>';
	};
	if($Y_BeiZhu2020730下午324562448!=$BeiZhu2020730下午324562448){
		$sys_editcontent.='备注:  '.$Y_BeiZhu2020730下午324562448.'=>'.$BeiZhu2020730下午324562448.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'214','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(214,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(214,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
