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
		$sql = "select * From `SQP_HeZuoHuoBan` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_GongSi=$row["ZD_GongSi"];
		$ZD_FaRen=$row["ZD_FaRen"];
		$ZD_JianChen=$row["ZD_JianChen"];
		$ZD_XingBie=$row["ZD_XingBie"];
		$ZD_DianHua=$row["ZD_DianHua"];
		$BeiZhu=$row["BeiZhu"];
		$ZD_DiZhi=$row["ZD_DiZhi"];
		$ZD_SheBaoRenShu=$row["ZD_SheBaoRenShu"];
		$ZD_WeiXin=$row["ZD_WeiXin"];
		$ZD_HeZuo=$row["ZD_HeZuo"];
		$ZD_QuFang=$row["ZD_QuFang"];
		$LaiFang=$row["LaiFang"];
		$PeiXun=$row["PeiXun"];
		$ZD_XiTong=$row["ZD_XiTong"];
		$ZD_JiHuaBaiFang=$row["ZD_JiHuaBaiFang"];
		$ZD_ZhuYingYeWu=$row["ZD_ZhuYingYeWu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_GongSi="";
		$ZD_FaRen="";
		$ZD_JianChen="";
		$ZD_XingBie="";
		$ZD_DianHua="";
		$BeiZhu="";
		$ZD_DiZhi="";
		$ZD_SheBaoRenShu="";
		$ZD_WeiXin="";
		$ZD_HeZuo="";
		$ZD_QuFang="";
		$LaiFang="";
		$PeiXun="";
		$ZD_XiTong="";
		$ZD_JiHuaBaiFang="";
		$ZD_ZhuYingYeWu="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;公司:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSi' id='ZD_GongSi' class='addboxinput inputfocus'  value='<?php echo $ZD_GongSi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongSi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;法人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_FaRen' id='ZD_FaRen' class='addboxinput inputfocus'  value='<?php echo $ZD_FaRen ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_FaRen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;简称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JianChen' id='ZD_JianChen' class='addboxinput inputfocus'  value='<?php echo $ZD_JianChen ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JianChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>性别:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_XingBie' type='radio' typeid='3' id='ZD_XingBie_0' value='先生'  class='addboxinput inputfocus'    />先生&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XingBie' type='radio' id='ZD_XingBie_1' class='addboxinput inputfocus' value='女士'  checked='checked'     />女士</label><script>Inputdate('ZD_XingBie','3','<?php echo $ZD_XingBie ?>','DeskMenuDiv223','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_XingBie_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;电话:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DianHua' id='ZD_DianHua' class='addboxinput inputfocus'  value='<?php echo $ZD_DianHua ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_DianHua_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>备注:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='BeiZhu' id='BeiZhu' class='addboxinput inputfocus' style='width:100%;height:25px;'   ><?php echo $BeiZhu ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='BeiZhu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>地址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DiZhi' id='ZD_DiZhi' class='addboxinput inputfocus'  value='<?php echo $ZD_DiZhi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_DiZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>社保人数:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_SheBaoRenShu' id='ZD_SheBaoRenShu' class='addboxinput inputfocus'  value='<?php echo $ZD_SheBaoRenShu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_SheBaoRenShu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>微信:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_WeiXin' type='radio' typeid='19' id='ZD_WeiXin_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_WeiXin' type='radio' typeid='19' id='ZD_WeiXin_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_WeiXin','19','<?php echo $ZD_WeiXin ?>','DeskMenuDiv223','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_WeiXin_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>合作:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_HeZuo' type='radio' typeid='19' id='ZD_HeZuo_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_HeZuo' type='radio' typeid='19' id='ZD_HeZuo_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_HeZuo','19','<?php echo $ZD_HeZuo ?>','DeskMenuDiv223','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_HeZuo_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>去访:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_QuFang' type='radio' typeid='19' id='ZD_QuFang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_QuFang' type='radio' typeid='19' id='ZD_QuFang_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_QuFang','19','<?php echo $ZD_QuFang ?>','DeskMenuDiv223','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_QuFang_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>来访:</li>
		                 <li class='cols02 reset_list'><label><input name='LaiFang' type='radio' typeid='19' id='LaiFang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='LaiFang' type='radio' typeid='19' id='LaiFang_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('LaiFang','19','<?php echo $LaiFang ?>','DeskMenuDiv223','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='LaiFang_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>培训:</li>
		                 <li class='cols02 reset_list'><label><input name='PeiXun' type='radio' typeid='19' id='PeiXun_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='PeiXun' type='radio' typeid='19' id='PeiXun_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('PeiXun','19','<?php echo $PeiXun ?>','DeskMenuDiv223','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='PeiXun_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>系统:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_XiTong' type='radio' typeid='19' id='ZD_XiTong_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XiTong' type='radio' typeid='19' id='ZD_XiTong_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_XiTong','19','<?php echo $ZD_XiTong ?>','DeskMenuDiv223','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_XiTong_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>计划拜访:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_JiHuaBaiFang' type='radio' typeid='19' id='ZD_JiHuaBaiFang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_JiHuaBaiFang' type='radio' typeid='19' id='ZD_JiHuaBaiFang_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_JiHuaBaiFang','19','<?php echo $ZD_JiHuaBaiFang ?>','DeskMenuDiv223','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_JiHuaBaiFang_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>主营业务:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZhuYingYeWu' id='ZD_ZhuYingYeWu' class='addboxinput inputfocus'  value='<?php echo $ZD_ZhuYingYeWu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ZhuYingYeWu_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $sys_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv223',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','ZD_MenDianTuPian')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GongSi,ZD_FaRen,ZD_JianChen,ZD_XingBie,ZD_DianHua,BeiZhu,ZD_DiZhi,ZD_SheBaoRenShu,ZD_WeiXin,ZD_HeZuo,ZD_QuFang,LaiFang,PeiXun,ZD_XiTong,ZD_JiHuaBaiFang,ZD_ZhuYingYeWu'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='ZD_MenDianTuPian' bitian_Arry='ZD_GongSi,ZD_FaRen,ZD_JianChen,ZD_DianHua' databiao='SQP_HeZuoHuoBan' Wuchongfu_Arry='ZD_GongSi,ZD_JianChen' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv223')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='223' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'ZD_GongSi,ZD_JianChen','SQP_HeZuoHuoBan','DeskMenuDiv223');form_add_copy('DeskMenuDiv223');inputfocusfirst('#addbox .htmlleirong','ZD_MenDianTuPian');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>