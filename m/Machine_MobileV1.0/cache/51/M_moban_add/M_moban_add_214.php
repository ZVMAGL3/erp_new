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
		$sql = "select * From `SQP_JiChuSheShiBaoYangJiHua` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$SheBeiMingChen=$row["SheBeiMingChen"];
		$XingHaoGuiGe=$row["XingHaoGuiGe"];
		$BaoYangZhouQi=$row["BaoYangZhouQi"];
		$ZD_1Yue=$row["ZD_1Yue"];
		$ZD_2Yue=$row["ZD_2Yue"];
		$ZD_3Yue=$row["ZD_3Yue"];
		$ZD_4Yue=$row["ZD_4Yue"];
		$ZD_5Yue=$row["ZD_5Yue"];
		$ZD_6Yue=$row["ZD_6Yue"];
		$ZD_7Yue=$row["ZD_7Yue"];
		$ZD_8Yue=$row["ZD_8Yue"];
		$ZD_9Yue=$row["ZD_9Yue"];
		$ZD_10Yue=$row["ZD_10Yue"];
		$ZD_11Yue=$row["ZD_11Yue"];
		$ZD_12Yue=$row["ZD_12Yue"];
		$BeiZhu2020730下午324562448=$row["BeiZhu2020730下午324562448"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$SheBeiMingChen="";
		$XingHaoGuiGe="";
		$BaoYangZhouQi="0";
		$ZD_1Yue="";
		$ZD_2Yue="";
		$ZD_3Yue="";
		$ZD_4Yue="0";
		$ZD_5Yue="";
		$ZD_6Yue="";
		$ZD_7Yue="";
		$ZD_8Yue="0";
		$ZD_9Yue="0";
		$ZD_10Yue="0";
		$ZD_11Yue="";
		$ZD_12Yue="";
		$BeiZhu2020730下午324562448="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;设备名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SheBeiMingChen' id='SheBeiMingChen' class='addboxinput inputfocus' value='<?php echo $SheBeiMingChen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SheBeiMingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>型号规格:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='XingHaoGuiGe' id='XingHaoGuiGe' class='addboxinput inputfocus' value='<?php echo $XingHaoGuiGe ?>'   />
		                 <div class='cols03 font_red yanzheng' id='XingHaoGuiGe_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>保养周期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='BaoYangZhouQi' id='BaoYangZhouQi' class='addboxinput inputfocus' value='<?php echo $BaoYangZhouQi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='BaoYangZhouQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>1月:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_1Yue' type='radio' typeid='19' id='ZD_1Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_1Yue' type='radio' typeid='19' id='ZD_1Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_1Yue','19','<?php echo $ZD_1Yue ?>','DeskMenuDiv214','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_1Yue_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>2月:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_2Yue' type='radio' typeid='19' id='ZD_2Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_2Yue' type='radio' typeid='19' id='ZD_2Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_2Yue','19','<?php echo $ZD_2Yue ?>','DeskMenuDiv214','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_2Yue_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>3月:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_3Yue' type='radio' typeid='19' id='ZD_3Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_3Yue' type='radio' typeid='19' id='ZD_3Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_3Yue','19','<?php echo $ZD_3Yue ?>','DeskMenuDiv214','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_3Yue_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>4月:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_4Yue' type='radio' typeid='19' id='ZD_4Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_4Yue' type='radio' typeid='19' id='ZD_4Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_4Yue','19','<?php echo $ZD_4Yue ?>','DeskMenuDiv214','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_4Yue_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>5月:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_5Yue' type='radio' typeid='19' id='ZD_5Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_5Yue' type='radio' typeid='19' id='ZD_5Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_5Yue','19','<?php echo $ZD_5Yue ?>','DeskMenuDiv214','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_5Yue_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>6月:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_6Yue' type='radio' typeid='19' id='ZD_6Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_6Yue' type='radio' typeid='19' id='ZD_6Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_6Yue','19','<?php echo $ZD_6Yue ?>','DeskMenuDiv214','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_6Yue_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>7月:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_7Yue' type='radio' typeid='19' id='ZD_7Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_7Yue' type='radio' typeid='19' id='ZD_7Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_7Yue','19','<?php echo $ZD_7Yue ?>','DeskMenuDiv214','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_7Yue_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>8月:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_8Yue' type='radio' typeid='19' id='ZD_8Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_8Yue' type='radio' typeid='19' id='ZD_8Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_8Yue','19','<?php echo $ZD_8Yue ?>','DeskMenuDiv214','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_8Yue_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>9月:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_9Yue' type='radio' typeid='19' id='ZD_9Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_9Yue' type='radio' typeid='19' id='ZD_9Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_9Yue','19','<?php echo $ZD_9Yue ?>','DeskMenuDiv214','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_9Yue_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>10月:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_10Yue' type='radio' typeid='19' id='ZD_10Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_10Yue' type='radio' typeid='19' id='ZD_10Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_10Yue','19','<?php echo $ZD_10Yue ?>','DeskMenuDiv214','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_10Yue_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>11月:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_11Yue' type='radio' typeid='19' id='ZD_11Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_11Yue' type='radio' typeid='19' id='ZD_11Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_11Yue','19','<?php echo $ZD_11Yue ?>','DeskMenuDiv214','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_11Yue_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>12月:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_12Yue' type='radio' typeid='19' id='ZD_12Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_12Yue' type='radio' typeid='19' id='ZD_12Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_12Yue','19','<?php echo $ZD_12Yue ?>','DeskMenuDiv214','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_12Yue_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>备注:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='BeiZhu2020730下午324562448' id='BeiZhu2020730下午324562448' class='addboxinput inputfocus' value='<?php echo $BeiZhu2020730下午324562448 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='BeiZhu2020730下午324562448_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $sys_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv214',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SheBeiMingChen,XingHaoGuiGe,BaoYangZhouQi,ZD_1Yue,ZD_2Yue,ZD_3Yue,ZD_4Yue,ZD_5Yue,ZD_6Yue,ZD_7Yue,ZD_8Yue,ZD_9Yue,ZD_10Yue,ZD_11Yue,ZD_12Yue,BeiZhu2020730下午324562448'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='SheBeiMingChen' databiao='SQP_JiChuSheShiBaoYangJiHua' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv214')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='214' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_JiChuSheShiBaoYangJiHua','DeskMenuDiv214');form_add_copy('DeskMenuDiv214');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>