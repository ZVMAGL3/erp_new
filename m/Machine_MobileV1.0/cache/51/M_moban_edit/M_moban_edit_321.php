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
	    $zu_all_list="291=失效,116=意向,290=汇淡中,369=潜在,121=老客户,368=跟进中,";
	    $sql = 'select * From `sys_gukedanganbiao` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv321');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'ZD_GongSiMingChen','sys_gukedanganbiao','DeskMenuDiv321','#addbox');$('#DeskMenuDiv321 #addbox #post_form').attr({'tit':'ZD_GongSiMingChen,ZD_FuZeRenDianHua','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv321');ListLoadEND_Mobile('DeskMenuDiv321');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"
                            <ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;公司名称:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiMingChen' id='ZD_GongSiMingChen' class='addboxinput inputfocus' value='$row[ZD_GongSiMingChen]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_GongSiMingChen_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;负责人:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_FuZeRen' id='ZD_FuZeRen' class='addboxinput inputfocus' value='$row[ZD_FuZeRen]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_FuZeRen_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'>意向服务:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_YiXiangFuWu' id='ZD_YiXiangFuWu' class='addboxinput inputfocus' value='$row[ZD_YiXiangFuWu]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_YiXiangFuWu_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'>项目经理:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='XiangMuJingLi' id='XiangMuJingLi' class='addboxinput inputfocus' value='$row[XiangMuJingLi]'   />
                            <div class='cols03 font_red yanzheng' id='XiangMuJingLi_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'>成交项目:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ChengJiaoXiangMu' id='ZD_ChengJiaoXiangMu' class='addboxinput inputfocus' value='$row[ZD_ChengJiaoXiangMu]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_ChengJiaoXiangMu_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'>等级:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DengJi' id='ZD_DengJi' class='addboxinput inputfocus' value='$row[ZD_DengJi]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_DengJi_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'>报价附件:</li>
                            <li class='cols02 reset_list'>
                <input type='text' typeid='6' name='ZD_BaoJiaFuJian' id='ZD_BaoJiaFuJian_$ToHtmlID' tidno='321_ZD_BaoJiaFuJian_$strmk_id' class='addboxinput inputfocus ZD_BaoJiaFuJian' value='' style='display:none;width:100%'   />
                <div id='ZD_BaoJiaFuJian_$ToHtmlID"."_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'>
                    <div id='ZD_BaoJiaFuJian_$ToHtmlID"."_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>
                        +
                    </div>
                </div>
                <script>
                    createupload_jiaohu({'inputid':'ZD_BaoJiaFuJian','ToHtmlID':'$ToHtmlID'});
                </script>
            
                            <div class='cols03 font_red yanzheng' id='ZD_BaoJiaFuJian_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'>微信:</li>
                            <li class='cols02 reset_list'><label><input name='ZD_WeiXin' type='radio' typeid='18' id='ZD_WeiXin_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_WeiXin' type='radio' typeid='18' id='ZD_WeiXin_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_WeiXin','18','$row[ZD_WeiXin]','DeskMenuDiv321','');</script>
                            <div class='cols03 font_red yanzheng' id='ZD_WeiXin_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"<ul><li class='cols01'>备注【企业工商信用等】:</li>
               <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_BeiZhuQiYeGongShangXinYongDeng' id='ZD_BeiZhuQiYeGongShangXinYongDeng' class='addboxinput inputfocus' 50px;'   >$row[ZD_BeiZhuQiYeGongShangXinYongDeng]</textarea>
			   <div class='cols03 font_red yanzheng' id='ZD_BeiZhuQiYeGongShangXinYongDeng_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>性别:</li>
               <li class='cols02 reset_list'><label><input name='XingBie' type='radio' typeid='3' id='XingBie_0' value='先生'  class='addboxinput inputfocus'    />先生&nbsp;&nbsp;&nbsp;</label><label><input name='XingBie' type='radio' id='XingBie_1' class='addboxinput inputfocus' value='女士'  checked='checked'     />女士</label><script>Inputdate('XingBie','3','$row[XingBie]','DeskMenuDiv321','');</script>
			   <div class='cols03 font_red yanzheng' id='XingBie_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;电话:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='DianHua' id='DianHua' class='addboxinput inputfocus' value='$row[DianHua]'   />
			   <div class='cols03 font_red yanzheng' id='DianHua_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>生产产品:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ShengChanChanPin' id='ShengChanChanPin' class='addboxinput inputfocus' value='$row[ShengChanChanPin]'   />
			   <div class='cols03 font_red yanzheng' id='ShengChanChanPin_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>地址:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='DiZhi' id='DiZhi' class='addboxinput inputfocus' value='$row[DiZhi]'   />
			   <div class='cols03 font_red yanzheng' id='DiZhi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>分类:</li>
               <li class='cols02 reset_list'>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu1' tit='$row[sys_id_zu]' cnval='失效' value='$row[sys_id_zu]' valid='291' valstr='' class='addboxinput inputfocus' >失效&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu2' tit='$row[sys_id_zu]' cnval='意向' value='$row[sys_id_zu]' valid='116' valstr='' class='addboxinput inputfocus' >意向&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu3' tit='$row[sys_id_zu]' cnval='汇淡中' value='$row[sys_id_zu]' valid='290' valstr='' class='addboxinput inputfocus' >汇淡中&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu4' tit='$row[sys_id_zu]' cnval='潜在' value='$row[sys_id_zu]' valid='369' valstr='' class='addboxinput inputfocus' >潜在&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu5' tit='$row[sys_id_zu]' cnval='老客户' value='$row[sys_id_zu]' valid='121' valstr='' class='addboxinput inputfocus' >老客户&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu6' tit='$row[sys_id_zu]' cnval='跟进中' value='$row[sys_id_zu]' valid='368' valstr='' class='addboxinput inputfocus' >跟进中&nbsp;</label><script>Inputdate('sys_id_zu','15','$row[sys_id_zu]','DeskMenuDiv321','');</script>
			   <div class='cols03 font_red yanzheng' id='sys_id_zu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>经办人:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='sys_chaosong' id='sys_chaosong' class='addboxinput inputfocus' value='$row[sys_chaosong]'   />
			   <div class='cols03 font_red yanzheng' id='sys_chaosong_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv321',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GongSiMingChen,ZD_FuZeRen,ZD_YiXiangFuWu,XiangMuJingLi,ZD_ChengJiaoXiangMu,ZD_DengJi,ZD_BaoJiaFuJian,ZD_WeiXinZD_BeiZhuQiYeGongShangXinYongDeng,XingBie,DianHua,ShengChanChanPin,DiZhi,sys_id_zu,sys_chaosong'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv321','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='ZD_GongSiMingChen,ZD_FuZeRenDianHua'  Wuchongfu_Arry='ZD_GongSiMingChen'  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv321')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv321','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='ZD_GongSiMingChen,ZD_FuZeRenDianHua'  Wuchongfu_Arry='ZD_GongSiMingChen'  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='321' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv321')>编辑</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv321_MenuDiv_308',this,'DeskMenuDiv321','21',$strmk_id)>顾客财产清单</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv321_MenuDiv_423',this,'DeskMenuDiv321','26',$strmk_id)>顾客合同</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv321_MenuDiv_264',this,'DeskMenuDiv321','30',$strmk_id)>交流记录</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv321_MenuDiv_510',this,'DeskMenuDiv321','34',$strmk_id)>客户证书管理</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv321_MenuDiv_495',this,'DeskMenuDiv321','36',$strmk_id)>服务流程单</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv321_MenuDiv_368',this,'DeskMenuDiv321','368',$strmk_id)>E+</A>
<A onClick=GuanXi(this,'DeskMenuDiv321')>+</A>
</div>
";
mysqli_close( $Conn ); //关闭数据库

?>