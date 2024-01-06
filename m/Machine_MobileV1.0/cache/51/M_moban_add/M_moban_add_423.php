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
		$sql = "select * From `SQP_GuKeHeTong` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_SuoShuGuKe=$row["ZD_SuoShuGuKe"];
		$ZD_HeTongBianHao=$row["ZD_HeTongBianHao"];
		$ZD_HeTongJinE=$row["ZD_HeTongJinE"];
		$ZD_XiangMu=$row["ZD_XiangMu"];
		$ZD_LianXiRen=$row["ZD_LianXiRen"];
		$ZD_DianHua=$row["ZD_DianHua"];
		$ZD_DiZhi=$row["ZD_DiZhi"];
		$ZD_QianDingRiQi=$row["ZD_QianDingRiQi"];
		$ZD_JiaoQi=$row["ZD_JiaoQi"];
		$ZD_QianDingDiDian=$row["ZD_QianDingDiDian"];
		$ZD_XiangMuJingLi=$row["ZD_XiangMuJingLi"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_SuoShuGuKe="";
		$ZD_HeTongBianHao="";
		$ZD_HeTongJinE="";
		$ZD_XiangMu="";
		$ZD_LianXiRen="";
		$ZD_DianHua="";
		$ZD_DiZhi="";
		$ZD_QianDingRiQi="";
		$ZD_JiaoQi="";
		$ZD_QianDingDiDian="";
		$ZD_XiangMuJingLi="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>所属顾客:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_SuoShuGuKe' id='ZD_SuoShuGuKe' class='addboxinput inputfocus' value='<?php echo $ZD_SuoShuGuKe ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_SuoShuGuKe_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>合同编号:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HeTongBianHao' id='ZD_HeTongBianHao' class='addboxinput inputfocus' value='<?php echo $ZD_HeTongBianHao ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_HeTongBianHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>合同金额:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HeTongJinE' id='ZD_HeTongJinE' class='addboxinput inputfocus' value='<?php echo $ZD_HeTongJinE ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_HeTongJinE_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>项目:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XiangMu' id='ZD_XiangMu' class='addboxinput inputfocus' value='<?php echo $ZD_XiangMu ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XiangMu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>联系人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_LianXiRen' id='ZD_LianXiRen' class='addboxinput inputfocus' value='<?php echo $ZD_LianXiRen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_LianXiRen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>电话:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DianHua' id='ZD_DianHua' class='addboxinput inputfocus' value='<?php echo $ZD_DianHua ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_DianHua_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>地址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DiZhi' id='ZD_DiZhi' class='addboxinput inputfocus' value='<?php echo $ZD_DiZhi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_DiZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;签订日期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='8' name='ZD_QianDingRiQi' id='ZD_QianDingRiQi' class='addboxinput inputfocus' value='<?php echo $ZD_QianDingRiQi ?>'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_QianDingRiQi',theme: '#393D49',lang: 'cn'});</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_QianDingRiQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;交期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiaoQi' id='ZD_JiaoQi' class='addboxinput inputfocus' value='<?php echo $ZD_JiaoQi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiaoQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>签订地点:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_QianDingDiDian' id='ZD_QianDingDiDian' class='addboxinput inputfocus' value='<?php echo $ZD_QianDingDiDian ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_QianDingDiDian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>项目经理:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XiangMuJingLi' id='ZD_XiangMuJingLi' class='addboxinput inputfocus' value='<?php echo $ZD_XiangMuJingLi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XiangMuJingLi_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv423',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_SuoShuGuKe,ZD_HeTongBianHao,ZD_HeTongJinE,ZD_XiangMu,ZD_LianXiRen,ZD_DianHua,ZD_DiZhi,ZD_QianDingRiQi,ZD_JiaoQi,ZD_QianDingDiDian,ZD_XiangMuJingLi'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='ZD_QianDingRiQi,ZD_JiaoQi' databiao='SQP_GuKeHeTong' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv423')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='423' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_GuKeHeTong','DeskMenuDiv423');form_add_copy('DeskMenuDiv423');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>