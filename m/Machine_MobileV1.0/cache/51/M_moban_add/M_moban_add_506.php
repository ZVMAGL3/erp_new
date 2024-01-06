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
		$sql = "select * From `sys_GongZiBiao` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_XingMing=$row["ZD_XingMing"];
		$ZD_JiBenGongZi=$row["ZD_JiBenGongZi"];
		$ZD_ZhiWuGongZi=$row["ZD_ZhiWuGongZi"];
		$ZD_NianDuJiaXin=$row["ZD_NianDuJiaXin"];
		$ZD_ChuQinTianShu=$row["ZD_ChuQinTianShu"];
		$ZD_GeRenSheBaoKouChu=$row["ZD_GeRenSheBaoKouChu"];
		$ZD_JiaBanGongZi=$row["ZD_JiaBanGongZi"];
		$ZD_ChuChaBuTie=$row["ZD_ChuChaBuTie"];
		$ZD_XiangMuTiCheng=$row["ZD_XiangMuTiCheng"];
		$ZD_YeWuTiCheng=$row["ZD_YeWuTiCheng"];
		$ZD_QingJiaKouChu=$row["ZD_QingJiaKouChu"];
		$ZD_QuanQinJiang=$row["ZD_QuanQinJiang"];
		$ZD_DangYueShiFa=$row["ZD_DangYueShiFa"];
		$ZD_BeiZhu=$row["ZD_BeiZhu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_XingMing="";
		$ZD_JiBenGongZi="";
		$ZD_ZhiWuGongZi="";
		$ZD_NianDuJiaXin="";
		$ZD_ChuQinTianShu="";
		$ZD_GeRenSheBaoKouChu="";
		$ZD_JiaBanGongZi="";
		$ZD_ChuChaBuTie="";
		$ZD_XiangMuTiCheng="";
		$ZD_YeWuTiCheng="";
		$ZD_QingJiaKouChu="";
		$ZD_QuanQinJiang="";
		$ZD_DangYueShiFa="";
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
		                 <li class='cols01'>基本工资:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiBenGongZi' id='ZD_JiBenGongZi' class='addboxinput inputfocus'  value='<?php echo $ZD_JiBenGongZi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiBenGongZi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>职务工资:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZhiWuGongZi' id='ZD_ZhiWuGongZi' class='addboxinput inputfocus'  value='<?php echo $ZD_ZhiWuGongZi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ZhiWuGongZi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>年度加薪:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_NianDuJiaXin' id='ZD_NianDuJiaXin' class='addboxinput inputfocus'  value='<?php echo $ZD_NianDuJiaXin ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_NianDuJiaXin_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>出勤天数:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ChuQinTianShu' id='ZD_ChuQinTianShu' class='addboxinput inputfocus'  value='<?php echo $ZD_ChuQinTianShu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ChuQinTianShu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>个人社保扣除:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GeRenSheBaoKouChu' id='ZD_GeRenSheBaoKouChu' class='addboxinput inputfocus'  value='<?php echo $ZD_GeRenSheBaoKouChu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GeRenSheBaoKouChu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>加班工资:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiaBanGongZi' id='ZD_JiaBanGongZi' class='addboxinput inputfocus'  value='<?php echo $ZD_JiaBanGongZi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiaBanGongZi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>出差补贴:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ChuChaBuTie' id='ZD_ChuChaBuTie' class='addboxinput inputfocus'  value='<?php echo $ZD_ChuChaBuTie ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ChuChaBuTie_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>项目提成:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XiangMuTiCheng' id='ZD_XiangMuTiCheng' class='addboxinput inputfocus'  value='<?php echo $ZD_XiangMuTiCheng ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XiangMuTiCheng_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>业务提成:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_YeWuTiCheng' id='ZD_YeWuTiCheng' class='addboxinput inputfocus'  value='<?php echo $ZD_YeWuTiCheng ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_YeWuTiCheng_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>请假扣除:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_QingJiaKouChu' id='ZD_QingJiaKouChu' class='addboxinput inputfocus'  value='<?php echo $ZD_QingJiaKouChu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_QingJiaKouChu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>全勤奖:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_QuanQinJiang' id='ZD_QuanQinJiang' class='addboxinput inputfocus'  value='<?php echo $ZD_QuanQinJiang ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_QuanQinJiang_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>当月实发:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DangYueShiFa' id='ZD_DangYueShiFa' class='addboxinput inputfocus'  value='<?php echo $ZD_DangYueShiFa ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_DangYueShiFa_bitian'></div>
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
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv506',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','id')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingMing,ZD_JiBenGongZi,ZD_ZhiWuGongZi,ZD_NianDuJiaXin,ZD_ChuQinTianShu,ZD_GeRenSheBaoKouChu,ZD_JiaBanGongZi,ZD_ChuChaBuTie,ZD_XiangMuTiCheng,ZD_YeWuTiCheng,ZD_QingJiaKouChu,ZD_QuanQinJiang,ZD_DangYueShiFa,ZD_BeiZhu'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='sys_GongZiBiao' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv506')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='506' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','sys_GongZiBiao','DeskMenuDiv506');form_add_copy('DeskMenuDiv506');inputfocusfirst('#addbox .htmlleirong','id');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>