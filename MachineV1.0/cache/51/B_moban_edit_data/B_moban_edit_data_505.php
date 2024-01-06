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
    if( isset($_POST["ZD_XingMing"]) ){$ZD_XingMing=$_POST["ZD_XingMing"];}else{$ZD_XingMing='';};       //姓名
    if( isset($_POST["ZD_NianFen"]) ){$ZD_NianFen=$_POST["ZD_NianFen"];}else{$ZD_NianFen='';};       //年份
    if( isset($_POST["ZD_1Ri"]) ){$ZD_1Ri=$_POST["ZD_1Ri"];}else{$ZD_1Ri='';};       //1日
    if( isset($_POST["ZD_2Ri"]) ){$ZD_2Ri=$_POST["ZD_2Ri"];}else{$ZD_2Ri='';};       //2日
    if( isset($_POST["ZD_3Ri"]) ){$ZD_3Ri=$_POST["ZD_3Ri"];}else{$ZD_3Ri='';};       //3日
    if( isset($_POST["ZD_4Ri"]) ){$ZD_4Ri=$_POST["ZD_4Ri"];}else{$ZD_4Ri='';};       //4日
    if( isset($_POST["ZD_5Ri"]) ){$ZD_5Ri=$_POST["ZD_5Ri"];}else{$ZD_5Ri='';};       //5日
    if( isset($_POST["ZD_6Ri"]) ){$ZD_6Ri=$_POST["ZD_6Ri"];}else{$ZD_6Ri='';};       //6日
    if( isset($_POST["ZD_7Ri"]) ){$ZD_7Ri=$_POST["ZD_7Ri"];}else{$ZD_7Ri='';};       //7日
    if( isset($_POST["ZD_8Ri"]) ){$ZD_8Ri=$_POST["ZD_8Ri"];}else{$ZD_8Ri='';};       //8日
    if( isset($_POST["ZD_9Ri"]) ){$ZD_9Ri=$_POST["ZD_9Ri"];}else{$ZD_9Ri='';};       //9日
    if( isset($_POST["ZD_10Ri"]) ){$ZD_10Ri=$_POST["ZD_10Ri"];}else{$ZD_10Ri='';};       //10日
    if( isset($_POST["ZD_11Ri"]) ){$ZD_11Ri=$_POST["ZD_11Ri"];}else{$ZD_11Ri='';};       //11日
    if( isset($_POST["ZD_12Ri"]) ){$ZD_12Ri=$_POST["ZD_12Ri"];}else{$ZD_12Ri='';};       //12日
    if( isset($_POST["ZD_13Ri"]) ){$ZD_13Ri=$_POST["ZD_13Ri"];}else{$ZD_13Ri='';};       //13日
    if( isset($_POST["ZD_14Ri"]) ){$ZD_14Ri=$_POST["ZD_14Ri"];}else{$ZD_14Ri='';};       //14日
    if( isset($_POST["ZD_15Ri"]) ){$ZD_15Ri=$_POST["ZD_15Ri"];}else{$ZD_15Ri='';};       //15日
    if( isset($_POST["ZD_16Ri"]) ){$ZD_16Ri=$_POST["ZD_16Ri"];}else{$ZD_16Ri='';};       //16日
    if( isset($_POST["ZD_17Ri"]) ){$ZD_17Ri=$_POST["ZD_17Ri"];}else{$ZD_17Ri='';};       //17日
    if( isset($_POST["ZD_18Ri"]) ){$ZD_18Ri=$_POST["ZD_18Ri"];}else{$ZD_18Ri='';};       //18日
    if( isset($_POST["ZD_19Ri"]) ){$ZD_19Ri=$_POST["ZD_19Ri"];}else{$ZD_19Ri='';};       //19日
    if( isset($_POST["ZD_20Ri"]) ){$ZD_20Ri=$_POST["ZD_20Ri"];}else{$ZD_20Ri='';};       //20日
    if( isset($_POST["ZD_21Ri"]) ){$ZD_21Ri=$_POST["ZD_21Ri"];}else{$ZD_21Ri='';};       //21日
    if( isset($_POST["ZD_22Ri"]) ){$ZD_22Ri=$_POST["ZD_22Ri"];}else{$ZD_22Ri='';};       //22日
    if( isset($_POST["ZD_23Ri"]) ){$ZD_23Ri=$_POST["ZD_23Ri"];}else{$ZD_23Ri='';};       //23日
    if( isset($_POST["ZD_24Ri"]) ){$ZD_24Ri=$_POST["ZD_24Ri"];}else{$ZD_24Ri='';};       //24日
    if( isset($_POST["ZD_25Ri"]) ){$ZD_25Ri=$_POST["ZD_25Ri"];}else{$ZD_25Ri='';};       //25日
    if( isset($_POST["ZD_26Ri"]) ){$ZD_26Ri=$_POST["ZD_26Ri"];}else{$ZD_26Ri='';};       //26日
    if( isset($_POST["ZD_27Ri"]) ){$ZD_27Ri=$_POST["ZD_27Ri"];}else{$ZD_27Ri='';};       //27日
    if( isset($_POST["ZD_28Ri"]) ){$ZD_28Ri=$_POST["ZD_28Ri"];}else{$ZD_28Ri='';};       //28日
    if( isset($_POST["ZD_29Ri"]) ){$ZD_29Ri=$_POST["ZD_29Ri"];}else{$ZD_29Ri='';};       //29日
    if( isset($_POST["ZD_30Ri"]) ){$ZD_30Ri=$_POST["ZD_30Ri"];}else{$ZD_30Ri='';};       //30日
    if( isset($_POST["ZD_31Ri"]) ){$ZD_31Ri=$_POST["ZD_31Ri"];}else{$ZD_31Ri='';};       //31日
    if( isset($_POST["ZD_GongJiTian"]) ){$ZD_GongJiTian=$_POST["ZD_GongJiTian"];}else{$ZD_GongJiTian='';};       //共计（天）
    if( isset($_POST["ZD_ChuChaBuTie"]) ){$ZD_ChuChaBuTie=$_POST["ZD_ChuChaBuTie"];}else{$ZD_ChuChaBuTie='';};       //出差补贴
    if( isset($_POST["ZD_BeiZhu"]) ){$ZD_BeiZhu=$_POST["ZD_BeiZhu"];}else{$ZD_BeiZhu='';};       //备注

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_ChuChaShiJianHuiZong`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_XingMing=$row2['ZD_XingMing'];
    $Y_ZD_NianFen=$row2['ZD_NianFen'];
    $Y_ZD_1Ri=$row2['ZD_1Ri'];
    $Y_ZD_2Ri=$row2['ZD_2Ri'];
    $Y_ZD_3Ri=$row2['ZD_3Ri'];
    $Y_ZD_4Ri=$row2['ZD_4Ri'];
    $Y_ZD_5Ri=$row2['ZD_5Ri'];
    $Y_ZD_6Ri=$row2['ZD_6Ri'];
    $Y_ZD_7Ri=$row2['ZD_7Ri'];
    $Y_ZD_8Ri=$row2['ZD_8Ri'];
    $Y_ZD_9Ri=$row2['ZD_9Ri'];
    $Y_ZD_10Ri=$row2['ZD_10Ri'];
    $Y_ZD_11Ri=$row2['ZD_11Ri'];
    $Y_ZD_12Ri=$row2['ZD_12Ri'];
    $Y_ZD_13Ri=$row2['ZD_13Ri'];
    $Y_ZD_14Ri=$row2['ZD_14Ri'];
    $Y_ZD_15Ri=$row2['ZD_15Ri'];
    $Y_ZD_16Ri=$row2['ZD_16Ri'];
    $Y_ZD_17Ri=$row2['ZD_17Ri'];
    $Y_ZD_18Ri=$row2['ZD_18Ri'];
    $Y_ZD_19Ri=$row2['ZD_19Ri'];
    $Y_ZD_20Ri=$row2['ZD_20Ri'];
    $Y_ZD_21Ri=$row2['ZD_21Ri'];
    $Y_ZD_22Ri=$row2['ZD_22Ri'];
    $Y_ZD_23Ri=$row2['ZD_23Ri'];
    $Y_ZD_24Ri=$row2['ZD_24Ri'];
    $Y_ZD_25Ri=$row2['ZD_25Ri'];
    $Y_ZD_26Ri=$row2['ZD_26Ri'];
    $Y_ZD_27Ri=$row2['ZD_27Ri'];
    $Y_ZD_28Ri=$row2['ZD_28Ri'];
    $Y_ZD_29Ri=$row2['ZD_29Ri'];
    $Y_ZD_30Ri=$row2['ZD_30Ri'];
    $Y_ZD_31Ri=$row2['ZD_31Ri'];
    $Y_ZD_GongJiTian=$row2['ZD_GongJiTian'];
    $Y_ZD_ChuChaBuTie=$row2['ZD_ChuChaBuTie'];
    $Y_ZD_BeiZhu=$row2['ZD_BeiZhu'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_ChuChaShiJianHuiZong`  set `ZD_XingMing`='$ZD_XingMing',`ZD_NianFen`='$ZD_NianFen',`ZD_1Ri`='$ZD_1Ri',`ZD_2Ri`='$ZD_2Ri',`ZD_3Ri`='$ZD_3Ri',`ZD_4Ri`='$ZD_4Ri',`ZD_5Ri`='$ZD_5Ri',`ZD_6Ri`='$ZD_6Ri',`ZD_7Ri`='$ZD_7Ri',`ZD_8Ri`='$ZD_8Ri',`ZD_9Ri`='$ZD_9Ri',`ZD_10Ri`='$ZD_10Ri',`ZD_11Ri`='$ZD_11Ri',`ZD_12Ri`='$ZD_12Ri',`ZD_13Ri`='$ZD_13Ri',`ZD_14Ri`='$ZD_14Ri',`ZD_15Ri`='$ZD_15Ri',`ZD_16Ri`='$ZD_16Ri',`ZD_17Ri`='$ZD_17Ri',`ZD_18Ri`='$ZD_18Ri',`ZD_19Ri`='$ZD_19Ri',`ZD_20Ri`='$ZD_20Ri',`ZD_21Ri`='$ZD_21Ri',`ZD_22Ri`='$ZD_22Ri',`ZD_23Ri`='$ZD_23Ri',`ZD_24Ri`='$ZD_24Ri',`ZD_25Ri`='$ZD_25Ri',`ZD_26Ri`='$ZD_26Ri',`ZD_27Ri`='$ZD_27Ri',`ZD_28Ri`='$ZD_28Ri',`ZD_29Ri`='$ZD_29Ri',`ZD_30Ri`='$ZD_30Ri',`ZD_31Ri`='$ZD_31Ri',`ZD_GongJiTian`='$ZD_GongJiTian',`ZD_ChuChaBuTie`='$ZD_ChuChaBuTie',`ZD_BeiZhu`='$ZD_BeiZhu',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_XingMing!=$ZD_XingMing){
		$sys_editcontent.='姓名:  '.$Y_ZD_XingMing.'=>'.$ZD_XingMing.';</br>';
	};
	if($Y_ZD_NianFen!=$ZD_NianFen){
		$sys_editcontent.='年份:  '.$Y_ZD_NianFen.'=>'.$ZD_NianFen.';</br>';
	};
	if($Y_ZD_1Ri!=$ZD_1Ri){
		$sys_editcontent.='1日:  '.$Y_ZD_1Ri.'=>'.$ZD_1Ri.';</br>';
	};
	if($Y_ZD_2Ri!=$ZD_2Ri){
		$sys_editcontent.='2日:  '.$Y_ZD_2Ri.'=>'.$ZD_2Ri.';</br>';
	};
	if($Y_ZD_3Ri!=$ZD_3Ri){
		$sys_editcontent.='3日:  '.$Y_ZD_3Ri.'=>'.$ZD_3Ri.';</br>';
	};
	if($Y_ZD_4Ri!=$ZD_4Ri){
		$sys_editcontent.='4日:  '.$Y_ZD_4Ri.'=>'.$ZD_4Ri.';</br>';
	};
	if($Y_ZD_5Ri!=$ZD_5Ri){
		$sys_editcontent.='5日:  '.$Y_ZD_5Ri.'=>'.$ZD_5Ri.';</br>';
	};
	if($Y_ZD_6Ri!=$ZD_6Ri){
		$sys_editcontent.='6日:  '.$Y_ZD_6Ri.'=>'.$ZD_6Ri.';</br>';
	};
	if($Y_ZD_7Ri!=$ZD_7Ri){
		$sys_editcontent.='7日:  '.$Y_ZD_7Ri.'=>'.$ZD_7Ri.';</br>';
	};
	if($Y_ZD_8Ri!=$ZD_8Ri){
		$sys_editcontent.='8日:  '.$Y_ZD_8Ri.'=>'.$ZD_8Ri.';</br>';
	};
	if($Y_ZD_9Ri!=$ZD_9Ri){
		$sys_editcontent.='9日:  '.$Y_ZD_9Ri.'=>'.$ZD_9Ri.';</br>';
	};
	if($Y_ZD_10Ri!=$ZD_10Ri){
		$sys_editcontent.='10日:  '.$Y_ZD_10Ri.'=>'.$ZD_10Ri.';</br>';
	};
	if($Y_ZD_11Ri!=$ZD_11Ri){
		$sys_editcontent.='11日:  '.$Y_ZD_11Ri.'=>'.$ZD_11Ri.';</br>';
	};
	if($Y_ZD_12Ri!=$ZD_12Ri){
		$sys_editcontent.='12日:  '.$Y_ZD_12Ri.'=>'.$ZD_12Ri.';</br>';
	};
	if($Y_ZD_13Ri!=$ZD_13Ri){
		$sys_editcontent.='13日:  '.$Y_ZD_13Ri.'=>'.$ZD_13Ri.';</br>';
	};
	if($Y_ZD_14Ri!=$ZD_14Ri){
		$sys_editcontent.='14日:  '.$Y_ZD_14Ri.'=>'.$ZD_14Ri.';</br>';
	};
	if($Y_ZD_15Ri!=$ZD_15Ri){
		$sys_editcontent.='15日:  '.$Y_ZD_15Ri.'=>'.$ZD_15Ri.';</br>';
	};
	if($Y_ZD_16Ri!=$ZD_16Ri){
		$sys_editcontent.='16日:  '.$Y_ZD_16Ri.'=>'.$ZD_16Ri.';</br>';
	};
	if($Y_ZD_17Ri!=$ZD_17Ri){
		$sys_editcontent.='17日:  '.$Y_ZD_17Ri.'=>'.$ZD_17Ri.';</br>';
	};
	if($Y_ZD_18Ri!=$ZD_18Ri){
		$sys_editcontent.='18日:  '.$Y_ZD_18Ri.'=>'.$ZD_18Ri.';</br>';
	};
	if($Y_ZD_19Ri!=$ZD_19Ri){
		$sys_editcontent.='19日:  '.$Y_ZD_19Ri.'=>'.$ZD_19Ri.';</br>';
	};
	if($Y_ZD_20Ri!=$ZD_20Ri){
		$sys_editcontent.='20日:  '.$Y_ZD_20Ri.'=>'.$ZD_20Ri.';</br>';
	};
	if($Y_ZD_21Ri!=$ZD_21Ri){
		$sys_editcontent.='21日:  '.$Y_ZD_21Ri.'=>'.$ZD_21Ri.';</br>';
	};
	if($Y_ZD_22Ri!=$ZD_22Ri){
		$sys_editcontent.='22日:  '.$Y_ZD_22Ri.'=>'.$ZD_22Ri.';</br>';
	};
	if($Y_ZD_23Ri!=$ZD_23Ri){
		$sys_editcontent.='23日:  '.$Y_ZD_23Ri.'=>'.$ZD_23Ri.';</br>';
	};
	if($Y_ZD_24Ri!=$ZD_24Ri){
		$sys_editcontent.='24日:  '.$Y_ZD_24Ri.'=>'.$ZD_24Ri.';</br>';
	};
	if($Y_ZD_25Ri!=$ZD_25Ri){
		$sys_editcontent.='25日:  '.$Y_ZD_25Ri.'=>'.$ZD_25Ri.';</br>';
	};
	if($Y_ZD_26Ri!=$ZD_26Ri){
		$sys_editcontent.='26日:  '.$Y_ZD_26Ri.'=>'.$ZD_26Ri.';</br>';
	};
	if($Y_ZD_27Ri!=$ZD_27Ri){
		$sys_editcontent.='27日:  '.$Y_ZD_27Ri.'=>'.$ZD_27Ri.';</br>';
	};
	if($Y_ZD_28Ri!=$ZD_28Ri){
		$sys_editcontent.='28日:  '.$Y_ZD_28Ri.'=>'.$ZD_28Ri.';</br>';
	};
	if($Y_ZD_29Ri!=$ZD_29Ri){
		$sys_editcontent.='29日:  '.$Y_ZD_29Ri.'=>'.$ZD_29Ri.';</br>';
	};
	if($Y_ZD_30Ri!=$ZD_30Ri){
		$sys_editcontent.='30日:  '.$Y_ZD_30Ri.'=>'.$ZD_30Ri.';</br>';
	};
	if($Y_ZD_31Ri!=$ZD_31Ri){
		$sys_editcontent.='31日:  '.$Y_ZD_31Ri.'=>'.$ZD_31Ri.';</br>';
	};
	if($Y_ZD_GongJiTian!=$ZD_GongJiTian){
		$sys_editcontent.='共计（天）:  '.$Y_ZD_GongJiTian.'=>'.$ZD_GongJiTian.';</br>';
	};
	if($Y_ZD_ChuChaBuTie!=$ZD_ChuChaBuTie){
		$sys_editcontent.='出差补贴:  '.$Y_ZD_ChuChaBuTie.'=>'.$ZD_ChuChaBuTie.';</br>';
	};
	if($Y_ZD_BeiZhu!=$ZD_BeiZhu){
		$sys_editcontent.='备注:  '.$Y_ZD_BeiZhu.'=>'.$ZD_BeiZhu.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'505','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(505,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(505,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
