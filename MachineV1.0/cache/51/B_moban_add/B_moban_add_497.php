<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_MeiRiGongZuoHuiBaoBiao";
		$sys_re_id_02="497";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_MeiRiGongZuoHuiBaoBiao` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_XiangXiMiaoShu=$row["ZD_XiangXiMiaoShu"];
		$ZD_HuiBaoRen=$row["ZD_HuiBaoRen"];
		$ZD_HuiBaoRiQi=$row["ZD_HuiBaoRiQi"];
		$ZD_WanChengQingKuang=$row["ZD_WanChengQingKuang"];
		$ZD_JiFen=$row["ZD_JiFen"];
		$ZD_ShenYueRen=$row["ZD_ShenYueRen"];
		$ZD_ShenYueShiJian=$row["ZD_ShenYueShiJian"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_XiangXiMiaoShu="";
		$ZD_HuiBaoRen="$SYS_UserName-($bh)";
		$ZD_HuiBaoRiQi="";
		$ZD_WanChengQingKuang="";
		$ZD_JiFen="";
		$ZD_ShenYueRen="";
		$ZD_ShenYueShiJian="";

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
	                         <ul zd='ZD_HuiBaoRen'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;汇报人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='23' name='ZD_HuiBaoRen' id='ZD_HuiBaoRen' class='addboxinput inputfocus'   value='$ZD_HuiBaoRen'  style='width:100%'    readonly='readonly' /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HuiBaoRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XiangXiMiaoShu'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;详细描述:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ZD_XiangXiMiaoShu' id='ZD_XiangXiMiaoShu' class='addboxinput inputfocus' style='width:100%;height:352px;'   >$ZD_XiangXiMiaoShu</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XiangXiMiaoShu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HuiBaoRiQi'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;汇报日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_HuiBaoRiQi' id='ZD_HuiBaoRiQi' class='addboxinput inputfocus'  value='$ZD_HuiBaoRiQi'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HuiBaoRiQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_WanChengQingKuang'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;完成情况:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_WanChengQingKuang' type='radio' typeid='17' id='ZD_WanChengQingKuang_0' value='是' class='addboxinput inputfocus'    />是&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_WanChengQingKuang' type='radio' typeid='17' id='ZD_WanChengQingKuang_1' class='addboxinput inputfocus' value=''   checked='checked'    />否</label><script>Inputdate('ZD_WanChengQingKuang','17','$ZD_WanChengQingKuang','DeskMenuDiv497','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_WanChengQingKuang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiFen'>
		                        <li style='text-align:right;width:220px'>积分:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiFen' id='ZD_JiFen' class='addboxinput inputfocus'  value='$ZD_JiFen'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiFen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenYueRen'>
		                        <li style='text-align:right;width:220px'>审阅人:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenYueRen' id='ZD_ShenYueRen' class='addboxinput inputfocus'  value='$ZD_ShenYueRen'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenYueRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenYueShiJian'>
		                        <li style='text-align:right;width:220px'>审阅时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenYueShiJian' id='ZD_ShenYueShiJian' class='addboxinput inputfocus'  value='$ZD_ShenYueShiJian'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenYueShiJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "497") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XiangXiMiaoShu,ZD_HuiBaoRen,ZD_HuiBaoRiQi,ZD_WanChengQingKuang,ZD_JiFen,ZD_ShenYueRen,ZD_ShenYueShiJian'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_id_zu' bitian_Arry='ZD_XiangXiMiaoShu,ZD_HuiBaoRen,ZD_HuiBaoRiQi,ZD_WanChengQingKuang' databiao='SQP_MeiRiGongZuoHuiBaoBiao' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='497' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_MeiRiGongZuoHuiBaoBiao','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','sys_id_zu');form_weikong('#post_form','DeskMenuDiv497');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>