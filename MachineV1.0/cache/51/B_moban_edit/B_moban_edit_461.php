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
	    $sql = 'select * From `SQP_WenJianZiDongHua` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='ZD_GongSiMingChen'>
		                        <li style='text-align:right;width:220px'><font color='red'>[验重]</font>&nbsp;公司名称:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_GongSiMingChen} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_GongSiMingChen}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSiMingChen' id='ZD_GongSiMingChen' class='addboxinput inputfocus'  value='$row[ZD_GongSiMingChen]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSiMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongSiDiZhi'>
		                        <li style='text-align:right;width:220px'>公司地址:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_GongSiDiZhi} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_GongSiDiZhi}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSiDiZhi' id='ZD_GongSiDiZhi' class='addboxinput inputfocus'  value='$row[ZD_GongSiDiZhi]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSiDiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongSiDianHua'>
		                        <li style='text-align:right;width:220px'>公司电话:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_GongSiDianHua} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_GongSiDianHua}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSiDianHua' id='ZD_GongSiDianHua' class='addboxinput inputfocus'  value='$row[ZD_GongSiDianHua]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSiDianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZongJingLi'>
		                        <li style='text-align:right;width:220px'>总经理:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_ZongJingLi} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_ZongJingLi}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZongJingLi' id='ZD_ZongJingLi' class='addboxinput inputfocus'  value='$row[ZD_ZongJingLi]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZongJingLi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GuanLiZheDaiBiao'>
		                        <li style='text-align:right;width:220px'>管理者代表:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_GuanLiZheDaiBiao} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_GuanLiZheDaiBiao}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GuanLiZheDaiBiao' id='ZD_GuanLiZheDaiBiao' class='addboxinput inputfocus'  value='$row[ZD_GuanLiZheDaiBiao]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GuanLiZheDaiBiao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_AnQuanShiWuDaiBiao'>
		                        <li style='text-align:right;width:220px'>安全事务代表:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_AnQuanShiWuDaiBiao} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_AnQuanShiWuDaiBiao}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_AnQuanShiWuDaiBiao' id='ZD_AnQuanShiWuDaiBiao' class='addboxinput inputfocus'  value='$row[ZD_AnQuanShiWuDaiBiao]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_AnQuanShiWuDaiBiao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShouCeBianZhiRen'>
		                        <li style='text-align:right;width:220px'>手册编制人:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_ShouCeBianZhiRen} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_ShouCeBianZhiRen}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShouCeBianZhiRen' id='ZD_ShouCeBianZhiRen' class='addboxinput inputfocus'  value='$row[ZD_ShouCeBianZhiRen]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShouCeBianZhiRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_XuanYongMoBan'>
		                        <li style='text-align:right;width:220px'>模版上传:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {sys_XuanYongMoBan} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{sys_XuanYongMoBan}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='6' name='sys_XuanYongMoBan' id='sys_XuanYongMoBan' tidno='461_sys_XuanYongMoBan_$strmk_id' class='addboxinput inputfocus' value='' style='display:none;width:100%'   />
	    <div id='sys_XuanYongMoBan_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'><div id='sys_XuanYongMoBan_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>+</div></div><script>createupload_jiaohu({'inputid':'sys_XuanYongMoBan','ToHtmlID':'DeskMenuDiv461'});</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_XuanYongMoBan_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_YinYongMoBan'>
		                        <li style='text-align:right;width:220px'>引用模版:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_YinYongMoBan} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_YinYongMoBan}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_YinYongMoBan' id='ZD_YinYongMoBan' class='addboxinput inputfocus'  value='$row[ZD_YinYongMoBan]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_YinYongMoBan_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='text-align:right;width:250px'>&nbsp; </li><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GongSiMingChen,ZD_GongSiDiZhi,ZD_GongSiDianHua,ZD_ZongJingLi,ZD_GuanLiZheDaiBiao,ZD_AnQuanShiWuDaiBiao,ZD_ShouCeBianZhiRen,sys_XuanYongMoBan,ZD_YinYongMoBan'/>";
if ( strpos($const_q_xiug, "461") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry='ZD_GongSiMingChen'  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry='ZD_GongSiMingChen'  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='461' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','ZD_GongSiMingChen','SQP_WenJianZiDongHua','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','sys_nowbh');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>参数设定</A>
<A class='selectTag' onClick=moban_check('tagContent1',this,'$ToHtmlID')>模版</A>
<A class='selectTag' onClick=SelectTag_Menu('tagContent2',this,'$ToHtmlID','368',$strmk_id)>文件</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv461_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
 echo( "<script>ListLoadEND('$ToHtmlID');</script>" );
mysqli_close( $Conn ); //关闭数据库

?>