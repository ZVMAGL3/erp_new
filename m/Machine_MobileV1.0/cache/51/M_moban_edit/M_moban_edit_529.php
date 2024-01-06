<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'M_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Connadmin.php";
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
	    if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                                //1回收站0为不回收
	    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                               //是否为回收站0为不回收
	   
	    global $strmk_id,$Connadmin,$const_q_xiug;
	    $zu_all_list="";
	    $sql = 'select * From `msc_user_hy` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Connadmin , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv529');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','msc_user_hy','DeskMenuDiv529','#addbox');$('#DeskMenuDiv529 #addbox #post_form').attr({'tit':'','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv529');ListLoadEND_Mobile('DeskMenuDiv529');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<ul><li class='cols01'>用户ID:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='user_id' id='user_id' class='addboxinput inputfocus' value='$row[user_id]'   />
			   <div class='cols03 font_red yanzheng' id='user_id_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>状态:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='state' id='state' class='addboxinput inputfocus' value='$row[state]'   />
			   <div class='cols03 font_red yanzheng' id='state_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>工号:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_GongHao' id='SYS_GongHao' class='addboxinput inputfocus' value='$row[SYS_GongHao]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_GongHao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>职位ID:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='zhiwei_id' id='zhiwei_id' class='addboxinput inputfocus' value='$row[zhiwei_id]'   />
			   <div class='cols03 font_red yanzheng' id='zhiwei_id_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>添加时间:</li>
               <li class='cols02 reset_list'><input type='text' typeid='9' name='add_time' id='add_time' class='addboxinput inputfocus' value='$row[add_time]'    /><a class='jia jiaok'  onclick=''><i class='fa fa-25-03'></i></a><script>laydate.render({  elem: '#add_time',theme: '#393D49',type: 'datetime',lang: 'cn'});</script>
			   <div class='cols03 font_red yanzheng' id='add_time_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>上次更新时间:</li>
               <li class='cols02 reset_list'><input type='text' typeid='9' name='new_time' id='new_time' class='addboxinput inputfocus' value='$row[new_time]'    /><a class='jia jiaok'  onclick=''><i class='fa fa-25-03'></i></a><script>laydate.render({  elem: '#new_time',theme: '#393D49',type: 'datetime',lang: 'cn'});</script>
			   <div class='cols03 font_red yanzheng' id='new_time_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>备注:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='Remark' id='Remark' class='addboxinput inputfocus' value='$row[Remark]'   />
			   <div class='cols03 font_red yanzheng' id='Remark_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv529',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='user_id,state,SYS_GongHao,zhiwei_id,add_time,new_time,Remark'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv529','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv529')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv529','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='529' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv529')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv529_MenuDiv_368',this,'DeskMenuDiv529','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Connadmin ); //关闭数据库

?>