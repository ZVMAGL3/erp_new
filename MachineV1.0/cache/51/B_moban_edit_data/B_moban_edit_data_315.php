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
    if( isset($_POST["ZD_XingBie"]) ){$ZD_XingBie=$_POST["ZD_XingBie"];}else{$ZD_XingBie='';};       //性别
    if( isset($_POST["ZD_JiGuan"]) ){$ZD_JiGuan=$_POST["ZD_JiGuan"];}else{$ZD_JiGuan='';};       //籍贯
    if( isset($_POST["ZD_MinZu"]) ){$ZD_MinZu=$_POST["ZD_MinZu"];}else{$ZD_MinZu='';};       //民族
    if( isset($_POST["ZD_ShenQingRiQi"]) ){$ZD_ShenQingRiQi=$_POST["ZD_ShenQingRiQi"];}else{$ZD_ShenQingRiQi='';};       //申请日期
    if( isset($_POST["ZD_ShenQingGangWei"]) ){$ZD_ShenQingGangWei=$_POST["ZD_ShenQingGangWei"];}else{$ZD_ShenQingGangWei='';};       //申请岗位
    if( isset($_POST["ZD_QiWangXinZi"]) ){$ZD_QiWangXinZi=$_POST["ZD_QiWangXinZi"];}else{$ZD_QiWangXinZi='';};       //期望薪资
    if( isset($_POST["ZD_XueLi"]) ){$ZD_XueLi=$_POST["ZD_XueLi"];}else{$ZD_XueLi='';};       //学历
    if( isset($_POST["ZD_XingMing"]) ){$ZD_XingMing=$_POST["ZD_XingMing"];}else{$ZD_XingMing='';};       //姓名
    if( isset($_POST["ZD_HunYin"]) ){$ZD_HunYin=$_POST["ZD_HunYin"];}else{$ZD_HunYin='';};       //婚姻
    if( isset($_POST["ZD_ShenGao"]) ){$ZD_ShenGao=$_POST["ZD_ShenGao"];}else{$ZD_ShenGao='';};       //身高
    if( isset($_POST["ZD_TiZhong"]) ){$ZD_TiZhong=$_POST["ZD_TiZhong"];}else{$ZD_TiZhong='';};       //体重
    if( isset($_POST["ZD_WaiYuDengJi"]) ){$ZD_WaiYuDengJi=$_POST["ZD_WaiYuDengJi"];}else{$ZD_WaiYuDengJi='';};       //外语等级
    if( isset($_POST["ZD_XingQuAiHao"]) ){$ZD_XingQuAiHao=$_POST["ZD_XingQuAiHao"];}else{$ZD_XingQuAiHao='';};       //兴趣爱好
    if( isset($_POST["ZD_ShenFenZhengDiZhi"]) ){$ZD_ShenFenZhengDiZhi=$_POST["ZD_ShenFenZhengDiZhi"];}else{$ZD_ShenFenZhengDiZhi='';};       //身份证地址
    if( isset($_POST["ZD_XianZhuDiZhi"]) ){$ZD_XianZhuDiZhi=$_POST["ZD_XianZhuDiZhi"];}else{$ZD_XianZhuDiZhi='';};       //现住地址
    if( isset($_POST["ZD_ShenFenZhengHaoMa"]) ){$ZD_ShenFenZhengHaoMa=$_POST["ZD_ShenFenZhengHaoMa"];}else{$ZD_ShenFenZhengHaoMa='';};       //身份证号码
    if( isset($_POST["ZD_LianXiDianHua"]) ){$ZD_LianXiDianHua=$_POST["ZD_LianXiDianHua"];}else{$ZD_LianXiDianHua='';};       //联系电话
    if( isset($_POST["ZD_JinJiLianXiRenDianHua"]) ){$ZD_JinJiLianXiRenDianHua=$_POST["ZD_JinJiLianXiRenDianHua"];}else{$ZD_JinJiLianXiRenDianHua='';};       //紧急联系人/电话
    if( isset($_POST["ZD_XueXiJingLi"]) ){$ZD_XueXiJingLi=$_POST["ZD_XueXiJingLi"];}else{$ZD_XueXiJingLi='';};       //学习经历
    if( isset($_POST["ZD_ZhuYaoGongZuoJingLi"]) ){$ZD_ZhuYaoGongZuoJingLi=$_POST["ZD_ZhuYaoGongZuoJingLi"];}else{$ZD_ZhuYaoGongZuoJingLi='';};       //主要工作经历
    if( isset($_POST["ZD_JiaTingQingKuang"]) ){$ZD_JiaTingQingKuang=$_POST["ZD_JiaTingQingKuang"];}else{$ZD_JiaTingQingKuang='';};       //家庭情况
    if( isset($_POST["ZD_ZiWoPingJia"]) ){$ZD_ZiWoPingJia=$_POST["ZD_ZiWoPingJia"];}else{$ZD_ZiWoPingJia='';};       //自我评价
    if( isset($_POST["ZD_RenShiBuPingYu"]) ){$ZD_RenShiBuPingYu=$_POST["ZD_RenShiBuPingYu"];}else{$ZD_RenShiBuPingYu='';};       //人事部评语
    if( isset($_POST["ZD_BuMenJingLiPingYu"]) ){$ZD_BuMenJingLiPingYu=$_POST["ZD_BuMenJingLiPingYu"];}else{$ZD_BuMenJingLiPingYu='';};       //部门经理评语
    if( isset($_POST["ZD_ZongJingLiPingYu"]) ){$ZD_ZongJingLiPingYu=$_POST["ZD_ZongJingLiPingYu"];}else{$ZD_ZongJingLiPingYu='';};       //总经理评语
    if( isset($_POST["ZD_JieLun"]) ){$ZD_JieLun=$_POST["ZD_JieLun"];}else{$ZD_JieLun='';};       //结论
    if( isset($_POST["ZD_RuZhiShiJian"]) ){$ZD_RuZhiShiJian=$_POST["ZD_RuZhiShiJian"];}else{$ZD_RuZhiShiJian='';};       //入职时间
    if( isset($_POST["ZD_ShiXiQiXin"]) ){$ZD_ShiXiQiXin=$_POST["ZD_ShiXiQiXin"];}else{$ZD_ShiXiQiXin='';};       //实习期/薪
    if( isset($_POST["ZD_ZhuanZhengHouXin"]) ){$ZD_ZhuanZhengHouXin=$_POST["ZD_ZhuanZhengHouXin"];}else{$ZD_ZhuanZhengHouXin='';};       //转正后/薪
    if( isset($_POST["ZD_ZhuSuAnPai"]) ){$ZD_ZhuSuAnPai=$_POST["ZD_ZhuSuAnPai"];}else{$ZD_ZhuSuAnPai='';};       //住宿安排
    if( isset($_POST["ZD_BeiZhu"]) ){$ZD_BeiZhu=$_POST["ZD_BeiZhu"];}else{$ZD_BeiZhu='';};       //备注
    if( isset($_POST["sys_gx_id_198"]) ){$sys_gx_id_198=$_POST["sys_gx_id_198"];}else{$sys_gx_id_198='';};       //[关系]质量记录归档登记表ID

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_JianLiZhongXin`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_XingBie=$row2['ZD_XingBie'];
    $Y_ZD_JiGuan=$row2['ZD_JiGuan'];
    $Y_ZD_MinZu=$row2['ZD_MinZu'];
    $Y_ZD_ShenQingRiQi=$row2['ZD_ShenQingRiQi'];
    $Y_ZD_ShenQingGangWei=$row2['ZD_ShenQingGangWei'];
    $Y_ZD_QiWangXinZi=$row2['ZD_QiWangXinZi'];
    $Y_ZD_XueLi=$row2['ZD_XueLi'];
    $Y_ZD_XingMing=$row2['ZD_XingMing'];
    $Y_ZD_HunYin=$row2['ZD_HunYin'];
    $Y_ZD_ShenGao=$row2['ZD_ShenGao'];
    $Y_ZD_TiZhong=$row2['ZD_TiZhong'];
    $Y_ZD_WaiYuDengJi=$row2['ZD_WaiYuDengJi'];
    $Y_ZD_XingQuAiHao=$row2['ZD_XingQuAiHao'];
    $Y_ZD_ShenFenZhengDiZhi=$row2['ZD_ShenFenZhengDiZhi'];
    $Y_ZD_XianZhuDiZhi=$row2['ZD_XianZhuDiZhi'];
    $Y_ZD_ShenFenZhengHaoMa=$row2['ZD_ShenFenZhengHaoMa'];
    $Y_ZD_LianXiDianHua=$row2['ZD_LianXiDianHua'];
    $Y_ZD_JinJiLianXiRenDianHua=$row2['ZD_JinJiLianXiRenDianHua'];
    $Y_ZD_XueXiJingLi=$row2['ZD_XueXiJingLi'];
    $Y_ZD_ZhuYaoGongZuoJingLi=$row2['ZD_ZhuYaoGongZuoJingLi'];
    $Y_ZD_JiaTingQingKuang=$row2['ZD_JiaTingQingKuang'];
    $Y_ZD_ZiWoPingJia=$row2['ZD_ZiWoPingJia'];
    $Y_ZD_RenShiBuPingYu=$row2['ZD_RenShiBuPingYu'];
    $Y_ZD_BuMenJingLiPingYu=$row2['ZD_BuMenJingLiPingYu'];
    $Y_ZD_ZongJingLiPingYu=$row2['ZD_ZongJingLiPingYu'];
    $Y_ZD_JieLun=$row2['ZD_JieLun'];
    $Y_ZD_RuZhiShiJian=$row2['ZD_RuZhiShiJian'];
    $Y_ZD_ShiXiQiXin=$row2['ZD_ShiXiQiXin'];
    $Y_ZD_ZhuanZhengHouXin=$row2['ZD_ZhuanZhengHouXin'];
    $Y_ZD_ZhuSuAnPai=$row2['ZD_ZhuSuAnPai'];
    $Y_ZD_BeiZhu=$row2['ZD_BeiZhu'];
    $Y_sys_gx_id_198=$row2['sys_gx_id_198'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_JianLiZhongXin`  set `ZD_XingBie`='$ZD_XingBie',`ZD_JiGuan`='$ZD_JiGuan',`ZD_MinZu`='$ZD_MinZu',`ZD_ShenQingRiQi`='$ZD_ShenQingRiQi',`ZD_ShenQingGangWei`='$ZD_ShenQingGangWei',`ZD_QiWangXinZi`='$ZD_QiWangXinZi',`ZD_XueLi`='$ZD_XueLi',`ZD_XingMing`='$ZD_XingMing',`ZD_HunYin`='$ZD_HunYin',`ZD_ShenGao`='$ZD_ShenGao',`ZD_TiZhong`='$ZD_TiZhong',`ZD_WaiYuDengJi`='$ZD_WaiYuDengJi',`ZD_XingQuAiHao`='$ZD_XingQuAiHao',`ZD_ShenFenZhengDiZhi`='$ZD_ShenFenZhengDiZhi',`ZD_XianZhuDiZhi`='$ZD_XianZhuDiZhi',`ZD_ShenFenZhengHaoMa`='$ZD_ShenFenZhengHaoMa',`ZD_LianXiDianHua`='$ZD_LianXiDianHua',`ZD_JinJiLianXiRenDianHua`='$ZD_JinJiLianXiRenDianHua',`ZD_XueXiJingLi`='$ZD_XueXiJingLi',`ZD_ZhuYaoGongZuoJingLi`='$ZD_ZhuYaoGongZuoJingLi',`ZD_JiaTingQingKuang`='$ZD_JiaTingQingKuang',`ZD_ZiWoPingJia`='$ZD_ZiWoPingJia',`ZD_RenShiBuPingYu`='$ZD_RenShiBuPingYu',`ZD_BuMenJingLiPingYu`='$ZD_BuMenJingLiPingYu',`ZD_ZongJingLiPingYu`='$ZD_ZongJingLiPingYu',`ZD_JieLun`='$ZD_JieLun',`ZD_RuZhiShiJian`='$ZD_RuZhiShiJian',`ZD_ShiXiQiXin`='$ZD_ShiXiQiXin',`ZD_ZhuanZhengHouXin`='$ZD_ZhuanZhengHouXin',`ZD_ZhuSuAnPai`='$ZD_ZhuSuAnPai',`ZD_BeiZhu`='$ZD_BeiZhu',`sys_gx_id_198`='$sys_gx_id_198',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_XingBie!=$ZD_XingBie){
		$sys_editcontent.='性别:  '.$Y_ZD_XingBie.'=>'.$ZD_XingBie.';</br>';
	};
	if($Y_ZD_JiGuan!=$ZD_JiGuan){
		$sys_editcontent.='籍贯:  '.$Y_ZD_JiGuan.'=>'.$ZD_JiGuan.';</br>';
	};
	if($Y_ZD_MinZu!=$ZD_MinZu){
		$sys_editcontent.='民族:  '.$Y_ZD_MinZu.'=>'.$ZD_MinZu.';</br>';
	};
	if($Y_ZD_ShenQingRiQi!=$ZD_ShenQingRiQi){
		$sys_editcontent.='申请日期:  '.$Y_ZD_ShenQingRiQi.'=>'.$ZD_ShenQingRiQi.';</br>';
	};
	if($Y_ZD_ShenQingGangWei!=$ZD_ShenQingGangWei){
		$sys_editcontent.='申请岗位:  '.$Y_ZD_ShenQingGangWei.'=>'.$ZD_ShenQingGangWei.';</br>';
	};
	if($Y_ZD_QiWangXinZi!=$ZD_QiWangXinZi){
		$sys_editcontent.='期望薪资:  '.$Y_ZD_QiWangXinZi.'=>'.$ZD_QiWangXinZi.';</br>';
	};
	if($Y_ZD_XueLi!=$ZD_XueLi){
		$sys_editcontent.='学历:  '.$Y_ZD_XueLi.'=>'.$ZD_XueLi.';</br>';
	};
	if($Y_ZD_XingMing!=$ZD_XingMing){
		$sys_editcontent.='姓名:  '.$Y_ZD_XingMing.'=>'.$ZD_XingMing.';</br>';
	};
	if($Y_ZD_HunYin!=$ZD_HunYin){
		$sys_editcontent.='婚姻:  '.$Y_ZD_HunYin.'=>'.$ZD_HunYin.';</br>';
	};
	if($Y_ZD_ShenGao!=$ZD_ShenGao){
		$sys_editcontent.='身高:  '.$Y_ZD_ShenGao.'=>'.$ZD_ShenGao.';</br>';
	};
	if($Y_ZD_TiZhong!=$ZD_TiZhong){
		$sys_editcontent.='体重:  '.$Y_ZD_TiZhong.'=>'.$ZD_TiZhong.';</br>';
	};
	if($Y_ZD_WaiYuDengJi!=$ZD_WaiYuDengJi){
		$sys_editcontent.='外语等级:  '.$Y_ZD_WaiYuDengJi.'=>'.$ZD_WaiYuDengJi.';</br>';
	};
	if($Y_ZD_XingQuAiHao!=$ZD_XingQuAiHao){
		$sys_editcontent.='兴趣爱好:  '.$Y_ZD_XingQuAiHao.'=>'.$ZD_XingQuAiHao.';</br>';
	};
	if($Y_ZD_ShenFenZhengDiZhi!=$ZD_ShenFenZhengDiZhi){
		$sys_editcontent.='身份证地址:  '.$Y_ZD_ShenFenZhengDiZhi.'=>'.$ZD_ShenFenZhengDiZhi.';</br>';
	};
	if($Y_ZD_XianZhuDiZhi!=$ZD_XianZhuDiZhi){
		$sys_editcontent.='现住地址:  '.$Y_ZD_XianZhuDiZhi.'=>'.$ZD_XianZhuDiZhi.';</br>';
	};
	if($Y_ZD_ShenFenZhengHaoMa!=$ZD_ShenFenZhengHaoMa){
		$sys_editcontent.='身份证号码:  '.$Y_ZD_ShenFenZhengHaoMa.'=>'.$ZD_ShenFenZhengHaoMa.';</br>';
	};
	if($Y_ZD_LianXiDianHua!=$ZD_LianXiDianHua){
		$sys_editcontent.='联系电话:  '.$Y_ZD_LianXiDianHua.'=>'.$ZD_LianXiDianHua.';</br>';
	};
	if($Y_ZD_JinJiLianXiRenDianHua!=$ZD_JinJiLianXiRenDianHua){
		$sys_editcontent.='紧急联系人/电话:  '.$Y_ZD_JinJiLianXiRenDianHua.'=>'.$ZD_JinJiLianXiRenDianHua.';</br>';
	};
	if($Y_ZD_XueXiJingLi!=$ZD_XueXiJingLi){
		$sys_editcontent.='学习经历:  '.$Y_ZD_XueXiJingLi.'=>'.$ZD_XueXiJingLi.';</br>';
	};
	if($Y_ZD_ZhuYaoGongZuoJingLi!=$ZD_ZhuYaoGongZuoJingLi){
		$sys_editcontent.='主要工作经历:  '.$Y_ZD_ZhuYaoGongZuoJingLi.'=>'.$ZD_ZhuYaoGongZuoJingLi.';</br>';
	};
	if($Y_ZD_JiaTingQingKuang!=$ZD_JiaTingQingKuang){
		$sys_editcontent.='家庭情况:  '.$Y_ZD_JiaTingQingKuang.'=>'.$ZD_JiaTingQingKuang.';</br>';
	};
	if($Y_ZD_ZiWoPingJia!=$ZD_ZiWoPingJia){
		$sys_editcontent.='自我评价:  '.$Y_ZD_ZiWoPingJia.'=>'.$ZD_ZiWoPingJia.';</br>';
	};
	if($Y_ZD_RenShiBuPingYu!=$ZD_RenShiBuPingYu){
		$sys_editcontent.='人事部评语:  '.$Y_ZD_RenShiBuPingYu.'=>'.$ZD_RenShiBuPingYu.';</br>';
	};
	if($Y_ZD_BuMenJingLiPingYu!=$ZD_BuMenJingLiPingYu){
		$sys_editcontent.='部门经理评语:  '.$Y_ZD_BuMenJingLiPingYu.'=>'.$ZD_BuMenJingLiPingYu.';</br>';
	};
	if($Y_ZD_ZongJingLiPingYu!=$ZD_ZongJingLiPingYu){
		$sys_editcontent.='总经理评语:  '.$Y_ZD_ZongJingLiPingYu.'=>'.$ZD_ZongJingLiPingYu.';</br>';
	};
	if($Y_ZD_JieLun!=$ZD_JieLun){
		$sys_editcontent.='结论:  '.$Y_ZD_JieLun.'=>'.$ZD_JieLun.';</br>';
	};
	if($Y_ZD_RuZhiShiJian!=$ZD_RuZhiShiJian){
		$sys_editcontent.='入职时间:  '.$Y_ZD_RuZhiShiJian.'=>'.$ZD_RuZhiShiJian.';</br>';
	};
	if($Y_ZD_ShiXiQiXin!=$ZD_ShiXiQiXin){
		$sys_editcontent.='实习期/薪:  '.$Y_ZD_ShiXiQiXin.'=>'.$ZD_ShiXiQiXin.';</br>';
	};
	if($Y_ZD_ZhuanZhengHouXin!=$ZD_ZhuanZhengHouXin){
		$sys_editcontent.='转正后/薪:  '.$Y_ZD_ZhuanZhengHouXin.'=>'.$ZD_ZhuanZhengHouXin.';</br>';
	};
	if($Y_ZD_ZhuSuAnPai!=$ZD_ZhuSuAnPai){
		$sys_editcontent.='住宿安排:  '.$Y_ZD_ZhuSuAnPai.'=>'.$ZD_ZhuSuAnPai.';</br>';
	};
	if($Y_ZD_BeiZhu!=$ZD_BeiZhu){
		$sys_editcontent.='备注:  '.$Y_ZD_BeiZhu.'=>'.$ZD_BeiZhu.';</br>';
	};
	if($Y_sys_gx_id_198!=$sys_gx_id_198){
		$sys_editcontent.='[关系]质量记录归档登记表ID:  '.$Y_sys_gx_id_198.'=>'.$sys_gx_id_198.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'315','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(315,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(315,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script>sys_count('198','315','$sys_gx_id_198');</script>";
mysqli_close( $Conn ); //关闭数据库
?>
