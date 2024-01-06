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
		$sql = "select * From `SQP_HeTongPingShenJiLuBiao` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_GuKeMingChen=$row["ZD_GuKeMingChen"];
		$ZD_HeTongBianHao=$row["ZD_HeTongBianHao"];
		$ZD_GuKeTeShuYaoQiuMiaoShu=$row["ZD_GuKeTeShuYaoQiuMiaoShu"];
		$ZD_XiaoShouBuPingShenRiQi=$row["ZD_XiaoShouBuPingShenRiQi"];
		$ZD_JiShuBuPingShenRiQi=$row["ZD_JiShuBuPingShenRiQi"];
		$ZD_ZongJingLiPingShenRiQi=$row["ZD_ZongJingLiPingShenRiQi"];
		$ZD_BeiZhu=$row["ZD_BeiZhu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_GuKeMingChen="";
		$ZD_HeTongBianHao="";
		$ZD_GuKeTeShuYaoQiuMiaoShu="";
		$ZD_XiaoShouBuPingShenRiQi="";
		$ZD_JiShuBuPingShenRiQi="";
		$ZD_ZongJingLiPingShenRiQi="";
		$ZD_BeiZhu="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>顾客名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GuKeMingChen' id='ZD_GuKeMingChen' class='addboxinput inputfocus'  value='<?php echo $ZD_GuKeMingChen ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GuKeMingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>合同编号:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HeTongBianHao' id='ZD_HeTongBianHao' class='addboxinput inputfocus'  value='<?php echo $ZD_HeTongBianHao ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_HeTongBianHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>顾客特殊要求描述:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_GuKeTeShuYaoQiuMiaoShu' id='ZD_GuKeTeShuYaoQiuMiaoShu' class='addboxinput inputfocus' style='width:100%;height:25px;'   ><?php echo $ZD_GuKeTeShuYaoQiuMiaoShu ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ZD_GuKeTeShuYaoQiuMiaoShu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>销售部评审/日期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XiaoShouBuPingShenRiQi' id='ZD_XiaoShouBuPingShenRiQi' class='addboxinput inputfocus'  value='<?php echo $ZD_XiaoShouBuPingShenRiQi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XiaoShouBuPingShenRiQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>技术部评审/日期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiShuBuPingShenRiQi' id='ZD_JiShuBuPingShenRiQi' class='addboxinput inputfocus'  value='<?php echo $ZD_JiShuBuPingShenRiQi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiShuBuPingShenRiQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>总经理评审/日期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZongJingLiPingShenRiQi' id='ZD_ZongJingLiPingShenRiQi' class='addboxinput inputfocus'  value='<?php echo $ZD_ZongJingLiPingShenRiQi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ZongJingLiPingShenRiQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>备注:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus'  value='<?php echo $ZD_BeiZhu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_BeiZhu_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv471',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GuKeMingChen,ZD_HeTongBianHao,ZD_GuKeTeShuYaoQiuMiaoShu,ZD_XiaoShouBuPingShenRiQi,ZD_JiShuBuPingShenRiQi,ZD_ZongJingLiPingShenRiQi,ZD_BeiZhu'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='SQP_HeTongPingShenJiLuBiao' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv471')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='471' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_HeTongPingShenJiLuBiao','DeskMenuDiv471');form_add_copy('DeskMenuDiv471');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>