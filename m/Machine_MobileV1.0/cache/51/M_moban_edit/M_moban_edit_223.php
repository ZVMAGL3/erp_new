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
	    $zu_all_list="495=企业管理咨询,150=其它,494=商标代理服务,148=工商税务,496=电子商务,149=知识产权,";
	    $sql = 'select * From `SQP_HeZuoHuoBan` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv223');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'ZD_GongSi,ZD_JianChen','SQP_HeZuoHuoBan','DeskMenuDiv223','#addbox');$('#DeskMenuDiv223 #addbox #post_form').attr({'tit':'ZD_GongSi,ZD_FaRen,ZD_JianChenZD_DianHua','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv223');ListLoadEND_Mobile('DeskMenuDiv223');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<ul><li class='cols01'>门店图片:</li>
               <li class='cols02 reset_list'><input type='text' typeid='6' name='ZD_MenDianTuPian' id='ZD_MenDianTuPian' tidno='223_ZD_MenDianTuPian_$strmk_id' class='addboxinput inputfocus' value='' style='display:none;width:100%'   />
	    <div id='ZD_MenDianTuPian_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'><div id='ZD_MenDianTuPian_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>+</div></div><script>createupload_jiaohu({'inputid':'ZD_MenDianTuPian','ToHtmlID':'DeskMenuDiv223'});</script>
			   <div class='cols03 font_red yanzheng' id='ZD_MenDianTuPian_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;公司:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSi' id='ZD_GongSi' class='addboxinput inputfocus'  value='$row[ZD_GongSi]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongSi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;法人:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_FaRen' id='ZD_FaRen' class='addboxinput inputfocus'  value='$row[ZD_FaRen]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_FaRen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;简称:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JianChen' id='ZD_JianChen' class='addboxinput inputfocus'  value='$row[ZD_JianChen]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JianChen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>性别:</li>
               <li class='cols02 reset_list'><label><input name='ZD_XingBie' type='radio' typeid='3' id='ZD_XingBie_0' value='先生'  class='addboxinput inputfocus'    />先生&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XingBie' type='radio' id='ZD_XingBie_1' class='addboxinput inputfocus' value='女士'  checked='checked'     />女士</label><script>Inputdate('ZD_XingBie','3','$row[ZD_XingBie]','DeskMenuDiv223','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_XingBie_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;电话:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DianHua' id='ZD_DianHua' class='addboxinput inputfocus'  value='$row[ZD_DianHua]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_DianHua_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>备注:</li>
               <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='BeiZhu' id='BeiZhu' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$row[BeiZhu]</textarea>
			   <div class='cols03 font_red yanzheng' id='BeiZhu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>地址:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DiZhi' id='ZD_DiZhi' class='addboxinput inputfocus'  value='$row[ZD_DiZhi]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_DiZhi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>社保人数:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_SheBaoRenShu' id='ZD_SheBaoRenShu' class='addboxinput inputfocus'  value='$row[ZD_SheBaoRenShu]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_SheBaoRenShu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>微信:</li>
               <li class='cols02 reset_list'><label><input name='ZD_WeiXin' type='radio' typeid='19' id='ZD_WeiXin_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_WeiXin' type='radio' typeid='19' id='ZD_WeiXin_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_WeiXin','19','$row[ZD_WeiXin]','DeskMenuDiv223','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_WeiXin_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>合作:</li>
               <li class='cols02 reset_list'><label><input name='ZD_HeZuo' type='radio' typeid='19' id='ZD_HeZuo_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_HeZuo' type='radio' typeid='19' id='ZD_HeZuo_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_HeZuo','19','$row[ZD_HeZuo]','DeskMenuDiv223','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_HeZuo_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>去访:</li>
               <li class='cols02 reset_list'><label><input name='ZD_QuFang' type='radio' typeid='19' id='ZD_QuFang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_QuFang' type='radio' typeid='19' id='ZD_QuFang_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_QuFang','19','$row[ZD_QuFang]','DeskMenuDiv223','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_QuFang_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>来访:</li>
               <li class='cols02 reset_list'><label><input name='LaiFang' type='radio' typeid='19' id='LaiFang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='LaiFang' type='radio' typeid='19' id='LaiFang_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('LaiFang','19','$row[LaiFang]','DeskMenuDiv223','');</script>
			   <div class='cols03 font_red yanzheng' id='LaiFang_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>培训:</li>
               <li class='cols02 reset_list'><label><input name='PeiXun' type='radio' typeid='19' id='PeiXun_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='PeiXun' type='radio' typeid='19' id='PeiXun_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('PeiXun','19','$row[PeiXun]','DeskMenuDiv223','');</script>
			   <div class='cols03 font_red yanzheng' id='PeiXun_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>系统:</li>
               <li class='cols02 reset_list'><label><input name='ZD_XiTong' type='radio' typeid='19' id='ZD_XiTong_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XiTong' type='radio' typeid='19' id='ZD_XiTong_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_XiTong','19','$row[ZD_XiTong]','DeskMenuDiv223','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_XiTong_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>计划拜访:</li>
               <li class='cols02 reset_list'><label><input name='ZD_JiHuaBaiFang' type='radio' typeid='19' id='ZD_JiHuaBaiFang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_JiHuaBaiFang' type='radio' typeid='19' id='ZD_JiHuaBaiFang_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_JiHuaBaiFang','19','$row[ZD_JiHuaBaiFang]','DeskMenuDiv223','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_JiHuaBaiFang_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>主营业务:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZhuYingYeWu' id='ZD_ZhuYingYeWu' class='addboxinput inputfocus'  value='$row[ZD_ZhuYingYeWu]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ZhuYingYeWu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv223',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_MenDianTuPian,ZD_GongSi,ZD_FaRen,ZD_JianChenZD_XingBie,ZD_DianHua,BeiZhu,ZD_DiZhi,ZD_SheBaoRenShu,ZD_WeiXin,ZD_HeZuo,ZD_QuFang,LaiFang,PeiXun,ZD_XiTong,ZD_JiHuaBaiFang,ZD_ZhuYingYeWu'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv223','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='ZD_MenDianTuPian' bitian_Arry='ZD_GongSi,ZD_FaRen,ZD_JianChenZD_DianHua'  Wuchongfu_Arry='ZD_GongSi,ZD_JianChen'  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv223')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv223','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='ZD_MenDianTuPian' bitian_Arry='ZD_GongSi,ZD_FaRen,ZD_JianChenZD_DianHua'  Wuchongfu_Arry='ZD_GongSi,ZD_JianChen'  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='223' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv223')>编辑</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv223_MenuDiv_321',this,'DeskMenuDiv223','15',$strmk_id)>顾客档案表</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv223_MenuDiv_264',this,'DeskMenuDiv223','31',$strmk_id)>交流记录</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv223_MenuDiv_368',this,'DeskMenuDiv223','368',$strmk_id)>E+</A>
<A onClick=GuanXi(this,'DeskMenuDiv223')>+</A>
</div>
";
mysqli_close( $Conn ); //关闭数据库

?>