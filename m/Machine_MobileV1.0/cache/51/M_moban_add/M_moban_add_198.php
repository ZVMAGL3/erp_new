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
		$sql = "select * From `sys_jlmb` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$sys_card=$row["sys_card"];
		$mdb_name_SYS=$row["mdb_name_SYS"];
		$Id_MenuBigClass=$row["Id_MenuBigClass"];
		$banben=$row["banben"];
		$xiugaicishu=$row["xiugaicishu"];
		$ul_row_height=$row["ul_row_height"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$sys_card="";
		$mdb_name_SYS="";
		$Id_MenuBigClass="";
		$banben="";
		$xiugaicishu="";
		$ul_row_height="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>记录名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_card' id='sys_card' class='addboxinput inputfocus' value='<?php echo $sys_card ?>'   />
		                 <div class='cols03 font_red yanzheng' id='sys_card_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>数据表名:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='mdb_name_SYS' id='mdb_name_SYS' class='addboxinput inputfocus' value='<?php echo $mdb_name_SYS ?>'   />
		                 <div class='cols03 font_red yanzheng' id='mdb_name_SYS_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>大类菜单:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='Id_MenuBigClass' id='Id_MenuBigClass' class='addboxinput inputfocus' value='<?php echo $Id_MenuBigClass ?>'   />
		                 <div class='cols03 font_red yanzheng' id='Id_MenuBigClass_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>版本:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='banben' id='banben' class='addboxinput inputfocus' value='<?php echo $banben ?>'   />
		                 <div class='cols03 font_red yanzheng' id='banben_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>修改次数:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='xiugaicishu' id='xiugaicishu' class='addboxinput inputfocus' value='<?php echo $xiugaicishu ?>'   />
		                 <div class='cols03 font_red yanzheng' id='xiugaicishu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>行高:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ul_row_height' id='ul_row_height' class='addboxinput inputfocus' value='<?php echo $ul_row_height ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ul_row_height_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $sys_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv198',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='sys_card,mdb_name_SYS,Id_MenuBigClass,banben,xiugaicishu,ul_row_height'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='sys_jlmb' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv198')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='198' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','sys_jlmb','DeskMenuDiv198');form_add_copy('DeskMenuDiv198');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>