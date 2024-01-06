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
		
	    $zu_all_list="";
	    $sql = 'select * From `SQP_JiChuSheShiGuanLiTaiZhang` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='SheBeiMingChen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;设备名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SheBeiMingChen' id='SheBeiMingChen' class='addboxinput inputfocus'  value='$row[SheBeiMingChen]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SheBeiMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='XingHaoGuiGe'>
		                        <li style='text-align:right;width:220px'>型号规格:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='XingHaoGuiGe' id='XingHaoGuiGe' class='addboxinput inputfocus'  value='$row[XingHaoGuiGe]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='XingHaoGuiGe_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZhiZaoChangShang'>
		                        <li style='text-align:right;width:220px'>制造厂商:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZhiZaoChangShang' id='ZhiZaoChangShang' class='addboxinput inputfocus'  value='$row[ZhiZaoChangShang]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZhiZaoChangShang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ChuChangBianHao'>
		                        <li style='text-align:right;width:220px'>出厂编号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ChuChangBianHao' id='ChuChangBianHao' class='addboxinput inputfocus'  value='$row[ChuChangBianHao]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ChuChangBianHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SuoShuBuMen'>
		                        <li style='text-align:right;width:220px'>所属部门:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SuoShuBuMen' id='SuoShuBuMen' class='addboxinput inputfocus'  value='$row[SuoShuBuMen]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SuoShuBuMen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ShiYongRiQi'>
		                        <li style='text-align:right;width:220px'>使用日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ShiYongRiQi' id='ShiYongRiQi' class='addboxinput inputfocus'  value='$row[ShiYongRiQi]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ShiYongRiQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='BeiZhu'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='BeiZhu' id='BeiZhu' class='addboxinput inputfocus'  value='$row[BeiZhu]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='BeiZhu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SheBeiMingChen,XingHaoGuiGe,ZhiZaoChangShang,ChuChangBianHao,SuoShuBuMen,ShiYongRiQi,BeiZhu'/>";
if ( strpos($const_q_xiug, "213") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry='SheBeiMingChen'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry='SheBeiMingChen'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='213' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_JiChuSheShiGuanLiTaiZhang','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','id');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv213_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
 echo( "<script>ListLoadEND('$ToHtmlID');</script>" );
mysqli_close( $Conn ); //关闭数据库

?>