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
		$sql = "select * From `SQP_HeTongXiangMuGenZongJiLu` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_GongSiMingChen=$row["ZD_GongSiMingChen"];
		$ZD_QianDingRiQi=$row["ZD_QianDingRiQi"];
		$ZD_HeTongBianHao=$row["ZD_HeTongBianHao"];
		$ZD_XiangMu=$row["ZD_XiangMu"];
		$ZD_JiaoQi=$row["ZD_JiaoQi"];
		$ZD_LianXiRen=$row["ZD_LianXiRen"];
		$ZD_DianHua=$row["ZD_DianHua"];
		$ZD_YuFuKuanJinERiQiZhangHao=$row["ZD_YuFuKuanJinERiQiZhangHao"];
		$ZD_FuWuLiuChengDanQianShouRiQi=$row["ZD_FuWuLiuChengDanQianShouRiQi"];
		$ZD_XiangMuWanChengRiQi=$row["ZD_XiangMuWanChengRiQi"];
		$ZD_WeiKuan=$row["ZD_WeiKuan"];
		$ZD_BeiZhu=$row["ZD_BeiZhu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_GongSiMingChen="";
		$ZD_QianDingRiQi="";
		$ZD_HeTongBianHao="";
		$ZD_XiangMu="";
		$ZD_JiaoQi="";
		$ZD_LianXiRen="";
		$ZD_DianHua="";
		$ZD_YuFuKuanJinERiQiZhangHao="";
		$ZD_FuWuLiuChengDanQianShouRiQi="";
		$ZD_XiangMuWanChengRiQi="";
		$ZD_WeiKuan="";
		$ZD_BeiZhu="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;公司名称:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiMingChen' id='ZD_GongSiMingChen' class='addboxinput inputfocus'  value='<?php echo $ZD_GongSiMingChen ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongSiMingChen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;签订日期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='8' name='ZD_QianDingRiQi' id='ZD_QianDingRiQi' class='addboxinput inputfocus' value='<?php echo $ZD_QianDingRiQi ?>' style='width:100%'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_QianDingRiQi',theme: '#393D49',lang: 'cn'});</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_QianDingRiQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;合同编号:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HeTongBianHao' id='ZD_HeTongBianHao' class='addboxinput inputfocus'  value='<?php echo $ZD_HeTongBianHao ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_HeTongBianHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;项目:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XiangMu' id='ZD_XiangMu' class='addboxinput inputfocus'  value='<?php echo $ZD_XiangMu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XiangMu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;交期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiaoQi' id='ZD_JiaoQi' class='addboxinput inputfocus'  value='<?php echo $ZD_JiaoQi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiaoQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;联系人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_LianXiRen' id='ZD_LianXiRen' class='addboxinput inputfocus'  value='<?php echo $ZD_LianXiRen ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_LianXiRen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;电话:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DianHua' id='ZD_DianHua' class='addboxinput inputfocus'  value='<?php echo $ZD_DianHua ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_DianHua_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>预付款金额/日期/帐号:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_YuFuKuanJinERiQiZhangHao' id='ZD_YuFuKuanJinERiQiZhangHao' class='addboxinput inputfocus'  value='<?php echo $ZD_YuFuKuanJinERiQiZhangHao ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_YuFuKuanJinERiQiZhangHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>服务流程单签收/日期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_FuWuLiuChengDanQianShouRiQi' id='ZD_FuWuLiuChengDanQianShouRiQi' class='addboxinput inputfocus'  value='<?php echo $ZD_FuWuLiuChengDanQianShouRiQi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_FuWuLiuChengDanQianShouRiQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>项目完成/日期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XiangMuWanChengRiQi' id='ZD_XiangMuWanChengRiQi' class='addboxinput inputfocus'  value='<?php echo $ZD_XiangMuWanChengRiQi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XiangMuWanChengRiQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>尾款:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_WeiKuan' id='ZD_WeiKuan' class='addboxinput inputfocus'  value='<?php echo $ZD_WeiKuan ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_WeiKuan_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>备注:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus'  value='<?php echo $ZD_BeiZhu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_BeiZhu_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv499',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','id')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GongSiMingChen,ZD_QianDingRiQi,ZD_HeTongBianHao,ZD_XiangMu,ZD_JiaoQi,ZD_LianXiRen,ZD_DianHua,ZD_YuFuKuanJinERiQiZhangHao,ZD_FuWuLiuChengDanQianShouRiQi,ZD_XiangMuWanChengRiQi,ZD_WeiKuan,ZD_BeiZhu'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='ZD_GongSiMingChen,ZD_QianDingRiQi,ZD_HeTongBianHao,ZD_XiangMu,ZD_JiaoQi,ZD_LianXiRen,ZD_DianHua' databiao='SQP_HeTongXiangMuGenZongJiLu' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv499')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='499' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_HeTongXiangMuGenZongJiLu','DeskMenuDiv499');form_add_copy('DeskMenuDiv499');inputfocusfirst('#addbox .htmlleirong','id');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>