<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Connadmin.php";
	    global $strmk_id,$Connadmin,$const_q_tianj,$ToHtmlID;
		$Table_name="msc_user_reg";
		$sys_re_id_02="256";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    
		$Conn=$Connadmin;

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `msc_user_reg` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$SYS_GongHao=$row["SYS_GongHao"];
		$SYS_reg_num=$row["SYS_reg_num"];
		$SYS_UserName=$row["SYS_UserName"];
		$SYS_ShouJi=$row["SYS_ShouJi"];
		$SYS_yuangongdanganbiao_id=$row["SYS_yuangongdanganbiao_id"];
		$SYS_PassWord=$row["SYS_PassWord"];
		$SYS_ShenFenZheng=$row["SYS_ShenFenZheng"];
		$SYS_Company_id=$row["SYS_Company_id"];
		$SYS_ZD_QQ=$row["SYS_ZD_QQ"];
		$SYS_Email=$row["SYS_Email"];
		$SYS_ZD_ZaiZhiZhuangTai=$row["SYS_ZD_ZaiZhiZhuangTai"];
		$SYS_QuanXian=$row["SYS_QuanXian"];
		$SYS_XingBie=$row["SYS_XingBie"];
		$SYS_DianHua=$row["SYS_DianHua"];
		$SYS_YinXingKaHao=$row["SYS_YinXingKaHao"];
		$SYS_DiZhi=$row["SYS_DiZhi"];
		$SYS_GongZi=$row["SYS_GongZi"];
		$SYS_StartDate=$row["SYS_StartDate"];
		$SYS_EndDate=$row["SYS_EndDate"];
		$SYS_jib=$row["SYS_jib"];
		$SYS_photo=$row["SYS_photo"];
		$SYS_chaoguan=$row["SYS_chaoguan"];
		$SYS_qianmin=$row["SYS_qianmin"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$SYS_GongHao="0";
		$SYS_reg_num="9007";
		$SYS_UserName="";
		$SYS_ShouJi="";
		$SYS_yuangongdanganbiao_id="";
		$SYS_PassWord="";
		$SYS_ShenFenZheng="";
		$SYS_Company_id="51";
		$SYS_ZD_QQ="";
		$SYS_Email="";
		$SYS_ZD_ZaiZhiZhuangTai="0";
		$SYS_QuanXian="0";
		$SYS_XingBie="";
		$SYS_DianHua="";
		$SYS_YinXingKaHao="";
		$SYS_DiZhi="";
		$SYS_GongZi="0";
		$SYS_StartDate="";
		$SYS_EndDate="";
		$SYS_jib="0";
		$SYS_photo="";
		$SYS_chaoguan="0";
		$SYS_qianmin="";

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
	                         <ul zd='SYS_GongHao'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;工号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_GongHao' id='SYS_GongHao' class='addboxinput inputfocus' value='$SYS_GongHao'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_GongHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_UserName'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;用户名:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_UserName' id='SYS_UserName' class='addboxinput inputfocus' value='$SYS_UserName'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_UserName_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_ShouJi'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;手机:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_ShouJi' id='SYS_ShouJi' class='addboxinput inputfocus' value='$SYS_ShouJi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_ShouJi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_ZD_ZaiZhiZhuangTai'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;在职状态:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_ZD_ZaiZhiZhuangTai' id='SYS_ZD_ZaiZhiZhuangTai' class='addboxinput inputfocus' value='$SYS_ZD_ZaiZhiZhuangTai'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_ZD_ZaiZhiZhuangTai_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_reg_num'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;公司注册号id:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_reg_num' id='SYS_reg_num' class='addboxinput inputfocus' value='$SYS_reg_num'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_reg_num_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_yuangongdanganbiao_id'>
		                        <li style='text-align:right;width:220px'>对应的会员id:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_yuangongdanganbiao_id' id='SYS_yuangongdanganbiao_id' class='addboxinput inputfocus' value='$SYS_yuangongdanganbiao_id'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_yuangongdanganbiao_id_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_PassWord'>
		                        <li style='text-align:right;width:220px'>密码:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_PassWord' id='SYS_PassWord' class='addboxinput inputfocus' value='$SYS_PassWord'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_PassWord_bitian'></li>
                                
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
	                         <ul zd='SYS_Company_id'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;所属公司ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_Company_id' id='SYS_Company_id' class='addboxinput inputfocus' value='$SYS_Company_id'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_Company_id_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_ZD_QQ'>
		                        <li style='text-align:right;width:220px'>QQ:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_ZD_QQ' id='SYS_ZD_QQ' class='addboxinput inputfocus' value='$SYS_ZD_QQ'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_ZD_QQ_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_Email'>
		                        <li style='text-align:right;width:220px'>邮件:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_Email' id='SYS_Email' class='addboxinput inputfocus' value='$SYS_Email'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_Email_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_QuanXian'>
		                        <li style='text-align:right;width:220px'><font color='red' class='s_bt'>*</font>&nbsp;权限{职位}:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_QuanXian' id='SYS_QuanXian' class='addboxinput inputfocus' value='$SYS_QuanXian'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_QuanXian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_XingBie'>
		                        <li style='text-align:right;width:220px'>性别:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='SYS_XingBie' type='radio' typeid='11' id='SYS_XingBie_0' value='男' class='addboxinput inputfocus'   checked='checked'    />男&nbsp;&nbsp;&nbsp;</label><label><input name='SYS_XingBie' type='radio' typeid='11' id='SYS_XingBie_1' class='addboxinput inputfocus' value='女'  checked='checked'    />女</label><script>Inputdate('SYS_XingBie','11','$SYS_XingBie','DeskMenuDiv256','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_XingBie_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_DianHua'>
		                        <li style='text-align:right;width:220px'>电话:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_DianHua' id='SYS_DianHua' class='addboxinput inputfocus' value='$SYS_DianHua'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_DianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_YinXingKaHao'>
		                        <li style='text-align:right;width:220px'>银行卡号:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_YinXingKaHao' id='SYS_YinXingKaHao' class='addboxinput inputfocus' value='$SYS_YinXingKaHao'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_YinXingKaHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_DiZhi'>
		                        <li style='text-align:right;width:220px'>地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_DiZhi' id='SYS_DiZhi' class='addboxinput inputfocus' value='$SYS_DiZhi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_DiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_GongZi'>
		                        <li style='text-align:right;width:220px'>工资:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_GongZi' id='SYS_GongZi' class='addboxinput inputfocus' value='$SYS_GongZi'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_GongZi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_StartDate'>
		                        <li style='text-align:right;width:220px'>入职时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_StartDate' id='SYS_StartDate' class='addboxinput inputfocus' value='$SYS_StartDate'   /></li>
								
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
	                         <ul zd='SYS_jib'>
		                        <li style='text-align:right;width:220px'>级别:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_jib' id='SYS_jib' class='addboxinput inputfocus' value='$SYS_jib'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_jib_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_photo'>
		                        <li style='text-align:right;width:220px'>头像:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_photo' id='SYS_photo' class='addboxinput inputfocus' value='$SYS_photo'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_photo_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_chaoguan'>
		                        <li style='text-align:right;width:220px'>超管:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_chaoguan' id='SYS_chaoguan' class='addboxinput inputfocus' value='$SYS_chaoguan'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_chaoguan_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='SYS_qianmin'>
		                        <li style='text-align:right;width:220px'>个性签名:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='SYS_qianmin' id='SYS_qianmin' class='addboxinput inputfocus' value='$SYS_qianmin'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='SYS_qianmin_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "256") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='SYS_GongHao,SYS_reg_num,SYS_UserName,SYS_ShouJi,SYS_yuangongdanganbiao_id,SYS_PassWord,SYS_ShenFenZheng,SYS_Company_id,SYS_ZD_QQ,SYS_Email,SYS_ZD_ZaiZhiZhuangTai,SYS_QuanXian,SYS_XingBie,SYS_DianHua,SYS_YinXingKaHao,SYS_DiZhi,SYS_GongZi,SYS_StartDate,SYS_EndDate,SYS_jib,SYS_photo,SYS_chaoguan,SYS_qianmin'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='SYS_GongHao,SYS_reg_num,SYS_UserName,SYS_ShouJi,SYS_Company_id,SYS_ZD_ZaiZhiZhuangTai,SYS_QuanXian' databiao='msc_user_reg' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='256' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','msc_user_reg','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','id');form_weikong('#post_form','DeskMenuDiv256');</script>";

?>

<?php 
mysqli_close( $Connadmin ); //关闭数据库

?>