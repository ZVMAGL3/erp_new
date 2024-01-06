<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_GongXianZhi";
		$sys_re_id_02="504";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_GongXianZhi` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_XingMing=$row["ZD_XingMing"];
		$ZD_GongXianZhi=$row["ZD_GongXianZhi"];
		$ZD_JiFen=$row["ZD_JiFen"];
		$ZD_GongXianZhi2020827‎16‎‎40‎‎1012=$row["ZD_GongXianZhi2020827‎16‎‎40‎‎1012"];
		$ZD_JiFen2020827‎16‎‎40‎‎142964=$row["ZD_JiFen2020827‎16‎‎40‎‎142964"];
		$ZD_GongXianZhi2020827‎16‎‎40‎‎252196=$row["ZD_GongXianZhi2020827‎16‎‎40‎‎252196"];
		$ZD_JiFen2020827‎16‎‎40‎‎332199=$row["ZD_JiFen2020827‎16‎‎40‎‎332199"];
		$ZD_GongXianZhi2020827‎16‎‎40‎‎402031=$row["ZD_GongXianZhi2020827‎16‎‎40‎‎402031"];
		$ZD_JiFen2020827‎16‎‎40‎‎46924=$row["ZD_JiFen2020827‎16‎‎40‎‎46924"];
		$ZD_GongXianZhi2020827‎16‎‎41‎‎00300=$row["ZD_GongXianZhi2020827‎16‎‎41‎‎00300"];
		$ZD_JiFen2020827‎16‎‎41‎‎12810=$row["ZD_JiFen2020827‎16‎‎41‎‎12810"];
		$ZD_GongXianZhi2020827‎16‎‎41‎‎24450=$row["ZD_GongXianZhi2020827‎16‎‎41‎‎24450"];
		$ZD_JiFen2020827‎16‎‎56‎‎012850=$row["ZD_JiFen2020827‎16‎‎56‎‎012850"];
		$ZD_GongXianZhi2020827‎16‎‎54‎‎322661=$row["ZD_GongXianZhi2020827‎16‎‎54‎‎322661"];
		$ZD_JiFen2020827‎16‎‎41‎‎331482=$row["ZD_JiFen2020827‎16‎‎41‎‎331482"];
		$ZD_GongXianZhi2020827‎16‎‎41‎‎42138=$row["ZD_GongXianZhi2020827‎16‎‎41‎‎42138"];
		$ZD_JiFen2020827‎16‎‎41‎‎462247=$row["ZD_JiFen2020827‎16‎‎41‎‎462247"];
		$ZD_GongXianZhi2020827‎16‎‎41‎‎531791=$row["ZD_GongXianZhi2020827‎16‎‎41‎‎531791"];
		$ZD_JiFen2020827‎16‎‎41‎‎572919=$row["ZD_JiFen2020827‎16‎‎41‎‎572919"];
		$ZD_GongXianZhi2020827‎16‎‎46‎‎12927=$row["ZD_GongXianZhi2020827‎16‎‎46‎‎12927"];
		$ZD_JiFen2020827‎16‎‎46‎‎172175=$row["ZD_JiFen2020827‎16‎‎46‎‎172175"];
		$ZD_GongXianZhi2020827‎16‎‎46‎‎241170=$row["ZD_GongXianZhi2020827‎16‎‎46‎‎241170"];
		$ZD_JiFen2020827‎16‎‎46‎‎301743=$row["ZD_JiFen2020827‎16‎‎46‎‎301743"];
		$ZD_GongXianZhi2020827‎16‎‎46‎‎361122=$row["ZD_GongXianZhi2020827‎16‎‎46‎‎361122"];
		$ZD_JiFen2020827‎16‎‎46‎‎4115=$row["ZD_JiFen2020827‎16‎‎46‎‎4115"];
		$ZD_ZongGongXianZhi=$row["ZD_ZongGongXianZhi"];
		$ZD_ZongJiFen=$row["ZD_ZongJiFen"];
		$ZD_HeJi=$row["ZD_HeJi"];
		$ZD_BeiZhu=$row["ZD_BeiZhu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_XingMing="";
		$ZD_GongXianZhi="";
		$ZD_JiFen="";
		$ZD_GongXianZhi2020827‎16‎‎40‎‎1012="";
		$ZD_JiFen2020827‎16‎‎40‎‎142964="";
		$ZD_GongXianZhi2020827‎16‎‎40‎‎252196="";
		$ZD_JiFen2020827‎16‎‎40‎‎332199="";
		$ZD_GongXianZhi2020827‎16‎‎40‎‎402031="";
		$ZD_JiFen2020827‎16‎‎40‎‎46924="";
		$ZD_GongXianZhi2020827‎16‎‎41‎‎00300="";
		$ZD_JiFen2020827‎16‎‎41‎‎12810="";
		$ZD_GongXianZhi2020827‎16‎‎41‎‎24450="";
		$ZD_JiFen2020827‎16‎‎56‎‎012850="";
		$ZD_GongXianZhi2020827‎16‎‎54‎‎322661="";
		$ZD_JiFen2020827‎16‎‎41‎‎331482="";
		$ZD_GongXianZhi2020827‎16‎‎41‎‎42138="";
		$ZD_JiFen2020827‎16‎‎41‎‎462247="";
		$ZD_GongXianZhi2020827‎16‎‎41‎‎531791="";
		$ZD_JiFen2020827‎16‎‎41‎‎572919="";
		$ZD_GongXianZhi2020827‎16‎‎46‎‎12927="";
		$ZD_JiFen2020827‎16‎‎46‎‎172175="";
		$ZD_GongXianZhi2020827‎16‎‎46‎‎241170="";
		$ZD_JiFen2020827‎16‎‎46‎‎301743="";
		$ZD_GongXianZhi2020827‎16‎‎46‎‎361122="";
		$ZD_JiFen2020827‎16‎‎46‎‎4115="";
		$ZD_ZongGongXianZhi="";
		$ZD_ZongJiFen="";
		$ZD_HeJi="";
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
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XingMing' id='ZD_XingMing' class='addboxinput inputfocus' value='$ZD_XingMing'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingMing_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi'>
		                        <li style='text-align:right;width:220px'>①贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi' id='ZD_GongXianZhi' class='addboxinput inputfocus' value='$ZD_GongXianZhi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen'>
		                        <li style='text-align:right;width:220px'>①积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen' id='ZD_JiFen' class='addboxinput inputfocus' value='$ZD_JiFen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎40‎‎1012'>
		                        <li style='text-align:right;width:220px'>②贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎1012' id='ZD_GongXianZhi2020827‎16‎‎40‎‎1012' class='addboxinput inputfocus' value='$ZD_GongXianZhi2020827‎16‎‎40‎‎1012'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎40‎‎1012_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎40‎‎142964'>
		                        <li style='text-align:right;width:220px'>②积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎142964' id='ZD_JiFen2020827‎16‎‎40‎‎142964' class='addboxinput inputfocus' value='$ZD_JiFen2020827‎16‎‎40‎‎142964'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎40‎‎142964_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎40‎‎252196'>
		                        <li style='text-align:right;width:220px'>③贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎252196' id='ZD_GongXianZhi2020827‎16‎‎40‎‎252196' class='addboxinput inputfocus' value='$ZD_GongXianZhi2020827‎16‎‎40‎‎252196'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎40‎‎252196_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎40‎‎332199'>
		                        <li style='text-align:right;width:220px'>③积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎332199' id='ZD_JiFen2020827‎16‎‎40‎‎332199' class='addboxinput inputfocus' value='$ZD_JiFen2020827‎16‎‎40‎‎332199'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎40‎‎332199_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎40‎‎402031'>
		                        <li style='text-align:right;width:220px'>④贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎402031' id='ZD_GongXianZhi2020827‎16‎‎40‎‎402031' class='addboxinput inputfocus' value='$ZD_GongXianZhi2020827‎16‎‎40‎‎402031'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎40‎‎402031_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎40‎‎46924'>
		                        <li style='text-align:right;width:220px'>④积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎46924' id='ZD_JiFen2020827‎16‎‎40‎‎46924' class='addboxinput inputfocus' value='$ZD_JiFen2020827‎16‎‎40‎‎46924'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎40‎‎46924_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎41‎‎00300'>
		                        <li style='text-align:right;width:220px'>⑤贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎00300' id='ZD_GongXianZhi2020827‎16‎‎41‎‎00300' class='addboxinput inputfocus' value='$ZD_GongXianZhi2020827‎16‎‎41‎‎00300'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎00300_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎41‎‎12810'>
		                        <li style='text-align:right;width:220px'>⑤积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎12810' id='ZD_JiFen2020827‎16‎‎41‎‎12810' class='addboxinput inputfocus' value='$ZD_JiFen2020827‎16‎‎41‎‎12810'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎12810_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎41‎‎24450'>
		                        <li style='text-align:right;width:220px'>⑥贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎24450' id='ZD_GongXianZhi2020827‎16‎‎41‎‎24450' class='addboxinput inputfocus' value='$ZD_GongXianZhi2020827‎16‎‎41‎‎24450'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎24450_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎56‎‎012850'>
		                        <li style='text-align:right;width:220px'>⑥积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎56‎‎012850' id='ZD_JiFen2020827‎16‎‎56‎‎012850' class='addboxinput inputfocus' value='$ZD_JiFen2020827‎16‎‎56‎‎012850'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎56‎‎012850_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎54‎‎322661'>
		                        <li style='text-align:right;width:220px'>⑦贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎54‎‎322661' id='ZD_GongXianZhi2020827‎16‎‎54‎‎322661' class='addboxinput inputfocus' value='$ZD_GongXianZhi2020827‎16‎‎54‎‎322661'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎54‎‎322661_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎41‎‎331482'>
		                        <li style='text-align:right;width:220px'>⑦积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎331482' id='ZD_JiFen2020827‎16‎‎41‎‎331482' class='addboxinput inputfocus' value='$ZD_JiFen2020827‎16‎‎41‎‎331482'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎331482_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎41‎‎42138'>
		                        <li style='text-align:right;width:220px'>⑧贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎42138' id='ZD_GongXianZhi2020827‎16‎‎41‎‎42138' class='addboxinput inputfocus' value='$ZD_GongXianZhi2020827‎16‎‎41‎‎42138'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎42138_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎41‎‎462247'>
		                        <li style='text-align:right;width:220px'>⑧积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎462247' id='ZD_JiFen2020827‎16‎‎41‎‎462247' class='addboxinput inputfocus' value='$ZD_JiFen2020827‎16‎‎41‎‎462247'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎462247_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎41‎‎531791'>
		                        <li style='text-align:right;width:220px'>⑨贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎531791' id='ZD_GongXianZhi2020827‎16‎‎41‎‎531791' class='addboxinput inputfocus' value='$ZD_GongXianZhi2020827‎16‎‎41‎‎531791'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎531791_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎41‎‎572919'>
		                        <li style='text-align:right;width:220px'>⑨积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎572919' id='ZD_JiFen2020827‎16‎‎41‎‎572919' class='addboxinput inputfocus' value='$ZD_JiFen2020827‎16‎‎41‎‎572919'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎572919_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎46‎‎12927'>
		                        <li style='text-align:right;width:220px'>⑩贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎12927' id='ZD_GongXianZhi2020827‎16‎‎46‎‎12927' class='addboxinput inputfocus' value='$ZD_GongXianZhi2020827‎16‎‎46‎‎12927'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎46‎‎12927_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎46‎‎172175'>
		                        <li style='text-align:right;width:220px'>⑩积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎172175' id='ZD_JiFen2020827‎16‎‎46‎‎172175' class='addboxinput inputfocus' value='$ZD_JiFen2020827‎16‎‎46‎‎172175'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎46‎‎172175_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎46‎‎241170'>
		                        <li style='text-align:right;width:220px'>⑪贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎241170' id='ZD_GongXianZhi2020827‎16‎‎46‎‎241170' class='addboxinput inputfocus' value='$ZD_GongXianZhi2020827‎16‎‎46‎‎241170'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎46‎‎241170_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎46‎‎301743'>
		                        <li style='text-align:right;width:220px'>⑪积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎301743' id='ZD_JiFen2020827‎16‎‎46‎‎301743' class='addboxinput inputfocus' value='$ZD_JiFen2020827‎16‎‎46‎‎301743'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎46‎‎301743_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎46‎‎361122'>
		                        <li style='text-align:right;width:220px'>⑫贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎361122' id='ZD_GongXianZhi2020827‎16‎‎46‎‎361122' class='addboxinput inputfocus' value='$ZD_GongXianZhi2020827‎16‎‎46‎‎361122'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎46‎‎361122_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎46‎‎4115'>
		                        <li style='text-align:right;width:220px'>⑫积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎4115' id='ZD_JiFen2020827‎16‎‎46‎‎4115' class='addboxinput inputfocus' value='$ZD_JiFen2020827‎16‎‎46‎‎4115'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎46‎‎4115_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZongGongXianZhi'>
		                        <li style='text-align:right;width:220px'>总贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZongGongXianZhi' id='ZD_ZongGongXianZhi' class='addboxinput inputfocus' value='$ZD_ZongGongXianZhi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZongGongXianZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZongJiFen'>
		                        <li style='text-align:right;width:220px'>总积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZongJiFen' id='ZD_ZongJiFen' class='addboxinput inputfocus' value='$ZD_ZongJiFen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZongJiFen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HeJi'>
		                        <li style='text-align:right;width:220px'>合计:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_HeJi' id='ZD_HeJi' class='addboxinput inputfocus' value='$ZD_HeJi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HeJi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BeiZhu'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus' value='$ZD_BeiZhu'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BeiZhu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "504") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingMing,ZD_GongXianZhi,ZD_JiFen,ZD_GongXianZhi2020827‎16‎‎40‎‎1012,ZD_JiFen2020827‎16‎‎40‎‎142964,ZD_GongXianZhi2020827‎16‎‎40‎‎252196,ZD_JiFen2020827‎16‎‎40‎‎332199,ZD_GongXianZhi2020827‎16‎‎40‎‎402031,ZD_JiFen2020827‎16‎‎40‎‎46924,ZD_GongXianZhi2020827‎16‎‎41‎‎00300,ZD_JiFen2020827‎16‎‎41‎‎12810,ZD_GongXianZhi2020827‎16‎‎41‎‎24450,ZD_JiFen2020827‎16‎‎56‎‎012850,ZD_GongXianZhi2020827‎16‎‎54‎‎322661,ZD_JiFen2020827‎16‎‎41‎‎331482,ZD_GongXianZhi2020827‎16‎‎41‎‎42138,ZD_JiFen2020827‎16‎‎41‎‎462247,ZD_GongXianZhi2020827‎16‎‎41‎‎531791,ZD_JiFen2020827‎16‎‎41‎‎572919,ZD_GongXianZhi2020827‎16‎‎46‎‎12927,ZD_JiFen2020827‎16‎‎46‎‎172175,ZD_GongXianZhi2020827‎16‎‎46‎‎241170,ZD_JiFen2020827‎16‎‎46‎‎301743,ZD_GongXianZhi2020827‎16‎‎46‎‎361122,ZD_JiFen2020827‎16‎‎46‎‎4115,ZD_ZongGongXianZhi,ZD_ZongJiFen,ZD_HeJi,ZD_BeiZhu'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='SQP_GongXianZhi' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='504' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_GongXianZhi','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','id');form_weikong('#post_form','DeskMenuDiv504');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>