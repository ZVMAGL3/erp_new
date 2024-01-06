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
    if( isset($_POST["ZD_YuanGongXingMing"]) ){$ZD_YuanGongXingMing=$_POST["ZD_YuanGongXingMing"];}else{$ZD_YuanGongXingMing='';};       //员工姓名
    if( isset($_POST["ZD_JiangLiFenLei"]) ){$ZD_JiangLiFenLei=$_POST["ZD_JiangLiFenLei"];}else{$ZD_JiangLiFenLei='';};       //奖励分类
    if( isset($_POST["ZD_JiangLiHuoBi"]) ){$ZD_JiangLiHuoBi=$_POST["ZD_JiangLiHuoBi"];}else{$ZD_JiangLiHuoBi='';};       //奖励货币
    if( isset($_POST["ZD_JiangLiJiFen"]) ){$ZD_JiangLiJiFen=$_POST["ZD_JiangLiJiFen"];}else{$ZD_JiangLiJiFen='';};       //奖励积分
    if( isset($_POST["ZD_ChuFaHuoBi"]) ){$ZD_ChuFaHuoBi=$_POST["ZD_ChuFaHuoBi"];}else{$ZD_ChuFaHuoBi='';};       //处罚货币
    if( isset($_POST["ZD_ChuFaJiFen"]) ){$ZD_ChuFaJiFen=$_POST["ZD_ChuFaJiFen"];}else{$ZD_ChuFaJiFen='';};       //处罚积分

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_GongZiMingXi`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_YuanGongXingMing=$row2['ZD_YuanGongXingMing'];
    $Y_ZD_JiangLiFenLei=$row2['ZD_JiangLiFenLei'];
    $Y_ZD_JiangLiHuoBi=$row2['ZD_JiangLiHuoBi'];
    $Y_ZD_JiangLiJiFen=$row2['ZD_JiangLiJiFen'];
    $Y_ZD_ChuFaHuoBi=$row2['ZD_ChuFaHuoBi'];
    $Y_ZD_ChuFaJiFen=$row2['ZD_ChuFaJiFen'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_GongZiMingXi`  set `ZD_YuanGongXingMing`='$ZD_YuanGongXingMing',`ZD_JiangLiFenLei`='$ZD_JiangLiFenLei',`ZD_JiangLiHuoBi`='$ZD_JiangLiHuoBi',`ZD_JiangLiJiFen`='$ZD_JiangLiJiFen',`ZD_ChuFaHuoBi`='$ZD_ChuFaHuoBi',`ZD_ChuFaJiFen`='$ZD_ChuFaJiFen',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_YuanGongXingMing!=$ZD_YuanGongXingMing){
		$sys_editcontent.='员工姓名:  '.$Y_ZD_YuanGongXingMing.'=>'.$ZD_YuanGongXingMing.';</br>';
	};
	if($Y_ZD_JiangLiFenLei!=$ZD_JiangLiFenLei){
		$sys_editcontent.='奖励分类:  '.$Y_ZD_JiangLiFenLei.'=>'.$ZD_JiangLiFenLei.';</br>';
	};
	if($Y_ZD_JiangLiHuoBi!=$ZD_JiangLiHuoBi){
		$sys_editcontent.='奖励货币:  '.$Y_ZD_JiangLiHuoBi.'=>'.$ZD_JiangLiHuoBi.';</br>';
	};
	if($Y_ZD_JiangLiJiFen!=$ZD_JiangLiJiFen){
		$sys_editcontent.='奖励积分:  '.$Y_ZD_JiangLiJiFen.'=>'.$ZD_JiangLiJiFen.';</br>';
	};
	if($Y_ZD_ChuFaHuoBi!=$ZD_ChuFaHuoBi){
		$sys_editcontent.='处罚货币:  '.$Y_ZD_ChuFaHuoBi.'=>'.$ZD_ChuFaHuoBi.';</br>';
	};
	if($Y_ZD_ChuFaJiFen!=$ZD_ChuFaJiFen){
		$sys_editcontent.='处罚积分:  '.$Y_ZD_ChuFaJiFen.'=>'.$ZD_ChuFaJiFen.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'294','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(294,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(294,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
