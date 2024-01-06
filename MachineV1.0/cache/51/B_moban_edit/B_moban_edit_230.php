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
		
	    $zu_all_list="164=完好,165=报废,166=维修,";
	    $sql = 'select * From `SQP_JianCeHeCeLiangZiYuanTaiZhang` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='MingChen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='MingChen' id='MingChen' class='addboxinput inputfocus' value='$row[MingChen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='MingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='GuiGe'>
		                        <li style='text-align:right;width:220px'>规格:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='GuiGe' id='GuiGe' class='addboxinput inputfocus' value='$row[GuiGe]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='GuiGe_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZhiZaoChangShang'>
		                        <li style='text-align:right;width:220px'>制造厂商:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZhiZaoChangShang' id='ZhiZaoChangShang' class='addboxinput inputfocus' value='$row[ZhiZaoChangShang]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZhiZaoChangShang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ChuChangBianHao'>
		                        <li style='text-align:right;width:220px'>出厂编号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ChuChangBianHao' id='ChuChangBianHao' class='addboxinput inputfocus' value='$row[ChuChangBianHao]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ChuChangBianHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ShiYongRiQi'>
		                        <li style='text-align:right;width:220px'>始用日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ShiYongRiQi' id='ShiYongRiQi' class='addboxinput inputfocus' value='$row[ShiYongRiQi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ShiYongRiQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ShiYongBuMen'>
		                        <li style='text-align:right;width:220px'>使用部门:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ShiYongBuMen' id='ShiYongBuMen' class='addboxinput inputfocus' value='$row[ShiYongBuMen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ShiYongBuMen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='GuanLiZeRenRen'>
		                        <li style='text-align:right;width:220px'>管理责任人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='GuanLiZeRenRen' id='GuanLiZeRenRen' class='addboxinput inputfocus' value='$row[GuanLiZeRenRen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='GuanLiZeRenRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='BaoFeiRiQi'>
		                        <li style='text-align:right;width:220px'>报废日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='BaoFeiRiQi' id='BaoFeiRiQi' class='addboxinput inputfocus' value='$row[BaoFeiRiQi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='BaoFeiRiQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='MingChen,GuiGe,ZhiZaoChangShang,ChuChangBianHao,ShiYongRiQi,ShiYongBuMen,GuanLiZeRenRen,BaoFeiRiQi'/>";
if ( strpos($const_q_xiug, "230") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='MingChen'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='MingChen'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='230' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_JianCeHeCeLiangZiYuanTaiZhang','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','sys_nowbh');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv230_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
mysqli_close( $Conn ); //关闭数据库

?>