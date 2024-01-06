<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_HeZuoHuoBan";
		$sys_re_id_02="223";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_HeZuoHuoBan` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_GongSi=$row["ZD_GongSi"];
		$ZD_FaRen=$row["ZD_FaRen"];
		$ZD_JianChen=$row["ZD_JianChen"];
		$ZD_XingBie=$row["ZD_XingBie"];
		$ZD_DianHua=$row["ZD_DianHua"];
		$BeiZhu=$row["BeiZhu"];
		$ZD_DiZhi=$row["ZD_DiZhi"];
		$ZD_SheBaoRenShu=$row["ZD_SheBaoRenShu"];
		$ZD_WeiXin=$row["ZD_WeiXin"];
		$ZD_HeZuo=$row["ZD_HeZuo"];
		$ZD_QuFang=$row["ZD_QuFang"];
		$LaiFang=$row["LaiFang"];
		$PeiXun=$row["PeiXun"];
		$ZD_XiTong=$row["ZD_XiTong"];
		$ZD_JiHuaBaiFang=$row["ZD_JiHuaBaiFang"];
		$ZD_ZhuYingYeWu=$row["ZD_ZhuYingYeWu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_GongSi="";
		$ZD_FaRen="";
		$ZD_JianChen="";
		$ZD_XingBie="";
		$ZD_DianHua="";
		$BeiZhu="";
		$ZD_DiZhi="";
		$ZD_SheBaoRenShu="";
		$ZD_WeiXin="";
		$ZD_HeZuo="";
		$ZD_QuFang="";
		$LaiFang="";
		$PeiXun="";
		$ZD_XiTong="";
		$ZD_JiHuaBaiFang="";
		$ZD_ZhuYingYeWu="";

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
<ul class='tr selectTag' title='第1页' onClick=SelectTag_Menu_Two('.ContentTwo1',this,'DeskMenuDiv223') >01  <span class='menutishi nocopytext'>第1页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='第2页' onClick=SelectTag_Menu_Two('.ContentTwo2',this,'DeskMenuDiv223') >02  <span class='menutishi nocopytext'>第2页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='第3页' onClick=SelectTag_Menu_Two('.ContentTwo3',this,'DeskMenuDiv223') >03  <span class='menutishi nocopytext'>第3页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='第4页' onClick=SelectTag_Menu_Two('.ContentTwo4',this,'DeskMenuDiv223') >04  <span class='menutishi nocopytext'>第4页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr trboom' onClick=SelectTag_Menu_Two('.ContentTwo',this,'DeskMenuDiv223') >&nbsp;  &nbsp;&nbsp;</ul>
</div>
<div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='ZD_FaRen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;法人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_FaRen' id='ZD_FaRen' class='addboxinput inputfocus'  value='$ZD_FaRen'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_FaRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JianChen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;简称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JianChen' id='ZD_JianChen' class='addboxinput inputfocus'  value='$ZD_JianChen'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JianChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XingBie'>
		                        <li style='text-align:right;width:220px'>性别:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_XingBie' type='radio' typeid='3' id='ZD_XingBie_0' value='先生'  class='addboxinput inputfocus'    />先生&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XingBie' type='radio' id='ZD_XingBie_1' class='addboxinput inputfocus' value='女士'  checked='checked'     />女士</label><script>Inputdate('ZD_XingBie','3','$ZD_XingBie','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingBie_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_DianHua'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;电话:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_DianHua' id='ZD_DianHua' class='addboxinput inputfocus'  value='$ZD_DianHua'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_DianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='BeiZhu'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='BeiZhu' id='BeiZhu' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$BeiZhu</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='BeiZhu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_DiZhi'>
		                        <li style='text-align:right;width:220px'>地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_DiZhi' id='ZD_DiZhi' class='addboxinput inputfocus'  value='$ZD_DiZhi'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_DiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_SheBaoRenShu'>
		                        <li style='text-align:right;width:220px'>社保人数:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_SheBaoRenShu' id='ZD_SheBaoRenShu' class='addboxinput inputfocus'  value='$ZD_SheBaoRenShu'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_SheBaoRenShu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_WeiXin'>
		                        <li style='text-align:right;width:220px'>微信:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_WeiXin' type='radio' typeid='19' id='ZD_WeiXin_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_WeiXin' type='radio' typeid='19' id='ZD_WeiXin_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_WeiXin','19','$ZD_WeiXin','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_WeiXin_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HeZuo'>
		                        <li style='text-align:right;width:220px'>合作:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_HeZuo' type='radio' typeid='19' id='ZD_HeZuo_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_HeZuo' type='radio' typeid='19' id='ZD_HeZuo_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_HeZuo','19','$ZD_HeZuo','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HeZuo_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_QuFang'>
		                        <li style='text-align:right;width:220px'>去访:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_QuFang' type='radio' typeid='19' id='ZD_QuFang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_QuFang' type='radio' typeid='19' id='ZD_QuFang_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_QuFang','19','$ZD_QuFang','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_QuFang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='LaiFang'>
		                        <li style='text-align:right;width:220px'>来访:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='LaiFang' type='radio' typeid='19' id='LaiFang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='LaiFang' type='radio' typeid='19' id='LaiFang_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('LaiFang','19','$LaiFang','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='LaiFang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='PeiXun'>
		                        <li style='text-align:right;width:220px'>培训:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='PeiXun' type='radio' typeid='19' id='PeiXun_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='PeiXun' type='radio' typeid='19' id='PeiXun_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('PeiXun','19','$PeiXun','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='PeiXun_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XiTong'>
		                        <li style='text-align:right;width:220px'>系统:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_XiTong' type='radio' typeid='19' id='ZD_XiTong_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XiTong' type='radio' typeid='19' id='ZD_XiTong_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_XiTong','19','$ZD_XiTong','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XiTong_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiHuaBaiFang'>
		                        <li style='text-align:right;width:220px'>计划拜访:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_JiHuaBaiFang' type='radio' typeid='19' id='ZD_JiHuaBaiFang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_JiHuaBaiFang' type='radio' typeid='19' id='ZD_JiHuaBaiFang_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_JiHuaBaiFang','19','$ZD_JiHuaBaiFang','DeskMenuDiv223','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiHuaBaiFang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZhuYingYeWu'>
		                        <li style='text-align:right;width:220px'>主营业务:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZhuYingYeWu' id='ZD_ZhuYingYeWu' class='addboxinput inputfocus'  value='$ZD_ZhuYingYeWu'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZhuYingYeWu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<span class='ContentTwo ContentTwo2' style='display:none'>";
echo"
	                         <ul zd='ZD_GongSi'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;公司:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSi' id='ZD_GongSi' class='addboxinput inputfocus'  value='$ZD_GongSi'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<span class='ContentTwo ContentTwo3' style='display:none'>";
echo"</span>";
echo"<span class='ContentTwo ContentTwo4' style='display:none'>";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "223") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GongSi,ZD_FaRen,ZD_JianChen,ZD_XingBie,ZD_DianHua,BeiZhu,ZD_DiZhi,ZD_SheBaoRenShu,ZD_WeiXin,ZD_HeZuo,ZD_QuFang,LaiFang,PeiXun,ZD_XiTong,ZD_JiHuaBaiFang,ZD_ZhuYingYeWu'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='ZD_MenDianTuPian' bitian_Arry='ZD_GongSi,ZD_FaRen,ZD_JianChen,ZD_DianHua' databiao='SQP_HeZuoHuoBan' Wuchongfu_Arry='ZD_GongSi,ZD_JianChen'  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='223' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'ZD_GongSi,ZD_JianChen','SQP_HeZuoHuoBan','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','ZD_MenDianTuPian');form_weikong('#post_form','DeskMenuDiv223');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>