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
		$sql = "select * From `sys_gukedanganbiao` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_GongSiMingChen=$row["ZD_GongSiMingChen"];
		$ZD_FuZeRen=$row["ZD_FuZeRen"];
		$ZD_YiXiangFuWu=$row["ZD_YiXiangFuWu"];
		$XiangMuJingLi=$row["XiangMuJingLi"];
		$ZD_ChengJiaoXiangMu=$row["ZD_ChengJiaoXiangMu"];
		$ZD_DengJi=$row["ZD_DengJi"];
		$ZD_WeiXin=$row["ZD_WeiXin"];
		$ZD_BeiZhuQiYeGongShangXinYongDeng=$row["ZD_BeiZhuQiYeGongShangXinYongDeng"];
		$XingBie=$row["XingBie"];
		$DianHua=$row["DianHua"];
		$ShengChanChanPin=$row["ShengChanChanPin"];
		$DiZhi=$row["DiZhi"];
		$sys_id_zu=$row["sys_id_zu"];
		$sys_chaosong=$row["sys_chaosong"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_GongSiMingChen="";
		$ZD_FuZeRen="";
		$ZD_YiXiangFuWu="";
		$XiangMuJingLi="";
		$ZD_ChengJiaoXiangMu="";
		$ZD_DengJi="";
		$ZD_WeiXin="";
		$ZD_BeiZhuQiYeGongShangXinYongDeng="";
		$XingBie="";
		$DianHua="";
		$ShengChanChanPin="";
		$DiZhi="";
		$sys_id_zu="";
		$sys_chaosong="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;公司名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiMingChen' id='ZD_GongSiMingChen' class='addboxinput inputfocus' value='<?php echo $ZD_GongSiMingChen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongSiMingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;负责人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_FuZeRen' id='ZD_FuZeRen' class='addboxinput inputfocus' value='<?php echo $ZD_FuZeRen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_FuZeRen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>意向服务:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_YiXiangFuWu' id='ZD_YiXiangFuWu' class='addboxinput inputfocus' value='<?php echo $ZD_YiXiangFuWu ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_YiXiangFuWu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>项目经理:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='XiangMuJingLi' id='XiangMuJingLi' class='addboxinput inputfocus' value='<?php echo $XiangMuJingLi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='XiangMuJingLi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>成交项目:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ChengJiaoXiangMu' id='ZD_ChengJiaoXiangMu' class='addboxinput inputfocus' value='<?php echo $ZD_ChengJiaoXiangMu ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ChengJiaoXiangMu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>等级:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DengJi' id='ZD_DengJi' class='addboxinput inputfocus' value='<?php echo $ZD_DengJi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_DengJi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>微信:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_WeiXin' type='radio' typeid='18' id='ZD_WeiXin_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_WeiXin' type='radio' typeid='18' id='ZD_WeiXin_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_WeiXin','18','<?php echo $ZD_WeiXin ?>','DeskMenuDiv321','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_WeiXin_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>备注【企业工商信用等】:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_BeiZhuQiYeGongShangXinYongDeng' id='ZD_BeiZhuQiYeGongShangXinYongDeng' class='addboxinput inputfocus' 50px;'   ><?php echo $ZD_BeiZhuQiYeGongShangXinYongDeng ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ZD_BeiZhuQiYeGongShangXinYongDeng_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>性别:</li>
		                 <li class='cols02 reset_list'><label><input name='XingBie' type='radio' typeid='3' id='XingBie_0' value='先生'  class='addboxinput inputfocus'    />先生&nbsp;&nbsp;&nbsp;</label><label><input name='XingBie' type='radio' id='XingBie_1' class='addboxinput inputfocus' value='女士'  checked='checked'     />女士</label><script>Inputdate('XingBie','3','<?php echo $XingBie ?>','DeskMenuDiv321','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='XingBie_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;电话:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='DianHua' id='DianHua' class='addboxinput inputfocus' value='<?php echo $DianHua ?>'   />
		                 <div class='cols03 font_red yanzheng' id='DianHua_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>生产产品:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ShengChanChanPin' id='ShengChanChanPin' class='addboxinput inputfocus' value='<?php echo $ShengChanChanPin ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ShengChanChanPin_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>地址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='DiZhi' id='DiZhi' class='addboxinput inputfocus' value='<?php echo $DiZhi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='DiZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>分类:</li>
		                 <li class='cols02 reset_list'>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu1' tit='<?php echo $sys_id_zu ?>' cnval='失效' value='<?php echo $sys_id_zu ?>' valid='291' valstr='' class='addboxinput inputfocus' >失效&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu2' tit='<?php echo $sys_id_zu ?>' cnval='意向' value='<?php echo $sys_id_zu ?>' valid='116' valstr='' class='addboxinput inputfocus' >意向&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu3' tit='<?php echo $sys_id_zu ?>' cnval='汇淡中' value='<?php echo $sys_id_zu ?>' valid='290' valstr='' class='addboxinput inputfocus' >汇淡中&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu4' tit='<?php echo $sys_id_zu ?>' cnval='潜在' value='<?php echo $sys_id_zu ?>' valid='369' valstr='' class='addboxinput inputfocus' >潜在&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu5' tit='<?php echo $sys_id_zu ?>' cnval='老客户' value='<?php echo $sys_id_zu ?>' valid='121' valstr='' class='addboxinput inputfocus' >老客户&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu6' tit='<?php echo $sys_id_zu ?>' cnval='跟进中' value='<?php echo $sys_id_zu ?>' valid='368' valstr='' class='addboxinput inputfocus' >跟进中&nbsp;</label><script>Inputdate('sys_id_zu','15','<?php echo $sys_id_zu ?>','DeskMenuDiv321','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='sys_id_zu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>经办人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_chaosong' id='sys_chaosong' class='addboxinput inputfocus' value='<?php echo $sys_chaosong ?>'   />
		                 <div class='cols03 font_red yanzheng' id='sys_chaosong_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv321',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GongSiMingChen,ZD_FuZeRen,ZD_YiXiangFuWu,XiangMuJingLi,ZD_ChengJiaoXiangMu,ZD_DengJi,ZD_WeiXin,ZD_BeiZhuQiYeGongShangXinYongDeng,XingBie,DianHua,ShengChanChanPin,DiZhi,sys_id_zu,sys_chaosong'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='ZD_GongSiMingChen,ZD_FuZeRen,DianHua' databiao='sys_gukedanganbiao' Wuchongfu_Arry='ZD_GongSiMingChen' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv321')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='321' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'ZD_GongSiMingChen','sys_gukedanganbiao','DeskMenuDiv321');form_add_copy('DeskMenuDiv321');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>