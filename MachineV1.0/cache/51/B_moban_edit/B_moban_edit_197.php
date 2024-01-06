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
	    $sql = 'select * From `SQP_YuanGongManYiDuDiaoChaBiao` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='username'>
		                        <li style='text-align:right;width:220px'>username:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='username' id='username' class='addboxinput inputfocus'  value='$row[username]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='username_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='tel'>
		                        <li style='text-align:right;width:220px'>tel:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='tel' id='tel' class='addboxinput inputfocus'  value='$row[tel]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='tel_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='card'>
		                        <li style='text-align:right;width:220px'>card:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='card' id='card' class='addboxinput inputfocus'  value='$row[card]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='card_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='startdate'>
		                        <li style='text-align:right;width:220px'>startdate:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='startdate' id='startdate' class='addboxinput inputfocus'  value='$row[startdate]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='startdate_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='enddate'>
		                        <li style='text-align:right;width:220px'>enddate:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='enddate' id='enddate' class='addboxinput inputfocus'  value='$row[enddate]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='enddate_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='beizhu'>
		                        <li style='text-align:right;width:220px'>beizhu:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='beizhu' id='beizhu' class='addboxinput inputfocus'  value='$row[beizhu]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='beizhu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='qq'>
		                        <li style='text-align:right;width:220px'>qq:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='qq' id='qq' class='addboxinput inputfocus'  value='$row[qq]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='qq_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_id_zu'>
		                        <li style='text-align:right;width:220px'>分类:</li>
                                
		                        <li style='width:40%' class='reset_list'>
<label><input type='checkbox' typeid='15' name='sys_id_zu' id='sys_id_zu0' tit=' $row[sys_id_zu]' value='' class='addboxinput inputfocus' checked>&nbsp;所有分类&nbsp;</label><script>Inputdate('sys_id_zu','15','$row[sys_id_zu]','DeskMenuDiv197','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_id_zu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='bianhao'>
		                        <li style='text-align:right;width:220px'>bianhao:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='bianhao' id='bianhao' class='addboxinput inputfocus'  value='$row[bianhao]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='bianhao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='username,tel,card,startdate,enddate,beizhu,qq,sys_id_zu,bianhao'/>";
if ( strpos($const_q_xiug, "197") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='197' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_YuanGongManYiDuDiaoChaBiao','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','id');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv197_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
 echo( "<script>ListLoadEND('$ToHtmlID');</script>" );
mysqli_close( $Conn ); //关闭数据库

?>