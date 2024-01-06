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
	    $zu_all_list="432=产品认证,431=体系认证,433=其它,";
	    $sql = 'select * From `SQP_ChanPinQingDan` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv501');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_ChanPinQingDan','DeskMenuDiv501','#addbox');$('#DeskMenuDiv501 #addbox #post_form').attr({'tit':'','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv501');ListLoadEND_Mobile('DeskMenuDiv501');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"
                            <ul><li class='cols01'>产品名称:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ChanPinMingChen' id='ZD_ChanPinMingChen' class='addboxinput inputfocus' value='$row[ZD_ChanPinMingChen]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_ChanPinMingChen_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"<ul><li class='cols01'>适用范围:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShiYongFanWei' id='ZD_ShiYongFanWei' class='addboxinput inputfocus' value='$row[ZD_ShiYongFanWei]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ShiYongFanWei_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>取证周期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_QuZhengZhouQi' id='ZD_QuZhengZhouQi' class='addboxinput inputfocus' value='$row[ZD_QuZhengZhouQi]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_QuZhengZhouQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>有效期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_YouXiaoQi' id='ZD_YouXiaoQi' class='addboxinput inputfocus' value='$row[ZD_YouXiaoQi]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_YouXiaoQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>人数与产品:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_RenShuYuChanPin' id='ZD_RenShuYuChanPin' class='addboxinput inputfocus' value='$row[ZD_RenShuYuChanPin]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_RenShuYuChanPin_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>收费标准:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShouFeiBiaoZhun' id='ZD_ShouFeiBiaoZhun' class='addboxinput inputfocus' value='$row[ZD_ShouFeiBiaoZhun]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ShouFeiBiaoZhun_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>热度:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ReDu' id='ZD_ReDu' class='addboxinput inputfocus' value='$row[ZD_ReDu]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ReDu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>合作机构:</li>
               <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_HeZuoJiGou' id='ZD_HeZuoJiGou' class='addboxinput inputfocus' 25px;'   >$row[ZD_HeZuoJiGou]</textarea>
			   <div class='cols03 font_red yanzheng' id='ZD_HeZuoJiGou_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>认证需要准备的材料:</li>
               <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_RenZhengXuYaoZhunBeiDeCaiLiao' id='ZD_RenZhengXuYaoZhunBeiDeCaiLiao' class='addboxinput inputfocus' 25px;'   >$row[ZD_RenZhengXuYaoZhunBeiDeCaiLiao]</textarea>
			   <div class='cols03 font_red yanzheng' id='ZD_RenZhengXuYaoZhunBeiDeCaiLiao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>项目简介:</li>
               <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_XiangMuJianJie' id='ZD_XiangMuJianJie' class='addboxinput inputfocus' 25px;'   >$row[ZD_XiangMuJianJie]</textarea>
			   <div class='cols03 font_red yanzheng' id='ZD_XiangMuJianJie_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv501',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_ChanPinMingChenZD_ShiYongFanWei,ZD_QuZhengZhouQi,ZD_YouXiaoQi,ZD_RenShuYuChanPin,ZD_ShouFeiBiaoZhun,ZD_ReDu,ZD_HeZuoJiGou,ZD_RenZhengXuYaoZhunBeiDeCaiLiao,ZD_XiangMuJianJie'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv501','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv501')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv501','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='501' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv501')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv501_MenuDiv_368',this,'DeskMenuDiv501','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Conn ); //关闭数据库

?>