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
	    $zu_all_list="408=体系资料整理/家,415=其它,412=器具送检整理,410=外出/审核,406=大扫除,414=学习（1小时）,420=工作积分登记发布,407=打扫卫生,419=扔垃圾（值日）,404=接/打电话,423=收发快递-10分,411=整改/家,405=整理项目资料,425=检定证书扫描存档,409=监督审核联系（提前2个月）,418=证书/合同扫描存档,";
	    $sql = 'select * From `SQP_MeiRiGongZuoHuiBaoBiao` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv497');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_MeiRiGongZuoHuiBaoBiao','DeskMenuDiv497','#addbox');$('#DeskMenuDiv497 #addbox #post_form').attr({'tit':'ZD_HuiBaoRenZD_XiangXiMiaoShu,ZD_HuiBaoRiQi,ZD_WanChengQingKuang','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv497');ListLoadEND_Mobile('DeskMenuDiv497');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;汇报人:</li>
               <li class='cols02 reset_list'><input type='text' typeid='23' name='ZD_HuiBaoRen' id='ZD_HuiBaoRen' class='addboxinput inputfocus'   value='$row[ZD_HuiBaoRen]'  style='width:100%'    readonly='readonly' />
			   <div class='cols03 font_red yanzheng' id='ZD_HuiBaoRen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;详细描述:</li>
               <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_XiangXiMiaoShu' id='ZD_XiangXiMiaoShu' class='addboxinput inputfocus' style='width:100%;height:352px;'   >$row[ZD_XiangXiMiaoShu]</textarea>
			   <div class='cols03 font_red yanzheng' id='ZD_XiangXiMiaoShu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;汇报日期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HuiBaoRiQi' id='ZD_HuiBaoRiQi' class='addboxinput inputfocus'  value='$row[ZD_HuiBaoRiQi]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_HuiBaoRiQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;完成情况:</li>
               <li class='cols02 reset_list'><label><input name='ZD_WanChengQingKuang' type='radio' typeid='17' id='ZD_WanChengQingKuang_0' value='是' class='addboxinput inputfocus'    />是&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_WanChengQingKuang' type='radio' typeid='17' id='ZD_WanChengQingKuang_1' class='addboxinput inputfocus' value=''   checked='checked'    />否</label><script>Inputdate('ZD_WanChengQingKuang','17','$row[ZD_WanChengQingKuang]','DeskMenuDiv497','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_WanChengQingKuang_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>积分:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen' id='ZD_JiFen' class='addboxinput inputfocus'  value='$row[ZD_JiFen]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiFen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>审阅人:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenYueRen' id='ZD_ShenYueRen' class='addboxinput inputfocus'  value='$row[ZD_ShenYueRen]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ShenYueRen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>审阅时间:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenYueShiJian' id='ZD_ShenYueShiJian' class='addboxinput inputfocus'  value='$row[ZD_ShenYueShiJian]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ShenYueShiJian_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv497',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_HuiBaoRenZD_XiangXiMiaoShu,ZD_HuiBaoRiQi,ZD_WanChengQingKuang,ZD_JiFen,ZD_ShenYueRen,ZD_ShenYueShiJian'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv497','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_id_zu' bitian_Arry='ZD_HuiBaoRenZD_XiangXiMiaoShu,ZD_HuiBaoRiQi,ZD_WanChengQingKuang'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv497')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv497','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_id_zu' bitian_Arry='ZD_HuiBaoRenZD_XiangXiMiaoShu,ZD_HuiBaoRiQi,ZD_WanChengQingKuang'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='497' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv497')>编辑</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv497_MenuDiv_',this,'DeskMenuDiv497','40',$strmk_id)></A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv497_MenuDiv_368',this,'DeskMenuDiv497','368',$strmk_id)>E+</A>
<A onClick=GuanXi(this,'DeskMenuDiv497')>+</A>
</div>
";
mysqli_close( $Conn ); //关闭数据库

?>