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
		$sql = "select * From `SQP_GongZuoJiHua` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$GongZuoXiangMu=$row["GongZuoXiangMu"];
		$NaRongYaoQiu=$row["NaRongYaoQiu"];
		$JiaoQi=$row["JiaoQi"];
		$WanCheng=$row["WanCheng"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$GongZuoXiangMu="";
		$NaRongYaoQiu="";
		$JiaoQi="";
		$WanCheng="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>工作项目:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='GongZuoXiangMu' id='GongZuoXiangMu' class='addboxinput inputfocus'  value='<?php echo $GongZuoXiangMu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='GongZuoXiangMu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>内容要求:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='NaRongYaoQiu' id='NaRongYaoQiu' class='addboxinput inputfocus' style='width:100%;height:350px;'   ><?php echo $NaRongYaoQiu ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='NaRongYaoQiu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>交期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='8' name='JiaoQi' id='JiaoQi' class='addboxinput inputfocus' value='<?php echo $JiaoQi ?>' style='width:100%'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#JiaoQi',theme: '#393D49',lang: 'cn'});</script>
		                 <div class='cols03 font_red yanzheng' id='JiaoQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>完成:</li>
		                 <li class='cols02 reset_list'><label><input name='WanCheng' type='radio' typeid='17' id='WanCheng_0' value='是' class='addboxinput inputfocus'    />是&nbsp;&nbsp;&nbsp;</label><label><input name='WanCheng' type='radio' typeid='17' id='WanCheng_1' class='addboxinput inputfocus' value=''   checked='checked'    />否</label><script>Inputdate('WanCheng','17','<?php echo $WanCheng ?>','DeskMenuDiv280','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='WanCheng_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv280',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='GongZuoXiangMu,NaRongYaoQiu,JiaoQi,WanCheng'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='SQP_GongZuoJiHua' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv280')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='280' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_GongZuoJiHua','DeskMenuDiv280');form_add_copy('DeskMenuDiv280');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>