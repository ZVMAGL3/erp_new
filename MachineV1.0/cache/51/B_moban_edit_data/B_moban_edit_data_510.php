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
    if( isset($_POST["ZD_ZhengShuHao"]) ){$ZD_ZhengShuHao=$_POST["ZD_ZhengShuHao"];}else{$ZD_ZhengShuHao='';};       //证书号
    if( isset($_POST["ZD_ZhengShuTuPian"]) ){$ZD_ZhengShuTuPian=$_POST["ZD_ZhengShuTuPian"];}else{$ZD_ZhengShuTuPian='';};       //证书图片
    if( isset($_POST["sys_gx_id_321"]) ){$sys_gx_id_321=$_POST["sys_gx_id_321"];}else{$sys_gx_id_321='';};       //[关系]顾客档案表ID
    if( isset($_POST["ZD_KeHuMingChen"]) ){$ZD_KeHuMingChen=$_POST["ZD_KeHuMingChen"];}else{$ZD_KeHuMingChen='';};       //客户名称
    if( isset($_POST["ZD_XiangMu"]) ){$ZD_XiangMu=$_POST["ZD_XiangMu"];}else{$ZD_XiangMu='';};       //项目
    if( isset($_POST["ZD_ChuShenShiJian"]) ){$ZD_ChuShenShiJian=$_POST["ZD_ChuShenShiJian"];}else{$ZD_ChuShenShiJian='';};       //初审时间
    if( isset($_POST["ZD_JianShiJian"]) ){$ZD_JianShiJian=$_POST["ZD_JianShiJian"];}else{$ZD_JianShiJian='';};       //监①时间
    if( isset($_POST["ZD_JianShiJian1629904411348"]) ){$ZD_JianShiJian1629904411348=$_POST["ZD_JianShiJian1629904411348"];}else{$ZD_JianShiJian1629904411348='';};       //监②时间
    if( isset($_POST["ZD_HuanZhengShiJian"]) ){$ZD_HuanZhengShiJian=$_POST["ZD_HuanZhengShiJian"];}else{$ZD_HuanZhengShiJian='';};       //换证时间
    if( isset($_POST["ZD_RenZhengFanWei"]) ){$ZD_RenZhengFanWei=$_POST["ZD_RenZhengFanWei"];}else{$ZD_RenZhengFanWei='';};       //认证范围
    if( isset($_POST["ZD_LianXiRen"]) ){$ZD_LianXiRen=$_POST["ZD_LianXiRen"];}else{$ZD_LianXiRen='';};       //联系人
    if( isset($_POST["ZD_DianHua"]) ){$ZD_DianHua=$_POST["ZD_DianHua"];}else{$ZD_DianHua='';};       //电话
    if( isset($_POST["ZD_GongSiDiZhi"]) ){$ZD_GongSiDiZhi=$_POST["ZD_GongSiDiZhi"];}else{$ZD_GongSiDiZhi='';};       //公司地址
    if( isset($_POST["ZD_XiangMuFuZeRen"]) ){$ZD_XiangMuFuZeRen=$_POST["ZD_XiangMuFuZeRen"];}else{$ZD_XiangMuFuZeRen='';};       //项目负责人
    if( isset($_POST["ZD_RenZhengFei"]) ){$ZD_RenZhengFei=$_POST["ZD_RenZhengFei"];}else{$ZD_RenZhengFei='';};       //认证费
    if( isset($_POST["sys_gx_id_423"]) ){$sys_gx_id_423=$_POST["sys_gx_id_423"];}else{$sys_gx_id_423='';};       //[关系]顾客合同ID
    if( isset($_POST["ZD_GenJinYueFen"]) ){$ZD_GenJinYueFen=$_POST["ZD_GenJinYueFen"];}else{$ZD_GenJinYueFen='';};       //跟进月份
    if( isset($_POST["sys_id_zu"]) ){$sys_id_zu=$_POST["sys_id_zu"];}else{$sys_id_zu='';};       //分类
    if( isset($_POST["ZD_RenZhengJiGou"]) ){$ZD_RenZhengJiGou=$_POST["ZD_RenZhengJiGou"];}else{$ZD_RenZhengJiGou='';};       //认证机构

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_KeHuZhengShuGuanLi`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_ZhengShuHao=$row2['ZD_ZhengShuHao'];
    $Y_ZD_ZhengShuTuPian=$row2['ZD_ZhengShuTuPian'];
    $Y_sys_gx_id_321=$row2['sys_gx_id_321'];
    $Y_ZD_KeHuMingChen=$row2['ZD_KeHuMingChen'];
    $Y_ZD_XiangMu=$row2['ZD_XiangMu'];
    $Y_ZD_ChuShenShiJian=$row2['ZD_ChuShenShiJian'];
    $Y_ZD_JianShiJian=$row2['ZD_JianShiJian'];
    $Y_ZD_JianShiJian1629904411348=$row2['ZD_JianShiJian1629904411348'];
    $Y_ZD_HuanZhengShiJian=$row2['ZD_HuanZhengShiJian'];
    $Y_ZD_RenZhengFanWei=$row2['ZD_RenZhengFanWei'];
    $Y_ZD_LianXiRen=$row2['ZD_LianXiRen'];
    $Y_ZD_DianHua=$row2['ZD_DianHua'];
    $Y_ZD_GongSiDiZhi=$row2['ZD_GongSiDiZhi'];
    $Y_ZD_XiangMuFuZeRen=$row2['ZD_XiangMuFuZeRen'];
    $Y_ZD_RenZhengFei=$row2['ZD_RenZhengFei'];
    $Y_sys_gx_id_423=$row2['sys_gx_id_423'];
    $Y_ZD_GenJinYueFen=$row2['ZD_GenJinYueFen'];
    $Y_sys_id_zu=$row2['sys_id_zu'];
    $Y_ZD_RenZhengJiGou=$row2['ZD_RenZhengJiGou'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_KeHuZhengShuGuanLi`  set `ZD_ZhengShuHao`='$ZD_ZhengShuHao',`ZD_ZhengShuTuPian`='$ZD_ZhengShuTuPian',`sys_gx_id_321`='$sys_gx_id_321',`ZD_KeHuMingChen`='$ZD_KeHuMingChen',`ZD_XiangMu`='$ZD_XiangMu',`ZD_ChuShenShiJian`='$ZD_ChuShenShiJian',`ZD_JianShiJian`='$ZD_JianShiJian',`ZD_JianShiJian1629904411348`='$ZD_JianShiJian1629904411348',`ZD_HuanZhengShiJian`='$ZD_HuanZhengShiJian',`ZD_RenZhengFanWei`='$ZD_RenZhengFanWei',`ZD_LianXiRen`='$ZD_LianXiRen',`ZD_DianHua`='$ZD_DianHua',`ZD_GongSiDiZhi`='$ZD_GongSiDiZhi',`ZD_XiangMuFuZeRen`='$ZD_XiangMuFuZeRen',`ZD_RenZhengFei`='$ZD_RenZhengFei',`sys_gx_id_423`='$sys_gx_id_423',`ZD_GenJinYueFen`='$ZD_GenJinYueFen',`sys_id_zu`='$sys_id_zu',`ZD_RenZhengJiGou`='$ZD_RenZhengJiGou',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_ZhengShuHao!=$ZD_ZhengShuHao){
		$sys_editcontent.='证书号:  '.$Y_ZD_ZhengShuHao.'=>'.$ZD_ZhengShuHao.';</br>';
	};
	if($Y_ZD_ZhengShuTuPian!=$ZD_ZhengShuTuPian){
		$sys_editcontent.='证书图片:  '.$Y_ZD_ZhengShuTuPian.'=>'.$ZD_ZhengShuTuPian.';</br>';
	};
	if($Y_sys_gx_id_321!=$sys_gx_id_321){
		$sys_editcontent.='[关系]顾客档案表ID:  '.$Y_sys_gx_id_321.'=>'.$sys_gx_id_321.';</br>';
	};
	if($Y_ZD_KeHuMingChen!=$ZD_KeHuMingChen){
		$sys_editcontent.='客户名称:  '.$Y_ZD_KeHuMingChen.'=>'.$ZD_KeHuMingChen.';</br>';
	};
	if($Y_ZD_XiangMu!=$ZD_XiangMu){
		$sys_editcontent.='项目:  '.$Y_ZD_XiangMu.'=>'.$ZD_XiangMu.';</br>';
	};
	if($Y_ZD_ChuShenShiJian!=$ZD_ChuShenShiJian){
		$sys_editcontent.='初审时间:  '.$Y_ZD_ChuShenShiJian.'=>'.$ZD_ChuShenShiJian.';</br>';
	};
	if($Y_ZD_JianShiJian!=$ZD_JianShiJian){
		$sys_editcontent.='监①时间:  '.$Y_ZD_JianShiJian.'=>'.$ZD_JianShiJian.';</br>';
	};
	if($Y_ZD_JianShiJian1629904411348!=$ZD_JianShiJian1629904411348){
		$sys_editcontent.='监②时间:  '.$Y_ZD_JianShiJian1629904411348.'=>'.$ZD_JianShiJian1629904411348.';</br>';
	};
	if($Y_ZD_HuanZhengShiJian!=$ZD_HuanZhengShiJian){
		$sys_editcontent.='换证时间:  '.$Y_ZD_HuanZhengShiJian.'=>'.$ZD_HuanZhengShiJian.';</br>';
	};
	if($Y_ZD_RenZhengFanWei!=$ZD_RenZhengFanWei){
		$sys_editcontent.='认证范围:  '.$Y_ZD_RenZhengFanWei.'=>'.$ZD_RenZhengFanWei.';</br>';
	};
	if($Y_ZD_LianXiRen!=$ZD_LianXiRen){
		$sys_editcontent.='联系人:  '.$Y_ZD_LianXiRen.'=>'.$ZD_LianXiRen.';</br>';
	};
	if($Y_ZD_DianHua!=$ZD_DianHua){
		$sys_editcontent.='电话:  '.$Y_ZD_DianHua.'=>'.$ZD_DianHua.';</br>';
	};
	if($Y_ZD_GongSiDiZhi!=$ZD_GongSiDiZhi){
		$sys_editcontent.='公司地址:  '.$Y_ZD_GongSiDiZhi.'=>'.$ZD_GongSiDiZhi.';</br>';
	};
	if($Y_ZD_XiangMuFuZeRen!=$ZD_XiangMuFuZeRen){
		$sys_editcontent.='项目负责人:  '.$Y_ZD_XiangMuFuZeRen.'=>'.$ZD_XiangMuFuZeRen.';</br>';
	};
	if($Y_ZD_RenZhengFei!=$ZD_RenZhengFei){
		$sys_editcontent.='认证费:  '.$Y_ZD_RenZhengFei.'=>'.$ZD_RenZhengFei.';</br>';
	};
	if($Y_sys_gx_id_423!=$sys_gx_id_423){
		$sys_editcontent.='[关系]顾客合同ID:  '.$Y_sys_gx_id_423.'=>'.$sys_gx_id_423.';</br>';
	};
	if($Y_ZD_GenJinYueFen!=$ZD_GenJinYueFen){
		$sys_editcontent.='跟进月份:  '.$Y_ZD_GenJinYueFen.'=>'.$ZD_GenJinYueFen.';</br>';
	};
	if($Y_sys_id_zu!=$sys_id_zu){
		$sys_editcontent.='分类:  '.$Y_sys_id_zu.'=>'.$sys_id_zu.';</br>';
	};
	if($Y_ZD_RenZhengJiGou!=$ZD_RenZhengJiGou){
		$sys_editcontent.='认证机构:  '.$Y_ZD_RenZhengJiGou.'=>'.$ZD_RenZhengJiGou.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'510','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(510,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(510,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script>sys_count('321','510','$sys_gx_id_321');sys_count('423','510','$sys_gx_id_423');</script>";
mysqli_close( $Conn ); //关闭数据库
?>
