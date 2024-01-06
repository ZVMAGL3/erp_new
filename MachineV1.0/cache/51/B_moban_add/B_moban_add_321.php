<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="sys_gukedanganbiao";
		$sys_re_id_02="321";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `sys_gukedanganbiao` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_BeiZhuQiYeGongShangXinYongDeng=$row["ZD_BeiZhuQiYeGongShangXinYongDeng"];
		$ZD_GongSiMingChen=$row["ZD_GongSiMingChen"];
		$ZD_FuZeRen=$row["ZD_FuZeRen"];
		$ZD_YiXiangFuWu=$row["ZD_YiXiangFuWu"];
		$XiangMuJingLi=$row["XiangMuJingLi"];
		$ZD_ChengJiaoXiangMu=$row["ZD_ChengJiaoXiangMu"];
		$ZD_DengJi=$row["ZD_DengJi"];
		$XingBie=$row["XingBie"];
		$DianHua=$row["DianHua"];
		$sys_gx_id_223=$row["sys_gx_id_223"];
		$ShengChanChanPin=$row["ShengChanChanPin"];
		$DiZhi=$row["DiZhi"];
		$sys_id_zu=$row["sys_id_zu"];
		$sys_chaosong=$row["sys_chaosong"];
		$ZD_WeiXin=$row["ZD_WeiXin"];
		$sys_gx_id_256=$row["sys_gx_id_256"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_BeiZhuQiYeGongShangXinYongDeng="";
		$ZD_GongSiMingChen="";
		$ZD_FuZeRen="";
		$ZD_YiXiangFuWu="";
		$XiangMuJingLi="";
		$ZD_ChengJiaoXiangMu="";
		$ZD_DengJi="";
		$XingBie="";
		$DianHua="";
		$sys_gx_id_223="";
		$ShengChanChanPin="";
		$DiZhi="";
		$sys_id_zu="";
		$sys_chaosong="";
		$ZD_WeiXin="";
		$sys_gx_id_256="";

};

		if($sys_guanxibiao_id!='' && $GuanXi_id!='' && $Table_name!=''){
	        //--------------------------------查询关系表
	        $sys_nowid_guanxi_col='sys_gx_id_'.$sys_guanxibiao_id;
	        $sql = "select sys_GuanXiZDList From `sys_guanxibiao` where `sys_re_id`='$sys_guanxibiao_id' and sys_re_id_02='$sys_re_id_02' and sys_nowid_guanxi_col='$sys_nowid_guanxi_col' and sys_huis=0";
	        $rs = mysqli_query(  $Conn , $sql );
	        $row = mysqli_fetch_array( $rs );
	        $sys_GuanXiZDList=$row['sys_GuanXiZDList'];
	        mysqli_free_result( $rs ); //释放内存
			$sys_GuanXiZDList='id=sys_gx_id_'.$sys_guanxibiao_id.','.$sys_GuanXiZDList;
	        //echo $sys_GuanXiZDList;
	        //--------------------------------jlmb表名
	        $sql = "select mdb_name_SYS From `sys_jlmb` where `id`='$sys_guanxibiao_id' ";
	        $rs = mysqli_query(  $Conn , $sql );
	        $row = mysqli_fetch_array( $rs );
	        $mdb_name_SYS=$row['mdb_name_SYS'];
	        mysqli_free_result( $rs ); //释放内存
	        //echo $mdb_name_SYS;
	        //--------------------------------查询到关系记录
	        $sql = "select * From `$mdb_name_SYS` where `id`='$GuanXi_id' ";
	        $rs = mysqli_query(  $Conn , $sql );
	        $row = mysqli_fetch_array( $rs );
	        
	        //循环
            $fharry = explode( ',', $sys_GuanXiZDList );
	        for ( $i = 0; $i < count( $fharry ); $i++ ) {
		        //$nowval = $fharry[ $i ];
				$fharry2 = explode( '=', $fharry[ $i ] );
				$nowval_A=$fharry2[0];
				$nowval_B=$fharry2[1];
				$$nowval_B=$row[$nowval_A];
				//echo $$nowval_B;
	        };
	        mysqli_free_result( $rs ); //释放内存

        }
		echo"<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'  style='padding-top:18px'>
<div class='two_menu'>
<ul class='tr trhead' >&nbsp;  <span class='menutishi nocopytext'>Menu</span></ul>
<ul class='tr selectTag' title='第1页' onClick=SelectTag_Menu_Two('.ContentTwo1',this,'DeskMenuDiv321') >01  <span class='menutishi nocopytext'>第1页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='第2页' onClick=SelectTag_Menu_Two('.ContentTwo2',this,'DeskMenuDiv321') >02  <span class='menutishi nocopytext'>第2页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr trboom' onClick=SelectTag_Menu_Two('.ContentTwo',this,'DeskMenuDiv321') >&nbsp;  &nbsp;&nbsp;</ul>
</div>
<div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='ZD_GongSiMingChen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;公司名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSiMingChen' id='ZD_GongSiMingChen' class='addboxinput inputfocus' value='$ZD_GongSiMingChen'   /></li>
								<li style='text-align:left;width:28px;margin-left:8px;border:0px solid #333;text-align: center;cursor:default;' class='font_red' onclick='baidu_url(this)'><i class='fa fa-18-4'></i></li>
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSiMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_YiXiangFuWu'>
		                        <li style='text-align:right;width:220px'>意向服务:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_YiXiangFuWu' id='ZD_YiXiangFuWu' class='addboxinput inputfocus' value='$ZD_YiXiangFuWu'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_YiXiangFuWu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='XiangMuJingLi'>
		                        <li style='text-align:right;width:220px'>项目经理:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='XiangMuJingLi' id='XiangMuJingLi' class='addboxinput inputfocus' value='$XiangMuJingLi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='XiangMuJingLi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ChengJiaoXiangMu'>
		                        <li style='text-align:right;width:220px'>成交项目:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ChengJiaoXiangMu' id='ZD_ChengJiaoXiangMu' class='addboxinput inputfocus' value='$ZD_ChengJiaoXiangMu'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ChengJiaoXiangMu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_DengJi'>
		                        <li style='text-align:right;width:220px'>等级:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_DengJi' id='ZD_DengJi' class='addboxinput inputfocus' value='$ZD_DengJi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_DengJi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_WeiXin'>
		                        <li style='text-align:right;width:220px'>微信:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_WeiXin' type='radio' typeid='18' id='ZD_WeiXin_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_WeiXin' type='radio' typeid='18' id='ZD_WeiXin_1' class='addboxinput inputfocus' value='×'   checked='checked'    />× </label><script>Inputdate('ZD_WeiXin','18','$ZD_WeiXin','DeskMenuDiv321','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_WeiXin_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BeiZhuQiYeGongShangXinYongDeng'>
		                        <li style='text-align:right;width:220px'>备注【企业工商信用等】:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ZD_BeiZhuQiYeGongShangXinYongDeng' id='ZD_BeiZhuQiYeGongShangXinYongDeng' class='addboxinput inputfocus' 50px;'   >$ZD_BeiZhuQiYeGongShangXinYongDeng</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BeiZhuQiYeGongShangXinYongDeng_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='XingBie'>
		                        <li style='text-align:right;width:220px'>性别:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='XingBie' type='radio' typeid='3' id='XingBie_0' value='先生'  class='addboxinput inputfocus'    />先生&nbsp;&nbsp;&nbsp;</label><label><input name='XingBie' type='radio' id='XingBie_1' class='addboxinput inputfocus' value='女士'  checked='checked'     />女士</label><script>Inputdate('XingBie','3','$XingBie','DeskMenuDiv321','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='XingBie_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='DianHua'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;电话:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='DianHua' id='DianHua' class='addboxinput inputfocus' value='$DianHua'   /></li>
								<li style='text-align:left;width:28px;margin-left:8px;border:0px solid #333;text-align: center;cursor:default;' class='font_red' onclick='baidu_url(this)'><i class='fa fa-18-4'></i></li>
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='DianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_223'>
		                        <li style='text-align:right;width:220px'>[关系]合作伙伴ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_223' id='sys_gx_id_223' class='addboxinput inputfocus' value='$sys_gx_id_223'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_223_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_223','15','sys_gukedanganbiao','DeskMenuDiv321');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='ShengChanChanPin'>
		                        <li style='text-align:right;width:220px'>生产产品:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ShengChanChanPin' id='ShengChanChanPin' class='addboxinput inputfocus' value='$ShengChanChanPin'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ShengChanChanPin_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='DiZhi'>
		                        <li style='text-align:right;width:220px'>地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='DiZhi' id='DiZhi' class='addboxinput inputfocus' value='$DiZhi'   /></li>
								<li style='text-align:left;width:28px;margin-left:8px;border:0px solid #333;text-align: center;cursor:default;' class='font_red' onclick='baidu_url(this)'><i class='fa fa-18-4'></i></li>
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='DiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_id_zu'>
		                        <li style='text-align:right;width:220px'>分类:</li>
                                
		                        <li style='width:40%' class='reset_list'>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu1' tit='$sys_id_zu' cnval='失效' value='$sys_id_zu' valid='291' valstr='' class='addboxinput inputfocus' >失效&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu2' tit='$sys_id_zu' cnval='意向' value='$sys_id_zu' valid='116' valstr='' class='addboxinput inputfocus' >意向&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu3' tit='$sys_id_zu' cnval='汇淡中' value='$sys_id_zu' valid='290' valstr='' class='addboxinput inputfocus' >汇淡中&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu4' tit='$sys_id_zu' cnval='潜在' value='$sys_id_zu' valid='369' valstr='' class='addboxinput inputfocus' >潜在&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu5' tit='$sys_id_zu' cnval='老客户' value='$sys_id_zu' valid='121' valstr='' class='addboxinput inputfocus' >老客户&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu6' tit='$sys_id_zu' cnval='跟进中' value='$sys_id_zu' valid='368' valstr='' class='addboxinput inputfocus' >跟进中&nbsp;</label><script>Inputdate('sys_id_zu','15','$sys_id_zu','DeskMenuDiv321','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_id_zu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_256'>
		                        <li style='text-align:right;width:220px'>[关系]SYS云帐户ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_256' id='sys_gx_id_256' class='addboxinput inputfocus' value='$sys_gx_id_256'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_256_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<span class='ContentTwo ContentTwo2' style='display:none'>";
echo"
	                         <ul zd='ZD_FuZeRen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;负责人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_FuZeRen' id='ZD_FuZeRen' class='addboxinput inputfocus' value='$ZD_FuZeRen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_FuZeRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_chaosong'>
		                        <li style='text-align:right;width:220px'>经办人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_chaosong' id='sys_chaosong' class='addboxinput inputfocus' value='$sys_chaosong'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_chaosong_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "321") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_BeiZhuQiYeGongShangXinYongDeng,ZD_GongSiMingChen,ZD_FuZeRen,ZD_YiXiangFuWu,XiangMuJingLi,ZD_ChengJiaoXiangMu,ZD_DengJi,XingBie,DianHua,sys_gx_id_223,ShengChanChanPin,DiZhi,sys_id_zu,sys_chaosong,ZD_WeiXin,sys_gx_id_256'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='ZD_GongSiMingChen,ZD_FuZeRen,DianHua' databiao='sys_gukedanganbiao' Wuchongfu_Arry='ZD_GongSiMingChen'  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='321' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'ZD_GongSiMingChen','sys_gukedanganbiao','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','sys_nowbh');form_weikong('#post_form','DeskMenuDiv321');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>