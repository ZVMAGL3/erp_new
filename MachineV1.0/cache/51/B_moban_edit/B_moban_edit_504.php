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
	    $sql = 'select * From `SQP_GongXianZhi` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='ZD_XingMing'>
		                        <li style='text-align:right;width:220px'>姓名:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XingMing' id='ZD_XingMing' class='addboxinput inputfocus' value='$row[ZD_XingMing]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingMing_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi'>
		                        <li style='text-align:right;width:220px'>①贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi' id='ZD_GongXianZhi' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen'>
		                        <li style='text-align:right;width:220px'>①积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen' id='ZD_JiFen' class='addboxinput inputfocus' value='$row[ZD_JiFen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎40‎‎1012'>
		                        <li style='text-align:right;width:220px'>②贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎1012' id='ZD_GongXianZhi2020827‎16‎‎40‎‎1012' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎40‎‎1012]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎40‎‎1012_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎40‎‎142964'>
		                        <li style='text-align:right;width:220px'>②积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎142964' id='ZD_JiFen2020827‎16‎‎40‎‎142964' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎40‎‎142964]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎40‎‎142964_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎40‎‎252196'>
		                        <li style='text-align:right;width:220px'>③贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎252196' id='ZD_GongXianZhi2020827‎16‎‎40‎‎252196' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎40‎‎252196]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎40‎‎252196_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎40‎‎332199'>
		                        <li style='text-align:right;width:220px'>③积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎332199' id='ZD_JiFen2020827‎16‎‎40‎‎332199' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎40‎‎332199]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎40‎‎332199_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎40‎‎402031'>
		                        <li style='text-align:right;width:220px'>④贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎402031' id='ZD_GongXianZhi2020827‎16‎‎40‎‎402031' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎40‎‎402031]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎40‎‎402031_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎40‎‎46924'>
		                        <li style='text-align:right;width:220px'>④积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎46924' id='ZD_JiFen2020827‎16‎‎40‎‎46924' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎40‎‎46924]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎40‎‎46924_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎41‎‎00300'>
		                        <li style='text-align:right;width:220px'>⑤贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎00300' id='ZD_GongXianZhi2020827‎16‎‎41‎‎00300' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎41‎‎00300]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎00300_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎41‎‎12810'>
		                        <li style='text-align:right;width:220px'>⑤积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎12810' id='ZD_JiFen2020827‎16‎‎41‎‎12810' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎41‎‎12810]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎12810_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎41‎‎24450'>
		                        <li style='text-align:right;width:220px'>⑥贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎24450' id='ZD_GongXianZhi2020827‎16‎‎41‎‎24450' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎41‎‎24450]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎24450_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎56‎‎012850'>
		                        <li style='text-align:right;width:220px'>⑥积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎56‎‎012850' id='ZD_JiFen2020827‎16‎‎56‎‎012850' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎56‎‎012850]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎56‎‎012850_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎54‎‎322661'>
		                        <li style='text-align:right;width:220px'>⑦贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎54‎‎322661' id='ZD_GongXianZhi2020827‎16‎‎54‎‎322661' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎54‎‎322661]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎54‎‎322661_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎41‎‎331482'>
		                        <li style='text-align:right;width:220px'>⑦积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎331482' id='ZD_JiFen2020827‎16‎‎41‎‎331482' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎41‎‎331482]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎331482_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎41‎‎42138'>
		                        <li style='text-align:right;width:220px'>⑧贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎42138' id='ZD_GongXianZhi2020827‎16‎‎41‎‎42138' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎41‎‎42138]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎42138_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎41‎‎462247'>
		                        <li style='text-align:right;width:220px'>⑧积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎462247' id='ZD_JiFen2020827‎16‎‎41‎‎462247' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎41‎‎462247]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎462247_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎41‎‎531791'>
		                        <li style='text-align:right;width:220px'>⑨贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎531791' id='ZD_GongXianZhi2020827‎16‎‎41‎‎531791' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎41‎‎531791]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎531791_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎41‎‎572919'>
		                        <li style='text-align:right;width:220px'>⑨积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎572919' id='ZD_JiFen2020827‎16‎‎41‎‎572919' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎41‎‎572919]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎572919_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎46‎‎12927'>
		                        <li style='text-align:right;width:220px'>⑩贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎12927' id='ZD_GongXianZhi2020827‎16‎‎46‎‎12927' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎46‎‎12927]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎46‎‎12927_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎46‎‎172175'>
		                        <li style='text-align:right;width:220px'>⑩积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎172175' id='ZD_JiFen2020827‎16‎‎46‎‎172175' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎46‎‎172175]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎46‎‎172175_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎46‎‎241170'>
		                        <li style='text-align:right;width:220px'>⑪贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎241170' id='ZD_GongXianZhi2020827‎16‎‎46‎‎241170' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎46‎‎241170]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎46‎‎241170_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎46‎‎301743'>
		                        <li style='text-align:right;width:220px'>⑪积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎301743' id='ZD_JiFen2020827‎16‎‎46‎‎301743' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎46‎‎301743]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎46‎‎301743_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongXianZhi2020827‎16‎‎46‎‎361122'>
		                        <li style='text-align:right;width:220px'>⑫贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎361122' id='ZD_GongXianZhi2020827‎16‎‎46‎‎361122' class='addboxinput inputfocus' value='$row[ZD_GongXianZhi2020827‎16‎‎46‎‎361122]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎46‎‎361122_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen2020827‎16‎‎46‎‎4115'>
		                        <li style='text-align:right;width:220px'>⑫积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎4115' id='ZD_JiFen2020827‎16‎‎46‎‎4115' class='addboxinput inputfocus' value='$row[ZD_JiFen2020827‎16‎‎46‎‎4115]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen2020827‎16‎‎46‎‎4115_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZongGongXianZhi'>
		                        <li style='text-align:right;width:220px'>总贡献值:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZongGongXianZhi' id='ZD_ZongGongXianZhi' class='addboxinput inputfocus' value='$row[ZD_ZongGongXianZhi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZongGongXianZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZongJiFen'>
		                        <li style='text-align:right;width:220px'>总积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZongJiFen' id='ZD_ZongJiFen' class='addboxinput inputfocus' value='$row[ZD_ZongJiFen]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZongJiFen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HeJi'>
		                        <li style='text-align:right;width:220px'>合计:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_HeJi' id='ZD_HeJi' class='addboxinput inputfocus' value='$row[ZD_HeJi]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HeJi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BeiZhu'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus' value='$row[ZD_BeiZhu]'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BeiZhu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingMing,ZD_GongXianZhi,ZD_JiFen,ZD_GongXianZhi2020827‎16‎‎40‎‎1012,ZD_JiFen2020827‎16‎‎40‎‎142964,ZD_GongXianZhi2020827‎16‎‎40‎‎252196,ZD_JiFen2020827‎16‎‎40‎‎332199,ZD_GongXianZhi2020827‎16‎‎40‎‎402031,ZD_JiFen2020827‎16‎‎40‎‎46924,ZD_GongXianZhi2020827‎16‎‎41‎‎00300,ZD_JiFen2020827‎16‎‎41‎‎12810,ZD_GongXianZhi2020827‎16‎‎41‎‎24450,ZD_JiFen2020827‎16‎‎56‎‎012850,ZD_GongXianZhi2020827‎16‎‎54‎‎322661,ZD_JiFen2020827‎16‎‎41‎‎331482,ZD_GongXianZhi2020827‎16‎‎41‎‎42138,ZD_JiFen2020827‎16‎‎41‎‎462247,ZD_GongXianZhi2020827‎16‎‎41‎‎531791,ZD_JiFen2020827‎16‎‎41‎‎572919,ZD_GongXianZhi2020827‎16‎‎46‎‎12927,ZD_JiFen2020827‎16‎‎46‎‎172175,ZD_GongXianZhi2020827‎16‎‎46‎‎241170,ZD_JiFen2020827‎16‎‎46‎‎301743,ZD_GongXianZhi2020827‎16‎‎46‎‎361122,ZD_JiFen2020827‎16‎‎46‎‎4115,ZD_ZongGongXianZhi,ZD_ZongJiFen,ZD_HeJi,ZD_BeiZhu'/>";
if ( strpos($const_q_xiug, "504") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='504' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_GongXianZhi','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','id');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv504_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
mysqli_close( $Conn ); //关闭数据库

?>