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
		global $strmk_id,$Connadmin,$const_q_xiug,$const_id_login,$bh,$hy,$SYS_UserName,$const_id_fz,$bumen_id;
		
		
if ( $const_q_xiug >= 0 ) { //有修改权限时
    if( isset($_POST["sys_title"]) ){$sys_title=$_POST["sys_title"];}else{$sys_title='';};       //模版名
    if( isset($_POST["sys_hangye"]) ){$sys_hangye=$_POST["sys_hangye"];}else{$sys_hangye='';};       //所属行业
    if( isset($_POST["sys_name"]) ){$sys_name=$_POST["sys_name"];}else{$sys_name='';};       //替换为
    if( isset($_POST["sys_file"]) ){$sys_file=$_POST["sys_file"];}else{$sys_file='';};       //文件清单
    if( isset($_POST["sys_beizhu"]) ){$sys_beizhu=$_POST["sys_beizhu"];}else{$sys_beizhu='';};       //说明
    if( isset($_POST["sys_Id_MenuBigClass"]) ){$sys_Id_MenuBigClass=$_POST["sys_Id_MenuBigClass"];}else{$sys_Id_MenuBigClass='';};       //所属标准
    if( isset($_POST["sys_id_zu"]) ){$sys_id_zu=$_POST["sys_id_zu"];}else{$sys_id_zu='';};       //分类

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `msc_RenZhengMoBan`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Connadmin, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_sys_title=$row2['sys_title'];
    $Y_sys_hangye=$row2['sys_hangye'];
    $Y_sys_name=$row2['sys_name'];
    $Y_sys_file=$row2['sys_file'];
    $Y_sys_beizhu=$row2['sys_beizhu'];
    $Y_sys_Id_MenuBigClass=$row2['sys_Id_MenuBigClass'];
    $Y_sys_id_zu=$row2['sys_id_zu'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `msc_RenZhengMoBan`  set `sys_title`='$sys_title',`sys_hangye`='$sys_hangye',`sys_name`='$sys_name',`sys_file`='$sys_file',`sys_beizhu`='$sys_beizhu',`sys_Id_MenuBigClass`='$sys_Id_MenuBigClass',`sys_id_zu`='$sys_id_zu',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Connadmin,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_sys_title!=$sys_title){
		$sys_editcontent.='模版名:  '.$Y_sys_title.'=>'.$sys_title.';</br>';
	};
	if($Y_sys_hangye!=$sys_hangye){
		$sys_editcontent.='所属行业:  '.$Y_sys_hangye.'=>'.$sys_hangye.';</br>';
	};
	if($Y_sys_name!=$sys_name){
		$sys_editcontent.='替换为:  '.$Y_sys_name.'=>'.$sys_name.';</br>';
	};
	if($Y_sys_file!=$sys_file){
		$sys_editcontent.='文件清单:  '.$Y_sys_file.'=>'.$sys_file.';</br>';
	};
	if($Y_sys_beizhu!=$sys_beizhu){
		$sys_editcontent.='说明:  '.$Y_sys_beizhu.'=>'.$sys_beizhu.';</br>';
	};
	if($Y_sys_Id_MenuBigClass!=$sys_Id_MenuBigClass){
		$sys_editcontent.='所属标准:  '.$Y_sys_Id_MenuBigClass.'=>'.$sys_Id_MenuBigClass.';</br>';
	};
	if($Y_sys_id_zu!=$sys_id_zu){
		$sys_editcontent.='分类:  '.$Y_sys_id_zu.'=>'.$sys_id_zu.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'517','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(517,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(517,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Connadmin ); //关闭数据库
?>
