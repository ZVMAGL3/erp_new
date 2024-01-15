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
	   
	    global $strmk_id,$Conn,$sys_q_xiug;
	    $zu_all_list="";
	    $sql = 'select * From `SQP_ZongGuoChengQingDan` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv190');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_ZongGuoChengQingDan','DeskMenuDiv190','#addbox');$('#DeskMenuDiv190 #addbox #post_form').attr({'tit':'','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv190');ListLoadEND_Mobile('DeskMenuDiv190');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<ul><li class='cols01'>username:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='username' id='username' class='addboxinput inputfocus' value='$row[username]'   />
			   <div class='cols03 font_red yanzheng' id='username_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>DianHua3:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='DianHua3' id='DianHua3' class='addboxinput inputfocus' value='$row[DianHua3]'   />
			   <div class='cols03 font_red yanzheng' id='DianHua3_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>startdate:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='startdate' id='startdate' class='addboxinput inputfocus' value='$row[startdate]'   />
			   <div class='cols03 font_red yanzheng' id='startdate_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>enddate:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='enddate' id='enddate' class='addboxinput inputfocus' value='$row[enddate]'   />
			   <div class='cols03 font_red yanzheng' id='enddate_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>beizhu:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='beizhu' id='beizhu' class='addboxinput inputfocus' value='$row[beizhu]'   />
			   <div class='cols03 font_red yanzheng' id='beizhu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>qq:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='qq' id='qq' class='addboxinput inputfocus' value='$row[qq]'   />
			   <div class='cols03 font_red yanzheng' id='qq_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>分类:</li>
               <li class='cols02 reset_list'>
<label><input type='checkbox' typeid='15' name='sys_id_zu' id='sys_id_zu0' tit=' $row[sys_id_zu]' value='' class='addboxinput inputfocus' checked>&nbsp;所有分类&nbsp;</label><script>Inputdate('sys_id_zu','15','$row[sys_id_zu]','DeskMenuDiv190','');</script>
			   <div class='cols03 font_red yanzheng' id='sys_id_zu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>card:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='card' id='card' class='addboxinput inputfocus' value='$row[card]'   />
			   <div class='cols03 font_red yanzheng' id='card_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>bianhao:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='bianhao' id='bianhao' class='addboxinput inputfocus' value='$row[bianhao]'   />
			   <div class='cols03 font_red yanzheng' id='bianhao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>审核:</li>
               <li class='cols02 reset_list'><input type='text' typeid='20' name='sys_shenpi' id='sys_shenpi' class='addboxinput inputfocus'  placeholder='请审核'  y-value='$row[sys_shenpi]'  value='$row[sys_shenpi]'  onclick='SignSH(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='SignSH(this)'><i class='fa fa-20-3'></i></a>
			   <div class='cols03 font_red yanzheng' id='sys_shenpi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>批准:</li>
               <li class='cols02 reset_list'><input type='text' typeid='22' name='sys_shenpi_all' id='sys_shenpi_all' class='addboxinput inputfocus' placeholder='请批准'  y-value='$row[sys_shenpi_all]'  value='$row[sys_shenpi_all]'  onclick='SignPZ(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='SignPZ(this)'><i class='fa fa-20-4'></i></a>
			   <div class='cols03 font_red yanzheng' id='sys_shenpi_all_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>编制人:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_login' id='sys_login' class='addboxinput inputfocus' value='$row[sys_login]'   readonly  />
			   <div class='cols03 font_red yanzheng' id='sys_login_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>经办人:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_chaosong' id='sys_chaosong' class='addboxinput inputfocus' value='$row[sys_chaosong]'   />
			   <div class='cols03 font_red yanzheng' id='sys_chaosong_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>排序:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_paixu' id='sys_paixu' class='addboxinput inputfocus' value='$row[sys_paixu]'   />
			   <div class='cols03 font_red yanzheng' id='sys_paixu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv190',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='username,DianHua3,startdate,enddate,beizhu,qq,sys_id_zu,card,bianhao,sys_shenpi,sys_shenpi_all,sys_login,sys_chaosong,sys_paixu'/>";
if ( $sys_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv190','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv190')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv190','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='190' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv190')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv190_MenuDiv_368',this,'DeskMenuDiv190','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Conn ); //关闭数据库

?>