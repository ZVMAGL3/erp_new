<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
        include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
	    include_once 'B_quanxian.php';
	    include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
	
	    global $strmk_id,$Conn,$const_q_xiug,$const_q_shenghe,$const_q_pizhun,$ToHtmlID;
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表id
	    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
		
		if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};//是否为回收站0为不回收
	    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};//是否为回收站0为不回收
		
	    $zu_all_list="286=已处理,287=试用,285=重要类别,";
	    $sql = 'select * From `SQP_JianLiZhongXin` where `id`='.$strmk_id;
        $rs = mysqli_query(  $Conn , $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
echo"<form id='post_form' autocomplete='off' SYS_Company_id='$SYS_Company_id' strmk_id='$strmk_id' zu_all_list='$zu_all_list' style='padding-top:18px'><div id='mobanaddbox2' class='NowULTable nocopytext' style='width:100%;'>";
echo"<span class='ContentTwo ContentTwo1' style='display:block'>";
echo"
	                         <ul zd='ZD_XingMing'>
		                        <li style='text-align:right;width:220px'>姓名:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XingMing' id='ZD_XingMing' class='addboxinput inputfocus'  value='$row[ZD_XingMing]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingMing_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XingBie'>
		                        <li style='text-align:right;width:220px'>性别:</li>
                                
		                        <li style='width:40%' class='reset_list'><label><input name='ZD_XingBie' type='radio' typeid='11' id='ZD_XingBie_0' value='男' class='addboxinput inputfocus'   checked='checked '    />男&nbsp;&nbsp;&nbsp;</label><label><input name='ZD_XingBie' type='radio' typeid='11' id='ZD_XingBie_1' class='addboxinput inputfocus' value='女'  checked='checked'    />女</label><script>Inputdate('ZD_XingBie','11','$row[ZD_XingBie]','DeskMenuDiv315','');</script></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingBie_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiGuan'>
		                        <li style='text-align:right;width:220px'>籍贯:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JiGuan' id='ZD_JiGuan' class='addboxinput inputfocus'  value='$row[ZD_JiGuan]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiGuan_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_MinZu'>
		                        <li style='text-align:right;width:220px'>民族:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_MinZu' id='ZD_MinZu' class='addboxinput inputfocus'  value='$row[ZD_MinZu]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_MinZu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenQingRiQi'>
		                        <li style='text-align:right;width:220px'>申请日期:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenQingRiQi' id='ZD_ShenQingRiQi' class='addboxinput inputfocus'  value='$row[ZD_ShenQingRiQi]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenQingRiQi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenQingGangWei'>
		                        <li style='text-align:right;width:220px'>申请岗位:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenQingGangWei' id='ZD_ShenQingGangWei' class='addboxinput inputfocus'  value='$row[ZD_ShenQingGangWei]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenQingGangWei_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_QiWangXinZi'>
		                        <li style='text-align:right;width:220px'>期望薪资:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_QiWangXinZi' id='ZD_QiWangXinZi' class='addboxinput inputfocus'  value='$row[ZD_QiWangXinZi]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_QiWangXinZi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XueLi'>
		                        <li style='text-align:right;width:220px'>学历:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XueLi' id='ZD_XueLi' class='addboxinput inputfocus'  value='$row[ZD_XueLi]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XueLi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_HunYin'>
		                        <li style='text-align:right;width:220px'>婚姻:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_HunYin' id='ZD_HunYin' class='addboxinput inputfocus'  value='$row[ZD_HunYin]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_HunYin_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenGao'>
		                        <li style='text-align:right;width:220px'>身高:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenGao' id='ZD_ShenGao' class='addboxinput inputfocus'  value='$row[ZD_ShenGao]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenGao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_TiZhong'>
		                        <li style='text-align:right;width:220px'>体重:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_TiZhong' id='ZD_TiZhong' class='addboxinput inputfocus'  value='$row[ZD_TiZhong]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_TiZhong_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_WaiYuDengJi'>
		                        <li style='text-align:right;width:220px'>外语等级:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_WaiYuDengJi' id='ZD_WaiYuDengJi' class='addboxinput inputfocus'  value='$row[ZD_WaiYuDengJi]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_WaiYuDengJi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XingQuAiHao'>
		                        <li style='text-align:right;width:220px'>兴趣爱好:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XingQuAiHao' id='ZD_XingQuAiHao' class='addboxinput inputfocus'  value='$row[ZD_XingQuAiHao]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XingQuAiHao_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenFenZhengDiZhi'>
		                        <li style='text-align:right;width:220px'>身份证地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenFenZhengDiZhi' id='ZD_ShenFenZhengDiZhi' class='addboxinput inputfocus'  value='$row[ZD_ShenFenZhengDiZhi]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenFenZhengDiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XianZhuDiZhi'>
		                        <li style='text-align:right;width:220px'>现住地址:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_XianZhuDiZhi' id='ZD_XianZhuDiZhi' class='addboxinput inputfocus'  value='$row[ZD_XianZhuDiZhi]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XianZhuDiZhi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShenFenZhengHaoMa'>
		                        <li style='text-align:right;width:220px'>身份证号码:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShenFenZhengHaoMa' id='ZD_ShenFenZhengHaoMa' class='addboxinput inputfocus'  value='$row[ZD_ShenFenZhengHaoMa]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShenFenZhengHaoMa_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_LianXiDianHua'>
		                        <li style='text-align:right;width:220px'>联系电话:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_LianXiDianHua' id='ZD_LianXiDianHua' class='addboxinput inputfocus'  value='$row[ZD_LianXiDianHua]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_LianXiDianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JinJiLianXiRenDianHua'>
		                        <li style='text-align:right;width:220px'>紧急联系人/电话:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JinJiLianXiRenDianHua' id='ZD_JinJiLianXiRenDianHua' class='addboxinput inputfocus'  value='$row[ZD_JinJiLianXiRenDianHua]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JinJiLianXiRenDianHua_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_XueXiJingLi'>
		                        <li style='text-align:right;width:220px'>学习经历:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ZD_XueXiJingLi' id='ZD_XueXiJingLi' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$row[ZD_XueXiJingLi]</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_XueXiJingLi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZhuYaoGongZuoJingLi'>
		                        <li style='text-align:right;width:220px'>主要工作经历:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ZD_ZhuYaoGongZuoJingLi' id='ZD_ZhuYaoGongZuoJingLi' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$row[ZD_ZhuYaoGongZuoJingLi]</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZhuYaoGongZuoJingLi_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JiaTingQingKuang'>
		                        <li style='text-align:right;width:220px'>家庭情况:</li>
                                
		                        <li style='width:40%' class='reset_list'><textarea type='textarea' typeid='2' name='ZD_JiaTingQingKuang' id='ZD_JiaTingQingKuang' class='addboxinput inputfocus' style='width:100%;height:25px;'   >$row[ZD_JiaTingQingKuang]</textarea></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JiaTingQingKuang_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZiWoPingJia'>
		                        <li style='text-align:right;width:220px'>自我评价:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZiWoPingJia' id='ZD_ZiWoPingJia' class='addboxinput inputfocus'  value='$row[ZD_ZiWoPingJia]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZiWoPingJia_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_RenShiBuPingYu'>
		                        <li style='text-align:right;width:220px'>人事部评语:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_RenShiBuPingYu' id='ZD_RenShiBuPingYu' class='addboxinput inputfocus'  value='$row[ZD_RenShiBuPingYu]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_RenShiBuPingYu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BuMenJingLiPingYu'>
		                        <li style='text-align:right;width:220px'>部门经理评语:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_BuMenJingLiPingYu' id='ZD_BuMenJingLiPingYu' class='addboxinput inputfocus'  value='$row[ZD_BuMenJingLiPingYu]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BuMenJingLiPingYu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZongJingLiPingYu'>
		                        <li style='text-align:right;width:220px'>总经理评语:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZongJingLiPingYu' id='ZD_ZongJingLiPingYu' class='addboxinput inputfocus'  value='$row[ZD_ZongJingLiPingYu]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZongJingLiPingYu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_JieLun'>
		                        <li style='text-align:right;width:220px'>结论:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_JieLun' id='ZD_JieLun' class='addboxinput inputfocus'  value='$row[ZD_JieLun]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_JieLun_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_RuZhiShiJian'>
		                        <li style='text-align:right;width:220px'>入职时间:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_RuZhiShiJian' id='ZD_RuZhiShiJian' class='addboxinput inputfocus'  value='$row[ZD_RuZhiShiJian]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_RuZhiShiJian_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ShiXiQiXin'>
		                        <li style='text-align:right;width:220px'>实习期/薪:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ShiXiQiXin' id='ZD_ShiXiQiXin' class='addboxinput inputfocus'  value='$row[ZD_ShiXiQiXin]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ShiXiQiXin_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZhuanZhengHouXin'>
		                        <li style='text-align:right;width:220px'>转正后/薪:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZhuanZhengHouXin' id='ZD_ZhuanZhengHouXin' class='addboxinput inputfocus'  value='$row[ZD_ZhuanZhengHouXin]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZhuanZhengHouXin_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_ZhuSuAnPai'>
		                        <li style='text-align:right;width:220px'>住宿安排:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_ZhuSuAnPai' id='ZD_ZhuSuAnPai' class='addboxinput inputfocus'  value='$row[ZD_ZhuSuAnPai]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_ZhuSuAnPai_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='ZD_BeiZhu'>
		                        <li style='text-align:right;width:220px'>备注:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='ZD_BeiZhu' id='ZD_BeiZhu' class='addboxinput inputfocus'  value='$row[ZD_BeiZhu]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='ZD_BeiZhu_bitian'></li>
                                
		                     </ul>
	                         
";
echo"
	                         <ul zd='sys_gx_id_198'>
		                        <li style='text-align:right;width:220px'>[关系]质量记录归档登记表ID:</li>
                                
		                        <li style='width:40%' class='reset_list'><input type='text' typeid='1' name='sys_gx_id_198' id='sys_gx_id_198' class='addboxinput inputfocus'  value='$row[sys_gx_id_198]'  style='width:100%'   /></li>
								
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='sys_gx_id_198_bitian'></li>
                                <script> GuanXiFillInput('sys_gx_id_198','48','SQP_JianLiZhongXin','DeskMenuDiv315');</script>
		                     </ul>
	                         
";
echo"</span>";
echo"<ul style='height:15px'><li style='width:98%'></li></ul>";
echo"<ul><li style='width:220px;text-align:right;'><i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>&nbsp;</li><li style='width:40%;text-align:left;padding-left:2px;'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='ZD_XingBie,ZD_JiGuan,ZD_MinZu,ZD_ShenQingRiQi,ZD_ShenQingGangWei,ZD_QiWangXinZi,ZD_XueLi,ZD_XingMing,ZD_HunYin,ZD_ShenGao,ZD_TiZhong,ZD_WaiYuDengJi,ZD_XingQuAiHao,ZD_ShenFenZhengDiZhi,ZD_XianZhuDiZhi,ZD_ShenFenZhengHaoMa,ZD_LianXiDianHua,ZD_JinJiLianXiRenDianHua,ZD_XueXiJingLi,ZD_ZhuYaoGongZuoJingLi,ZD_JiaTingQingKuang,ZD_ZiWoPingJia,ZD_RenShiBuPingYu,ZD_BuMenJingLiPingYu,ZD_ZongJingLiPingYu,ZD_JieLun,ZD_RuZhiShiJian,ZD_ShiXiQiXin,ZD_ZhuanZhengHouXin,ZD_ZhuSuAnPai,ZD_BeiZhu,sys_gx_id_198'/>";
if ( strpos($const_q_xiug, "315") !== false ) { //有修改权限时
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry=''  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />";
}else{
    echo"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=add_data(this,$strmk_id,'$ToHtmlID') />";
    echo"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='$SYS_Company_id'  firstinputname='sys_nowbh' bitian_Arry=''  Wuchongfu_Arry=''  onclick=alert('您无修改权限')  style='width:87%'  />";
};
echo"<input type='hidden' name='re_id' value='315' />";
echo"<input type='hidden' name='strmk_id' value='$strmk_id'/>";
echo"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div>";
echo"</form>";
echo"<script>guanximenucopy('$ToHtmlID');YanZhen_ChongFu_ZuLoad('$strmk_id','','SQP_JianLiZhongXin','$ToHtmlID');inputfocusfirst('#$ToHtmlID  #content_foot .htmlleirong','sys_nowbh');</script>
<div class='moban_set_menu'>
<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>
<A title='修改记录'  onClick=SelectTag_Menu('DeskMenuDiv315_MenuDiv_368',this,'$ToHtmlID','368',$strmk_id)>E+</A>
</div>
<script>form_weikong('#post_form','$ToHtmlID');</script>

";
 echo( "<script>ListLoadEND('$ToHtmlID');</script>" );
mysqli_close( $Conn ); //关闭数据库

?>