<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_KeHuZhengShuGuanLi";
		$sys_re_id_02="510";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_KeHuZhengShuGuanLi` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_ZhengShuHao=$row["ZD_ZhengShuHao"];
		$sys_gx_id_321=$row["sys_gx_id_321"];
		$ZD_KeHuMingChen=$row["ZD_KeHuMingChen"];
		$ZD_XiangMu=$row["ZD_XiangMu"];
		$ZD_ChuShenShiJian=$row["ZD_ChuShenShiJian"];
		$ZD_JianShiJian=$row["ZD_JianShiJian"];
		$ZD_JianShiJian1629904411348=$row["ZD_JianShiJian1629904411348"];
		$ZD_HuanZhengShiJian=$row["ZD_HuanZhengShiJian"];
		$ZD_RenZhengFanWei=$row["ZD_RenZhengFanWei"];
		$ZD_LianXiRen=$row["ZD_LianXiRen"];
		$ZD_DianHua=$row["ZD_DianHua"];
		$ZD_GongSiDiZhi=$row["ZD_GongSiDiZhi"];
		$ZD_XiangMuFuZeRen=$row["ZD_XiangMuFuZeRen"];
		$ZD_RenZhengFei=$row["ZD_RenZhengFei"];
		$ZD_ZiXunFei=$row["ZD_ZiXunFei"];
		$sys_gx_id_423=$row["sys_gx_id_423"];
		$ZD_GenJinYueFen=$row["ZD_GenJinYueFen"];
		$sys_id_zu=$row["sys_id_zu"];
		$ZD_RenZhengJiGou=$row["ZD_RenZhengJiGou"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_ZhengShuHao="";
		$sys_gx_id_321="";
		$ZD_KeHuMingChen="";
		$ZD_XiangMu="";
		$ZD_ChuShenShiJian="";
		$ZD_JianShiJian="";
		$ZD_JianShiJian1629904411348="";
		$ZD_HuanZhengShiJian="";
		$ZD_RenZhengFanWei="";
		$ZD_LianXiRen="";
		$ZD_DianHua="";
		$ZD_GongSiDiZhi="";
		$ZD_XiangMuFuZeRen="";
		$ZD_RenZhengFei="";
		$ZD_ZiXunFei="";
		$sys_gx_id_423="";
		$ZD_GenJinYueFen="";
		$sys_id_zu="";
		$ZD_RenZhengJiGou="";

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
	                         <ul zd='ZD_ZhengShuHao'>
		                        <li style='text-align:right;width:220px'>证书号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZhengShuHao' id='ZD_ZhengShuHao' class='addboxinput inputfocus' value='$ZD_ZhengShuHao'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZhengShuHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_321'>
		                        <li style='text-align:right;width:220px'>[关系]顾客档案表ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_321' id='sys_gx_id_321' class='addboxinput inputfocus' value='$sys_gx_id_321'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_321_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_321','34','SQP_KeHuZhengShuGuanLi','DeskMenuDiv510');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_KeHuMingChen'>
		                        <li style='text-align:right;width:220px'>客户名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_KeHuMingChen' id='ZD_KeHuMingChen' class='addboxinput inputfocus' value='$ZD_KeHuMingChen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_KeHuMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XiangMu'>
		                        <li style='text-align:right;width:220px'>项目:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XiangMu' id='ZD_XiangMu' class='addboxinput inputfocus' value='$ZD_XiangMu'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XiangMu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZiXunFei'>
		                        <li style='text-align:right;width:220px'>104:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZiXunFei' id='ZD_ZiXunFei' class='addboxinput inputfocus' value='$ZD_ZiXunFei'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZiXunFei_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GenJinYueFen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;跟进月份:</li>
                                
		                        <li style='width:40%' class='reset_list'>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_0' tit='$ZD_GenJinYueFen' cnval='1月' value='$ZD_GenJinYueFen' valid='1月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >1月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_1' tit='$ZD_GenJinYueFen' cnval='2月' value='$ZD_GenJinYueFen' valid='2月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >2月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_2' tit='$ZD_GenJinYueFen' cnval='3月' value='$ZD_GenJinYueFen' valid='3月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >3月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_3' tit='$ZD_GenJinYueFen' cnval='4月' value='$ZD_GenJinYueFen' valid='4月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >4月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_4' tit='$ZD_GenJinYueFen' cnval='5月' value='$ZD_GenJinYueFen' valid='5月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >5月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_5' tit='$ZD_GenJinYueFen' cnval='6月' value='$ZD_GenJinYueFen' valid='6月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >6月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_6' tit='$ZD_GenJinYueFen' cnval='7月' value='$ZD_GenJinYueFen' valid='7月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >7月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_7' tit='$ZD_GenJinYueFen' cnval='8月' value='$ZD_GenJinYueFen' valid='8月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >8月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_8' tit='$ZD_GenJinYueFen' cnval='9月' value='$ZD_GenJinYueFen' valid='9月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >9月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_9' tit='$ZD_GenJinYueFen' cnval='10月' value='$ZD_GenJinYueFen' valid='10月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >10月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_10' tit='$ZD_GenJinYueFen' cnval='11月' value='$ZD_GenJinYueFen' valid='11月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >11月&nbsp;</label>
            <label><input type='checkbox' typeid='27'  name='ZD_GenJinYueFen'  id='ZD_GenJinYueFen_11' tit='$ZD_GenJinYueFen' cnval='12月' value='$ZD_GenJinYueFen' valid='12月' valstr='' class='addboxinput inputfocus'   onchange=\"checkbox_morechecked(this)\"  >12月&nbsp;</label>
            
            <script>Inputdate('ZD_GenJinYueFen','15','$ZD_GenJinYueFen','DeskMenuDiv510','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GenJinYueFen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_RenZhengJiGou'>
		                        <li style='text-align:right;width:220px'>认证机构:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_RenZhengJiGou' id='ZD_RenZhengJiGou' class='addboxinput inputfocus' value='$ZD_RenZhengJiGou'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_RenZhengJiGou_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ChuShenShiJian'>
		                        <li style='text-align:right;width:220px'>初审时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ChuShenShiJian' id='ZD_ChuShenShiJian' class='addboxinput inputfocus' value='$ZD_ChuShenShiJian'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ChuShenShiJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JianShiJian'>
		                        <li style='text-align:right;width:220px'>监①时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JianShiJian' id='ZD_JianShiJian' class='addboxinput inputfocus' value='$ZD_JianShiJian'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JianShiJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JianShiJian1629904411348'>
		                        <li style='text-align:right;width:220px'>监②时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JianShiJian1629904411348' id='ZD_JianShiJian1629904411348' class='addboxinput inputfocus' value='$ZD_JianShiJian1629904411348'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JianShiJian1629904411348_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HuanZhengShiJian'>
		                        <li style='text-align:right;width:220px'>换证时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_HuanZhengShiJian' id='ZD_HuanZhengShiJian' class='addboxinput inputfocus' value='$ZD_HuanZhengShiJian'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HuanZhengShiJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_RenZhengFanWei'>
		                        <li style='text-align:right;width:220px'>认证范围:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_RenZhengFanWei' id='ZD_RenZhengFanWei' class='addboxinput inputfocus' value='$ZD_RenZhengFanWei'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_RenZhengFanWei_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_LianXiRen'>
		                        <li style='text-align:right;width:220px'>联系人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_LianXiRen' id='ZD_LianXiRen' class='addboxinput inputfocus' value='$ZD_LianXiRen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_LianXiRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_DianHua'>
		                        <li style='text-align:right;width:220px'>电话:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_DianHua' id='ZD_DianHua' class='addboxinput inputfocus' value='$ZD_DianHua'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_DianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongSiDiZhi'>
		                        <li style='text-align:right;width:220px'>公司地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSiDiZhi' id='ZD_GongSiDiZhi' class='addboxinput inputfocus' value='$ZD_GongSiDiZhi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSiDiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XiangMuFuZeRen'>
		                        <li style='text-align:right;width:220px'>项目负责人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XiangMuFuZeRen' id='ZD_XiangMuFuZeRen' class='addboxinput inputfocus' value='$ZD_XiangMuFuZeRen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XiangMuFuZeRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_RenZhengFei'>
		                        <li style='text-align:right;width:220px'>认证费:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_RenZhengFei' id='ZD_RenZhengFei' class='addboxinput inputfocus' value='$ZD_RenZhengFei'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_RenZhengFei_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_423'>
		                        <li style='text-align:right;width:220px'>[关系]顾客合同ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_423' id='sys_gx_id_423' class='addboxinput inputfocus' value='$sys_gx_id_423'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_423_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_423','28','SQP_KeHuZhengShuGuanLi','DeskMenuDiv510');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_id_zu'>
		                        <li style='text-align:right;width:220px'>分类:</li>
                                
		                        <li style='width:40%' class='reset_list'>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu1' tit='$sys_id_zu' cnval='撤消' value='$sys_id_zu' valid='487' valstr='' class='addboxinput inputfocus' >撤消&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu2' tit='$sys_id_zu' cnval='暂停' value='$sys_id_zu' valid='486' valstr='' class='addboxinput inputfocus' >暂停&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu3' tit='$sys_id_zu' cnval='有效' value='$sys_id_zu' valid='492' valstr='' class='addboxinput inputfocus' >有效&nbsp;</label><script>Inputdate('sys_id_zu','15','$sys_id_zu','DeskMenuDiv510','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_id_zu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "510") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_ZhengShuHao,sys_gx_id_321,ZD_KeHuMingChen,ZD_XiangMu,ZD_ChuShenShiJian,ZD_JianShiJian,ZD_JianShiJian1629904411348,ZD_HuanZhengShiJian,ZD_RenZhengFanWei,ZD_LianXiRen,ZD_DianHua,ZD_GongSiDiZhi,ZD_XiangMuFuZeRen,ZD_RenZhengFei,ZD_ZiXunFei,sys_gx_id_423,ZD_GenJinYueFen,sys_id_zu,ZD_RenZhengJiGou'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='ZD_ZhengShuHao' bitian_Arry='ZD_GenJinYueFen' databiao='SQP_KeHuZhengShuGuanLi' Wuchongfu_Arry='ZD_ZiXunFei'  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='510' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'ZD_ZiXunFei','SQP_KeHuZhengShuGuanLi','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','ZD_ZhengShuHao');form_weikong('#post_form','DeskMenuDiv510');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>