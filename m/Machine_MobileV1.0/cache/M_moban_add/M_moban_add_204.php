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
		$sql = "select * From `sys_yuangongdanganbiao` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$SYS_GongHao=$row["SYS_GongHao"];
		$SYS_UserName=$row["SYS_UserName"];
		$SYS_QuanXian=$row["SYS_QuanXian"];
		$XingBie=$row["XingBie"];
		$SYS_ShouJi=$row["SYS_ShouJi"];
		$GongZi=$row["GongZi"];
		$ZD_GongZiFaFangZhangHu=$row["ZD_GongZiFaFangZhangHu"];
		$SYS_ShenFenZheng=$row["SYS_ShenFenZheng"];
		$ZD_XianZhuDiZhi=$row["ZD_XianZhuDiZhi"];
		$QQ=$row["QQ"];
		$SYS_Email=$row["SYS_Email"];
		$SYS_StartDate=$row["SYS_StartDate"];
		$SYS_EndDate=$row["SYS_EndDate"];
		$zzzt=$row["zzzt"];
		$ZD_HunYinZhuangTai=$row["ZD_HunYinZhuangTai"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$SYS_GongHao="";
		$SYS_UserName="";
		$SYS_QuanXian="";
		$XingBie="";
		$SYS_ShouJi="";
		$GongZi="0";
		$ZD_GongZiFaFangZhangHu="";
		$SYS_ShenFenZheng="";
		$ZD_XianZhuDiZhi="";
		$QQ="";
		$SYS_Email="";
		$SYS_StartDate="";
		$SYS_EndDate="";
		$zzzt="0";
		$ZD_HunYinZhuangTai="未婚";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id=''><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;工号:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_GongHao' id='SYS_GongHao' class='addboxinput inputfocus'  value='<?php echo $SYS_GongHao ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_GongHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;姓名:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_UserName' id='SYS_UserName' class='addboxinput inputfocus'  value='<?php echo $SYS_UserName ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_UserName_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>职位:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_QuanXian' id='SYS_QuanXian' class='addboxinput inputfocus'  value='<?php echo $SYS_QuanXian ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_QuanXian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>性别:</li>
		                 <li class='cols02 reset_list'><label><input name='XingBie' type='radio' typeid='11' id='XingBie_0' value='男' class='addboxinput inputfocus'   checked='checked'    />男&nbsp;&nbsp;&nbsp;</label><label><input name='XingBie' type='radio' typeid='11' id='XingBie_1' class='addboxinput inputfocus' value='女'  checked='checked'    />女</label><script>Inputdate('XingBie','11','<?php echo $XingBie ?>','DeskMenuDiv204','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='XingBie_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;联系方式:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_ShouJi' id='SYS_ShouJi' class='addboxinput inputfocus'  value='<?php echo $SYS_ShouJi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_ShouJi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>工资:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='GongZi' id='GongZi' class='addboxinput inputfocus'  value='<?php echo $GongZi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='GongZi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>工资发放账户:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongZiFaFangZhangHu' id='ZD_GongZiFaFangZhangHu' class='addboxinput inputfocus'  value='<?php echo $ZD_GongZiFaFangZhangHu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongZiFaFangZhangHu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>身份证:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_ShenFenZheng' id='SYS_ShenFenZheng' class='addboxinput inputfocus'  value='<?php echo $SYS_ShenFenZheng ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_ShenFenZheng_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>现住地址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XianZhuDiZhi' id='ZD_XianZhuDiZhi' class='addboxinput inputfocus'  value='<?php echo $ZD_XianZhuDiZhi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XianZhuDiZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>QQ:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='QQ' id='QQ' class='addboxinput inputfocus'  value='<?php echo $QQ ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='QQ_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>邮箱:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_Email' id='SYS_Email' class='addboxinput inputfocus'  value='<?php echo $SYS_Email ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_Email_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;入职时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='8' name='SYS_StartDate' id='SYS_StartDate' class='addboxinput inputfocus' value='<?php echo $SYS_StartDate ?>' style='width:100%'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#SYS_StartDate',theme: '#393D49',lang: 'cn'});</script>
		                 <div class='cols03 font_red yanzheng' id='SYS_StartDate_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>离职时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_EndDate' id='SYS_EndDate' class='addboxinput inputfocus'  value='<?php echo $SYS_EndDate ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_EndDate_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;在职状态:</li>
		                 <li class='cols02 reset_list'><label><input name='zzzt' type='radio' typeid='16' id='zzzt_0' value='在职' class='addboxinput inputfocus'    />在职&nbsp;&nbsp;&nbsp;</label><label><input name='zzzt' type='radio' typeid='16' id='zzzt_1' class='addboxinput inputfocus' value='离职'  checked='checked'    />离职</label><script>Inputdate('zzzt','16','<?php echo $zzzt ?>','DeskMenuDiv204','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='zzzt_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>婚姻状态:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_HunYinZhuangTai' type='radio' typeid='26' id='ZD_HunYinZhuangTai_0' value='已婚' class='addboxinput inputfocus'    />已婚&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_HunYinZhuangTai' type='radio' typeid='26' id='ZD_HunYinZhuangTai_1' class='addboxinput inputfocus' value='未婚'  checked='checked'    />未婚</label><script>Inputdate('ZD_HunYinZhuangTai','26','<?php echo $ZD_HunYinZhuangTai ?>','DeskMenuDiv204','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_HunYinZhuangTai_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv204',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','id')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SYS_GongHao,SYS_UserName,SYS_QuanXian,XingBie,SYS_ShouJi,GongZi,ZD_GongZiFaFangZhangHu,SYS_ShenFenZheng,ZD_XianZhuDiZhi,QQ,SYS_Email,SYS_StartDate,SYS_EndDate,zzzt,ZD_HunYinZhuangTai'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='' strmk_id='' firstinputname='id' bitian_Arry='SYS_GongHao,SYS_UserName,SYS_ShouJi,SYS_StartDate,zzzt' databiao='sys_yuangongdanganbiao' Wuchongfu_Arry='SYS_GongHao,SYS_ShouJi' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv204')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='204' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'SYS_GongHao,SYS_ShouJi','sys_yuangongdanganbiao','DeskMenuDiv204');form_add_copy('DeskMenuDiv204');inputfocusfirst('#addbox .htmlleirong','id');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>