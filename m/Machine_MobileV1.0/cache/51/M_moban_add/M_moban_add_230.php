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
		$sql = "select * From `SQP_JianCeHeCeLiangZiYuanTaiZhang` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$MingChen=$row["MingChen"];
		$GuiGe=$row["GuiGe"];
		$ZhiZaoChangShang=$row["ZhiZaoChangShang"];
		$ChuChangBianHao=$row["ChuChangBianHao"];
		$ShiYongRiQi=$row["ShiYongRiQi"];
		$ShiYongBuMen=$row["ShiYongBuMen"];
		$GuanLiZeRenRen=$row["GuanLiZeRenRen"];
		$BaoFeiRiQi=$row["BaoFeiRiQi"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$MingChen="";
		$GuiGe="";
		$ZhiZaoChangShang="";
		$ChuChangBianHao="";
		$ShiYongRiQi="";
		$ShiYongBuMen="";
		$GuanLiZeRenRen="";
		$BaoFeiRiQi="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='MingChen' id='MingChen' class='addboxinput inputfocus' value='<?php echo $MingChen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='MingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>规格:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='GuiGe' id='GuiGe' class='addboxinput inputfocus' value='<?php echo $GuiGe ?>'   />
		                 <div class='cols03 font_red yanzheng' id='GuiGe_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>制造厂商:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZhiZaoChangShang' id='ZhiZaoChangShang' class='addboxinput inputfocus' value='<?php echo $ZhiZaoChangShang ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZhiZaoChangShang_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>出厂编号:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ChuChangBianHao' id='ChuChangBianHao' class='addboxinput inputfocus' value='<?php echo $ChuChangBianHao ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ChuChangBianHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>始用日期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ShiYongRiQi' id='ShiYongRiQi' class='addboxinput inputfocus' value='<?php echo $ShiYongRiQi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ShiYongRiQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>使用部门:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ShiYongBuMen' id='ShiYongBuMen' class='addboxinput inputfocus' value='<?php echo $ShiYongBuMen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ShiYongBuMen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>管理责任人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='GuanLiZeRenRen' id='GuanLiZeRenRen' class='addboxinput inputfocus' value='<?php echo $GuanLiZeRenRen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='GuanLiZeRenRen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>报废日期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='BaoFeiRiQi' id='BaoFeiRiQi' class='addboxinput inputfocus' value='<?php echo $BaoFeiRiQi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='BaoFeiRiQi_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv230',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='MingChen,GuiGe,ZhiZaoChangShang,ChuChangBianHao,ShiYongRiQi,ShiYongBuMen,GuanLiZeRenRen,BaoFeiRiQi'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='MingChen' databiao='SQP_JianCeHeCeLiangZiYuanTaiZhang' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv230')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='230' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_JianCeHeCeLiangZiYuanTaiZhang','DeskMenuDiv230');form_add_copy('DeskMenuDiv230');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>