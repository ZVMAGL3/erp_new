<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'M_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
	    if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                                //1回收站0为不回收
	    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                               //是否为回收站0为不回收
	   
	    global $strmk_id,$Conn,$const_q_tianj;
	

		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `SQP_JianLiZhongXin` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	
		$ZD_XingMing=$row["ZD_XingMing"];
		$ZD_XingBie=$row["ZD_XingBie"];
		$ZD_JiGuan=$row["ZD_JiGuan"];
		$ZD_MinZu=$row["ZD_MinZu"];
		$ZD_ShenQingRiQi=$row["ZD_ShenQingRiQi"];
		$ZD_ShenQingGangWei=$row["ZD_ShenQingGangWei"];
		$ZD_QiWangXinZi=$row["ZD_QiWangXinZi"];
		$ZD_XueLi=$row["ZD_XueLi"];
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


		
		mysqli_free_result( $rs ); //释放内存
	
	
}else{
		$ZD_XingMing="";
		$ZD_XingBie="";
		$ZD_JiGuan="";
		$ZD_MinZu="汉";
		$ZD_ShenQingRiQi="";
		$ZD_ShenQingGangWei="";
		$ZD_QiWangXinZi="0";
		$ZD_XueLi="0";
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

};
?>

<form id='post_form' autocomplete='off' tit='' SYS_Company_id='51'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>

	                     <ul>
		                 <li class='cols01'>姓名:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XingMing' id='ZD_XingMing' class='addboxinput inputfocus'  value='<?php echo $ZD_XingMing ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XingMing_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>性别:</li>
		                 <li class='cols02 reset_list'><label><input name='ZD_XingBie' type='radio' typeid='11' id='ZD_XingBie_0' value='男' class='addboxinput inputfocus'   checked='checked'    />男&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XingBie' type='radio' typeid='11' id='ZD_XingBie_1' class='addboxinput inputfocus' value='女'  checked='checked'    />女</label><script>Inputdate('ZD_XingBie','11','<?php echo $ZD_XingBie ?>','DeskMenuDiv315','addbox');</script>
		                 <div class='cols03 font_red yanzheng' id='ZD_XingBie_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>籍贯:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JiGuan' id='ZD_JiGuan' class='addboxinput inputfocus'  value='<?php echo $ZD_JiGuan ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JiGuan_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>民族:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_MinZu' id='ZD_MinZu' class='addboxinput inputfocus'  value='<?php echo $ZD_MinZu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_MinZu_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>申请日期:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenQingRiQi' id='ZD_ShenQingRiQi' class='addboxinput inputfocus'  value='<?php echo $ZD_ShenQingRiQi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenQingRiQi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>申请岗位:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenQingGangWei' id='ZD_ShenQingGangWei' class='addboxinput inputfocus'  value='<?php echo $ZD_ShenQingGangWei ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenQingGangWei_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>期望薪资:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_QiWangXinZi' id='ZD_QiWangXinZi' class='addboxinput inputfocus'  value='<?php echo $ZD_QiWangXinZi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_QiWangXinZi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>学历:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XueLi' id='ZD_XueLi' class='addboxinput inputfocus'  value='<?php echo $ZD_XueLi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XueLi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>婚姻:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_HunYin' id='ZD_HunYin' class='addboxinput inputfocus'  value='<?php echo $ZD_HunYin ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_HunYin_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>身高:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenGao' id='ZD_ShenGao' class='addboxinput inputfocus'  value='<?php echo $ZD_ShenGao ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenGao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>体重:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_TiZhong' id='ZD_TiZhong' class='addboxinput inputfocus'  value='<?php echo $ZD_TiZhong ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_TiZhong_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>外语等级:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_WaiYuDengJi' id='ZD_WaiYuDengJi' class='addboxinput inputfocus'  value='<?php echo $ZD_WaiYuDengJi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_WaiYuDengJi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>兴趣爱好:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XingQuAiHao' id='ZD_XingQuAiHao' class='addboxinput inputfocus'  value='<?php echo $ZD_XingQuAiHao ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XingQuAiHao_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>身份证地址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenFenZhengDiZhi' id='ZD_ShenFenZhengDiZhi' class='addboxinput inputfocus'  value='<?php echo $ZD_ShenFenZhengDiZhi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenFenZhengDiZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>现住地址:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_XianZhuDiZhi' id='ZD_XianZhuDiZhi' class='addboxinput inputfocus'  value='<?php echo $ZD_XianZhuDiZhi ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_XianZhuDiZhi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>身份证号码:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ShenFenZhengHaoMa' id='ZD_ShenFenZhengHaoMa' class='addboxinput inputfocus'  value='<?php echo $ZD_ShenFenZhengHaoMa ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ShenFenZhengHaoMa_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>联系电话:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_LianXiDianHua' id='ZD_LianXiDianHua' class='addboxinput inputfocus'  value='<?php echo $ZD_LianXiDianHua ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_LianXiDianHua_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>紧急联系人/电话:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_JinJiLianXiRenDianHua' id='ZD_JinJiLianXiRenDianHua' class='addboxinput inputfocus'  value='<?php echo $ZD_JinJiLianXiRenDianHua ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_JinJiLianXiRenDianHua_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>学习经历:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_XueXiJingLi' id='ZD_XueXiJingLi' class='addboxinput inputfocus' style='width:100%;height:25px;'   ><?php echo $ZD_XueXiJingLi ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ZD_XueXiJingLi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>主要工作经历:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_ZhuYaoGongZuoJingLi' id='ZD_ZhuYaoGongZuoJingLi' class='addboxinput inputfocus' style='width:100%;height:25px;'   ><?php echo $ZD_ZhuYaoGongZuoJingLi ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ZD_ZhuYaoGongZuoJingLi_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>家庭情况:</li>
		                 <li class='cols02 reset_list'><textarea type='textarea' typeid='2' name='ZD_JiaTingQingKuang' id='ZD_JiaTingQingKuang' class='addboxinput inputfocus' style='width:100%;height:25px;'   ><?php echo $ZD_JiaTingQingKuang ?></textarea>
		                 <div class='cols03 font_red yanzheng' id='ZD_JiaTingQingKuang_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>自我评价:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_ZiWoPingJia' id='ZD_ZiWoPingJia' class='addboxinput inputfocus'  value='<?php echo $ZD_ZiWoPingJia ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_ZiWoPingJia_bitian'></div>
						 </li>
		                 </ul>

	                     <ul>
		                 <li class='cols01'>备注:</li>
		                 <li class='cols02 reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus'  value='<?php echo $ZD_BeiZhu ?>'  style='width:100%'   />
		                 <div class='cols03 font_red yanzheng' id='ZD_BeiZhu_bitian'></div>
						 </li>
		                 </ul>
<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>
<?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('DeskMenuDiv315',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','sys_nowbh')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingMing,ZD_XingBie,ZD_JiGuan,ZD_MinZu,ZD_ShenQingRiQi,ZD_ShenQingGangWei,ZD_QiWangXinZi,ZD_XueLi,ZD_HunYin,ZD_ShenGao,ZD_TiZhong,ZD_WaiYuDengJi,ZD_XingQuAiHao,ZD_ShenFenZhengDiZhi,ZD_XianZhuDiZhi,ZD_ShenFenZhengHaoMa,ZD_LianXiDianHua,ZD_JinJiLianXiRenDianHua,ZD_XueXiJingLi,ZD_ZhuYaoGongZuoJingLi,ZD_JiaTingQingKuang,ZD_ZiWoPingJia,ZD_BeiZhu'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='51' strmk_id='' firstinputname='sys_nowbh' bitian_Arry='' databiao='SQP_JianLiZhongXin' Wuchongfu_Arry='' onclick=data_add_arrys(this,'#addbox','DeskMenuDiv315')   onkeydown="EnterPress(event,this,this.click)" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>

		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='315' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div><script>YanZhen_ChongFu_ZuLoad(0,'','SQP_JianLiZhongXin','DeskMenuDiv315');form_add_copy('DeskMenuDiv315');inputfocusfirst('#addbox .htmlleirong','sys_nowbh');</script>

<?php 
mysqli_close( $Conn ); //关闭数据库

?>