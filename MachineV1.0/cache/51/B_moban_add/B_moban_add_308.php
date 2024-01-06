<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_GuKeCaiChanQingDan";
		$sys_re_id_02="308";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_GuKeCaiChanQingDan` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$sys_gx_id_321=$row["sys_gx_id_321"];
		$ZD_GuKeMingChen=$row["ZD_GuKeMingChen"];
		$ZD_CaiChanMingChen=$row["ZD_CaiChanMingChen"];
		$ZD_XingHaoGuiGe=$row["ZD_XingHaoGuiGe"];
		$ZD_BenChangBianHao=$row["ZD_BenChangBianHao"];
		$ZD_ShuLiang=$row["ZD_ShuLiang"];
		$ZD_JieShouRiQi=$row["ZD_JieShouRiQi"];
		$ZD_ShiYongBuMen=$row["ZD_ShiYongBuMen"];
		$ZD_WanHaoZhuangTai=$row["ZD_WanHaoZhuangTai"];
		$ZD_CunFangDiDian=$row["ZD_CunFangDiDian"];
		$ZD_BaoFeiRiQi=$row["ZD_BaoFeiRiQi"];
		$ZD_BeiZhu=$row["ZD_BeiZhu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$sys_gx_id_321="";
		$ZD_GuKeMingChen="";
		$ZD_CaiChanMingChen="";
		$ZD_XingHaoGuiGe="";
		$ZD_BenChangBianHao="";
		$ZD_ShuLiang="";
		$ZD_JieShouRiQi="";
		$ZD_ShiYongBuMen="";
		$ZD_WanHaoZhuangTai="";
		$ZD_CunFangDiDian="";
		$ZD_BaoFeiRiQi="";
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
	                         <ul zd='sys_gx_id_321'>
		                        <li style='text-align:right;width:220px'>关系字段:sys_gx_id_321:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_321' id='sys_gx_id_321' class='addboxinput inputfocus' value='$sys_gx_id_321'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_321_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_321','21','SQP_GuKeCaiChanQingDan','DeskMenuDiv308');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GuKeMingChen'>
		                        <li style='text-align:right;width:220px'>顾客名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GuKeMingChen' id='ZD_GuKeMingChen' class='addboxinput inputfocus' value='$ZD_GuKeMingChen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GuKeMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_CaiChanMingChen'>
		                        <li style='text-align:right;width:220px'>财产名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_CaiChanMingChen' id='ZD_CaiChanMingChen' class='addboxinput inputfocus' value='$ZD_CaiChanMingChen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_CaiChanMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XingHaoGuiGe'>
		                        <li style='text-align:right;width:220px'>型号/规格:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XingHaoGuiGe' id='ZD_XingHaoGuiGe' class='addboxinput inputfocus' value='$ZD_XingHaoGuiGe'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingHaoGuiGe_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BenChangBianHao'>
		                        <li style='text-align:right;width:220px'>本厂编号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_BenChangBianHao' id='ZD_BenChangBianHao' class='addboxinput inputfocus' value='$ZD_BenChangBianHao'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BenChangBianHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShuLiang'>
		                        <li style='text-align:right;width:220px'>数量:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShuLiang' id='ZD_ShuLiang' class='addboxinput inputfocus' value='$ZD_ShuLiang'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShuLiang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JieShouRiQi'>
		                        <li style='text-align:right;width:220px'>接收日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JieShouRiQi' id='ZD_JieShouRiQi' class='addboxinput inputfocus' value='$ZD_JieShouRiQi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JieShouRiQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShiYongBuMen'>
		                        <li style='text-align:right;width:220px'>使用部门:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShiYongBuMen' id='ZD_ShiYongBuMen' class='addboxinput inputfocus' value='$ZD_ShiYongBuMen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShiYongBuMen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_WanHaoZhuangTai'>
		                        <li style='text-align:right;width:220px'>完好状态:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_WanHaoZhuangTai' id='ZD_WanHaoZhuangTai' class='addboxinput inputfocus' value='$ZD_WanHaoZhuangTai'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_WanHaoZhuangTai_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_CunFangDiDian'>
		                        <li style='text-align:right;width:220px'>存放地点:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_CunFangDiDian' id='ZD_CunFangDiDian' class='addboxinput inputfocus' value='$ZD_CunFangDiDian'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_CunFangDiDian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BaoFeiRiQi'>
		                        <li style='text-align:right;width:220px'>报废日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_BaoFeiRiQi' id='ZD_BaoFeiRiQi' class='addboxinput inputfocus' value='$ZD_BaoFeiRiQi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BaoFeiRiQi_bitian'></li>
                                
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
if ( strpos($const_q_tianj, "308") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='sys_gx_id_321,ZD_GuKeMingChen,ZD_CaiChanMingChen,ZD_XingHaoGuiGe,ZD_BenChangBianHao,ZD_ShuLiang,ZD_JieShouRiQi,ZD_ShiYongBuMen,ZD_WanHaoZhuangTai,ZD_CunFangDiDian,ZD_BaoFeiRiQi,ZD_BeiZhu'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='SQP_GuKeCaiChanQingDan' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='308' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_GuKeCaiChanQingDan','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','sys_nowbh');form_weikong('#post_form','DeskMenuDiv308');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>