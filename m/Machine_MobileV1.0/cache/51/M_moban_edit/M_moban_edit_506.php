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
	    $zu_all_list="451=10月,452=11月,453=12月,442=1月,443=2月,444=3月,445=4月,446=5月,447=6月,448=7月,449=8月,450=9月,";
	    $sql = 'select * From `sys_GongZiBiao` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv506');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','sys_GongZiBiao','DeskMenuDiv506','#addbox');$('#DeskMenuDiv506 #addbox #post_form').attr({'tit':'','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv506');ListLoadEND_Mobile('DeskMenuDiv506');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<ul><li class='cols01'>姓名:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XingMing' id='ZD_XingMing' class='addboxinput inputfocus'  value='$row[ZD_XingMing]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_XingMing_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>所属年份:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_SuoShuNianFen' id='ZD_SuoShuNianFen' class='addboxinput inputfocus'  value='$row[ZD_SuoShuNianFen]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_SuoShuNianFen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>所属月份:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_SuoShuYueFen' id='ZD_SuoShuYueFen' class='addboxinput inputfocus'  value='$row[ZD_SuoShuYueFen]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_SuoShuYueFen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>基本工资:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiBenGongZi' id='ZD_JiBenGongZi' class='addboxinput inputfocus'  value='$row[ZD_JiBenGongZi]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiBenGongZi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>职务工资:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZhiWuGongZi' id='ZD_ZhiWuGongZi' class='addboxinput inputfocus'  value='$row[ZD_ZhiWuGongZi]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ZhiWuGongZi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>年度加薪:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_NianDuJiaXin' id='ZD_NianDuJiaXin' class='addboxinput inputfocus'  value='$row[ZD_NianDuJiaXin]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_NianDuJiaXin_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>出勤天数:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ChuQinTianShu' id='ZD_ChuQinTianShu' class='addboxinput inputfocus'  value='$row[ZD_ChuQinTianShu]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ChuQinTianShu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>个人社保扣除:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GeRenSheBaoKouChu' id='ZD_GeRenSheBaoKouChu' class='addboxinput inputfocus'  value='$row[ZD_GeRenSheBaoKouChu]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GeRenSheBaoKouChu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>加班工资:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiaBanGongZi' id='ZD_JiaBanGongZi' class='addboxinput inputfocus'  value='$row[ZD_JiaBanGongZi]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiaBanGongZi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>出差补贴:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ChuChaBuTie' id='ZD_ChuChaBuTie' class='addboxinput inputfocus'  value='$row[ZD_ChuChaBuTie]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ChuChaBuTie_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>项目提成:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XiangMuTiCheng' id='ZD_XiangMuTiCheng' class='addboxinput inputfocus'  value='$row[ZD_XiangMuTiCheng]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_XiangMuTiCheng_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>业务提成:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_YeWuTiCheng' id='ZD_YeWuTiCheng' class='addboxinput inputfocus'  value='$row[ZD_YeWuTiCheng]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_YeWuTiCheng_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>请假扣除:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_QingJiaKouChu' id='ZD_QingJiaKouChu' class='addboxinput inputfocus'  value='$row[ZD_QingJiaKouChu]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_QingJiaKouChu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>全勤奖:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_QuanQinJiang' id='ZD_QuanQinJiang' class='addboxinput inputfocus'  value='$row[ZD_QuanQinJiang]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_QuanQinJiang_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>当月实发:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DangYueShiFa' id='ZD_DangYueShiFa' class='addboxinput inputfocus'  value='$row[ZD_DangYueShiFa]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_DangYueShiFa_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>备注:</li>
               <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$row[ZD_BeiZhu]</textarea>
			   <div class='cols03 font_red yanzheng' id='ZD_BeiZhu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv506',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingMing,ZD_SuoShuNianFen,ZD_SuoShuYueFenZD_JiBenGongZi,ZD_ZhiWuGongZi,ZD_NianDuJiaXin,ZD_ChuQinTianShu,ZD_GeRenSheBaoKouChu,ZD_JiaBanGongZi,ZD_ChuChaBuTie,ZD_XiangMuTiCheng,ZD_YeWuTiCheng,ZD_QingJiaKouChu,ZD_QuanQinJiang,ZD_DangYueShiFa,ZD_BeiZhu'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv506','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv506')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv506','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='506' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv506')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv506_MenuDiv_368',this,'DeskMenuDiv506','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Conn ); //关闭数据库

?>