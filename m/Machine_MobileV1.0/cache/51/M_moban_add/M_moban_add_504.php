<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'M_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
	    if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                                //1回收站0为不回收
	    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                               //是否为回收站0为不回收
	   
	    global $strmk_id,$Conn,$const_q_tianj;
	

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
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>姓名:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XingMing' id='ZD_XingMing' class='addboxinput inputfocus' value='<?php echo $ZD_XingMing ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XingMing_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>①贡献值:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi' id='ZD_GongXianZhi' class='addboxinput inputfocus' value='<?php echo $ZD_GongXianZhi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>①积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen' id='ZD_JiFen' class='addboxinput inputfocus' value='<?php echo $ZD_JiFen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiFen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>②贡献值:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎1012' id='ZD_GongXianZhi2020827‎16‎‎40‎‎1012' class='addboxinput inputfocus' value='<?php echo $ZD_GongXianZhi2020827‎16‎‎40‎‎1012 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎40‎‎1012_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>②积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎142964' id='ZD_JiFen2020827‎16‎‎40‎‎142964' class='addboxinput inputfocus' value='<?php echo $ZD_JiFen2020827‎16‎‎40‎‎142964 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎40‎‎142964_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>③贡献值:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎252196' id='ZD_GongXianZhi2020827‎16‎‎40‎‎252196' class='addboxinput inputfocus' value='<?php echo $ZD_GongXianZhi2020827‎16‎‎40‎‎252196 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎40‎‎252196_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>③积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎332199' id='ZD_JiFen2020827‎16‎‎40‎‎332199' class='addboxinput inputfocus' value='<?php echo $ZD_JiFen2020827‎16‎‎40‎‎332199 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎40‎‎332199_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>④贡献值:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎402031' id='ZD_GongXianZhi2020827‎16‎‎40‎‎402031' class='addboxinput inputfocus' value='<?php echo $ZD_GongXianZhi2020827‎16‎‎40‎‎402031 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎40‎‎402031_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>④积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎46924' id='ZD_JiFen2020827‎16‎‎40‎‎46924' class='addboxinput inputfocus' value='<?php echo $ZD_JiFen2020827‎16‎‎40‎‎46924 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎40‎‎46924_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑤贡献值:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎00300' id='ZD_GongXianZhi2020827‎16‎‎41‎‎00300' class='addboxinput inputfocus' value='<?php echo $ZD_GongXianZhi2020827‎16‎‎41‎‎00300 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎00300_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑤积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎12810' id='ZD_JiFen2020827‎16‎‎41‎‎12810' class='addboxinput inputfocus' value='<?php echo $ZD_JiFen2020827‎16‎‎41‎‎12810 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎12810_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑥贡献值:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎24450' id='ZD_GongXianZhi2020827‎16‎‎41‎‎24450' class='addboxinput inputfocus' value='<?php echo $ZD_GongXianZhi2020827‎16‎‎41‎‎24450 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎24450_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑥积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎56‎‎012850' id='ZD_JiFen2020827‎16‎‎56‎‎012850' class='addboxinput inputfocus' value='<?php echo $ZD_JiFen2020827‎16‎‎56‎‎012850 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎56‎‎012850_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑦贡献值:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎54‎‎322661' id='ZD_GongXianZhi2020827‎16‎‎54‎‎322661' class='addboxinput inputfocus' value='<?php echo $ZD_GongXianZhi2020827‎16‎‎54‎‎322661 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎54‎‎322661_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑦积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎331482' id='ZD_JiFen2020827‎16‎‎41‎‎331482' class='addboxinput inputfocus' value='<?php echo $ZD_JiFen2020827‎16‎‎41‎‎331482 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎331482_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑧贡献值:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎42138' id='ZD_GongXianZhi2020827‎16‎‎41‎‎42138' class='addboxinput inputfocus' value='<?php echo $ZD_GongXianZhi2020827‎16‎‎41‎‎42138 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎42138_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑧积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎462247' id='ZD_JiFen2020827‎16‎‎41‎‎462247' class='addboxinput inputfocus' value='<?php echo $ZD_JiFen2020827‎16‎‎41‎‎462247 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎462247_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑨贡献值:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎531791' id='ZD_GongXianZhi2020827‎16‎‎41‎‎531791' class='addboxinput inputfocus' value='<?php echo $ZD_GongXianZhi2020827‎16‎‎41‎‎531791 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎41‎‎531791_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑨积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎572919' id='ZD_JiFen2020827‎16‎‎41‎‎572919' class='addboxinput inputfocus' value='<?php echo $ZD_JiFen2020827‎16‎‎41‎‎572919 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎41‎‎572919_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑩贡献值:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎12927' id='ZD_GongXianZhi2020827‎16‎‎46‎‎12927' class='addboxinput inputfocus' value='<?php echo $ZD_GongXianZhi2020827‎16‎‎46‎‎12927 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎46‎‎12927_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑩积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎172175' id='ZD_JiFen2020827‎16‎‎46‎‎172175' class='addboxinput inputfocus' value='<?php echo $ZD_JiFen2020827‎16‎‎46‎‎172175 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎46‎‎172175_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑪贡献值:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎241170' id='ZD_GongXianZhi2020827‎16‎‎46‎‎241170' class='addboxinput inputfocus' value='<?php echo $ZD_GongXianZhi2020827‎16‎‎46‎‎241170 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎46‎‎241170_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑪积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎301743' id='ZD_JiFen2020827‎16‎‎46‎‎301743' class='addboxinput inputfocus' value='<?php echo $ZD_JiFen2020827‎16‎‎46‎‎301743 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎46‎‎301743_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑫贡献值:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎361122' id='ZD_GongXianZhi2020827‎16‎‎46‎‎361122' class='addboxinput inputfocus' value='<?php echo $ZD_GongXianZhi2020827‎16‎‎46‎‎361122 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_GongXianZhi2020827‎16‎‎46‎‎361122_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>⑫积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎4115' id='ZD_JiFen2020827‎16‎‎46‎‎4115' class='addboxinput inputfocus' value='<?php echo $ZD_JiFen2020827‎16‎‎46‎‎4115 ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiFen2020827‎16‎‎46‎‎4115_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>总贡献值:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZongGongXianZhi' id='ZD_ZongGongXianZhi' class='addboxinput inputfocus' value='<?php echo $ZD_ZongGongXianZhi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ZongGongXianZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>总积分:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZongJiFen' id='ZD_ZongJiFen' class='addboxinput inputfocus' value='<?php echo $ZD_ZongJiFen ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ZongJiFen_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>合计:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HeJi' id='ZD_HeJi' class='addboxinput inputfocus' value='<?php echo $ZD_HeJi ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_HeJi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>备注:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus' value='<?php echo $ZD_BeiZhu ?>'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_BeiZhu_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv504',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','id')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingMing,ZD_GongXianZhi,ZD_JiFen,ZD_GongXianZhi2020827‎16‎‎40‎‎1012,ZD_JiFen2020827‎16‎‎40‎‎142964,ZD_GongXianZhi2020827‎16‎‎40‎‎252196,ZD_JiFen2020827‎16‎‎40‎‎332199,ZD_GongXianZhi2020827‎16‎‎40‎‎402031,ZD_JiFen2020827‎16‎‎40‎‎46924,ZD_GongXianZhi2020827‎16‎‎41‎‎00300,ZD_JiFen2020827‎16‎‎41‎‎12810,ZD_GongXianZhi2020827‎16‎‎41‎‎24450,ZD_JiFen2020827‎16‎‎56‎‎012850,ZD_GongXianZhi2020827‎16‎‎54‎‎322661,ZD_JiFen2020827‎16‎‎41‎‎331482,ZD_GongXianZhi2020827‎16‎‎41‎‎42138,ZD_JiFen2020827‎16‎‎41‎‎462247,ZD_GongXianZhi2020827‎16‎‎41‎‎531791,ZD_JiFen2020827‎16‎‎41‎‎572919,ZD_GongXianZhi2020827‎16‎‎46‎‎12927,ZD_JiFen2020827‎16‎‎46‎‎172175,ZD_GongXianZhi2020827‎16‎‎46‎‎241170,ZD_JiFen2020827‎16‎‎46‎‎301743,ZD_GongXianZhi2020827‎16‎‎46‎‎361122,ZD_JiFen2020827‎16‎‎46‎‎4115,ZD_ZongGongXianZhi,ZD_ZongJiFen,ZD_HeJi,ZD_BeiZhu'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='SQP_GongXianZhi' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv504')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='504' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_GongXianZhi','DeskMenuDiv504');form_add_copy('DeskMenuDiv504');inputfocusfirst('#addbox .htmlleirong','id');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>