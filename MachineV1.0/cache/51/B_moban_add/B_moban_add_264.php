<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="sys_msn";
		$sys_re_id_02="264";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `sys_msn` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$sys_gx_id_321=$row["sys_gx_id_321"];
		$sys_jilu=$row["sys_jilu"];
		$sys_gx_id_223=$row["sys_gx_id_223"];
		$sys_gx_id_495=$row["sys_gx_id_495"];
		$sys_gx_id_308=$row["sys_gx_id_308"];
		$sys_gx_id_497=$row["sys_gx_id_497"];
		$sys_gx_id_204=$row["sys_gx_id_204"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$sys_gx_id_321="";
		$sys_jilu="";
		$sys_gx_id_223="";
		$sys_gx_id_495="";
		$sys_gx_id_308="";
		$sys_gx_id_497="";
		$sys_gx_id_204="";

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
		                        <li style='text-align:right;width:220px'>sys_gx_id_321:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_321' id='sys_gx_id_321' class='addboxinput inputfocus'  value='$sys_gx_id_321'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_321_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_321','30','sys_msn','DeskMenuDiv264');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_223'>
		                        <li style='text-align:right;width:220px'>关系字段:sys_gx_id_223:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_223' id='sys_gx_id_223' class='addboxinput inputfocus'  value='$sys_gx_id_223'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_223_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_223','31','sys_msn','DeskMenuDiv264');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_jilu'>
		                        <li style='text-align:right;width:220px'>交流内容:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_jilu' id='sys_jilu' class='addboxinput inputfocus'  value='$sys_jilu'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_jilu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_495'>
		                        <li style='text-align:right;width:220px'>[关系]服务流程单ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_495' id='sys_gx_id_495' class='addboxinput inputfocus'  value='$sys_gx_id_495'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_495_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_495','32','sys_msn','DeskMenuDiv264');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_308'>
		                        <li style='text-align:right;width:220px'>[关系]顾客财产清单ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_308' id='sys_gx_id_308' class='addboxinput inputfocus'  value='$sys_gx_id_308'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_308_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_308','33','sys_msn','DeskMenuDiv264');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_497'>
		                        <li style='text-align:right;width:220px'>[关系]每日工作汇报表ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_497' id='sys_gx_id_497' class='addboxinput inputfocus'  value='$sys_gx_id_497'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_497_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_497','40','sys_msn','DeskMenuDiv264');</script>
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_204'>
		                        <li style='text-align:right;width:220px'>[关系]员工档案ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_204' id='sys_gx_id_204' class='addboxinput inputfocus'  value='$sys_gx_id_204'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_204_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_204','42','sys_msn','DeskMenuDiv264');</script>
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "264") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='sys_gx_id_321,sys_jilu,sys_gx_id_223,sys_gx_id_495,sys_gx_id_308,sys_gx_id_497,sys_gx_id_204'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='sys_msn' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='264' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','sys_msn','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','sys_nowbh');form_weikong('#post_form','DeskMenuDiv264');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>