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
    if( isset($_POST["ZD_MenDianTuPian"]) ){$ZD_MenDianTuPian=$_POST["ZD_MenDianTuPian"];}else{$ZD_MenDianTuPian='';};       //门店图片
    if( isset($_POST["ZD_GongSi"]) ){$ZD_GongSi=$_POST["ZD_GongSi"];}else{$ZD_GongSi='';};       //公司
    if( isset($_POST["ZD_FaRen"]) ){$ZD_FaRen=$_POST["ZD_FaRen"];}else{$ZD_FaRen='';};       //法人
    if( isset($_POST["ZD_JianChen"]) ){$ZD_JianChen=$_POST["ZD_JianChen"];}else{$ZD_JianChen='';};       //简称
    if( isset($_POST["ZD_XingBie"]) ){$ZD_XingBie=$_POST["ZD_XingBie"];}else{$ZD_XingBie='';};       //性别
    if( isset($_POST["ZD_DianHua"]) ){$ZD_DianHua=$_POST["ZD_DianHua"];}else{$ZD_DianHua='';};       //电话
    if( isset($_POST["BeiZhu"]) ){$BeiZhu=$_POST["BeiZhu"];}else{$BeiZhu='';};       //备注
    if( isset($_POST["ZD_DiZhi"]) ){$ZD_DiZhi=$_POST["ZD_DiZhi"];}else{$ZD_DiZhi='';};       //地址
    if( isset($_POST["ZD_SheBaoRenShu"]) ){$ZD_SheBaoRenShu=$_POST["ZD_SheBaoRenShu"];}else{$ZD_SheBaoRenShu='';};       //社保人数
    if( isset($_POST["ZD_WeiXin"]) ){$ZD_WeiXin=$_POST["ZD_WeiXin"];}else{$ZD_WeiXin='';};       //微信
    if( isset($_POST["ZD_HeZuo"]) ){$ZD_HeZuo=$_POST["ZD_HeZuo"];}else{$ZD_HeZuo='';};       //合作
    if( isset($_POST["ZD_QuFang"]) ){$ZD_QuFang=$_POST["ZD_QuFang"];}else{$ZD_QuFang='';};       //去访
    if( isset($_POST["LaiFang"]) ){$LaiFang=$_POST["LaiFang"];}else{$LaiFang='';};       //来访
    if( isset($_POST["PeiXun"]) ){$PeiXun=$_POST["PeiXun"];}else{$PeiXun='';};       //培训
    if( isset($_POST["ZD_XiTong"]) ){$ZD_XiTong=$_POST["ZD_XiTong"];}else{$ZD_XiTong='';};       //系统
    if( isset($_POST["ZD_JiHuaBaiFang"]) ){$ZD_JiHuaBaiFang=$_POST["ZD_JiHuaBaiFang"];}else{$ZD_JiHuaBaiFang='';};       //计划拜访
    if( isset($_POST["ZD_ZhuYingYeWu"]) ){$ZD_ZhuYingYeWu=$_POST["ZD_ZhuYingYeWu"];}else{$ZD_ZhuYingYeWu='';};       //主营业务

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_HeZuoHuoBan`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_MenDianTuPian=$row2['ZD_MenDianTuPian'];
    $Y_ZD_GongSi=$row2['ZD_GongSi'];
    $Y_ZD_FaRen=$row2['ZD_FaRen'];
    $Y_ZD_JianChen=$row2['ZD_JianChen'];
    $Y_ZD_XingBie=$row2['ZD_XingBie'];
    $Y_ZD_DianHua=$row2['ZD_DianHua'];
    $Y_BeiZhu=$row2['BeiZhu'];
    $Y_ZD_DiZhi=$row2['ZD_DiZhi'];
    $Y_ZD_SheBaoRenShu=$row2['ZD_SheBaoRenShu'];
    $Y_ZD_WeiXin=$row2['ZD_WeiXin'];
    $Y_ZD_HeZuo=$row2['ZD_HeZuo'];
    $Y_ZD_QuFang=$row2['ZD_QuFang'];
    $Y_LaiFang=$row2['LaiFang'];
    $Y_PeiXun=$row2['PeiXun'];
    $Y_ZD_XiTong=$row2['ZD_XiTong'];
    $Y_ZD_JiHuaBaiFang=$row2['ZD_JiHuaBaiFang'];
    $Y_ZD_ZhuYingYeWu=$row2['ZD_ZhuYingYeWu'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_HeZuoHuoBan`  set `ZD_MenDianTuPian`='$ZD_MenDianTuPian',`ZD_GongSi`='$ZD_GongSi',`ZD_FaRen`='$ZD_FaRen',`ZD_JianChen`='$ZD_JianChen',`ZD_XingBie`='$ZD_XingBie',`ZD_DianHua`='$ZD_DianHua',`BeiZhu`='$BeiZhu',`ZD_DiZhi`='$ZD_DiZhi',`ZD_SheBaoRenShu`='$ZD_SheBaoRenShu',`ZD_WeiXin`='$ZD_WeiXin',`ZD_HeZuo`='$ZD_HeZuo',`ZD_QuFang`='$ZD_QuFang',`LaiFang`='$LaiFang',`PeiXun`='$PeiXun',`ZD_XiTong`='$ZD_XiTong',`ZD_JiHuaBaiFang`='$ZD_JiHuaBaiFang',`ZD_ZhuYingYeWu`='$ZD_ZhuYingYeWu',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_MenDianTuPian!=$ZD_MenDianTuPian){
		$sys_editcontent.='门店图片:  '.$Y_ZD_MenDianTuPian.'=>'.$ZD_MenDianTuPian.';</br>';
	};
	if($Y_ZD_GongSi!=$ZD_GongSi){
		$sys_editcontent.='公司:  '.$Y_ZD_GongSi.'=>'.$ZD_GongSi.';</br>';
	};
	if($Y_ZD_FaRen!=$ZD_FaRen){
		$sys_editcontent.='法人:  '.$Y_ZD_FaRen.'=>'.$ZD_FaRen.';</br>';
	};
	if($Y_ZD_JianChen!=$ZD_JianChen){
		$sys_editcontent.='简称:  '.$Y_ZD_JianChen.'=>'.$ZD_JianChen.';</br>';
	};
	if($Y_ZD_XingBie!=$ZD_XingBie){
		$sys_editcontent.='性别:  '.$Y_ZD_XingBie.'=>'.$ZD_XingBie.';</br>';
	};
	if($Y_ZD_DianHua!=$ZD_DianHua){
		$sys_editcontent.='电话:  '.$Y_ZD_DianHua.'=>'.$ZD_DianHua.';</br>';
	};
	if($Y_BeiZhu!=$BeiZhu){
		$sys_editcontent.='备注:  '.$Y_BeiZhu.'=>'.$BeiZhu.';</br>';
	};
	if($Y_ZD_DiZhi!=$ZD_DiZhi){
		$sys_editcontent.='地址:  '.$Y_ZD_DiZhi.'=>'.$ZD_DiZhi.';</br>';
	};
	if($Y_ZD_SheBaoRenShu!=$ZD_SheBaoRenShu){
		$sys_editcontent.='社保人数:  '.$Y_ZD_SheBaoRenShu.'=>'.$ZD_SheBaoRenShu.';</br>';
	};
	if($Y_ZD_WeiXin!=$ZD_WeiXin){
		$sys_editcontent.='微信:  '.$Y_ZD_WeiXin.'=>'.$ZD_WeiXin.';</br>';
	};
	if($Y_ZD_HeZuo!=$ZD_HeZuo){
		$sys_editcontent.='合作:  '.$Y_ZD_HeZuo.'=>'.$ZD_HeZuo.';</br>';
	};
	if($Y_ZD_QuFang!=$ZD_QuFang){
		$sys_editcontent.='去访:  '.$Y_ZD_QuFang.'=>'.$ZD_QuFang.';</br>';
	};
	if($Y_LaiFang!=$LaiFang){
		$sys_editcontent.='来访:  '.$Y_LaiFang.'=>'.$LaiFang.';</br>';
	};
	if($Y_PeiXun!=$PeiXun){
		$sys_editcontent.='培训:  '.$Y_PeiXun.'=>'.$PeiXun.';</br>';
	};
	if($Y_ZD_XiTong!=$ZD_XiTong){
		$sys_editcontent.='系统:  '.$Y_ZD_XiTong.'=>'.$ZD_XiTong.';</br>';
	};
	if($Y_ZD_JiHuaBaiFang!=$ZD_JiHuaBaiFang){
		$sys_editcontent.='计划拜访:  '.$Y_ZD_JiHuaBaiFang.'=>'.$ZD_JiHuaBaiFang.';</br>';
	};
	if($Y_ZD_ZhuYingYeWu!=$ZD_ZhuYingYeWu){
		$sys_editcontent.='主营业务:  '.$Y_ZD_ZhuYingYeWu.'=>'.$ZD_ZhuYingYeWu.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'223','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(223,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(223,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
