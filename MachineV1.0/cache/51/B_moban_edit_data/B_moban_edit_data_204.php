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
    if( isset($_POST["SYS_UserName"]) ){$SYS_UserName=$_POST["SYS_UserName"];}else{$SYS_UserName='';};       //姓名
    if( isset($_POST["ZD_ZhaoPian"]) ){$ZD_ZhaoPian=$_POST["ZD_ZhaoPian"];}else{$ZD_ZhaoPian='';};       //照片
    if( isset($_POST["XingBie"]) ){$XingBie=$_POST["XingBie"];}else{$XingBie='';};       //性别
    if( isset($_POST["SYS_GongHao"]) ){$SYS_GongHao=$_POST["SYS_GongHao"];}else{$SYS_GongHao='';};       //工号
    if( isset($_POST["SYS_QuanXian"]) ){$SYS_QuanXian=$_POST["SYS_QuanXian"];}else{$SYS_QuanXian='';};       //职位
    if( isset($_POST["SYS_ShouJi"]) ){$SYS_ShouJi=$_POST["SYS_ShouJi"];}else{$SYS_ShouJi='';};       //联系方式
    if( isset($_POST["GongZi"]) ){$GongZi=$_POST["GongZi"];}else{$GongZi='';};       //工资
    if( isset($_POST["ZD_GongZiFaFangZhangHu"]) ){$ZD_GongZiFaFangZhangHu=$_POST["ZD_GongZiFaFangZhangHu"];}else{$ZD_GongZiFaFangZhangHu='';};       //工资发放账户
    if( isset($_POST["SYS_ShenFenZheng"]) ){$SYS_ShenFenZheng=$_POST["SYS_ShenFenZheng"];}else{$SYS_ShenFenZheng='';};       //身份证
    if( isset($_POST["ZD_XianZhuDiZhi"]) ){$ZD_XianZhuDiZhi=$_POST["ZD_XianZhuDiZhi"];}else{$ZD_XianZhuDiZhi='';};       //现住地址
    if( isset($_POST["QQ"]) ){$QQ=$_POST["QQ"];}else{$QQ='';};       //QQ
    if( isset($_POST["SYS_Email"]) ){$SYS_Email=$_POST["SYS_Email"];}else{$SYS_Email='';};       //邮箱
    if( isset($_POST["SYS_StartDate"]) ){$SYS_StartDate=$_POST["SYS_StartDate"];}else{$SYS_StartDate='';};       //入职时间
    if( isset($_POST["SYS_EndDate"]) ){$SYS_EndDate=$_POST["SYS_EndDate"];}else{$SYS_EndDate='';};       //离职时间
    if( isset($_POST["zzzt"]) ){$zzzt=$_POST["zzzt"];}else{$zzzt='';};       //在职状态
    if( isset($_POST["ZD_HunYinZhuangTai"]) ){$ZD_HunYinZhuangTai=$_POST["ZD_HunYinZhuangTai"];}else{$ZD_HunYinZhuangTai='';};       //婚姻状态
    if( isset($_POST["sys_gx_id_204"]) ){$sys_gx_id_204=$_POST["sys_gx_id_204"];}else{$sys_gx_id_204='';};       //关系字段:sys_gx_id_204
    if( isset($_POST["ZD_ZhengJian"]) ){$ZD_ZhengJian=$_POST["ZD_ZhengJian"];}else{$ZD_ZhengJian='';};       //证件

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `sys_yuangongdanganbiao`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_SYS_UserName=$row2['SYS_UserName'];
    $Y_ZD_ZhaoPian=$row2['ZD_ZhaoPian'];
    $Y_XingBie=$row2['XingBie'];
    $Y_SYS_GongHao=$row2['SYS_GongHao'];
    $Y_SYS_QuanXian=$row2['SYS_QuanXian'];
    $Y_SYS_ShouJi=$row2['SYS_ShouJi'];
    $Y_GongZi=$row2['GongZi'];
    $Y_ZD_GongZiFaFangZhangHu=$row2['ZD_GongZiFaFangZhangHu'];
    $Y_SYS_ShenFenZheng=$row2['SYS_ShenFenZheng'];
    $Y_ZD_XianZhuDiZhi=$row2['ZD_XianZhuDiZhi'];
    $Y_QQ=$row2['QQ'];
    $Y_SYS_Email=$row2['SYS_Email'];
    $Y_SYS_StartDate=$row2['SYS_StartDate'];
    $Y_SYS_EndDate=$row2['SYS_EndDate'];
    $Y_zzzt=$row2['zzzt'];
    $Y_ZD_HunYinZhuangTai=$row2['ZD_HunYinZhuangTai'];
    $Y_sys_gx_id_204=$row2['sys_gx_id_204'];
    $Y_ZD_ZhengJian=$row2['ZD_ZhengJian'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `sys_yuangongdanganbiao`  set `SYS_UserName`='$SYS_UserName',`ZD_ZhaoPian`='$ZD_ZhaoPian',`XingBie`='$XingBie',`SYS_GongHao`='$SYS_GongHao',`SYS_QuanXian`='$SYS_QuanXian',`SYS_ShouJi`='$SYS_ShouJi',`GongZi`='$GongZi',`ZD_GongZiFaFangZhangHu`='$ZD_GongZiFaFangZhangHu',`SYS_ShenFenZheng`='$SYS_ShenFenZheng',`ZD_XianZhuDiZhi`='$ZD_XianZhuDiZhi',`QQ`='$QQ',`SYS_Email`='$SYS_Email',`SYS_StartDate`='$SYS_StartDate',`SYS_EndDate`='$SYS_EndDate',`zzzt`='$zzzt',`ZD_HunYinZhuangTai`='$ZD_HunYinZhuangTai',`ZD_ZhengJian`='$ZD_ZhengJian',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_SYS_UserName!=$SYS_UserName){
		$sys_editcontent.='姓名:  '.$Y_SYS_UserName.'=>'.$SYS_UserName.';</br>';
	};
	if($Y_ZD_ZhaoPian!=$ZD_ZhaoPian){
		$sys_editcontent.='照片:  '.$Y_ZD_ZhaoPian.'=>'.$ZD_ZhaoPian.';</br>';
	};
	if($Y_XingBie!=$XingBie){
		$sys_editcontent.='性别:  '.$Y_XingBie.'=>'.$XingBie.';</br>';
	};
	if($Y_SYS_GongHao!=$SYS_GongHao){
		$sys_editcontent.='工号:  '.$Y_SYS_GongHao.'=>'.$SYS_GongHao.';</br>';
	};
	if($Y_SYS_QuanXian!=$SYS_QuanXian){
		$sys_editcontent.='职位:  '.$Y_SYS_QuanXian.'=>'.$SYS_QuanXian.';</br>';
	};
	if($Y_SYS_ShouJi!=$SYS_ShouJi){
		$sys_editcontent.='联系方式:  '.$Y_SYS_ShouJi.'=>'.$SYS_ShouJi.';</br>';
	};
	if($Y_GongZi!=$GongZi){
		$sys_editcontent.='工资:  '.$Y_GongZi.'=>'.$GongZi.';</br>';
	};
	if($Y_ZD_GongZiFaFangZhangHu!=$ZD_GongZiFaFangZhangHu){
		$sys_editcontent.='工资发放账户:  '.$Y_ZD_GongZiFaFangZhangHu.'=>'.$ZD_GongZiFaFangZhangHu.';</br>';
	};
	if($Y_SYS_ShenFenZheng!=$SYS_ShenFenZheng){
		$sys_editcontent.='身份证:  '.$Y_SYS_ShenFenZheng.'=>'.$SYS_ShenFenZheng.';</br>';
	};
	if($Y_ZD_XianZhuDiZhi!=$ZD_XianZhuDiZhi){
		$sys_editcontent.='现住地址:  '.$Y_ZD_XianZhuDiZhi.'=>'.$ZD_XianZhuDiZhi.';</br>';
	};
	if($Y_QQ!=$QQ){
		$sys_editcontent.='QQ:  '.$Y_QQ.'=>'.$QQ.';</br>';
	};
	if($Y_SYS_Email!=$SYS_Email){
		$sys_editcontent.='邮箱:  '.$Y_SYS_Email.'=>'.$SYS_Email.';</br>';
	};
	if($Y_SYS_StartDate!=$SYS_StartDate){
		$sys_editcontent.='入职时间:  '.$Y_SYS_StartDate.'=>'.$SYS_StartDate.';</br>';
	};
	if($Y_SYS_EndDate!=$SYS_EndDate){
		$sys_editcontent.='离职时间:  '.$Y_SYS_EndDate.'=>'.$SYS_EndDate.';</br>';
	};
	if($Y_zzzt!=$zzzt){
		$sys_editcontent.='在职状态:  '.$Y_zzzt.'=>'.$zzzt.';</br>';
	};
	if($Y_ZD_HunYinZhuangTai!=$ZD_HunYinZhuangTai){
		$sys_editcontent.='婚姻状态:  '.$Y_ZD_HunYinZhuangTai.'=>'.$ZD_HunYinZhuangTai.';</br>';
	};
	if($Y_sys_gx_id_204!=$sys_gx_id_204){
		$sys_editcontent.='关系字段:sys_gx_id_204:  '.$Y_sys_gx_id_204.'=>'.$sys_gx_id_204.';</br>';
	};
	if($Y_ZD_ZhengJian!=$ZD_ZhengJian){
		$sys_editcontent.='证件:  '.$Y_ZD_ZhengJian.'=>'.$ZD_ZhengJian.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'204','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(204,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(204,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script>sys_count('204','204','$sys_gx_id_204');</script>";
mysqli_close( $Conn ); //关闭数据库
?>
