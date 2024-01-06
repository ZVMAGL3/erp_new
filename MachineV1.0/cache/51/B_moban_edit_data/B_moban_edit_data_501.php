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
    if( isset($_POST["ZD_ShiYongFanWei"]) ){$ZD_ShiYongFanWei=$_POST["ZD_ShiYongFanWei"];}else{$ZD_ShiYongFanWei='';};       //适用范围
    if( isset($_POST["ZD_QuZhengZhouQi"]) ){$ZD_QuZhengZhouQi=$_POST["ZD_QuZhengZhouQi"];}else{$ZD_QuZhengZhouQi='';};       //取证周期
    if( isset($_POST["ZD_ChanPinMingChen"]) ){$ZD_ChanPinMingChen=$_POST["ZD_ChanPinMingChen"];}else{$ZD_ChanPinMingChen='';};       //产品名称
    if( isset($_POST["ZD_YouXiaoQi"]) ){$ZD_YouXiaoQi=$_POST["ZD_YouXiaoQi"];}else{$ZD_YouXiaoQi='';};       //有效期
    if( isset($_POST["ZD_RenShuYuChanPin"]) ){$ZD_RenShuYuChanPin=$_POST["ZD_RenShuYuChanPin"];}else{$ZD_RenShuYuChanPin='';};       //人数与产品
    if( isset($_POST["ZD_ShouFeiBiaoZhun"]) ){$ZD_ShouFeiBiaoZhun=$_POST["ZD_ShouFeiBiaoZhun"];}else{$ZD_ShouFeiBiaoZhun='';};       //收费标准
    if( isset($_POST["ZD_ReDu"]) ){$ZD_ReDu=$_POST["ZD_ReDu"];}else{$ZD_ReDu='';};       //热度
    if( isset($_POST["ZD_HeZuoJiGou"]) ){$ZD_HeZuoJiGou=$_POST["ZD_HeZuoJiGou"];}else{$ZD_HeZuoJiGou='';};       //合作机构
    if( isset($_POST["ZD_RenZhengXuYaoZhunBeiDeCaiLiao"]) ){$ZD_RenZhengXuYaoZhunBeiDeCaiLiao=$_POST["ZD_RenZhengXuYaoZhunBeiDeCaiLiao"];}else{$ZD_RenZhengXuYaoZhunBeiDeCaiLiao='';};       //认证需要准备的材料
    if( isset($_POST["ZD_XiangMuJianJie"]) ){$ZD_XiangMuJianJie=$_POST["ZD_XiangMuJianJie"];}else{$ZD_XiangMuJianJie='';};       //项目简介
    if( isset($_POST["sys_gx_id_321"]) ){$sys_gx_id_321=$_POST["sys_gx_id_321"];}else{$sys_gx_id_321='';};       //[关系]顾客档案表ID
    if( isset($_POST["sys_gx_id_257"]) ){$sys_gx_id_257=$_POST["sys_gx_id_257"];}else{$sys_gx_id_257='';};       //[关系][SYS] 职位管理ID

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_ChanPinQingDan`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_ShiYongFanWei=$row2['ZD_ShiYongFanWei'];
    $Y_ZD_QuZhengZhouQi=$row2['ZD_QuZhengZhouQi'];
    $Y_ZD_ChanPinMingChen=$row2['ZD_ChanPinMingChen'];
    $Y_ZD_YouXiaoQi=$row2['ZD_YouXiaoQi'];
    $Y_ZD_RenShuYuChanPin=$row2['ZD_RenShuYuChanPin'];
    $Y_ZD_ShouFeiBiaoZhun=$row2['ZD_ShouFeiBiaoZhun'];
    $Y_ZD_ReDu=$row2['ZD_ReDu'];
    $Y_ZD_HeZuoJiGou=$row2['ZD_HeZuoJiGou'];
    $Y_ZD_RenZhengXuYaoZhunBeiDeCaiLiao=$row2['ZD_RenZhengXuYaoZhunBeiDeCaiLiao'];
    $Y_ZD_XiangMuJianJie=$row2['ZD_XiangMuJianJie'];
    $Y_sys_gx_id_321=$row2['sys_gx_id_321'];
    $Y_sys_gx_id_257=$row2['sys_gx_id_257'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_ChanPinQingDan`  set `ZD_ShiYongFanWei`='$ZD_ShiYongFanWei',`ZD_QuZhengZhouQi`='$ZD_QuZhengZhouQi',`ZD_ChanPinMingChen`='$ZD_ChanPinMingChen',`ZD_YouXiaoQi`='$ZD_YouXiaoQi',`ZD_RenShuYuChanPin`='$ZD_RenShuYuChanPin',`ZD_ShouFeiBiaoZhun`='$ZD_ShouFeiBiaoZhun',`ZD_ReDu`='$ZD_ReDu',`ZD_HeZuoJiGou`='$ZD_HeZuoJiGou',`ZD_RenZhengXuYaoZhunBeiDeCaiLiao`='$ZD_RenZhengXuYaoZhunBeiDeCaiLiao',`ZD_XiangMuJianJie`='$ZD_XiangMuJianJie',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_ShiYongFanWei!=$ZD_ShiYongFanWei){
		$sys_editcontent.='适用范围:  '.$Y_ZD_ShiYongFanWei.'=>'.$ZD_ShiYongFanWei.';</br>';
	};
	if($Y_ZD_QuZhengZhouQi!=$ZD_QuZhengZhouQi){
		$sys_editcontent.='取证周期:  '.$Y_ZD_QuZhengZhouQi.'=>'.$ZD_QuZhengZhouQi.';</br>';
	};
	if($Y_ZD_ChanPinMingChen!=$ZD_ChanPinMingChen){
		$sys_editcontent.='产品名称:  '.$Y_ZD_ChanPinMingChen.'=>'.$ZD_ChanPinMingChen.';</br>';
	};
	if($Y_ZD_YouXiaoQi!=$ZD_YouXiaoQi){
		$sys_editcontent.='有效期:  '.$Y_ZD_YouXiaoQi.'=>'.$ZD_YouXiaoQi.';</br>';
	};
	if($Y_ZD_RenShuYuChanPin!=$ZD_RenShuYuChanPin){
		$sys_editcontent.='人数与产品:  '.$Y_ZD_RenShuYuChanPin.'=>'.$ZD_RenShuYuChanPin.';</br>';
	};
	if($Y_ZD_ShouFeiBiaoZhun!=$ZD_ShouFeiBiaoZhun){
		$sys_editcontent.='收费标准:  '.$Y_ZD_ShouFeiBiaoZhun.'=>'.$ZD_ShouFeiBiaoZhun.';</br>';
	};
	if($Y_ZD_ReDu!=$ZD_ReDu){
		$sys_editcontent.='热度:  '.$Y_ZD_ReDu.'=>'.$ZD_ReDu.';</br>';
	};
	if($Y_ZD_HeZuoJiGou!=$ZD_HeZuoJiGou){
		$sys_editcontent.='合作机构:  '.$Y_ZD_HeZuoJiGou.'=>'.$ZD_HeZuoJiGou.';</br>';
	};
	if($Y_ZD_RenZhengXuYaoZhunBeiDeCaiLiao!=$ZD_RenZhengXuYaoZhunBeiDeCaiLiao){
		$sys_editcontent.='认证需要准备的材料:  '.$Y_ZD_RenZhengXuYaoZhunBeiDeCaiLiao.'=>'.$ZD_RenZhengXuYaoZhunBeiDeCaiLiao.';</br>';
	};
	if($Y_ZD_XiangMuJianJie!=$ZD_XiangMuJianJie){
		$sys_editcontent.='项目简介:  '.$Y_ZD_XiangMuJianJie.'=>'.$ZD_XiangMuJianJie.';</br>';
	};
	if($Y_sys_gx_id_321!=$sys_gx_id_321){
		$sys_editcontent.='[关系]顾客档案表ID:  '.$Y_sys_gx_id_321.'=>'.$sys_gx_id_321.';</br>';
	};
	if($Y_sys_gx_id_257!=$sys_gx_id_257){
		$sys_editcontent.='[关系][SYS] 职位管理ID:  '.$Y_sys_gx_id_257.'=>'.$sys_gx_id_257.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'501','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(501,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(501,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script>sys_count('321','501','$sys_gx_id_321');sys_count('257','501','$sys_gx_id_257');</script>";
mysqli_close( $Conn ); //关闭数据库
?>
