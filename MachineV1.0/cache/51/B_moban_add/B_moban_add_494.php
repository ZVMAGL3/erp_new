<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_QingJiaDiaoXiuJiaBanWaiChuDan";
		$sys_re_id_02="494";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_QingJiaDiaoXiuJiaBanWaiChuDan` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZhiWu=$row["ZhiWu"];
		$ZD_ShenQingRen=$row["ZD_ShenQingRen"];
		$sys_id_zu=$row["sys_id_zu"];
		$ZD_ShenQingShiJian=$row["ZD_ShenQingShiJian"];
		$ShiYou=$row["ShiYou"];
		$ZD_BeiZhu=$row["ZD_BeiZhu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZhiWu="$const_q_zu-($bumen_id)";
		$ZD_ShenQingRen="$SYS_UserName-($bh)";
		$sys_id_zu="";
		$ZD_ShenQingShiJian="$nowdate";
		$ShiYou="";
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
	                         <ul zd='ZhiWu'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;职务:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='24' name='ZhiWu' id='ZhiWu' class='addboxinput inputfocus'   value='$ZhiWu'    readonly='readonly' /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZhiWu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenQingRen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;申请人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='23' name='ZD_ShenQingRen' id='ZD_ShenQingRen' class='addboxinput inputfocus'   value='$ZD_ShenQingRen'    readonly='readonly' /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenQingRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenQingShiJian'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;申请时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='25' name='ZD_ShenQingShiJian' id='ZD_ShenQingShiJian' class='addboxinput inputfocus'   value='$ZD_ShenQingShiJian'    readonly='readonly' /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenQingShiJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_id_zu'>
		                        <li style='text-align:right;width:220px'>分类:</li>
                                
		                        <li style='width:40%' class='reset_list'>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu1' tit='$sys_id_zu' cnval='丧假' value='$sys_id_zu' valid='394' valstr='' class='addboxinput inputfocus' >丧假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu2' tit='$sys_id_zu' cnval='事假' value='$sys_id_zu' valid='390' valstr='' class='addboxinput inputfocus' >事假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu3' tit='$sys_id_zu' cnval='产假' value='$sys_id_zu' valid='393' valstr='' class='addboxinput inputfocus' >产假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu4' tit='$sys_id_zu' cnval='出差' value='$sys_id_zu' valid='398' valstr='' class='addboxinput inputfocus' >出差&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu5' tit='$sys_id_zu' cnval='加班' value='$sys_id_zu' valid='396' valstr='' class='addboxinput inputfocus' >加班&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu6' tit='$sys_id_zu' cnval='外出' value='$sys_id_zu' valid='400' valstr='' class='addboxinput inputfocus' >外出&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu7' tit='$sys_id_zu' cnval='婚假' value='$sys_id_zu' valid='391' valstr='' class='addboxinput inputfocus' >婚假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu8' tit='$sys_id_zu' cnval='审核' value='$sys_id_zu' valid='397' valstr='' class='addboxinput inputfocus' >审核&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu9' tit='$sys_id_zu' cnval='年假' value='$sys_id_zu' valid='392' valstr='' class='addboxinput inputfocus' >年假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu10' tit='$sys_id_zu' cnval='病假' value='$sys_id_zu' valid='434' valstr='' class='addboxinput inputfocus' >病假&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu11' tit='$sys_id_zu' cnval='调休' value='$sys_id_zu' valid='395' valstr='' class='addboxinput inputfocus' >调休&nbsp;</label><script>Inputdate('sys_id_zu','15','$sys_id_zu','DeskMenuDiv494','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_id_zu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ShiYou'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;事由:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ShiYou' id='ShiYou' class='addboxinput inputfocus' 25px;'   >$ShiYou</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ShiYou_bitian'></li>
                                
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
if ( strpos($const_q_tianj, "494") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZhiWu,ZD_ShenQingRen,sys_id_zu,ZD_ShenQingShiJian,ShiYou,ZD_BeiZhu'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='ZhiWu,ZD_ShenQingRen,ZD_ShenQingShiJian,ShiYou' databiao='SQP_QingJiaDiaoXiuJiaBanWaiChuDan' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='494' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_QingJiaDiaoXiuJiaBanWaiChuDan','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','sys_nowbh');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>