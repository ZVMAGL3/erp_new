<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'M_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
	    if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                                //1回收站0为不回收
	    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                               //是否为回收站0为不回收
	   
	    global $strmk_id,$Conn,$const_q_tianj;
	

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_FuWuLiuChengDan` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$sys_gx_id_321=$row["sys_gx_id_321"];
		$ZD_GongSiMingChen=$row["ZD_GongSiMingChen"];
		$RenZhengXinXi=$row["RenZhengXinXi"];
		$XiangMuQianShou=$row["XiangMuQianShou"];
		$ZD_ShenHeTianShu=$row["ZD_ShenHeTianShu"];
		$ZD_JiaoQi=$row["ZD_JiaoQi"];
		$ZD_RuChang=$row["ZD_RuChang"];
		$ZD_ShenQing=$row["ZD_ShenQing"];
		$ZD_ZiLiao=$row["ZD_ZiLiao"];
		$ZD_JiLiangJianDing=$row["ZD_JiLiangJianDing"];
		$ZD_TeZhongJianDing=$row["ZD_TeZhongJianDing"];
		$ZD_YanShou=$row["ZD_YanShou"];
		$ZD_ShenHe=$row["ZD_ShenHe"];
		$ZD_ZhengGai=$row["ZD_ZhengGai"];
		$ZD_JiaoJie=$row["ZD_JiaoJie"];
		$ZD_TiChengJieSuan=$row["ZD_TiChengJieSuan"];
		$ZD_RenShuChanPin=$row["ZD_RenShuChanPin"];
		$LianXiRen=$row["LianXiRen"];
		$DianHua=$row["DianHua"];
		$ZhiDaoXingShi=$row["ZhiDaoXingShi"];
		$ZD_ShenHeYuan=$row["ZD_ShenHeYuan"];
		$ShenHeShiJian=$row["ShenHeShiJian"];
		$JiaoTongJieDai=$row["JiaoTongJieDai"];
		$ZiXunFeiYong=$row["ZiXunFeiYong"];
		$QiTaYaoQiu=$row["QiTaYaoQiu"];
		$ZD_ZiLiaoFuZeRen=$row["ZD_ZiLiaoFuZeRen"];
		$ZD_ZiLiaoZhuDao=$row["ZD_ZiLiaoZhuDao"];
		$ZD_JiLiangQiJu=$row["ZD_JiLiangQiJu"];
		$ZD_PeiShenYanChang=$row["ZD_PeiShenYanChang"];
		$ZD_PeiXun=$row["ZD_PeiXun"];
		$ZD_HeJiTiCheng=$row["ZD_HeJiTiCheng"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$sys_gx_id_321="";
		$ZD_GongSiMingChen="";
		$RenZhengXinXi="";
		$XiangMuQianShou="";
		$ZD_ShenHeTianShu="";
		$ZD_JiaoQi="";
		$ZD_RuChang="";
		$ZD_ShenQing="";
		$ZD_ZiLiao="";
		$ZD_JiLiangJianDing="";
		$ZD_TeZhongJianDing="";
		$ZD_YanShou="";
		$ZD_ShenHe="";
		$ZD_ZhengGai="";
		$ZD_JiaoJie="";
		$ZD_TiChengJieSuan="";
		$ZD_RenShuChanPin="";
		$LianXiRen="";
		$DianHua="";
		$ZhiDaoXingShi="";
		$ZD_ShenHeYuan="";
		$ShenHeShiJian="";
		$JiaoTongJieDai="";
		$ZiXunFeiYong="";
		$QiTaYaoQiu="";
		$ZD_ZiLiaoFuZeRen="";
		$ZD_ZiLiaoZhuDao="";
		$ZD_JiLiangQiJu="";
		$ZD_PeiShenYanChang="";
		$ZD_PeiXun="";
		$ZD_HeJiTiCheng="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>[关系]顾客档案表ID:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_gx_id_321' id='sys_gx_id_321' class='addboxinput inputfocus' value='<?php echo $sys_gx_id_321 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='sys_gx_id_321_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;公司名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiMingChen' id='ZD_GongSiMingChen' class='addboxinput inputfocus' value='<?php echo $ZD_GongSiMingChen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongSiMingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;认证信息:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='RenZhengXinXi' id='RenZhengXinXi' class='addboxinput inputfocus' value='<?php echo $RenZhengXinXi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='RenZhengXinXi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>项目签收:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='21' name='XiangMuQianShou' id='XiangMuQianShou' class='addboxinput inputfocus' placeholder='请签名'  y-value='<?php echo $XiangMuQianShou ?>'  value='<?php echo $XiangMuQianShou ?>'  onclick='sign(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='sign(this)'><i class='fa fa-23-3'></i></a>
		                 <div class='cols03 font_red yanzheng' id='XiangMuQianShou_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>审核天数:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenHeTianShu' id='ZD_ShenHeTianShu' class='addboxinput inputfocus' value='<?php echo $ZD_ShenHeTianShu ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenHeTianShu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>交期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='8' name='ZD_JiaoQi' id='ZD_JiaoQi' class='addboxinput inputfocus' value='<?php echo $ZD_JiaoQi ?>'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_JiaoQi',theme: '#393D49',lang: 'cn'});</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_JiaoQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>①入厂:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_RuChang' type='radio' typeid='18' id='ZD_RuChang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_RuChang' type='radio' typeid='18' id='ZD_RuChang_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_RuChang','18','<?php echo $ZD_RuChang ?>','DeskMenuDiv495','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_RuChang_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>②申请:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_ShenQing' type='radio' typeid='18' id='ZD_ShenQing_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_ShenQing' type='radio' typeid='18' id='ZD_ShenQing_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_ShenQing','18','<?php echo $ZD_ShenQing ?>','DeskMenuDiv495','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenQing_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>③资料:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_ZiLiao' type='radio' typeid='18' id='ZD_ZiLiao_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_ZiLiao' type='radio' typeid='18' id='ZD_ZiLiao_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_ZiLiao','18','<?php echo $ZD_ZiLiao ?>','DeskMenuDiv495','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_ZiLiao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>④计量检定:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_JiLiangJianDing' type='radio' typeid='18' id='ZD_JiLiangJianDing_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_JiLiangJianDing' type='radio' typeid='18' id='ZD_JiLiangJianDing_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_JiLiangJianDing','18','<?php echo $ZD_JiLiangJianDing ?>','DeskMenuDiv495','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_JiLiangJianDing_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑤特种检定:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_TeZhongJianDing' type='radio' typeid='18' id='ZD_TeZhongJianDing_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_TeZhongJianDing' type='radio' typeid='18' id='ZD_TeZhongJianDing_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_TeZhongJianDing','18','<?php echo $ZD_TeZhongJianDing ?>','DeskMenuDiv495','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_TeZhongJianDing_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑥验收:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_YanShou' type='radio' typeid='18' id='ZD_YanShou_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_YanShou' type='radio' typeid='18' id='ZD_YanShou_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_YanShou','18','<?php echo $ZD_YanShou ?>','DeskMenuDiv495','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_YanShou_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑦审核:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_ShenHe' type='radio' typeid='18' id='ZD_ShenHe_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_ShenHe' type='radio' typeid='18' id='ZD_ShenHe_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_ShenHe','18','<?php echo $ZD_ShenHe ?>','DeskMenuDiv495','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenHe_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑧整改:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_ZhengGai' type='radio' typeid='18' id='ZD_ZhengGai_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_ZhengGai' type='radio' typeid='18' id='ZD_ZhengGai_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_ZhengGai','18','<?php echo $ZD_ZhengGai ?>','DeskMenuDiv495','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_ZhengGai_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑨交接:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_JiaoJie' type='radio' typeid='18' id='ZD_JiaoJie_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_JiaoJie' type='radio' typeid='18' id='ZD_JiaoJie_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_JiaoJie','18','<?php echo $ZD_JiaoJie ?>','DeskMenuDiv495','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_JiaoJie_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>提成结算:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_TiChengJieSuan' type='radio' typeid='18' id='ZD_TiChengJieSuan_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_TiChengJieSuan' type='radio' typeid='18' id='ZD_TiChengJieSuan_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_TiChengJieSuan','18','<?php echo $ZD_TiChengJieSuan ?>','DeskMenuDiv495','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_TiChengJieSuan_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>人数/产品:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_RenShuChanPin' id='ZD_RenShuChanPin' class='addboxinput inputfocus' value='<?php echo $ZD_RenShuChanPin ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_RenShuChanPin_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;联系人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='LianXiRen' id='LianXiRen' class='addboxinput inputfocus' value='<?php echo $LianXiRen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='LianXiRen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;电话:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='DianHua' id='DianHua' class='addboxinput inputfocus' value='<?php echo $DianHua ?>'   />
		                 <div class='cols03 font_red yanzheng' id='DianHua_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;指导形式:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZhiDaoXingShi' id='ZhiDaoXingShi' class='addboxinput inputfocus' value='<?php echo $ZhiDaoXingShi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZhiDaoXingShi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>审核员:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenHeYuan' id='ZD_ShenHeYuan' class='addboxinput inputfocus' value='<?php echo $ZD_ShenHeYuan ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenHeYuan_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>审核时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ShenHeShiJian' id='ShenHeShiJian' class='addboxinput inputfocus' value='<?php echo $ShenHeShiJian ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ShenHeShiJian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;交通接待:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='JiaoTongJieDai' id='JiaoTongJieDai' class='addboxinput inputfocus' value='<?php echo $JiaoTongJieDai ?>'   />
		                 <div class='cols03 font_red yanzheng' id='JiaoTongJieDai_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;咨询费用:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZiXunFeiYong' id='ZiXunFeiYong' class='addboxinput inputfocus' value='<?php echo $ZiXunFeiYong ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZiXunFeiYong_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>其它要求:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='QiTaYaoQiu' id='QiTaYaoQiu' class='addboxinput inputfocus' value='<?php echo $QiTaYaoQiu ?>'   />
		                 <div class='cols03 font_red yanzheng' id='QiTaYaoQiu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>①资料（负责人）:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZiLiaoFuZeRen' id='ZD_ZiLiaoFuZeRen' class='addboxinput inputfocus' value='<?php echo $ZD_ZiLiaoFuZeRen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ZiLiaoFuZeRen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>②资料（主导）:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZiLiaoZhuDao' id='ZD_ZiLiaoZhuDao' class='addboxinput inputfocus' value='<?php echo $ZD_ZiLiaoZhuDao ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ZiLiaoZhuDao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>③计量器具:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiLiangQiJu' id='ZD_JiLiangQiJu' class='addboxinput inputfocus' value='<?php echo $ZD_JiLiangQiJu ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiLiangQiJu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>④陪审/验厂:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_PeiShenYanChang' id='ZD_PeiShenYanChang' class='addboxinput inputfocus' value='<?php echo $ZD_PeiShenYanChang ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_PeiShenYanChang_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑤培训:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_PeiXun' id='ZD_PeiXun' class='addboxinput inputfocus' value='<?php echo $ZD_PeiXun ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_PeiXun_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>合计提成:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HeJiTiCheng' id='ZD_HeJiTiCheng' class='addboxinput inputfocus' value='<?php echo $ZD_HeJiTiCheng ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_HeJiTiCheng_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv495',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='sys_gx_id_321,ZD_GongSiMingChen,RenZhengXinXi,XiangMuQianShou,ZD_ShenHeTianShu,ZD_JiaoQi,ZD_RuChang,ZD_ShenQing,ZD_ZiLiao,ZD_JiLiangJianDing,ZD_TeZhongJianDing,ZD_YanShou,ZD_ShenHe,ZD_ZhengGai,ZD_JiaoJie,ZD_TiChengJieSuan,ZD_RenShuChanPin,LianXiRen,DianHua,ZhiDaoXingShi,ZD_ShenHeYuan,ShenHeShiJian,JiaoTongJieDai,ZiXunFeiYong,QiTaYaoQiu,ZD_ZiLiaoFuZeRen,ZD_ZiLiaoZhuDao,ZD_JiLiangQiJu,ZD_PeiShenYanChang,ZD_PeiXun,ZD_HeJiTiCheng'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='ZD_GongSiMingChen,RenZhengXinXi,LianXiRen,DianHua,ZhiDaoXingShi,JiaoTongJieDai,ZiXunFeiYong' databiao='SQP_FuWuLiuChengDan' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv495')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='495' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_FuWuLiuChengDan','DeskMenuDiv495');form_add_copy('DeskMenuDiv495');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>