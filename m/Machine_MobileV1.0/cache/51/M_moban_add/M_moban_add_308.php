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
		$sql = "select * From `SQP_GuKeCaiChanQingDan` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_GuKeMingChen=$row["ZD_GuKeMingChen"];
		$ZD_CaiChanMingChen=$row["ZD_CaiChanMingChen"];
		$ZD_XingHaoGuiGe=$row["ZD_XingHaoGuiGe"];
		$ZD_BenChangBianHao=$row["ZD_BenChangBianHao"];
		$ZD_ShuLiang=$row["ZD_ShuLiang"];
		$ZD_JieShouRiQi=$row["ZD_JieShouRiQi"];
		$ZD_ShiYongBuMen=$row["ZD_ShiYongBuMen"];
		$ZD_WanHaoZhuangTai=$row["ZD_WanHaoZhuangTai"];
		$ZD_CunFangDiDian=$row["ZD_CunFangDiDian"];
		$ZD_BaoFeiRiQi=$row["ZD_BaoFeiRiQi"];
		$ZD_BeiZhu=$row["ZD_BeiZhu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_GuKeMingChen="";
		$ZD_CaiChanMingChen="";
		$ZD_XingHaoGuiGe="";
		$ZD_BenChangBianHao="";
		$ZD_ShuLiang="";
		$ZD_JieShouRiQi="";
		$ZD_ShiYongBuMen="";
		$ZD_WanHaoZhuangTai="";
		$ZD_CunFangDiDian="";
		$ZD_BaoFeiRiQi="";
		$ZD_BeiZhu="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>顾客名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GuKeMingChen' id='ZD_GuKeMingChen' class='addboxinput inputfocus' value='<?php echo $ZD_GuKeMingChen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GuKeMingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>财产名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_CaiChanMingChen' id='ZD_CaiChanMingChen' class='addboxinput inputfocus' value='<?php echo $ZD_CaiChanMingChen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_CaiChanMingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>型号/规格:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XingHaoGuiGe' id='ZD_XingHaoGuiGe' class='addboxinput inputfocus' value='<?php echo $ZD_XingHaoGuiGe ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XingHaoGuiGe_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>本厂编号:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_BenChangBianHao' id='ZD_BenChangBianHao' class='addboxinput inputfocus' value='<?php echo $ZD_BenChangBianHao ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_BenChangBianHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>数量:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShuLiang' id='ZD_ShuLiang' class='addboxinput inputfocus' value='<?php echo $ZD_ShuLiang ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShuLiang_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>接收日期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JieShouRiQi' id='ZD_JieShouRiQi' class='addboxinput inputfocus' value='<?php echo $ZD_JieShouRiQi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JieShouRiQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>使用部门:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShiYongBuMen' id='ZD_ShiYongBuMen' class='addboxinput inputfocus' value='<?php echo $ZD_ShiYongBuMen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShiYongBuMen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>完好状态:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_WanHaoZhuangTai' id='ZD_WanHaoZhuangTai' class='addboxinput inputfocus' value='<?php echo $ZD_WanHaoZhuangTai ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_WanHaoZhuangTai_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>存放地点:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_CunFangDiDian' id='ZD_CunFangDiDian' class='addboxinput inputfocus' value='<?php echo $ZD_CunFangDiDian ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_CunFangDiDian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>报废日期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_BaoFeiRiQi' id='ZD_BaoFeiRiQi' class='addboxinput inputfocus' value='<?php echo $ZD_BaoFeiRiQi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_BaoFeiRiQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>备注:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus' value='<?php echo $ZD_BeiZhu ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_BeiZhu_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv308',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GuKeMingChen,ZD_CaiChanMingChen,ZD_XingHaoGuiGe,ZD_BenChangBianHao,ZD_ShuLiang,ZD_JieShouRiQi,ZD_ShiYongBuMen,ZD_WanHaoZhuangTai,ZD_CunFangDiDian,ZD_BaoFeiRiQi,ZD_BeiZhu'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='SQP_GuKeCaiChanQingDan' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv308')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='308' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_GuKeCaiChanQingDan','DeskMenuDiv308');form_add_copy('DeskMenuDiv308');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>