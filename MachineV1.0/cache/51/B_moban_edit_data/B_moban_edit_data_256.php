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
    if( isset($_POST["SYS_GongHao"]) ){$SYS_GongHao=$_POST["SYS_GongHao"];}else{$SYS_GongHao='';};       //工号
    if( isset($_POST["SYS_reg_num"]) ){$SYS_reg_num=$_POST["SYS_reg_num"];}else{$SYS_reg_num='';};       //公司注册号id
    if( isset($_POST["SYS_UserName"]) ){$SYS_UserName=$_POST["SYS_UserName"];}else{$SYS_UserName='';};       //用户名
    if( isset($_POST["SYS_ShouJi"]) ){$SYS_ShouJi=$_POST["SYS_ShouJi"];}else{$SYS_ShouJi='';};       //手机
    if( isset($_POST["SYS_yuangongdanganbiao_id"]) ){$SYS_yuangongdanganbiao_id=$_POST["SYS_yuangongdanganbiao_id"];}else{$SYS_yuangongdanganbiao_id='';};       //对应的会员id
    if( isset($_POST["SYS_PassWord"]) ){$SYS_PassWord=$_POST["SYS_PassWord"];}else{$SYS_PassWord='';};       //密码
    if( isset($_POST["SYS_ShenFenZheng"]) ){$SYS_ShenFenZheng=$_POST["SYS_ShenFenZheng"];}else{$SYS_ShenFenZheng='';};       //身份证
    if( isset($_POST["SYS_Company_id"]) ){$SYS_Company_id=$_POST["SYS_Company_id"];}else{$SYS_Company_id='';};       //所属公司ID
    if( isset($_POST["SYS_ZD_QQ"]) ){$SYS_ZD_QQ=$_POST["SYS_ZD_QQ"];}else{$SYS_ZD_QQ='';};       //QQ
    if( isset($_POST["SYS_Email"]) ){$SYS_Email=$_POST["SYS_Email"];}else{$SYS_Email='';};       //邮件
    if( isset($_POST["SYS_ZD_ZaiZhiZhuangTai"]) ){$SYS_ZD_ZaiZhiZhuangTai=$_POST["SYS_ZD_ZaiZhiZhuangTai"];}else{$SYS_ZD_ZaiZhiZhuangTai='';};       //在职状态
    if( isset($_POST["SYS_QuanXian"]) ){$SYS_QuanXian=$_POST["SYS_QuanXian"];}else{$SYS_QuanXian='';};       //权限{职位}
    if( isset($_POST["SYS_XingBie"]) ){$SYS_XingBie=$_POST["SYS_XingBie"];}else{$SYS_XingBie='';};       //性别
    if( isset($_POST["SYS_DianHua"]) ){$SYS_DianHua=$_POST["SYS_DianHua"];}else{$SYS_DianHua='';};       //电话
    if( isset($_POST["SYS_YinXingKaHao"]) ){$SYS_YinXingKaHao=$_POST["SYS_YinXingKaHao"];}else{$SYS_YinXingKaHao='';};       //银行卡号
    if( isset($_POST["SYS_DiZhi"]) ){$SYS_DiZhi=$_POST["SYS_DiZhi"];}else{$SYS_DiZhi='';};       //地址
    if( isset($_POST["SYS_GongZi"]) ){$SYS_GongZi=$_POST["SYS_GongZi"];}else{$SYS_GongZi='';};       //工资
    if( isset($_POST["SYS_StartDate"]) ){$SYS_StartDate=$_POST["SYS_StartDate"];}else{$SYS_StartDate='';};       //入职时间
    if( isset($_POST["SYS_EndDate"]) ){$SYS_EndDate=$_POST["SYS_EndDate"];}else{$SYS_EndDate='';};       //离职时间
    if( isset($_POST["SYS_jib"]) ){$SYS_jib=$_POST["SYS_jib"];}else{$SYS_jib='';};       //级别
    if( isset($_POST["SYS_photo"]) ){$SYS_photo=$_POST["SYS_photo"];}else{$SYS_photo='';};       //头像
    if( isset($_POST["SYS_chaoguan"]) ){$SYS_chaoguan=$_POST["SYS_chaoguan"];}else{$SYS_chaoguan='';};       //超管
    if( isset($_POST["SYS_qianmin"]) ){$SYS_qianmin=$_POST["SYS_qianmin"];}else{$SYS_qianmin='';};       //个性签名

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `msc_user_reg`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Connadmin, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_SYS_GongHao=$row2['SYS_GongHao'];
    $Y_SYS_reg_num=$row2['SYS_reg_num'];
    $Y_SYS_UserName=$row2['SYS_UserName'];
    $Y_SYS_ShouJi=$row2['SYS_ShouJi'];
    $Y_SYS_yuangongdanganbiao_id=$row2['SYS_yuangongdanganbiao_id'];
    $Y_SYS_PassWord=$row2['SYS_PassWord'];
    $Y_SYS_ShenFenZheng=$row2['SYS_ShenFenZheng'];
    $Y_SYS_Company_id=$row2['SYS_Company_id'];
    $Y_SYS_ZD_QQ=$row2['SYS_ZD_QQ'];
    $Y_SYS_Email=$row2['SYS_Email'];
    $Y_SYS_ZD_ZaiZhiZhuangTai=$row2['SYS_ZD_ZaiZhiZhuangTai'];
    $Y_SYS_QuanXian=$row2['SYS_QuanXian'];
    $Y_SYS_XingBie=$row2['SYS_XingBie'];
    $Y_SYS_DianHua=$row2['SYS_DianHua'];
    $Y_SYS_YinXingKaHao=$row2['SYS_YinXingKaHao'];
    $Y_SYS_DiZhi=$row2['SYS_DiZhi'];
    $Y_SYS_GongZi=$row2['SYS_GongZi'];
    $Y_SYS_StartDate=$row2['SYS_StartDate'];
    $Y_SYS_EndDate=$row2['SYS_EndDate'];
    $Y_SYS_jib=$row2['SYS_jib'];
    $Y_SYS_photo=$row2['SYS_photo'];
    $Y_SYS_chaoguan=$row2['SYS_chaoguan'];
    $Y_SYS_qianmin=$row2['SYS_qianmin'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `msc_user_reg`  set `SYS_GongHao`='$SYS_GongHao',`SYS_reg_num`='$SYS_reg_num',`SYS_UserName`='$SYS_UserName',`SYS_ShouJi`='$SYS_ShouJi',`SYS_yuangongdanganbiao_id`='$SYS_yuangongdanganbiao_id',`SYS_PassWord`='$SYS_PassWord',`SYS_ShenFenZheng`='$SYS_ShenFenZheng',`SYS_Company_id`='$SYS_Company_id',`SYS_ZD_QQ`='$SYS_ZD_QQ',`SYS_Email`='$SYS_Email',`SYS_ZD_ZaiZhiZhuangTai`='$SYS_ZD_ZaiZhiZhuangTai',`SYS_QuanXian`='$SYS_QuanXian',`SYS_XingBie`='$SYS_XingBie',`SYS_DianHua`='$SYS_DianHua',`SYS_YinXingKaHao`='$SYS_YinXingKaHao',`SYS_DiZhi`='$SYS_DiZhi',`SYS_GongZi`='$SYS_GongZi',`SYS_StartDate`='$SYS_StartDate',`SYS_EndDate`='$SYS_EndDate',`SYS_jib`='$SYS_jib',`SYS_photo`='$SYS_photo',`SYS_chaoguan`='$SYS_chaoguan',`SYS_qianmin`='$SYS_qianmin',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Connadmin,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_SYS_GongHao!=$SYS_GongHao){
		$sys_editcontent.='工号:  '.$Y_SYS_GongHao.'=>'.$SYS_GongHao.';</br>';
	};
	if($Y_SYS_reg_num!=$SYS_reg_num){
		$sys_editcontent.='公司注册号id:  '.$Y_SYS_reg_num.'=>'.$SYS_reg_num.';</br>';
	};
	if($Y_SYS_UserName!=$SYS_UserName){
		$sys_editcontent.='用户名:  '.$Y_SYS_UserName.'=>'.$SYS_UserName.';</br>';
	};
	if($Y_SYS_ShouJi!=$SYS_ShouJi){
		$sys_editcontent.='手机:  '.$Y_SYS_ShouJi.'=>'.$SYS_ShouJi.';</br>';
	};
	if($Y_SYS_yuangongdanganbiao_id!=$SYS_yuangongdanganbiao_id){
		$sys_editcontent.='对应的会员id:  '.$Y_SYS_yuangongdanganbiao_id.'=>'.$SYS_yuangongdanganbiao_id.';</br>';
	};
	if($Y_SYS_PassWord!=$SYS_PassWord){
		$sys_editcontent.='密码:  '.$Y_SYS_PassWord.'=>'.$SYS_PassWord.';</br>';
	};
	if($Y_SYS_ShenFenZheng!=$SYS_ShenFenZheng){
		$sys_editcontent.='身份证:  '.$Y_SYS_ShenFenZheng.'=>'.$SYS_ShenFenZheng.';</br>';
	};
	if($Y_SYS_Company_id!=$SYS_Company_id){
		$sys_editcontent.='所属公司ID:  '.$Y_SYS_Company_id.'=>'.$SYS_Company_id.';</br>';
	};
	if($Y_SYS_ZD_QQ!=$SYS_ZD_QQ){
		$sys_editcontent.='QQ:  '.$Y_SYS_ZD_QQ.'=>'.$SYS_ZD_QQ.';</br>';
	};
	if($Y_SYS_Email!=$SYS_Email){
		$sys_editcontent.='邮件:  '.$Y_SYS_Email.'=>'.$SYS_Email.';</br>';
	};
	if($Y_SYS_ZD_ZaiZhiZhuangTai!=$SYS_ZD_ZaiZhiZhuangTai){
		$sys_editcontent.='在职状态:  '.$Y_SYS_ZD_ZaiZhiZhuangTai.'=>'.$SYS_ZD_ZaiZhiZhuangTai.';</br>';
	};
	if($Y_SYS_QuanXian!=$SYS_QuanXian){
		$sys_editcontent.='权限{职位}:  '.$Y_SYS_QuanXian.'=>'.$SYS_QuanXian.';</br>';
	};
	if($Y_SYS_XingBie!=$SYS_XingBie){
		$sys_editcontent.='性别:  '.$Y_SYS_XingBie.'=>'.$SYS_XingBie.';</br>';
	};
	if($Y_SYS_DianHua!=$SYS_DianHua){
		$sys_editcontent.='电话:  '.$Y_SYS_DianHua.'=>'.$SYS_DianHua.';</br>';
	};
	if($Y_SYS_YinXingKaHao!=$SYS_YinXingKaHao){
		$sys_editcontent.='银行卡号:  '.$Y_SYS_YinXingKaHao.'=>'.$SYS_YinXingKaHao.';</br>';
	};
	if($Y_SYS_DiZhi!=$SYS_DiZhi){
		$sys_editcontent.='地址:  '.$Y_SYS_DiZhi.'=>'.$SYS_DiZhi.';</br>';
	};
	if($Y_SYS_GongZi!=$SYS_GongZi){
		$sys_editcontent.='工资:  '.$Y_SYS_GongZi.'=>'.$SYS_GongZi.';</br>';
	};
	if($Y_SYS_StartDate!=$SYS_StartDate){
		$sys_editcontent.='入职时间:  '.$Y_SYS_StartDate.'=>'.$SYS_StartDate.';</br>';
	};
	if($Y_SYS_EndDate!=$SYS_EndDate){
		$sys_editcontent.='离职时间:  '.$Y_SYS_EndDate.'=>'.$SYS_EndDate.';</br>';
	};
	if($Y_SYS_jib!=$SYS_jib){
		$sys_editcontent.='级别:  '.$Y_SYS_jib.'=>'.$SYS_jib.';</br>';
	};
	if($Y_SYS_photo!=$SYS_photo){
		$sys_editcontent.='头像:  '.$Y_SYS_photo.'=>'.$SYS_photo.';</br>';
	};
	if($Y_SYS_chaoguan!=$SYS_chaoguan){
		$sys_editcontent.='超管:  '.$Y_SYS_chaoguan.'=>'.$SYS_chaoguan.';</br>';
	};
	if($Y_SYS_qianmin!=$SYS_qianmin){
		$sys_editcontent.='个性签名:  '.$Y_SYS_qianmin.'=>'.$SYS_qianmin.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'256','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(256,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(256,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Connadmin ); //关闭数据库
?>
