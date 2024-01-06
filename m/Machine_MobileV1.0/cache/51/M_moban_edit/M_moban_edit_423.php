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
	    $sql = 'select * From `SQP_GuKeHeTong` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv423');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_GuKeHeTong','DeskMenuDiv423','#addbox');$('#DeskMenuDiv423 #addbox #post_form').attr({'tit':'ZD_QianDingRiQi,ZD_JiaoQi','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv423');ListLoadEND_Mobile('DeskMenuDiv423');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"
                            <ul><li class='cols01'>合同附件:</li>
                            <li class='cols02 reset_list'>
                <input type='text' typeid='6' name='ZD_HeTongFuJian' id='ZD_HeTongFuJian_$ToHtmlID' tidno='423_ZD_HeTongFuJian_$strmk_id' class='addboxinput inputfocus ZD_HeTongFuJian' value='' style='display:none;width:100%'   />
                <div id='ZD_HeTongFuJian_$ToHtmlID"."_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'>
                    <div id='ZD_HeTongFuJian_$ToHtmlID"."_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>
                        +
                    </div>
                </div>
                <script>
                    createupload_jiaohu({'inputid':'ZD_HeTongFuJian','ToHtmlID':'$ToHtmlID'});
                </script>
            
                            <div class='cols03 font_red yanzheng' id='ZD_HeTongFuJian_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'>所属顾客:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_SuoShuGuKe' id='ZD_SuoShuGuKe' class='addboxinput inputfocus' value='$row[ZD_SuoShuGuKe]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_SuoShuGuKe_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"<ul><li class='cols01'>合同编号:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HeTongBianHao' id='ZD_HeTongBianHao' class='addboxinput inputfocus' value='$row[ZD_HeTongBianHao]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_HeTongBianHao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>合同金额:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HeTongJinE' id='ZD_HeTongJinE' class='addboxinput inputfocus' value='$row[ZD_HeTongJinE]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_HeTongJinE_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>项目:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XiangMu' id='ZD_XiangMu' class='addboxinput inputfocus' value='$row[ZD_XiangMu]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_XiangMu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>联系人:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_LianXiRen' id='ZD_LianXiRen' class='addboxinput inputfocus' value='$row[ZD_LianXiRen]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_LianXiRen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>电话:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DianHua' id='ZD_DianHua' class='addboxinput inputfocus' value='$row[ZD_DianHua]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_DianHua_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>地址:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DiZhi' id='ZD_DiZhi' class='addboxinput inputfocus' value='$row[ZD_DiZhi]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_DiZhi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;签订日期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='8' name='ZD_QianDingRiQi' id='ZD_QianDingRiQi' class='addboxinput inputfocus' value='$row[ZD_QianDingRiQi]'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_QianDingRiQi',theme: '#393D49',lang: 'cn'});</script>
			   <div class='cols03 font_red yanzheng' id='ZD_QianDingRiQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;交期:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiaoQi' id='ZD_JiaoQi' class='addboxinput inputfocus' value='$row[ZD_JiaoQi]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiaoQi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>签订地点:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_QianDingDiDian' id='ZD_QianDingDiDian' class='addboxinput inputfocus' value='$row[ZD_QianDingDiDian]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_QianDingDiDian_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>项目经理:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XiangMuJingLi' id='ZD_XiangMuJingLi' class='addboxinput inputfocus' value='$row[ZD_XiangMuJingLi]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_XiangMuJingLi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv423',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_HeTongFuJian,ZD_SuoShuGuKeZD_HeTongBianHao,ZD_HeTongJinE,ZD_XiangMu,ZD_LianXiRen,ZD_DianHua,ZD_DiZhi,ZD_QianDingRiQi,ZD_JiaoQi,ZD_QianDingDiDian,ZD_XiangMuJingLi'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv423','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='ZD_QianDingRiQi,ZD_JiaoQi'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv423')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv423','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='ZD_QianDingRiQi,ZD_JiaoQi'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='423' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv423')>编辑</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv423_MenuDiv_499',this,'DeskMenuDiv423','24',$strmk_id)>合同项目跟踪记录</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv423_MenuDiv_471',this,'DeskMenuDiv423','25',$strmk_id)>合同评审记录表</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv423_MenuDiv_495',this,'DeskMenuDiv423','27',$strmk_id)>服务流程单</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv423_MenuDiv_510',this,'DeskMenuDiv423','28',$strmk_id)>客户证书管理</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv423_MenuDiv_368',this,'DeskMenuDiv423','368',$strmk_id)>E+</A>
<A onClick=GuanXi(this,'DeskMenuDiv423')>+</A>
</div>
";
mysqli_close( $Conn ); //关闭数据库

?>