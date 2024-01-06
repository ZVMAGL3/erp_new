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
		
	    $zu_all_list="375=不合格供方,374=合格供方,";
	    $sql = 'select * From `SQP_ZhaoPinGongYingShang` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='QuDaoMingChen'>
		                        <li style='text-align:right;width:220px'>渠道名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='QuDaoMingChen' id='QuDaoMingChen' class='addboxinput inputfocus' value='$row[QuDaoMingChen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='QuDaoMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='WangZhi'>
		                        <li style='text-align:right;width:220px'>网址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='WangZhi' id='WangZhi' class='addboxinput inputfocus' value='$row[WangZhi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='WangZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='DiZhi'>
		                        <li style='text-align:right;width:220px'>地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='DiZhi' id='DiZhi' class='addboxinput inputfocus' value='$row[DiZhi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='DiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZhangHaoMiMa'>
		                        <li style='text-align:right;width:220px'>帐号密码:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZhangHaoMiMa' id='ZhangHaoMiMa' class='addboxinput inputfocus' value='$row[ZhangHaoMiMa]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZhangHaoMiMa_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='LeiXing'>
		                        <li style='text-align:right;width:220px'>类型:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='LeiXing' id='LeiXing' class='addboxinput inputfocus' value='$row[LeiXing]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='LeiXing_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZhaoPinJiQiao'>
		                        <li style='text-align:right;width:220px'>招聘技巧:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ZhaoPinJiQiao' id='ZhaoPinJiQiao' class='addboxinput inputfocus' 25px;'   >$row[ZhaoPinJiQiao]</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZhaoPinJiQiao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='QuDaoMingChen,WangZhi,DiZhi,ZhangHaoMiMa,LeiXing,ZhaoPinJiQiao'/>";
if ( strpos($const_q_xiug, "314") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='314' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_ZhaoPinGongYingShang','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','id');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv314_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
mysqli_close( $Conn ); //关闭数据库

?>