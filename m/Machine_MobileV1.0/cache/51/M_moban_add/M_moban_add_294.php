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
		$sql = "select * From `SQP_GongZiMingXi` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_YuanGongXingMing=$row["ZD_YuanGongXingMing"];
		$ZD_JiangLiFenLei=$row["ZD_JiangLiFenLei"];
		$ZD_JiangLiHuoBi=$row["ZD_JiangLiHuoBi"];
		$ZD_JiangLiJiFen=$row["ZD_JiangLiJiFen"];
		$ZD_ChuFaHuoBi=$row["ZD_ChuFaHuoBi"];
		$ZD_ChuFaJiFen=$row["ZD_ChuFaJiFen"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_YuanGongXingMing="";
		$ZD_JiangLiFenLei="";
		$ZD_JiangLiHuoBi="";
		$ZD_JiangLiJiFen="";
		$ZD_ChuFaHuoBi="";
		$ZD_ChuFaJiFen="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>员工姓名:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_YuanGongXingMing' id='ZD_YuanGongXingMing' class='addboxinput inputfocus'  value='<?php echo $ZD_YuanGongXingMing ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_YuanGongXingMing_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>奖励分类:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiangLiFenLei' id='ZD_JiangLiFenLei' class='addboxinput inputfocus'  value='<?php echo $ZD_JiangLiFenLei ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiangLiFenLei_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>奖励货币:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiangLiHuoBi' id='ZD_JiangLiHuoBi' class='addboxinput inputfocus'  value='<?php echo $ZD_JiangLiHuoBi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiangLiHuoBi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>奖励积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiangLiJiFen' id='ZD_JiangLiJiFen' class='addboxinput inputfocus'  value='<?php echo $ZD_JiangLiJiFen ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiangLiJiFen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>处罚货币:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ChuFaHuoBi' id='ZD_ChuFaHuoBi' class='addboxinput inputfocus'  value='<?php echo $ZD_ChuFaHuoBi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ChuFaHuoBi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>处罚积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ChuFaJiFen' id='ZD_ChuFaJiFen' class='addboxinput inputfocus'  value='<?php echo $ZD_ChuFaJiFen ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ChuFaJiFen_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv294',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','id')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_YuanGongXingMing,ZD_JiangLiFenLei,ZD_JiangLiHuoBi,ZD_JiangLiJiFen,ZD_ChuFaHuoBi,ZD_ChuFaJiFen'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='SQP_GongZiMingXi' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv294')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='294' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_GongZiMingXi','DeskMenuDiv294');form_add_copy('DeskMenuDiv294');inputfocusfirst('#addbox .htmlleirong','id');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>