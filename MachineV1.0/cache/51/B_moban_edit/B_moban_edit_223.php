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
		
	    $zu_all_list="495=企业管理咨询,150=其它,494=商标代理服务,148=工商税务,496=电子商务,149=知识产权,";
	    $sql = 'select * From `SQP_HeZuoHuoBan` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div class='two_menu'>
<ul class='tr trhead' >&nbsp;  <span class='menutishi nocopytext'>Menu</span></ul>
<ul class='tr selectTag' title='第1页' onClick=SelectTag_Menu_Two('.ContentTwo1',this,'DeskMenuDiv223') >01  <span class='menutishi nocopytext'>第1页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='第2页' onClick=SelectTag_Menu_Two('.ContentTwo2',this,'DeskMenuDiv223') >02  <span class='menutishi nocopytext'>第2页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='第3页' onClick=SelectTag_Menu_Two('.ContentTwo3',this,'DeskMenuDiv223') >03  <span class='menutishi nocopytext'>第3页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='第4页' onClick=SelectTag_Menu_Two('.ContentTwo4',this,'DeskMenuDiv223') >04  <span class='menutishi nocopytext'>第4页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr trboom' onClick=SelectTag_Menu_Two('.ContentTwo',this,'DeskMenuDiv223') >&nbsp;  &nbsp;&nbsp;</ul>
</div>
<div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='ZD_MenDianTuPian'>
		                        <li style='text-align:right;width:220px'>门店图片:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='6' name='ZD_MenDianTuPian' id='ZD_MenDianTuPian' tidno='223_ZD_MenDianTuPian_$strmk_id' class='addboxinput inputfocus' value='' style='display:none;width:100%'   />
	    <div id='ZD_MenDianTuPian_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'><div id='ZD_MenDianTuPian_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>+</div></div><script>createupload_jiaohu({'inputid':'ZD_MenDianTuPian','ToHtmlID':'DeskMenuDiv223'});</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_MenDianTuPian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_FaRen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;法人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_FaRen' id='ZD_FaRen' class='addboxinput inputfocus'  value='$row[ZD_FaRen]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_FaRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JianChen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;简称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JianChen' id='ZD_JianChen' class='addboxinput inputfocus'  value='$row[ZD_JianChen]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JianChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XingBie'>
		                        <li style='text-align:right;width:220px'>性别:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_XingBie' type='radio' typeid='3' id='ZD_XingBie_0' value='先生'  class='addboxinput inputfocus'    />先生&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XingBie' type='radio' id='ZD_XingBie_1' class='addboxinput inputfocus' value='女士'  checked='checked'     />女士</label><script>Inputdate('ZD_XingBie','3','$row[ZD_XingBie]','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingBie_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_DianHua'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;电话:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_DianHua' id='ZD_DianHua' class='addboxinput inputfocus'  value='$row[ZD_DianHua]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_DianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='BeiZhu'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='BeiZhu' id='BeiZhu' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$row[BeiZhu]</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='BeiZhu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_DiZhi'>
		                        <li style='text-align:right;width:220px'>地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_DiZhi' id='ZD_DiZhi' class='addboxinput inputfocus'  value='$row[ZD_DiZhi]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_DiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_SheBaoRenShu'>
		                        <li style='text-align:right;width:220px'>社保人数:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_SheBaoRenShu' id='ZD_SheBaoRenShu' class='addboxinput inputfocus'  value='$row[ZD_SheBaoRenShu]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_SheBaoRenShu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_WeiXin'>
		                        <li style='text-align:right;width:220px'>微信:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_WeiXin' type='radio' typeid='19' id='ZD_WeiXin_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_WeiXin' type='radio' typeid='19' id='ZD_WeiXin_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_WeiXin','19','$row[ZD_WeiXin]','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_WeiXin_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HeZuo'>
		                        <li style='text-align:right;width:220px'>合作:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_HeZuo' type='radio' typeid='19' id='ZD_HeZuo_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_HeZuo' type='radio' typeid='19' id='ZD_HeZuo_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_HeZuo','19','$row[ZD_HeZuo]','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HeZuo_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_QuFang'>
		                        <li style='text-align:right;width:220px'>去访:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_QuFang' type='radio' typeid='19' id='ZD_QuFang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_QuFang' type='radio' typeid='19' id='ZD_QuFang_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_QuFang','19','$row[ZD_QuFang]','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_QuFang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='LaiFang'>
		                        <li style='text-align:right;width:220px'>来访:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='LaiFang' type='radio' typeid='19' id='LaiFang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='LaiFang' type='radio' typeid='19' id='LaiFang_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('LaiFang','19','$row[LaiFang]','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='LaiFang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='PeiXun'>
		                        <li style='text-align:right;width:220px'>培训:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='PeiXun' type='radio' typeid='19' id='PeiXun_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='PeiXun' type='radio' typeid='19' id='PeiXun_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('PeiXun','19','$row[PeiXun]','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='PeiXun_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XiTong'>
		                        <li style='text-align:right;width:220px'>系统:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_XiTong' type='radio' typeid='19' id='ZD_XiTong_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XiTong' type='radio' typeid='19' id='ZD_XiTong_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_XiTong','19','$row[ZD_XiTong]','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XiTong_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiHuaBaiFang'>
		                        <li style='text-align:right;width:220px'>计划拜访:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_JiHuaBaiFang' type='radio' typeid='19' id='ZD_JiHuaBaiFang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_JiHuaBaiFang' type='radio' typeid='19' id='ZD_JiHuaBaiFang_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_JiHuaBaiFang','19','$row[ZD_JiHuaBaiFang]','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiHuaBaiFang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZhuYingYeWu'>
		                        <li style='text-align:right;width:220px'>主营业务:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZhuYingYeWu' id='ZD_ZhuYingYeWu' class='addboxinput inputfocus'  value='$row[ZD_ZhuYingYeWu]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZhuYingYeWu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<span class='ContentTwo ContentTwo2' style='display:none'>";
echo"
	                         <ul zd='ZD_GongSi'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;公司:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSi' id='ZD_GongSi' class='addboxinput inputfocus'  value='$row[ZD_GongSi]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<span class='ContentTwo ContentTwo3' style='display:none'>";
echo"</span>";
echo"<span class='ContentTwo ContentTwo4' style='display:none'>";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_MenDianTuPian,ZD_GongSi,ZD_FaRen,ZD_JianChen,ZD_XingBie,ZD_DianHua,BeiZhu,ZD_DiZhi,ZD_SheBaoRenShu,ZD_WeiXin,ZD_HeZuo,ZD_QuFang,LaiFang,PeiXun,ZD_XiTong,ZD_JiHuaBaiFang,ZD_ZhuYingYeWu'/>";
if ( strpos($const_q_xiug, "223") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='ZD_MenDianTuPian' bitian_Arry='ZD_GongSi,ZD_FaRen,ZD_JianChen,ZD_DianHua'  Wuchongfu_Arry='ZD_GongSi,ZD_JianChen'  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='ZD_MenDianTuPian' bitian_Arry='ZD_GongSi,ZD_FaRen,ZD_JianChen,ZD_DianHua'  Wuchongfu_Arry='ZD_GongSi,ZD_JianChen'  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='223' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','ZD_GongSi,ZD_JianChen','SQP_HeZuoHuoBan','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','ZD_MenDianTuPian');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv223_MenuDiv_321',this,'$ToHtmlID','15',$strmk_id)>顾客档案表</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv223_MenuDiv_264',this,'$ToHtmlID','31',$strmk_id)>交流记录</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv223_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>

<script>form_weikong('#post_form','$ToHtmlID');</script>

";
 echo( "<script>ListLoadEND('$ToHtmlID');</script>" );
mysqli_close( $Conn ); //关闭数据库

?>