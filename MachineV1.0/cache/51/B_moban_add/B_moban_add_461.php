<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_WenJianZiDongHua";
		$sys_re_id_02="461";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_WenJianZiDongHua` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_GongSiMingChen=$row["ZD_GongSiMingChen"];
		$ZD_GongSiDiZhi=$row["ZD_GongSiDiZhi"];
		$ZD_GongSiDianHua=$row["ZD_GongSiDianHua"];
		$ZD_GongSiChuanZhen=$row["ZD_GongSiChuanZhen"];
		$ZD_ZongJingLi=$row["ZD_ZongJingLi"];
		$ZD_GuanLiZheDaiBiao=$row["ZD_GuanLiZheDaiBiao"];
		$ZD_AnQuanShiWuDaiBiao=$row["ZD_AnQuanShiWuDaiBiao"];
		$ZD_ShouCeBianZhiRen=$row["ZD_ShouCeBianZhiRen"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_GongSiMingChen="";
		$ZD_GongSiDiZhi="";
		$ZD_GongSiDianHua="";
		$ZD_GongSiChuanZhen="";
		$ZD_ZongJingLi="总经理";
		$ZD_GuanLiZheDaiBiao="管代";
		$ZD_AnQuanShiWuDaiBiao="安全代表";
		$ZD_ShouCeBianZhiRen="手册编制人";

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
	                         <ul zd='ZD_GongSiMingChen'>
		                        <li style='text-align:right;width:220px'><font color='red'>[验重]</font>&nbsp;公司名称:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_GongSiMingChen} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_GongSiMingChen}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSiMingChen' id='ZD_GongSiMingChen' class='addboxinput inputfocus'  value='$ZD_GongSiMingChen'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSiMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongSiDiZhi'>
		                        <li style='text-align:right;width:220px'>公司地址:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_GongSiDiZhi} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_GongSiDiZhi}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSiDiZhi' id='ZD_GongSiDiZhi' class='addboxinput inputfocus'  value='$ZD_GongSiDiZhi'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSiDiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongSiDianHua'>
		                        <li style='text-align:right;width:220px'>公司电话:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_GongSiDianHua} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_GongSiDianHua}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSiDianHua' id='ZD_GongSiDianHua' class='addboxinput inputfocus'  value='$ZD_GongSiDianHua'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSiDianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongSiChuanZhen'>
		                        <li style='text-align:right;width:220px'>公司传真:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_GongSiChuanZhen} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_GongSiChuanZhen}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongSiChuanZhen' id='ZD_GongSiChuanZhen' class='addboxinput inputfocus'  value='$ZD_GongSiChuanZhen'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongSiChuanZhen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZongJingLi'>
		                        <li style='text-align:right;width:220px'>总经理:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_ZongJingLi} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_ZongJingLi}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZongJingLi' id='ZD_ZongJingLi' class='addboxinput inputfocus'  value='$ZD_ZongJingLi'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZongJingLi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GuanLiZheDaiBiao'>
		                        <li style='text-align:right;width:220px'>管理者代表:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_GuanLiZheDaiBiao} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_GuanLiZheDaiBiao}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GuanLiZheDaiBiao' id='ZD_GuanLiZheDaiBiao' class='addboxinput inputfocus'  value='$ZD_GuanLiZheDaiBiao'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GuanLiZheDaiBiao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_AnQuanShiWuDaiBiao'>
		                        <li style='text-align:right;width:220px'>安全事务代表:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_AnQuanShiWuDaiBiao} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_AnQuanShiWuDaiBiao}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_AnQuanShiWuDaiBiao' id='ZD_AnQuanShiWuDaiBiao' class='addboxinput inputfocus'  value='$ZD_AnQuanShiWuDaiBiao'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_AnQuanShiWuDaiBiao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShouCeBianZhiRen'>
		                        <li style='text-align:right;width:220px'>手册编制人:</li>
                                <li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {ZD_ShouCeBianZhiRen} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{ZD_ShouCeBianZhiRen}') ></i> 替换为 </li>
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShouCeBianZhiRen' id='ZD_ShouCeBianZhiRen' class='addboxinput inputfocus'  value='$ZD_ShouCeBianZhiRen'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShouCeBianZhiRen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "461") !== false  ) { //有添加权限时
       echo"<ul><li style='text-align:right;width:250px'>&nbsp; </li>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_GongSiMingChen,ZD_GongSiDiZhi,ZD_GongSiDianHua,ZD_GongSiChuanZhen,ZD_ZongJingLi,ZD_GuanLiZheDaiBiao,ZD_AnQuanShiWuDaiBiao,ZD_ShouCeBianZhiRen'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='SQP_WenJianZiDongHua' Wuchongfu_Arry='ZD_GongSiMingChen'  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='461' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'ZD_GongSiMingChen','SQP_WenJianZiDongHua','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','sys_nowbh');form_weikong('#post_form','DeskMenuDiv461');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>