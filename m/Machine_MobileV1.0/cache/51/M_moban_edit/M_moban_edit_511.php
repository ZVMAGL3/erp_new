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
	    $zu_all_list="504=一、电线组件,510=七、热熔断器,506=三、家用及类似用途插头插座,512=九、小型熔断器的管状熔断体,505=二、电线电缆产品,523=二十、轮胎产品,524=二十一、安全玻璃,530=二十七、安全技术防范产品,526=二十三、橡胶避孕套产品,532=二十九、装饰装修产品,525=二十二、植物保护机械,528=二十五、医疗器材产品,531=二十八、汽车安全带产品,529=二十六、消防产品,527=二十四、电信终端设备,508=五、工业用插头插座和耦合器,511=八、家用及类似用途固定式电器装置电器附件外壳,509=六、家用及类似用途的器具耦合器,513=十、低压器具,514=十一、小功率电动机,520=十七、照明电器,516=十三、电焊机,522=十九、摩托车及摩托车发动机,515=十二、电动工具,518=十五、音视频设备,521=十八、汽车产品,519=十六、信息技术设备,517=十四、家用和类似用途设备,507=四、家用及类似用途固定式电器装置的开关,";
	    $sql = 'select * From `SQP_CCCFeiYongChaXun` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv511');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_CCCFeiYongChaXun','DeskMenuDiv511','#addbox');$('#DeskMenuDiv511 #addbox #post_form').attr({'tit':'','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv511');ListLoadEND_Mobile('DeskMenuDiv511');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"
                            <ul><li class='cols01'>产品名称:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ChanPinMingChen' id='ZD_ChanPinMingChen' class='addboxinput inputfocus' value='$row[ZD_ChanPinMingChen]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_ChanPinMingChen_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'>对应相关产品名称:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_DuiYingXiangGuanChanPinMingChen' id='ZD_DuiYingXiangGuanChanPinMingChen' class='addboxinput inputfocus' value='$row[ZD_DuiYingXiangGuanChanPinMingChen]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_DuiYingXiangGuanChanPinMingChen_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"<ul><li class='cols01'>分类:</li>
               <li class='cols02 reset_list'>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu1' tit='$row[sys_id_zu]' cnval='一、电线组件' value='$row[sys_id_zu]' valid='504' valstr='' class='addboxinput inputfocus' >一、电线组件&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu2' tit='$row[sys_id_zu]' cnval='七、热熔断器' value='$row[sys_id_zu]' valid='510' valstr='' class='addboxinput inputfocus' >七、热熔断器&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu3' tit='$row[sys_id_zu]' cnval='三、家用及类似用途插头插座' value='$row[sys_id_zu]' valid='506' valstr='' class='addboxinput inputfocus' >三、家用及类似用途插头插座&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu4' tit='$row[sys_id_zu]' cnval='九、小型熔断器的管状熔断体' value='$row[sys_id_zu]' valid='512' valstr='' class='addboxinput inputfocus' >九、小型熔断器的管状熔断体&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu5' tit='$row[sys_id_zu]' cnval='二、电线电缆产品' value='$row[sys_id_zu]' valid='505' valstr='' class='addboxinput inputfocus' >二、电线电缆产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu6' tit='$row[sys_id_zu]' cnval='二十、轮胎产品' value='$row[sys_id_zu]' valid='523' valstr='' class='addboxinput inputfocus' >二十、轮胎产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu7' tit='$row[sys_id_zu]' cnval='二十一、安全玻璃' value='$row[sys_id_zu]' valid='524' valstr='' class='addboxinput inputfocus' >二十一、安全玻璃&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu8' tit='$row[sys_id_zu]' cnval='二十七、安全技术防范产品' value='$row[sys_id_zu]' valid='530' valstr='' class='addboxinput inputfocus' >二十七、安全技术防范产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu9' tit='$row[sys_id_zu]' cnval='二十三、橡胶避孕套产品' value='$row[sys_id_zu]' valid='526' valstr='' class='addboxinput inputfocus' >二十三、橡胶避孕套产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu10' tit='$row[sys_id_zu]' cnval='二十九、装饰装修产品' value='$row[sys_id_zu]' valid='532' valstr='' class='addboxinput inputfocus' >二十九、装饰装修产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu11' tit='$row[sys_id_zu]' cnval='二十二、植物保护机械' value='$row[sys_id_zu]' valid='525' valstr='' class='addboxinput inputfocus' >二十二、植物保护机械&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu12' tit='$row[sys_id_zu]' cnval='二十五、医疗器材产品' value='$row[sys_id_zu]' valid='528' valstr='' class='addboxinput inputfocus' >二十五、医疗器材产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu13' tit='$row[sys_id_zu]' cnval='二十八、汽车安全带产品' value='$row[sys_id_zu]' valid='531' valstr='' class='addboxinput inputfocus' >二十八、汽车安全带产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu14' tit='$row[sys_id_zu]' cnval='二十六、消防产品' value='$row[sys_id_zu]' valid='529' valstr='' class='addboxinput inputfocus' >二十六、消防产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu15' tit='$row[sys_id_zu]' cnval='二十四、电信终端设备' value='$row[sys_id_zu]' valid='527' valstr='' class='addboxinput inputfocus' >二十四、电信终端设备&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu16' tit='$row[sys_id_zu]' cnval='五、工业用插头插座和耦合器' value='$row[sys_id_zu]' valid='508' valstr='' class='addboxinput inputfocus' >五、工业用插头插座和耦合器&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu17' tit='$row[sys_id_zu]' cnval='八、家用及类似用途固定式电器装置电器附件外壳' value='$row[sys_id_zu]' valid='511' valstr='' class='addboxinput inputfocus' >八、家用及类似用途固定式电器装置电器附件外壳&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu18' tit='$row[sys_id_zu]' cnval='六、家用及类似用途的器具耦合器' value='$row[sys_id_zu]' valid='509' valstr='' class='addboxinput inputfocus' >六、家用及类似用途的器具耦合器&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu19' tit='$row[sys_id_zu]' cnval='十、低压器具' value='$row[sys_id_zu]' valid='513' valstr='' class='addboxinput inputfocus' >十、低压器具&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu20' tit='$row[sys_id_zu]' cnval='十一、小功率电动机' value='$row[sys_id_zu]' valid='514' valstr='' class='addboxinput inputfocus' >十一、小功率电动机&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu21' tit='$row[sys_id_zu]' cnval='十七、照明电器' value='$row[sys_id_zu]' valid='520' valstr='' class='addboxinput inputfocus' >十七、照明电器&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu22' tit='$row[sys_id_zu]' cnval='十三、电焊机' value='$row[sys_id_zu]' valid='516' valstr='' class='addboxinput inputfocus' >十三、电焊机&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu23' tit='$row[sys_id_zu]' cnval='十九、摩托车及摩托车发动机' value='$row[sys_id_zu]' valid='522' valstr='' class='addboxinput inputfocus' >十九、摩托车及摩托车发动机&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu24' tit='$row[sys_id_zu]' cnval='十二、电动工具' value='$row[sys_id_zu]' valid='515' valstr='' class='addboxinput inputfocus' >十二、电动工具&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu25' tit='$row[sys_id_zu]' cnval='十五、音视频设备' value='$row[sys_id_zu]' valid='518' valstr='' class='addboxinput inputfocus' >十五、音视频设备&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu26' tit='$row[sys_id_zu]' cnval='十八、汽车产品' value='$row[sys_id_zu]' valid='521' valstr='' class='addboxinput inputfocus' >十八、汽车产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu27' tit='$row[sys_id_zu]' cnval='十六、信息技术设备' value='$row[sys_id_zu]' valid='519' valstr='' class='addboxinput inputfocus' >十六、信息技术设备&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu28' tit='$row[sys_id_zu]' cnval='十四、家用和类似用途设备' value='$row[sys_id_zu]' valid='517' valstr='' class='addboxinput inputfocus' >十四、家用和类似用途设备&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu29' tit='$row[sys_id_zu]' cnval='四、家用及类似用途固定式电器装置的开关' value='$row[sys_id_zu]' valid='507' valstr='' class='addboxinput inputfocus' >四、家用及类似用途固定式电器装置的开关&nbsp;</label><script>Inputdate('sys_id_zu','15','$row[sys_id_zu]','DeskMenuDiv511','');</script>
			   <div class='cols03 font_red yanzheng' id='sys_id_zu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>执行标准:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZhiXingBiaoZhun' id='ZD_ZhiXingBiaoZhun' class='addboxinput inputfocus' value='$row[ZD_ZhiXingBiaoZhun]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ZhiXingBiaoZhun_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>实施细则:</li>
               <li class='cols02 reset_list'>
                <input type='text' typeid='6' name='ZD_ShiShiXiZe' id='ZD_ShiShiXiZe_$ToHtmlID' tidno='511_ZD_ShiShiXiZe_$strmk_id' class='addboxinput inputfocus ZD_ShiShiXiZe' value='' style='display:none;width:100%'   />
                <div id='ZD_ShiShiXiZe_$ToHtmlID"."_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'>
                    <div id='ZD_ShiShiXiZe_$ToHtmlID"."_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>
                        +
                    </div>
                </div>
                <script>
                    createupload_jiaohu({'inputid':'ZD_ShiShiXiZe','ToHtmlID':'$ToHtmlID'});
                </script>
            
			   <div class='cols03 font_red yanzheng' id='ZD_ShiShiXiZe_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>全项检测费:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_QuanXiangJianCeFei' id='ZD_QuanXiangJianCeFei' class='addboxinput inputfocus' value='$row[ZD_QuanXiangJianCeFei]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_QuanXiangJianCeFei_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>咨询费:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZiXunFei' id='ZD_ZiXunFei' class='addboxinput inputfocus' value='$row[ZD_ZiXunFei]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ZiXunFei_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>检测条目:</li>
               <li class='cols02 reset_list'>
                <input type='text' typeid='6' name='ZD_JianCeTiaoMu' id='ZD_JianCeTiaoMu_$ToHtmlID' tidno='511_ZD_JianCeTiaoMu_$strmk_id' class='addboxinput inputfocus ZD_JianCeTiaoMu' value='' style='display:none;width:100%'   />
                <div id='ZD_JianCeTiaoMu_$ToHtmlID"."_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'>
                    <div id='ZD_JianCeTiaoMu_$ToHtmlID"."_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>
                        +
                    </div>
                </div>
                <script>
                    createupload_jiaohu({'inputid':'ZD_JianCeTiaoMu','ToHtmlID':'$ToHtmlID'});
                </script>
            
			   <div class='cols03 font_red yanzheng' id='ZD_JianCeTiaoMu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv511',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_ChanPinMingChen,ZD_DuiYingXiangGuanChanPinMingChensys_id_zu,ZD_ZhiXingBiaoZhun,ZD_ShiShiXiZe,ZD_QuanXiangJianCeFei,ZD_ZiXunFei,ZD_JianCeTiaoMu'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv511','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv511')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv511','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='511' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv511')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv511_MenuDiv_368',this,'DeskMenuDiv511','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Conn ); //关闭数据库

?>