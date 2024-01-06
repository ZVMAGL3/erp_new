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
    if( isset($_POST["ZD_XingBie"]) ){$ZD_XingBie=$_POST["ZD_XingBie"];}else{$ZD_XingBie='';};       //性别
    if( isset($_POST["ZD_ShenFenZhengHao"]) ){$ZD_ShenFenZhengHao=$_POST["ZD_ShenFenZhengHao"];}else{$ZD_ShenFenZhengHao='';};       //身份证号
    if( isset($_POST["ZD_QiShiGongZuoShiJian"]) ){$ZD_QiShiGongZuoShiJian=$_POST["ZD_QiShiGongZuoShiJian"];}else{$ZD_QiShiGongZuoShiJian='';};       //起始工作时间
    if( isset($_POST["ZD_SuoJieChuLaoDongHeTongQiXian"]) ){$ZD_SuoJieChuLaoDongHeTongQiXian=$_POST["ZD_SuoJieChuLaoDongHeTongQiXian"];}else{$ZD_SuoJieChuLaoDongHeTongQiXian='';};       //所解除劳动合同期限
    if( isset($_POST["ZD_LiZhiYuanYin"]) ){$ZD_LiZhiYuanYin=$_POST["ZD_LiZhiYuanYin"];}else{$ZD_LiZhiYuanYin='';};       //离职原因
    if( isset($_POST["ZD_JieChuLaoDongHeTongShiJian"]) ){$ZD_JieChuLaoDongHeTongShiJian=$_POST["ZD_JieChuLaoDongHeTongShiJian"];}else{$ZD_JieChuLaoDongHeTongShiJian='';};       //解除劳动合同时间
    if( isset($_POST["ZD_LaoDongZheQianZi"]) ){$ZD_LaoDongZheQianZi=$_POST["ZD_LaoDongZheQianZi"];}else{$ZD_LaoDongZheQianZi='';};       //劳动者签字

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_JieChuLaoDongHeTongZhengMingShu`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_XingMing=$row2['ZD_XingMing'];
    $Y_ZD_XingBie=$row2['ZD_XingBie'];
    $Y_ZD_ShenFenZhengHao=$row2['ZD_ShenFenZhengHao'];
    $Y_ZD_QiShiGongZuoShiJian=$row2['ZD_QiShiGongZuoShiJian'];
    $Y_ZD_SuoJieChuLaoDongHeTongQiXian=$row2['ZD_SuoJieChuLaoDongHeTongQiXian'];
    $Y_ZD_LiZhiYuanYin=$row2['ZD_LiZhiYuanYin'];
    $Y_ZD_JieChuLaoDongHeTongShiJian=$row2['ZD_JieChuLaoDongHeTongShiJian'];
    $Y_ZD_LaoDongZheQianZi=$row2['ZD_LaoDongZheQianZi'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_JieChuLaoDongHeTongZhengMingShu`  set `ZD_XingMing`='$ZD_XingMing',`ZD_XingBie`='$ZD_XingBie',`ZD_ShenFenZhengHao`='$ZD_ShenFenZhengHao',`ZD_QiShiGongZuoShiJian`='$ZD_QiShiGongZuoShiJian',`ZD_SuoJieChuLaoDongHeTongQiXian`='$ZD_SuoJieChuLaoDongHeTongQiXian',`ZD_LiZhiYuanYin`='$ZD_LiZhiYuanYin',`ZD_JieChuLaoDongHeTongShiJian`='$ZD_JieChuLaoDongHeTongShiJian',`ZD_LaoDongZheQianZi`='$ZD_LaoDongZheQianZi',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_XingMing!=$ZD_XingMing){
		$sys_editcontent.='姓名:  '.$Y_ZD_XingMing.'=>'.$ZD_XingMing.';</br>';
	};
	if($Y_ZD_XingBie!=$ZD_XingBie){
		$sys_editcontent.='性别:  '.$Y_ZD_XingBie.'=>'.$ZD_XingBie.';</br>';
	};
	if($Y_ZD_ShenFenZhengHao!=$ZD_ShenFenZhengHao){
		$sys_editcontent.='身份证号:  '.$Y_ZD_ShenFenZhengHao.'=>'.$ZD_ShenFenZhengHao.';</br>';
	};
	if($Y_ZD_QiShiGongZuoShiJian!=$ZD_QiShiGongZuoShiJian){
		$sys_editcontent.='起始工作时间:  '.$Y_ZD_QiShiGongZuoShiJian.'=>'.$ZD_QiShiGongZuoShiJian.';</br>';
	};
	if($Y_ZD_SuoJieChuLaoDongHeTongQiXian!=$ZD_SuoJieChuLaoDongHeTongQiXian){
		$sys_editcontent.='所解除劳动合同期限:  '.$Y_ZD_SuoJieChuLaoDongHeTongQiXian.'=>'.$ZD_SuoJieChuLaoDongHeTongQiXian.';</br>';
	};
	if($Y_ZD_LiZhiYuanYin!=$ZD_LiZhiYuanYin){
		$sys_editcontent.='离职原因:  '.$Y_ZD_LiZhiYuanYin.'=>'.$ZD_LiZhiYuanYin.';</br>';
	};
	if($Y_ZD_JieChuLaoDongHeTongShiJian!=$ZD_JieChuLaoDongHeTongShiJian){
		$sys_editcontent.='解除劳动合同时间:  '.$Y_ZD_JieChuLaoDongHeTongShiJian.'=>'.$ZD_JieChuLaoDongHeTongShiJian.';</br>';
	};
	if($Y_ZD_LaoDongZheQianZi!=$ZD_LaoDongZheQianZi){
		$sys_editcontent.='劳动者签字:  '.$Y_ZD_LaoDongZheQianZi.'=>'.$ZD_LaoDongZheQianZi.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'503','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(503,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(503,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
