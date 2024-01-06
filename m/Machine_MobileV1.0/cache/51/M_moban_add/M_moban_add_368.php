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
		$sql = "select * From `sys_xiuguaijilu` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$sys_re_id=$row["sys_re_id"];
		$sys_edit_id=$row["sys_edit_id"];
		$sys_editcontent=$row["sys_editcontent"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$sys_re_id="";
		$sys_edit_id="";
		$sys_editcontent="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>对应表id:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_re_id' id='sys_re_id' class='addboxinput inputfocus' value='<?php echo $sys_re_id ?>'   />
		                 <div class='cols03 font_red yanzheng' id='sys_re_id_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>记录ID:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_edit_id' id='sys_edit_id' class='addboxinput inputfocus' value='<?php echo $sys_edit_id ?>'   />
		                 <div class='cols03 font_red yanzheng' id='sys_edit_id_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>修改内容:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_editcontent' id='sys_editcontent' class='addboxinput inputfocus' value='<?php echo $sys_editcontent ?>'   />
		                 <div class='cols03 font_red yanzheng' id='sys_editcontent_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv368',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','id')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='sys_re_id,sys_edit_id,sys_editcontent'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='sys_xiuguaijilu' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv368')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='368' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','sys_xiuguaijilu','DeskMenuDiv368');form_add_copy('DeskMenuDiv368');inputfocusfirst('#addbox .htmlleirong','id');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>