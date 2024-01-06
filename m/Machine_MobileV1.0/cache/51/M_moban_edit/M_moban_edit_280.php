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
	    $sql = 'select * From `SQP_GongZuoJiHua` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv280');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_GongZuoJiHua','DeskMenuDiv280','#addbox');$('#DeskMenuDiv280 #addbox #post_form').attr({'tit':'','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv280');ListLoadEND_Mobile('DeskMenuDiv280');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"
                            <ul><li class='cols01'>工作项目:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='GongZuoXiangMu' id='GongZuoXiangMu' class='addboxinput inputfocus'  value='$row[GongZuoXiangMu]'  style='width:100%'   />
                            <div class='cols03 font_red yanzheng' id='GongZuoXiangMu_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"<ul><li class='cols01'>内容要求:</li>
               <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='NaRongYaoQiu' id='NaRongYaoQiu' class='addboxinput inputfocus' style='width:100%;height:350px;'   >$row[NaRongYaoQiu]</textarea>
			   <div class='cols03 font_red yanzheng' id='NaRongYaoQiu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>交期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='8' name='JiaoQi' id='JiaoQi' class='addboxinput inputfocus' value='$row[JiaoQi]' style='width:100%'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#JiaoQi',theme: '#393D49',lang: 'cn'});</script>
			   <div class='cols03 font_red yanzheng' id='JiaoQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>完成:</li>
               <li class='cols02 reset_list'><label><input name='WanCheng' type='radio' typeid='17' id='WanCheng_0' value='是' class='addboxinput inputfocus'    />是&nbsp;&nbsp;&nbsp;</label><label><input name='WanCheng' type='radio' typeid='17' id='WanCheng_1' class='addboxinput inputfocus' value=''   checked='checked'    />否</label><script>Inputdate('WanCheng','17','$row[WanCheng]','DeskMenuDiv280','');</script>
			   <div class='cols03 font_red yanzheng' id='WanCheng_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv280',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='GongZuoXiangMuNaRongYaoQiu,JiaoQi,WanCheng'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv280','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv280')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv280','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='280' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv280')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv280_MenuDiv_368',this,'DeskMenuDiv280','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Conn ); //关闭数据库

?>