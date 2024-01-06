<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	    global $strmk_id,$Conn,$const_q_tianj,$ToHtmlID;
		$Table_name="SQP_JianLiZhongXin";
		$sys_re_id_02="315";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.';'.$GuanXi_id.';'.$Table_name;
	    

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_JianLiZhongXin` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_XingBie=$row["ZD_XingBie"];
		$ZD_JiGuan=$row["ZD_JiGuan"];
		$ZD_MinZu=$row["ZD_MinZu"];
		$ZD_ShenQingRiQi=$row["ZD_ShenQingRiQi"];
		$ZD_ShenQingGangWei=$row["ZD_ShenQingGangWei"];
		$ZD_QiWangXinZi=$row["ZD_QiWangXinZi"];
		$ZD_XueLi=$row["ZD_XueLi"];
		$ZD_XingMing=$row["ZD_XingMing"];
		$ZD_HunYin=$row["ZD_HunYin"];
		$ZD_ShenGao=$row["ZD_ShenGao"];
		$ZD_TiZhong=$row["ZD_TiZhong"];
		$ZD_WaiYuDengJi=$row["ZD_WaiYuDengJi"];
		$ZD_XingQuAiHao=$row["ZD_XingQuAiHao"];
		$ZD_ShenFenZhengDiZhi=$row["ZD_ShenFenZhengDiZhi"];
		$ZD_XianZhuDiZhi=$row["ZD_XianZhuDiZhi"];
		$ZD_ShenFenZhengHaoMa=$row["ZD_ShenFenZhengHaoMa"];
		$ZD_LianXiDianHua=$row["ZD_LianXiDianHua"];
		$ZD_JinJiLianXiRenDianHua=$row["ZD_JinJiLianXiRenDianHua"];
		$ZD_XueXiJingLi=$row["ZD_XueXiJingLi"];
		$ZD_ZhuYaoGongZuoJingLi=$row["ZD_ZhuYaoGongZuoJingLi"];
		$ZD_JiaTingQingKuang=$row["ZD_JiaTingQingKuang"];
		$ZD_ZiWoPingJia=$row["ZD_ZiWoPingJia"];
		$ZD_BeiZhu=$row["ZD_BeiZhu"];
		$sys_gx_id_198=$row["sys_gx_id_198"];


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_XingBie="";
		$ZD_JiGuan="";
		$ZD_MinZu="汉";
		$ZD_ShenQingRiQi="";
		$ZD_ShenQingGangWei="";
		$ZD_QiWangXinZi="0";
		$ZD_XueLi="0";
		$ZD_XingMing="";
		$ZD_HunYin="";
		$ZD_ShenGao="";
		$ZD_TiZhong="";
		$ZD_WaiYuDengJi="";
		$ZD_XingQuAiHao="";
		$ZD_ShenFenZhengDiZhi="";
		$ZD_XianZhuDiZhi="";
		$ZD_ShenFenZhengHaoMa="";
		$ZD_LianXiDianHua="";
		$ZD_JinJiLianXiRenDianHua="";
		$ZD_XueXiJingLi="";
		$ZD_ZhuYaoGongZuoJingLi="";
		$ZD_JiaTingQingKuang="";
		$ZD_ZiWoPingJia="";
		$ZD_BeiZhu="";
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
	                         <ul zd='ZD_XingMing'>
		                        <li style='text-align:right;width:220px'>姓名:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XingMing' id='ZD_XingMing' class='addboxinput inputfocus'  value='$ZD_XingMing'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingMing_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XingBie'>
		                        <li style='text-align:right;width:220px'>性别:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_XingBie' type='radio' typeid='11' id='ZD_XingBie_0' value='男' class='addboxinput inputfocus'   checked='checked'    />男&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XingBie' type='radio' typeid='11' id='ZD_XingBie_1' class='addboxinput inputfocus' value='女'  checked='checked'    />女</label><script>Inputdate('ZD_XingBie','11','$ZD_XingBie','DeskMenuDiv315','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingBie_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiGuan'>
		                        <li style='text-align:right;width:220px'>籍贯:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiGuan' id='ZD_JiGuan' class='addboxinput inputfocus'  value='$ZD_JiGuan'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiGuan_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_MinZu'>
		                        <li style='text-align:right;width:220px'>民族:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_MinZu' id='ZD_MinZu' class='addboxinput inputfocus'  value='$ZD_MinZu'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_MinZu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenQingRiQi'>
		                        <li style='text-align:right;width:220px'>申请日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenQingRiQi' id='ZD_ShenQingRiQi' class='addboxinput inputfocus'  value='$ZD_ShenQingRiQi'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenQingRiQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenQingGangWei'>
		                        <li style='text-align:right;width:220px'>申请岗位:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenQingGangWei' id='ZD_ShenQingGangWei' class='addboxinput inputfocus'  value='$ZD_ShenQingGangWei'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenQingGangWei_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_QiWangXinZi'>
		                        <li style='text-align:right;width:220px'>期望薪资:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_QiWangXinZi' id='ZD_QiWangXinZi' class='addboxinput inputfocus'  value='$ZD_QiWangXinZi'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_QiWangXinZi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XueLi'>
		                        <li style='text-align:right;width:220px'>学历:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XueLi' id='ZD_XueLi' class='addboxinput inputfocus'  value='$ZD_XueLi'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XueLi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HunYin'>
		                        <li style='text-align:right;width:220px'>婚姻:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_HunYin' id='ZD_HunYin' class='addboxinput inputfocus'  value='$ZD_HunYin'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HunYin_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenGao'>
		                        <li style='text-align:right;width:220px'>身高:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenGao' id='ZD_ShenGao' class='addboxinput inputfocus'  value='$ZD_ShenGao'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenGao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_TiZhong'>
		                        <li style='text-align:right;width:220px'>体重:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_TiZhong' id='ZD_TiZhong' class='addboxinput inputfocus'  value='$ZD_TiZhong'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_TiZhong_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_WaiYuDengJi'>
		                        <li style='text-align:right;width:220px'>外语等级:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_WaiYuDengJi' id='ZD_WaiYuDengJi' class='addboxinput inputfocus'  value='$ZD_WaiYuDengJi'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_WaiYuDengJi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XingQuAiHao'>
		                        <li style='text-align:right;width:220px'>兴趣爱好:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XingQuAiHao' id='ZD_XingQuAiHao' class='addboxinput inputfocus'  value='$ZD_XingQuAiHao'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingQuAiHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenFenZhengDiZhi'>
		                        <li style='text-align:right;width:220px'>身份证地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenFenZhengDiZhi' id='ZD_ShenFenZhengDiZhi' class='addboxinput inputfocus'  value='$ZD_ShenFenZhengDiZhi'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenFenZhengDiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XianZhuDiZhi'>
		                        <li style='text-align:right;width:220px'>现住地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XianZhuDiZhi' id='ZD_XianZhuDiZhi' class='addboxinput inputfocus'  value='$ZD_XianZhuDiZhi'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XianZhuDiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenFenZhengHaoMa'>
		                        <li style='text-align:right;width:220px'>身份证号码:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenFenZhengHaoMa' id='ZD_ShenFenZhengHaoMa' class='addboxinput inputfocus'  value='$ZD_ShenFenZhengHaoMa'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenFenZhengHaoMa_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_LianXiDianHua'>
		                        <li style='text-align:right;width:220px'>联系电话:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_LianXiDianHua' id='ZD_LianXiDianHua' class='addboxinput inputfocus'  value='$ZD_LianXiDianHua'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_LianXiDianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JinJiLianXiRenDianHua'>
		                        <li style='text-align:right;width:220px'>紧急联系人/电话:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JinJiLianXiRenDianHua' id='ZD_JinJiLianXiRenDianHua' class='addboxinput inputfocus'  value='$ZD_JinJiLianXiRenDianHua'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JinJiLianXiRenDianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XueXiJingLi'>
		                        <li style='text-align:right;width:220px'>学习经历:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ZD_XueXiJingLi' id='ZD_XueXiJingLi' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$ZD_XueXiJingLi</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XueXiJingLi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZhuYaoGongZuoJingLi'>
		                        <li style='text-align:right;width:220px'>主要工作经历:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ZD_ZhuYaoGongZuoJingLi' id='ZD_ZhuYaoGongZuoJingLi' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$ZD_ZhuYaoGongZuoJingLi</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZhuYaoGongZuoJingLi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiaTingQingKuang'>
		                        <li style='text-align:right;width:220px'>家庭情况:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ZD_JiaTingQingKuang' id='ZD_JiaTingQingKuang' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$ZD_JiaTingQingKuang</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiaTingQingKuang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZiWoPingJia'>
		                        <li style='text-align:right;width:220px'>自我评价:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZiWoPingJia' id='ZD_ZiWoPingJia' class='addboxinput inputfocus'  value='$ZD_ZiWoPingJia'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZiWoPingJia_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BeiZhu'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus'  value='$ZD_BeiZhu'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BeiZhu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_198'>
		                        <li style='text-align:right;width:220px'>[关系]质量记录归档登记表ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_198' id='sys_gx_id_198' class='addboxinput inputfocus'  value='$sys_gx_id_198'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_198_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_198','48','SQP_JianLiZhongXin','DeskMenuDiv315');</script>
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px;'><li style='width:98%'></li></ul>";
if ( strpos($const_q_tianj, "315") !== false  ) { //有添加权限时
       echo"<ul>
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingBie,ZD_JiGuan,ZD_MinZu,ZD_ShenQingRiQi,ZD_ShenQingGangWei,ZD_QiWangXinZi,ZD_XueLi,ZD_XingMing,ZD_HunYin,ZD_ShenGao,ZD_TiZhong,ZD_WaiYuDengJi,ZD_XingQuAiHao,ZD_ShenFenZhengDiZhi,ZD_XianZhuDiZhi,ZD_ShenFenZhengHaoMa,ZD_LianXiDianHua,ZD_JinJiLianXiRenDianHua,ZD_XueXiJingLi,ZD_ZhuYaoGongZuoJingLi,ZD_JiaTingQingKuang,ZD_ZiWoPingJia,ZD_BeiZhu,sys_gx_id_198'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='SQP_JianLiZhongXin' Wuchongfu_Arry=''  onclick=data_add_arrys(this,'#post_form','$ToHtmlID')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>";
}
		echo"<input type='hidden' name='re_id' id='re_id' value='315' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_JianLiZhongXin','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#".$ToHtmlID."_content_foot .htmlleirong','sys_nowbh');form_weikong('#post_form','DeskMenuDiv315');</script>";

?>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>