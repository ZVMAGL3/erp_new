
<?php
header('Content-type: text/html; charset=utf-8');//设定本页编码
include_once '../session.php' ;
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php';//执行接收参数及配置

include_once '../inc/B_conn.php';
include_once '../inc/B_connadmin.php'; 

include_once '../inc/Sub_All.php' ;

//======================================ok
//==============================================接收参数开始
   $dbb=$strmkzd=$strmk=$mdb_name=$nowziduan=$bumen_id=$ZhiWei_id=$ADDcolsarry=$DELcolsarry=$ChongfuId='';

   if(isset($_REQUEST['dbb']))            $dbb=$_REQUEST['dbb'];                      //
   if(isset($_REQUEST['strmkzd']))        $strmkzd=$_REQUEST['strmkzd'];              //更新动态接收
   if(isset($_REQUEST['strmk']))          $strmk=$_REQUEST['strmk'];                  //更新动态接收
   if(isset($_REQUEST['mdb_name']))       $mdb_name=$_REQUEST['mdb_name'];            //修改备注字段名称
   if(isset($_REQUEST['zd']))             $nowziduan=$_REQUEST['zd'];                 //字段
   if(isset($_REQUEST['bumen_id']))       $bumen_id=intval($_REQUEST['bumen_id']);    //部门ID
   if(isset($_REQUEST['Now_ZD']))         $Now_ZD=trim($_REQUEST['Now_ZD']);          //字段
   if(isset($_REQUEST['ZhiWei_id']))      $ZhiWei_id=$_REQUEST['ZhiWei_id'];          //职位ID
   if(isset($_REQUEST['ADDcolsarry']))    $ADDcolsarry=trim($_REQUEST['ADDcolsarry']);//添加数组接收
   if(isset($_REQUEST['DELcolsarry']))    $DELcolsarry=trim($_REQUEST['DELcolsarry']);//删除数组接收
   if(isset($_REQUEST['ChongfuId']))      $ChongfuId=trim($_REQUEST['ChongfuId']);    //0为全局禁重，1为同级禁重
   
   //==============================================接收参数//end=====================================
   
   switch ($act){
   case 'bigmenu'://=====================================[ok]一级菜单管理(部门管理、菜单管理)
     bigmenu();break;
   default:
     echo NoZhiLing();
   };
  function bigmenu(){

	global $Connadmin,$re_id,$All_XT_ZiDuan,$hy,$bh,$const_q_tianj,$const_q_xiug,$const_q_shanc,$const_q_cak,$const_q_dayin,$const_q_huis,$const_q_seid,$const_q_dian,$const_q_shenghe,$ChongfuId;//引用权限 //得到全局变量
  
	echo ('<div class="DFtables " style="border:0">');
	$sql="select * From msc_BuMenList where  sys_yfzuid='$hy' and sys_huis=0 order by sys_bh Asc";
    //echo $sql;
	  $rs=mysqli_query( $Connadmin , $sql );
	  $nowrecordcount=mysqli_num_rows($rs);//统计数量
	  if($nowrecordcount<=0){//当没有数据时也要显示一行
	       echo ("<ul class='nodataul'><i class='fa fa-nodata'></i>&nbsp;sorry,没有数据，请先添加。</ul>");
	  };
	  $i=0;
	  $now_id=$NOW_menubigclass=$nowziduan='';
      while ($row = mysqli_fetch_array($rs)){
	       $i++;
	       if($i<10){
	          $iig='0'.$i;
	       }else{
	          $iig=$i;
	       };
           $now_id=$row['id'];
		   echo '<font color="#999">'.$iig.'&nbsp;'.$row['bumenname'].'</font>';
     	     $sql2="select * From msc_zhiwei where  sys_yfzuid='$hy' and bumen='$now_id' and sys_huis=0 order by xu Asc";
             //echo $sql2;
	         $rs2=mysqli_query( $Connadmin , $sql2 );
	         $nowrecordcount2=mysqli_num_rows($rs2);//统计数量
	         if($nowrecordcount2<=0){//当没有数据时也要显示一行
	             echo ("<ul class='nodataul'><i class='fa fa-nodata'></i>&nbsp;sorry,没有数据，请先添加。</ul>");
	         };
	         $i2=0;
	         $now_id=$NOW_menubigclass=$nowziduan='';
             while ($row2 = mysqli_fetch_array($rs2)){
	              $i2++;
	              if($i2<10){
	                 $iig2='0'.$i2;
	              }else{
	                 $iig=$i2;
	              };
                  $now_id2=$row2['id'];
		          
		          echo ('<ul class="head hoverthis ">'); 
	                echo ('<li class="headbh leftli middle" title="">'.$iig2.'</li><li class="textleft middle" style="width:70%">'.$row2['zu'].'</li>');
	              echo ('</ul> '); 
		                              
             };//while end
		  
		   
		                               //这里得到ul数据
      };//while end
	  
	echo ('</div> '); 
  };

  // 【ok】======================================================================= : 大类管理菜单通用(部门)
  function bigmenu2(){
    //echo ("<script>$('title').append("."<link href='../style/menuedit.css' rel='stylesheet' type='text/css' />)<//script>");
	
	$ii=$Mystr=$UboundMystr=$arryi=$arryUboundi=$bigid=$Mystr_0='';
	if(isset($_REQUEST['arryi'])){$arryi=$_REQUEST['arryi'];};                          //
	if(isset($_REQUEST['arryUboundi'])){$arryUboundi=$_REQUEST['arryUboundi'];};        //接收的数据数量
	if(isset($_REQUEST['bigid'])){$bigid=$_REQUEST['bigid'];};                          //接收的上级分类id
	
	  
	$MenuArry='msc_bumenlist,bumenname,id,EditNo,menuOpen';//
	$Mystr=explode(';',$MenuArry);                                              //分开为几组菜单
	$UboundMystr=count($Mystr);                                                 //echo $UboundMystr;
	$Mystr_0= $Mystr[0];                                                        //echo $Mystr_0;//1
	if ($UboundMystr==-1){                                                      //没有任何参数传过来时
	    echo ('</br></br></br></br>未传递任何显示的表及列参数。');
	}elseif ($UboundMystr>=0){//当有参数传过来时
	    if ($arryi.'1' != '1' and $arryUboundi.'1' != '1' and $Mystr[$arryi].'1'!='1'){
	         //bigmenu_Data($MenuArry,$Mystr[$arryi],$arryi,$arryUboundi,$bigid); //下级菜单时执行
			 //echo '1001';
	    }else{                                                                  //顶级菜单
	         if($Mystr_0){                                                      //当传递的参数字符串正确或不为空时。
		         $UboundMystr=$UboundMystr-1;                                   //数据从1开始，数组从0开始所以减1
		         echo "'".$MenuArry."','".$Mystr_0."','0','".$UboundMystr."','".$bigid."'";
	             bigmenu_Data($MenuArry,$Mystr_0,0,$UboundMystr,$bigid);        //只有一级菜单时 
				 //echo '2';
		     }else{
		         echo ('对不起，没有传递过来正确参数！');
		     };
	    };//end if
	};//http://localhost/MachineV1.0/B_menu_zhiwei_set.php?act=bigmenu&MenuArry=msc_bumenlist,bumenname,id,EditYes,menuClose
  };
  
  // 【ok】======================================================================= : 大类管理菜单通用(数据)
  function bigmenu_Data($MenuArry,$datarry,$iiiii,$Uboundi,$bigid){//(数据数组，级数)
      //echo "'".$MenuArry."','".$datarry."','".$iiiii."','".$Uboundi."','".$bigid."'";
      global $Conn,$Connadmin,$re_id,$All_XT_ZiDuan,$hy,$bh,$const_q_tianj,$const_q_xiug,$const_q_shanc,$const_q_cak,$const_q_dayin,$const_q_huis,$const_q_seid,$const_q_dian,$const_q_shenghe,$ChongfuId;//引用权限 //得到全局变量
	  if($bigid > 0){
		  $Conn=$Connadmin;
	  };
	  $openclass=$iig=$ParntsMenuArry=$ParntsMenustr=$Parnttablename=$ParntZDname=$ParntIDname='';
	  $Menuid=getN_FH($MenuArry,$datarry,';');                                 //得到当前数组在总数组中的排序
	  if ($Menuid>0){
	      $Menustr=explode(';',$MenuArry);                                     //分开数组
	      $ParntsMenuArry=$Menustr[$Menuid-1];                                 //得到上级参数
	      $ParntsMenustr=explode(',',$ParntsMenuArry);                         //分开数组
	      $Parnttablename=$ParntsMenustr[0];                                   //得到上级表名
	      $ParntZDname=$ParntsMenustr[1];                                      //得到上级关系字段名
	      $ParntIDname=$ParntsMenustr[2];                                      //得到上级字段名
	  };//echo ($datarry);
      
      $Mystr=explode(',',$datarry);                                            //分开各参数
	  //$UboundMystr=count($Mystr);
	  $MY_tablename=$Mystr[0];                                                 //表名
	  $MY_zd_list=strtolower($Mystr[1]);                                                   //显示的字段名小写
	  $MY_gx_col_id=$Mystr[2];                                                 //关系ID列
	  $MY_Edit=$Mystr[3];                                                      //是否允许修改
	  $MY_Morclose=$Mystr[4];                                                  //默认打开还是折曡
	  
	  if ($iiiii<$Uboundi and $MY_Morclose=='menuOpen'){                       //有二级菜单时
	      $openclass=' tablesclick';
	  };
      if ($iiiii==0){
	      echo ('<div');
		  if ($re_id>0){
		      echo (" class='DFtables ".$openclass."'");
		  }else{
		      echo (" class='DFtables ".$openclass." DFtables-top'");
		  };
		  echo (" tit='".$All_XT_ZiDuan."' MenuArry='".$MenuArry."'>");
	  }elseif($iiiii>0){                                                      //有二级菜单时
	      $nowtwomenuid="tables_".$iiiii."_".$bigid;
	      echo ("<div id='".$nowtwomenuid."' class='DFtables".$iiiii.$openclass."'>");
	  };
      
	  $sql="select * From ".$MY_tablename." where  sys_yfzuid='$hy' ";
	  //echo $sql;
	  if ($bigid>0 and $bigid.'1'!='1'){$sql=$sql." and ".$MY_gx_col_id."=".$bigid." ";};
	  //if($re_id>0){$sql=$sql." and re_id=".$re_id." ";};
	  
	  $sql=$sql.' and sys_huis=0 order by bh Asc';
	  echo $sql;
	  $rs=mysqli_query( $Conn , $sql );
	  $nowrecordcount=mysqli_num_rows($rs);//统计数量
	  if($nowrecordcount<=0){//当没有数据时也要显示一行
	       echo ("<ul class='nodataul'><i class='fa fa-nodata'></i>&nbsp;sorry,没有数据，请先添加。</ul>");
	  };
	  $i=0;
	  $now_id=$NOW_menubigclass=$nowziduan='';
      while ($row = mysqli_fetch_array($rs)){
	       $i++;
	       if($i<10){
	          $iig='0'.$i;
	       }else{
	          $iig=$i;
	       };
           $now_id=$row['id'];
	       $NOW_menubigclass=$row[$MY_zd_list];
		   bigmenu_Data2($iiiii,$iig,$i,$Uboundi,$bigid,$now_id,$ParntZDname,$ParntIDname,$Parnttablename,$MY_Edit,$MY_tablename,$NOW_menubigclass,$MY_gx_col_id,$MY_zd_list);                               //这里得到ul数据
      };//while end
      
	  //================================================================= 添加行及备用行
	  if ( $const_q_tianj > -1 or $bh=='9001') {//允许添加时
	     if ($MY_Edit=='EditYes'){//允许添加大类菜单<li class='rightli hoverthis'>Σ:".$nowrecordcount."</li>
	       if ($iiiii>0){
		       echo ("<ul class='noneline ADDmenus' bigid='".$bigid."'><li class='leftli'></li><li class='rightli hoverthis li_kuan middle' onclick='addulDHCD(this);'><i class='fa fa-add-mini'></i>&nbsp;新增</li></ul>");
	       }else{                                                                       //这里为默认添加按钮样式
	          echo ("<ul class='noneline ADDmenus headbg middle' bigid='".$bigid."'><li class='leftli middle'></li><li class='rightli li_kuan hoverthis middle' onclick='addulDHCD(this);'><i class='fa fa-add'></i>&nbsp;ADD</li></ul>");
	       };
	       bigmenu_Data2($iiiii,0,1,$Uboundi,$bigid,$now_id,$ParntZDname,$ParntIDname,$Parnttablename,$MY_Edit,$MY_tablename,'备用行',$MY_gx_col_id,$MY_zd_list);//这里得到ul数据(用于添加数据的拷贝行)
	     };
	  };
	  //================================================================= 添加行及备用行  end
	  echo ('</div>');
	  mysqli_free_result($rs);//释放内存
	  if ($iiiii<$Uboundi and $MY_Morclose=='menuOpen'){//有二级菜单时
	     echo ("<script>$('.tablesclick>ul').click();</script>");//只打开第一层UL
	     //echo ("<script>$('.DFtables ul').click();<'/script>");//打开所有下级层
	  };
	  echo ("<script>$('ul.ADDmenus').next('ul').hide();</script>");//这里隐藏备用拷贝行
	  
	  //================================================================= 回收站开始
	  if ($iiiii==0){//判断只有一级菜单时
	     if ($Uboundi>=0){
	        $tsMenustr=explode(';',$MenuArry);//分开数组
	        $tsMenuArry=$tsMenustr[$Uboundi];//得到当前参数
	        $tsMenustr=explode(',',$tsMenuArry);//分开数组
	        $ttablename=$tsMenustr[0];//得到表名
	        $tZDname=$tsMenustr[1];//得到当前字段名
	        $tIDname=$tsMenustr[2];//得到当前关系字段名
	     };//echo ($ttablename.';'.$tZDname.';'.$tIDname)
	     $rs2=$sql2=$nowrecordcount2='';                                        //统计回收数据 开始
	     if ($tZDname.'1'!='1' and $ttablename.'1'!='1'){
	        $sql2='select id From '.$ttablename.' where sys_yfzuid='.$hy.' and sys_huis=0';
	     };
	     //if ($re_id>0){$sql2=$sql2.' and re_id='.$re_id.' ';};
	     
         $rs2=mysqli_query( $Conn , $sql2 );                                          // 统计回收数据 end
	     $nowrecordcount2=mysqli_num_rows($rs2);//统计数量
         mysqli_free_result($rs2);//释放内存
	     //echo ("<div class='DFtables'><ul class='head'><li class='li_kuan hoverthis'>Σ</li><li  class='leftli hoverthis' id='list_count'>".$nowrecordcount2."</li><li  class='leftli hoverthis'>&nbsp;</li></ul></div>");
	     $rs3=$sql3=$nowrecordcount3='';                                         // 回收站开始
	     if ($tZDname.'1'!='1' and $ttablename.'1'!='1'){$sql3='select id From '.$ttablename.' where sys_huis=1';};
	     //if ($re_id>0){$sql3=$sql3.' and re_id='.$re_id.' ';};
		  
         $rs3=mysqli_query( $Conn , $sql3 );
	     $nowrecordcount3=mysqli_num_rows($rs3);//统计数量
         mysqli_free_result($rs3);//释放内存
	     echo ("<div class='DFtables DFtables-top-huis'><ul class='head huisz'><li class='li_kuan'>Σ:</li><li id='list_count'  class='leftli hoverthis'>".$nowrecordcount2."</li><li  class='leftli'>&nbsp;</li><li  id='huis_count' onclick=".'"'."huisget(this,'".$ttablename."','".$tZDname."','".$tIDname."','".$Uboundi."')".'"'." class='rightli  hoverthis li_kuan'>".$nowrecordcount3."</li><li  class='rightli'><i class='fa fa-trash'></i></li></ul></div>");
		  
	     echo ('</br></br></br></br>');
	 };//if else  end                                                         // 回收站 结束
  };//function end
  
  // 【ok】======================================================================= : 大类管理菜单通用(行数据)
  function bigmenu_Data2($iiiii,$iig,$i,$Uboundi,$bigid,$now_id,$ParntZDname,$ParntIDname,$Parnttablename,$MY_Edit,$MY_tablename,$NOW_menubigclass,$MY_gx_col_id,$nowziduan){                                       //(数据数组，级数3)
     global $ToHtmlID,$Connadmin,$re_id,$All_XT_ZiDuan,$hy,$bh,$const_q_tianj,$const_q_xiug,$const_q_shanc,$const_q_cak,$const_q_dayin,$const_q_huis,$const_q_seid,$const_q_dian,$const_q_shenghe,$ChongfuId,$nowusethis;//引用权限 //得到全局变量

	 $SYS_str=$mdb_name_SYS_jlmb=$mdb_name_SYS_conn='';
	 if ($MY_tablename=="Sys_Jlmb" ){                                      //当为记录模版时
		 $mdb_name_SYS_jlmb=Find_Col_Value('Sys_Jlmb',"`id`='$now_id'",'mdb_name_SYS');//查询相关值
		 $mdb_name_SYS_conn=Conn_Table_In( $mdb_name_SYS_jlmb);
		 $SYS_str=SYS_str( $mdb_name_SYS_jlmb ) ; //当为0时不为系统字段 1代表为系统字段
	 };
     echo ('<ul '); 
	 $iiiii=$iiiii+1;
	 
	 echo "onclick=".'"'."EditBigMenu(this,'确实要删除大类到回收站么?下面的小类也将受影响，请慎重！！！',".$iiiii.",".$Uboundi.")".'"';                                   //为0时无二级菜单
	
	 $myhead='head_'.$iiiii.'_';
	 echo (" bigid='".$bigid."' BigXsZd='".$ParntZDname."' bigZD='".$ParntIDname."' bigTablename='".$Parnttablename."' TSulii='".$iiiii."' TSulUbii='".$Uboundi."' Tsid='".$now_id."' Tszd='id' Tstable='".$MY_tablename."'  GXzd='".$MY_gx_col_id."' TsEdit='".$MY_Edit."' TsTYPE='xianshi'");
	 if ($MY_Edit=="EditNo" or $iiiii==1){                                       //不允许编辑大类菜单
	     echo (" class='head hoverthis headbg $myhead middle'>");
	 }else{
	     echo (" class='head hoverthis $myhead middle'>");                      //允许编辑时
	 };
	 //第一列名称
	 if ($MY_tablename=='msc_zhiwei'){                                       //当为职位时
	     echo ("<li class='headbh leftli middle' title='id:".$now_id."' ><i class='fa fa-peple'></i></li><li  class='textleft middle' style='width:70%'>");
	 }elseif ($MY_tablename=="Sys_biaozhun_menu" ){                             //当为依据标准时
		 echo ("<li class='headbh leftli middle' title='id:".$now_id."' >".$iig."</li><li  class='textleft middle' style='width:60%'>");
	 }elseif ($MY_tablename=="Sys_Jlmb" ){                                      //当为记录模版时
		 //echo $SYS_str;
		 //echo $mdb_name_SYSisok."_";
		 if(("1".$mdb_name_SYS_jlmb=="1" or $mdb_name_SYS_conn == "-1") and $SYS_str=="0"){//没有设定表时或者数据库与记录数据表不对时
			 $noclick = "Edit_daohangmenu('daohangmenu',$(this).parent().find('input[name=tablebeizhu]'),'moban_set_data.php','$MY_tablename','$nowziduan','$ToHtmlID','$ChongfuId');";  
			 echo ("<li class='headbh leftli middle' title='id:".$now_id." 表有异常，点击可修复该表。' onclick=\"$noclick\"><i class='fa fa-gantan'></i></li><li class='textleft middle' style='width:70%'>");
		 }else{
			 if($SYS_str=="1"){
				 echo ("<li class='headbh leftli middle' title='id:$now_id'>SYS</li><li class='textleft middle' style='width:70%'>");
			 }else{
				 echo ("<li class='headbh leftli middle' title='id:$now_id'><i class='fa fa-25-1'></i></li><li class='textleft middle' style='width:70%'>");
			 };
		 }
	     
		 
	 }elseif($iiiii==1 ){                                                       //当为最高父目录时【部门等】
	     echo ("<li class='headbh leftli middle' title='id:".$now_id."'>".$iig."</li><li  class='textleft middle' style='width:70%'>");
	 }else{                                                                     //当为其它样式时
	     echo ("<li class='headbh leftli middle' title='id:".$now_id."'><i class='fa fa-22-1'></i></li><li  class='textleft middle'>");
	 };
	  
	 
	 if ($MY_Edit=='EditNo'){                                                  //不允许编辑大类菜单
	     echo ("$NOW_menubigclass");//Tszd为关系字段
	 }else{                                                                     //允许编辑大类菜单
	     if($MY_tablename=="Sys_Jlmb" ){                                       //当为记录模版时
		 
			 if ( ($const_q_xiug > -1 or $bh=='9001') and $SYS_str=="0") {//回收权限
			     echo ("<input name='tablebeizhu' type='text' style='width:100%;' TABINDEX='".$i."' value='".$NOW_menubigclass."' tit='".$NOW_menubigclass."' onchange=".'"'."Edit_daohangmenu('daohangmenu',this,'moban_set_data.php','$MY_tablename','$nowziduan','$ToHtmlID','$ChongfuId')".'"'." >");
			 }else{
				 echo "$NOW_menubigclass";
			 };
		 
			 
		 }else{
			 if ( $const_q_xiug > -1 or $bh=='9001') {//回收权限
			 echo ("<input name='tablebeizhu' type='text' style='width:100%;' TABINDEX='".$i."' value='".$NOW_menubigclass."' tit='".$NOW_menubigclass."' onchange=".'"'."Edit_daohangmenu('daohangmenu',this,'moban_set_data.php','$MY_tablename','$nowziduan','$ToHtmlID','$ChongfuId')".'"'." >");
			 }else{
				 echo "$NOW_menubigclass";
			 };
		 };
	 };
	  
	 
	  
	 if ($MY_Edit=='EditNo'){                                                  //不允许编辑大类菜单
         echo ('</li>');
	 }else{
		 echo ("</li><div><li class='rightlikj noneline'>&nbsp;</li>");
		 
		 if ( ($const_q_shanc > -1 or $bh=='9001') and $SYS_str=="0") {//删除权限
	       echo ("<li class='rightli25px hoverthis2 noneline menus mdel' style='width:30px' ><i class='fa fa-del'></i></li>");                //右边删除菜单
	     };
		 if ( $const_q_huis > -1 or $bh=='9001') {//回收权限
	       echo ("<li class='rightli25px hoverthis2 noneline menus huis' style='width:30px'><i class='fa fa-huis'></i></li>");                                                             //右边回收菜单
		 };
		 if ( $const_q_xiug > -1 or $bh=='9001') {//修改权限
	       if ($iiiii >=1 and '1'.$ParntZDname != '1'){                         //当为最父目录时（没有上级时禁止出现转移菜单）
	         echo ("<li class='rightli25px hoverthis2 noneline menus mzuanyi' style='width:30px'><i class='fa fa-del'></i></li>");                      //右边转移菜单
	       };
		 };
	     echo ('</div>');                                               //右边删除菜单
     };

	 echo ('</ul>'); 
	  
	//echo ($MY_Edit);
};//function end




mysqli_close($Conn);//关闭数据库
mysqli_close($Connadmin);//关闭云数据库

?>