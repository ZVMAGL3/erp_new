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
		$sql = "select * From `SQP_XiTongGaiJin` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_WenJianBianHao=$row["ZD_WenJianBianHao"];
		$ZD_GaiJinWenTiDianMiaoShu=$row["ZD_GaiJinWenTiDianMiaoShu"];
		$ZD_XiuGaiWanCheng=$row["ZD_XiuGaiWanCheng"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_WenJianBianHao="";
		$ZD_GaiJinWenTiDianMiaoShu="";
		$ZD_XiuGaiWanCheng="";

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>文件编号:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_WenJianBianHao' id='ZD_WenJianBianHao' class='addboxinput inputfocus'  value='<?php echo $ZD_WenJianBianHao ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_WenJianBianHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>改进问题点描述:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_GaiJinWenTiDianMiaoShu' id='ZD_GaiJinWenTiDianMiaoShu' class='addboxinput inputfocus' style='width:100%;height:25px;'   ><?php echo $ZD_GaiJinWenTiDianMiaoShu ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ZD_GaiJinWenTiDianMiaoShu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>修改完成:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_XiuGaiWanCheng' type='radio' typeid='19' id='ZD_XiuGaiWanCheng_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XiuGaiWanCheng' type='radio' typeid='19' id='ZD_XiuGaiWanCheng_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_XiuGaiWanCheng','19','<?php echo $ZD_XiuGaiWanCheng ?>','DeskMenuDiv502','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_XiuGaiWanCheng_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv502',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_WenJianBianHao,ZD_GaiJinWenTiDianMiaoShu,ZD_XiuGaiWanCheng'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='SQP_XiTongGaiJin' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv502')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='502' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_XiTongGaiJin','DeskMenuDiv502');form_add_copy('DeskMenuDiv502');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>