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
	   
	    global $strmk_id,$Conn,$const_q_xiug;
	    $zu_all_list="376=不需要,378=以后不要再打电话,377=需要时再联系,";
	    $sql = 'select * From `SQP_JiChuSheShiBaoYangJiHua` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv214');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_JiChuSheShiBaoYangJiHua','DeskMenuDiv214','#addbox');$('#DeskMenuDiv214 #addbox #post_form').attr({'tit':'SheBeiMingChen','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv214');ListLoadEND_Mobile('DeskMenuDiv214');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"
                            <ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;设备名称:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='SheBeiMingChen' id='SheBeiMingChen' class='addboxinput inputfocus' value='$row[SheBeiMingChen]'   />
                            <div class='cols03 font_red yanzheng' id='SheBeiMingChen_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"<ul><li class='cols01'>型号规格:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='XingHaoGuiGe' id='XingHaoGuiGe' class='addboxinput inputfocus' value='$row[XingHaoGuiGe]'   />
			   <div class='cols03 font_red yanzheng' id='XingHaoGuiGe_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>保养周期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='BaoYangZhouQi' id='BaoYangZhouQi' class='addboxinput inputfocus' value='$row[BaoYangZhouQi]'   />
			   <div class='cols03 font_red yanzheng' id='BaoYangZhouQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>1月:</li>
               <li class='cols02 reset_list'><label><input name='ZD_1Yue' type='radio' typeid='19' id='ZD_1Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_1Yue' type='radio' typeid='19' id='ZD_1Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_1Yue','19','$row[ZD_1Yue]','DeskMenuDiv214','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_1Yue_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>2月:</li>
               <li class='cols02 reset_list'><label><input name='ZD_2Yue' type='radio' typeid='19' id='ZD_2Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_2Yue' type='radio' typeid='19' id='ZD_2Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_2Yue','19','$row[ZD_2Yue]','DeskMenuDiv214','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_2Yue_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>3月:</li>
               <li class='cols02 reset_list'><label><input name='ZD_3Yue' type='radio' typeid='19' id='ZD_3Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_3Yue' type='radio' typeid='19' id='ZD_3Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_3Yue','19','$row[ZD_3Yue]','DeskMenuDiv214','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_3Yue_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>4月:</li>
               <li class='cols02 reset_list'><label><input name='ZD_4Yue' type='radio' typeid='19' id='ZD_4Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_4Yue' type='radio' typeid='19' id='ZD_4Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_4Yue','19','$row[ZD_4Yue]','DeskMenuDiv214','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_4Yue_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>5月:</li>
               <li class='cols02 reset_list'><label><input name='ZD_5Yue' type='radio' typeid='19' id='ZD_5Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_5Yue' type='radio' typeid='19' id='ZD_5Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_5Yue','19','$row[ZD_5Yue]','DeskMenuDiv214','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_5Yue_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>6月:</li>
               <li class='cols02 reset_list'><label><input name='ZD_6Yue' type='radio' typeid='19' id='ZD_6Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_6Yue' type='radio' typeid='19' id='ZD_6Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_6Yue','19','$row[ZD_6Yue]','DeskMenuDiv214','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_6Yue_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>7月:</li>
               <li class='cols02 reset_list'><label><input name='ZD_7Yue' type='radio' typeid='19' id='ZD_7Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_7Yue' type='radio' typeid='19' id='ZD_7Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_7Yue','19','$row[ZD_7Yue]','DeskMenuDiv214','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_7Yue_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>8月:</li>
               <li class='cols02 reset_list'><label><input name='ZD_8Yue' type='radio' typeid='19' id='ZD_8Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_8Yue' type='radio' typeid='19' id='ZD_8Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_8Yue','19','$row[ZD_8Yue]','DeskMenuDiv214','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_8Yue_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>9月:</li>
               <li class='cols02 reset_list'><label><input name='ZD_9Yue' type='radio' typeid='19' id='ZD_9Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_9Yue' type='radio' typeid='19' id='ZD_9Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_9Yue','19','$row[ZD_9Yue]','DeskMenuDiv214','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_9Yue_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>10月:</li>
               <li class='cols02 reset_list'><label><input name='ZD_10Yue' type='radio' typeid='19' id='ZD_10Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_10Yue' type='radio' typeid='19' id='ZD_10Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_10Yue','19','$row[ZD_10Yue]','DeskMenuDiv214','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_10Yue_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>11月:</li>
               <li class='cols02 reset_list'><label><input name='ZD_11Yue' type='radio' typeid='19' id='ZD_11Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_11Yue' type='radio' typeid='19' id='ZD_11Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_11Yue','19','$row[ZD_11Yue]','DeskMenuDiv214','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_11Yue_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>12月:</li>
               <li class='cols02 reset_list'><label><input name='ZD_12Yue' type='radio' typeid='19' id='ZD_12Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_12Yue' type='radio' typeid='19' id='ZD_12Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_12Yue','19','$row[ZD_12Yue]','DeskMenuDiv214','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_12Yue_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>备注:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='BeiZhu2020730下午324562448' id='BeiZhu2020730下午324562448' class='addboxinput inputfocus' value='$row[BeiZhu2020730下午324562448]'   />
			   <div class='cols03 font_red yanzheng' id='BeiZhu2020730下午324562448_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv214',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SheBeiMingChenXingHaoGuiGe,BaoYangZhouQi,ZD_1Yue,ZD_2Yue,ZD_3Yue,ZD_4Yue,ZD_5Yue,ZD_6Yue,ZD_7Yue,ZD_8Yue,ZD_9Yue,ZD_10Yue,ZD_11Yue,ZD_12Yue,BeiZhu2020730下午324562448'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv214','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='SheBeiMingChen'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv214')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv214','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='SheBeiMingChen'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='214' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv214')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv214_MenuDiv_368',this,'DeskMenuDiv214','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Conn ); //关闭数据库

?>