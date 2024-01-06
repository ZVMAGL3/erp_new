<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
        include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Connadmin.php";
	
	    global $strmk_id,$Connadmin,$const_q_xiug,$const_q_shenghe,$const_q_pizhun,$ToHtmlID;
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
		if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};//是否为回收站0为不回收
	    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};//是否为回收站0为不回收
		
	    $zu_all_list="";
	    $sql = 'select * From `msc_user_reg` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Connadmin , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='SYS_GongHao'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;工号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_GongHao' id='SYS_GongHao' class='addboxinput inputfocus' value='$row[SYS_GongHao]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_GongHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_UserName'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;用户名:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_UserName' id='SYS_UserName' class='addboxinput inputfocus' value='$row[SYS_UserName]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_UserName_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_ShouJi'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;手机:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_ShouJi' id='SYS_ShouJi' class='addboxinput inputfocus' value='$row[SYS_ShouJi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_ShouJi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_ZD_ZaiZhiZhuangTai'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;在职状态:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_ZD_ZaiZhiZhuangTai' id='SYS_ZD_ZaiZhiZhuangTai' class='addboxinput inputfocus' value='$row[SYS_ZD_ZaiZhiZhuangTai]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_ZD_ZaiZhiZhuangTai_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_reg_num'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;公司注册号id:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_reg_num' id='SYS_reg_num' class='addboxinput inputfocus' value='$row[SYS_reg_num]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_reg_num_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_yuangongdanganbiao_id'>
		                        <li style='text-align:right;width:220px'>对应的会员id:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_yuangongdanganbiao_id' id='SYS_yuangongdanganbiao_id' class='addboxinput inputfocus' value='$row[SYS_yuangongdanganbiao_id]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_yuangongdanganbiao_id_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_PassWord'>
		                        <li style='text-align:right;width:220px'>密码:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_PassWord' id='SYS_PassWord' class='addboxinput inputfocus' value='$row[SYS_PassWord]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_PassWord_bitian'></li>
                                
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
	                         <ul zd='SYS_Company_id'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;所属公司ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_Company_id' id='SYS_Company_id' class='addboxinput inputfocus' value='$row[SYS_Company_id]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_Company_id_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_ZD_QQ'>
		                        <li style='text-align:right;width:220px'>QQ:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_ZD_QQ' id='SYS_ZD_QQ' class='addboxinput inputfocus' value='$row[SYS_ZD_QQ]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_ZD_QQ_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_Email'>
		                        <li style='text-align:right;width:220px'>邮件:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_Email' id='SYS_Email' class='addboxinput inputfocus' value='$row[SYS_Email]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_Email_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_QuanXian'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;权限{职位}:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_QuanXian' id='SYS_QuanXian' class='addboxinput inputfocus' value='$row[SYS_QuanXian]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_QuanXian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_XingBie'>
		                        <li style='text-align:right;width:220px'>性别:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='SYS_XingBie' type='radio' typeid='11' id='SYS_XingBie_0' value='男' class='addboxinput inputfocus'   checked='checked '    />男&nbsp;&nbsp;&nbsp;</label><label><input name='SYS_XingBie' type='radio' typeid='11' id='SYS_XingBie_1' class='addboxinput inputfocus' value='女'  checked='checked'    />女</label><script>Inputdate('SYS_XingBie','11','$row[SYS_XingBie]','DeskMenuDiv256','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_XingBie_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_DianHua'>
		                        <li style='text-align:right;width:220px'>电话:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_DianHua' id='SYS_DianHua' class='addboxinput inputfocus' value='$row[SYS_DianHua]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_DianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_YinXingKaHao'>
		                        <li style='text-align:right;width:220px'>银行卡号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_YinXingKaHao' id='SYS_YinXingKaHao' class='addboxinput inputfocus' value='$row[SYS_YinXingKaHao]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_YinXingKaHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_DiZhi'>
		                        <li style='text-align:right;width:220px'>地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_DiZhi' id='SYS_DiZhi' class='addboxinput inputfocus' value='$row[SYS_DiZhi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_DiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_GongZi'>
		                        <li style='text-align:right;width:220px'>工资:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_GongZi' id='SYS_GongZi' class='addboxinput inputfocus' value='$row[SYS_GongZi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_GongZi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_StartDate'>
		                        <li style='text-align:right;width:220px'>入职时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_StartDate' id='SYS_StartDate' class='addboxinput inputfocus' value='$row[SYS_StartDate]'   /></li>
								
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
	                         <ul zd='SYS_jib'>
		                        <li style='text-align:right;width:220px'>级别:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_jib' id='SYS_jib' class='addboxinput inputfocus' value='$row[SYS_jib]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_jib_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_photo'>
		                        <li style='text-align:right;width:220px'>头像:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_photo' id='SYS_photo' class='addboxinput inputfocus' value='$row[SYS_photo]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_photo_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_chaoguan'>
		                        <li style='text-align:right;width:220px'>超管:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_chaoguan' id='SYS_chaoguan' class='addboxinput inputfocus' value='$row[SYS_chaoguan]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_chaoguan_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_qianmin'>
		                        <li style='text-align:right;width:220px'>个性签名:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_qianmin' id='SYS_qianmin' class='addboxinput inputfocus' value='$row[SYS_qianmin]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_qianmin_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SYS_GongHao,SYS_reg_num,SYS_UserName,SYS_ShouJi,SYS_yuangongdanganbiao_id,SYS_PassWord,SYS_ShenFenZheng,SYS_Company_id,SYS_ZD_QQ,SYS_Email,SYS_ZD_ZaiZhiZhuangTai,SYS_QuanXian,SYS_XingBie,SYS_DianHua,SYS_YinXingKaHao,SYS_DiZhi,SYS_GongZi,SYS_StartDate,SYS_EndDate,SYS_jib,SYS_photo,SYS_chaoguan,SYS_qianmin'/>";
if ( strpos($const_q_xiug, "256") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry='SYS_GongHao,SYS_reg_num,SYS_UserName,SYS_ShouJi,SYS_Company_id,SYS_ZD_ZaiZhiZhuangTai,SYS_QuanXian'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry='SYS_GongHao,SYS_reg_num,SYS_UserName,SYS_ShouJi,SYS_Company_id,SYS_ZD_ZaiZhiZhuangTai,SYS_QuanXian'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='256' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','msc_user_reg','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','id');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv256_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
mysqli_close( $Connadmin ); //关闭数据库

?>