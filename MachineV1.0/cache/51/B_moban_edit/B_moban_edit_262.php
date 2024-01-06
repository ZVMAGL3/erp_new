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
		
	    $zu_all_list="366=国内公司注册(Domestic Company reg),367=国外公司注册(Abroad Company reg),364=法律顾问 (Legal advisor),362=知识产权 (property),363=管理顾问 (consultant),361=认证服务 (Certification),";
	    $sql = 'select * From `sys_jlmb` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='sys_card'>
		                        <li style='text-align:right;width:220px'>记录名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_card' id='sys_card' class='addboxinput inputfocus'  value='$row[sys_card]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_card_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='mdb_name_SYS'>
		                        <li style='text-align:right;width:220px'>数据表名:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='mdb_name_SYS' id='mdb_name_SYS' class='addboxinput inputfocus'  value='$row[mdb_name_SYS]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='mdb_name_SYS_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='Id_MenuBigClass'>
		                        <li style='text-align:right;width:220px'>大类菜单:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='Id_MenuBigClass' id='Id_MenuBigClass' class='addboxinput inputfocus'  value='$row[Id_MenuBigClass]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='Id_MenuBigClass_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='banben'>
		                        <li style='text-align:right;width:220px'>版本:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='banben' id='banben' class='addboxinput inputfocus'  value='$row[banben]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='banben_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='xiugaicishu'>
		                        <li style='text-align:right;width:220px'>修改次数:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='xiugaicishu' id='xiugaicishu' class='addboxinput inputfocus'  value='$row[xiugaicishu]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='xiugaicishu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ul_row_height'>
		                        <li style='text-align:right;width:220px'>行高:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ul_row_height' id='ul_row_height' class='addboxinput inputfocus'  value='$row[ul_row_height]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ul_row_height_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='sys_card,mdb_name_SYS,Id_MenuBigClass,banben,xiugaicishu,ul_row_height'/>";
if ( strpos($const_q_xiug, "262") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='262' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','sys_jlmb','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','sys_nowbh');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv262_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
 echo( "<script>ListLoadEND('$ToHtmlID');</script>" );
mysqli_close( $Conn ); //关闭数据库

?>