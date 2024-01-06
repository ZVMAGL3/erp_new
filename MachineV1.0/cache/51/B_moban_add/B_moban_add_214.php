<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_JiChuSheShiBaoYangJiHua";
		$sys_re_id_02="214";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_JiChuSheShiBaoYangJiHua` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$SheBeiMingChen=$row["SheBeiMingChen"];
		$XingHaoGuiGe=$row["XingHaoGuiGe"];
		$BaoYangZhouQi=$row["BaoYangZhouQi"];
		$ZD_1Yue=$row["ZD_1Yue"];
		$ZD_2Yue=$row["ZD_2Yue"];
		$ZD_3Yue=$row["ZD_3Yue"];
		$ZD_4Yue=$row["ZD_4Yue"];
		$ZD_5Yue=$row["ZD_5Yue"];
		$ZD_6Yue=$row["ZD_6Yue"];
		$ZD_7Yue=$row["ZD_7Yue"];
		$ZD_8Yue=$row["ZD_8Yue"];
		$ZD_9Yue=$row["ZD_9Yue"];
		$ZD_10Yue=$row["ZD_10Yue"];
		$ZD_11Yue=$row["ZD_11Yue"];
		$ZD_12Yue=$row["ZD_12Yue"];
		$BeiZhu2020730下午324562448=$row["BeiZhu2020730下午324562448"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$SheBeiMingChen="";
		$XingHaoGuiGe="";
		$BaoYangZhouQi="0";
		$ZD_1Yue="";
		$ZD_2Yue="";
		$ZD_3Yue="";
		$ZD_4Yue="0";
		$ZD_5Yue="";
		$ZD_6Yue="";
		$ZD_7Yue="";
		$ZD_8Yue="0";
		$ZD_9Yue="0";
		$ZD_10Yue="0";
		$ZD_11Yue="";
		$ZD_12Yue="";
		$BeiZhu2020730下午324562448="";

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
<div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='SheBeiMingChen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;设备名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SheBeiMingChen' id='SheBeiMingChen' class='addboxinput inputfocus' value='$SheBeiMingChen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SheBeiMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='XingHaoGuiGe'>
		                        <li style='text-align:right;width:220px'>型号规格:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='XingHaoGuiGe' id='XingHaoGuiGe' class='addboxinput inputfocus' value='$XingHaoGuiGe'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='XingHaoGuiGe_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='BaoYangZhouQi'>
		                        <li style='text-align:right;width:220px'>保养周期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='BaoYangZhouQi' id='BaoYangZhouQi' class='addboxinput inputfocus' value='$BaoYangZhouQi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='BaoYangZhouQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_1Yue'>
		                        <li style='text-align:right;width:220px'>1月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_1Yue' type='radio' typeid='19' id='ZD_1Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_1Yue' type='radio' typeid='19' id='ZD_1Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_1Yue','19','$ZD_1Yue','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_1Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_2Yue'>
		                        <li style='text-align:right;width:220px'>2月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_2Yue' type='radio' typeid='19' id='ZD_2Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_2Yue' type='radio' typeid='19' id='ZD_2Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_2Yue','19','$ZD_2Yue','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_2Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_3Yue'>
		                        <li style='text-align:right;width:220px'>3月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_3Yue' type='radio' typeid='19' id='ZD_3Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_3Yue' type='radio' typeid='19' id='ZD_3Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_3Yue','19','$ZD_3Yue','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_3Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_4Yue'>
		                        <li style='text-align:right;width:220px'>4月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_4Yue' type='radio' typeid='19' id='ZD_4Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_4Yue' type='radio' typeid='19' id='ZD_4Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_4Yue','19','$ZD_4Yue','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_4Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_5Yue'>
		                        <li style='text-align:right;width:220px'>5月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_5Yue' type='radio' typeid='19' id='ZD_5Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_5Yue' type='radio' typeid='19' id='ZD_5Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_5Yue','19','$ZD_5Yue','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_5Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_6Yue'>
		                        <li style='text-align:right;width:220px'>6月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_6Yue' type='radio' typeid='19' id='ZD_6Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_6Yue' type='radio' typeid='19' id='ZD_6Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_6Yue','19','$ZD_6Yue','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_6Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_7Yue'>
		                        <li style='text-align:right;width:220px'>7月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_7Yue' type='radio' typeid='19' id='ZD_7Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_7Yue' type='radio' typeid='19' id='ZD_7Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_7Yue','19','$ZD_7Yue','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_7Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_8Yue'>
		                        <li style='text-align:right;width:220px'>8月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_8Yue' type='radio' typeid='19' id='ZD_8Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_8Yue' type='radio' typeid='19' id='ZD_8Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_8Yue','19','$ZD_8Yue','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_8Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_9Yue'>
		                        <li style='text-align:right;width:220px'>9月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_9Yue' type='radio' typeid='19' id='ZD_9Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_9Yue' type='radio' typeid='19' id='ZD_9Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_9Yue','19','$ZD_9Yue','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_9Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_10Yue'>
		                        <li style='text-align:right;width:220px'>10月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_10Yue' type='radio' typeid='19' id='ZD_10Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_10Yue' type='radio' typeid='19' id='ZD_10Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_10Yue','19','$ZD_10Yue','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_10Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_11Yue'>
		                        <li style='text-align:right;width:220px'>11月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_11Yue' type='radio' typeid='19' id='ZD_11Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_11Yue' type='radio' typeid='19' id='ZD_11Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_11Yue','19','$ZD_11Yue','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_11Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_12Yue'>
		                        <li style='text-align:right;width:220px'>12月:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_12Yue' type='radio' typeid='19' id='ZD_12Yue_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_12Yue' type='radio' typeid='19' id='ZD_12Yue_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_12Yue','19','$ZD_12Yue','DeskMenuDiv214','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_12Yue_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='BeiZhu2020730下午324562448'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='BeiZhu2020730下午324562448' id='BeiZhu2020730下午324562448' class='addboxinput inputfocus' value='$BeiZhu2020730下午324562448'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='BeiZhu2020730下午324562448_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "214") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SheBeiMingChen,XingHaoGuiGe,BaoYangZhouQi,ZD_1Yue,ZD_2Yue,ZD_3Yue,ZD_4Yue,ZD_5Yue,ZD_6Yue,ZD_7Yue,ZD_8Yue,ZD_9Yue,ZD_10Yue,ZD_11Yue,ZD_12Yue,BeiZhu2020730下午324562448'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='SheBeiMingChen' databiao='SQP_JiChuSheShiBaoYangJiHua' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='214' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_JiChuSheShiBaoYangJiHua','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','sys_nowbh');form_weikong('#post_form','DeskMenuDiv214');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>