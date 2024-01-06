<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_CCCFeiYongChaXun";
		$sys_re_id_02="511";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_CCCFeiYongChaXun` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$sys_id_zu=$row["sys_id_zu"];
		$ZD_ChanPinMingChen=$row["ZD_ChanPinMingChen"];
		$ZD_DuiYingXiangGuanChanPinMingChen=$row["ZD_DuiYingXiangGuanChanPinMingChen"];
		$ZD_ZhiXingBiaoZhun=$row["ZD_ZhiXingBiaoZhun"];
		$ZD_QuanXiangJianCeFei=$row["ZD_QuanXiangJianCeFei"];
		$ZD_ZiXunFei=$row["ZD_ZiXunFei"];
		$sys_gx_id_198=$row["sys_gx_id_198"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$sys_id_zu="";
		$ZD_ChanPinMingChen="";
		$ZD_DuiYingXiangGuanChanPinMingChen="";
		$ZD_ZhiXingBiaoZhun="";
		$ZD_QuanXiangJianCeFei="";
		$ZD_ZiXunFei="";
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
	                         <ul zd='ZD_ChanPinMingChen'>
		                        <li style='text-align:right;width:220px'>产品名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ChanPinMingChen' id='ZD_ChanPinMingChen' class='addboxinput inputfocus' value='$ZD_ChanPinMingChen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ChanPinMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_DuiYingXiangGuanChanPinMingChen'>
		                        <li style='text-align:right;width:220px'>对应相关产品名称:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_DuiYingXiangGuanChanPinMingChen' id='ZD_DuiYingXiangGuanChanPinMingChen' class='addboxinput inputfocus' value='$ZD_DuiYingXiangGuanChanPinMingChen'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_DuiYingXiangGuanChanPinMingChen_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_id_zu'>
		                        <li style='text-align:right;width:220px'>分类:</li>
                                
		                        <li style='width:40%' class='reset_list'>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu1' tit='$sys_id_zu' cnval='一、电线组件' value='$sys_id_zu' valid='504' valstr='' class='addboxinput inputfocus' >一、电线组件&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu2' tit='$sys_id_zu' cnval='七、热熔断器' value='$sys_id_zu' valid='510' valstr='' class='addboxinput inputfocus' >七、热熔断器&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu3' tit='$sys_id_zu' cnval='三、家用及类似用途插头插座' value='$sys_id_zu' valid='506' valstr='' class='addboxinput inputfocus' >三、家用及类似用途插头插座&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu4' tit='$sys_id_zu' cnval='九、小型熔断器的管状熔断体' value='$sys_id_zu' valid='512' valstr='' class='addboxinput inputfocus' >九、小型熔断器的管状熔断体&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu5' tit='$sys_id_zu' cnval='二、电线电缆产品' value='$sys_id_zu' valid='505' valstr='' class='addboxinput inputfocus' >二、电线电缆产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu6' tit='$sys_id_zu' cnval='二十、轮胎产品' value='$sys_id_zu' valid='523' valstr='' class='addboxinput inputfocus' >二十、轮胎产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu7' tit='$sys_id_zu' cnval='二十一、安全玻璃' value='$sys_id_zu' valid='524' valstr='' class='addboxinput inputfocus' >二十一、安全玻璃&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu8' tit='$sys_id_zu' cnval='二十七、安全技术防范产品' value='$sys_id_zu' valid='530' valstr='' class='addboxinput inputfocus' >二十七、安全技术防范产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu9' tit='$sys_id_zu' cnval='二十三、橡胶避孕套产品' value='$sys_id_zu' valid='526' valstr='' class='addboxinput inputfocus' >二十三、橡胶避孕套产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu10' tit='$sys_id_zu' cnval='二十九、装饰装修产品' value='$sys_id_zu' valid='532' valstr='' class='addboxinput inputfocus' >二十九、装饰装修产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu11' tit='$sys_id_zu' cnval='二十二、植物保护机械' value='$sys_id_zu' valid='525' valstr='' class='addboxinput inputfocus' >二十二、植物保护机械&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu12' tit='$sys_id_zu' cnval='二十五、医疗器材产品' value='$sys_id_zu' valid='528' valstr='' class='addboxinput inputfocus' >二十五、医疗器材产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu13' tit='$sys_id_zu' cnval='二十八、汽车安全带产品' value='$sys_id_zu' valid='531' valstr='' class='addboxinput inputfocus' >二十八、汽车安全带产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu14' tit='$sys_id_zu' cnval='二十六、消防产品' value='$sys_id_zu' valid='529' valstr='' class='addboxinput inputfocus' >二十六、消防产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu15' tit='$sys_id_zu' cnval='二十四、电信终端设备' value='$sys_id_zu' valid='527' valstr='' class='addboxinput inputfocus' >二十四、电信终端设备&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu16' tit='$sys_id_zu' cnval='五、工业用插头插座和耦合器' value='$sys_id_zu' valid='508' valstr='' class='addboxinput inputfocus' >五、工业用插头插座和耦合器&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu17' tit='$sys_id_zu' cnval='八、家用及类似用途固定式电器装置电器附件外壳' value='$sys_id_zu' valid='511' valstr='' class='addboxinput inputfocus' >八、家用及类似用途固定式电器装置电器附件外壳&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu18' tit='$sys_id_zu' cnval='六、家用及类似用途的器具耦合器' value='$sys_id_zu' valid='509' valstr='' class='addboxinput inputfocus' >六、家用及类似用途的器具耦合器&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu19' tit='$sys_id_zu' cnval='十、低压器具' value='$sys_id_zu' valid='513' valstr='' class='addboxinput inputfocus' >十、低压器具&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu20' tit='$sys_id_zu' cnval='十一、小功率电动机' value='$sys_id_zu' valid='514' valstr='' class='addboxinput inputfocus' >十一、小功率电动机&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu21' tit='$sys_id_zu' cnval='十七、照明电器' value='$sys_id_zu' valid='520' valstr='' class='addboxinput inputfocus' >十七、照明电器&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu22' tit='$sys_id_zu' cnval='十三、电焊机' value='$sys_id_zu' valid='516' valstr='' class='addboxinput inputfocus' >十三、电焊机&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu23' tit='$sys_id_zu' cnval='十九、摩托车及摩托车发动机' value='$sys_id_zu' valid='522' valstr='' class='addboxinput inputfocus' >十九、摩托车及摩托车发动机&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu24' tit='$sys_id_zu' cnval='十二、电动工具' value='$sys_id_zu' valid='515' valstr='' class='addboxinput inputfocus' >十二、电动工具&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu25' tit='$sys_id_zu' cnval='十五、音视频设备' value='$sys_id_zu' valid='518' valstr='' class='addboxinput inputfocus' >十五、音视频设备&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu26' tit='$sys_id_zu' cnval='十八、汽车产品' value='$sys_id_zu' valid='521' valstr='' class='addboxinput inputfocus' >十八、汽车产品&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu27' tit='$sys_id_zu' cnval='十六、信息技术设备' value='$sys_id_zu' valid='519' valstr='' class='addboxinput inputfocus' >十六、信息技术设备&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu28' tit='$sys_id_zu' cnval='十四、家用和类似用途设备' value='$sys_id_zu' valid='517' valstr='' class='addboxinput inputfocus' >十四、家用和类似用途设备&nbsp;</label>
<label><input type='checkbox' typeid='15' onchange='checkbox_morechecked(this)' name='sys_id_zu' id='sys_id_zu29' tit='$sys_id_zu' cnval='四、家用及类似用途固定式电器装置的开关' value='$sys_id_zu' valid='507' valstr='' class='addboxinput inputfocus' >四、家用及类似用途固定式电器装置的开关&nbsp;</label><script>Inputdate('sys_id_zu','15','$sys_id_zu','DeskMenuDiv511','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_id_zu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZhiXingBiaoZhun'>
		                        <li style='text-align:right;width:220px'>执行标准:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZhiXingBiaoZhun' id='ZD_ZhiXingBiaoZhun' class='addboxinput inputfocus' value='$ZD_ZhiXingBiaoZhun'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZhiXingBiaoZhun_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_QuanXiangJianCeFei'>
		                        <li style='text-align:right;width:220px'>全项检测费:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_QuanXiangJianCeFei' id='ZD_QuanXiangJianCeFei' class='addboxinput inputfocus' value='$ZD_QuanXiangJianCeFei'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_QuanXiangJianCeFei_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZiXunFei'>
		                        <li style='text-align:right;width:220px'>咨询费:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZiXunFei' id='ZD_ZiXunFei' class='addboxinput inputfocus' value='$ZD_ZiXunFei'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZiXunFei_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_198'>
		                        <li style='text-align:right;width:220px'>[关系]质量记录归档登记表ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_198' id='sys_gx_id_198' class='addboxinput inputfocus' value='$sys_gx_id_198'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_198_bitian'></li>
                                
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "511") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='sys_id_zu,ZD_ChanPinMingChen,ZD_DuiYingXiangGuanChanPinMingChen,ZD_ZhiXingBiaoZhun,ZD_QuanXiangJianCeFei,ZD_ZiXunFei,sys_gx_id_198'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='id' bitian_Arry='' databiao='SQP_CCCFeiYongChaXun' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='511' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_CCCFeiYongChaXun','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','id');form_weikong('#post_form','DeskMenuDiv511');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>