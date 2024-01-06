<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'M_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Connadmin.php";
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
	    if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                                //1回收站0为不回收
	    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                               //是否为回收站0为不回收
	   
	    global $strmk_id,$Connadmin,$const_q_tianj;
	
		$Conn=$Connadmin;

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `msc_RenZhengMoBan` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$sys_title=$row["sys_title"];
		$sys_hangye=$row["sys_hangye"];
		$sys_name=$row["sys_name"];
		$sys_file=$row["sys_file"];
		$sys_beizhu=$row["sys_beizhu"];
		$sys_Id_MenuBigClass=$row["sys_Id_MenuBigClass"];
		$sys_id_zu=$row["sys_id_zu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$sys_title="";
		$sys_hangye="";
		$sys_name="";
		$sys_file="";
		$sys_beizhu="";
		$sys_Id_MenuBigClass="";
		$sys_id_zu="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>模版名:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_title' id='sys_title' class='addboxinput inputfocus'  value='<?php echo $sys_title ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='sys_title_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>所属行业:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_hangye' id='sys_hangye' class='addboxinput inputfocus'  value='<?php echo $sys_hangye ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='sys_hangye_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>替换为:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_name' id='sys_name' class='addboxinput inputfocus'  value='<?php echo $sys_name ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='sys_name_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>文件清单:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_file' id='sys_file' class='addboxinput inputfocus'  value='<?php echo $sys_file ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='sys_file_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>说明:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_beizhu' id='sys_beizhu' class='addboxinput inputfocus'  value='<?php echo $sys_beizhu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='sys_beizhu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>所属标准:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_Id_MenuBigClass' id='sys_Id_MenuBigClass' class='addboxinput inputfocus'  value='<?php echo $sys_Id_MenuBigClass ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='sys_Id_MenuBigClass_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>分类:</li>
		                 <li class='cols02 reset_list'>
<label><input type='checkbox' typeid='15' name='sys_id_zu' id='sys_id_zu0' tit=' <?php echo $sys_id_zu ?>' value='' class='addboxinput inputfocus' checked>&nbsp;所有分类&nbsp;</label><script>Inputdate('sys_id_zu','15','<?php echo $sys_id_zu ?>','DeskMenuDiv517','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='sys_id_zu_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv517',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='sys_title,sys_hangye,sys_name,sys_file,sys_beizhu,sys_Id_MenuBigClass,sys_id_zu'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='msc_RenZhengMoBan' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv517')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='517' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','msc_RenZhengMoBan','DeskMenuDiv517');form_add_copy('DeskMenuDiv517');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Connadmin ); //关闭数据库

?>