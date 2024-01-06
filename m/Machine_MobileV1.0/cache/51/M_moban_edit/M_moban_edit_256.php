<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'M_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Connadmin.php";
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
	    if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                                //1回收站0为不回收
	    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                               //是否为回收站0为不回收
	   
	    global $strmk_id,$Connadmin,$const_q_xiug;
	    $zu_all_list="";
	    $sql = 'select * From `msc_user_reg` where `id`='.$strmk_id;
	    $rs = mysqli_query(  $Connadmin , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	
echo( "<script>guanximenucopy_mobile('DeskMenuDiv256');YanZhen_ChongFu_ZuLoad_mobile($strmk_id,'','msc_user_reg','DeskMenuDiv256','#addbox');$('#DeskMenuDiv256 #addbox #post_form').attr({'tit':'SYS_GongHao,SYS_UserName,SYS_ShouJi,SYS_ZD_ZaiZhiZhuangTaiSYS_reg_num,SYS_Company_id,SYS_QuanXian','strmk_id':'$strmk_id'});form_weikong('#post_form','DeskMenuDiv256');ListLoadEND_Mobile('DeskMenuDiv256');</script>" );
echo"<p></p><form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list'><div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"
                            <ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;工号:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_GongHao' id='SYS_GongHao' class='addboxinput inputfocus' value='$row[SYS_GongHao]'   />
                            <div class='cols03 font_red yanzheng' id='SYS_GongHao_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;用户名:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_UserName' id='SYS_UserName' class='addboxinput inputfocus' value='$row[SYS_UserName]'   />
                            <div class='cols03 font_red yanzheng' id='SYS_UserName_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;手机:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_ShouJi' id='SYS_ShouJi' class='addboxinput inputfocus' value='$row[SYS_ShouJi]'   />
                            <div class='cols03 font_red yanzheng' id='SYS_ShouJi_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"
                            <ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;在职状态:</li>
                            <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_ZD_ZaiZhiZhuangTai' id='SYS_ZD_ZaiZhiZhuangTai' class='addboxinput inputfocus' value='$row[SYS_ZD_ZaiZhiZhuangTai]'   />
                            <div class='cols03 font_red yanzheng' id='SYS_ZD_ZaiZhiZhuangTai_bitian'></div>
                            </li>
                            </ul>
                        ";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;公司注册号id:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_reg_num' id='SYS_reg_num' class='addboxinput inputfocus' value='$row[SYS_reg_num]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_reg_num_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>对应的会员id:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_yuangongdanganbiao_id' id='SYS_yuangongdanganbiao_id' class='addboxinput inputfocus' value='$row[SYS_yuangongdanganbiao_id]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_yuangongdanganbiao_id_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>密码:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_PassWord' id='SYS_PassWord' class='addboxinput inputfocus' value='$row[SYS_PassWord]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_PassWord_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>身份证:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_ShenFenZheng' id='SYS_ShenFenZheng' class='addboxinput inputfocus' value='$row[SYS_ShenFenZheng]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_ShenFenZheng_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;所属公司ID:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_Company_id' id='SYS_Company_id' class='addboxinput inputfocus' value='$row[SYS_Company_id]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_Company_id_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>QQ:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_ZD_QQ' id='SYS_ZD_QQ' class='addboxinput inputfocus' value='$row[SYS_ZD_QQ]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_ZD_QQ_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>邮件:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_Email' id='SYS_Email' class='addboxinput inputfocus' value='$row[SYS_Email]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_Email_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;权限{职位}:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_QuanXian' id='SYS_QuanXian' class='addboxinput inputfocus' value='$row[SYS_QuanXian]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_QuanXian_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>性别:</li>
               <li class='cols02 reset_list'><label><input name='SYS_XingBie' type='radio' typeid='11' id='SYS_XingBie_0' value='男' class='addboxinput inputfocus'   checked='checked'    />男&nbsp;&nbsp;&nbsp;</label><label><input name='SYS_XingBie' type='radio' typeid='11' id='SYS_XingBie_1' class='addboxinput inputfocus' value='女'  checked='checked'    />女</label><script>Inputdate('SYS_XingBie','11','$row[SYS_XingBie]','DeskMenuDiv256','');</script>
			   <div class='cols03 font_red yanzheng' id='SYS_XingBie_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>电话:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_DianHua' id='SYS_DianHua' class='addboxinput inputfocus' value='$row[SYS_DianHua]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_DianHua_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>银行卡号:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_YinXingKaHao' id='SYS_YinXingKaHao' class='addboxinput inputfocus' value='$row[SYS_YinXingKaHao]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_YinXingKaHao_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>地址:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_DiZhi' id='SYS_DiZhi' class='addboxinput inputfocus' value='$row[SYS_DiZhi]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_DiZhi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>工资:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_GongZi' id='SYS_GongZi' class='addboxinput inputfocus' value='$row[SYS_GongZi]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_GongZi_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>入职时间:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_StartDate' id='SYS_StartDate' class='addboxinput inputfocus' value='$row[SYS_StartDate]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_StartDate_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>离职时间:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_EndDate' id='SYS_EndDate' class='addboxinput inputfocus' value='$row[SYS_EndDate]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_EndDate_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>级别:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_jib' id='SYS_jib' class='addboxinput inputfocus' value='$row[SYS_jib]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_jib_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>头像:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_photo' id='SYS_photo' class='addboxinput inputfocus' value='$row[SYS_photo]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_photo_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>超管:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_chaoguan' id='SYS_chaoguan' class='addboxinput inputfocus' value='$row[SYS_chaoguan]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_chaoguan_bitian'></div>
			   </li>
			   </ul>";
echo"<ul><li class='cols01'>个性签名:</li>
               <li class='cols02 reset_list'><input type='text' typeid='1' name='SYS_qianmin' id='SYS_qianmin' class='addboxinput inputfocus' value='$row[SYS_qianmin]'   />
			   <div class='cols03 font_red yanzheng' id='SYS_qianmin_bitian'></div>
			   </li>
			   </ul>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li class='cols01'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('DeskMenuDiv256',this) title='设定修改字段。'></i>&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SYS_GongHao,SYS_UserName,SYS_ShouJi,SYS_ZD_ZaiZhiZhuangTaiSYS_reg_num,SYS_yuangongdanganbiao_id,SYS_PassWord,SYS_ShenFenZheng,SYS_Company_id,SYS_ZD_QQ,SYS_Email,SYS_QuanXian,SYS_XingBie,SYS_DianHua,SYS_YinXingKaHao,SYS_DiZhi,SYS_GongZi,SYS_StartDate,SYS_EndDate,SYS_jib,SYS_photo,SYS_chaoguan,SYS_qianmin'/>";
if ( $const_q_xiug >= 0 ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv256','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry='SYS_GongHao,SYS_UserName,SYS_ShouJi,SYS_ZD_ZaiZhiZhuangTaiSYS_reg_num,SYS_Company_id,SYS_QuanXian'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','DeskMenuDiv256')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'DeskMenuDiv256','.sett',$strmk_id); />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry='SYS_GongHao,SYS_UserName,SYS_ShouJi,SYS_ZD_ZaiZhiZhuangTaiSYS_reg_num,SYS_Company_id,SYS_QuanXian'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:85%'  />";
};
echo"<input type='hidden' name='re_id' value='256' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>";
echo"
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'DeskMenuDiv256')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu_mobile('DeskMenuDiv256_MenuDiv_368',this,'DeskMenuDiv256','368',$strmk_id)>E+</A>
</div>


";
mysqli_close( $Connadmin ); //关闭数据库

?>