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
	    $sql = 'select * From `SQP_JieChuLaoDongHeTongZhengMingShu` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv503');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_JieChuLaoDongHeTongZhengMingShu','DeskMenuDiv503','#addbox');$('#DeskMenuDiv503 #addbox #post_form').attr({'tit':'','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv503');ListLoadEND_Mobile('DeskMenuDiv503');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<ul><li class='cols01'>姓名:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XingMing' id='ZD_XingMing' class='addboxinput inputfocus'  value='$row[ZD_XingMing]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_XingMing_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>性别:</li>
               <li class='cols02 reset_list'><label><input name='ZD_XingBie' type='radio' typeid='11' id='ZD_XingBie_0' value='男' class='addboxinput inputfocus'   checked='checked'    />男&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XingBie' type='radio' typeid='11' id='ZD_XingBie_1' class='addboxinput inputfocus' value='女'  checked='checked'    />女</label><script>Inputdate('ZD_XingBie','11','$row[ZD_XingBie]','DeskMenuDiv503','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_XingBie_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>身份证号:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenFenZhengHao' id='ZD_ShenFenZhengHao' class='addboxinput inputfocus'  value='$row[ZD_ShenFenZhengHao]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ShenFenZhengHao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>起始工作时间:</li>
               <li class='cols02 reset_list'><input type='text' typeid='8' name='ZD_QiShiGongZuoShiJian' id='ZD_QiShiGongZuoShiJian' class='addboxinput inputfocus' value='$row[ZD_QiShiGongZuoShiJian]' style='width:100%'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_QiShiGongZuoShiJian',theme: '#393D49',lang: 'cn'});</script>
			   <div class='cols03 font_red yanzheng' id='ZD_QiShiGongZuoShiJian_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>所解除劳动合同期限:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_SuoJieChuLaoDongHeTongQiXian' id='ZD_SuoJieChuLaoDongHeTongQiXian' class='addboxinput inputfocus'  value='$row[ZD_SuoJieChuLaoDongHeTongQiXian]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_SuoJieChuLaoDongHeTongQiXian_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>离职原因:</li>
               <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_LiZhiYuanYin' id='ZD_LiZhiYuanYin' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$row[ZD_LiZhiYuanYin]</textarea>
			   <div class='cols03 font_red yanzheng' id='ZD_LiZhiYuanYin_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>解除劳动合同时间:</li>
               <li class='cols02 reset_list'><input type='text' typeid='8' name='ZD_JieChuLaoDongHeTongShiJian' id='ZD_JieChuLaoDongHeTongShiJian' class='addboxinput inputfocus' value='$row[ZD_JieChuLaoDongHeTongShiJian]' style='width:100%'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_JieChuLaoDongHeTongShiJian',theme: '#393D49',lang: 'cn'});</script>
			   <div class='cols03 font_red yanzheng' id='ZD_JieChuLaoDongHeTongShiJian_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>劳动者签字:</li>
               <li class='cols02 reset_list'><label><input name='ZD_LaoDongZheQianZi' type='radio' typeid='17' id='ZD_LaoDongZheQianZi_0' value='是' class='addboxinput inputfocus'    />是&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_LaoDongZheQianZi' type='radio' typeid='17' id='ZD_LaoDongZheQianZi_1' class='addboxinput inputfocus' value=''   checked='checked'    />否</label><script>Inputdate('ZD_LaoDongZheQianZi','17','$row[ZD_LaoDongZheQianZi]','DeskMenuDiv503','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_LaoDongZheQianZi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv503',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingMingZD_XingBie,ZD_ShenFenZhengHao,ZD_QiShiGongZuoShiJian,ZD_SuoJieChuLaoDongHeTongQiXian,ZD_LiZhiYuanYin,ZD_JieChuLaoDongHeTongShiJian,ZD_LaoDongZheQianZi'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv503','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv503')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv503','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='503' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv503')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv503_MenuDiv_368',this,'DeskMenuDiv503','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Conn ); //关闭数据库

?>