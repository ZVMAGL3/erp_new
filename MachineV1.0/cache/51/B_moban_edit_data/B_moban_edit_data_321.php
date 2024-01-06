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
    if( isset($_POST["ZD_BeiZhuQiYeGongShangXinYongDeng"]) ){$ZD_BeiZhuQiYeGongShangXinYongDeng=$_POST["ZD_BeiZhuQiYeGongShangXinYongDeng"];}else{$ZD_BeiZhuQiYeGongShangXinYongDeng='';};       //备注【企业工商信用等】
    if( isset($_POST["ZD_GongSiMingChen"]) ){$ZD_GongSiMingChen=$_POST["ZD_GongSiMingChen"];}else{$ZD_GongSiMingChen='';};       //公司名称
    if( isset($_POST["ZD_FuZeRen"]) ){$ZD_FuZeRen=$_POST["ZD_FuZeRen"];}else{$ZD_FuZeRen='';};       //负责人
    if( isset($_POST["ZD_YiXiangFuWu"]) ){$ZD_YiXiangFuWu=$_POST["ZD_YiXiangFuWu"];}else{$ZD_YiXiangFuWu='';};       //意向服务
    if( isset($_POST["XiangMuJingLi"]) ){$XiangMuJingLi=$_POST["XiangMuJingLi"];}else{$XiangMuJingLi='';};       //项目经理
    if( isset($_POST["ZD_ChengJiaoXiangMu"]) ){$ZD_ChengJiaoXiangMu=$_POST["ZD_ChengJiaoXiangMu"];}else{$ZD_ChengJiaoXiangMu='';};       //成交项目
    if( isset($_POST["ZD_DengJi"]) ){$ZD_DengJi=$_POST["ZD_DengJi"];}else{$ZD_DengJi='';};       //等级
    if( isset($_POST["ZD_BaoJiaFuJian"]) ){$ZD_BaoJiaFuJian=$_POST["ZD_BaoJiaFuJian"];}else{$ZD_BaoJiaFuJian='';};       //报价附件
    if( isset($_POST["XingBie"]) ){$XingBie=$_POST["XingBie"];}else{$XingBie='';};       //性别
    if( isset($_POST["DianHua"]) ){$DianHua=$_POST["DianHua"];}else{$DianHua='';};       //电话
    if( isset($_POST["sys_gx_id_223"]) ){$sys_gx_id_223=$_POST["sys_gx_id_223"];}else{$sys_gx_id_223='';};       //[关系]合作伙伴ID
    if( isset($_POST["ShengChanChanPin"]) ){$ShengChanChanPin=$_POST["ShengChanChanPin"];}else{$ShengChanChanPin='';};       //生产产品
    if( isset($_POST["DiZhi"]) ){$DiZhi=$_POST["DiZhi"];}else{$DiZhi='';};       //地址
    if( isset($_POST["sys_id_zu"]) ){$sys_id_zu=$_POST["sys_id_zu"];}else{$sys_id_zu='';};       //分类
    if( isset($_POST["sys_chaosong"]) ){$sys_chaosong=$_POST["sys_chaosong"];}else{$sys_chaosong='';};       //经办人
    if( isset($_POST["ZD_WeiXin"]) ){$ZD_WeiXin=$_POST["ZD_WeiXin"];}else{$ZD_WeiXin='';};       //微信
    if( isset($_POST["sys_gx_id_256"]) ){$sys_gx_id_256=$_POST["sys_gx_id_256"];}else{$sys_gx_id_256='';};       //[关系]SYS云帐户ID

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `sys_gukedanganbiao`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_BeiZhuQiYeGongShangXinYongDeng=$row2['ZD_BeiZhuQiYeGongShangXinYongDeng'];
    $Y_ZD_GongSiMingChen=$row2['ZD_GongSiMingChen'];
    $Y_ZD_FuZeRen=$row2['ZD_FuZeRen'];
    $Y_ZD_YiXiangFuWu=$row2['ZD_YiXiangFuWu'];
    $Y_XiangMuJingLi=$row2['XiangMuJingLi'];
    $Y_ZD_ChengJiaoXiangMu=$row2['ZD_ChengJiaoXiangMu'];
    $Y_ZD_DengJi=$row2['ZD_DengJi'];
    $Y_ZD_BaoJiaFuJian=$row2['ZD_BaoJiaFuJian'];
    $Y_XingBie=$row2['XingBie'];
    $Y_DianHua=$row2['DianHua'];
    $Y_sys_gx_id_223=$row2['sys_gx_id_223'];
    $Y_ShengChanChanPin=$row2['ShengChanChanPin'];
    $Y_DiZhi=$row2['DiZhi'];
    $Y_sys_id_zu=$row2['sys_id_zu'];
    $Y_sys_chaosong=$row2['sys_chaosong'];
    $Y_ZD_WeiXin=$row2['ZD_WeiXin'];
    $Y_sys_gx_id_256=$row2['sys_gx_id_256'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `sys_gukedanganbiao`  set `ZD_BeiZhuQiYeGongShangXinYongDeng`='$ZD_BeiZhuQiYeGongShangXinYongDeng',`ZD_GongSiMingChen`='$ZD_GongSiMingChen',`ZD_FuZeRen`='$ZD_FuZeRen',`ZD_YiXiangFuWu`='$ZD_YiXiangFuWu',`XiangMuJingLi`='$XiangMuJingLi',`ZD_ChengJiaoXiangMu`='$ZD_ChengJiaoXiangMu',`ZD_DengJi`='$ZD_DengJi',`ZD_BaoJiaFuJian`='$ZD_BaoJiaFuJian',`XingBie`='$XingBie',`DianHua`='$DianHua',`sys_gx_id_223`='$sys_gx_id_223',`ShengChanChanPin`='$ShengChanChanPin',`DiZhi`='$DiZhi',`sys_id_zu`='$sys_id_zu',`sys_chaosong`='$sys_chaosong',`ZD_WeiXin`='$ZD_WeiXin',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_BeiZhuQiYeGongShangXinYongDeng!=$ZD_BeiZhuQiYeGongShangXinYongDeng){
		$sys_editcontent.='备注【企业工商信用等】:  '.$Y_ZD_BeiZhuQiYeGongShangXinYongDeng.'=>'.$ZD_BeiZhuQiYeGongShangXinYongDeng.';</br>';
	};
	if($Y_ZD_GongSiMingChen!=$ZD_GongSiMingChen){
		$sys_editcontent.='公司名称:  '.$Y_ZD_GongSiMingChen.'=>'.$ZD_GongSiMingChen.';</br>';
	};
	if($Y_ZD_FuZeRen!=$ZD_FuZeRen){
		$sys_editcontent.='负责人:  '.$Y_ZD_FuZeRen.'=>'.$ZD_FuZeRen.';</br>';
	};
	if($Y_ZD_YiXiangFuWu!=$ZD_YiXiangFuWu){
		$sys_editcontent.='意向服务:  '.$Y_ZD_YiXiangFuWu.'=>'.$ZD_YiXiangFuWu.';</br>';
	};
	if($Y_XiangMuJingLi!=$XiangMuJingLi){
		$sys_editcontent.='项目经理:  '.$Y_XiangMuJingLi.'=>'.$XiangMuJingLi.';</br>';
	};
	if($Y_ZD_ChengJiaoXiangMu!=$ZD_ChengJiaoXiangMu){
		$sys_editcontent.='成交项目:  '.$Y_ZD_ChengJiaoXiangMu.'=>'.$ZD_ChengJiaoXiangMu.';</br>';
	};
	if($Y_ZD_DengJi!=$ZD_DengJi){
		$sys_editcontent.='等级:  '.$Y_ZD_DengJi.'=>'.$ZD_DengJi.';</br>';
	};
	if($Y_ZD_BaoJiaFuJian!=$ZD_BaoJiaFuJian){
		$sys_editcontent.='报价附件:  '.$Y_ZD_BaoJiaFuJian.'=>'.$ZD_BaoJiaFuJian.';</br>';
	};
	if($Y_XingBie!=$XingBie){
		$sys_editcontent.='性别:  '.$Y_XingBie.'=>'.$XingBie.';</br>';
	};
	if($Y_DianHua!=$DianHua){
		$sys_editcontent.='电话:  '.$Y_DianHua.'=>'.$DianHua.';</br>';
	};
	if($Y_sys_gx_id_223!=$sys_gx_id_223){
		$sys_editcontent.='[关系]合作伙伴ID:  '.$Y_sys_gx_id_223.'=>'.$sys_gx_id_223.';</br>';
	};
	if($Y_ShengChanChanPin!=$ShengChanChanPin){
		$sys_editcontent.='生产产品:  '.$Y_ShengChanChanPin.'=>'.$ShengChanChanPin.';</br>';
	};
	if($Y_DiZhi!=$DiZhi){
		$sys_editcontent.='地址:  '.$Y_DiZhi.'=>'.$DiZhi.';</br>';
	};
	if($Y_sys_id_zu!=$sys_id_zu){
		$sys_editcontent.='分类:  '.$Y_sys_id_zu.'=>'.$sys_id_zu.';</br>';
	};
	if($Y_sys_chaosong!=$sys_chaosong){
		$sys_editcontent.='经办人:  '.$Y_sys_chaosong.'=>'.$sys_chaosong.';</br>';
	};
	if($Y_ZD_WeiXin!=$ZD_WeiXin){
		$sys_editcontent.='微信:  '.$Y_ZD_WeiXin.'=>'.$ZD_WeiXin.';</br>';
	};
	if($Y_sys_gx_id_256!=$sys_gx_id_256){
		$sys_editcontent.='[关系]SYS云帐户ID:  '.$Y_sys_gx_id_256.'=>'.$sys_gx_id_256.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'321','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(321,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(321,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script>sys_count('223','321','$sys_gx_id_223');sys_count('256','321','$sys_gx_id_256');</script>";
mysqli_close( $Conn ); //关闭数据库
?>
