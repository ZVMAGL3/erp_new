<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
        include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	
	    global $strmk_id,$Conn,$const_q_xiug,$const_q_shenghe,$const_q_pizhun,$ToHtmlID;
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
		if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};//是否为回收站0为不回收
	    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};//是否为回收站0为不回收
		
	    $zu_all_list="487=撤消,486=暂停,492=有效,";
	    $sql = 'select * From `SQP_KeHuZhengShuGuanLi` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='ZD_ZhengShuHao'>
		                        <li style='text-align:right;width:220px'>证书号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZhengShuHao' id='ZD_ZhengShuHao' class='addboxinput inputfocus' value='$row[ZD_ZhengShuHao]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZhengShuHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZhengShuTuPian'>
		                        <li style='text-align:right;width:220px'>证书图片:</li>
                                
		                        <li style='width:40%' class='reset_list'>
                <input type='text' typeid='6' name='ZD_ZhengShuTuPian' id='ZD_ZhengShuTuPian_$ToHtmlID' tidno='510_ZD_ZhengShuTuPian_$strmk_id' class='addboxinput inputfocus ZD_ZhengShuTuPian' value='' style='display:none;width:100%'   />
                <div id='ZD_ZhengShuTuPian_$ToHtmlID"."_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'>
                    <div id='ZD_ZhengShuTuPian_$ToHtmlID"."_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>
                        +
                    </div>
                </div>
                <script>
                    createupload_jiaohu({'inputid':'ZD_ZhengShuTuPian','ToHtmlID':'$ToHtmlID'});
                </script>
            </li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZhengShuTuPian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_321'>
		                        <li style='text-align:right;width:220px'>[关系]顾客档案表ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_321' id='sys_gx_id_321' class='addboxinput inputfocus' value='$row[sys_gx_id_321]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_321_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_321','34','SQP_KeHuZhengShuGuanLi','DeskMenuDiv510');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_KeHuMingChen'>
		                        <li style='text-align:right;width:220px'>客户名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_KeHuMingChen' id='ZD_KeHuMingChen' class='addboxinput inputfocus' value='$row[ZD_KeHuMingChen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_KeHuMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XiangMu'>
		                        <li style='text-align:right;width:220px'>项目:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XiangMu' id='ZD_XiangMu' class='addboxinput inputfocus' value='$row[ZD_XiangMu]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XiangMu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GenJinYueFen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;跟进月份:</li>
                                
		                        <li style='width:40%' class='reset_list'>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_0' tit='$row[ZD_GenJinYueFen]' cnval='1月' value='$row[ZD_GenJinYueFen]' valid='1月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >1月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_1' tit='$row[ZD_GenJinYueFen]' cnval='2月' value='$row[ZD_GenJinYueFen]' valid='2月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >2月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_2' tit='$row[ZD_GenJinYueFen]' cnval='3月' value='$row[ZD_GenJinYueFen]' valid='3月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >3月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_3' tit='$row[ZD_GenJinYueFen]' cnval='4月' value='$row[ZD_GenJinYueFen]' valid='4月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >4月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_4' tit='$row[ZD_GenJinYueFen]' cnval='5月' value='$row[ZD_GenJinYueFen]' valid='5月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >5月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_5' tit='$row[ZD_GenJinYueFen]' cnval='6月' value='$row[ZD_GenJinYueFen]' valid='6月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >6月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_6' tit='$row[ZD_GenJinYueFen]' cnval='7月' value='$row[ZD_GenJinYueFen]' valid='7月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >7月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_7' tit='$row[ZD_GenJinYueFen]' cnval='8月' value='$row[ZD_GenJinYueFen]' valid='8月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >8月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_8' tit='$row[ZD_GenJinYueFen]' cnval='9月' value='$row[ZD_GenJinYueFen]' valid='9月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >9月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_9' tit='$row[ZD_GenJinYueFen]' cnval='10月' value='$row[ZD_GenJinYueFen]' valid='10月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >10月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_10' tit='$row[ZD_GenJinYueFen]' cnval='11月' value='$row[ZD_GenJinYueFen]' valid='11月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >11月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_11' tit='$row[ZD_GenJinYueFen]' cnval='12月' value='$row[ZD_GenJinYueFen]' valid='12月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >12月&nbsp;</label>
            
            <script>Inputdate('ZD_GenJinYueFen','15','$row[ZD_GenJinYueFen]','DeskMenuDiv510','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GenJinYueFen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_RenZhengJiGou'>
		                        <li style='text-align:right;width:220px'>认证机构:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_RenZhengJiGou' id='ZD_RenZhengJiGou' class='addboxinput inputfocus' value='$row[ZD_RenZhengJiGou]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_RenZhengJiGou_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ChuShenShiJian'>
		                        <li style='text-align:right;width:220px'>初审时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ChuShenShiJian' id='ZD_ChuShenShiJian' class='addboxinput inputfocus' value='$row[ZD_ChuShenShiJian]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ChuShenShiJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JianShiJian'>
		                        <li style='text-align:right;width:220px'>监①时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JianShiJian' id='ZD_JianShiJian' class='addboxinput inputfocus' value='$row[ZD_JianShiJian]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JianShiJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JianShiJian1629904411348'>
		                        <li style='text-align:right;width:220px'>监②时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JianShiJian1629904411348' id='ZD_JianShiJian1629904411348' class='addboxinput inputfocus' value='$row[ZD_JianShiJian1629904411348]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JianShiJian1629904411348_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HuanZhengShiJian'>
		                        <li style='text-align:right;width:220px'>换证时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_HuanZhengShiJian' id='ZD_HuanZhengShiJian' class='addboxinput inputfocus' value='$row[ZD_HuanZhengShiJian]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HuanZhengShiJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_RenZhengFanWei'>
		                        <li style='text-align:right;width:220px'>认证范围:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_RenZhengFanWei' id='ZD_RenZhengFanWei' class='addboxinput inputfocus' value='$row[ZD_RenZhengFanWei]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_RenZhengFanWei_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_LianXiRen'>
		                        <li style='text-align:right;width:220px'>联系人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_LianXiRen' id='ZD_LianXiRen' class='addboxinput inputfocus' value='$row[ZD_LianXiRen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_LianXiRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_DianHua'>
		                        <li style='text-align:right;width:220px'>电话:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_DianHua' id='ZD_DianHua' class='addboxinput inputfocus' value='$row[ZD_DianHua]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_DianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongSiDiZhi'>
		                        <li style='text-align:right;width:220px'>公司地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSiDiZhi' id='ZD_GongSiDiZhi' class='addboxinput inputfocus' value='$row[ZD_GongSiDiZhi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSiDiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XiangMuFuZeRen'>
		                        <li style='text-align:right;width:220px'>项目负责人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XiangMuFuZeRen' id='ZD_XiangMuFuZeRen' class='addboxinput inputfocus' value='$row[ZD_XiangMuFuZeRen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XiangMuFuZeRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_RenZhengFei'>
		                        <li style='text-align:right;width:220px'>认证费:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_RenZhengFei' id='ZD_RenZhengFei' class='addboxinput inputfocus' value='$row[ZD_RenZhengFei]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_RenZhengFei_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_423'>
		                        <li style='text-align:right;width:220px'>[关系]顾客合同ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_423' id='sys_gx_id_423' class='addboxinput inputfocus' value='$row[sys_gx_id_423]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_423_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_423','28','SQP_KeHuZhengShuGuanLi','DeskMenuDiv510');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_id_zu'>
		                        <li style='text-align:right;width:220px'>分类:</li>
                                
		                        <li style='width:40%' class='reset_list'>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu1' tit='$row[sys_id_zu]' cnval='撤消' value='$row[sys_id_zu]' valid='487' valstr='' class='addboxinput inputfocus' >撤消&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu2' tit='$row[sys_id_zu]' cnval='暂停' value='$row[sys_id_zu]' valid='486' valstr='' class='addboxinput inputfocus' >暂停&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu3' tit='$row[sys_id_zu]' cnval='有效' value='$row[sys_id_zu]' valid='492' valstr='' class='addboxinput inputfocus' >有效&nbsp;</label><script>Inputdate('sys_id_zu','15','$row[sys_id_zu]','DeskMenuDiv510','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_id_zu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_ZhengShuHao,ZD_ZhengShuTuPian,sys_gx_id_321,ZD_KeHuMingChen,ZD_XiangMu,ZD_ChuShenShiJian,ZD_JianShiJian,ZD_JianShiJian1629904411348,ZD_HuanZhengShiJian,ZD_RenZhengFanWei,ZD_LianXiRen,ZD_DianHua,ZD_GongSiDiZhi,ZD_XiangMuFuZeRen,ZD_RenZhengFei,sys_gx_id_423,ZD_GenJinYueFen,sys_id_zu,ZD_RenZhengJiGou'/>";
if ( strpos($const_q_xiug, "510") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='ZD_ZhengShuHao' bitian_Arry='ZD_GenJinYueFen'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='ZD_ZhengShuHao' bitian_Arry='ZD_GenJinYueFen'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='510' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_KeHuZhengShuGuanLi','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','ZD_ZhengShuHao');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv510_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
mysqli_close( $Conn ); //关闭数据库

?>