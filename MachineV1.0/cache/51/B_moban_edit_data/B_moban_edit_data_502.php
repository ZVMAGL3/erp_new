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
    if( isset($_POST["ZD_WenJianBianHao"]) ){$ZD_WenJianBianHao=$_POST["ZD_WenJianBianHao"];}else{$ZD_WenJianBianHao='';};       //文件编号
    if( isset($_POST["ZD_GaiJinWenTiDianMiaoShu"]) ){$ZD_GaiJinWenTiDianMiaoShu=$_POST["ZD_GaiJinWenTiDianMiaoShu"];}else{$ZD_GaiJinWenTiDianMiaoShu='';};       //改进问题点描述
    if( isset($_POST["ZD_XiuGaiWanCheng"]) ){$ZD_XiuGaiWanCheng=$_POST["ZD_XiuGaiWanCheng"];}else{$ZD_XiuGaiWanCheng='';};       //修改完成

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_XiTongGaiJin`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_WenJianBianHao=$row2['ZD_WenJianBianHao'];
    $Y_ZD_GaiJinWenTiDianMiaoShu=$row2['ZD_GaiJinWenTiDianMiaoShu'];
    $Y_ZD_XiuGaiWanCheng=$row2['ZD_XiuGaiWanCheng'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_XiTongGaiJin`  set `ZD_WenJianBianHao`='$ZD_WenJianBianHao',`ZD_GaiJinWenTiDianMiaoShu`='$ZD_GaiJinWenTiDianMiaoShu',`ZD_XiuGaiWanCheng`='$ZD_XiuGaiWanCheng',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_WenJianBianHao!=$ZD_WenJianBianHao){
		$sys_editcontent.='文件编号:  '.$Y_ZD_WenJianBianHao.'=>'.$ZD_WenJianBianHao.';</br>';
	};
	if($Y_ZD_GaiJinWenTiDianMiaoShu!=$ZD_GaiJinWenTiDianMiaoShu){
		$sys_editcontent.='改进问题点描述:  '.$Y_ZD_GaiJinWenTiDianMiaoShu.'=>'.$ZD_GaiJinWenTiDianMiaoShu.';</br>';
	};
	if($Y_ZD_XiuGaiWanCheng!=$ZD_XiuGaiWanCheng){
		$sys_editcontent.='修改完成:  '.$Y_ZD_XiuGaiWanCheng.'=>'.$ZD_XiuGaiWanCheng.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'502','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(502,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(502,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
