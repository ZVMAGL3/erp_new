<?php
header( 'Content-type: text/html; charset=utf8' ); //设定本页编码
include_once '../../session.php';                    //session记录
include_once( 'M_quanxian.php' );                      //接收职位权限信息
include_once '../../inc/Function_All.php';           //

include_once '../../inc/B_Config.php';               //执行接收参数及配置
include_once '../../inc/B_conn.php';             //
include_once '../../inc/B_connadmin.php';       //
include_once '../../inc/cache_write.php';            /*自动缓存*/

error_reporting(E_ALL);
ini_set('display_errors', '1');
$tianjia_ZD_Arry = $bitian_Arry = $Wuchongfu_Arry = '';
//=========================================================================得到记录模版设定信息
if ( $re_id <> 0 ) {
	
	//
	$sql = 'select sys_zt,sys_zt_bianhao,mdb_name_SYS From Sys_jlmb where id=' . $re_id;
	$rs = mysqli_query(  $Conn , $sql );
	$row = mysqli_fetch_array( $rs );
	mysqli_free_result( $rs ); //释放内存
	$r_zt = $row[ 'sys_zt' ]; //系统字头
	$r_zt_bianhao = $row[ 'sys_zt_bianhao' ]; //系统字头编号
	$databiao = htmlspecialchars( trim( $row[ 'mdb_name_SYS' ] ) ); //原数据表名
	if(!$databiao){
		echo '没有该表,联系管理员处理!';
		exit();
	}
};
$Conn=ChangeConn($databiao);//选择数据库
////======================================接收参数开始

$strmkzd = $strmk =  '';

if ( isset( $_REQUEST[ 'strmkzd' ] ) ) {
	$strmkzd = trim( $_REQUEST[ 'strmkzd' ] ); //更新动态接收
};
if ( isset( $_REQUEST[ 'strmk' ] ) ) {
	$strmk = trim( $_REQUEST[ 'strmk' ] ); //更新动态接收
};

if ( isset( $_REQUEST[ 'zu' ] ) ) {
	$zu_id = $_REQUEST[ 'zu' ]; //得到分类id
} else {
	$zu_id = 0;
};

//echo ('<br>'.$zu_id);
//$strmk_id=33;
if ( $act == 'list' ) {
	lists();
};

function lists(){
	$Htmlcache=$Htmlcache_data='' ;
	//exit;
	global $hy, $re_id, $Conn, $maxrecord, $ToHtmlID, $strmk_id, $databiao, $xt_m_ziduan, $xt_m_ziduan_Name,$file_name,$SYS_Company_id;
	$rs = $sql = $row = $firstinputname = $nowUboundarry = $qx_wuchongfu = $TianJia_POST_Arry = $Wuchongfu_Arry = $zd_Default = $wuchongfu_html = $bitian_Arry =$zhiduanarryNull=$zhiduanarrydata= '';
	$IsConn=IsConn($databiao);            //查出所属表的数据库
	//$Htmlcache="";
	$Tablecol_list=Tablecol_list( $databiao );//得到表的字段清单
	
	
	

	//==============================================================================================================【锁定】
	//查询用于显示的字段信息清单
	$sql = "SHOW FULL COLUMNS FROM `$databiao`";
	//echo $sql;
	$rs = mysqli_query( $Conn , $sql );
	$countcords=mysqli_num_rows($rs);
	if ( '1' . $databiao == '1') {
	    $Htmlcache_data= "<ul style='padding-left:20px;padding-top:25px;color:red;'>对不起，还没有设定数据库表呢！请先设定。</ul>\n" ;
	} elseif ( $countcords == 0 ) {
	    $Htmlcache_data= "<ul style='padding-left:20px;padding-top:25px;color:red;'>还没有设定允许添加字段，请联系上级设定好再来。</ul>\n" ;
	} else {
		//echo ($re_id);
		
		$i = 0;
		while ( $row = mysqli_fetch_array( $rs ) ) {
			//echo $row['id'];
			$i++;
			
			$zd_en_name = $row[ 'Field' ]; //字段
			$zdbeizhu = $row[ 'Comment' ]; //备注
			$NEW_zdbeizhu=colbeizhu($zdbeizhu,$zd_en_name);
			//0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
		    if (getN( $Tablecol_list, $zd_en_name ) >= 0){//如果查得到该表时

			   if ( $i == 1 ) {
				  $firstinputname = $zd_en_name;
			   }; //输出第一个文本框字段
			   $zd_cn_name=textN( $NEW_zdbeizhu, 0, ',' );                //中文字段名
			   //$zd_xianshi_width = textN( $NEW_zdbeizhu, 1, ',' );      //字段显示宽度
			   $zd_xianshi_input_id = textN( $NEW_zdbeizhu, 4, ',' );     //显示类型
			   $zd_xianshi_is = textN( $NEW_zdbeizhu, 7, ',' );           //7为添加
               $zd_shuoding_is = textN( $NEW_zdbeizhu, 6, ',' );          //6为锁定列
			   $zd_xianshi_height = textN( $NEW_zdbeizhu, 10, ',' );      //10为控件显示高度
				
			 if($zd_xianshi_is==1 and $zd_shuoding_is==1 and $zd_en_name!='id'){
			   $zd_Default = move_zkh( $row[ 'Default' ], "N',[,],'" );   //默认值
			   $now_zd_Default = htmlspecialchars($row[ 'Default' ]);     //默认值
				
			   $qx_bitian = textN( $NEW_zdbeizhu, 2, ',' );               //字段必填
			   $qx_wuchongfu = textN( $NEW_zdbeizhu, 3, ',' );            //字段无重复

			   //$zd_xianshi_input = $row[ 'zd_xianshi_input' ]; //显示的控件样式
			   $sys_class = 'addboxinput inputfocus';
			
			   $getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //当>=0为系统字段时
               if ( $getN_XTZD >= 0 ) {
		          $zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',');//显示字段系统名称					
	           };
			   $zd_cn_name=SysChangeName($zd_cn_name,$databiao);//变更系统设定名
				
			   /*
			   if ( $strmk_id > 0 ) { //复制添加时执行
				  $sys_value = '<?php echo $'.$zd_en_name.' ?>'; //得到当前值
			   } else {
				  $sys_value = $zd_Default;
			   };*/
				  $sys_value = '<?php echo $'.$zd_en_name.' ?>';
				  //$zhiduanarryNull.='$'.$zd_en_name.'=';
				  $zhiduanarryNull.='		$'.$zd_en_name.'="'.$now_zd_Default.'";'."\n";
				  $zhiduanarrydata.='		$'.$zd_en_name.'=$row["'.$zd_en_name.'"];'."\n";
				 
               if($zd_xianshi_input_id==10){//当为密码时
				  $zd_cn_name='[不添加时请留空] '.$zd_cn_name;
			   };
			   if ( $qx_wuchongfu == 1 ) { //当为无重复时
				  $zd_cn_name = "<font color='red'>[验重]</font>&nbsp;" . $zd_cn_name;
			   };
			   if ( $qx_bitian == 1 ) { //当为必填字段时
				  $zd_cn_name = "<font color='red' class='s_bt'>*</font>&nbsp;" . $zd_cn_name;
				  $bitian_Arry = $bitian_Arry . ',' . $zd_en_name;
			   };

			   //if ( $zd_en_name == 'sys_id_zu' ) { //当为分类时执行
				//$zd_xianshi_input = Html_input( 'sys_zuall', 'id', 'lname1', $sys_value, 'CheckBox', 'sys_id_zu', $re_id );
			  //} else {
			  //echo $re_id;
			  //echo $zd_xianshi_input_id;
				$zd_xianshi_input = Get_out_InputTypes_cols( $zd_xianshi_input_id, $zd_en_name, $zd_en_name, $sys_class, $sys_value,'100%',$zd_xianshi_height,$re_id,'Daima_xianshi','addbox'); //这里为输出input样式
			  //};
			  //

			  //$wuchongfu_html = "<font id='" . $zd_en_name . "_YanZhenChongFu_Div' class='YanZhenChongFu_Div chongfuzhi'><i class='fa fa-nodata' class='bitiantishi chongfuzhi' title='有重复值: " . $zd_cn_name . "'></i></font>";

			  //========================输出显示表格<div id='YanZhenChongFu_Div' class='YanZhenChongFu_Div'>00</div>
			  if ( $qx_wuchongfu == 0 ) {
				$qx_wuchongfu = '';
			  } else {
				$Wuchongfu_Arry = $Wuchongfu_Arry . ',' . $zd_en_name; //无重复字段
			  }; //无重复

			  $TianJia_POST_Arry = $TianJia_POST_Arry . ',' . $zd_en_name;

			  $Htmlcache_data.= "
	                     <ul>
		                 <li class='cols01'>$zd_cn_name:</li>
		                 <li class='cols02 reset_list'>$zd_xianshi_input
		                 <div class='cols03 font_red yanzheng' id='".$zd_en_name."_bitian'>$wuchongfu_html</div>
						 </li>
		                 </ul>\n";
			}
				
		  }
		}//while end
		mysqli_free_result( $rs ); //释放内存
        

		
		$bitian_Arry = trim( $bitian_Arry, ',' ); //必填
		//echo($bitian_Arry);
		$firstinputname = trim( $firstinputname, ',' ); //得到第一个输入框
		$TianJia_POST_Arry = trim( $TianJia_POST_Arry, ',' ); //允许添加字段
		$Wuchongfu_Arry = trim( $Wuchongfu_Arry, ',' ); //无重复字段

		//========================================end if


	 }
	
	
	//==============================================================================================================【显示列】
	//查询用于显示的字段信息清单
	$sql = "SHOW FULL COLUMNS FROM `$databiao`";
	//echo $sql;
	$rs = mysqli_query( $Conn , $sql );
	$countcords=mysqli_num_rows($rs);
	if ( '1' . $databiao == '1') {
	    //$Htmlcache_data= "<ul style='padding-left:20px;padding-top:25px;color:red;'>对不起，还没有设定数据库表呢！请先设定。</ul>\n" ;
	} elseif ( $countcords == 0 ) {
	    //$Htmlcache_data= "<ul style='padding-left:20px;padding-top:25px;color:red;'>还没有设定允许添加字段，请联系上级设定好再来。</ul>\n" ;
	} else {
		//echo ($re_id);
		//==============================================以下为获取显示区域
		$i = 0;
		while ( $row = mysqli_fetch_array( $rs ) ) {
			//echo $row['id'];
			$i++;
			
			$zd_en_name = $row[ 'Field' ]; //字段
			$zdbeizhu = $row[ 'Comment' ]; //备注
			$NEW_zdbeizhu=colbeizhu($zdbeizhu,$zd_en_name);
			//0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
		    if (getN( $Tablecol_list, $zd_en_name ) >= 0){//如果查得到该表时

			   if ( $i == 1 ) {
				  $firstinputname = $zd_en_name;
			   }; //输出第一个文本框字段
			   $zd_cn_name=textN( $NEW_zdbeizhu, 0, ',' );                //中文字段名
			   //$zd_xianshi_width = textN( $NEW_zdbeizhu, 1, ',' );      //字段显示宽度
			   $zd_xianshi_input_id = textN( $NEW_zdbeizhu, 4, ',' );     //显示类型
			   $zd_xianshi_is = textN( $NEW_zdbeizhu, 7, ',' );           //7为添加
               $zd_shuoding_is = textN( $NEW_zdbeizhu, 6, ',' );          //6为锁定列
			   $zd_xianshi_height = textN( $NEW_zdbeizhu, 10, ',' );      //10为控件显示高度
			 if($zd_xianshi_is==1 and $zd_shuoding_is!=1 and $zd_en_name!='id'){
			   $zd_Default = move_zkh( $row[ 'Default' ], "N',[,],'" );   //默认值
			   $now_zd_Default = htmlspecialchars($row[ 'Default' ]);     //默认值
				
			   $qx_bitian = textN( $NEW_zdbeizhu, 2, ',' );               //字段必填
			   $qx_wuchongfu = textN( $NEW_zdbeizhu, 3, ',' );            //字段无重复

			   //$zd_xianshi_input = $row[ 'zd_xianshi_input' ]; //显示的控件样式
			   $sys_class = 'addboxinput inputfocus';
			
			   $getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //当>=0为系统字段时
               if ( $getN_XTZD >= 0 ) {
		          $zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',');//显示字段系统名称					
	           };
			   $zd_cn_name=SysChangeName($zd_cn_name,$databiao);//变更系统设定名
			   /*
			   if ( $strmk_id > 0 ) { //复制添加时执行
				  $sys_value = '<?php echo $'.$zd_en_name.' ?>'; //得到当前值
			   } else {
				  $sys_value = $zd_Default;
			   };*/
			   $sys_value = '<?php echo $'.$zd_en_name.' ?>';
			   $zhiduanarryNull.='		$'.$zd_en_name.'="'.$now_zd_Default.'";'."\n";       //显示为默认值
			   $zhiduanarrydata.='		$'.$zd_en_name.'=$row["'.$zd_en_name.'"];'."\n";   
				
				 
               if($zd_xianshi_input_id==10){//当为密码时
				  $zd_cn_name='[不添加时请留空] '.$zd_cn_name;
			   };
			   if ( $qx_wuchongfu == 1 ) { //当为无重复时
				  $zd_cn_name = "<font color='red'>[验重]</font>&nbsp;" . $zd_cn_name;
			   };
			   if ( $qx_bitian == 1 ) { //当为必填字段时
				  $zd_cn_name = "<font color='red' class='s_bt'>*</font>&nbsp;" . $zd_cn_name;
				  $bitian_Arry = $bitian_Arry . ',' . $zd_en_name;
			   };

			   //if ( $zd_en_name == 'sys_id_zu' ) { //当为分类时执行
				//$zd_xianshi_input = Html_input( 'sys_zuall', 'id', 'lname1', $sys_value, 'CheckBox', 'sys_id_zu', $re_id );
			  //} else {
			  //echo $re_id;
			  //echo $zd_xianshi_input_id;
				$zd_xianshi_input = Get_out_InputTypes_cols( $zd_xianshi_input_id, $zd_en_name, $zd_en_name, $sys_class, $sys_value,'100%',$zd_xianshi_height,$re_id,'Daima_xianshi','addbox'); //这里为输出input样式
			  //};
			  //

			  //$wuchongfu_html = "<font id='" . $zd_en_name . "_YanZhenChongFu_Div' class='YanZhenChongFu_Div chongfuzhi'><i class='fa fa-nodata' class='bitiantishi chongfuzhi' title='有重复值: " . $zd_cn_name . "'></i></font>";

			  //========================输出显示表格<div id='YanZhenChongFu_Div' class='YanZhenChongFu_Div'>00</div>
			  if ( $qx_wuchongfu == 0 ) {
				$qx_wuchongfu = '';
			  } else {
				$Wuchongfu_Arry = $Wuchongfu_Arry . ',' . $zd_en_name; //无重复字段
			  }; //无重复

			  $TianJia_POST_Arry = $TianJia_POST_Arry . ',' . $zd_en_name;

			  $Htmlcache_data.= "
	                     <ul>
		                 <li class='cols01'>$zd_cn_name:</li>
		                 <li class='cols02 reset_list'>$zd_xianshi_input
		                 <div class='cols03 font_red yanzheng' id='".$zd_en_name."_bitian'>$wuchongfu_html</div>
						 </li>
		                 </ul>\n";
			}
				
		  }
		}//while end
		mysqli_free_result( $rs ); //释放内存
        
        
	    
		
		
		
		$bitian_Arry = trim( $bitian_Arry, ',' ); //必填
		//echo($bitian_Arry);
		$firstinputname = trim( $firstinputname, ',' ); //得到第一个输入框
		$TianJia_POST_Arry = trim( $TianJia_POST_Arry, ',' ); //允许添加字段
		$Wuchongfu_Arry = trim( $Wuchongfu_Arry, ',' ); //无重复字段

		//========================================end if
		
		//==============================================================================================================【输出值】
		$Htmlcache.='<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER[\'PATH_TRANSLATED\']}/session.php";
	    include_once \'M_quanxian.php\';
	    include_once "{$_SERVER[\'PATH_TRANSLATED\']}/inc/B_'.$IsConn.'.php";
		if ( isset( $_REQUEST[ \'sys_guanxibiao_id\' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ \'sys_guanxibiao_id\' ] );}else{$sys_guanxibiao_id = \'\';};         //关系表id
	    if ( isset( $_REQUEST[ \'GuanXi_id\' ] ) ){$GuanXi_id = intval( $_REQUEST[ \'GuanXi_id\' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ \'ToHtmlID\' ] ) ){$ToHtmlID = $_REQUEST[ \'ToHtmlID\' ];};                                                                              //显示页面
	    if ( isset( $_REQUEST[ \'huis\' ] ) ){$huis = intval( $_REQUEST[ \'huis\' ] );}else{$huis = 0;};                                                                //1回收站0为不回收
	    //if ( $huis == 1){$ToHtmlID=\'HUIS_\'.$ToHtmlID;};                                                                                                               //是否为回收站0为不回收
	   
	    global $strmk_id,$'.$IsConn.',$sys_q_tianj;
	'."\n";
		if($IsConn=='Connadmin'){
			$Htmlcache.='		$Conn=$Connadmin;'."\n";
		}
		/*
	if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `$databiao` where `id`='$strmk_id' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		mysqli_free_result( $rs ); //释放内存
	};
    */
		
		
		
		$Htmlcache.='
		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `'.$databiao.'` where `id`=\'$strmk_id\' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	'."\n";
		$Htmlcache.=$zhiduanarrydata."\n";//得到变量值，如有时
		$Htmlcache.='
		
		mysqli_free_result( $rs ); //释放内存
	
	'."\n";
		$Htmlcache.="}else{\n";
		$Htmlcache.=$zhiduanarryNull."\n";//申明变量
		$Htmlcache.="};\n";
		$Htmlcache.="?>"."\n\n";
		$Htmlcache.= "<form id='post_form' autocomplete='off' tit='' SYS_Company_id='{$SYS_Company_id}'><div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;'>\n" ;
		
		$Htmlcache.=$Htmlcache_data;//这里得到数据

		$Htmlcache.= "<ul style='height:15px;width:100%;'><li style='width:98%'></li></ul>\n";//间隔空白处
		
		$Htmlcache.='<?php if ( $sys_q_tianj >= 0 ) { //有添加权限时 ?>'. "\n";
		
		$Htmlcache.= "<ul>
  <li class='cols01'><i class='fa fa-sitting-ziduan'  onClick='Table_Set_XianShi('$ToHtmlID',this)' title='设定添加字段。'/>&nbsp;</li>
  <li class='cols02'>
  
  <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset' onclick=inputfocusfirst('#addbox .htmlleirong','$firstinputname')><input type='hidden' id='formaddcount' value='0'/>
  
  <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='" . $TianJia_POST_Arry . "'/>
  
  <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:88%'  SYS_Company_id='".$SYS_Company_id."' strmk_id='".''."' firstinputname='$firstinputname' bitian_Arry='$bitian_Arry' databiao='$databiao' Wuchongfu_Arry='$Wuchongfu_Arry' onclick=data_add_arrys(this,'#addbox','$ToHtmlID')   onkeydown=\"EnterPress(event,this,this.click)\" />
  
  <font id='editsuccess' class='font_red'></font></li>
  </ul>\n";
		$Htmlcache.="
		<?php
		  }
        ?>
		<input type='hidden' name='re_id' id='re_id' value='$re_id' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div>" ;
		$Htmlcache.= "<script>YanZhen_ChongFu_ZuLoad(0,'$Wuchongfu_Arry','$databiao','$ToHtmlID');form_add_copy('$ToHtmlID');inputfocusfirst('#addbox .htmlleirong','$firstinputname');</script>\n\n" ; //输出js
		
		//echo '"; ? >';
        //$cache->caching();
	 }
	
	//echo $Htmlcache;
	if($IsConn=='Connadmin'){
		$Htmlcache.='<?php '."\n".'mysqli_close( $Connadmin ); //关闭数据库'."\n\n".'?>';
	}else{
		$Htmlcache.='<?php '."\n".'mysqli_close( $Conn ); //关闭数据库'."\n\n".'?>';
	}
	
	
	$current_file=str_replace("_chache.php","",basename(__FILE__));       //得到当前文件 除”_chache.php“的文件名称
	write_cache('1',$Htmlcache,$current_file);                 //生成模版
	
	
    //sleep(1);//暂停一秒
	//find_cache('1');
	if ( $strmk_id > 0 ) { //复制添加时执行
		//echo "这里要修改验重项";
	};
};



mysqli_close($Conn);//关闭数据库

//http://localhost/m/MachineV1.0/M_moban_add_chache.php?re_id=321&act=list
?>