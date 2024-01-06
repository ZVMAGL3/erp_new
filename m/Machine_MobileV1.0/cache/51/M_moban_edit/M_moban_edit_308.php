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
	    $zu_all_list="428=产品,430=其它,426=图纸,429=技术资料,427=模具/夹具,";
	    $sql = 'select * From `SQP_GuKeCaiChanQingDan` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv308');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_GuKeCaiChanQingDan','DeskMenuDiv308','#addbox');$('#DeskMenuDiv308 #addbox #post_form').attr({'tit':'','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv308');ListLoadEND_Mobile('DeskMenuDiv308');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"
                            <ul><li class='cols01'>顾客名称:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GuKeMingChen' id='ZD_GuKeMingChen' class='addboxinput inputfocus' value='$row[ZD_GuKeMingChen]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_GuKeMingChen_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'>财产名称:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_CaiChanMingChen' id='ZD_CaiChanMingChen' class='addboxinput inputfocus' value='$row[ZD_CaiChanMingChen]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_CaiChanMingChen_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"<ul><li class='cols01'>型号/规格:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XingHaoGuiGe' id='ZD_XingHaoGuiGe' class='addboxinput inputfocus' value='$row[ZD_XingHaoGuiGe]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_XingHaoGuiGe_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>本厂编号:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_BenChangBianHao' id='ZD_BenChangBianHao' class='addboxinput inputfocus' value='$row[ZD_BenChangBianHao]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_BenChangBianHao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>数量:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShuLiang' id='ZD_ShuLiang' class='addboxinput inputfocus' value='$row[ZD_ShuLiang]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ShuLiang_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>接收日期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JieShouRiQi' id='ZD_JieShouRiQi' class='addboxinput inputfocus' value='$row[ZD_JieShouRiQi]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JieShouRiQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>使用部门:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShiYongBuMen' id='ZD_ShiYongBuMen' class='addboxinput inputfocus' value='$row[ZD_ShiYongBuMen]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ShiYongBuMen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>完好状态:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_WanHaoZhuangTai' id='ZD_WanHaoZhuangTai' class='addboxinput inputfocus' value='$row[ZD_WanHaoZhuangTai]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_WanHaoZhuangTai_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>存放地点:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_CunFangDiDian' id='ZD_CunFangDiDian' class='addboxinput inputfocus' value='$row[ZD_CunFangDiDian]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_CunFangDiDian_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>报废日期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_BaoFeiRiQi' id='ZD_BaoFeiRiQi' class='addboxinput inputfocus' value='$row[ZD_BaoFeiRiQi]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_BaoFeiRiQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>备注:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus' value='$row[ZD_BeiZhu]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_BeiZhu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv308',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GuKeMingChen,ZD_CaiChanMingChenZD_XingHaoGuiGe,ZD_BenChangBianHao,ZD_ShuLiang,ZD_JieShouRiQi,ZD_ShiYongBuMen,ZD_WanHaoZhuangTai,ZD_CunFangDiDian,ZD_BaoFeiRiQi,ZD_BeiZhu'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv308','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv308')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv308','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='308' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv308')>编辑</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv308_MenuDiv_264',this,'DeskMenuDiv308','33',$strmk_id)>交流记录</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv308_MenuDiv_368',this,'DeskMenuDiv308','368',$strmk_id)>E+</A>
<A onClick=GuanXi(this,'DeskMenuDiv308')>+</A>
</div>
";
mysqli_close( $Conn ); //关闭数据库

?>