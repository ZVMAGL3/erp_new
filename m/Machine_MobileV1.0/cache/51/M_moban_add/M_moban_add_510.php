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
		$sql = "select * From `SQP_KeHuZhengShuGuanLi` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_ZhengShuHao=$row["ZD_ZhengShuHao"];
		$ZD_KeHuMingChen=$row["ZD_KeHuMingChen"];
		$ZD_XiangMu=$row["ZD_XiangMu"];
		$ZD_ZiXunFei=$row["ZD_ZiXunFei"];
		$ZD_GenJinYueFen=$row["ZD_GenJinYueFen"];
		$ZD_RenZhengJiGou=$row["ZD_RenZhengJiGou"];
		$ZD_ChuShenShiJian=$row["ZD_ChuShenShiJian"];
		$ZD_JianShiJian=$row["ZD_JianShiJian"];
		$ZD_JianShiJian1629904411348=$row["ZD_JianShiJian1629904411348"];
		$ZD_HuanZhengShiJian=$row["ZD_HuanZhengShiJian"];
		$ZD_RenZhengFanWei=$row["ZD_RenZhengFanWei"];
		$ZD_LianXiRen=$row["ZD_LianXiRen"];
		$ZD_DianHua=$row["ZD_DianHua"];
		$ZD_GongSiDiZhi=$row["ZD_GongSiDiZhi"];
		$ZD_XiangMuFuZeRen=$row["ZD_XiangMuFuZeRen"];
		$ZD_RenZhengFei=$row["ZD_RenZhengFei"];
		$sys_id_zu=$row["sys_id_zu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_ZhengShuHao="";
		$ZD_KeHuMingChen="";
		$ZD_XiangMu="";
		$ZD_ZiXunFei="";
		$ZD_GenJinYueFen="";
		$ZD_RenZhengJiGou="";
		$ZD_ChuShenShiJian="";
		$ZD_JianShiJian="";
		$ZD_JianShiJian1629904411348="";
		$ZD_HuanZhengShiJian="";
		$ZD_RenZhengFanWei="";
		$ZD_LianXiRen="";
		$ZD_DianHua="";
		$ZD_GongSiDiZhi="";
		$ZD_XiangMuFuZeRen="";
		$ZD_RenZhengFei="";
		$sys_id_zu="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>证书号:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZhengShuHao' id='ZD_ZhengShuHao' class='addboxinput inputfocus' value='<?php echo $ZD_ZhengShuHao ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ZhengShuHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>客户名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_KeHuMingChen' id='ZD_KeHuMingChen' class='addboxinput inputfocus' value='<?php echo $ZD_KeHuMingChen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_KeHuMingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>项目:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XiangMu' id='ZD_XiangMu' class='addboxinput inputfocus' value='<?php echo $ZD_XiangMu ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XiangMu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>104:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZiXunFei' id='ZD_ZiXunFei' class='addboxinput inputfocus' value='<?php echo $ZD_ZiXunFei ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ZiXunFei_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;跟进月份:</li>
		                 <li class='cols02 reset_list'>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_0' tit='<?php echo $ZD_GenJinYueFen ?>' cnval='1月' value='<?php echo $ZD_GenJinYueFen ?>' valid='1月' valstr='' class='addboxinput inputfocus'   >1月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_1' tit='<?php echo $ZD_GenJinYueFen ?>' cnval='2月' value='<?php echo $ZD_GenJinYueFen ?>' valid='2月' valstr='' class='addboxinput inputfocus'   >2月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_2' tit='<?php echo $ZD_GenJinYueFen ?>' cnval='3月' value='<?php echo $ZD_GenJinYueFen ?>' valid='3月' valstr='' class='addboxinput inputfocus'   >3月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_3' tit='<?php echo $ZD_GenJinYueFen ?>' cnval='4月' value='<?php echo $ZD_GenJinYueFen ?>' valid='4月' valstr='' class='addboxinput inputfocus'   >4月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_4' tit='<?php echo $ZD_GenJinYueFen ?>' cnval='5月' value='<?php echo $ZD_GenJinYueFen ?>' valid='5月' valstr='' class='addboxinput inputfocus'   >5月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_5' tit='<?php echo $ZD_GenJinYueFen ?>' cnval='6月' value='<?php echo $ZD_GenJinYueFen ?>' valid='6月' valstr='' class='addboxinput inputfocus'   >6月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_6' tit='<?php echo $ZD_GenJinYueFen ?>' cnval='7月' value='<?php echo $ZD_GenJinYueFen ?>' valid='7月' valstr='' class='addboxinput inputfocus'   >7月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_7' tit='<?php echo $ZD_GenJinYueFen ?>' cnval='8月' value='<?php echo $ZD_GenJinYueFen ?>' valid='8月' valstr='' class='addboxinput inputfocus'   >8月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_8' tit='<?php echo $ZD_GenJinYueFen ?>' cnval='9月' value='<?php echo $ZD_GenJinYueFen ?>' valid='9月' valstr='' class='addboxinput inputfocus'   >9月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_9' tit='<?php echo $ZD_GenJinYueFen ?>' cnval='10月' value='<?php echo $ZD_GenJinYueFen ?>' valid='10月' valstr='' class='addboxinput inputfocus'   >10月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_10' tit='<?php echo $ZD_GenJinYueFen ?>' cnval='11月' value='<?php echo $ZD_GenJinYueFen ?>' valid='11月' valstr='' class='addboxinput inputfocus'   >11月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_11' tit='<?php echo $ZD_GenJinYueFen ?>' cnval='12月' value='<?php echo $ZD_GenJinYueFen ?>' valid='12月' valstr='' class='addboxinput inputfocus'   >12月&nbsp;</label>
            
            <script>Inputdate('ZD_GenJinYueFen','15','<?php echo $ZD_GenJinYueFen ?>','DeskMenuDiv510','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_GenJinYueFen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>认证机构:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_RenZhengJiGou' id='ZD_RenZhengJiGou' class='addboxinput inputfocus' value='<?php echo $ZD_RenZhengJiGou ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_RenZhengJiGou_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>初审时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ChuShenShiJian' id='ZD_ChuShenShiJian' class='addboxinput inputfocus' value='<?php echo $ZD_ChuShenShiJian ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ChuShenShiJian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>监①时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JianShiJian' id='ZD_JianShiJian' class='addboxinput inputfocus' value='<?php echo $ZD_JianShiJian ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JianShiJian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>监②时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JianShiJian1629904411348' id='ZD_JianShiJian1629904411348' class='addboxinput inputfocus' value='<?php echo $ZD_JianShiJian1629904411348 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JianShiJian1629904411348_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>换证时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HuanZhengShiJian' id='ZD_HuanZhengShiJian' class='addboxinput inputfocus' value='<?php echo $ZD_HuanZhengShiJian ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_HuanZhengShiJian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>认证范围:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_RenZhengFanWei' id='ZD_RenZhengFanWei' class='addboxinput inputfocus' value='<?php echo $ZD_RenZhengFanWei ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_RenZhengFanWei_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>联系人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_LianXiRen' id='ZD_LianXiRen' class='addboxinput inputfocus' value='<?php echo $ZD_LianXiRen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_LianXiRen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>电话:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DianHua' id='ZD_DianHua' class='addboxinput inputfocus' value='<?php echo $ZD_DianHua ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_DianHua_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>公司地址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiDiZhi' id='ZD_GongSiDiZhi' class='addboxinput inputfocus' value='<?php echo $ZD_GongSiDiZhi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongSiDiZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>项目负责人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XiangMuFuZeRen' id='ZD_XiangMuFuZeRen' class='addboxinput inputfocus' value='<?php echo $ZD_XiangMuFuZeRen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XiangMuFuZeRen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>认证费:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_RenZhengFei' id='ZD_RenZhengFei' class='addboxinput inputfocus' value='<?php echo $ZD_RenZhengFei ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_RenZhengFei_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>分类:</li>
		                 <li class='cols02 reset_list'>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu1' tit='<?php echo $sys_id_zu ?>' cnval='撤消' value='<?php echo $sys_id_zu ?>' valid='487' valstr='' class='addboxinput inputfocus' >撤消&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu2' tit='<?php echo $sys_id_zu ?>' cnval='暂停' value='<?php echo $sys_id_zu ?>' valid='486' valstr='' class='addboxinput inputfocus' >暂停&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu3' tit='<?php echo $sys_id_zu ?>' cnval='有效' value='<?php echo $sys_id_zu ?>' valid='492' valstr='' class='addboxinput inputfocus' >有效&nbsp;</label><script>Inputdate('sys_id_zu','15','<?php echo $sys_id_zu ?>','DeskMenuDiv510','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='sys_id_zu_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv510',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','ZD_ZhengShuHao')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_ZhengShuHao,ZD_KeHuMingChen,ZD_XiangMu,ZD_ZiXunFei,ZD_GenJinYueFen,ZD_RenZhengJiGou,ZD_ChuShenShiJian,ZD_JianShiJian,ZD_JianShiJian1629904411348,ZD_HuanZhengShiJian,ZD_RenZhengFanWei,ZD_LianXiRen,ZD_DianHua,ZD_GongSiDiZhi,ZD_XiangMuFuZeRen,ZD_RenZhengFei,sys_id_zu'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='ZD_ZhengShuHao' bitian_Arry='ZD_GenJinYueFen' databiao='SQP_KeHuZhengShuGuanLi' Wuchongfu_Arry='ZD_ZiXunFei' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv510')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='510' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'ZD_ZiXunFei','SQP_KeHuZhengShuGuanLi','DeskMenuDiv510');form_add_copy('DeskMenuDiv510');inputfocusfirst('#addbox .htmlleirong','ZD_ZhengShuHao');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>