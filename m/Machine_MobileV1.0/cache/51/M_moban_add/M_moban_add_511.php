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
		$sql = "select * From `SQP_CCCFeiYongChaXun` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_ChanPinMingChen=$row["ZD_ChanPinMingChen"];
		$ZD_DuiYingXiangGuanChanPinMingChen=$row["ZD_DuiYingXiangGuanChanPinMingChen"];
		$sys_id_zu=$row["sys_id_zu"];
		$ZD_ZhiXingBiaoZhun=$row["ZD_ZhiXingBiaoZhun"];
		$ZD_QuanXiangJianCeFei=$row["ZD_QuanXiangJianCeFei"];
		$ZD_ZiXunFei=$row["ZD_ZiXunFei"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_ChanPinMingChen="";
		$ZD_DuiYingXiangGuanChanPinMingChen="";
		$sys_id_zu="";
		$ZD_ZhiXingBiaoZhun="";
		$ZD_QuanXiangJianCeFei="";
		$ZD_ZiXunFei="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>产品名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ChanPinMingChen' id='ZD_ChanPinMingChen' class='addboxinput inputfocus' value='<?php echo $ZD_ChanPinMingChen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ChanPinMingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>对应相关产品名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DuiYingXiangGuanChanPinMingChen' id='ZD_DuiYingXiangGuanChanPinMingChen' class='addboxinput inputfocus' value='<?php echo $ZD_DuiYingXiangGuanChanPinMingChen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_DuiYingXiangGuanChanPinMingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>分类:</li>
		                 <li class='cols02 reset_list'>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu1' tit='<?php echo $sys_id_zu ?>' cnval='一、电线组件' value='<?php echo $sys_id_zu ?>' valid='504' valstr='' class='addboxinput inputfocus' >一、电线组件&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu2' tit='<?php echo $sys_id_zu ?>' cnval='七、热熔断器' value='<?php echo $sys_id_zu ?>' valid='510' valstr='' class='addboxinput inputfocus' >七、热熔断器&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu3' tit='<?php echo $sys_id_zu ?>' cnval='三、家用及类似用途插头插座' value='<?php echo $sys_id_zu ?>' valid='506' valstr='' class='addboxinput inputfocus' >三、家用及类似用途插头插座&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu4' tit='<?php echo $sys_id_zu ?>' cnval='九、小型熔断器的管状熔断体' value='<?php echo $sys_id_zu ?>' valid='512' valstr='' class='addboxinput inputfocus' >九、小型熔断器的管状熔断体&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu5' tit='<?php echo $sys_id_zu ?>' cnval='二、电线电缆产品' value='<?php echo $sys_id_zu ?>' valid='505' valstr='' class='addboxinput inputfocus' >二、电线电缆产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu6' tit='<?php echo $sys_id_zu ?>' cnval='二十、轮胎产品' value='<?php echo $sys_id_zu ?>' valid='523' valstr='' class='addboxinput inputfocus' >二十、轮胎产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu7' tit='<?php echo $sys_id_zu ?>' cnval='二十一、安全玻璃' value='<?php echo $sys_id_zu ?>' valid='524' valstr='' class='addboxinput inputfocus' >二十一、安全玻璃&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu8' tit='<?php echo $sys_id_zu ?>' cnval='二十七、安全技术防范产品' value='<?php echo $sys_id_zu ?>' valid='530' valstr='' class='addboxinput inputfocus' >二十七、安全技术防范产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu9' tit='<?php echo $sys_id_zu ?>' cnval='二十三、橡胶避孕套产品' value='<?php echo $sys_id_zu ?>' valid='526' valstr='' class='addboxinput inputfocus' >二十三、橡胶避孕套产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu10' tit='<?php echo $sys_id_zu ?>' cnval='二十九、装饰装修产品' value='<?php echo $sys_id_zu ?>' valid='532' valstr='' class='addboxinput inputfocus' >二十九、装饰装修产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu11' tit='<?php echo $sys_id_zu ?>' cnval='二十二、植物保护机械' value='<?php echo $sys_id_zu ?>' valid='525' valstr='' class='addboxinput inputfocus' >二十二、植物保护机械&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu12' tit='<?php echo $sys_id_zu ?>' cnval='二十五、医疗器材产品' value='<?php echo $sys_id_zu ?>' valid='528' valstr='' class='addboxinput inputfocus' >二十五、医疗器材产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu13' tit='<?php echo $sys_id_zu ?>' cnval='二十八、汽车安全带产品' value='<?php echo $sys_id_zu ?>' valid='531' valstr='' class='addboxinput inputfocus' >二十八、汽车安全带产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu14' tit='<?php echo $sys_id_zu ?>' cnval='二十六、消防产品' value='<?php echo $sys_id_zu ?>' valid='529' valstr='' class='addboxinput inputfocus' >二十六、消防产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu15' tit='<?php echo $sys_id_zu ?>' cnval='二十四、电信终端设备' value='<?php echo $sys_id_zu ?>' valid='527' valstr='' class='addboxinput inputfocus' >二十四、电信终端设备&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu16' tit='<?php echo $sys_id_zu ?>' cnval='五、工业用插头插座和耦合器' value='<?php echo $sys_id_zu ?>' valid='508' valstr='' class='addboxinput inputfocus' >五、工业用插头插座和耦合器&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu17' tit='<?php echo $sys_id_zu ?>' cnval='八、家用及类似用途固定式电器装置电器附件外壳' value='<?php echo $sys_id_zu ?>' valid='511' valstr='' class='addboxinput inputfocus' >八、家用及类似用途固定式电器装置电器附件外壳&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu18' tit='<?php echo $sys_id_zu ?>' cnval='六、家用及类似用途的器具耦合器' value='<?php echo $sys_id_zu ?>' valid='509' valstr='' class='addboxinput inputfocus' >六、家用及类似用途的器具耦合器&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu19' tit='<?php echo $sys_id_zu ?>' cnval='十、低压器具' value='<?php echo $sys_id_zu ?>' valid='513' valstr='' class='addboxinput inputfocus' >十、低压器具&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu20' tit='<?php echo $sys_id_zu ?>' cnval='十一、小功率电动机' value='<?php echo $sys_id_zu ?>' valid='514' valstr='' class='addboxinput inputfocus' >十一、小功率电动机&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu21' tit='<?php echo $sys_id_zu ?>' cnval='十七、照明电器' value='<?php echo $sys_id_zu ?>' valid='520' valstr='' class='addboxinput inputfocus' >十七、照明电器&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu22' tit='<?php echo $sys_id_zu ?>' cnval='十三、电焊机' value='<?php echo $sys_id_zu ?>' valid='516' valstr='' class='addboxinput inputfocus' >十三、电焊机&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu23' tit='<?php echo $sys_id_zu ?>' cnval='十九、摩托车及摩托车发动机' value='<?php echo $sys_id_zu ?>' valid='522' valstr='' class='addboxinput inputfocus' >十九、摩托车及摩托车发动机&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu24' tit='<?php echo $sys_id_zu ?>' cnval='十二、电动工具' value='<?php echo $sys_id_zu ?>' valid='515' valstr='' class='addboxinput inputfocus' >十二、电动工具&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu25' tit='<?php echo $sys_id_zu ?>' cnval='十五、音视频设备' value='<?php echo $sys_id_zu ?>' valid='518' valstr='' class='addboxinput inputfocus' >十五、音视频设备&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu26' tit='<?php echo $sys_id_zu ?>' cnval='十八、汽车产品' value='<?php echo $sys_id_zu ?>' valid='521' valstr='' class='addboxinput inputfocus' >十八、汽车产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu27' tit='<?php echo $sys_id_zu ?>' cnval='十六、信息技术设备' value='<?php echo $sys_id_zu ?>' valid='519' valstr='' class='addboxinput inputfocus' >十六、信息技术设备&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu28' tit='<?php echo $sys_id_zu ?>' cnval='十四、家用和类似用途设备' value='<?php echo $sys_id_zu ?>' valid='517' valstr='' class='addboxinput inputfocus' >十四、家用和类似用途设备&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu29' tit='<?php echo $sys_id_zu ?>' cnval='四、家用及类似用途固定式电器装置的开关' value='<?php echo $sys_id_zu ?>' valid='507' valstr='' class='addboxinput inputfocus' >四、家用及类似用途固定式电器装置的开关&nbsp;</label><script>Inputdate('sys_id_zu','15','<?php echo $sys_id_zu ?>','DeskMenuDiv511','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='sys_id_zu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>执行标准:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZhiXingBiaoZhun' id='ZD_ZhiXingBiaoZhun' class='addboxinput inputfocus' value='<?php echo $ZD_ZhiXingBiaoZhun ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ZhiXingBiaoZhun_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>全项检测费:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_QuanXiangJianCeFei' id='ZD_QuanXiangJianCeFei' class='addboxinput inputfocus' value='<?php echo $ZD_QuanXiangJianCeFei ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_QuanXiangJianCeFei_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>咨询费:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZiXunFei' id='ZD_ZiXunFei' class='addboxinput inputfocus' value='<?php echo $ZD_ZiXunFei ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ZiXunFei_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv511',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','id')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_ChanPinMingChen,ZD_DuiYingXiangGuanChanPinMingChen,sys_id_zu,ZD_ZhiXingBiaoZhun,ZD_QuanXiangJianCeFei,ZD_ZiXunFei'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='SQP_CCCFeiYongChaXun' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv511')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='511' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_CCCFeiYongChaXun','DeskMenuDiv511');form_add_copy('DeskMenuDiv511');inputfocusfirst('#addbox .htmlleirong','id');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>