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
		
	    $zu_all_list="394=丧假,390=事假,393=产假,398=出差,396=加班,400=外出,391=婚假,397=审核,392=年假,434=病假,395=调休,";
	    $sql = 'select * From `SQP_QingJiaDiaoXiuJiaBanWaiChuDan` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='ZhiWu'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;职务:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='24' name='ZhiWu' id='ZhiWu' class='addboxinput inputfocus'   value='$row[ZhiWu]'    readonly='readonly' /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZhiWu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenQingRen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;申请人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='23' name='ZD_ShenQingRen' id='ZD_ShenQingRen' class='addboxinput inputfocus'   value='$row[ZD_ShenQingRen]'    readonly='readonly' /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenQingRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenQingShiJian'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;申请时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='25' name='ZD_ShenQingShiJian' id='ZD_ShenQingShiJian' class='addboxinput inputfocus'   value='$row[ZD_ShenQingShiJian]'    readonly='readonly' /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenQingShiJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_id_zu'>
		                        <li style='text-align:right;width:220px'>分类:</li>
                                
		                        <li style='width:40%' class='reset_list'>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu1' tit='$row[sys_id_zu]' cnval='丧假' value='$row[sys_id_zu]' valid='394' valstr='' class='addboxinput inputfocus' >丧假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu2' tit='$row[sys_id_zu]' cnval='事假' value='$row[sys_id_zu]' valid='390' valstr='' class='addboxinput inputfocus' >事假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu3' tit='$row[sys_id_zu]' cnval='产假' value='$row[sys_id_zu]' valid='393' valstr='' class='addboxinput inputfocus' >产假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu4' tit='$row[sys_id_zu]' cnval='出差' value='$row[sys_id_zu]' valid='398' valstr='' class='addboxinput inputfocus' >出差&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu5' tit='$row[sys_id_zu]' cnval='加班' value='$row[sys_id_zu]' valid='396' valstr='' class='addboxinput inputfocus' >加班&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu6' tit='$row[sys_id_zu]' cnval='外出' value='$row[sys_id_zu]' valid='400' valstr='' class='addboxinput inputfocus' >外出&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu7' tit='$row[sys_id_zu]' cnval='婚假' value='$row[sys_id_zu]' valid='391' valstr='' class='addboxinput inputfocus' >婚假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu8' tit='$row[sys_id_zu]' cnval='审核' value='$row[sys_id_zu]' valid='397' valstr='' class='addboxinput inputfocus' >审核&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu9' tit='$row[sys_id_zu]' cnval='年假' value='$row[sys_id_zu]' valid='392' valstr='' class='addboxinput inputfocus' >年假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu10' tit='$row[sys_id_zu]' cnval='病假' value='$row[sys_id_zu]' valid='434' valstr='' class='addboxinput inputfocus' >病假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu11' tit='$row[sys_id_zu]' cnval='调休' value='$row[sys_id_zu]' valid='395' valstr='' class='addboxinput inputfocus' >调休&nbsp;</label><script>Inputdate('sys_id_zu','15','$row[sys_id_zu]','DeskMenuDiv494','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_id_zu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ShiYou'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;事由:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ShiYou' id='ShiYou' class='addboxinput inputfocus' 25px;'   >$row[ShiYou]</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ShiYou_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BeiZhu'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus' value='$row[ZD_BeiZhu]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BeiZhu_bitian'></li>
                                
		                     </ul>
	                         
";
if ( strpos($const_q_shenghe, "494") !== false ) { //有审核权限时
echo"
	                         <ul zd='sys_shenpi'>
		                        <li style='text-align:right;width:220px'>审核:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='20' name='sys_shenpi' id='sys_shenpi' class='addboxinput inputfocus'  placeholder='请审核'  y-value='$row[sys_shenpi]'  value='$row[sys_shenpi]'  onclick='SignSH(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='SignSH(this)'><i class='fa fa-20-3'></i></a></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_shenpi_bitian'></li>
                                
		                     </ul>
	                         
";
}
if ( strpos($const_q_pizhun, "494") !== false ) { //有批准权限时
echo"
	                         <ul zd='sys_shenpi_all'>
		                        <li style='text-align:right;width:220px'>批准:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='22' name='sys_shenpi_all' id='sys_shenpi_all' class='addboxinput inputfocus' placeholder='请批准'  y-value='$row[sys_shenpi_all]'  value='$row[sys_shenpi_all]'  onclick='SignPZ(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='SignPZ(this)'><i class='fa fa-20-4'></i></a></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_shenpi_all_bitian'></li>
                                
		                     </ul>
	                         
";
}
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZhiWu,ZD_ShenQingRen,sys_id_zu,ZD_ShenQingShiJian,ShiYou,ZD_BeiZhu,sys_shenpi,sys_shenpi_all'/>";
if ( strpos($const_q_xiug, "494") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='ZhiWu,ZD_ShenQingRen,ZD_ShenQingShiJian,ShiYou'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='ZhiWu,ZD_ShenQingRen,ZD_ShenQingShiJian,ShiYou'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='494' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_QingJiaDiaoXiuJiaBanWaiChuDan','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','sys_nowbh');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv494_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
mysqli_close( $Conn ); //关闭数据库

?>