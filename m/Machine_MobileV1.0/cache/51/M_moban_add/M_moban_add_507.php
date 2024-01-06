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
		$sql = "select * From `SQP_JiaBanDiaoXiuShiJianHuiZong` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_XingMing=$row["ZD_XingMing"];
		$ZD_NianFen=$row["ZD_NianFen"];
		$ZD_1Ri=$row["ZD_1Ri"];
		$ZD_2Ri=$row["ZD_2Ri"];
		$ZD_3Ri=$row["ZD_3Ri"];
		$ZD_4Ri=$row["ZD_4Ri"];
		$ZD_5Ri=$row["ZD_5Ri"];
		$ZD_6Ri=$row["ZD_6Ri"];
		$ZD_7Ri=$row["ZD_7Ri"];
		$ZD_8Ri=$row["ZD_8Ri"];
		$ZD_9Ri=$row["ZD_9Ri"];
		$ZD_10Ri=$row["ZD_10Ri"];
		$ZD_11Ri=$row["ZD_11Ri"];
		$ZD_12Ri=$row["ZD_12Ri"];
		$ZD_13Ri=$row["ZD_13Ri"];
		$ZD_14Ri=$row["ZD_14Ri"];
		$ZD_15Ri=$row["ZD_15Ri"];
		$ZD_16Ri=$row["ZD_16Ri"];
		$ZD_17Ri=$row["ZD_17Ri"];
		$ZD_18Ri=$row["ZD_18Ri"];
		$ZD_19Ri=$row["ZD_19Ri"];
		$ZD_20Ri=$row["ZD_20Ri"];
		$ZD_21Ri=$row["ZD_21Ri"];
		$ZD_22Ri=$row["ZD_22Ri"];
		$ZD_23Ri=$row["ZD_23Ri"];
		$ZD_24Ri=$row["ZD_24Ri"];
		$ZD_25Ri=$row["ZD_25Ri"];
		$ZD_26Ri=$row["ZD_26Ri"];
		$ZD_27Ri=$row["ZD_27Ri"];
		$ZD_28Ri=$row["ZD_28Ri"];
		$ZD_29Ri=$row["ZD_29Ri"];
		$ZD_30Ri=$row["ZD_30Ri"];
		$ZD_31Ri=$row["ZD_31Ri"];
		$ZD_HeJiShiJian=$row["ZD_HeJiShiJian"];
		$ZD_DiaoXiuShiJian=$row["ZD_DiaoXiuShiJian"];
		$ZD_ShiJiJiaBanShiJian=$row["ZD_ShiJiJiaBanShiJian"];
		$ZD_JiaBanGongZi=$row["ZD_JiaBanGongZi"];
		$ZD_BeiZhu=$row["ZD_BeiZhu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_XingMing="";
		$ZD_NianFen="";
		$ZD_1Ri="";
		$ZD_2Ri="";
		$ZD_3Ri="";
		$ZD_4Ri="";
		$ZD_5Ri="";
		$ZD_6Ri="";
		$ZD_7Ri="";
		$ZD_8Ri="";
		$ZD_9Ri="";
		$ZD_10Ri="";
		$ZD_11Ri="";
		$ZD_12Ri="";
		$ZD_13Ri="";
		$ZD_14Ri="";
		$ZD_15Ri="";
		$ZD_16Ri="";
		$ZD_17Ri="";
		$ZD_18Ri="";
		$ZD_19Ri="";
		$ZD_20Ri="";
		$ZD_21Ri="";
		$ZD_22Ri="";
		$ZD_23Ri="";
		$ZD_24Ri="";
		$ZD_25Ri="";
		$ZD_26Ri="";
		$ZD_27Ri="";
		$ZD_28Ri="";
		$ZD_29Ri="";
		$ZD_30Ri="";
		$ZD_31Ri="";
		$ZD_HeJiShiJian="";
		$ZD_DiaoXiuShiJian="";
		$ZD_ShiJiJiaBanShiJian="";
		$ZD_JiaBanGongZi="";
		$ZD_BeiZhu="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>姓名:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XingMing' id='ZD_XingMing' class='addboxinput inputfocus'  value='<?php echo $ZD_XingMing ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XingMing_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>年份:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_NianFen' id='ZD_NianFen' class='addboxinput inputfocus'  value='<?php echo $ZD_NianFen ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_NianFen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>1日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_1Ri' id='ZD_1Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_1Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_1Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>2日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_2Ri' id='ZD_2Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_2Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_2Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>3日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_3Ri' id='ZD_3Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_3Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_3Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>4日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_4Ri' id='ZD_4Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_4Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_4Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>5日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_5Ri' id='ZD_5Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_5Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_5Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>6日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_6Ri' id='ZD_6Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_6Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_6Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>7日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_7Ri' id='ZD_7Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_7Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_7Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>8日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_8Ri' id='ZD_8Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_8Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_8Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>9日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_9Ri' id='ZD_9Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_9Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_9Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>10日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_10Ri' id='ZD_10Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_10Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_10Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>11日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_11Ri' id='ZD_11Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_11Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_11Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>12日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_12Ri' id='ZD_12Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_12Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_12Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>13日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_13Ri' id='ZD_13Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_13Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_13Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>14日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_14Ri' id='ZD_14Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_14Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_14Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>15日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_15Ri' id='ZD_15Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_15Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_15Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>16日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_16Ri' id='ZD_16Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_16Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_16Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>17日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_17Ri' id='ZD_17Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_17Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_17Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>18日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_18Ri' id='ZD_18Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_18Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_18Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>19日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_19Ri' id='ZD_19Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_19Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_19Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>20日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_20Ri' id='ZD_20Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_20Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_20Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>21日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_21Ri' id='ZD_21Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_21Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_21Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>22日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_22Ri' id='ZD_22Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_22Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_22Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>23日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_23Ri' id='ZD_23Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_23Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_23Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>24日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_24Ri' id='ZD_24Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_24Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_24Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>25日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_25Ri' id='ZD_25Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_25Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_25Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>26日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_26Ri' id='ZD_26Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_26Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_26Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>27日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_27Ri' id='ZD_27Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_27Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_27Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>28日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_28Ri' id='ZD_28Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_28Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_28Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>29日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_29Ri' id='ZD_29Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_29Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_29Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>30日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_30Ri' id='ZD_30Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_30Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_30Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>31日:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_31Ri' id='ZD_31Ri' class='addboxinput inputfocus'  value='<?php echo $ZD_31Ri ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_31Ri_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>合计时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HeJiShiJian' id='ZD_HeJiShiJian' class='addboxinput inputfocus'  value='<?php echo $ZD_HeJiShiJian ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_HeJiShiJian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>调休时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DiaoXiuShiJian' id='ZD_DiaoXiuShiJian' class='addboxinput inputfocus'  value='<?php echo $ZD_DiaoXiuShiJian ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_DiaoXiuShiJian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>实际加班时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShiJiJiaBanShiJian' id='ZD_ShiJiJiaBanShiJian' class='addboxinput inputfocus'  value='<?php echo $ZD_ShiJiJiaBanShiJian ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShiJiJiaBanShiJian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>加班工资:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiaBanGongZi' id='ZD_JiaBanGongZi' class='addboxinput inputfocus'  value='<?php echo $ZD_JiaBanGongZi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiaBanGongZi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>备注:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus' style='width:100%;height:25px;'   ><?php echo $ZD_BeiZhu ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ZD_BeiZhu_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv507',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingMing,ZD_NianFen,ZD_1Ri,ZD_2Ri,ZD_3Ri,ZD_4Ri,ZD_5Ri,ZD_6Ri,ZD_7Ri,ZD_8Ri,ZD_9Ri,ZD_10Ri,ZD_11Ri,ZD_12Ri,ZD_13Ri,ZD_14Ri,ZD_15Ri,ZD_16Ri,ZD_17Ri,ZD_18Ri,ZD_19Ri,ZD_20Ri,ZD_21Ri,ZD_22Ri,ZD_23Ri,ZD_24Ri,ZD_25Ri,ZD_26Ri,ZD_27Ri,ZD_28Ri,ZD_29Ri,ZD_30Ri,ZD_31Ri,ZD_HeJiShiJian,ZD_DiaoXiuShiJian,ZD_ShiJiJiaBanShiJian,ZD_JiaBanGongZi,ZD_BeiZhu'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='SQP_JiaBanDiaoXiuShiJianHuiZong' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv507')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='507' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_JiaBanDiaoXiuShiJianHuiZong','DeskMenuDiv507');form_add_copy('DeskMenuDiv507');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>