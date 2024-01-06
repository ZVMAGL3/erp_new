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
		
	    $zu_all_list="";
	    $sql = 'select * From `sys_yuangongdanganbiao` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div class='two_menu'>
<ul class='tr trhead' >&nbsp;  <span class='menutishi nocopytext'>Menu</span></ul>
<ul class='tr selectTag' title='第1页' onClick=SelectTag_Menu_Two('.ContentTwo1',this,'DeskMenuDiv204') >01  <span class='menutishi nocopytext'>第1页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='第2页' onClick=SelectTag_Menu_Two('.ContentTwo2',this,'DeskMenuDiv204') >02  <span class='menutishi nocopytext'>第2页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr trboom' onClick=SelectTag_Menu_Two('.ContentTwo',this,'DeskMenuDiv204') >&nbsp;  &nbsp;&nbsp;</ul>
</div>
<div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='ZD_ZhaoPian'>
		                        <li style='text-align:right;width:220px'>照片:</li>
                                
		                        <li style='width:40%' class='reset_list'>
                <input type='text' typeid='6' name='ZD_ZhaoPian' id='ZD_ZhaoPian_$ToHtmlID' tidno='204_ZD_ZhaoPian_$strmk_id' class='addboxinput inputfocus ZD_ZhaoPian' value='' style='display:none;width:100%'   />
                <div id='ZD_ZhaoPian_$ToHtmlID"."_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'>
                    <div id='ZD_ZhaoPian_$ToHtmlID"."_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>
                        +
                    </div>
                </div>
                <script>
                    createupload_jiaohu({'inputid':'ZD_ZhaoPian','ToHtmlID':'$ToHtmlID'});
                </script>
            </li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZhaoPian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='XingBie'>
		                        <li style='text-align:right;width:220px'>性别:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='XingBie' type='radio' typeid='11' id='XingBie_0' value='男' class='addboxinput inputfocus'   checked='checked '    />男&nbsp;&nbsp;&nbsp;</label><label><input name='XingBie' type='radio' typeid='11' id='XingBie_1' class='addboxinput inputfocus' value='女'  checked='checked'    />女</label><script>Inputdate('XingBie','11','$row[XingBie]','DeskMenuDiv204','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='XingBie_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_GongHao'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;工号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_GongHao' id='SYS_GongHao' class='addboxinput inputfocus' value='$row[SYS_GongHao]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_GongHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_QuanXian'>
		                        <li style='text-align:right;width:220px'>职位:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_QuanXian' id='SYS_QuanXian' class='addboxinput inputfocus' value='$row[SYS_QuanXian]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_QuanXian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_ShouJi'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;联系方式:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_ShouJi' id='SYS_ShouJi' class='addboxinput inputfocus' value='$row[SYS_ShouJi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_ShouJi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='GongZi'>
		                        <li style='text-align:right;width:220px'>工资:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='GongZi' id='GongZi' class='addboxinput inputfocus' value='$row[GongZi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='GongZi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongZiFaFangZhangHu'>
		                        <li style='text-align:right;width:220px'>工资发放账户:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongZiFaFangZhangHu' id='ZD_GongZiFaFangZhangHu' class='addboxinput inputfocus' value='$row[ZD_GongZiFaFangZhangHu]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongZiFaFangZhangHu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_ShenFenZheng'>
		                        <li style='text-align:right;width:220px'>身份证:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_ShenFenZheng' id='SYS_ShenFenZheng' class='addboxinput inputfocus' value='$row[SYS_ShenFenZheng]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_ShenFenZheng_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XianZhuDiZhi'>
		                        <li style='text-align:right;width:220px'>现住地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XianZhuDiZhi' id='ZD_XianZhuDiZhi' class='addboxinput inputfocus' value='$row[ZD_XianZhuDiZhi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XianZhuDiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='QQ'>
		                        <li style='text-align:right;width:220px'>QQ:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='QQ' id='QQ' class='addboxinput inputfocus' value='$row[QQ]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='QQ_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_Email'>
		                        <li style='text-align:right;width:220px'>邮箱:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_Email' id='SYS_Email' class='addboxinput inputfocus' value='$row[SYS_Email]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_Email_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_StartDate'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;入职时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='8' name='SYS_StartDate' id='SYS_StartDate' class='addboxinput inputfocus' value='$row[SYS_StartDate]'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#SYS_StartDate',theme: '#393D49',lang: 'cn'});</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_StartDate_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_EndDate'>
		                        <li style='text-align:right;width:220px'>离职时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_EndDate' id='SYS_EndDate' class='addboxinput inputfocus' value='$row[SYS_EndDate]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_EndDate_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='zzzt'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;在职状态:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='zzzt' type='radio' typeid='16' id='zzzt_0' value='在职' class='addboxinput inputfocus'    />在职&nbsp;&nbsp;&nbsp;</label><label><input name='zzzt' type='radio' typeid='16' id='zzzt_1' class='addboxinput inputfocus' value='离职'  checked='checked'    />离职</label><script>Inputdate('zzzt','16','$row[zzzt]','DeskMenuDiv204','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='zzzt_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HunYinZhuangTai'>
		                        <li style='text-align:right;width:220px'>婚姻状态:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_HunYinZhuangTai' type='radio' typeid='26' id='ZD_HunYinZhuangTai_0' value='已婚' class='addboxinput inputfocus'    />已婚&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_HunYinZhuangTai' type='radio' typeid='26' id='ZD_HunYinZhuangTai_1' class='addboxinput inputfocus' value='未婚'  checked='checked'    />未婚</label><script>Inputdate('ZD_HunYinZhuangTai','26','$row[ZD_HunYinZhuangTai]','DeskMenuDiv204','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HunYinZhuangTai_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_204'>
		                        <li style='text-align:right;width:220px'>关系字段:sys_gx_id_204:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_204' id='sys_gx_id_204' class='addboxinput inputfocus' value='$row[sys_gx_id_204]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_204_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZhengJian'>
		                        <li style='text-align:right;width:220px'>证件:</li>
                                
		                        <li style='width:40%' class='reset_list'>
                <input type='text' typeid='6' name='ZD_ZhengJian' id='ZD_ZhengJian_$ToHtmlID' tidno='204_ZD_ZhengJian_$strmk_id' class='addboxinput inputfocus ZD_ZhengJian' value='' style='display:none;width:100%'   />
                <div id='ZD_ZhengJian_$ToHtmlID"."_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'>
                    <div id='ZD_ZhengJian_$ToHtmlID"."_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>
                        +
                    </div>
                </div>
                <script>
                    createupload_jiaohu({'inputid':'ZD_ZhengJian','ToHtmlID':'$ToHtmlID'});
                </script>
            </li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZhengJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<span class='ContentTwo ContentTwo2' style='display:none'>";
echo"
	                         <ul zd='SYS_UserName'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;姓名:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_UserName' id='SYS_UserName' class='addboxinput inputfocus' value='$row[SYS_UserName]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_UserName_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SYS_UserName,ZD_ZhaoPian,XingBie,SYS_GongHao,SYS_QuanXian,SYS_ShouJi,GongZi,ZD_GongZiFaFangZhangHu,SYS_ShenFenZheng,ZD_XianZhuDiZhi,QQ,SYS_Email,SYS_StartDate,SYS_EndDate,zzzt,ZD_HunYinZhuangTai,sys_gx_id_204,ZD_ZhengJian'/>";
if ( strpos($const_q_xiug, "204") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry='SYS_UserName,SYS_GongHao,SYS_ShouJi,SYS_StartDate,zzzt'  Wuchongfu_Arry='SYS_GongHao,SYS_ShouJi'  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry='SYS_UserName,SYS_GongHao,SYS_ShouJi,SYS_StartDate,zzzt'  Wuchongfu_Arry='SYS_GongHao,SYS_ShouJi'  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='204' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','SYS_GongHao,SYS_ShouJi','sys_yuangongdanganbiao','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','id');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv204_MenuDiv_264',this,'$ToHtmlID','42',$strmk_id)>交流记录</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv204_MenuDiv_324',this,'$ToHtmlID','41',$strmk_id)>检测和测量资源内校记录</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv204_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>

<script>form_weikong('#post_form','$ToHtmlID');</script>

";
mysqli_close( $Conn ); //关闭数据库

?>