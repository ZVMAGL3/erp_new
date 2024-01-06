<?php

//【ok】=========================================================================权限筛选sql
//function QuanXian_Sql($Sql) {
	
//};

//=========================================================================$sql查询到分页数据
function sql_all_cache( $TableName, $ZD_List, $fy, $nowkeyword, $huis=0) { //在$dTableName(表),ziduan_list（显示的字段清单）,$fy（0分页，1不分页不排序）".ziduan_list."
	$sql = $sql2 = '';
	$fy = intval( $fy );
	if ( '1' . $TableName <> '1' ) {
		$ZD_List=move_arrynull($ZD_List);//这里去除首尾逗号 和 空字符串
		$sql = "select  $ZD_List  from `$TableName` where id in(".'$sql_all_id_list'.") and sys_yfzuid=".'\'$hy\''.' and sys_huis='.'\'$huis\'';
		//echo ($sql);
	};
	return $sql;
} //function end

//=========================================================================$sql查询到总数据用于统计数据 moban_foot.php用
function sql_all_counts( $TableName, $nowkeyword, $huis=0, $ZD_in_List=0 ) { 
	global $hy;
	$sql=$sql2='';
	if ( '1' . $TableName <> '1' ) {
		$sql = 'select  id  from `' . $TableName . '` where sys_yfzuid='.$hy.' and sys_huis='.$huis;
		//echo ($sql);
	};
	return $sql;
} //function end

//=========================================================================$sql查询到分页数据的id值合集
function sql_all_id_cache( $TableName, $ZD_List, $nowkeyword ) {
	$sql = $sql2 = '';
	if ( '1' . $TableName <> '1' ) {
		$sql = 'select (@rownum:=@rownum+1) as rownum,' . $TableName . '.' . $ZD_List . '  from `' . $TableName . '`,(select @rownum:=0) as ' . $TableName . ' where  sys_yfzuid='.'\'$hy\''.' and sys_huis=' . '\'$huis\' ' ;
		//echo ($sql);
	};
	return $sql;
} //function end
//=========================================================================$sql查询到的列转为字符串
function sql_all_id_list($sql,$Conn) {
	$sql_all_id_list = $rs = '';
	// echo $sql;
	$rs = mysqli_query($Conn,$sql);
	//$nowrscount = mysqli_num_rows( $rs ); //统计数量 无用
	//echo $sql;
	if ( $rs ) {
		while ( $row = mysqli_fetch_array( $rs ) ) {
			$sql_all_id_list .= $row[ 'id' ]. ',';
		};
		mysqli_free_result( $rs ); //释放内存
	}else{
		echo mysqli_error($Conn);
	};
	$sql_all_id_list = trim( $sql_all_id_list, ',' );
	return $sql_all_id_list;
} //function end

//=========================================================================根据权限来重构SQL
function sql_search($TableName, $sql, $nowkeyword, $huis=0) { //在$dTableName(表),ziduan_list（显示的字段清单）,$fy（0分页，1不分页不排序）".ziduan_list."
	//return $sql;
	global $hy,$bh, $const_q_fanwei,$sys_id_bumen,$const_id_bumen, $const_id_fz, $pok, $px_ziduan, $pxv, $nowzu, $zd, $sys_id_login,$re_id,$sys_adddate,$ShaiXuanSql,$ShaiXuanSql_other,$sys_shenpi,$sys_shenpi_all,$sys_chaosong;

	$pok = intval( $pok );
	//echo $const_q_fanwei;
	
	if ( '1' . $TableName <> '1' ) {
		//------------------------------------------[分类]
		if ( $nowzu <> 0 )$sql .= " and (sys_id_zu  like '%$nowzu%' or sys_id_zu like '$nowzu%' or sys_id_zu like '%$nowzu' or sys_id_zu ='$nowzu' )";
		//------------------------------------------[关键词]
		if ( $nowkeyword <> '' ) {
			if ( $zd == '0' ) {
				$SQL_QMSYS_ziduan = Tablecol_list( $TableName );
				$sql .= " and CONCAT(" . isfullzd( $SQL_QMSYS_ziduan ) . ") like '%$nowkeyword%'"; //CONCAT（） like 更快
				//echo "<script>alert('$sql')</script>";
			} else {
				$sql .= " and `$zd` like '%$nowkeyword%' ";
			}
		}
		
		//------------------------------------------[SQL筛选语句]
        if ($ShaiXuanSql.'1' != '1'){ $sql .= " and $ShaiXuanSql "; };
		//------------------------------------------[更多字段]
        if ($ShaiXuanSql_other.'1' != '1'){	$sql .= " $ShaiXuanSql_other"; };
		//------------------------------------------[部门]
		//if ( $sys_id_bumen>0 ) { $sql .= " and sys_id_bumen='$sys_id_bumen'"; };
		//------------------------------------------[编制人]
		//if ( $sys_id_login > 0) { $sql .= " and sys_id_login='$sys_id_login' "; };
		//------------------------------------------[审核人]
		if ( $sys_shenpi > 0) {
			$sql .= " and (sys_shenpi  like '%$sys_shenpi%' or sys_shenpi like '$sys_shenpi%' or sys_shenpi like '%$sys_shenpi' or sys_shenpi ='$sys_shenpi' )";
		}
		//------------------------------------------[批准人]
		if ( $sys_shenpi_all > 0) {
			$sql .= " and (sys_shenpi_all  like '%$sys_shenpi_all%' or sys_shenpi_all like '$sys_shenpi_all%' or sys_shenpi_all like '%$sys_shenpi_all' or sys_shenpi_all ='$sys_shenpi_all' )";
		}
		//------------------------------------------[经办人]
		if ( $sys_chaosong > 0) {
			$sql .= " and (sys_chaosong  like '%$sys_chaosong%' or sys_chaosong like '$sys_chaosong%' or sys_chaosong like '%$sys_chaosong' or sys_chaosong ='$sys_chaosong' )";
		}
		
		//------------------------------------------[添加、修改时间]
		if ( $sys_adddate != '' and $sys_adddate != '0') {	$sql .= " and  $sys_adddate"; };
		
		//------------------------------------------[权限]
		if ( $const_q_fanwei == 0) { //权限为个人时
			$sql .= " and (sys_id_login='$bh' ) ";
		}else if ( $const_q_fanwei == 1) { //部门
			$sql .= " and sys_id_bumen='$const_id_bumen'  ";//
		}else if ( $const_q_fanwei == 2) { //分公司
			$sql .= " and sys_id_fz='$const_id_fz'  ";//sys_shenpi_all='1' or 
		}else if ( $const_q_fanwei == 3) { //总公司
			$sql = $sql;
		}
	}
	//echo $sql;
	return $sql;
} //function end

//=========================================================================a_ziduan=a,b,c,d,e $nowkeyword关键词//多字段搜索数组函数//echo
function isfullzd( $A_ziduan ) {
	$isfullzd = '';
	$A_ziduan = trim( $A_ziduan, ',' );
	$Arr_ziduan = explode( ',', $A_ziduan );
	$nowcount = count( $Arr_ziduan );

	for ( $i = 0; $i < $nowcount; $i++ ) {
		$nowziduan = "IFNULL(" . $Arr_ziduan[ $i ] . ",'')";
		$isfullzd = $isfullzd . ',' . $nowziduan;
	};
	$isfullzd = trim( $isfullzd, ',' );
	//$isfullzd=' and '.'('.$isfullzd.')';
	return $isfullzd;
} //function end



//========================================================================= 生成cache
function table_cache($Conn,$databiao,$Tablecol_list) {
	
	global $r_cow_height,$xt_m_ziduan,$xt_m_ziduan_Name,$zd_en_name,$now_id;
	$Htmlcache02s = '';
	//=================================================================================================================【锁定列数】
	$shuodingnum=SHOW_FULL_COLUMNS($databiao,6);//返回6列为锁定列的总数
	//------------------------------------------------------------------------------------------------------------------------【锁定列】
	$sql = "SHOW FULL COLUMNS FROM `$databiao`";
	//echo $sql.'_'; 
	$rs = mysqli_query( $Conn, $sql );
	$xianshi_ZD_num = mysqli_num_rows( $rs ); //总数
	if ( $xianshi_ZD_num == 0 ) {
			$Htmlcache02s .= "              echo\"<li class='shuodingli border_shuoding' style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;width:350px;'>没有设定显示列,请先设定</li>\"; ";
	} else {
			$i = 0;
			while ( $row = mysqli_fetch_array( $rs ) ) {
				
				$zd_en_name = $row[ 'Field' ]; //字段
				$zdbeizhu = $row[ 'Comment' ]; //备注
				$NEW_zdbeizhu=colbeizhu($zdbeizhu,$zd_en_name);
				//0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
				if ( getN( $Tablecol_list, $zd_en_name ) >= 0 ) {           //如果查得到该字段时
					$zd_cn_name=textN( $NEW_zdbeizhu, 0, ',' );             //中文字段名
					$zd_xianshi_width = textN( $NEW_zdbeizhu, 1, ',' );     //字段显示宽度
					$zd_xianshi_input_id = textN( $NEW_zdbeizhu, 4, ',' );   //显示类型
					$zd_xianshi_is = textN( $NEW_zdbeizhu, 5, ',' );         //5为显示
                    $zd_shuoding_is = textN( $NEW_zdbeizhu, 6, ',' );        //6为锁定列
			 if($zd_xianshi_is==1 and $zd_shuoding_is==1 and $zd_en_name!='id'){
				    $i++;
						$zd_xianshi_width=XianShiWidthMoren($zd_en_name,$zd_xianshi_width);//设定系统默认宽度和最小显示宽度
							
						$getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //当>=0为系统字段时
					    if ( $getN_XTZD >= 0 ) {
							$zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',' ); //显示字段系统名称					
						};
					    $zd_cn_name = SysChangeName( $zd_cn_name, $databiao ); //变更系统设定名
						//$colls='coll'.'_'.$re_id.'_'.$III+1;
						$classss = "shuodingli  ";	
				        if ( $i == $shuodingnum ) { //结束列
					       $classss .= "border_shuoding " ;
				        };
						if ( $i == 1 ) {
							$nowidhtml = "id='c_tdtop" . $i . "' ";
						} else {
							$nowidhtml = '';
						};
						$datezd = '".DeleteHtml($row[\''.$zd_en_name.'\'])."'; //得到数据
						$id_login = '$row[\'sys_id_login\']'; //得到id用户
						$shenpi_all = '$row[\'sys_shenpi_all\']'; //得到id用户
						if ('1'.trim($datezd)=='1') $datezd='&nbsp;';
						$classss = $classss . ' ET_' . $zd_en_name . '$now_id';
						$ET = 'ET_' . $zd_en_name;
						$classss = $classss . ' F_M_XS_' . $zd_xianshi_input_id; //加上类型列
                        $Htmlcache02s .= '              echo("';
						$Htmlcache02s .= "<li $nowidhtml class='$classss' ET='$ET'  xstypeid='$zd_xianshi_input_id' name='$zd_en_name' style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;width:" . $zd_xianshi_width . "px;'>$datezd</li>";
						$Htmlcache02s .= '");'."\n";
						}
							//echo "<li class='$classss' name='$zd_en_name' style='width:" . $zd_xianshi_width . "px'>$zd_cn_name</li>";
				};//end if
			};//while
	};//end if
	mysqli_free_result( $rs ); //释放内存
	
	//------------------------------------------------------------------------------------------------------------------------【显示列】
	$sql = "SHOW FULL COLUMNS FROM `$databiao`";
	//echo $sql.'_'; 
	$rs = mysqli_query( $Conn, $sql );
	$xianshi_ZD_num = mysqli_num_rows( $rs ); //总数
	if ( $xianshi_ZD_num == 0 ) {
			//$Htmlcache02s .= "              echo\"<li class='shuodingli border_shuoding' style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;width:350px;'>没有设定显示列,请先设定</li>\"; ";
	} else {
			$ii = 0;
			while ( $row = mysqli_fetch_array( $rs ) ) {
				$ii++;
				$zd_en_name = $row[ 'Field' ]; //字段
				$zdbeizhu = $row[ 'Comment' ]; //备注
				$NEW_zdbeizhu=colbeizhu($zdbeizhu,$zd_en_name);
				//0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
				if ( getN( $Tablecol_list, $zd_en_name ) >= 0 ) {           //如果查得到该字段时
					$zd_cn_name=textN( $NEW_zdbeizhu, 0, ',' );             //中文字段名
					$zd_xianshi_width = textN( $NEW_zdbeizhu, 1, ',' );     //字段显示宽度
					$zd_xianshi_input_id = textN( $NEW_zdbeizhu, 4, ',' );   //显示类型
					$zd_xianshi_is = textN( $NEW_zdbeizhu, 5, ',' );         //5为显示
                    $zd_shuoding_is = textN( $NEW_zdbeizhu, 6, ',' );        //6为锁定列
			 if($zd_xianshi_is==1 and $zd_shuoding_is==0 and $zd_en_name!='id'){
						$zd_xianshi_width=XianShiWidthMoren($zd_en_name,$zd_xianshi_width);//设定系统默认宽度和最小显示宽度
							
						$getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //当>=0为系统字段时
					    if ( $getN_XTZD >= 0 ) {
							$zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',' ); //显示字段系统名称					
						};
					    $zd_cn_name = SysChangeName( $zd_cn_name, $databiao ); //变更系统设定名
						//$colls='coll'.'_'.$re_id.'_'.$III+1;
						if ( $ii == $xianshi_ZD_num ) { //结束列
							$classss = "endli";
						} else { //常规列
							$classss = "contentli"; //内容列样式
						};
						//if ( $ii == 1 ) {
							//$nowidhtml = "id='c_tdtop" . $ii . "' ";
						//} else {
							//$nowidhtml = '';
						//};
						$datezd = '".DeleteHtml($row[\''.$zd_en_name.'\'])."'; //得到数据
						$id_login = '$row[\'sys_id_login\']'; //得到id用户
						$shenpi_all = '$row[\'sys_shenpi_all\']'; //得到id用户
						if ('1'.trim($datezd)=='1') $datezd='&nbsp;';
						$classss = $classss . ' ET_' . $zd_en_name . '$now_id';
						$ET = 'ET_' . $zd_en_name;
						$classss = $classss . ' F_M_XS_' . $zd_xianshi_input_id; //加上类型列
                        $Htmlcache02s .= '              echo("';
						$Htmlcache02s .= "<li class='$classss' ET='$ET'  xstypeid='$zd_xianshi_input_id' name='$zd_en_name' style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;width:" . $zd_xianshi_width . "px;'>$datezd</li>";
						$Htmlcache02s .= '");'."\n";
						}
							//echo "<li class='$classss' name='$zd_en_name' style='width:" . $zd_xianshi_width . "px'>$zd_cn_name</li>";
				};//end if
			};//while
	};//end if
	mysqli_free_result( $rs ); //释放内存
	return $Htmlcache02s;
};
//========================================================================= 显示界面格式化样式
function FormattingXianShi_idlist($Conn,$databiao,$ToHtmlID) {
	
	global $r_cow_height,$xt_m_ziduan,$xt_m_ziduan_Name,$zd_en_name,$now_id;
	$FormattingXianShi_idlist = '';
	
	//------------------------------------------------------------------------------------------------------------------------【锁定列】
	$sql = "SHOW FULL COLUMNS FROM `$databiao`";
	//echo $sql.'_'; 
	$rs = mysqli_query( $Conn, $sql );
	// echo mysqli_error($Conn);
	$xianshi_ZD_num = mysqli_num_rows( $rs ); //总数
	if ( $xianshi_ZD_num == 0 ) {
			$FormattingXianShi_idlist = "";
	} else {
			$i = 0;
			while ( $row = mysqli_fetch_array( $rs ) ) {
				
				$zd_en_name = $row[ 'Field' ]; //字段
				$zdbeizhu = $row[ 'Comment' ]; //备注
				$NEW_zdbeizhu=colbeizhu($zdbeizhu,$zd_en_name);
				//0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
				//$zd_cn_name=textN( $NEW_zdbeizhu, 0, ',' );             //中文字段名
				//$zd_xianshi_width = textN( $NEW_zdbeizhu, 1, ',' );     //字段显示宽度
				$zd_xianshi_input_id = textN( $NEW_zdbeizhu, 4, ',' );   //显示类型
				$zd_xianshi_is = textN( $NEW_zdbeizhu, 5, ',' );         //5为显示
                    
			    if($zd_xianshi_is==1 and $zd_en_name!='id'){
				    //$i++;
					    //$zd_xianshi_width=XianShiWidthMoren($zd_en_name,$zd_xianshi_width);//设定系统默认宽度和最小显示宽度
					    //$getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //当>=0为系统字段时
					    //if ( $getN_XTZD >= 0 ) {
					    //	$zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',' ); //显示字段系统名称					
					    //};
					    //$zd_cn_name = SysChangeName( $zd_cn_name, $databiao ); //变更系统设定名
						//$classss = $classss . ' ET_' . $zd_en_name . '$now_id';
						//$ET = 'ET_' . $zd_en_name;
					  //$classss = 'F_M_XS_' . $zd_xianshi_input_id; //加上类型列
                      $FormattingXianShi_idlist.=$zd_xianshi_input_id.',';
				        
				 }
				
			};//while
	};//end if
	$FormattingXianShi_idlist=QuChong( $FormattingXianShi_idlist );//去重复值
	mysqli_free_result( $rs ); //释放内存
	return $FormattingXianShi_idlist;
};

//========================================================================= 生成cache手机版用
function table_cols_cache_mobile($Conn,$databiao,$Tablecol_list) {
	global $r_cow_height,$xt_m_ziduan,$shuoding_num_list,$xt_m_ziduan_Name,$zd_en_name,$now_id;
	$Htmlcache02s = '';

	$sql = "SHOW FULL COLUMNS FROM `$databiao`";
				//echo $sql.'_'; 
				$rs = mysqli_query( $Conn, $sql );
				$xianshi_ZD_num = mysqli_num_rows( $rs ); //总数
				if ( $xianshi_ZD_num == 0 ) {
					$Htmlcache02s .= "              echo\"<li><a>请先添加字段...</a></li>\"; ";
				} else {
					$Htmlcache02s .= '              echo("<li onclick=edit_data(this,\'$now_id\',\'$ToHtmlID\',\'$hy\')><a><label class=\'nowcolfirst\'><input type=\'checkbox\'  name=\'ID\' value=\'".$row["id"]."\' style=\'display: inline-block;\'></label> ");'."\n";
					$ii = $i2 = 0;
					while ( $row = mysqli_fetch_array( $rs ) ) {
						$ii++;
						$zd_en_name = $row[ 'Field' ]; //字段
						$zdbeizhu = $row[ 'Comment' ]; //备注
				        $NEW_zdbeizhu=colbeizhu($zdbeizhu,$zd_en_name);
						//0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
						
						if ( getN( $Tablecol_list, $zd_en_name ) >= 0 ) {            //如果查得到该字段时
							
							
							$zd_cn_name=textN( $NEW_zdbeizhu, 0, ',' );              //字段名称	
							$zd_xianshi_width = textN( $NEW_zdbeizhu, 1, ',' );      //字段显示宽度
							$zd_xianshi_input_id = textN( $NEW_zdbeizhu, 4, ',' );   //显示类型
                            $zd_xianshi_is = textN( $NEW_zdbeizhu, 11, ',' );        //1为显示
							if($zd_xianshi_is==1){
							   $i2++;
							   $getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //当>=0为系统字段时
							   if ( $getN_XTZD >= 0 ) {
								  $zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',' ); //显示字段系统名称					
							   };
							   $zd_cn_name = SysChangeName( $zd_cn_name, $databiao ); //变更系统设定名
							   $datezd = '".DeleteHtml($row[\''.$zd_en_name.'\'])."'; //得到数据
							   //$id_login = '$row[\'sys_id_login\']'; //得到id用户
							   //$shenpi_all = '$row[\'sys_shenpi_all\']'; //得到id用户
							   if ('1'.trim($datezd)=='1') $datezd='&nbsp;';
							   $classss = 'ET_' . $zd_en_name;
							   $classss = 'F_M_XS_' . $zd_xianshi_input_id.' '.$classss; //加上类型列
                               $Htmlcache02s .= '              echo("<font  style=width:'.$zd_xianshi_width.'px class=\''.$classss.'$now_id\'>';
							   $Htmlcache02s .= "$datezd".'&nbsp;';

							   $Htmlcache02s .= '</font>");'."\n";
		
							//echo "<li class='$classss' name='$zd_en_name' style='width:" . $zd_xianshi_width . "px'>$zd_cn_name</li>";
							}
							
						};
					};
					if($i2==0){
							   $datezd = '".DeleteHtml($row[\'id\'])."'; //得到数据

							   if ('1'.trim($datezd)=='1') $datezd='&nbsp;';
							   $classss = 'ET_id';
							   $classss = 'F_M_XS_1 '.$classss; //加上类型列
                               $Htmlcache02s .= '              echo("<font  style=\'width:50px;color:#999;\' class=\''.$classss.'$now_id\'>';
							   $Htmlcache02s .= "$datezd".'&nbsp;&nbsp;手机端显示字段还未设定...';

							   $Htmlcache02s .= '</font>");'."\n";
					}
				$Htmlcache02s .= '              echo("</a>");'."\n";
				if ($shuoding_num_list.'1' <> '1'){//当锁定列不为空时
					
				   $Htmlcache02s .= '              echo("<em>".DeleteHtml($row[textN($shuoding_num_list,0, \',\')])."</em>");'."\n";
				}
				$Htmlcache02s .= '              echo("</li>");'."\n";
					
					
				};
				mysqli_free_result( $rs ); //释放内存
	return $Htmlcache02s;
};

?>