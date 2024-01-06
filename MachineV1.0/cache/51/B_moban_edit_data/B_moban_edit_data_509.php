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
    if( isset($_POST["ZD_NaRong"]) ){$ZD_NaRong=$_POST["ZD_NaRong"];}else{$ZD_NaRong='';};       //内容
    if( isset($_POST["ZD_RiQi"]) ){$ZD_RiQi=$_POST["ZD_RiQi"];}else{$ZD_RiQi='';};       //日期
    if( isset($_POST["ZD_KuaiDiMingChen"]) ){$ZD_KuaiDiMingChen=$_POST["ZD_KuaiDiMingChen"];}else{$ZD_KuaiDiMingChen='';};       //快递名称
    if( isset($_POST["ZD_KuaiDiDanHao"]) ){$ZD_KuaiDiDanHao=$_POST["ZD_KuaiDiDanHao"];}else{$ZD_KuaiDiDanHao='';};       //快递单号
    if( isset($_POST["ZD_GenZongQingKuang"]) ){$ZD_GenZongQingKuang=$_POST["ZD_GenZongQingKuang"];}else{$ZD_GenZongQingKuang='';};       //跟踪情况

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_KuaiDiShouFaDengJi`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_GongSiMingChen=$row2['ZD_GongSiMingChen'];
    $Y_ZD_NaRong=$row2['ZD_NaRong'];
    $Y_ZD_RiQi=$row2['ZD_RiQi'];
    $Y_ZD_KuaiDiMingChen=$row2['ZD_KuaiDiMingChen'];
    $Y_ZD_KuaiDiDanHao=$row2['ZD_KuaiDiDanHao'];
    $Y_ZD_GenZongQingKuang=$row2['ZD_GenZongQingKuang'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_KuaiDiShouFaDengJi`  set `ZD_GongSiMingChen`='$ZD_GongSiMingChen',`ZD_NaRong`='$ZD_NaRong',`ZD_RiQi`='$ZD_RiQi',`ZD_KuaiDiMingChen`='$ZD_KuaiDiMingChen',`ZD_KuaiDiDanHao`='$ZD_KuaiDiDanHao',`ZD_GenZongQingKuang`='$ZD_GenZongQingKuang',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_GongSiMingChen!=$ZD_GongSiMingChen){
		$sys_editcontent.='公司名称:  '.$Y_ZD_GongSiMingChen.'=>'.$ZD_GongSiMingChen.';</br>';
	};
	if($Y_ZD_NaRong!=$ZD_NaRong){
		$sys_editcontent.='内容:  '.$Y_ZD_NaRong.'=>'.$ZD_NaRong.';</br>';
	};
	if($Y_ZD_RiQi!=$ZD_RiQi){
		$sys_editcontent.='日期:  '.$Y_ZD_RiQi.'=>'.$ZD_RiQi.';</br>';
	};
	if($Y_ZD_KuaiDiMingChen!=$ZD_KuaiDiMingChen){
		$sys_editcontent.='快递名称:  '.$Y_ZD_KuaiDiMingChen.'=>'.$ZD_KuaiDiMingChen.';</br>';
	};
	if($Y_ZD_KuaiDiDanHao!=$ZD_KuaiDiDanHao){
		$sys_editcontent.='快递单号:  '.$Y_ZD_KuaiDiDanHao.'=>'.$ZD_KuaiDiDanHao.';</br>';
	};
	if($Y_ZD_GenZongQingKuang!=$ZD_GenZongQingKuang){
		$sys_editcontent.='跟踪情况:  '.$Y_ZD_GenZongQingKuang.'=>'.$ZD_GenZongQingKuang.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'509','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(509,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(509,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
