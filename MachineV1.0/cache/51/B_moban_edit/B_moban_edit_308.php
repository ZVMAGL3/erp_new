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
		
	    $zu_all_list="428=产品,430=其它,426=图纸,429=技术资料,427=模具/夹具,";
	    $sql = 'select * From `SQP_GuKeCaiChanQingDan` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='sys_gx_id_321'>
		                        <li style='text-align:right;width:220px'>关系字段:sys_gx_id_321:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_321' id='sys_gx_id_321' class='addboxinput inputfocus' value='$row[sys_gx_id_321]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_321_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_321','21','SQP_GuKeCaiChanQingDan','DeskMenuDiv308');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GuKeMingChen'>
		                        <li style='text-align:right;width:220px'>顾客名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GuKeMingChen' id='ZD_GuKeMingChen' class='addboxinput inputfocus' value='$row[ZD_GuKeMingChen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GuKeMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_CaiChanMingChen'>
		                        <li style='text-align:right;width:220px'>财产名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_CaiChanMingChen' id='ZD_CaiChanMingChen' class='addboxinput inputfocus' value='$row[ZD_CaiChanMingChen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_CaiChanMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XingHaoGuiGe'>
		                        <li style='text-align:right;width:220px'>型号/规格:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XingHaoGuiGe' id='ZD_XingHaoGuiGe' class='addboxinput inputfocus' value='$row[ZD_XingHaoGuiGe]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingHaoGuiGe_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BenChangBianHao'>
		                        <li style='text-align:right;width:220px'>本厂编号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_BenChangBianHao' id='ZD_BenChangBianHao' class='addboxinput inputfocus' value='$row[ZD_BenChangBianHao]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BenChangBianHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShuLiang'>
		                        <li style='text-align:right;width:220px'>数量:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShuLiang' id='ZD_ShuLiang' class='addboxinput inputfocus' value='$row[ZD_ShuLiang]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShuLiang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JieShouRiQi'>
		                        <li style='text-align:right;width:220px'>接收日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JieShouRiQi' id='ZD_JieShouRiQi' class='addboxinput inputfocus' value='$row[ZD_JieShouRiQi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JieShouRiQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShiYongBuMen'>
		                        <li style='text-align:right;width:220px'>使用部门:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShiYongBuMen' id='ZD_ShiYongBuMen' class='addboxinput inputfocus' value='$row[ZD_ShiYongBuMen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShiYongBuMen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_WanHaoZhuangTai'>
		                        <li style='text-align:right;width:220px'>完好状态:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_WanHaoZhuangTai' id='ZD_WanHaoZhuangTai' class='addboxinput inputfocus' value='$row[ZD_WanHaoZhuangTai]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_WanHaoZhuangTai_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_CunFangDiDian'>
		                        <li style='text-align:right;width:220px'>存放地点:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_CunFangDiDian' id='ZD_CunFangDiDian' class='addboxinput inputfocus' value='$row[ZD_CunFangDiDian]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_CunFangDiDian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BaoFeiRiQi'>
		                        <li style='text-align:right;width:220px'>报废日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_BaoFeiRiQi' id='ZD_BaoFeiRiQi' class='addboxinput inputfocus' value='$row[ZD_BaoFeiRiQi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BaoFeiRiQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BeiZhu'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus' value='$row[ZD_BeiZhu]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BeiZhu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='sys_gx_id_321,ZD_GuKeMingChen,ZD_CaiChanMingChen,ZD_XingHaoGuiGe,ZD_BenChangBianHao,ZD_ShuLiang,ZD_JieShouRiQi,ZD_ShiYongBuMen,ZD_WanHaoZhuangTai,ZD_CunFangDiDian,ZD_BaoFeiRiQi,ZD_BeiZhu'/>";
if ( strpos($const_q_xiug, "308") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='308' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_GuKeCaiChanQingDan','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','sys_nowbh');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv308_MenuDiv_264',this,'$ToHtmlID','33',$strmk_id)>交流记录</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv308_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>

<script>form_weikong('#post_form','$ToHtmlID');</script>

";
mysqli_close( $Conn ); //关闭数据库

?>