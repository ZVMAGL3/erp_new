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
    if( isset($_POST["sys_re_id"]) ){$sys_re_id=$_POST["sys_re_id"];}else{$sys_re_id='';};       //对应表id
    if( isset($_POST["sys_edit_id"]) ){$sys_edit_id=$_POST["sys_edit_id"];}else{$sys_edit_id='';};       //记录ID
    if( isset($_POST["sys_editcontent"]) ){$sys_editcontent=$_POST["sys_editcontent"];}else{$sys_editcontent='';};       //修改内容

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `sys_xiuguaijilu`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_sys_re_id=$row2['sys_re_id'];
    $Y_sys_edit_id=$row2['sys_edit_id'];
    $Y_sys_editcontent=$row2['sys_editcontent'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `sys_xiuguaijilu`  set `sys_re_id`='$sys_re_id',`sys_edit_id`='$sys_edit_id',`sys_editcontent`='$sys_editcontent',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_sys_re_id!=$sys_re_id){
		$sys_editcontent.='对应表id:  '.$Y_sys_re_id.'=>'.$sys_re_id.';</br>';
	};
	if($Y_sys_edit_id!=$sys_edit_id){
		$sys_editcontent.='记录ID:  '.$Y_sys_edit_id.'=>'.$sys_edit_id.';</br>';
	};
	if($Y_sys_editcontent!=$sys_editcontent){
		$sys_editcontent.='修改内容:  '.$Y_sys_editcontent.'=>'.$sys_editcontent.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'368','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(368,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(368,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
