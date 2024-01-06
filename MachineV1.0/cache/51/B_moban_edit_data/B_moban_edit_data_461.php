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
    if( isset($_POST["ZD_GongSiMingChen"]) ){$ZD_GongSiMingChen=$_POST["ZD_GongSiMingChen"];}else{$ZD_GongSiMingChen='';};       //公司名称
    if( isset($_POST["ZD_GongSiDiZhi"]) ){$ZD_GongSiDiZhi=$_POST["ZD_GongSiDiZhi"];}else{$ZD_GongSiDiZhi='';};       //公司地址
    if( isset($_POST["ZD_GongSiDianHua"]) ){$ZD_GongSiDianHua=$_POST["ZD_GongSiDianHua"];}else{$ZD_GongSiDianHua='';};       //公司电话
    if( isset($_POST["ZD_ZongJingLi"]) ){$ZD_ZongJingLi=$_POST["ZD_ZongJingLi"];}else{$ZD_ZongJingLi='';};       //总经理
    if( isset($_POST["ZD_GuanLiZheDaiBiao"]) ){$ZD_GuanLiZheDaiBiao=$_POST["ZD_GuanLiZheDaiBiao"];}else{$ZD_GuanLiZheDaiBiao='';};       //管理者代表
    if( isset($_POST["ZD_AnQuanShiWuDaiBiao"]) ){$ZD_AnQuanShiWuDaiBiao=$_POST["ZD_AnQuanShiWuDaiBiao"];}else{$ZD_AnQuanShiWuDaiBiao='';};       //安全事务代表
    if( isset($_POST["ZD_ShouCeBianZhiRen"]) ){$ZD_ShouCeBianZhiRen=$_POST["ZD_ShouCeBianZhiRen"];}else{$ZD_ShouCeBianZhiRen='';};       //手册编制人
    if( isset($_POST["sys_XuanYongMoBan"]) ){$sys_XuanYongMoBan=$_POST["sys_XuanYongMoBan"];}else{$sys_XuanYongMoBan='';};       //模版上传
    if( isset($_POST["ZD_YinYongMoBan"]) ){$ZD_YinYongMoBan=$_POST["ZD_YinYongMoBan"];}else{$ZD_YinYongMoBan='';};       //引用模版

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_WenJianZiDongHua`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_GongSiMingChen=$row2['ZD_GongSiMingChen'];
    $Y_ZD_GongSiDiZhi=$row2['ZD_GongSiDiZhi'];
    $Y_ZD_GongSiDianHua=$row2['ZD_GongSiDianHua'];
    $Y_ZD_ZongJingLi=$row2['ZD_ZongJingLi'];
    $Y_ZD_GuanLiZheDaiBiao=$row2['ZD_GuanLiZheDaiBiao'];
    $Y_ZD_AnQuanShiWuDaiBiao=$row2['ZD_AnQuanShiWuDaiBiao'];
    $Y_ZD_ShouCeBianZhiRen=$row2['ZD_ShouCeBianZhiRen'];
    $Y_sys_XuanYongMoBan=$row2['sys_XuanYongMoBan'];
    $Y_ZD_YinYongMoBan=$row2['ZD_YinYongMoBan'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_WenJianZiDongHua`  set `ZD_GongSiMingChen`='$ZD_GongSiMingChen',`ZD_GongSiDiZhi`='$ZD_GongSiDiZhi',`ZD_GongSiDianHua`='$ZD_GongSiDianHua',`ZD_ZongJingLi`='$ZD_ZongJingLi',`ZD_GuanLiZheDaiBiao`='$ZD_GuanLiZheDaiBiao',`ZD_AnQuanShiWuDaiBiao`='$ZD_AnQuanShiWuDaiBiao',`ZD_ShouCeBianZhiRen`='$ZD_ShouCeBianZhiRen',`sys_XuanYongMoBan`='$sys_XuanYongMoBan',`ZD_YinYongMoBan`='$ZD_YinYongMoBan',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_GongSiMingChen!=$ZD_GongSiMingChen){
		$sys_editcontent.='公司名称:  '.$Y_ZD_GongSiMingChen.'=>'.$ZD_GongSiMingChen.';</br>';
	};
	if($Y_ZD_GongSiDiZhi!=$ZD_GongSiDiZhi){
		$sys_editcontent.='公司地址:  '.$Y_ZD_GongSiDiZhi.'=>'.$ZD_GongSiDiZhi.';</br>';
	};
	if($Y_ZD_GongSiDianHua!=$ZD_GongSiDianHua){
		$sys_editcontent.='公司电话:  '.$Y_ZD_GongSiDianHua.'=>'.$ZD_GongSiDianHua.';</br>';
	};
	if($Y_ZD_ZongJingLi!=$ZD_ZongJingLi){
		$sys_editcontent.='总经理:  '.$Y_ZD_ZongJingLi.'=>'.$ZD_ZongJingLi.';</br>';
	};
	if($Y_ZD_GuanLiZheDaiBiao!=$ZD_GuanLiZheDaiBiao){
		$sys_editcontent.='管理者代表:  '.$Y_ZD_GuanLiZheDaiBiao.'=>'.$ZD_GuanLiZheDaiBiao.';</br>';
	};
	if($Y_ZD_AnQuanShiWuDaiBiao!=$ZD_AnQuanShiWuDaiBiao){
		$sys_editcontent.='安全事务代表:  '.$Y_ZD_AnQuanShiWuDaiBiao.'=>'.$ZD_AnQuanShiWuDaiBiao.';</br>';
	};
	if($Y_ZD_ShouCeBianZhiRen!=$ZD_ShouCeBianZhiRen){
		$sys_editcontent.='手册编制人:  '.$Y_ZD_ShouCeBianZhiRen.'=>'.$ZD_ShouCeBianZhiRen.';</br>';
	};
	if($Y_sys_XuanYongMoBan!=$sys_XuanYongMoBan){
		$sys_editcontent.='模版上传:  '.$Y_sys_XuanYongMoBan.'=>'.$sys_XuanYongMoBan.';</br>';
	};
	if($Y_ZD_YinYongMoBan!=$ZD_YinYongMoBan){
		$sys_editcontent.='引用模版:  '.$Y_ZD_YinYongMoBan.'=>'.$ZD_YinYongMoBan.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'461','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(461,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(461,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
