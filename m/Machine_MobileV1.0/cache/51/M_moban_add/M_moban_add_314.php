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
		$sql = "select * From `SQP_ZhaoPinGongYingShang` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$QuDaoMingChen=$row["QuDaoMingChen"];
		$WangZhi=$row["WangZhi"];
		$DiZhi=$row["DiZhi"];
		$ZhangHaoMiMa=$row["ZhangHaoMiMa"];
		$LeiXing=$row["LeiXing"];
		$ZhaoPinJiQiao=$row["ZhaoPinJiQiao"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$QuDaoMingChen="";
		$WangZhi="";
		$DiZhi="";
		$ZhangHaoMiMa="";
		$LeiXing="";
		$ZhaoPinJiQiao="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>渠道名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='QuDaoMingChen' id='QuDaoMingChen' class='addboxinput inputfocus' value='<?php echo $QuDaoMingChen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='QuDaoMingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>网址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='WangZhi' id='WangZhi' class='addboxinput inputfocus' value='<?php echo $WangZhi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='WangZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>地址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='DiZhi' id='DiZhi' class='addboxinput inputfocus' value='<?php echo $DiZhi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='DiZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>帐号密码:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZhangHaoMiMa' id='ZhangHaoMiMa' class='addboxinput inputfocus' value='<?php echo $ZhangHaoMiMa ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZhangHaoMiMa_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>类型:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='LeiXing' id='LeiXing' class='addboxinput inputfocus' value='<?php echo $LeiXing ?>'   />
		                 <div class='cols03 font_red yanzheng' id='LeiXing_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>招聘技巧:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZhaoPinJiQiao' id='ZhaoPinJiQiao' class='addboxinput inputfocus' 25px;'   ><?php echo $ZhaoPinJiQiao ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ZhaoPinJiQiao_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv314',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','id')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='QuDaoMingChen,WangZhi,DiZhi,ZhangHaoMiMa,LeiXing,ZhaoPinJiQiao'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='SQP_ZhaoPinGongYingShang' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv314')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='314' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_ZhaoPinGongYingShang','DeskMenuDiv314');form_add_copy('DeskMenuDiv314');inputfocusfirst('#addbox .htmlleirong','id');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>