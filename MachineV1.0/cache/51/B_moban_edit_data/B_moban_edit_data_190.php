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
		global $strmk_id,$sys_q_xiug,$sys_id_login,$bh,$hy,$SYS_UserName,$sys_id_fz,$bumen_id;
		
		
if ( $sys_q_xiug >= 0 ) { //有修改权限时
    if( isset($_POST["username"]) ){$username=$_POST["username"];}else{$username='';};       //username
    if( isset($_POST["DianHua3"]) ){$DianHua3=$_POST["DianHua3"];}else{$DianHua3='';};       //DianHua3
    if( isset($_POST["startdate"]) ){$startdate=$_POST["startdate"];}else{$startdate='';};       //startdate
    if( isset($_POST["enddate"]) ){$enddate=$_POST["enddate"];}else{$enddate='';};       //enddate
    if( isset($_POST["beizhu"]) ){$beizhu=$_POST["beizhu"];}else{$beizhu='';};       //beizhu
    if( isset($_POST["qq"]) ){$qq=$_POST["qq"];}else{$qq='';};       //qq
    if( isset($_POST["sys_id_zu"]) ){$sys_id_zu=$_POST["sys_id_zu"];}else{$sys_id_zu='';};       //分类
    if( isset($_POST["card"]) ){$card=$_POST["card"];}else{$card='';};       //card
    if( isset($_POST["bianhao"]) ){$bianhao=$_POST["bianhao"];}else{$bianhao='';};       //bianhao
    if( isset($_POST["sys_shenpi"]) ){$sys_shenpi=$_POST["sys_shenpi"];}else{$sys_shenpi='';};       //审核
    if( isset($_POST["sys_shenpi_all"]) ){$sys_shenpi_all=$_POST["sys_shenpi_all"];}else{$sys_shenpi_all='';};       //批准
    if( isset($_POST["sys_login"]) ){$sys_login=$_POST["sys_login"];}else{$sys_login='';};       //编制人
    if( isset($_POST["sys_chaosong"]) ){$sys_chaosong=$_POST["sys_chaosong"];}else{$sys_chaosong='';};       //经办人
    if( isset($_POST["sys_paixu"]) ){$sys_paixu=$_POST["sys_paixu"];}else{$sys_paixu='';};       //排序

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_ZongGuoChengQingDan`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_username=$row2['username'];
    $Y_DianHua3=$row2['DianHua3'];
    $Y_startdate=$row2['startdate'];
    $Y_enddate=$row2['enddate'];
    $Y_beizhu=$row2['beizhu'];
    $Y_qq=$row2['qq'];
    $Y_sys_id_zu=$row2['sys_id_zu'];
    $Y_card=$row2['card'];
    $Y_bianhao=$row2['bianhao'];
    $Y_sys_shenpi=$row2['sys_shenpi'];
    $Y_sys_shenpi_all=$row2['sys_shenpi_all'];
    $Y_sys_login=$row2['sys_login'];
    $Y_sys_chaosong=$row2['sys_chaosong'];
    $Y_sys_paixu=$row2['sys_paixu'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_ZongGuoChengQingDan`  set `username`='$username',`DianHua3`='$DianHua3',`startdate`='$startdate',`enddate`='$enddate',`beizhu`='$beizhu',`qq`='$qq',`sys_id_zu`='$sys_id_zu',`card`='$card',`bianhao`='$bianhao',`sys_shenpi`='$sys_shenpi',`sys_shenpi_all`='$sys_shenpi_all',`sys_login`='$sys_login',`sys_chaosong`='$sys_chaosong',`sys_paixu`='$sys_paixu',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_username!=$username){
		$sys_editcontent.='username:  '.$Y_username.'=>'.$username.';</br>';
	};
	if($Y_DianHua3!=$DianHua3){
		$sys_editcontent.='DianHua3:  '.$Y_DianHua3.'=>'.$DianHua3.';</br>';
	};
	if($Y_startdate!=$startdate){
		$sys_editcontent.='startdate:  '.$Y_startdate.'=>'.$startdate.';</br>';
	};
	if($Y_enddate!=$enddate){
		$sys_editcontent.='enddate:  '.$Y_enddate.'=>'.$enddate.';</br>';
	};
	if($Y_beizhu!=$beizhu){
		$sys_editcontent.='beizhu:  '.$Y_beizhu.'=>'.$beizhu.';</br>';
	};
	if($Y_qq!=$qq){
		$sys_editcontent.='qq:  '.$Y_qq.'=>'.$qq.';</br>';
	};
	if($Y_sys_id_zu!=$sys_id_zu){
		$sys_editcontent.='分类:  '.$Y_sys_id_zu.'=>'.$sys_id_zu.';</br>';
	};
	if($Y_card!=$card){
		$sys_editcontent.='card:  '.$Y_card.'=>'.$card.';</br>';
	};
	if($Y_bianhao!=$bianhao){
		$sys_editcontent.='bianhao:  '.$Y_bianhao.'=>'.$bianhao.';</br>';
	};
	if($Y_sys_shenpi!=$sys_shenpi){
		$sys_editcontent.='审核:  '.$Y_sys_shenpi.'=>'.$sys_shenpi.';</br>';
	};
	if($Y_sys_shenpi_all!=$sys_shenpi_all){
		$sys_editcontent.='批准:  '.$Y_sys_shenpi_all.'=>'.$sys_shenpi_all.';</br>';
	};
	if($Y_sys_login!=$sys_login){
		$sys_editcontent.='编制人:  '.$Y_sys_login.'=>'.$sys_login.';</br>';
	};
	if($Y_sys_chaosong!=$sys_chaosong){
		$sys_editcontent.='经办人:  '.$Y_sys_chaosong.'=>'.$sys_chaosong.';</br>';
	};
	if($Y_sys_paixu!=$sys_paixu){
		$sys_editcontent.='排序:  '.$Y_sys_paixu.'=>'.$sys_paixu.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'190','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(190,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(190,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
