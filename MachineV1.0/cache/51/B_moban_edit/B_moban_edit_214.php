<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
        include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	
	    global $strmk_id,$Conn,$const_q_xiug,$const_q_shenghe,$const_q_pizhun,$ToHtmlID;
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
		if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};//是否为回收站0为不回收
	    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};//是否为回收站0为不回收
		
	    $zu_all_list="376=不需要,378=以后不要再打电话,377=需要时再联系,";
	    $sql = 'select * From `SQP_JiChuSheShiBaoYangJiHua` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='SheBeiMingChen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;设备名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SheBeiMingChen' id='SheBeiMingChen' class='addboxinput inputfocus' value='$row[SheBeiMingChen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SheBeiMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='XingHaoGuiGe'>
		                        <li style='text-align:right;width:220px'>型号规格:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='XingHaoGuiGe' id='XingHaoGuiGe' class='addboxinput inputfocus' value='$row[XingHaoGuiGe]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='XingHaoGuiGe_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='BaoYangZhouQi'>
		                        <li style='text-align:right;width:220px'>保养周期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='BaoYangZhouQi' id='BaoYangZhouQi' class='addboxinput inputfocus' value='$row[BaoYangZhouQi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='BaoYangZhouQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_1Yue'>
		                        <li style='text-align:right;width:220px'>1月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_1Yue' type='radio' typeid='19' id='ZD_1Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_1Yue' type='radio' typeid='19' id='ZD_1Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_1Yue','19','$row[ZD_1Yue]','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_1Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_2Yue'>
		                        <li style='text-align:right;width:220px'>2月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_2Yue' type='radio' typeid='19' id='ZD_2Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_2Yue' type='radio' typeid='19' id='ZD_2Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_2Yue','19','$row[ZD_2Yue]','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_2Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_3Yue'>
		                        <li style='text-align:right;width:220px'>3月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_3Yue' type='radio' typeid='19' id='ZD_3Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_3Yue' type='radio' typeid='19' id='ZD_3Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_3Yue','19','$row[ZD_3Yue]','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_3Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_4Yue'>
		                        <li style='text-align:right;width:220px'>4月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_4Yue' type='radio' typeid='19' id='ZD_4Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_4Yue' type='radio' typeid='19' id='ZD_4Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_4Yue','19','$row[ZD_4Yue]','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_4Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_5Yue'>
		                        <li style='text-align:right;width:220px'>5月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_5Yue' type='radio' typeid='19' id='ZD_5Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_5Yue' type='radio' typeid='19' id='ZD_5Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_5Yue','19','$row[ZD_5Yue]','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_5Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_6Yue'>
		                        <li style='text-align:right;width:220px'>6月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_6Yue' type='radio' typeid='19' id='ZD_6Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_6Yue' type='radio' typeid='19' id='ZD_6Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_6Yue','19','$row[ZD_6Yue]','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_6Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_7Yue'>
		                        <li style='text-align:right;width:220px'>7月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_7Yue' type='radio' typeid='19' id='ZD_7Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_7Yue' type='radio' typeid='19' id='ZD_7Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_7Yue','19','$row[ZD_7Yue]','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_7Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_8Yue'>
		                        <li style='text-align:right;width:220px'>8月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_8Yue' type='radio' typeid='19' id='ZD_8Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_8Yue' type='radio' typeid='19' id='ZD_8Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_8Yue','19','$row[ZD_8Yue]','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_8Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_9Yue'>
		                        <li style='text-align:right;width:220px'>9月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_9Yue' type='radio' typeid='19' id='ZD_9Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_9Yue' type='radio' typeid='19' id='ZD_9Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_9Yue','19','$row[ZD_9Yue]','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_9Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_10Yue'>
		                        <li style='text-align:right;width:220px'>10月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_10Yue' type='radio' typeid='19' id='ZD_10Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_10Yue' type='radio' typeid='19' id='ZD_10Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_10Yue','19','$row[ZD_10Yue]','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_10Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_11Yue'>
		                        <li style='text-align:right;width:220px'>11月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_11Yue' type='radio' typeid='19' id='ZD_11Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_11Yue' type='radio' typeid='19' id='ZD_11Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_11Yue','19','$row[ZD_11Yue]','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_11Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_12Yue'>
		                        <li style='text-align:right;width:220px'>12月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_12Yue' type='radio' typeid='19' id='ZD_12Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_12Yue' type='radio' typeid='19' id='ZD_12Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_12Yue','19','$row[ZD_12Yue]','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_12Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='BeiZhu2020730下午324562448'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='BeiZhu2020730下午324562448' id='BeiZhu2020730下午324562448' class='addboxinput inputfocus' value='$row[BeiZhu2020730下午324562448]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='BeiZhu2020730下午324562448_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SheBeiMingChen,XingHaoGuiGe,BaoYangZhouQi,ZD_1Yue,ZD_2Yue,ZD_3Yue,ZD_4Yue,ZD_5Yue,ZD_6Yue,ZD_7Yue,ZD_8Yue,ZD_9Yue,ZD_10Yue,ZD_11Yue,ZD_12Yue,BeiZhu2020730下午324562448'/>";
if ( strpos($const_q_xiug, "214") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='SheBeiMingChen'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='SheBeiMingChen'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='214' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_JiChuSheShiBaoYangJiHua','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','sys_nowbh');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv214_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
mysqli_close( $Conn ); //关闭数据库

?>