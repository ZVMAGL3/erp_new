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
		$sql = "select * From `SQP_JieChuLaoDongHeTongZhengMingShu` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_XingMing=$row["ZD_XingMing"];
		$ZD_XingBie=$row["ZD_XingBie"];
		$ZD_ShenFenZhengHao=$row["ZD_ShenFenZhengHao"];
		$ZD_QiShiGongZuoShiJian=$row["ZD_QiShiGongZuoShiJian"];
		$ZD_SuoJieChuLaoDongHeTongQiXian=$row["ZD_SuoJieChuLaoDongHeTongQiXian"];
		$ZD_LiZhiYuanYin=$row["ZD_LiZhiYuanYin"];
		$ZD_JieChuLaoDongHeTongShiJian=$row["ZD_JieChuLaoDongHeTongShiJian"];
		$ZD_LaoDongZheQianZi=$row["ZD_LaoDongZheQianZi"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_XingMing="";
		$ZD_XingBie="";
		$ZD_ShenFenZhengHao="";
		$ZD_QiShiGongZuoShiJian="";
		$ZD_SuoJieChuLaoDongHeTongQiXian="";
		$ZD_LiZhiYuanYin="";
		$ZD_JieChuLaoDongHeTongShiJian="";
		$ZD_LaoDongZheQianZi="";

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
		                 <li class='cols01'>性别:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_XingBie' type='radio' typeid='11' id='ZD_XingBie_0' value='男' class='addboxinput inputfocus'   checked='checked'    />男&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XingBie' type='radio' typeid='11' id='ZD_XingBie_1' class='addboxinput inputfocus' value='女'  checked='checked'    />女</label><script>Inputdate('ZD_XingBie','11','<?php echo $ZD_XingBie ?>','DeskMenuDiv503','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_XingBie_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>身份证号:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenFenZhengHao' id='ZD_ShenFenZhengHao' class='addboxinput inputfocus'  value='<?php echo $ZD_ShenFenZhengHao ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenFenZhengHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>起始工作时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='8' name='ZD_QiShiGongZuoShiJian' id='ZD_QiShiGongZuoShiJian' class='addboxinput inputfocus' value='<?php echo $ZD_QiShiGongZuoShiJian ?>' style='width:100%'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_QiShiGongZuoShiJian',theme: '#393D49',lang: 'cn'});</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_QiShiGongZuoShiJian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>所解除劳动合同期限:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_SuoJieChuLaoDongHeTongQiXian' id='ZD_SuoJieChuLaoDongHeTongQiXian' class='addboxinput inputfocus'  value='<?php echo $ZD_SuoJieChuLaoDongHeTongQiXian ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_SuoJieChuLaoDongHeTongQiXian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>离职原因:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_LiZhiYuanYin' id='ZD_LiZhiYuanYin' class='addboxinput inputfocus' style='width:100%;height:25px;'   ><?php echo $ZD_LiZhiYuanYin ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ZD_LiZhiYuanYin_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>解除劳动合同时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='8' name='ZD_JieChuLaoDongHeTongShiJian' id='ZD_JieChuLaoDongHeTongShiJian' class='addboxinput inputfocus' value='<?php echo $ZD_JieChuLaoDongHeTongShiJian ?>' style='width:100%'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_JieChuLaoDongHeTongShiJian',theme: '#393D49',lang: 'cn'});</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_JieChuLaoDongHeTongShiJian_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>劳动者签字:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_LaoDongZheQianZi' type='radio' typeid='17' id='ZD_LaoDongZheQianZi_0' value='是' class='addboxinput inputfocus'    />是&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_LaoDongZheQianZi' type='radio' typeid='17' id='ZD_LaoDongZheQianZi_1' class='addboxinput inputfocus' value=''   checked='checked'    />否</label><script>Inputdate('ZD_LaoDongZheQianZi','17','<?php echo $ZD_LaoDongZheQianZi ?>','DeskMenuDiv503','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_LaoDongZheQianZi_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv503',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','id')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingMing,ZD_XingBie,ZD_ShenFenZhengHao,ZD_QiShiGongZuoShiJian,ZD_SuoJieChuLaoDongHeTongQiXian,ZD_LiZhiYuanYin,ZD_JieChuLaoDongHeTongShiJian,ZD_LaoDongZheQianZi'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='SQP_JieChuLaoDongHeTongZhengMingShu' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv503')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='503' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_JieChuLaoDongHeTongZhengMingShu','DeskMenuDiv503');form_add_copy('DeskMenuDiv503');inputfocusfirst('#addbox .htmlleirong','id');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>