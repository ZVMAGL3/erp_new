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
		$sql = "select * From `msc_user_hy` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$user_id=$row["user_id"];
		$state=$row["state"];
		$SYS_GongHao=$row["SYS_GongHao"];
		$zhiwei_id=$row["zhiwei_id"];
		$add_time=$row["add_time"];
		$new_time=$row["new_time"];
		$Remark=$row["Remark"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$user_id="";
		$state="";
		$SYS_GongHao="";
		$zhiwei_id="";
		$add_time="";
		$new_time="";
		$Remark="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>用户ID:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='user_id' id='user_id' class='addboxinput inputfocus' value='<?php echo $user_id ?>'   />
		                 <div class='cols03 font_red yanzheng' id='user_id_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>状态:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='state' id='state' class='addboxinput inputfocus' value='<?php echo $state ?>'   />
		                 <div class='cols03 font_red yanzheng' id='state_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>工号:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_GongHao' id='SYS_GongHao' class='addboxinput inputfocus' value='<?php echo $SYS_GongHao ?>'   />
		                 <div class='cols03 font_red yanzheng' id='SYS_GongHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>职位ID:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='zhiwei_id' id='zhiwei_id' class='addboxinput inputfocus' value='<?php echo $zhiwei_id ?>'   />
		                 <div class='cols03 font_red yanzheng' id='zhiwei_id_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>添加时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='9' name='add_time' id='add_time' class='addboxinput inputfocus' value='<?php echo $add_time ?>'    /><a class='jia jiaok'  onclick=''><i class='fa fa-25-03'></i></a><script>laydate.render({  elem: '#add_time',theme: '#393D49',type: 'datetime',lang: 'cn'});</script>
		                 <div class='cols03 font_red yanzheng' id='add_time_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>上次更新时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='9' name='new_time' id='new_time' class='addboxinput inputfocus' value='<?php echo $new_time ?>'    /><a class='jia jiaok'  onclick=''><i class='fa fa-25-03'></i></a><script>laydate.render({  elem: '#new_time',theme: '#393D49',type: 'datetime',lang: 'cn'});</script>
		                 <div class='cols03 font_red yanzheng' id='new_time_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>备注:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='Remark' id='Remark' class='addboxinput inputfocus' value='<?php echo $Remark ?>'   />
		                 <div class='cols03 font_red yanzheng' id='Remark_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv529',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','id')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='user_id,state,SYS_GongHao,zhiwei_id,add_time,new_time,Remark'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='msc_user_hy' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv529')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='529' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','msc_user_hy','DeskMenuDiv529');form_add_copy('DeskMenuDiv529');inputfocusfirst('#addbox .htmlleirong','id');</script>

<?php 
mysqli_close( $Connadmin ); //关闭数据库

?>