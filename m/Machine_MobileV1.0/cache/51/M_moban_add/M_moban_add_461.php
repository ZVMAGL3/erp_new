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
		$sql = "select * From `SQP_WenJianZiDongHua` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_GongSiMingChen=$row["ZD_GongSiMingChen"];
		$ZD_GongSiDiZhi=$row["ZD_GongSiDiZhi"];
		$ZD_GongSiDianHua=$row["ZD_GongSiDianHua"];
		$ZD_GongSiChuanZhen=$row["ZD_GongSiChuanZhen"];
		$ZD_ZongJingLi=$row["ZD_ZongJingLi"];
		$ZD_GuanLiZheDaiBiao=$row["ZD_GuanLiZheDaiBiao"];
		$ZD_AnQuanShiWuDaiBiao=$row["ZD_AnQuanShiWuDaiBiao"];
		$ZD_ShouCeBianZhiRen=$row["ZD_ShouCeBianZhiRen"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_GongSiMingChen="";
		$ZD_GongSiDiZhi="";
		$ZD_GongSiDianHua="";
		$ZD_GongSiChuanZhen="";
		$ZD_ZongJingLi="总经理";
		$ZD_GuanLiZheDaiBiao="管代";
		$ZD_AnQuanShiWuDaiBiao="安全代表";
		$ZD_ShouCeBianZhiRen="手册编制人";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'><font color='red'>[验重]</font>&nbsp;公司名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiMingChen' id='ZD_GongSiMingChen' class='addboxinput inputfocus'  value='<?php echo $ZD_GongSiMingChen ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongSiMingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>公司地址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiDiZhi' id='ZD_GongSiDiZhi' class='addboxinput inputfocus'  value='<?php echo $ZD_GongSiDiZhi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongSiDiZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>公司电话:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiDianHua' id='ZD_GongSiDianHua' class='addboxinput inputfocus'  value='<?php echo $ZD_GongSiDianHua ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongSiDianHua_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>公司传真:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiChuanZhen' id='ZD_GongSiChuanZhen' class='addboxinput inputfocus'  value='<?php echo $ZD_GongSiChuanZhen ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongSiChuanZhen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>总经理:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZongJingLi' id='ZD_ZongJingLi' class='addboxinput inputfocus'  value='<?php echo $ZD_ZongJingLi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ZongJingLi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>管理者代表:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GuanLiZheDaiBiao' id='ZD_GuanLiZheDaiBiao' class='addboxinput inputfocus'  value='<?php echo $ZD_GuanLiZheDaiBiao ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GuanLiZheDaiBiao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>安全事务代表:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_AnQuanShiWuDaiBiao' id='ZD_AnQuanShiWuDaiBiao' class='addboxinput inputfocus'  value='<?php echo $ZD_AnQuanShiWuDaiBiao ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_AnQuanShiWuDaiBiao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>手册编制人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShouCeBianZhiRen' id='ZD_ShouCeBianZhiRen' class='addboxinput inputfocus'  value='<?php echo $ZD_ShouCeBianZhiRen ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShouCeBianZhiRen_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv461',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GongSiMingChen,ZD_GongSiDiZhi,ZD_GongSiDianHua,ZD_GongSiChuanZhen,ZD_ZongJingLi,ZD_GuanLiZheDaiBiao,ZD_AnQuanShiWuDaiBiao,ZD_ShouCeBianZhiRen'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='SQP_WenJianZiDongHua' Wuchongfu_Arry='ZD_GongSiMingChen' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv461')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='461' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'ZD_GongSiMingChen','SQP_WenJianZiDongHua','DeskMenuDiv461');form_add_copy('DeskMenuDiv461');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>