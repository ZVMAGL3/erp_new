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
		$sql = "select * From `SQP_ChanPinQingDan` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_ChanPinMingChen=$row["ZD_ChanPinMingChen"];
		$ZD_ShiYongFanWei=$row["ZD_ShiYongFanWei"];
		$ZD_QuZhengZhouQi=$row["ZD_QuZhengZhouQi"];
		$ZD_YouXiaoQi=$row["ZD_YouXiaoQi"];
		$ZD_RenShuYuChanPin=$row["ZD_RenShuYuChanPin"];
		$ZD_ShouFeiBiaoZhun=$row["ZD_ShouFeiBiaoZhun"];
		$ZD_ReDu=$row["ZD_ReDu"];
		$ZD_HeZuoJiGou=$row["ZD_HeZuoJiGou"];
		$ZD_RenZhengXuYaoZhunBeiDeCaiLiao=$row["ZD_RenZhengXuYaoZhunBeiDeCaiLiao"];
		$ZD_XiangMuJianJie=$row["ZD_XiangMuJianJie"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_ChanPinMingChen="";
		$ZD_ShiYongFanWei="";
		$ZD_QuZhengZhouQi="";
		$ZD_YouXiaoQi="";
		$ZD_RenShuYuChanPin="";
		$ZD_ShouFeiBiaoZhun="";
		$ZD_ReDu="";
		$ZD_HeZuoJiGou="";
		$ZD_RenZhengXuYaoZhunBeiDeCaiLiao="";
		$ZD_XiangMuJianJie="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>产品名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ChanPinMingChen' id='ZD_ChanPinMingChen' class='addboxinput inputfocus' value='<?php echo $ZD_ChanPinMingChen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ChanPinMingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>适用范围:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShiYongFanWei' id='ZD_ShiYongFanWei' class='addboxinput inputfocus' value='<?php echo $ZD_ShiYongFanWei ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShiYongFanWei_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>取证周期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_QuZhengZhouQi' id='ZD_QuZhengZhouQi' class='addboxinput inputfocus' value='<?php echo $ZD_QuZhengZhouQi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_QuZhengZhouQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>有效期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_YouXiaoQi' id='ZD_YouXiaoQi' class='addboxinput inputfocus' value='<?php echo $ZD_YouXiaoQi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_YouXiaoQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>人数与产品:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_RenShuYuChanPin' id='ZD_RenShuYuChanPin' class='addboxinput inputfocus' value='<?php echo $ZD_RenShuYuChanPin ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_RenShuYuChanPin_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>收费标准:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShouFeiBiaoZhun' id='ZD_ShouFeiBiaoZhun' class='addboxinput inputfocus' value='<?php echo $ZD_ShouFeiBiaoZhun ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShouFeiBiaoZhun_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>热度:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ReDu' id='ZD_ReDu' class='addboxinput inputfocus' value='<?php echo $ZD_ReDu ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ReDu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>合作机构:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_HeZuoJiGou' id='ZD_HeZuoJiGou' class='addboxinput inputfocus' 25px;'   ><?php echo $ZD_HeZuoJiGou ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ZD_HeZuoJiGou_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>认证需要准备的材料:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_RenZhengXuYaoZhunBeiDeCaiLiao' id='ZD_RenZhengXuYaoZhunBeiDeCaiLiao' class='addboxinput inputfocus' 25px;'   ><?php echo $ZD_RenZhengXuYaoZhunBeiDeCaiLiao ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ZD_RenZhengXuYaoZhunBeiDeCaiLiao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>项目简介:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_XiangMuJianJie' id='ZD_XiangMuJianJie' class='addboxinput inputfocus' 25px;'   ><?php echo $ZD_XiangMuJianJie ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ZD_XiangMuJianJie_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv501',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_ChanPinMingChen,ZD_ShiYongFanWei,ZD_QuZhengZhouQi,ZD_YouXiaoQi,ZD_RenShuYuChanPin,ZD_ShouFeiBiaoZhun,ZD_ReDu,ZD_HeZuoJiGou,ZD_RenZhengXuYaoZhunBeiDeCaiLiao,ZD_XiangMuJianJie'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='SQP_ChanPinQingDan' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv501')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='501' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_ChanPinQingDan','DeskMenuDiv501');form_add_copy('DeskMenuDiv501');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>