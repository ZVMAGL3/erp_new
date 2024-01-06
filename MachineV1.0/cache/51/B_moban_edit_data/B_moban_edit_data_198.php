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
    if( isset($_POST["sys_card"]) ){$sys_card=$_POST["sys_card"];}else{$sys_card='';};       //记录名称
    if( isset($_POST["mdb_name_SYS"]) ){$mdb_name_SYS=$_POST["mdb_name_SYS"];}else{$mdb_name_SYS='';};       //数据表名
    if( isset($_POST["Id_MenuBigClass"]) ){$Id_MenuBigClass=$_POST["Id_MenuBigClass"];}else{$Id_MenuBigClass='';};       //大类菜单
    if( isset($_POST["banben"]) ){$banben=$_POST["banben"];}else{$banben='';};       //版本
    if( isset($_POST["xiugaicishu"]) ){$xiugaicishu=$_POST["xiugaicishu"];}else{$xiugaicishu='';};       //修改次数
    if( isset($_POST["ul_row_height"]) ){$ul_row_height=$_POST["ul_row_height"];}else{$ul_row_height='';};       //行高

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `sys_jlmb`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_sys_card=$row2['sys_card'];
    $Y_mdb_name_SYS=$row2['mdb_name_SYS'];
    $Y_Id_MenuBigClass=$row2['Id_MenuBigClass'];
    $Y_banben=$row2['banben'];
    $Y_xiugaicishu=$row2['xiugaicishu'];
    $Y_ul_row_height=$row2['ul_row_height'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `sys_jlmb`  set `sys_card`='$sys_card',`mdb_name_SYS`='$mdb_name_SYS',`Id_MenuBigClass`='$Id_MenuBigClass',`banben`='$banben',`xiugaicishu`='$xiugaicishu',`ul_row_height`='$ul_row_height',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_sys_card!=$sys_card){
		$sys_editcontent.='记录名称:  '.$Y_sys_card.'=>'.$sys_card.';</br>';
	};
	if($Y_mdb_name_SYS!=$mdb_name_SYS){
		$sys_editcontent.='数据表名:  '.$Y_mdb_name_SYS.'=>'.$mdb_name_SYS.';</br>';
	};
	if($Y_Id_MenuBigClass!=$Id_MenuBigClass){
		$sys_editcontent.='大类菜单:  '.$Y_Id_MenuBigClass.'=>'.$Id_MenuBigClass.';</br>';
	};
	if($Y_banben!=$banben){
		$sys_editcontent.='版本:  '.$Y_banben.'=>'.$banben.';</br>';
	};
	if($Y_xiugaicishu!=$xiugaicishu){
		$sys_editcontent.='修改次数:  '.$Y_xiugaicishu.'=>'.$xiugaicishu.';</br>';
	};
	if($Y_ul_row_height!=$ul_row_height){
		$sys_editcontent.='行高:  '.$Y_ul_row_height.'=>'.$ul_row_height.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'198','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(198,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(198,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
