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
	    $sql = 'select * From `SQP_HeTongXiangMuGenZongJiLu` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv499');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_HeTongXiangMuGenZongJiLu','DeskMenuDiv499','#addbox');$('#DeskMenuDiv499 #addbox #post_form').attr({'tit':'ZD_GongSiMingChenZD_QianDingRiQi,ZD_HeTongBianHao,ZD_XiangMu,ZD_JiaoQi,ZD_LianXiRen,ZD_DianHua','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv499');ListLoadEND_Mobile('DeskMenuDiv499');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;公司名称:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiMingChen' id='ZD_GongSiMingChen' class='addboxinput inputfocus'  value='$row[ZD_GongSiMingChen]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_GongSiMingChen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;签订日期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='8' name='ZD_QianDingRiQi' id='ZD_QianDingRiQi' class='addboxinput inputfocus' value='$row[ZD_QianDingRiQi]' style='width:100%'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_QianDingRiQi',theme: '#393D49',lang: 'cn'});</script>
			   <div class='cols03 font_red yanzheng' id='ZD_QianDingRiQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;合同编号:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HeTongBianHao' id='ZD_HeTongBianHao' class='addboxinput inputfocus'  value='$row[ZD_HeTongBianHao]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_HeTongBianHao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;项目:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XiangMu' id='ZD_XiangMu' class='addboxinput inputfocus'  value='$row[ZD_XiangMu]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_XiangMu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;交期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiaoQi' id='ZD_JiaoQi' class='addboxinput inputfocus'  value='$row[ZD_JiaoQi]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiaoQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;联系人:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_LianXiRen' id='ZD_LianXiRen' class='addboxinput inputfocus'  value='$row[ZD_LianXiRen]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_LianXiRen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;电话:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DianHua' id='ZD_DianHua' class='addboxinput inputfocus'  value='$row[ZD_DianHua]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_DianHua_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>预付款金额/日期/帐号:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_YuFuKuanJinERiQiZhangHao' id='ZD_YuFuKuanJinERiQiZhangHao' class='addboxinput inputfocus'  value='$row[ZD_YuFuKuanJinERiQiZhangHao]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_YuFuKuanJinERiQiZhangHao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>①合同上传:</li>
               <li class='cols02 reset_list'><input type='text' typeid='6' name='ZD_HeTongShangChuan' id='ZD_HeTongShangChuan' tidno='499_ZD_HeTongShangChuan_$strmk_id' class='addboxinput inputfocus' value='' style='display:none;width:100%'   />
	    <div id='ZD_HeTongShangChuan_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'><div id='ZD_HeTongShangChuan_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>+</div></div><script>createupload_jiaohu({'inputid':'ZD_HeTongShangChuan','ToHtmlID':'DeskMenuDiv499'});</script>
			   <div class='cols03 font_red yanzheng' id='ZD_HeTongShangChuan_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>服务流程单签收/日期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_FuWuLiuChengDanQianShouRiQi' id='ZD_FuWuLiuChengDanQianShouRiQi' class='addboxinput inputfocus'  value='$row[ZD_FuWuLiuChengDanQianShouRiQi]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_FuWuLiuChengDanQianShouRiQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>项目完成/日期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XiangMuWanChengRiQi' id='ZD_XiangMuWanChengRiQi' class='addboxinput inputfocus'  value='$row[ZD_XiangMuWanChengRiQi]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_XiangMuWanChengRiQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>尾款:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_WeiKuan' id='ZD_WeiKuan' class='addboxinput inputfocus'  value='$row[ZD_WeiKuan]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_WeiKuan_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>证书上传:</li>
               <li class='cols02 reset_list'><input type='text' typeid='6' name='ZD_ZhengShuShangChuan' id='ZD_ZhengShuShangChuan' tidno='499_ZD_ZhengShuShangChuan_$strmk_id' class='addboxinput inputfocus' value='' style='display:none;width:100%'   />
	    <div id='ZD_ZhengShuShangChuan_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'><div id='ZD_ZhengShuShangChuan_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>+</div></div><script>createupload_jiaohu({'inputid':'ZD_ZhengShuShangChuan','ToHtmlID':'DeskMenuDiv499'});</script>
			   <div class='cols03 font_red yanzheng' id='ZD_ZhengShuShangChuan_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>拍照宣传:</li>
               <li class='cols02 reset_list'><input type='text' typeid='6' name='ZD_PaiZhaoXuanChuan' id='ZD_PaiZhaoXuanChuan' tidno='499_ZD_PaiZhaoXuanChuan_$strmk_id' class='addboxinput inputfocus' value='' style='display:none;width:100%'   />
	    <div id='ZD_PaiZhaoXuanChuan_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'><div id='ZD_PaiZhaoXuanChuan_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>+</div></div><script>createupload_jiaohu({'inputid':'ZD_PaiZhaoXuanChuan','ToHtmlID':'DeskMenuDiv499'});</script>
			   <div class='cols03 font_red yanzheng' id='ZD_PaiZhaoXuanChuan_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>备注:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus'  value='$row[ZD_BeiZhu]'  style='width:100%'   />
			   <div class='cols03 font_red yanzheng' id='ZD_BeiZhu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv499',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GongSiMingChenZD_QianDingRiQi,ZD_HeTongBianHao,ZD_XiangMu,ZD_JiaoQi,ZD_LianXiRen,ZD_DianHua,ZD_YuFuKuanJinERiQiZhangHao,ZD_HeTongShangChuan,ZD_FuWuLiuChengDanQianShouRiQi,ZD_XiangMuWanChengRiQi,ZD_WeiKuan,ZD_ZhengShuShangChuan,ZD_PaiZhaoXuanChuan,ZD_BeiZhu'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv499','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry='ZD_GongSiMingChenZD_QianDingRiQi,ZD_HeTongBianHao,ZD_XiangMu,ZD_JiaoQi,ZD_LianXiRen,ZD_DianHua'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv499')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv499','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry='ZD_GongSiMingChenZD_QianDingRiQi,ZD_HeTongBianHao,ZD_XiangMu,ZD_JiaoQi,ZD_LianXiRen,ZD_DianHua'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='499' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv499')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv499_MenuDiv_368',this,'DeskMenuDiv499','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Conn ); //关闭数据库

?>