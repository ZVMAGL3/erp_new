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
	    $zu_all_list="";
	    $sql = 'select * From `SQP_GongXianZhi` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv504');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_GongXianZhi','DeskMenuDiv504','#addbox');$('#DeskMenuDiv504 #addbox #post_form').attr({'tit':'','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv504');ListLoadEND_Mobile('DeskMenuDiv504');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"
                            <ul><li class='cols01'>姓名:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XingMing' id='ZD_XingMing' class='addboxinput inputfocus' value='$row[ZD_XingMing]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_XingMing_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"<ul><li class='cols01'>①贡献值:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi' id='ZD_GongXianZhi' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>①积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen' id='ZD_JiFen' class='addboxinput inputfocus' value='$row[ZD_JiFen]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiFen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>②贡献值:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎1012' id='ZD_GongXianZhi2020827‎16‎‎40‎‎1012' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎40‎‎1012]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎40‎‎1012_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>②积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎142964' id='ZD_JiFen2020827‎16‎‎40‎‎142964' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎40‎‎142964]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎40‎‎142964_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>③贡献值:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎252196' id='ZD_GongXianZhi2020827‎16‎‎40‎‎252196' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎40‎‎252196]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎40‎‎252196_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>③积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎332199' id='ZD_JiFen2020827‎16‎‎40‎‎332199' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎40‎‎332199]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎40‎‎332199_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>④贡献值:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎402031' id='ZD_GongXianZhi2020827‎16‎‎40‎‎402031' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎40‎‎402031]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎40‎‎402031_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>④积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎46924' id='ZD_JiFen2020827‎16‎‎40‎‎46924' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎40‎‎46924]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎40‎‎46924_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑤贡献值:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎00300' id='ZD_GongXianZhi2020827‎16‎‎41‎‎00300' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎41‎‎00300]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎00300_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑤积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎12810' id='ZD_JiFen2020827‎16‎‎41‎‎12810' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎41‎‎12810]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎12810_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑥贡献值:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎24450' id='ZD_GongXianZhi2020827‎16‎‎41‎‎24450' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎41‎‎24450]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎24450_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑥积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎56‎‎012850' id='ZD_JiFen2020827‎16‎‎56‎‎012850' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎56‎‎012850]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎56‎‎012850_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑦贡献值:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎54‎‎322661' id='ZD_GongXianZhi2020827‎16‎‎54‎‎322661' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎54‎‎322661]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎54‎‎322661_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑦积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎331482' id='ZD_JiFen2020827‎16‎‎41‎‎331482' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎41‎‎331482]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎331482_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑧贡献值:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎42138' id='ZD_GongXianZhi2020827‎16‎‎41‎‎42138' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎41‎‎42138]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎42138_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑧积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎462247' id='ZD_JiFen2020827‎16‎‎41‎‎462247' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎41‎‎462247]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎462247_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑨贡献值:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎531791' id='ZD_GongXianZhi2020827‎16‎‎41‎‎531791' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎41‎‎531791]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎531791_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑨积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎572919' id='ZD_JiFen2020827‎16‎‎41‎‎572919' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎41‎‎572919]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎572919_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑩贡献值:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎12927' id='ZD_GongXianZhi2020827‎16‎‎46‎‎12927' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎46‎‎12927]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎46‎‎12927_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑩积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎172175' id='ZD_JiFen2020827‎16‎‎46‎‎172175' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎46‎‎172175]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎46‎‎172175_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑪贡献值:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎241170' id='ZD_GongXianZhi2020827‎16‎‎46‎‎241170' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎46‎‎241170]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎46‎‎241170_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑪积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎301743' id='ZD_JiFen2020827‎16‎‎46‎‎301743' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎46‎‎301743]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎46‎‎301743_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑫贡献值:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎361122' id='ZD_GongXianZhi2020827‎16‎‎46‎‎361122' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎46‎‎361122]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎46‎‎361122_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑫积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎4115' id='ZD_JiFen2020827‎16‎‎46‎‎4115' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎46‎‎4115]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎46‎‎4115_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>总贡献值:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZongGongXianZhi' id='ZD_ZongGongXianZhi' class='addboxinput inputfocus' value='$row[ZD_ZongGongXianZhi]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ZongGongXianZhi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>总积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZongJiFen' id='ZD_ZongJiFen' class='addboxinput inputfocus' value='$row[ZD_ZongJiFen]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ZongJiFen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>合计:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HeJi' id='ZD_HeJi' class='addboxinput inputfocus' value='$row[ZD_HeJi]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_HeJi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>备注:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus' value='$row[ZD_BeiZhu]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_BeiZhu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv504',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingMingZD_GongXianZhi,ZD_JiFen,ZD_GongXianZhi2020827‎16‎‎40‎‎1012,ZD_JiFen2020827‎16‎‎40‎‎142964,ZD_GongXianZhi2020827‎16‎‎40‎‎252196,ZD_JiFen2020827‎16‎‎40‎‎332199,ZD_GongXianZhi2020827‎16‎‎40‎‎402031,ZD_JiFen2020827‎16‎‎40‎‎46924,ZD_GongXianZhi2020827‎16‎‎41‎‎00300,ZD_JiFen2020827‎16‎‎41‎‎12810,ZD_GongXianZhi2020827‎16‎‎41‎‎24450,ZD_JiFen2020827‎16‎‎56‎‎012850,ZD_GongXianZhi2020827‎16‎‎54‎‎322661,ZD_JiFen2020827‎16‎‎41‎‎331482,ZD_GongXianZhi2020827‎16‎‎41‎‎42138,ZD_JiFen2020827‎16‎‎41‎‎462247,ZD_GongXianZhi2020827‎16‎‎41‎‎531791,ZD_JiFen2020827‎16‎‎41‎‎572919,ZD_GongXianZhi2020827‎16‎‎46‎‎12927,ZD_JiFen2020827‎16‎‎46‎‎172175,ZD_GongXianZhi2020827‎16‎‎46‎‎241170,ZD_JiFen2020827‎16‎‎46‎‎301743,ZD_GongXianZhi2020827‎16‎‎46‎‎361122,ZD_JiFen2020827‎16‎‎46‎‎4115,ZD_ZongGongXianZhi,ZD_ZongJiFen,ZD_HeJi,ZD_BeiZhu'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv504','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv504')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv504','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='504' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv504')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv504_MenuDiv_368',this,'DeskMenuDiv504','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Conn ); //关闭数据库

?>