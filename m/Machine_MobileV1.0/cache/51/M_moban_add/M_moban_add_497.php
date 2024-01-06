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
		$sql = "select * From `SQP_MeiRiGongZuoHuiBaoBiao` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_HuiBaoRen=$row["ZD_HuiBaoRen"];
		$ZD_XiangXiMiaoShu=$row["ZD_XiangXiMiaoShu"];
		$ZD_HuiBaoRiQi=$row["ZD_HuiBaoRiQi"];
		$ZD_WanChengQingKuang=$row["ZD_WanChengQingKuang"];
		$ZD_JiFen=$row["ZD_JiFen"];
		$ZD_ShenYueRen=$row["ZD_ShenYueRen"];
		$ZD_ShenYueShiJian=$row["ZD_ShenYueShiJian"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_HuiBaoRen="$SYS_UserName-($bh)";
		$ZD_XiangXiMiaoShu="";
		$ZD_HuiBaoRiQi="";
		$ZD_WanChengQingKuang="";
		$ZD_JiFen="";
		$ZD_ShenYueRen="";
		$ZD_ShenYueShiJian="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;汇报人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='23' name='ZD_HuiBaoRen' id='ZD_HuiBaoRen' class='addboxinput inputfocus'   value='<?php echo $ZD_HuiBaoRen ?>'  style='width:100%'    readonly='readonly' />
		                 <div class='cols03 font_red yanzheng' id='ZD_HuiBaoRen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;详细描述:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_XiangXiMiaoShu' id='ZD_XiangXiMiaoShu' class='addboxinput inputfocus' style='width:100%;height:352px;'   ><?php echo $ZD_XiangXiMiaoShu ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ZD_XiangXiMiaoShu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;汇报日期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HuiBaoRiQi' id='ZD_HuiBaoRiQi' class='addboxinput inputfocus'  value='<?php echo $ZD_HuiBaoRiQi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_HuiBaoRiQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;完成情况:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_WanChengQingKuang' type='radio' typeid='17' id='ZD_WanChengQingKuang_0' value='是' class='addboxinput inputfocus'    />是&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_WanChengQingKuang' type='radio' typeid='17' id='ZD_WanChengQingKuang_1' class='addboxinput inputfocus' value=''   checked='checked'    />否</label><script>Inputdate('ZD_WanChengQingKuang','17','<?php echo $ZD_WanChengQingKuang ?>','DeskMenuDiv497','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_WanChengQingKuang_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen' id='ZD_JiFen' class='addboxinput inputfocus'  value='<?php echo $ZD_JiFen ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiFen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>审阅人:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenYueRen' id='ZD_ShenYueRen' class='addboxinput inputfocus'  value='<?php echo $ZD_ShenYueRen ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenYueRen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>审阅时间:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenYueShiJian' id='ZD_ShenYueShiJian' class='addboxinput inputfocus'  value='<?php echo $ZD_ShenYueShiJian ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenYueShiJian_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv497',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_id_zu')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_HuiBaoRen,ZD_XiangXiMiaoShu,ZD_HuiBaoRiQi,ZD_WanChengQingKuang,ZD_JiFen,ZD_ShenYueRen,ZD_ShenYueShiJian'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_id_zu' bitian_Arry='ZD_HuiBaoRen,ZD_XiangXiMiaoShu,ZD_HuiBaoRiQi,ZD_WanChengQingKuang' databiao='SQP_MeiRiGongZuoHuiBaoBiao' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv497')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='497' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_MeiRiGongZuoHuiBaoBiao','DeskMenuDiv497');form_add_copy('DeskMenuDiv497');inputfocusfirst('#addbox .htmlleirong','sys_id_zu');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>