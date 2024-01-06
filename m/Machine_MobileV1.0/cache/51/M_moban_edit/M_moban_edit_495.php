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
	    $zu_all_list="401=初审,403=复评,402=监审,";
	    $sql = 'select * From `SQP_FuWuLiuChengDan` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv495');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','SQP_FuWuLiuChengDan','DeskMenuDiv495','#addbox');$('#DeskMenuDiv495 #addbox #post_form').attr({'tit':'ZD_GongSiMingChen,RenZhengXinXiLianXiRen,DianHua,ZhiDaoXingShi,JiaoTongJieDai,ZiXunFeiYong','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv495');ListLoadEND_Mobile('DeskMenuDiv495');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"
                            <ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;公司名称:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongSiMingChen' id='ZD_GongSiMingChen' class='addboxinput inputfocus' value='$row[ZD_GongSiMingChen]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_GongSiMingChen_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;认证信息:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='RenZhengXinXi' id='RenZhengXinXi' class='addboxinput inputfocus' value='$row[RenZhengXinXi]'   />
                            <div class='cols03 font_red yanzheng' id='RenZhengXinXi_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'>项目签收:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='21' name='XiangMuQianShou' id='XiangMuQianShou' class='addboxinput inputfocus' placeholder='请签名'  y-value='$row[XiangMuQianShou]'  value='$row[XiangMuQianShou]'  onclick='sign(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='sign(this)'><i class='fa fa-23-3'></i></a>
                            <div class='cols03 font_red yanzheng' id='XiangMuQianShou_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'>审核天数:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenHeTianShu' id='ZD_ShenHeTianShu' class='addboxinput inputfocus' value='$row[ZD_ShenHeTianShu]'   />
                            <div class='cols03 font_red yanzheng' id='ZD_ShenHeTianShu_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'>交期:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='8' name='ZD_JiaoQi' id='ZD_JiaoQi' class='addboxinput inputfocus' value='$row[ZD_JiaoQi]'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_JiaoQi',theme: '#393D49',lang: 'cn'});</script>
                            <div class='cols03 font_red yanzheng' id='ZD_JiaoQi_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'>合作未结算:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='21' name='ZD_HeZuoWeiJieSuan' id='ZD_HeZuoWeiJieSuan' class='addboxinput inputfocus' placeholder='请签名'  y-value='$row[ZD_HeZuoWeiJieSuan]'  value='$row[ZD_HeZuoWeiJieSuan]'  onclick='sign(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='sign(this)'><i class='fa fa-23-3'></i></a>
                            <div class='cols03 font_red yanzheng' id='ZD_HeZuoWeiJieSuan_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"<ul><li class='cols01'>①入厂:</li>
               <li class='cols02 reset_list'><label><input name='ZD_RuChang' type='radio' typeid='18' id='ZD_RuChang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_RuChang' type='radio' typeid='18' id='ZD_RuChang_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_RuChang','18','$row[ZD_RuChang]','DeskMenuDiv495','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_RuChang_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>②申请:</li>
               <li class='cols02 reset_list'><label><input name='ZD_ShenQing' type='radio' typeid='18' id='ZD_ShenQing_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_ShenQing' type='radio' typeid='18' id='ZD_ShenQing_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_ShenQing','18','$row[ZD_ShenQing]','DeskMenuDiv495','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_ShenQing_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>③资料:</li>
               <li class='cols02 reset_list'><label><input name='ZD_ZiLiao' type='radio' typeid='18' id='ZD_ZiLiao_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_ZiLiao' type='radio' typeid='18' id='ZD_ZiLiao_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_ZiLiao','18','$row[ZD_ZiLiao]','DeskMenuDiv495','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_ZiLiao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>④计量检定:</li>
               <li class='cols02 reset_list'><label><input name='ZD_JiLiangJianDing' type='radio' typeid='18' id='ZD_JiLiangJianDing_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_JiLiangJianDing' type='radio' typeid='18' id='ZD_JiLiangJianDing_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_JiLiangJianDing','18','$row[ZD_JiLiangJianDing]','DeskMenuDiv495','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_JiLiangJianDing_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑤特种检定:</li>
               <li class='cols02 reset_list'><label><input name='ZD_TeZhongJianDing' type='radio' typeid='18' id='ZD_TeZhongJianDing_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_TeZhongJianDing' type='radio' typeid='18' id='ZD_TeZhongJianDing_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_TeZhongJianDing','18','$row[ZD_TeZhongJianDing]','DeskMenuDiv495','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_TeZhongJianDing_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑥验收:</li>
               <li class='cols02 reset_list'><label><input name='ZD_YanShou' type='radio' typeid='18' id='ZD_YanShou_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_YanShou' type='radio' typeid='18' id='ZD_YanShou_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_YanShou','18','$row[ZD_YanShou]','DeskMenuDiv495','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_YanShou_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑦审核:</li>
               <li class='cols02 reset_list'><label><input name='ZD_ShenHe' type='radio' typeid='18' id='ZD_ShenHe_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_ShenHe' type='radio' typeid='18' id='ZD_ShenHe_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_ShenHe','18','$row[ZD_ShenHe]','DeskMenuDiv495','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_ShenHe_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑧整改:</li>
               <li class='cols02 reset_list'><label><input name='ZD_ZhengGai' type='radio' typeid='18' id='ZD_ZhengGai_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_ZhengGai' type='radio' typeid='18' id='ZD_ZhengGai_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_ZhengGai','18','$row[ZD_ZhengGai]','DeskMenuDiv495','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_ZhengGai_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑨交接:</li>
               <li class='cols02 reset_list'><label><input name='ZD_JiaoJie' type='radio' typeid='18' id='ZD_JiaoJie_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_JiaoJie' type='radio' typeid='18' id='ZD_JiaoJie_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_JiaoJie','18','$row[ZD_JiaoJie]','DeskMenuDiv495','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_JiaoJie_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>提成结算:</li>
               <li class='cols02 reset_list'><label><input name='ZD_TiChengJieSuan' type='radio' typeid='18' id='ZD_TiChengJieSuan_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_TiChengJieSuan' type='radio' typeid='18' id='ZD_TiChengJieSuan_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_TiChengJieSuan','18','$row[ZD_TiChengJieSuan]','DeskMenuDiv495','');</script>
			   <div class='cols03 font_red yanzheng' id='ZD_TiChengJieSuan_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>人数/产品:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_RenShuChanPin' id='ZD_RenShuChanPin' class='addboxinput inputfocus' value='$row[ZD_RenShuChanPin]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_RenShuChanPin_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;联系人:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='LianXiRen' id='LianXiRen' class='addboxinput inputfocus' value='$row[LianXiRen]'   />
			   <div class='cols03 font_red yanzheng' id='LianXiRen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;电话:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='DianHua' id='DianHua' class='addboxinput inputfocus' value='$row[DianHua]'   />
			   <div class='cols03 font_red yanzheng' id='DianHua_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;指导形式:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZhiDaoXingShi' id='ZhiDaoXingShi' class='addboxinput inputfocus' value='$row[ZhiDaoXingShi]'   />
			   <div class='cols03 font_red yanzheng' id='ZhiDaoXingShi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>审核员:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenHeYuan' id='ZD_ShenHeYuan' class='addboxinput inputfocus' value='$row[ZD_ShenHeYuan]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ShenHeYuan_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>审核时间:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ShenHeShiJian' id='ShenHeShiJian' class='addboxinput inputfocus' value='$row[ShenHeShiJian]'   />
			   <div class='cols03 font_red yanzheng' id='ShenHeShiJian_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;交通接待:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='JiaoTongJieDai' id='JiaoTongJieDai' class='addboxinput inputfocus' value='$row[JiaoTongJieDai]'   />
			   <div class='cols03 font_red yanzheng' id='JiaoTongJieDai_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;咨询费用:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZiXunFeiYong' id='ZiXunFeiYong' class='addboxinput inputfocus' value='$row[ZiXunFeiYong]'   />
			   <div class='cols03 font_red yanzheng' id='ZiXunFeiYong_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>其它要求:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='QiTaYaoQiu' id='QiTaYaoQiu' class='addboxinput inputfocus' value='$row[QiTaYaoQiu]'   />
			   <div class='cols03 font_red yanzheng' id='QiTaYaoQiu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>①资料（负责人）:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZiLiaoFuZeRen' id='ZD_ZiLiaoFuZeRen' class='addboxinput inputfocus' value='$row[ZD_ZiLiaoFuZeRen]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ZiLiaoFuZeRen_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>②资料（主导）:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZiLiaoZhuDao' id='ZD_ZiLiaoZhuDao' class='addboxinput inputfocus' value='$row[ZD_ZiLiaoZhuDao]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_ZiLiaoZhuDao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>③计量器具:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiLiangQiJu' id='ZD_JiLiangQiJu' class='addboxinput inputfocus' value='$row[ZD_JiLiangQiJu]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_JiLiangQiJu_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>④陪审/验厂:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_PeiShenYanChang' id='ZD_PeiShenYanChang' class='addboxinput inputfocus' value='$row[ZD_PeiShenYanChang]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_PeiShenYanChang_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>⑤培训:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_PeiXun' id='ZD_PeiXun' class='addboxinput inputfocus' value='$row[ZD_PeiXun]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_PeiXun_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>合计提成:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HeJiTiCheng' id='ZD_HeJiTiCheng' class='addboxinput inputfocus' value='$row[ZD_HeJiTiCheng]'   />
			   <div class='cols03 font_red yanzheng' id='ZD_HeJiTiCheng_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>洪柳凤:</li>
               <li class='cols02 reset_list'><input type='text' typeid='21' name='ZD_HongLiuFeng' id='ZD_HongLiuFeng' class='addboxinput inputfocus' placeholder='请签名'  y-value='$row[ZD_HongLiuFeng]'  value='$row[ZD_HongLiuFeng]'  onclick='sign(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='sign(this)'><i class='fa fa-23-3'></i></a>
			   <div class='cols03 font_red yanzheng' id='ZD_HongLiuFeng_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>完工单:</li>
               <li class='cols02 reset_list'>
                <input type='text' typeid='6' name='ZD_WanGongDan' id='ZD_WanGongDan_$ToHtmlID' tidno='495_ZD_WanGongDan_$strmk_id' class='addboxinput inputfocus ZD_WanGongDan' value='' style='display:none;width:100%'   />
                <div id='ZD_WanGongDan_$ToHtmlID"."_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'>
                    <div id='ZD_WanGongDan_$ToHtmlID"."_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>
                        +
                    </div>
                </div>
                <script>
                    createupload_jiaohu({'inputid':'ZD_WanGongDan','ToHtmlID':'$ToHtmlID'});
                </script>
            
			   <div class='cols03 font_red yanzheng' id='ZD_WanGongDan_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv495',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GongSiMingChen,RenZhengXinXi,XiangMuQianShou,ZD_ShenHeTianShu,ZD_JiaoQi,ZD_HeZuoWeiJieSuanZD_RuChang,ZD_ShenQing,ZD_ZiLiao,ZD_JiLiangJianDing,ZD_TeZhongJianDing,ZD_YanShou,ZD_ShenHe,ZD_ZhengGai,ZD_JiaoJie,ZD_TiChengJieSuan,ZD_RenShuChanPin,LianXiRen,DianHua,ZhiDaoXingShi,ZD_ShenHeYuan,ShenHeShiJian,JiaoTongJieDai,ZiXunFeiYong,QiTaYaoQiu,ZD_ZiLiaoFuZeRen,ZD_ZiLiaoZhuDao,ZD_JiLiangQiJu,ZD_PeiShenYanChang,ZD_PeiXun,ZD_HeJiTiCheng,ZD_HongLiuFeng,ZD_WanGongDan'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv495','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='ZD_GongSiMingChen,RenZhengXinXiLianXiRen,DianHua,ZhiDaoXingShi,JiaoTongJieDai,ZiXunFeiYong'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv495')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv495','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='ZD_GongSiMingChen,RenZhengXinXiLianXiRen,DianHua,ZhiDaoXingShi,JiaoTongJieDai,ZiXunFeiYong'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='495' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv495')>编辑</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv495_MenuDiv_264',this,'DeskMenuDiv495','32',$strmk_id)>交流记录</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv495_MenuDiv_368',this,'DeskMenuDiv495','368',$strmk_id)>E+</A>
<A onClick=GuanXi(this,'DeskMenuDiv495')>+</A>
</div>
";
mysqli_close( $Conn ); //关闭数据库

?>