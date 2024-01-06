<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_ChuChaShiJianHuiZong";
		$sys_re_id_02="505";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_ChuChaShiJianHuiZong` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_XingMing=$row["ZD_XingMing"];
		$ZD_NianFen=$row["ZD_NianFen"];
		$ZD_1Ri=$row["ZD_1Ri"];
		$ZD_2Ri=$row["ZD_2Ri"];
		$ZD_3Ri=$row["ZD_3Ri"];
		$ZD_4Ri=$row["ZD_4Ri"];
		$ZD_5Ri=$row["ZD_5Ri"];
		$ZD_6Ri=$row["ZD_6Ri"];
		$ZD_7Ri=$row["ZD_7Ri"];
		$ZD_8Ri=$row["ZD_8Ri"];
		$ZD_9Ri=$row["ZD_9Ri"];
		$ZD_10Ri=$row["ZD_10Ri"];
		$ZD_11Ri=$row["ZD_11Ri"];
		$ZD_12Ri=$row["ZD_12Ri"];
		$ZD_13Ri=$row["ZD_13Ri"];
		$ZD_14Ri=$row["ZD_14Ri"];
		$ZD_15Ri=$row["ZD_15Ri"];
		$ZD_16Ri=$row["ZD_16Ri"];
		$ZD_17Ri=$row["ZD_17Ri"];
		$ZD_18Ri=$row["ZD_18Ri"];
		$ZD_19Ri=$row["ZD_19Ri"];
		$ZD_20Ri=$row["ZD_20Ri"];
		$ZD_21Ri=$row["ZD_21Ri"];
		$ZD_22Ri=$row["ZD_22Ri"];
		$ZD_23Ri=$row["ZD_23Ri"];
		$ZD_24Ri=$row["ZD_24Ri"];
		$ZD_25Ri=$row["ZD_25Ri"];
		$ZD_26Ri=$row["ZD_26Ri"];
		$ZD_27Ri=$row["ZD_27Ri"];
		$ZD_28Ri=$row["ZD_28Ri"];
		$ZD_29Ri=$row["ZD_29Ri"];
		$ZD_30Ri=$row["ZD_30Ri"];
		$ZD_31Ri=$row["ZD_31Ri"];
		$ZD_GongJiTian=$row["ZD_GongJiTian"];
		$ZD_ChuChaBuTie=$row["ZD_ChuChaBuTie"];
		$ZD_BeiZhu=$row["ZD_BeiZhu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_XingMing="";
		$ZD_NianFen="";
		$ZD_1Ri="";
		$ZD_2Ri="";
		$ZD_3Ri="";
		$ZD_4Ri="";
		$ZD_5Ri="";
		$ZD_6Ri="";
		$ZD_7Ri="";
		$ZD_8Ri="";
		$ZD_9Ri="";
		$ZD_10Ri="";
		$ZD_11Ri="";
		$ZD_12Ri="";
		$ZD_13Ri="";
		$ZD_14Ri="";
		$ZD_15Ri="";
		$ZD_16Ri="";
		$ZD_17Ri="";
		$ZD_18Ri="";
		$ZD_19Ri="";
		$ZD_20Ri="";
		$ZD_21Ri="";
		$ZD_22Ri="";
		$ZD_23Ri="";
		$ZD_24Ri="";
		$ZD_25Ri="";
		$ZD_26Ri="";
		$ZD_27Ri="";
		$ZD_28Ri="";
		$ZD_29Ri="";
		$ZD_30Ri="";
		$ZD_31Ri="";
		$ZD_GongJiTian="";
		$ZD_ChuChaBuTie="";
		$ZD_BeiZhu="";

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
	                         <ul zd='ZD_XingMing'>
		                        <li style='text-align:right;width:220px'>姓名:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XingMing' id='ZD_XingMing' class='addboxinput inputfocus'  value='$ZD_XingMing'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingMing_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_NianFen'>
		                        <li style='text-align:right;width:220px'>年份:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_NianFen' id='ZD_NianFen' class='addboxinput inputfocus'  value='$ZD_NianFen'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_NianFen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_1Ri'>
		                        <li style='text-align:right;width:220px'>1日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_1Ri' id='ZD_1Ri' class='addboxinput inputfocus'  value='$ZD_1Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_1Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_2Ri'>
		                        <li style='text-align:right;width:220px'>2日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_2Ri' id='ZD_2Ri' class='addboxinput inputfocus'  value='$ZD_2Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_2Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_3Ri'>
		                        <li style='text-align:right;width:220px'>3日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_3Ri' id='ZD_3Ri' class='addboxinput inputfocus'  value='$ZD_3Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_3Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_4Ri'>
		                        <li style='text-align:right;width:220px'>4日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_4Ri' id='ZD_4Ri' class='addboxinput inputfocus'  value='$ZD_4Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_4Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_5Ri'>
		                        <li style='text-align:right;width:220px'>5日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_5Ri' id='ZD_5Ri' class='addboxinput inputfocus'  value='$ZD_5Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_5Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_6Ri'>
		                        <li style='text-align:right;width:220px'>6日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_6Ri' id='ZD_6Ri' class='addboxinput inputfocus'  value='$ZD_6Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_6Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_7Ri'>
		                        <li style='text-align:right;width:220px'>7日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_7Ri' id='ZD_7Ri' class='addboxinput inputfocus'  value='$ZD_7Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_7Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_8Ri'>
		                        <li style='text-align:right;width:220px'>8日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_8Ri' id='ZD_8Ri' class='addboxinput inputfocus'  value='$ZD_8Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_8Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_9Ri'>
		                        <li style='text-align:right;width:220px'>9日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_9Ri' id='ZD_9Ri' class='addboxinput inputfocus'  value='$ZD_9Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_9Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_10Ri'>
		                        <li style='text-align:right;width:220px'>10日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_10Ri' id='ZD_10Ri' class='addboxinput inputfocus'  value='$ZD_10Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_10Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_11Ri'>
		                        <li style='text-align:right;width:220px'>11日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_11Ri' id='ZD_11Ri' class='addboxinput inputfocus'  value='$ZD_11Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_11Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_12Ri'>
		                        <li style='text-align:right;width:220px'>12日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_12Ri' id='ZD_12Ri' class='addboxinput inputfocus'  value='$ZD_12Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_12Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_13Ri'>
		                        <li style='text-align:right;width:220px'>13日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_13Ri' id='ZD_13Ri' class='addboxinput inputfocus'  value='$ZD_13Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_13Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_14Ri'>
		                        <li style='text-align:right;width:220px'>14日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_14Ri' id='ZD_14Ri' class='addboxinput inputfocus'  value='$ZD_14Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_14Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_15Ri'>
		                        <li style='text-align:right;width:220px'>15日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_15Ri' id='ZD_15Ri' class='addboxinput inputfocus'  value='$ZD_15Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_15Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_16Ri'>
		                        <li style='text-align:right;width:220px'>16日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_16Ri' id='ZD_16Ri' class='addboxinput inputfocus'  value='$ZD_16Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_16Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_17Ri'>
		                        <li style='text-align:right;width:220px'>17日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_17Ri' id='ZD_17Ri' class='addboxinput inputfocus'  value='$ZD_17Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_17Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_18Ri'>
		                        <li style='text-align:right;width:220px'>18日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_18Ri' id='ZD_18Ri' class='addboxinput inputfocus'  value='$ZD_18Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_18Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_19Ri'>
		                        <li style='text-align:right;width:220px'>19日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_19Ri' id='ZD_19Ri' class='addboxinput inputfocus'  value='$ZD_19Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_19Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_20Ri'>
		                        <li style='text-align:right;width:220px'>20日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_20Ri' id='ZD_20Ri' class='addboxinput inputfocus'  value='$ZD_20Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_20Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_21Ri'>
		                        <li style='text-align:right;width:220px'>21日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_21Ri' id='ZD_21Ri' class='addboxinput inputfocus'  value='$ZD_21Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_21Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_22Ri'>
		                        <li style='text-align:right;width:220px'>22日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_22Ri' id='ZD_22Ri' class='addboxinput inputfocus'  value='$ZD_22Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_22Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_23Ri'>
		                        <li style='text-align:right;width:220px'>23日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_23Ri' id='ZD_23Ri' class='addboxinput inputfocus'  value='$ZD_23Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_23Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_24Ri'>
		                        <li style='text-align:right;width:220px'>24日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_24Ri' id='ZD_24Ri' class='addboxinput inputfocus'  value='$ZD_24Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_24Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_25Ri'>
		                        <li style='text-align:right;width:220px'>25日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_25Ri' id='ZD_25Ri' class='addboxinput inputfocus'  value='$ZD_25Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_25Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_26Ri'>
		                        <li style='text-align:right;width:220px'>26日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_26Ri' id='ZD_26Ri' class='addboxinput inputfocus'  value='$ZD_26Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_26Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_27Ri'>
		                        <li style='text-align:right;width:220px'>27日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_27Ri' id='ZD_27Ri' class='addboxinput inputfocus'  value='$ZD_27Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_27Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_28Ri'>
		                        <li style='text-align:right;width:220px'>28日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_28Ri' id='ZD_28Ri' class='addboxinput inputfocus'  value='$ZD_28Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_28Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_29Ri'>
		                        <li style='text-align:right;width:220px'>29日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_29Ri' id='ZD_29Ri' class='addboxinput inputfocus'  value='$ZD_29Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_29Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_30Ri'>
		                        <li style='text-align:right;width:220px'>30日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_30Ri' id='ZD_30Ri' class='addboxinput inputfocus'  value='$ZD_30Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_30Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_31Ri'>
		                        <li style='text-align:right;width:220px'>31日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_31Ri' id='ZD_31Ri' class='addboxinput inputfocus'  value='$ZD_31Ri'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_31Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongJiTian'>
		                        <li style='text-align:right;width:220px'>共计（天）:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongJiTian' id='ZD_GongJiTian' class='addboxinput inputfocus'  value='$ZD_GongJiTian'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongJiTian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ChuChaBuTie'>
		                        <li style='text-align:right;width:220px'>出差补贴:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ChuChaBuTie' id='ZD_ChuChaBuTie' class='addboxinput inputfocus'  value='$ZD_ChuChaBuTie'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ChuChaBuTie_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BeiZhu'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$ZD_BeiZhu</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BeiZhu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "505") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingMing,ZD_NianFen,ZD_1Ri,ZD_2Ri,ZD_3Ri,ZD_4Ri,ZD_5Ri,ZD_6Ri,ZD_7Ri,ZD_8Ri,ZD_9Ri,ZD_10Ri,ZD_11Ri,ZD_12Ri,ZD_13Ri,ZD_14Ri,ZD_15Ri,ZD_16Ri,ZD_17Ri,ZD_18Ri,ZD_19Ri,ZD_20Ri,ZD_21Ri,ZD_22Ri,ZD_23Ri,ZD_24Ri,ZD_25Ri,ZD_26Ri,ZD_27Ri,ZD_28Ri,ZD_29Ri,ZD_30Ri,ZD_31Ri,ZD_GongJiTian,ZD_ChuChaBuTie,ZD_BeiZhu'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='SQP_ChuChaShiJianHuiZong' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='505' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_ChuChaShiJianHuiZong','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','id');form_weikong('#post_form','DeskMenuDiv505');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>