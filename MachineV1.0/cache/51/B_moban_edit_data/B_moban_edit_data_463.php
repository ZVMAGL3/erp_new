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
	
		include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Connadmin.php";
		global $strmk_id,$Connadmin,$const_q_xiug,$const_id_login,$bh,$hy,$SYS_UserName,$const_id_fz,$const_id_bumen;
		
		
if ( $const_q_xiug >= 0 ) { //有修改权限时
    if( isset($_POST["SYS_YongHuMing"]) ){$SYS_YongHuMing=$_POST["SYS_YongHuMing"];}else{$SYS_YongHuMing='';};       //用户名
    if( isset($_POST["SYS_ShouJi"]) ){$SYS_ShouJi=$_POST["SYS_ShouJi"];}else{$SYS_ShouJi='';};       //手机
    if( isset($_POST["SYS_SuoShuGongSi"]) ){$SYS_SuoShuGongSi=$_POST["SYS_SuoShuGongSi"];}else{$SYS_SuoShuGongSi='';};       //所属公司
    if( isset($_POST["SYS_IPDiZhi"]) ){$SYS_IPDiZhi=$_POST["SYS_IPDiZhi"];}else{$SYS_IPDiZhi='';};       //IP地址
    if( isset($_POST["SYS_QuanXian"]) ){$SYS_QuanXian=$_POST["SYS_QuanXian"];}else{$SYS_QuanXian='';};       //职位ID
    if( isset($_POST["SYS_QuanXian_Name"]) ){$SYS_QuanXian_Name=$_POST["SYS_QuanXian_Name"];}else{$SYS_QuanXian_Name='';};       //职位名称
    if( isset($_POST["SYS_DiZhi"]) ){$SYS_DiZhi=$_POST["SYS_DiZhi"];}else{$SYS_DiZhi='';};       //地址
    if( isset($_POST["SYS_HTTP_REFERER"]) ){$SYS_HTTP_REFERER=$_POST["SYS_HTTP_REFERER"];}else{$SYS_HTTP_REFERER='';};       //来路网址
    if( isset($_POST["SYS_PC_Mobile"]) ){$SYS_PC_Mobile=$_POST["SYS_PC_Mobile"];}else{$SYS_PC_Mobile='';};       //设备

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `msc_yonghudenglujilu`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Connadmin, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_SYS_YongHuMing=$row2['SYS_YongHuMing'];
    $Y_SYS_ShouJi=$row2['SYS_ShouJi'];
    $Y_SYS_SuoShuGongSi=$row2['SYS_SuoShuGongSi'];
    $Y_SYS_IPDiZhi=$row2['SYS_IPDiZhi'];
    $Y_SYS_QuanXian=$row2['SYS_QuanXian'];
    $Y_SYS_QuanXian_Name=$row2['SYS_QuanXian_Name'];
    $Y_SYS_DiZhi=$row2['SYS_DiZhi'];
    $Y_SYS_HTTP_REFERER=$row2['SYS_HTTP_REFERER'];
    $Y_SYS_PC_Mobile=$row2['SYS_PC_Mobile'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `msc_yonghudenglujilu`  set `SYS_YongHuMing`='$SYS_YongHuMing',`SYS_ShouJi`='$SYS_ShouJi',`SYS_SuoShuGongSi`='$SYS_SuoShuGongSi',`SYS_IPDiZhi`='$SYS_IPDiZhi',`SYS_QuanXian`='$SYS_QuanXian',`SYS_QuanXian_Name`='$SYS_QuanXian_Name',`SYS_DiZhi`='$SYS_DiZhi',`SYS_HTTP_REFERER`='$SYS_HTTP_REFERER',`SYS_PC_Mobile`='$SYS_PC_Mobile',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Connadmin,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_SYS_YongHuMing!=$SYS_YongHuMing){
		$sys_editcontent.='用户名:  '.$Y_SYS_YongHuMing.'=>'.$SYS_YongHuMing.';</br>';
	};
	if($Y_SYS_ShouJi!=$SYS_ShouJi){
		$sys_editcontent.='手机:  '.$Y_SYS_ShouJi.'=>'.$SYS_ShouJi.';</br>';
	};
	if($Y_SYS_SuoShuGongSi!=$SYS_SuoShuGongSi){
		$sys_editcontent.='所属公司:  '.$Y_SYS_SuoShuGongSi.'=>'.$SYS_SuoShuGongSi.';</br>';
	};
	if($Y_SYS_IPDiZhi!=$SYS_IPDiZhi){
		$sys_editcontent.='IP地址:  '.$Y_SYS_IPDiZhi.'=>'.$SYS_IPDiZhi.';</br>';
	};
	if($Y_SYS_QuanXian!=$SYS_QuanXian){
		$sys_editcontent.='职位ID:  '.$Y_SYS_QuanXian.'=>'.$SYS_QuanXian.';</br>';
	};
	if($Y_SYS_QuanXian_Name!=$SYS_QuanXian_Name){
		$sys_editcontent.='职位名称:  '.$Y_SYS_QuanXian_Name.'=>'.$SYS_QuanXian_Name.';</br>';
	};
	if($Y_SYS_DiZhi!=$SYS_DiZhi){
		$sys_editcontent.='地址:  '.$Y_SYS_DiZhi.'=>'.$SYS_DiZhi.';</br>';
	};
	if($Y_SYS_HTTP_REFERER!=$SYS_HTTP_REFERER){
		$sys_editcontent.='来路网址:  '.$Y_SYS_HTTP_REFERER.'=>'.$SYS_HTTP_REFERER.';</br>';
	};
	if($Y_SYS_PC_Mobile!=$SYS_PC_Mobile){
		$sys_editcontent.='设备:  '.$Y_SYS_PC_Mobile.'=>'.$SYS_PC_Mobile.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'463','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(463,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(463,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Connadmin ); //关闭数据库
?>
