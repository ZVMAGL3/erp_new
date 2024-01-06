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
		$sql = "select * From `SQP_QingJiaDiaoXiuJiaBanWaiChuDan` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZhiWu=$row["ZhiWu"];
		$ZD_ShenQingRen=$row["ZD_ShenQingRen"];
		$ZD_ShenQingShiJian=$row["ZD_ShenQingShiJian"];
		$sys_id_zu=$row["sys_id_zu"];
		$ShiYou=$row["ShiYou"];
		$ZD_BeiZhu=$row["ZD_BeiZhu"];
		$sys_shenpi=$row["sys_shenpi"];
		$sys_shenpi_all=$row["sys_shenpi_all"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZhiWu="$const_q_zu-($const_id_bumen)";
		$ZD_ShenQingRen="$SYS_UserName-($bh)";
		$ZD_ShenQingShiJian="$nowdate";
		$sys_id_zu="";
		$ShiYou="";
		$ZD_BeiZhu="";
		$sys_shenpi="";
		$sys_shenpi_all="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;职务:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='24' name='ZhiWu' id='ZhiWu' class='addboxinput inputfocus'   value='<?php echo $ZhiWu ?>'  style='width:100%'    readonly='readonly' />
		                 <div class='cols03 font_red yanzheng' id='ZhiWu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;申请人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='23' name='ZD_ShenQingRen' id='ZD_ShenQingRen' class='addboxinput inputfocus'   value='<?php echo $ZD_ShenQingRen ?>'  style='width:100%'    readonly='readonly' />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenQingRen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;申请时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='25' name='ZD_ShenQingShiJian' id='ZD_ShenQingShiJian' class='addboxinput inputfocus'   value='<?php echo $ZD_ShenQingShiJian ?>'  style='width:100%'    readonly='readonly' />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenQingShiJian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>分类:</li>
		                 <li class='cols02 reset_list'>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu1' tit='<?php echo $sys_id_zu ?>' cnval='丧假' value='<?php echo $sys_id_zu ?>' valid='394' valstr='' class='addboxinput inputfocus' >丧假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu2' tit='<?php echo $sys_id_zu ?>' cnval='事假' value='<?php echo $sys_id_zu ?>' valid='390' valstr='' class='addboxinput inputfocus' >事假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu3' tit='<?php echo $sys_id_zu ?>' cnval='产假' value='<?php echo $sys_id_zu ?>' valid='393' valstr='' class='addboxinput inputfocus' >产假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu4' tit='<?php echo $sys_id_zu ?>' cnval='出差' value='<?php echo $sys_id_zu ?>' valid='398' valstr='' class='addboxinput inputfocus' >出差&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu5' tit='<?php echo $sys_id_zu ?>' cnval='加班' value='<?php echo $sys_id_zu ?>' valid='396' valstr='' class='addboxinput inputfocus' >加班&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu6' tit='<?php echo $sys_id_zu ?>' cnval='外出' value='<?php echo $sys_id_zu ?>' valid='400' valstr='' class='addboxinput inputfocus' >外出&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu7' tit='<?php echo $sys_id_zu ?>' cnval='婚假' value='<?php echo $sys_id_zu ?>' valid='391' valstr='' class='addboxinput inputfocus' >婚假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu8' tit='<?php echo $sys_id_zu ?>' cnval='审核' value='<?php echo $sys_id_zu ?>' valid='397' valstr='' class='addboxinput inputfocus' >审核&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu9' tit='<?php echo $sys_id_zu ?>' cnval='年假' value='<?php echo $sys_id_zu ?>' valid='392' valstr='' class='addboxinput inputfocus' >年假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu10' tit='<?php echo $sys_id_zu ?>' cnval='病假' value='<?php echo $sys_id_zu ?>' valid='434' valstr='' class='addboxinput inputfocus' >病假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu11' tit='<?php echo $sys_id_zu ?>' cnval='调休' value='<?php echo $sys_id_zu ?>' valid='395' valstr='' class='addboxinput inputfocus' >调休&nbsp;</label><script>Inputdate('sys_id_zu','15','<?php echo $sys_id_zu ?>','DeskMenuDiv494','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='sys_id_zu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;事由:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ShiYou' id='ShiYou' class='addboxinput inputfocus' style='width:100%;height:25px;'   ><?php echo $ShiYou ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ShiYou_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>备注:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus'  value='<?php echo $ZD_BeiZhu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_BeiZhu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>审核:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='20' name='sys_shenpi' id='sys_shenpi' class='addboxinput inputfocus'  placeholder='请审核'  y-value='<?php echo $sys_shenpi ?>'  value='<?php echo $sys_shenpi ?>'  onclick='SignSH(this)' style='width:100%'    readonly='readonly' /><a class='jia jiaok'  onclick='SignSH(this)'><i class='fa fa-20-3'></i></a>
		                 <div class='cols03 font_red yanzheng' id='sys_shenpi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>批准:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='22' name='sys_shenpi_all' id='sys_shenpi_all' class='addboxinput inputfocus' placeholder='请批准'  y-value='<?php echo $sys_shenpi_all ?>'  value='<?php echo $sys_shenpi_all ?>'  onclick='SignPZ(this)' style='width:100%'    readonly='readonly' /><a class='jia jiaok'  onclick='SignPZ(this)'><i class='fa fa-20-4'></i></a>
		                 <div class='cols03 font_red yanzheng' id='sys_shenpi_all_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv494',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZhiWu,ZD_ShenQingRen,ZD_ShenQingShiJian,sys_id_zu,ShiYou,ZD_BeiZhu,sys_shenpi,sys_shenpi_all'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='ZhiWu,ZD_ShenQingRen,ZD_ShenQingShiJian,ShiYou' databiao='SQP_QingJiaDiaoXiuJiaBanWaiChuDan' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv494')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='494' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_QingJiaDiaoXiuJiaBanWaiChuDan','DeskMenuDiv494');form_add_copy('DeskMenuDiv494');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>