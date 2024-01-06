<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_GongZuoJiHua";
		$sys_re_id_02="280";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_GongZuoJiHua` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$GongZuoXiangMu=$row["GongZuoXiangMu"];
		$NaRongYaoQiu=$row["NaRongYaoQiu"];
		$JiaoQi=$row["JiaoQi"];
		$WanCheng=$row["WanCheng"];
		$sys_gx_id_321=$row["sys_gx_id_321"];
		$sys_gx_id_198=$row["sys_gx_id_198"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$GongZuoXiangMu="";
		$NaRongYaoQiu="";
		$JiaoQi="";
		$WanCheng="";
		$sys_gx_id_321="";
		$sys_gx_id_198="";

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
	                         <ul zd='GongZuoXiangMu'>
		                        <li style='text-align:right;width:220px'>工作项目:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='GongZuoXiangMu' id='GongZuoXiangMu' class='addboxinput inputfocus'  value='$GongZuoXiangMu'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='GongZuoXiangMu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='NaRongYaoQiu'>
		                        <li style='text-align:right;width:220px'>内容要求:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='NaRongYaoQiu' id='NaRongYaoQiu' class='addboxinput inputfocus' style='width:100%;height:350px;'   >$NaRongYaoQiu</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='NaRongYaoQiu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='JiaoQi'>
		                        <li style='text-align:right;width:220px'>交期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='8' name='JiaoQi' id='JiaoQi' class='addboxinput inputfocus' value='$JiaoQi' style='width:100%'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#JiaoQi',theme: '#393D49',lang: 'cn'});</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='JiaoQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='WanCheng'>
		                        <li style='text-align:right;width:220px'>完成:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='WanCheng' type='radio' typeid='17' id='WanCheng_0' value='是' class='addboxinput inputfocus'    />是&nbsp;&nbsp;&nbsp;</label><label><input name='WanCheng' type='radio' typeid='17' id='WanCheng_1' class='addboxinput inputfocus' value=''   checked='checked'    />否</label><script>Inputdate('WanCheng','17','$WanCheng','DeskMenuDiv280','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='WanCheng_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_321'>
		                        <li style='text-align:right;width:220px'>关系字段:sys_gx_id_321:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_321' id='sys_gx_id_321' class='addboxinput inputfocus'  value='$sys_gx_id_321'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_321_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_198'>
		                        <li style='text-align:right;width:220px'>[关系]质量记录归档登记表ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_198' id='sys_gx_id_198' class='addboxinput inputfocus'  value='$sys_gx_id_198'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_198_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_198','48','SQP_GongZuoJiHua','DeskMenuDiv280');</script>
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "280") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='GongZuoXiangMu,NaRongYaoQiu,JiaoQi,WanCheng,sys_gx_id_321,sys_gx_id_198'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='SQP_GongZuoJiHua' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='280' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_GongZuoJiHua','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','sys_nowbh');form_weikong('#post_form','DeskMenuDiv280');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>