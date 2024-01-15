<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="sys_yuangongdanganbiao";
		$sys_re_id_02="204";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `sys_yuangongdanganbiao` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$SYS_UserName=$row["SYS_UserName"];
		$XingBie=$row["XingBie"];
		$SYS_GongHao=$row["SYS_GongHao"];
		$SYS_QuanXian=$row["SYS_QuanXian"];
		$SYS_ShouJi=$row["SYS_ShouJi"];
		$GongZi=$row["GongZi"];
		$ZD_GongZiFaFangZhangHu=$row["ZD_GongZiFaFangZhangHu"];
		$SYS_ShenFenZheng=$row["SYS_ShenFenZheng"];
		$ZD_XianZhuDiZhi=$row["ZD_XianZhuDiZhi"];
		$QQ=$row["QQ"];
		$SYS_Email=$row["SYS_Email"];
		$SYS_StartDate=$row["SYS_StartDate"];
		$SYS_EndDate=$row["SYS_EndDate"];
		$zzzt=$row["zzzt"];
		$ZD_HunYinZhuangTai=$row["ZD_HunYinZhuangTai"];
		$sys_gx_id_204=$row["sys_gx_id_204"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$SYS_UserName="";
		$XingBie="";
		$SYS_GongHao="";
		$SYS_QuanXian="";
		$SYS_ShouJi="";
		$GongZi="0";
		$ZD_GongZiFaFangZhangHu="";
		$SYS_ShenFenZheng="";
		$ZD_XianZhuDiZhi="";
		$QQ="";
		$SYS_Email="";
		$SYS_StartDate="";
		$SYS_EndDate="";
		$zzzt="0";
		$ZD_HunYinZhuangTai="未婚";
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
<div class='two_menu'>
<ul class='tr trhead' >&nbsp;  <span class='menutishi nocopytext'>Menu</span></ul>
<ul class='tr selectTag' title='第1页' onClick=SelectTag_Menu_Two('.ContentTwo1',this,'DeskMenuDiv204') >01  <span class='menutishi nocopytext'>第1页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr ' title='第2页' onClick=SelectTag_Menu_Two('.ContentTwo2',this,'DeskMenuDiv204') >02  <span class='menutishi nocopytext'>第2页</span><span class='bitian_wuchong_tongji'>0</span></ul>
<ul class='tr trboom' onClick=SelectTag_Menu_Two('.ContentTwo',this,'DeskMenuDiv204') >&nbsp;  &nbsp;&nbsp;</ul>
</div>
<div id='mobanaddbox' class='NowULTable nocopytext'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='XingBie'>
		                        <li style='text-align:right;width:220px'>性别:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='XingBie' type='radio' typeid='11' id='XingBie_0' value='男' class='addboxinput inputfocus'   checked='checked'    />男&nbsp;&nbsp;&nbsp;</label><label><input name='XingBie' type='radio' typeid='11' id='XingBie_1' class='addboxinput inputfocus' value='女'  checked='checked'    />女</label><script>Inputdate('XingBie','11','$XingBie','DeskMenuDiv204','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='XingBie_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_GongHao'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;工号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_GongHao' id='SYS_GongHao' class='addboxinput inputfocus' value='$SYS_GongHao'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_GongHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_QuanXian'>
		                        <li style='text-align:right;width:220px'>职位:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_QuanXian' id='SYS_QuanXian' class='addboxinput inputfocus' value='$SYS_QuanXian'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_QuanXian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_ShouJi'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[验重]</font>&nbsp;联系方式:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_ShouJi' id='SYS_ShouJi' class='addboxinput inputfocus' value='$SYS_ShouJi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_ShouJi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='GongZi'>
		                        <li style='text-align:right;width:220px'>工资:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='GongZi' id='GongZi' class='addboxinput inputfocus' value='$GongZi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='GongZi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_GongZiFaFangZhangHu'>
		                        <li style='text-align:right;width:220px'>工资发放账户:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_GongZiFaFangZhangHu' id='ZD_GongZiFaFangZhangHu' class='addboxinput inputfocus' value='$ZD_GongZiFaFangZhangHu'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_GongZiFaFangZhangHu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_ShenFenZheng'>
		                        <li style='text-align:right;width:220px'>身份证:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_ShenFenZheng' id='SYS_ShenFenZheng' class='addboxinput inputfocus' value='$SYS_ShenFenZheng'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_ShenFenZheng_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XianZhuDiZhi'>
		                        <li style='text-align:right;width:220px'>现住地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XianZhuDiZhi' id='ZD_XianZhuDiZhi' class='addboxinput inputfocus' value='$ZD_XianZhuDiZhi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XianZhuDiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='QQ'>
		                        <li style='text-align:right;width:220px'>QQ:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='QQ' id='QQ' class='addboxinput inputfocus' value='$QQ'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='QQ_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_Email'>
		                        <li style='text-align:right;width:220px'>邮箱:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_Email' id='SYS_Email' class='addboxinput inputfocus' value='$SYS_Email'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_Email_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_StartDate'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;入职时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='8' name='SYS_StartDate' id='SYS_StartDate' class='addboxinput inputfocus' value='$SYS_StartDate'   /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#SYS_StartDate',theme: '#393D49',lang: 'cn'});</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_StartDate_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_EndDate'>
		                        <li style='text-align:right;width:220px'>离职时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_EndDate' id='SYS_EndDate' class='addboxinput inputfocus' value='$SYS_EndDate'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_EndDate_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='zzzt'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;在职状态:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='zzzt' type='radio' typeid='16' id='zzzt_0' value='在职' class='addboxinput inputfocus'    />在职&nbsp;&nbsp;&nbsp;</label><label><input name='zzzt' type='radio' typeid='16' id='zzzt_1' class='addboxinput inputfocus' value='离职'  checked='checked'    />离职</label><script>Inputdate('zzzt','16','$zzzt','DeskMenuDiv204','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='zzzt_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HunYinZhuangTai'>
		                        <li style='text-align:right;width:220px'>婚姻状态:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_HunYinZhuangTai' type='radio' typeid='26' id='ZD_HunYinZhuangTai_0' value='已婚' class='addboxinput inputfocus'    />已婚&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_HunYinZhuangTai' type='radio' typeid='26' id='ZD_HunYinZhuangTai_1' class='addboxinput inputfocus' value='未婚'  checked='checked'    />未婚</label><script>Inputdate('ZD_HunYinZhuangTai','26','$ZD_HunYinZhuangTai','DeskMenuDiv204','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HunYinZhuangTai_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_204'>
		                        <li style='text-align:right;width:220px'>关系字段:sys_gx_id_204:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_204' id='sys_gx_id_204' class='addboxinput inputfocus' value='$sys_gx_id_204'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_204_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<span class='ContentTwo ContentTwo2' style='display:none'>";
echo"
	                         <ul zd='SYS_UserName'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;姓名:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_UserName' id='SYS_UserName' class='addboxinput inputfocus' value='$SYS_UserName'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_UserName_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "204") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SYS_UserName,XingBie,SYS_GongHao,SYS_QuanXian,SYS_ShouJi,GongZi,ZD_GongZiFaFangZhangHu,SYS_ShenFenZheng,ZD_XianZhuDiZhi,QQ,SYS_Email,SYS_StartDate,SYS_EndDate,zzzt,ZD_HunYinZhuangTai,sys_gx_id_204'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='SYS_UserName,SYS_GongHao,SYS_ShouJi,SYS_StartDate,zzzt' databiao='sys_yuangongdanganbiao' Wuchongfu_Arry='SYS_GongHao,SYS_ShouJi'  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='204' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'SYS_GongHao,SYS_ShouJi','sys_yuangongdanganbiao','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','id');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>