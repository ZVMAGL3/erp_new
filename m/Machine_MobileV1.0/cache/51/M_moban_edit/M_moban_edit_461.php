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
	    $zu_all_list="";
	    $sql = 'select * From `SQP_WenJianZiDongHua` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv461');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'ZD_GongSiMingChen','SQP_WenJianZiDongHua','DeskMenuDiv461','#addbox');$('#DeskMenuDiv461 #addbox #post_form').attr({'tit':'','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv461');ListLoadEND_Mobile('DeskMenuDiv461');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<ul><li class='cols01'><font color='red'>[验重]</font>&nbsp;公司名称:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiMingChen' id='ZD_GongSiMingChen' class='addboxinput inputfocus'  value='$row[ZD_GongSiMingChen]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongSiMingChen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>公司地址:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiDiZhi' id='ZD_GongSiDiZhi' class='addboxinput inputfocus'  value='$row[ZD_GongSiDiZhi]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongSiDiZhi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>公司电话:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiDianHua' id='ZD_GongSiDianHua' class='addboxinput inputfocus'  value='$row[ZD_GongSiDianHua]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongSiDianHua_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>总经理:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZongJingLi' id='ZD_ZongJingLi' class='addboxinput inputfocus'  value='$row[ZD_ZongJingLi]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ZongJingLi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>管理者代表:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GuanLiZheDaiBiao' id='ZD_GuanLiZheDaiBiao' class='addboxinput inputfocus'  value='$row[ZD_GuanLiZheDaiBiao]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GuanLiZheDaiBiao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>安全事务代表:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_AnQuanShiWuDaiBiao' id='ZD_AnQuanShiWuDaiBiao' class='addboxinput inputfocus'  value='$row[ZD_AnQuanShiWuDaiBiao]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_AnQuanShiWuDaiBiao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>手册编制人:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShouCeBianZhiRen' id='ZD_ShouCeBianZhiRen' class='addboxinput inputfocus'  value='$row[ZD_ShouCeBianZhiRen]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ShouCeBianZhiRen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>模版上传:</li>
               <li class='cols02 reset_list'><input type='text' typeid='6' name='sys_XuanYongMoBan' id='sys_XuanYongMoBan' tidno='461_sys_XuanYongMoBan_$strmk_id' class='addboxinput inputfocus' value='' style='display:none;width:100%'   />
	    <div id='sys_XuanYongMoBan_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'><div id='sys_XuanYongMoBan_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>+</div></div><script>createupload_jiaohu({'inputid':'sys_XuanYongMoBan','ToHtmlID':'DeskMenuDiv461'});</script>
			   <div class='cols03 font_red yanzheng' id='sys_XuanYongMoBan_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>引用模版:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_YinYongMoBan' id='ZD_YinYongMoBan' class='addboxinput inputfocus'  value='$row[ZD_YinYongMoBan]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_YinYongMoBan_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv461',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GongSiMingChen,ZD_GongSiDiZhi,ZD_GongSiDianHua,ZD_ZongJingLi,ZD_GuanLiZheDaiBiao,ZD_AnQuanShiWuDaiBiao,ZD_ShouCeBianZhiRen,sys_XuanYongMoBan,ZD_YinYongMoBan'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv461','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry='ZD_GongSiMingChen'  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv461')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv461','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry='ZD_GongSiMingChen'  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='461' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv461')>参数设定</A>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent2',this,'DeskMenuDiv461','368',$strmk_id)>模版</A>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent2',this,'DeskMenuDiv461','368',$strmk_id)>文件</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv461_MenuDiv_368',this,'DeskMenuDiv461','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Conn ); //关闭数据库

?>