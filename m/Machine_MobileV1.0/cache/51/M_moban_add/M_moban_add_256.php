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
		$sql = "select * From `msc_user_reg` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$SYS_GongHao=$row["SYS_GongHao"];
		$SYS_UserName=$row["SYS_UserName"];
		$SYS_ShouJi=$row["SYS_ShouJi"];
		$SYS_ZD_ZaiZhiZhuangTai=$row["SYS_ZD_ZaiZhiZhuangTai"];
		$SYS_reg_num=$row["SYS_reg_num"];
		$SYS_yuangongdanganbiao_id=$row["SYS_yuangongdanganbiao_id"];
		$SYS_PassWord=$row["SYS_PassWord"];
		$SYS_ShenFenZheng=$row["SYS_ShenFenZheng"];
		$SYS_Company_id=$row["SYS_Company_id"];
		$SYS_ZD_QQ=$row["SYS_ZD_QQ"];
		$SYS_Email=$row["SYS_Email"];
		$SYS_QuanXian=$row["SYS_QuanXian"];
		$SYS_XingBie=$row["SYS_XingBie"];
		$SYS_DianHua=$row["SYS_DianHua"];
		$SYS_YinXingKaHao=$row["SYS_YinXingKaHao"];
		$SYS_DiZhi=$row["SYS_DiZhi"];
		$SYS_GongZi=$row["SYS_GongZi"];
		$SYS_StartDate=$row["SYS_StartDate"];
		$SYS_EndDate=$row["SYS_EndDate"];
		$SYS_jib=$row["SYS_jib"];
		$SYS_photo=$row["SYS_photo"];
		$SYS_chaoguan=$row["SYS_chaoguan"];
		$SYS_qianmin=$row["SYS_qianmin"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$SYS_GongHao="0";
		$SYS_UserName="";
		$SYS_ShouJi="";
		$SYS_ZD_ZaiZhiZhuangTai="0";
		$SYS_reg_num="9007";
		$SYS_yuangongdanganbiao_id="";
		$SYS_PassWord="";
		$SYS_ShenFenZheng="";
		$SYS_Company_id="51";
		$SYS_ZD_QQ="";
		$SYS_Email="";
		$SYS_QuanXian="0";
		$SYS_XingBie="";
		$SYS_DianHua="";
		$SYS_YinXingKaHao="";
		$SYS_DiZhi="";
		$SYS_GongZi="0";
		$SYS_StartDate="";
		$SYS_EndDate="";
		$SYS_jib="0";
		$SYS_photo="";
		$SYS_chaoguan="0";
		$SYS_qianmin="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;工号:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_GongHao' id='SYS_GongHao' class='addboxinput inputfocus' value='<?php echo $SYS_GongHao ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_GongHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;用户名:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_UserName' id='SYS_UserName' class='addboxinput inputfocus' value='<?php echo $SYS_UserName ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_UserName_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;手机:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_ShouJi' id='SYS_ShouJi' class='addboxinput inputfocus' value='<?php echo $SYS_ShouJi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_ShouJi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;在职状态:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_ZD_ZaiZhiZhuangTai' id='SYS_ZD_ZaiZhiZhuangTai' class='addboxinput inputfocus' value='<?php echo $SYS_ZD_ZaiZhiZhuangTai ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_ZD_ZaiZhiZhuangTai_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;公司注册号id:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_reg_num' id='SYS_reg_num' class='addboxinput inputfocus' value='<?php echo $SYS_reg_num ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_reg_num_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>对应的会员id:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_yuangongdanganbiao_id' id='SYS_yuangongdanganbiao_id' class='addboxinput inputfocus' value='<?php echo $SYS_yuangongdanganbiao_id ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_yuangongdanganbiao_id_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>密码:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_PassWord' id='SYS_PassWord' class='addboxinput inputfocus' value='<?php echo $SYS_PassWord ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_PassWord_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>身份证:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_ShenFenZheng' id='SYS_ShenFenZheng' class='addboxinput inputfocus' value='<?php echo $SYS_ShenFenZheng ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_ShenFenZheng_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;所属公司ID:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_Company_id' id='SYS_Company_id' class='addboxinput inputfocus' value='<?php echo $SYS_Company_id ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_Company_id_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>QQ:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_ZD_QQ' id='SYS_ZD_QQ' class='addboxinput inputfocus' value='<?php echo $SYS_ZD_QQ ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_ZD_QQ_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>邮件:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_Email' id='SYS_Email' class='addboxinput inputfocus' value='<?php echo $SYS_Email ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_Email_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;权限{职位}:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_QuanXian' id='SYS_QuanXian' class='addboxinput inputfocus' value='<?php echo $SYS_QuanXian ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_QuanXian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>性别:</li>
		                 <li class='cols02 reset_list'><label><input name='SYS_XingBie' type='radio' typeid='11' id='SYS_XingBie_0' value='男' class='addboxinput inputfocus'   checked='checked'    />男&nbsp;&nbsp;&nbsp;</label><label><input name='SYS_XingBie' type='radio' typeid='11' id='SYS_XingBie_1' class='addboxinput inputfocus' value='女'  checked='checked'    />女</label><script>Inputdate('SYS_XingBie','11','<?php echo $SYS_XingBie ?>','DeskMenuDiv256','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='SYS_XingBie_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>电话:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_DianHua' id='SYS_DianHua' class='addboxinput inputfocus' value='<?php echo $SYS_DianHua ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_DianHua_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>银行卡号:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_YinXingKaHao' id='SYS_YinXingKaHao' class='addboxinput inputfocus' value='<?php echo $SYS_YinXingKaHao ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_YinXingKaHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>地址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_DiZhi' id='SYS_DiZhi' class='addboxinput inputfocus' value='<?php echo $SYS_DiZhi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_DiZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>工资:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_GongZi' id='SYS_GongZi' class='addboxinput inputfocus' value='<?php echo $SYS_GongZi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_GongZi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>入职时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_StartDate' id='SYS_StartDate' class='addboxinput inputfocus' value='<?php echo $SYS_StartDate ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_StartDate_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>离职时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_EndDate' id='SYS_EndDate' class='addboxinput inputfocus' value='<?php echo $SYS_EndDate ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_EndDate_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>级别:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_jib' id='SYS_jib' class='addboxinput inputfocus' value='<?php echo $SYS_jib ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_jib_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>头像:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_photo' id='SYS_photo' class='addboxinput inputfocus' value='<?php echo $SYS_photo ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_photo_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>超管:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_chaoguan' id='SYS_chaoguan' class='addboxinput inputfocus' value='<?php echo $SYS_chaoguan ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_chaoguan_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>个性签名:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_qianmin' id='SYS_qianmin' class='addboxinput inputfocus' value='<?php echo $SYS_qianmin ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_qianmin_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv256',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','id')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SYS_GongHao,SYS_UserName,SYS_ShouJi,SYS_ZD_ZaiZhiZhuangTai,SYS_reg_num,SYS_yuangongdanganbiao_id,SYS_PassWord,SYS_ShenFenZheng,SYS_Company_id,SYS_ZD_QQ,SYS_Email,SYS_QuanXian,SYS_XingBie,SYS_DianHua,SYS_YinXingKaHao,SYS_DiZhi,SYS_GongZi,SYS_StartDate,SYS_EndDate,SYS_jib,SYS_photo,SYS_chaoguan,SYS_qianmin'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='SYS_GongHao,SYS_UserName,SYS_ShouJi,SYS_ZD_ZaiZhiZhuangTai,SYS_reg_num,SYS_Company_id,SYS_QuanXian' databiao='msc_user_reg' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv256')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='256' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','msc_user_reg','DeskMenuDiv256');form_add_copy('DeskMenuDiv256');inputfocusfirst('#addbox .htmlleirong','id');</script>

<?php 
mysqli_close( $Connadmin ); //关闭数据库

?>