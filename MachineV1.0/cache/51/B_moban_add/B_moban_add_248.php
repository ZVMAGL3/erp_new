<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_GuoChengGuanXiTu";
		$sys_re_id_02="248";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_GuoChengGuanXiTu` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$sys_login=$row["sys_login"];
		$sys_id_zu=$row["sys_id_zu"];
		$sys_shenpi=$row["sys_shenpi"];
		$sys_shenpi_all=$row["sys_shenpi_all"];
		$sys_chaosong=$row["sys_chaosong"];
		$sys_paixu=$row["sys_paixu"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$sys_login="";
		$sys_id_zu="";
		$sys_shenpi="";
		$sys_shenpi_all="";
		$sys_chaosong="";
		$sys_paixu="";

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
<div class='two_menu'>
<ul class='tr trhead' >&nbsp;  <span class='menutishi nocopytext'>Menu</span></ul>
<ul class='tr selectTag' title='第1页' onClick=SelectTag_Menu_Two('.ContentTwo1',this,'DeskMenuDiv248') >01  <span class='menutishi nocopytext'>第1页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='第2页' onClick=SelectTag_Menu_Two('.ContentTwo2',this,'DeskMenuDiv248') >02  <span class='menutishi nocopytext'>第2页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='第3页' onClick=SelectTag_Menu_Two('.ContentTwo3',this,'DeskMenuDiv248') >03  <span class='menutishi nocopytext'>第3页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr trboom' onClick=SelectTag_Menu_Two('.ContentTwo',this,'DeskMenuDiv248') >&nbsp;  &nbsp;&nbsp;</ul>
</div>
<div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
if ( strpos($const_q_shenghe, "248") !== false ) { //有审核权限时
echo"
	                         <ul zd='sys_shenpi'>
		                        <li style='text-align:right;width:220px'>审核:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='20' name='sys_shenpi' id='sys_shenpi' class='addboxinput inputfocus'  placeholder='请审核'  y-value='$sys_shenpi'  value='$sys_shenpi'  onclick='SignSH(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='SignSH(this)'><i class='fa fa-20-3'></i></a></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_shenpi_bitian'></li>
                                
		                     </ul>
	                         
";
}
echo"
	                         <ul zd='sys_chaosong'>
		                        <li style='text-align:right;width:220px'>经办人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_chaosong' id='sys_chaosong' class='addboxinput inputfocus' value='$sys_chaosong'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_chaosong_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_paixu'>
		                        <li style='text-align:right;width:220px'>排序:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_paixu' id='sys_paixu' class='addboxinput inputfocus' value='$sys_paixu'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_paixu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<span class='ContentTwo ContentTwo2' style='display:none'>";
echo"
	                         <ul zd='sys_login'>
		                        <li style='text-align:right;width:220px'>编制人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_login' id='sys_login' class='addboxinput inputfocus' value='$sys_login'   readonly  /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_login_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<span class='ContentTwo ContentTwo3' style='display:none'>";
echo"
	                         <ul zd='sys_id_zu'>
		                        <li style='text-align:right;width:220px'>分类:</li>
                                
		                        <li style='width:40%' class='reset_list'>
<label><input type='checkbox' typeid='15' name='sys_id_zu' id='sys_id_zu0' tit=' $sys_id_zu' value='' class='addboxinput inputfocus' checked>&nbsp;所有分类&nbsp;</label><script>Inputdate('sys_id_zu','15','$sys_id_zu','DeskMenuDiv248','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_id_zu_bitian'></li>
                                
		                     </ul>
	                         
";
if ( strpos($const_q_pizhun, "248") !== false ) { //有批准权限时
echo"
	                         <ul zd='sys_shenpi_all'>
		                        <li style='text-align:right;width:220px'>批准:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='22' name='sys_shenpi_all' id='sys_shenpi_all' class='addboxinput inputfocus' placeholder='请批准'  y-value='$sys_shenpi_all'  value='$sys_shenpi_all'  onclick='SignPZ(this)'    readonly='readonly' /><a class='jia jiaok'  onclick='SignPZ(this)'><i class='fa fa-20-4'></i></a></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_shenpi_all_bitian'></li>
                                
		                     </ul>
	                         
";
}
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "248") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='sys_login,sys_id_zu,sys_shenpi,sys_shenpi_all,sys_chaosong,sys_paixu'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='SQP_GuoChengGuanXiTu' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='248' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_GuoChengGuanXiTu','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','id');form_weikong('#post_form','DeskMenuDiv248');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>