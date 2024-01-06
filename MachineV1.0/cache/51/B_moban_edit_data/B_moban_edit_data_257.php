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
    if( isset($_POST["sys_q_fanwei"]) ){$sys_q_fanwei=$_POST["sys_q_fanwei"];}else{$sys_q_fanwei='';};       //管辖范围

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `msc_zhiwei`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Connadmin, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_sys_q_fanwei=$row2['sys_q_fanwei'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `msc_zhiwei`  set `sys_q_fanwei`='$sys_q_fanwei',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Connadmin,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_sys_q_fanwei!=$sys_q_fanwei){
		$sys_editcontent.='管辖范围:  '.$Y_sys_q_fanwei.'=>'.$sys_q_fanwei.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'257','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(257,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(257,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Connadmin ); //关闭数据库
?>
