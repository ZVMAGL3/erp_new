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
	    $zu_all_list="164=完好,165=报废,166=维修,";
	    $sql = 'select * From `SQP_JianCeHeCeLiangZiYuanTaiZhang` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv230');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_JianCeHeCeLiangZiYuanTaiZhang','DeskMenuDiv230','#addbox');$('#DeskMenuDiv230 #addbox #post_form').attr({'tit':'MingChen','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv230');ListLoadEND_Mobile('DeskMenuDiv230');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"
                            <ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;名称:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='MingChen' id='MingChen' class='addboxinput inputfocus' value='$row[MingChen]'   />
                            <div class='cols03 font_red yanzheng' id='MingChen_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"<ul><li class='cols01'>规格:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='GuiGe' id='GuiGe' class='addboxinput inputfocus' value='$row[GuiGe]'   />
			   <div class='cols03 font_red yanzheng' id='GuiGe_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>制造厂商:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZhiZaoChangShang' id='ZhiZaoChangShang' class='addboxinput inputfocus' value='$row[ZhiZaoChangShang]'   />
			   <div class='cols03 font_red yanzheng' id='ZhiZaoChangShang_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>出厂编号:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ChuChangBianHao' id='ChuChangBianHao' class='addboxinput inputfocus' value='$row[ChuChangBianHao]'   />
			   <div class='cols03 font_red yanzheng' id='ChuChangBianHao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>始用日期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ShiYongRiQi' id='ShiYongRiQi' class='addboxinput inputfocus' value='$row[ShiYongRiQi]'   />
			   <div class='cols03 font_red yanzheng' id='ShiYongRiQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>使用部门:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ShiYongBuMen' id='ShiYongBuMen' class='addboxinput inputfocus' value='$row[ShiYongBuMen]'   />
			   <div class='cols03 font_red yanzheng' id='ShiYongBuMen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>管理责任人:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='GuanLiZeRenRen' id='GuanLiZeRenRen' class='addboxinput inputfocus' value='$row[GuanLiZeRenRen]'   />
			   <div class='cols03 font_red yanzheng' id='GuanLiZeRenRen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>报废日期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='BaoFeiRiQi' id='BaoFeiRiQi' class='addboxinput inputfocus' value='$row[BaoFeiRiQi]'   />
			   <div class='cols03 font_red yanzheng' id='BaoFeiRiQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv230',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='MingChenGuiGe,ZhiZaoChangShang,ChuChangBianHao,ShiYongRiQi,ShiYongBuMen,GuanLiZeRenRen,BaoFeiRiQi'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv230','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='MingChen'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv230')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv230','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='MingChen'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='230' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv230')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv230_MenuDiv_368',this,'DeskMenuDiv230','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Conn ); //关闭数据库

?>