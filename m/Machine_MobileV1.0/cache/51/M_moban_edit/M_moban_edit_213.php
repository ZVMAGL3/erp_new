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
	    $sql = 'select * From `SQP_JiChuSheShiGuanLiTaiZhang` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv213');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_JiChuSheShiGuanLiTaiZhang','DeskMenuDiv213','#addbox');$('#DeskMenuDiv213 #addbox #post_form').attr({'tit':'SheBeiMingChen','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv213');ListLoadEND_Mobile('DeskMenuDiv213');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;设备名称:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SheBeiMingChen' id='SheBeiMingChen' class='addboxinput inputfocus'  value='$row[SheBeiMingChen]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='SheBeiMingChen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>型号规格:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='XingHaoGuiGe' id='XingHaoGuiGe' class='addboxinput inputfocus'  value='$row[XingHaoGuiGe]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='XingHaoGuiGe_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>制造厂商:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZhiZaoChangShang' id='ZhiZaoChangShang' class='addboxinput inputfocus'  value='$row[ZhiZaoChangShang]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZhiZaoChangShang_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>出厂编号:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ChuChangBianHao' id='ChuChangBianHao' class='addboxinput inputfocus'  value='$row[ChuChangBianHao]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ChuChangBianHao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>所属部门:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SuoShuBuMen' id='SuoShuBuMen' class='addboxinput inputfocus'  value='$row[SuoShuBuMen]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='SuoShuBuMen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>使用日期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ShiYongRiQi' id='ShiYongRiQi' class='addboxinput inputfocus'  value='$row[ShiYongRiQi]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ShiYongRiQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>备注:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='BeiZhu' id='BeiZhu' class='addboxinput inputfocus'  value='$row[BeiZhu]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='BeiZhu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv213',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SheBeiMingChenXingHaoGuiGe,ZhiZaoChangShang,ChuChangBianHao,SuoShuBuMen,ShiYongRiQi,BeiZhu'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv213','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry='SheBeiMingChen'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv213')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv213','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry='SheBeiMingChen'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='213' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv213')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv213_MenuDiv_368',this,'DeskMenuDiv213','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Conn ); //关闭数据库

?>