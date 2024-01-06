<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_JianCeHeCeLiangZiYuanTaiZhang";
		$sys_re_id_02="230";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_JianCeHeCeLiangZiYuanTaiZhang` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$MingChen=$row["MingChen"];
		$GuiGe=$row["GuiGe"];
		$ZhiZaoChangShang=$row["ZhiZaoChangShang"];
		$ChuChangBianHao=$row["ChuChangBianHao"];
		$ShiYongRiQi=$row["ShiYongRiQi"];
		$ShiYongBuMen=$row["ShiYongBuMen"];
		$GuanLiZeRenRen=$row["GuanLiZeRenRen"];
		$BaoFeiRiQi=$row["BaoFeiRiQi"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$MingChen="";
		$GuiGe="";
		$ZhiZaoChangShang="";
		$ChuChangBianHao="";
		$ShiYongRiQi="";
		$ShiYongBuMen="";
		$GuanLiZeRenRen="";
		$BaoFeiRiQi="";

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
	                         <ul zd='MingChen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='MingChen' id='MingChen' class='addboxinput inputfocus' value='$MingChen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='MingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='GuiGe'>
		                        <li style='text-align:right;width:220px'>规格:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='GuiGe' id='GuiGe' class='addboxinput inputfocus' value='$GuiGe'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='GuiGe_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZhiZaoChangShang'>
		                        <li style='text-align:right;width:220px'>制造厂商:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZhiZaoChangShang' id='ZhiZaoChangShang' class='addboxinput inputfocus' value='$ZhiZaoChangShang'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZhiZaoChangShang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ChuChangBianHao'>
		                        <li style='text-align:right;width:220px'>出厂编号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ChuChangBianHao' id='ChuChangBianHao' class='addboxinput inputfocus' value='$ChuChangBianHao'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ChuChangBianHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ShiYongRiQi'>
		                        <li style='text-align:right;width:220px'>始用日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ShiYongRiQi' id='ShiYongRiQi' class='addboxinput inputfocus' value='$ShiYongRiQi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ShiYongRiQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ShiYongBuMen'>
		                        <li style='text-align:right;width:220px'>使用部门:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ShiYongBuMen' id='ShiYongBuMen' class='addboxinput inputfocus' value='$ShiYongBuMen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ShiYongBuMen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='GuanLiZeRenRen'>
		                        <li style='text-align:right;width:220px'>管理责任人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='GuanLiZeRenRen' id='GuanLiZeRenRen' class='addboxinput inputfocus' value='$GuanLiZeRenRen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='GuanLiZeRenRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='BaoFeiRiQi'>
		                        <li style='text-align:right;width:220px'>报废日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='BaoFeiRiQi' id='BaoFeiRiQi' class='addboxinput inputfocus' value='$BaoFeiRiQi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='BaoFeiRiQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "230") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='MingChen,GuiGe,ZhiZaoChangShang,ChuChangBianHao,ShiYongRiQi,ShiYongBuMen,GuanLiZeRenRen,BaoFeiRiQi'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='MingChen' databiao='SQP_JianCeHeCeLiangZiYuanTaiZhang' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='230' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_JianCeHeCeLiangZiYuanTaiZhang','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','sys_nowbh');form_weikong('#post_form','DeskMenuDiv230');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>