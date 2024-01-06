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
		
	    $zu_all_list="401=初审,403=复评,402=监审,";
	    $sql = 'select * From `SQP_FuWuLiuChengDan` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div class='two_menu'>
<ul class='tr trhead' >&nbsp;  <span class='menutishi nocopytext'>Menu</span></ul>
<ul class='tr selectTag' title='流程单' onClick=SelectTag_Menu_Two('.ContentTwo1',this,'DeskMenuDiv495') >01  <span class='menutishi nocopytext'>流程单</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='进度' onClick=SelectTag_Menu_Two('.ContentTwo2',this,'DeskMenuDiv495') >02  <span class='menutishi nocopytext'>进度</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='结算' onClick=SelectTag_Menu_Two('.ContentTwo3',this,'DeskMenuDiv495') >03  <span class='menutishi nocopytext'>结算</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='yb' onClick=SelectTag_Menu_Two('.ContentTwo4',this,'DeskMenuDiv495') >04  <span class='menutishi nocopytext'>yb</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr trboom' onClick=SelectTag_Menu_Two('.ContentTwo',this,'DeskMenuDiv495') >&nbsp;  &nbsp;&nbsp;</ul>
</div>
<div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='sys_gx_id_321'>
		                        <li style='text-align:right;width:220px'>[关系]顾客档案表ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_321' id='sys_gx_id_321' class='addboxinput inputfocus' value='$row[sys_gx_id_321]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_321_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_321','36','SQP_FuWuLiuChengDan','DeskMenuDiv495');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongSiMingChen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;公司名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSiMingChen' id='ZD_GongSiMingChen' class='addboxinput inputfocus' value='$row[ZD_GongSiMingChen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSiMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_423'>
		                        <li style='text-align:right;width:220px'>[关系]顾客合同ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_423' id='sys_gx_id_423' class='addboxinput inputfocus' value='$row[sys_gx_id_423]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_423_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_423','27','SQP_FuWuLiuChengDan','DeskMenuDiv495');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='RenZhengXinXi'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;认证信息:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='RenZhengXinXi' id='RenZhengXinXi' class='addboxinput inputfocus' value='$row[RenZhengXinXi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='RenZhengXinXi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenHeTianShu'>
		                        <li style='text-align:right;width:220px'>审核天数:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenHeTianShu' id='ZD_ShenHeTianShu' class='addboxinput inputfocus' value='$row[ZD_ShenHeTianShu]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenHeTianShu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiaoQi'>
		                        <li style='text-align:right;width:220px'>交期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='8' name='ZD_JiaoQi' id='ZD_JiaoQi' class='addboxinput inputfocus' value='$row[ZD_JiaoQi]'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_JiaoQi',theme: '#393D49',lang: 'cn'});</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiaoQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_RenShuChanPin'>
		                        <li style='text-align:right;width:220px'>人数/产品:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_RenShuChanPin' id='ZD_RenShuChanPin' class='addboxinput inputfocus' value='$row[ZD_RenShuChanPin]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_RenShuChanPin_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='LianXiRen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;联系人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='LianXiRen' id='LianXiRen' class='addboxinput inputfocus' value='$row[LianXiRen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='LianXiRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='DianHua'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;电话:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='DianHua' id='DianHua' class='addboxinput inputfocus' value='$row[DianHua]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='DianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZhiDaoXingShi'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;指导形式:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZhiDaoXingShi' id='ZhiDaoXingShi' class='addboxinput inputfocus' value='$row[ZhiDaoXingShi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZhiDaoXingShi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenHeYuan'>
		                        <li style='text-align:right;width:220px'>审核员:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenHeYuan' id='ZD_ShenHeYuan' class='addboxinput inputfocus' value='$row[ZD_ShenHeYuan]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenHeYuan_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ShenHeShiJian'>
		                        <li style='text-align:right;width:220px'>审核时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ShenHeShiJian' id='ShenHeShiJian' class='addboxinput inputfocus' value='$row[ShenHeShiJian]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ShenHeShiJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='JiaoTongJieDai'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;交通接待:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='JiaoTongJieDai' id='JiaoTongJieDai' class='addboxinput inputfocus' value='$row[JiaoTongJieDai]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='JiaoTongJieDai_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZiXunFeiYong'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;咨询费用:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZiXunFeiYong' id='ZiXunFeiYong' class='addboxinput inputfocus' value='$row[ZiXunFeiYong]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZiXunFeiYong_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='QiTaYaoQiu'>
		                        <li style='text-align:right;width:220px'>其它要求:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='QiTaYaoQiu' id='QiTaYaoQiu' class='addboxinput inputfocus' value='$row[QiTaYaoQiu]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='QiTaYaoQiu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_510'>
		                        <li style='text-align:right;width:220px'>[关系]客户证书管理ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_510' id='sys_gx_id_510' class='addboxinput inputfocus' value='$row[sys_gx_id_510]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_510_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_WanGongDan'>
		                        <li style='text-align:right;width:220px'>完工单:</li>
                                
		                        <li style='width:40%' class='reset_list'>
                <input type='text' typeid='6' name='ZD_WanGongDan' id='ZD_WanGongDan_$ToHtmlID' tidno='495_ZD_WanGongDan_$strmk_id' class='addboxinput inputfocus ZD_WanGongDan' value='' style='display:none;width:100%'   />
                <div id='ZD_WanGongDan_$ToHtmlID"."_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'>
                    <div id='ZD_WanGongDan_$ToHtmlID"."_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>
                        +
                    </div>
                </div>
                <script>
                    createupload_jiaohu({'inputid':'ZD_WanGongDan','ToHtmlID':'$ToHtmlID'});
                </script>
            </li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_WanGongDan_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_529'>
		                        <li style='text-align:right;width:220px'>[关系]用户和公司关系ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_529' id='sys_gx_id_529' class='addboxinput inputfocus' value='$row[sys_gx_id_529]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_529_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<span class='ContentTwo ContentTwo2' style='display:none'>";
echo"
	                         <ul zd='XiangMuQianShou'>
		                        <li style='text-align:right;width:220px'>项目签收:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='21' name='XiangMuQianShou' id='XiangMuQianShou' class='addboxinput inputfocus' placeholder='请签名'  y-value='$row[XiangMuQianShou]'  value='$row[XiangMuQianShou]'  onclick='sign(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='sign(this)'><i class='fa fa-23-3'></i></a></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='XiangMuQianShou_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_RuChang'>
		                        <li style='text-align:right;width:220px'>①入厂:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_RuChang' type='radio' typeid='18' id='ZD_RuChang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_RuChang' type='radio' typeid='18' id='ZD_RuChang_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_RuChang','18','$row[ZD_RuChang]','DeskMenuDiv495','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_RuChang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenQing'>
		                        <li style='text-align:right;width:220px'>②申请:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_ShenQing' type='radio' typeid='18' id='ZD_ShenQing_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_ShenQing' type='radio' typeid='18' id='ZD_ShenQing_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_ShenQing','18','$row[ZD_ShenQing]','DeskMenuDiv495','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenQing_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZiLiao'>
		                        <li style='text-align:right;width:220px'>③资料:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_ZiLiao' type='radio' typeid='18' id='ZD_ZiLiao_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_ZiLiao' type='radio' typeid='18' id='ZD_ZiLiao_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_ZiLiao','18','$row[ZD_ZiLiao]','DeskMenuDiv495','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZiLiao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiLiangJianDing'>
		                        <li style='text-align:right;width:220px'>④计量检定:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_JiLiangJianDing' type='radio' typeid='18' id='ZD_JiLiangJianDing_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_JiLiangJianDing' type='radio' typeid='18' id='ZD_JiLiangJianDing_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_JiLiangJianDing','18','$row[ZD_JiLiangJianDing]','DeskMenuDiv495','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiLiangJianDing_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_TeZhongJianDing'>
		                        <li style='text-align:right;width:220px'>⑤特种检定:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_TeZhongJianDing' type='radio' typeid='18' id='ZD_TeZhongJianDing_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_TeZhongJianDing' type='radio' typeid='18' id='ZD_TeZhongJianDing_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_TeZhongJianDing','18','$row[ZD_TeZhongJianDing]','DeskMenuDiv495','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_TeZhongJianDing_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_YanShou'>
		                        <li style='text-align:right;width:220px'>⑥验收:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_YanShou' type='radio' typeid='18' id='ZD_YanShou_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_YanShou' type='radio' typeid='18' id='ZD_YanShou_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_YanShou','18','$row[ZD_YanShou]','DeskMenuDiv495','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_YanShou_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenHe'>
		                        <li style='text-align:right;width:220px'>⑦审核:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_ShenHe' type='radio' typeid='18' id='ZD_ShenHe_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_ShenHe' type='radio' typeid='18' id='ZD_ShenHe_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_ShenHe','18','$row[ZD_ShenHe]','DeskMenuDiv495','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenHe_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZhengGai'>
		                        <li style='text-align:right;width:220px'>⑧整改:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_ZhengGai' type='radio' typeid='18' id='ZD_ZhengGai_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_ZhengGai' type='radio' typeid='18' id='ZD_ZhengGai_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_ZhengGai','18','$row[ZD_ZhengGai]','DeskMenuDiv495','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZhengGai_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiaoJie'>
		                        <li style='text-align:right;width:220px'>⑨交接:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_JiaoJie' type='radio' typeid='18' id='ZD_JiaoJie_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_JiaoJie' type='radio' typeid='18' id='ZD_JiaoJie_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_JiaoJie','18','$row[ZD_JiaoJie]','DeskMenuDiv495','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiaoJie_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<span class='ContentTwo ContentTwo3' style='display:none'>";
echo"
	                         <ul zd='ZD_TiChengJieSuan'>
		                        <li style='text-align:right;width:220px'>提成结算:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_TiChengJieSuan' type='radio' typeid='18' id='ZD_TiChengJieSuan_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_TiChengJieSuan' type='radio' typeid='18' id='ZD_TiChengJieSuan_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_TiChengJieSuan','18','$row[ZD_TiChengJieSuan]','DeskMenuDiv495','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_TiChengJieSuan_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZiLiaoFuZeRen'>
		                        <li style='text-align:right;width:220px'>①资料（负责人）:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZiLiaoFuZeRen' id='ZD_ZiLiaoFuZeRen' class='addboxinput inputfocus' value='$row[ZD_ZiLiaoFuZeRen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZiLiaoFuZeRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZiLiaoZhuDao'>
		                        <li style='text-align:right;width:220px'>②资料（主导）:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZiLiaoZhuDao' id='ZD_ZiLiaoZhuDao' class='addboxinput inputfocus' value='$row[ZD_ZiLiaoZhuDao]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZiLiaoZhuDao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiLiangQiJu'>
		                        <li style='text-align:right;width:220px'>③计量器具:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiLiangQiJu' id='ZD_JiLiangQiJu' class='addboxinput inputfocus' value='$row[ZD_JiLiangQiJu]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiLiangQiJu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_PeiShenYanChang'>
		                        <li style='text-align:right;width:220px'>④陪审/验厂:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_PeiShenYanChang' id='ZD_PeiShenYanChang' class='addboxinput inputfocus' value='$row[ZD_PeiShenYanChang]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_PeiShenYanChang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_PeiXun'>
		                        <li style='text-align:right;width:220px'>⑤培训:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_PeiXun' id='ZD_PeiXun' class='addboxinput inputfocus' value='$row[ZD_PeiXun]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_PeiXun_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HeJiTiCheng'>
		                        <li style='text-align:right;width:220px'>合计提成:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_HeJiTiCheng' id='ZD_HeJiTiCheng' class='addboxinput inputfocus' value='$row[ZD_HeJiTiCheng]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HeJiTiCheng_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HongLiuFeng'>
		                        <li style='text-align:right;width:220px'>洪柳凤:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='21' name='ZD_HongLiuFeng' id='ZD_HongLiuFeng' class='addboxinput inputfocus' placeholder='请签名'  y-value='$row[ZD_HongLiuFeng]'  value='$row[ZD_HongLiuFeng]'  onclick='sign(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='sign(this)'><i class='fa fa-23-3'></i></a></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HongLiuFeng_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<span class='ContentTwo ContentTwo4' style='display:none'>";
echo"
	                         <ul zd='ZD_HeZuoWeiJieSuan'>
		                        <li style='text-align:right;width:220px'>合作未结算:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='21' name='ZD_HeZuoWeiJieSuan' id='ZD_HeZuoWeiJieSuan' class='addboxinput inputfocus' placeholder='请签名'  y-value='$row[ZD_HeZuoWeiJieSuan]'  value='$row[ZD_HeZuoWeiJieSuan]'  onclick='sign(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='sign(this)'><i class='fa fa-23-3'></i></a></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HeZuoWeiJieSuan_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='sys_gx_id_321,ZD_GongSiMingChen,sys_gx_id_423,RenZhengXinXi,XiangMuQianShou,ZD_RuChang,ZD_ShenQing,ZD_ZiLiao,ZD_JiLiangJianDing,ZD_TeZhongJianDing,ZD_YanShou,ZD_ShenHe,ZD_ZhengGai,ZD_JiaoJie,ZD_TiChengJieSuan,ZD_RenShuChanPin,LianXiRen,DianHua,ZhiDaoXingShi,ZD_ShenHeYuan,ShenHeShiJian,JiaoTongJieDai,ZiXunFeiYong,QiTaYaoQiu,ZD_ZiLiaoFuZeRen,ZD_ZiLiaoZhuDao,ZD_JiLiangQiJu,ZD_PeiShenYanChang,ZD_PeiXun,ZD_HeJiTiCheng,ZD_ShenHeTianShu,ZD_JiaoQi,sys_gx_id_510,ZD_HongLiuFeng,ZD_WanGongDan,ZD_HeZuoWeiJieSuan,sys_gx_id_529'/>";
if ( strpos($const_q_xiug, "495") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='ZD_GongSiMingChen,RenZhengXinXi,LianXiRen,DianHua,ZhiDaoXingShi,JiaoTongJieDai,ZiXunFeiYong'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='ZD_GongSiMingChen,RenZhengXinXi,LianXiRen,DianHua,ZhiDaoXingShi,JiaoTongJieDai,ZiXunFeiYong'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='495' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_FuWuLiuChengDan','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','sys_nowbh');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv495_MenuDiv_264',this,'$ToHtmlID','32',$strmk_id)>交流记录</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv495_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>

<script>form_weikong('#post_form','$ToHtmlID');</script>

";
mysqli_close( $Conn ); //关闭数据库

?>