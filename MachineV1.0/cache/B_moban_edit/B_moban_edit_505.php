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
		
	    $zu_all_list="458=10月,459=11月,460=12月,441=1月,440=2月,437=3月,436=4月,435=5月,454=6月,455=7月,456=8月,457=9月,";
	    $sql = 'select * From `SQP_ChuChaShiJianHuiZong` where `id`='.$strmk_id;
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
	                         <ul zd='ZD_NianFen'>
		                        <li style='text-align:right;width:220px'>年份:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_NianFen' id='ZD_NianFen' class='addboxinput inputfocus'  value='$row[ZD_NianFen]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_NianFen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_1Ri'>
		                        <li style='text-align:right;width:220px'>1日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_1Ri' id='ZD_1Ri' class='addboxinput inputfocus'  value='$row[ZD_1Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_1Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_2Ri'>
		                        <li style='text-align:right;width:220px'>2日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_2Ri' id='ZD_2Ri' class='addboxinput inputfocus'  value='$row[ZD_2Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_2Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_3Ri'>
		                        <li style='text-align:right;width:220px'>3日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_3Ri' id='ZD_3Ri' class='addboxinput inputfocus'  value='$row[ZD_3Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_3Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_4Ri'>
		                        <li style='text-align:right;width:220px'>4日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_4Ri' id='ZD_4Ri' class='addboxinput inputfocus'  value='$row[ZD_4Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_4Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_5Ri'>
		                        <li style='text-align:right;width:220px'>5日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_5Ri' id='ZD_5Ri' class='addboxinput inputfocus'  value='$row[ZD_5Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_5Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_6Ri'>
		                        <li style='text-align:right;width:220px'>6日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_6Ri' id='ZD_6Ri' class='addboxinput inputfocus'  value='$row[ZD_6Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_6Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_7Ri'>
		                        <li style='text-align:right;width:220px'>7日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_7Ri' id='ZD_7Ri' class='addboxinput inputfocus'  value='$row[ZD_7Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_7Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_8Ri'>
		                        <li style='text-align:right;width:220px'>8日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_8Ri' id='ZD_8Ri' class='addboxinput inputfocus'  value='$row[ZD_8Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_8Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_9Ri'>
		                        <li style='text-align:right;width:220px'>9日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_9Ri' id='ZD_9Ri' class='addboxinput inputfocus'  value='$row[ZD_9Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_9Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_10Ri'>
		                        <li style='text-align:right;width:220px'>10日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_10Ri' id='ZD_10Ri' class='addboxinput inputfocus'  value='$row[ZD_10Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_10Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_11Ri'>
		                        <li style='text-align:right;width:220px'>11日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_11Ri' id='ZD_11Ri' class='addboxinput inputfocus'  value='$row[ZD_11Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_11Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_12Ri'>
		                        <li style='text-align:right;width:220px'>12日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_12Ri' id='ZD_12Ri' class='addboxinput inputfocus'  value='$row[ZD_12Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_12Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_13Ri'>
		                        <li style='text-align:right;width:220px'>13日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_13Ri' id='ZD_13Ri' class='addboxinput inputfocus'  value='$row[ZD_13Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_13Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_14Ri'>
		                        <li style='text-align:right;width:220px'>14日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_14Ri' id='ZD_14Ri' class='addboxinput inputfocus'  value='$row[ZD_14Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_14Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_15Ri'>
		                        <li style='text-align:right;width:220px'>15日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_15Ri' id='ZD_15Ri' class='addboxinput inputfocus'  value='$row[ZD_15Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_15Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_16Ri'>
		                        <li style='text-align:right;width:220px'>16日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_16Ri' id='ZD_16Ri' class='addboxinput inputfocus'  value='$row[ZD_16Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_16Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_17Ri'>
		                        <li style='text-align:right;width:220px'>17日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_17Ri' id='ZD_17Ri' class='addboxinput inputfocus'  value='$row[ZD_17Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_17Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_18Ri'>
		                        <li style='text-align:right;width:220px'>18日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_18Ri' id='ZD_18Ri' class='addboxinput inputfocus'  value='$row[ZD_18Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_18Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_19Ri'>
		                        <li style='text-align:right;width:220px'>19日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_19Ri' id='ZD_19Ri' class='addboxinput inputfocus'  value='$row[ZD_19Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_19Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_20Ri'>
		                        <li style='text-align:right;width:220px'>20日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_20Ri' id='ZD_20Ri' class='addboxinput inputfocus'  value='$row[ZD_20Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_20Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_21Ri'>
		                        <li style='text-align:right;width:220px'>21日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_21Ri' id='ZD_21Ri' class='addboxinput inputfocus'  value='$row[ZD_21Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_21Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_22Ri'>
		                        <li style='text-align:right;width:220px'>22日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_22Ri' id='ZD_22Ri' class='addboxinput inputfocus'  value='$row[ZD_22Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_22Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_23Ri'>
		                        <li style='text-align:right;width:220px'>23日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_23Ri' id='ZD_23Ri' class='addboxinput inputfocus'  value='$row[ZD_23Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_23Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_24Ri'>
		                        <li style='text-align:right;width:220px'>24日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_24Ri' id='ZD_24Ri' class='addboxinput inputfocus'  value='$row[ZD_24Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_24Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_25Ri'>
		                        <li style='text-align:right;width:220px'>25日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_25Ri' id='ZD_25Ri' class='addboxinput inputfocus'  value='$row[ZD_25Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_25Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_26Ri'>
		                        <li style='text-align:right;width:220px'>26日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_26Ri' id='ZD_26Ri' class='addboxinput inputfocus'  value='$row[ZD_26Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_26Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_27Ri'>
		                        <li style='text-align:right;width:220px'>27日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_27Ri' id='ZD_27Ri' class='addboxinput inputfocus'  value='$row[ZD_27Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_27Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_28Ri'>
		                        <li style='text-align:right;width:220px'>28日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_28Ri' id='ZD_28Ri' class='addboxinput inputfocus'  value='$row[ZD_28Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_28Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_29Ri'>
		                        <li style='text-align:right;width:220px'>29日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_29Ri' id='ZD_29Ri' class='addboxinput inputfocus'  value='$row[ZD_29Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_29Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_30Ri'>
		                        <li style='text-align:right;width:220px'>30日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_30Ri' id='ZD_30Ri' class='addboxinput inputfocus'  value='$row[ZD_30Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_30Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_31Ri'>
		                        <li style='text-align:right;width:220px'>31日:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_31Ri' id='ZD_31Ri' class='addboxinput inputfocus'  value='$row[ZD_31Ri]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_31Ri_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongJiTian'>
		                        <li style='text-align:right;width:220px'>共计（天）:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongJiTian' id='ZD_GongJiTian' class='addboxinput inputfocus'  value='$row[ZD_GongJiTian]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongJiTian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ChuChaBuTie'>
		                        <li style='text-align:right;width:220px'>出差补贴:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ChuChaBuTie' id='ZD_ChuChaBuTie' class='addboxinput inputfocus'  value='$row[ZD_ChuChaBuTie]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ChuChaBuTie_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BeiZhu'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$row[ZD_BeiZhu]</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BeiZhu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingMing,ZD_NianFen,ZD_1Ri,ZD_2Ri,ZD_3Ri,ZD_4Ri,ZD_5Ri,ZD_6Ri,ZD_7Ri,ZD_8Ri,ZD_9Ri,ZD_10Ri,ZD_11Ri,ZD_12Ri,ZD_13Ri,ZD_14Ri,ZD_15Ri,ZD_16Ri,ZD_17Ri,ZD_18Ri,ZD_19Ri,ZD_20Ri,ZD_21Ri,ZD_22Ri,ZD_23Ri,ZD_24Ri,ZD_25Ri,ZD_26Ri,ZD_27Ri,ZD_28Ri,ZD_29Ri,ZD_30Ri,ZD_31Ri,ZD_GongJiTian,ZD_ChuChaBuTie,ZD_BeiZhu'/>";
if ( strpos($const_q_xiug, "505") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='id' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='505' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_ChuChaShiJianHuiZong','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','id');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv505_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
 echo( "<script>ListLoadEND('$ToHtmlID');</script>" );
mysqli_close( $Conn ); //关闭数据库

?>