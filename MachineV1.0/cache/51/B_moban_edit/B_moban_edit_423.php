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
	    $sql = 'select * From `SQP_GuKeHeTong` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='ZD_HeTongFuJian'>
		                        <li style='text-align:right;width:220px'>合同附件:</li>
                                
		                        <li style='width:40%' class='reset_list'>
                <input type='text' typeid='6' name='ZD_HeTongFuJian' id='ZD_HeTongFuJian_$ToHtmlID' tidno='423_ZD_HeTongFuJian_$strmk_id' class='addboxinput inputfocus ZD_HeTongFuJian' value='' style='display:none;width:100%'   />
                <div id='ZD_HeTongFuJian_$ToHtmlID"."_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'>
                    <div id='ZD_HeTongFuJian_$ToHtmlID"."_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>
                        +
                    </div>
                </div>
                <script>
                    createupload_jiaohu({'inputid':'ZD_HeTongFuJian','ToHtmlID':'$ToHtmlID'});
                </script>
            </li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HeTongFuJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_SuoShuGuKe'>
		                        <li style='text-align:right;width:220px'>所属顾客:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_SuoShuGuKe' id='ZD_SuoShuGuKe' class='addboxinput inputfocus' value='$row[ZD_SuoShuGuKe]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_SuoShuGuKe_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HeTongBianHao'>
		                        <li style='text-align:right;width:220px'>合同编号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_HeTongBianHao' id='ZD_HeTongBianHao' class='addboxinput inputfocus' value='$row[ZD_HeTongBianHao]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HeTongBianHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HeTongJinE'>
		                        <li style='text-align:right;width:220px'>合同金额:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_HeTongJinE' id='ZD_HeTongJinE' class='addboxinput inputfocus' value='$row[ZD_HeTongJinE]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HeTongJinE_bitian'></li>
                                
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
	                         <ul zd='ZD_DiZhi'>
		                        <li style='text-align:right;width:220px'>地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_DiZhi' id='ZD_DiZhi' class='addboxinput inputfocus' value='$row[ZD_DiZhi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_DiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_QianDingRiQi'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;签订日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='8' name='ZD_QianDingRiQi' id='ZD_QianDingRiQi' class='addboxinput inputfocus' value='$row[ZD_QianDingRiQi]'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#ZD_QianDingRiQi',theme: '#393D49',lang: 'cn'});</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_QianDingRiQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiaoQi'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;交期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiaoQi' id='ZD_JiaoQi' class='addboxinput inputfocus' value='$row[ZD_JiaoQi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiaoQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_QianDingDiDian'>
		                        <li style='text-align:right;width:220px'>签订地点:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_QianDingDiDian' id='ZD_QianDingDiDian' class='addboxinput inputfocus' value='$row[ZD_QianDingDiDian]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_QianDingDiDian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XiangMuJingLi'>
		                        <li style='text-align:right;width:220px'>项目经理:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XiangMuJingLi' id='ZD_XiangMuJingLi' class='addboxinput inputfocus' value='$row[ZD_XiangMuJingLi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XiangMuJingLi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_321'>
		                        <li style='text-align:right;width:220px'>[关系]顾客档案表ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_321' id='sys_gx_id_321' class='addboxinput inputfocus' value='$row[sys_gx_id_321]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_321_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_321','26','SQP_GuKeHeTong','DeskMenuDiv423');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_257'>
		                        <li style='text-align:right;width:220px'>[关系][SYS] 职位管理ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_257' id='sys_gx_id_257' class='addboxinput inputfocus' value='$row[sys_gx_id_257]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_257_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_HeTongFuJian,ZD_SuoShuGuKe,ZD_HeTongBianHao,ZD_HeTongJinE,ZD_XiangMu,ZD_LianXiRen,ZD_DianHua,ZD_DiZhi,ZD_QianDingRiQi,ZD_JiaoQi,ZD_QianDingDiDian,ZD_XiangMuJingLi,sys_gx_id_321,sys_gx_id_257'/>";
if ( strpos($const_q_xiug, "423") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='ZD_QianDingRiQi,ZD_JiaoQi'  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry='ZD_QianDingRiQi,ZD_JiaoQi'  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='423' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_GuKeHeTong','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','sys_nowbh');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv423_MenuDiv_499',this,'$ToHtmlID','24',$strmk_id)>合同项目跟踪记录</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv423_MenuDiv_471',this,'$ToHtmlID','25',$strmk_id)>合同评审记录表</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv423_MenuDiv_495',this,'$ToHtmlID','27',$strmk_id)>服务流程单</A>
<A  onClick=SelectTag_Menu('DeskMenuDiv423_MenuDiv_510',this,'$ToHtmlID','28',$strmk_id)>客户证书管理</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv423_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>

<script>form_weikong('#post_form','$ToHtmlID');</script>

";
mysqli_close( $Conn ); //关闭数据库

?>