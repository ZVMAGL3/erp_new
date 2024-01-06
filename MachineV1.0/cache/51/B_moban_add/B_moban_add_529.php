<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Connadmin.php";
	    global $strmk_id,$Connadmin,$const_q_tianj,$ToHtmlID;
		$Table_name="msc_user_hy";
		$sys_re_id_02="529";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    
		$Conn=$Connadmin;

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `msc_user_hy` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$user_id=$row["user_id"];
		$state=$row["state"];
		$SYS_GongHao=$row["SYS_GongHao"];
		$zhiwei_id=$row["zhiwei_id"];
		$add_time=$row["add_time"];
		$new_time=$row["new_time"];
		$Remark=$row["Remark"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$user_id="";
		$state="";
		$SYS_GongHao="";
		$zhiwei_id="";
		$add_time="";
		$new_time="";
		$Remark="";

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
	                         <ul zd='user_id'>
		                        <li style='text-align:right;width:220px'>用户ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='user_id' id='user_id' class='addboxinput inputfocus' value='$user_id'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='user_id_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='state'>
		                        <li style='text-align:right;width:220px'>状态:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='state' id='state' class='addboxinput inputfocus' value='$state'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='state_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_GongHao'>
		                        <li style='text-align:right;width:220px'>工号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_GongHao' id='SYS_GongHao' class='addboxinput inputfocus' value='$SYS_GongHao'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_GongHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='zhiwei_id'>
		                        <li style='text-align:right;width:220px'>职位ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='zhiwei_id' id='zhiwei_id' class='addboxinput inputfocus' value='$zhiwei_id'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='zhiwei_id_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='add_time'>
		                        <li style='text-align:right;width:220px'>添加时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='9' name='add_time' id='add_time' class='addboxinput inputfocus' value='$add_time'    /><a class='jia jiaok'  onclick=''><i class='fa fa-25-03'></i></a><script>laydate.render({  elem: '#add_time',theme: '#393D49',type: 'datetime',lang: 'cn'});</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='add_time_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='new_time'>
		                        <li style='text-align:right;width:220px'>上次更新时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='9' name='new_time' id='new_time' class='addboxinput inputfocus' value='$new_time'    /><a class='jia jiaok'  onclick=''><i class='fa fa-25-03'></i></a><script>laydate.render({  elem: '#new_time',theme: '#393D49',type: 'datetime',lang: 'cn'});</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='new_time_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='Remark'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='Remark' id='Remark' class='addboxinput inputfocus' value='$Remark'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='Remark_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "529") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='user_id,state,SYS_GongHao,zhiwei_id,add_time,new_time,Remark'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='msc_user_hy' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='529' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','msc_user_hy','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','id');form_weikong('#post_form','DeskMenuDiv529');</script>";

?>

<?php 
mysqli_close( $Connadmin ); //关闭数据库

?>