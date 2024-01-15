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
	
		include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_conn.php";
		include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_connadmin.php";
		global $strmk_id,$const_q_xiug,$const_id_login,$bh,$hy,$SYS_UserName,$const_id_fz,$const_id_bumen;
		
		
if ( $const_q_xiug >= 0 ) { //有修改权限时
    if( isset($_POST["user_id"]) ){$user_id=$_POST["user_id"];}else{$user_id='';};       //用户ID
    if( isset($_POST["state"]) ){$state=$_POST["state"];}else{$state='';};       //状态
    if( isset($_POST["SYS_GongHao"]) ){$SYS_GongHao=$_POST["SYS_GongHao"];}else{$SYS_GongHao='';};       //工号
    if( isset($_POST["zhiwei_id"]) ){$zhiwei_id=$_POST["zhiwei_id"];}else{$zhiwei_id='';};       //职位ID
    if( isset($_POST["add_time"]) ){$add_time=$_POST["add_time"];}else{$add_time='';};       //添加时间
    if( isset($_POST["new_time"]) ){$new_time=$_POST["new_time"];}else{$new_time='';};       //上次更新时间
    if( isset($_POST["Remark"]) ){$Remark=$_POST["Remark"];}else{$Remark='';};       //备注

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `msc_user_hy`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Connadmin, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_user_id=$row2['user_id'];
    $Y_state=$row2['state'];
    $Y_SYS_GongHao=$row2['SYS_GongHao'];
    $Y_zhiwei_id=$row2['zhiwei_id'];
    $Y_add_time=$row2['add_time'];
    $Y_new_time=$row2['new_time'];
    $Y_Remark=$row2['Remark'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `msc_user_hy`  set `user_id`='$user_id',`state`='$state',`SYS_GongHao`='$SYS_GongHao',`zhiwei_id`='$zhiwei_id',`add_time`='$add_time',`new_time`='$new_time',`Remark`='$Remark',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Connadmin,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_user_id!=$user_id){
		$sys_editcontent.='用户ID:  '.$Y_user_id.'=>'.$user_id.';</br>';
	};
	if($Y_state!=$state){
		$sys_editcontent.='状态:  '.$Y_state.'=>'.$state.';</br>';
	};
	if($Y_SYS_GongHao!=$SYS_GongHao){
		$sys_editcontent.='工号:  '.$Y_SYS_GongHao.'=>'.$SYS_GongHao.';</br>';
	};
	if($Y_zhiwei_id!=$zhiwei_id){
		$sys_editcontent.='职位ID:  '.$Y_zhiwei_id.'=>'.$zhiwei_id.';</br>';
	};
	if($Y_add_time!=$add_time){
		$sys_editcontent.='添加时间:  '.$Y_add_time.'=>'.$add_time.';</br>';
	};
	if($Y_new_time!=$new_time){
		$sys_editcontent.='上次更新时间:  '.$Y_new_time.'=>'.$new_time.';</br>';
	};
	if($Y_Remark!=$Remark){
		$sys_editcontent.='备注:  '.$Y_Remark.'=>'.$Remark.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'529','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(529,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(529,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Connadmin ); //关闭数据库
?>
