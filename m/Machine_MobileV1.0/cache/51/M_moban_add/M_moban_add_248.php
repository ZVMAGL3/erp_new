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
		$sql = "select * From `SQP_GuoChengGuanXiTu` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$sys_login=$row["sys_login"];
		$sys_id_zu=$row["sys_id_zu"];
		$sys_shenpi=$row["sys_shenpi"];
		$sys_shenpi_all=$row["sys_shenpi_all"];
		$sys_chaosong=$row["sys_chaosong"];
		$sys_paixu=$row["sys_paixu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$sys_login="";
		$sys_id_zu="";
		$sys_shenpi="";
		$sys_shenpi_all="";
		$sys_chaosong="";
		$sys_paixu="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>编制人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_login' id='sys_login' class='addboxinput inputfocus' value='<?php echo $sys_login ?>'   readonly  />
		                 <div class='cols03 font_red yanzheng' id='sys_login_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>分类:</li>
		                 <li class='cols02 reset_list'>
<label><input type='checkbox' typeid='15' name='sys_id_zu' id='sys_id_zu0' tit=' <?php echo $sys_id_zu ?>' value='' class='addboxinput inputfocus' checked>&nbsp;所有分类&nbsp;</label><script>Inputdate('sys_id_zu','15','<?php echo $sys_id_zu ?>','DeskMenuDiv248','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='sys_id_zu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>审核:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='20' name='sys_shenpi' id='sys_shenpi' class='addboxinput inputfocus'  placeholder='请审核'  y-value='<?php echo $sys_shenpi ?>'  value='<?php echo $sys_shenpi ?>'  onclick='SignSH(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='SignSH(this)'><i class='fa fa-20-3'></i></a>
		                 <div class='cols03 font_red yanzheng' id='sys_shenpi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>批准:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='22' name='sys_shenpi_all' id='sys_shenpi_all' class='addboxinput inputfocus' placeholder='请批准'  y-value='<?php echo $sys_shenpi_all ?>'  value='<?php echo $sys_shenpi_all ?>'  onclick='SignPZ(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='SignPZ(this)'><i class='fa fa-20-4'></i></a>
		                 <div class='cols03 font_red yanzheng' id='sys_shenpi_all_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>经办人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_chaosong' id='sys_chaosong' class='addboxinput inputfocus' value='<?php echo $sys_chaosong ?>'   />
		                 <div class='cols03 font_red yanzheng' id='sys_chaosong_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>排序:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_paixu' id='sys_paixu' class='addboxinput inputfocus' value='<?php echo $sys_paixu ?>'   />
		                 <div class='cols03 font_red yanzheng' id='sys_paixu_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv248',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','id')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='sys_login,sys_id_zu,sys_shenpi,sys_shenpi_all,sys_chaosong,sys_paixu'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='SQP_GuoChengGuanXiTu' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv248')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='248' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_GuoChengGuanXiTu','DeskMenuDiv248');form_add_copy('DeskMenuDiv248');inputfocusfirst('#addbox .htmlleirong','id');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>