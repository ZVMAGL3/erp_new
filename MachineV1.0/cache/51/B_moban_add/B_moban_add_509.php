<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_KuaiDiShouFaDengJi";
		$sys_re_id_02="509";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_KuaiDiShouFaDengJi` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_GongSiMingChen=$row["ZD_GongSiMingChen"];
		$ZD_NaRong=$row["ZD_NaRong"];
		$ZD_RiQi=$row["ZD_RiQi"];
		$ZD_KuaiDiMingChen=$row["ZD_KuaiDiMingChen"];
		$ZD_KuaiDiDanHao=$row["ZD_KuaiDiDanHao"];
		$ZD_GenZongQingKuang=$row["ZD_GenZongQingKuang"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_GongSiMingChen="";
		$ZD_NaRong="";
		$ZD_RiQi="";
		$ZD_KuaiDiMingChen="";
		$ZD_KuaiDiDanHao="";
		$ZD_GenZongQingKuang="";

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
<ul class='tr selectTag' title='第1页' onClick=SelectTag_Menu_Two('.ContentTwo1',this,'DeskMenuDiv509') >01  <span class='menutishi nocopytext'>第1页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='第2页' onClick=SelectTag_Menu_Two('.ContentTwo2',this,'DeskMenuDiv509') >02  <span class='menutishi nocopytext'>第2页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr trboom' onClick=SelectTag_Menu_Two('.ContentTwo',this,'DeskMenuDiv509') >&nbsp;  &nbsp;&nbsp;</ul>
</div>
<div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='ZD_NaRong'>
		                        <li style='text-align:right;width:220px'>内容:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ZD_NaRong' id='ZD_NaRong' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$ZD_NaRong</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_NaRong_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_RiQi'>
		                        <li style='text-align:right;width:220px'>日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_RiQi' id='ZD_RiQi' class='addboxinput inputfocus'  value='$ZD_RiQi'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_RiQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_KuaiDiMingChen'>
		                        <li style='text-align:right;width:220px'>快递名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_KuaiDiMingChen' id='ZD_KuaiDiMingChen' class='addboxinput inputfocus'  value='$ZD_KuaiDiMingChen'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_KuaiDiMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_KuaiDiDanHao'>
		                        <li style='text-align:right;width:220px'>快递单号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_KuaiDiDanHao' id='ZD_KuaiDiDanHao' class='addboxinput inputfocus'  value='$ZD_KuaiDiDanHao'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_KuaiDiDanHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GenZongQingKuang'>
		                        <li style='text-align:right;width:220px'>跟踪情况:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_GenZongQingKuang' type='radio' typeid='19' id='ZD_GenZongQingKuang_0' value='✓' class='addboxinput inputfocus'    />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='ZD_GenZongQingKuang' type='radio' typeid='19' id='ZD_GenZongQingKuang_1' class='addboxinput inputfocus' value=''  checked='checked'    />空 </label><script>Inputdate('ZD_GenZongQingKuang','19','$ZD_GenZongQingKuang','DeskMenuDiv509','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GenZongQingKuang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<span class='ContentTwo ContentTwo2' style='display:none'>";
echo"
	                         <ul zd='ZD_GongSiMingChen'>
		                        <li style='text-align:right;width:220px'>公司名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSiMingChen' id='ZD_GongSiMingChen' class='addboxinput inputfocus'  value='$ZD_GongSiMingChen'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSiMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "509") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GongSiMingChen,ZD_NaRong,ZD_RiQi,ZD_KuaiDiMingChen,ZD_KuaiDiDanHao,ZD_GenZongQingKuang'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='SQP_KuaiDiShouFaDengJi' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='509' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_KuaiDiShouFaDengJi','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','id');form_weikong('#post_form','DeskMenuDiv509');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>