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
	    $sql = 'select * From `SQP_JieChuLaoDongHeTongZhengMingShu` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='ZD_XingMing'>
		                        <li style='text-align:right;width:220px'>姓名:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XingMing' id='ZD_XingMing' class='addboxinput inputfocus'  value='$row[ZD_XingMing]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingMing_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XingBie'>
		                        <li style='text-align:right;width:220px'>性别:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_XingBie' type='radio' typeid='11' id='ZD_XingBie_0' value='男' class='addboxinput inputfocus'   checked='checked '    />男&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XingBie' type='radio' typeid='11' id='ZD_XingBie_1' class='addboxinput inputfocus' value='女'  checked='checked'    />女</label><script>Inputdate('ZD_XingBie','11','$row[ZD_XingBie]','DeskMenuDiv503','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingBie_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenFenZhengHao'>
		                        <li style='text-align:right;width:220px'>身份证号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenFenZhengHao' id='ZD_ShenFenZhengHao' class='addboxinput inputfocus'  value='$row[ZD_ShenFenZhengHao]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenFenZhengHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_QiShiGongZuoShiJian'>
		                        <li style='text-align:right;width:220px'>起始工作时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='8' name='ZD_QiShiGongZuoShiJian' id='ZD_QiShiGongZuoShiJian' class='addboxinput inputfocus' value='$row[ZD_QiShiGongZuoShiJian]' style='width:100%'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_QiShiGongZuoShiJian',theme: '#393D49',lang: 'cn'});</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_QiShiGongZuoShiJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_SuoJieChuLaoDongHeTongQiXian'>
		                        <li style='text-align:right;width:220px'>所解除劳动合同期限:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_SuoJieChuLaoDongHeTongQiXian' id='ZD_SuoJieChuLaoDongHeTongQiXian' class='addboxinput inputfocus'  value='$row[ZD_SuoJieChuLaoDongHeTongQiXian]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_SuoJieChuLaoDongHeTongQiXian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_LiZhiYuanYin'>
		                        <li style='text-align:right;width:220px'>离职原因:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ZD_LiZhiYuanYin' id='ZD_LiZhiYuanYin' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$row[ZD_LiZhiYuanYin]</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_LiZhiYuanYin_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JieChuLaoDongHeTongShiJian'>
		                        <li style='text-align:right;width:220px'>解除劳动合同时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='8' name='ZD_JieChuLaoDongHeTongShiJian' id='ZD_JieChuLaoDongHeTongShiJian' class='addboxinput inputfocus' value='$row[ZD_JieChuLaoDongHeTongShiJian]' style='width:100%'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_JieChuLaoDongHeTongShiJian',theme: '#393D49',lang: 'cn'});</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JieChuLaoDongHeTongShiJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_LaoDongZheQianZi'>
		                        <li style='text-align:right;width:220px'>劳动者签字:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_LaoDongZheQianZi' type='radio' typeid='17' id='ZD_LaoDongZheQianZi_0' value='是' class='addboxinput inputfocus'    />是&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_LaoDongZheQianZi' type='radio' typeid='17' id='ZD_LaoDongZheQianZi_1' class='addboxinput inputfocus' value=''   checked='checked'    />否</label><script>Inputdate('ZD_LaoDongZheQianZi','17','$row[ZD_LaoDongZheQianZi]','DeskMenuDiv503','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_LaoDongZheQianZi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingMing,ZD_XingBie,ZD_ShenFenZhengHao,ZD_QiShiGongZuoShiJian,ZD_SuoJieChuLaoDongHeTongQiXian,ZD_LiZhiYuanYin,ZD_JieChuLaoDongHeTongShiJian,ZD_LaoDongZheQianZi'/>";
if ( strpos($const_q_xiug, "503") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='503' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_JieChuLaoDongHeTongZhengMingShu','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','id');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv503_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
 echo( "<script>ListLoadEND('$ToHtmlID');</script>" );
mysqli_close( $Conn ); //关闭数据库

?>