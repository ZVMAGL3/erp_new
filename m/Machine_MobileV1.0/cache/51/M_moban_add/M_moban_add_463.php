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
		$sql = "select * From `msc_yonghudenglujilu` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$SYS_YongHuMing=$row["SYS_YongHuMing"];
		$SYS_ShouJi=$row["SYS_ShouJi"];
		$SYS_SuoShuGongSi=$row["SYS_SuoShuGongSi"];
		$SYS_IPDiZhi=$row["SYS_IPDiZhi"];
		$SYS_QuanXian=$row["SYS_QuanXian"];
		$SYS_QuanXian_Name=$row["SYS_QuanXian_Name"];
		$SYS_DiZhi=$row["SYS_DiZhi"];
		$SYS_HTTP_REFERER=$row["SYS_HTTP_REFERER"];
		$SYS_PC_Mobile=$row["SYS_PC_Mobile"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$SYS_YongHuMing="";
		$SYS_ShouJi="";
		$SYS_SuoShuGongSi="";
		$SYS_IPDiZhi="";
		$SYS_QuanXian="";
		$SYS_QuanXian_Name="";
		$SYS_DiZhi="";
		$SYS_HTTP_REFERER="";
		$SYS_PC_Mobile="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>用户名:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_YongHuMing' id='SYS_YongHuMing' class='addboxinput inputfocus'  value='<?php echo $SYS_YongHuMing ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_YongHuMing_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>手机:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_ShouJi' id='SYS_ShouJi' class='addboxinput inputfocus'  value='<?php echo $SYS_ShouJi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_ShouJi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>所属公司:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_SuoShuGongSi' id='SYS_SuoShuGongSi' class='addboxinput inputfocus'  value='<?php echo $SYS_SuoShuGongSi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_SuoShuGongSi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>IP地址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_IPDiZhi' id='SYS_IPDiZhi' class='addboxinput inputfocus'  value='<?php echo $SYS_IPDiZhi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_IPDiZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>职位ID:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_QuanXian' id='SYS_QuanXian' class='addboxinput inputfocus'  value='<?php echo $SYS_QuanXian ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_QuanXian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>职位名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_QuanXian_Name' id='SYS_QuanXian_Name' class='addboxinput inputfocus'  value='<?php echo $SYS_QuanXian_Name ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_QuanXian_Name_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>地址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_DiZhi' id='SYS_DiZhi' class='addboxinput inputfocus'  value='<?php echo $SYS_DiZhi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_DiZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>来路网址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_HTTP_REFERER' id='SYS_HTTP_REFERER' class='addboxinput inputfocus'  value='<?php echo $SYS_HTTP_REFERER ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_HTTP_REFERER_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>设备:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_PC_Mobile' id='SYS_PC_Mobile' class='addboxinput inputfocus'  value='<?php echo $SYS_PC_Mobile ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_PC_Mobile_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv463',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','id')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SYS_YongHuMing,SYS_ShouJi,SYS_SuoShuGongSi,SYS_IPDiZhi,SYS_QuanXian,SYS_QuanXian_Name,SYS_DiZhi,SYS_HTTP_REFERER,SYS_PC_Mobile'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='msc_yonghudenglujilu' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv463')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='463' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','msc_yonghudenglujilu','DeskMenuDiv463');form_add_copy('DeskMenuDiv463');inputfocusfirst('#addbox .htmlleirong','id');</script>

<?php 
mysqli_close( $Connadmin ); //关闭数据库

?>