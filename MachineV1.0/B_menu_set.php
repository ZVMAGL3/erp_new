
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
   //case 'bigmenu'://=====================================[ok]一级菜单管理(部门管理、菜单管理)
     //bigmenu();break;
   case 'ZhiLeng_Edit':                     //职能
     ZhiLeng_Edit();break;
   case 'ZhiLeng_Edit_date':                //职能二级菜单
     ZhiLeng_Edit_date();break;
   case 'huisget':                          //回收站
     huisget();break;
   case 'ZhiZheQuanXian':                   //职权编辑【新】
     ZhiZheQuanXian();break;	   
   case 'ZhiZheQuanXian_GET':               //职权编辑数据【新】
     ZhiZheQuanXian_GET();break;
   case 'ZhiZheQuanXian_GET_date':          //职权编辑数据【新】
     ZhiZheQuanXian_GET_date();break;
   case 'mima':                             //密码修改
		mima();break;
   case 'YunHuiYuan_Edit':                  //云会员 
     YunHuiYuan_Edit();break;
   default:
     echo NoZhiLing();
   };

  
  

// 【ok】======================================================================= : 依据标准
  function biaozhun(){
     global $Conn,$re_id,$All_XT_ZiDuan,$hy,$bh,$sys_q_tianj,$sys_q_xiug,$sys_q_shanc,$sys_q_cak,$sys_q_dayin,$sys_q_huis,$sys_q_seid,$sys_q_dian,$sys_q_shenghe;//引用权限 //得到全局变量
	 global $sys_id_login;
	 if($sys_id_login!=1){//无权限时
    echo"<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    echo"<br><br><font style='color:red;padding-left:30px;font-size:12px;'>您无此栏目管理权限!</font>";
    exit();
}

	 $nowusethis='';
	 echo "<li  class='rightli25px noneline rightli_check' style='width:70px'  title='$nowusethis'><label><input type='checkbox'  value='$nowusethis' name='usethis'  onchange=\"thistripnt('Edit_Bmquanxian',this,'$hy')\" ";
			   
	           if ($nowusethis=='1'){
	               echo  (' checked ');//选中时执行
	           };
			   //if ( $sys_q_xiug > -1 or $bh=='9001') {//修改权限
			   //}else{
				  // echo " disabled ";
			   //};
	           echo "></label></li>";
	        //echo ("</div>");
  };
// 【ok】======================================================================= : 回收站数据
  function huisget(){
     global $re_id,$All_XT_ZiDuan,$hy,$bh,$sys_q_tianj,$sys_q_xiug,$sys_q_shanc,$sys_q_cak,$sys_q_dayin,$sys_q_huis,$sys_q_seid,$sys_q_dian,$sys_q_shenghe;//引用权限 //得到全局变量
	 
	 $MY_tablename=$_REQUEST['tablename'];
	 $nowTszd=$_REQUEST['tszd'];
	 $nowgxzd=$_REQUEST['gxzd'];
	 $nowtableiiiii=$_REQUEST['nowtableiiiii'];//为0时证明只有一级菜单
	  
	 $Conn=ChangeConn($MY_tablename);    //依据表自动选择数据库
	  
	   if ($nowTszd.'1'!='1' and $MY_tablename.'1'!='1'){
	     $sql='select * From '.$MY_tablename.' where sys_huis=1';
	   };
	   if ($re_id>0){
	     $sql=$sql.' and re_id='.$re_id.' ';
	   };
	   $rs=mysqli_query( $Conn , $sql );
	   $nowrecordcount=mysqli_num_rows($rs);//统计数量
	   if ($nowrecordcount==0){
	       echo ("<ul class='head hoverthis huis nodataul'><li><i class='fa fa-nodata'></i> 对不起，没有数据。</li></ul>");
	      
	   };
	   //echo ("<div class='twomenu DFtables'>");
	   $i=0;
	   while($row = mysqli_fetch_array($rs)){
		   $i++;
	       $now_id=$row['id'];
	       $nowdatatszd=$row[$nowTszd];//大类名称
	       $nowdatagxzd=$row[$nowgxzd];//得到关系字段id
       
           echo ("<ul bigid='".$nowdatagxzd."' Tsid='".$now_id."' Tszd='".$nowTszd."' Tstable='".$MY_tablename."' GXzd='".$nowgxzd."' nowtableiiiii='".$nowtableiiiii."' nowvalue='".$nowdatatszd."' class='head hoverthis huis'  TsTYPE='huis'>");

	       if ($MY_tablename=='msc_zhiwei'){//当为职位时第一例
	           echo ("<li class='headbh leftli' title='id:".$now_id."' style='vertical-align:middle;'><i class='fa fa-peple'></i></li><li  class='textleft'>");
	       }elseif($MY_tablename=='Sys_Jlmb') {//当为记录模版时
	           echo ("<li class='headbh leftli' title='id:".$now_id."' style='vertical-align:middle;'><i class='fa fa-25-1'></i></li><li  class='textleft'>");
	       }else{//当为其它样式时
	           $nowidss=$i;
	           if ($nowidss<10){$nowidss='0'.$i;};
	           echo ("<li class='headbh leftli' title='id:".$now_id."'>".$nowidss."</li><li  class='noneline textleft'>");
	       };
		   echo($nowdatatszd."</li>");
		   if ( $sys_q_shanc > -1 or $bh=='9001') {//删除权限
	       echo("<li class='rightli verticalalign' onclick='' title='彻底删除' style='vertical-align:middle;padding-top:4px;'><i class='fa fa-del'></i></li>");
		   };
		   if ( $sys_q_huis > -1 or $bh=='9001') {//回收权限
		       echo "<li class='rightli verticalalign' onclick='huispost(this)' title='找回' style='vertical-align:middle;padding-top:4px;'><i class='fa fa-huis'></i></li>";
		   };
		   echo "</ul>";
	  };//while end
	  mysqli_free_result($rs);//释放内存
	  mysqli_close($Conn);//关闭数据库
	        //echo ("</div>");
  };

  // 【】======================================================================= : 职能分配
  function ZhiLeng_Edit(){
	global $Conn,$Connadmin,$hy;//得到全局变量
	  global $sys_id_login;
	if($sys_id_login!=1){//无权限时
    echo"<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    echo"<br><br><font style='color:red;padding-left:30px;font-size:12px;'>您无此栏目管理权限!</font>";
    exit();
}

    $rs=$sql=$row=$rs3=$sql3=$row3=$bumenname=$i=$NOW_menubigclass=$NOW_quanxian=$iig=$nowrecordcount='';
    echo ("<div class='DFtables' id='ZhiLeng_Edit' style='margrin:0'>");
	$sql="select id,sys_GuoChengMingChen,quanxian From sys_menubigclass where sys_yfzuid='$hy' and sys_huis=0 order by sys_GuoChengMingChen Asc";
	 // echo $sql;
	$rs=mysqli_query( $Conn , $sql );
	$nowrecordcount=mysqli_num_rows($rs);//统计数量

    if ($nowrecordcount<=0 ){//当没有数据时也要显示一行
	    echo ("<ul class='nodataul'><i class='fa fa-nodata'></i>&nbsp;sorry,没有数据，请先添加。</ul>");
    }else{
		$iig=$i=0;
	    while ($row = mysqli_fetch_array($rs)){
		   $i++;
           $NOW_menubigclass_id=$row['id'];
	       $NOW_menubigclass=$row['sys_GuoChengMingChen'];
	       $NOW_quanxian=$row['quanxian'];
	       $iig=$iig+1;
	       if ($iig<10) $iig='0'.$iig;
	       //------------------------------------- 统计数据 start
	       $rs2=$sql2=$nowrecordcount_jlmb='';
	       $sql2="select id From Sys_jlmb where sys_yfzuid='$hy' and Id_MenuBigClass='$NOW_menubigclass_id' and sys_huis=0  order by sys_card Asc";
			//echo $sql2;
		   $rs2=mysqli_query( $Conn , $sql2 );
		   $nowrecordcount_jlmb=mysqli_num_rows($rs2);//统计数量
           //$row2 = mysqli_fetch_array($rs2);
		   $NOW_menubigclass=$NOW_menubigclass.'&nbsp;&nbsp;('.$nowrecordcount_jlmb.")";
	       //--------------------------------------统计 end
		   
	       echo ("<ul Sys_Menu_id='$NOW_menubigclass_id' qxid='$NOW_menubigclass_id' onclick=\"ZhiLeng_Edit_Post(this);\" class='head headbg hoverthis'><li class='headbh leftli' title='id:$NOW_menubigclass_id'>$iig</li><li class='textleft'>$NOW_menubigclass</li>");
		   
	       //======================================================部门清单=========================
           $sql3="select id,bumenname From msc_bumenlist where sys_yfzuid='$hy' and sys_huis=0 order by id Desc";
           $rs3=mysqli_query( $Connadmin , $sql3 );
	       while($row3 = mysqli_fetch_array($rs3)){
               $bumenname=$row3['bumenname'];
	           echo ("<li class='rightli_check' title='$bumenname'>$bumenname</li>");
	       };
           mysqli_free_result($rs3);//释放内存
	       //======================================================部门清单end if===================
	       echo ('</ul>');
	    };//while end
		
    };//else end
    mysqli_free_result($rs);//释放内存
	  mysqli_close($Conn);//关闭数据库
	  mysqli_close($Connadmin);//关闭数据库
    echo ('</div><br><br><br><br><br>');
	echo ("<script>$('.DFtables ul').first().click();</script>");
	//echo ("<h3>&nbsp;&nbsp;</h3>")//EditSTDZhiLeng_Edit();
  };
  
  // 【ok】======================================================================= : 职能分配二级菜单
  function ZhiLeng_Edit_date(){
    global $Conn,$Connadmin,$hy,$nowgsbh,$sys_jlbhzt;//得到全局变量
	global $re_id,$bh,$sys_q_xiug,$sys_q_shanc,$sys_q_cak,$sys_q_dayin;//引用权限 //得到全局变量
	
	$id=$_REQUEST['id'];
	  //echo $nsquanxian;
    echo ("<div class='tables2'>");//这里是二级菜单标识
    $ii=$re_datapage_list=$re_id2=$nowcard=$bumenID=$bumenname=$This_quanxianlist=$nowrecordcount='';
	$sql="select * From Sys_jlmb where sys_yfzuid='$hy' and sys_huis='0' and Id_MenuBigClass='$id' order by id Asc";
	  //echo $sql;
	$rs=mysqli_query( $Conn,$sql );
	$nowrecordcount=mysqli_num_rows($rs);//统计数量
   
    if ($nowrecordcount<=0){//当没有数据时也要显示一行
	    echo ("<ul class='nodataul'><i class='fa fa-nodata'></i>&nbsp;sorry,没有相关菜单，请在“菜单管理”中添加。</ul>");
    }else{
       while ( $row = mysqli_fetch_array( $rs ) ) {
	       $re_datapage_list=$row['datapage_list'];
	       $re_id2=$row['id'];
	       $nowcard=$row['sys_card'];
	       $nowbanben=$row['banben'];
	       $nowxiugaicishu=$row['xiugaicishu'];
	       $nowcardall=$nowgsbh.'.'.$sys_jlbhzt.'-'.$re_id2.'-'.$nowbanben.'/'.$nowxiugaicishu;
	       echo ("<ul class='twomenu hoverthis'>");
		   echo  ("<li class='headbh leftli' style='padding-top:2px'><i class='fa fa-25-1'></i></li><li class='textleft w140'>".$nowcardall."</li><li class='textleft'>".$nowcard."</li>");
   	       //======================================================部门清单
			
           $sql2='select id,bumenname,quanxianlist From msc_bumenlist where sys_yfzuid='.$hy.' and sys_huis=0 order by id Desc';
	       $rs2=mysqli_query( $Connadmin , $sql2 );
	       
	       while($row2 = mysqli_fetch_array($rs2)){
	           $bumenID=$row2['id'];
               //$bumenname=$row2['bumenname'];
	           $bumenvalname='SYS_b_m'.$bumenID;
	           $This_quanxianlist=move_arrynull($row2['quanxianlist']);
	           echo "<li  class='rightli_check'><label><input type='checkbox' bumenID='$bumenID'  value='$bumenID' name='$bumenvalname' at='$re_id2' onchange=\"thistripnt('Edit_Bmquanxian',this,'$hy')\" ";
			   
	           if (getN($This_quanxianlist,$re_id2)>-1){
	               echo  (' checked=\'checked\' ');//选中时执行
	           };
			   if ( $sys_q_xiug > -1 or $bh=='9001') {//修改权限
			   }else{
				   echo " disabled ";
			   };
	           echo "></label></li>";
	           //echo ('<li>'.$bumenname.'</li>');
	       };//while 02 end
		   mysqli_free_result($rs2);//释放内存
		   /**/
		   echo ('</ul>');
		   
		   //======================================================部门清单  end
	   }//while 01 end
		mysqli_free_result($rs);//释放内存
		mysqli_close($Conn);//关闭数据库
		//mysqli_close($Connadmin);//关闭数据库
		
	echo ('</div>');
  };//if end
};//function end


  // 【ok】======================================================================= : 职责权限菜单
  function ZhiZheQuanXian(){
	global $sys_id_login;
	if($sys_id_login!=1){//无权限时
        echo"<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
        echo"<br><br><font style='color:red;padding-left:30px;font-size:12px;'>您无此栏目管理权限!</font>";
        exit();
    }

    global $Conn,$Connadmin,$hy;//得到全局变量
	$i=$NOW_ZhiWei_id=$NOW_bumen_id=$NOW_menubigclass=$iig='';
	echo ("<div class='DFtables' id='ZhiZheQuanXian'>");
	  echo ("<div class='DFtables' id='ZQright'>点选部门继续...</div>");
	$sql='select id,zu,bumen From msc_ZhiWei where sys_yfzuid='.$hy.' and sys_huis=0 order by bumen Asc';
	$rs=mysqli_query( $Connadmin , $sql );
	$nowrecordcount=mysqli_num_rows($rs);//统计数量
	  
	  //echo ("<ul class='nodataul' style='background-color:#FFF;color:#000'>职位清单</ul>");
    if ($nowrecordcount<=0){//当没有数据时也要显示一行
	    echo ("<ul class='nodataul'><i class='fa fa-nodata'></i>&nbsp;sorry,没有数据，请先添加/设置。</ul>");
    }else{
		$iig=$firstid=0;
        while ($row = mysqli_fetch_array($rs)){
		   $iig++;
		   if($iig<10){
	          $iig='0'.$iig;
	       };
           $NOW_ZhiWei_id=$row['id'];
		   
           $NOW_bumen_id=$row['bumen'];
	       $NOW_menubigclass=$row['zu'];
			
		   if($iig=='01'){
			   $firstid=$NOW_ZhiWei_id;//这里得到第一个值
		   }
	       //------------------------------------- 统计数据 start
	       $nowquxx='';$nowcount=0;
	       $sql2="select id,SYS_GongHao,SYS_UserName,SYS_QuanXian From `sys_yuangongdanganbiao` where  sys_yfzuid='$hy' and sys_huis=0 and (SYS_QuanXian  like '%" . "," . $NOW_ZhiWei_id . "," . "%' or SYS_QuanXian like '" . $NOW_ZhiWei_id . "," . "%' or SYS_QuanXian like '%" . "," . $NOW_ZhiWei_id . "%' or SYS_QuanXian ='$NOW_ZhiWei_id')";
		   $rs2=mysqli_query( $Conn , $sql2 );
		   $nowname='';
           while($row2 = mysqli_fetch_array($rs2) ){
			 //$nowquxx.=move_arrynull($row2['SYS_QuanXian']).','; 
			   //$nowname.='['.$row2['SYS_GongHao'].'-'.$row2['SYS_UserName'].'],'; 
		   }; 
		   $nowcount=mysqli_num_rows($rs2);//统计结果
		   $nowname =trim($nowname,','); //得到员工信息   

		   if($nowcount>=1){
			   $ok="<i class='fa fa-gou'></i>";
		   }else{
			   $ok="<i class='fa fa-gantanhao'></i>";
		   };
		   mysqli_free_result($rs2);//释放内存
			
		   $NOW_menubigclass=$NOW_menubigclass.'&nbsp';
		   
	       //------------------------------------- 统计数据 end
		   //echo 'E_zw_'.$NOW_ZhiWei_id;
	       echo ("<ul class='head headbg hoverthis E_zw' id='E_zw_$NOW_ZhiWei_id' onclick=\"ZhiZheQuanXian_GET($NOW_ZhiWei_id)\">");
	       echo ("<li class='headbh leftli' style='width:28px'>$iig</li>");
		   echo ("<li  class='textleft' style='width:70px'>$NOW_menubigclass</li>");
		   //echo ("<li  class='textleft' style='width:10px;text-align:center;padding:0;margin:0;'>$nowcount</li>");
           
		  
		   echo ("<li  class='textleft'>&nbsp;</li>");
	       //echo ("<li class='rightli  rightli30'>打印</li><li class='rightli rightli30'>回收</li><li class='rightli rightli30'>删除</li><li class='rightli rightli30'>修改</li><li class='rightli rightli30'>添加</li><li class='rightli rightli30'>查看</li>");
		   echo "</ul>";
        };//while end 
		echo "<script>ZhiZheQuanXian_GET($firstid)</script>";
    };// if else end
	mysqli_free_result($rs);//释放内存
	mysqli_close($Conn);//关闭数据库
	mysqli_close($Connadmin);//关闭数据库
    echo ('</div>');
	//echo ("<div id='ceishi888'>00</div><br>");
	//echo ("<script>$('.DFtables ul').first().click();<'/script>");
  };//function end
  // 【】======================================================================= : 职能分配
  function ZhiZheQuanXian_GET(){
	global $Conn,$Connadmin,$hy,$sys_q_xiug;//得到全局变量
	  
	  $zwid=$_REQUEST['zwid'];
	  //echo $zwid;
	  
    $rs=$sql=$row=$rs3=$sql3=$row3=$bumenname=$i=$NOW_menubigclass=$NOW_quanxian=$iig=$nowrecordcount='';
    echo ("<div class='DFtables' id='ZhiLeng_Edit' style='margin:5px;padding:0'>");
	$sql="select id,sys_GuoChengMingChen,quanxian From sys_menubigclass where sys_yfzuid='$hy' and sys_huis=0 order by sys_GuoChengMingChen Asc";
	 // echo $sql;
	$rs=mysqli_query( $Conn , $sql );
	$nowrecordcount=mysqli_num_rows($rs);//统计数量

    if ($nowrecordcount<=0 ){//当没有数据时也要显示一行
	    echo ("<ul class='nodataul'><i class='fa fa-nodata'></i>&nbsp;sorry,没有数据，请先添加。</ul>");
    }else{
		$iig=$i=0;
	    while ($row = mysqli_fetch_array($rs)){
		   $i++;
           $NOW_menubigclass_id=$row['id'];
	       $NOW_menubigclass=$row['sys_GuoChengMingChen'];
	       $NOW_quanxian=$row['quanxian'];
	       $iig=$iig+1;
	       if ($iig<10) $iig='0'.$iig;
	       //------------------------------------- 统计数据 总小类菜单
	       $rs2=$sql2=$nowrecordcount_jlmb='';
	       $sql2="select id From Sys_jlmb where sys_yfzuid='$hy' and Id_MenuBigClass='$NOW_menubigclass_id' and sys_huis=0  order by sys_card Asc";
			//echo $sql2;
		   $rs2=mysqli_query( $Conn , $sql2 );
		   $nowrecordcount_jlmb=mysqli_num_rows($rs2);//统计数量
           //$row2 = mysqli_fetch_array($rs2);
		   $NOW_menubigclass=$NOW_menubigclass;
	       //--------------------------------------查询职位对应的查看权限
			
		   $sql3 = "select * from `msc_zhiwei` where id ='$zwid' and sys_huis=0 ";
		   //echo($sql);
	       $rs3 = mysqli_query( $Connadmin , $sql3 );
	       $row3 = mysqli_fetch_array( $rs3 );
	       $now_q_cak3=$row3['sys_q_cak'];             //查看
	       mysqli_free_result( $rs3 );             //释放内存
		   //--------------------------------------查询选中的查看权限数量
		   if ($now_q_cak3.'1'=='1'){
			   $nowrecordcount_jlmb4=0;//统计数量
		   }else{
			   $sql4="select id From Sys_jlmb where sys_yfzuid='$hy' and Id_MenuBigClass='$NOW_menubigclass_id' and id in($now_q_cak3) and sys_huis=0  order by sys_card Asc";
			   //echo $sql2;
		       $rs4=mysqli_query( $Conn , $sql4 );
		       $nowrecordcount_jlmb4=mysqli_num_rows($rs4);//统计数量
               mysqli_free_result( $rs4 );             //释放内存
		   }
		   
			
		   //--------------------------------------输出内容
	       echo ("<ul Sys_Menu_id='$NOW_menubigclass_id' zwid='$zwid' qxid='$NOW_menubigclass_id' onclick=\"ZhiZheQuanXian_GET_date(this);\" class='head headbg hoverthis'>");
			
		   echo ("<li class='headbh leftli' title='id:$NOW_menubigclass_id'>$iig</li>");
		   echo ("<li class='leftli' style='width:140px;text-align:left;padding-left:3px;'>$NOW_menubigclass</li>");
		   echo ("<li class='textleft' style='border-left:0;color:#999'>[ <font color='red'>$nowrecordcount_jlmb4</font> / $nowrecordcount_jlmb ]</li>");
			
		   echo ("<li class='rightli rightli30' style='padding:0;width:30px;'><img src='images/Fugue_1177.png'></li>");
		   
		   if ( $sys_q_xiug > -1 or $bh=='9001') {//设定
				echo ("<li class='rightli rightli30' style='padding:0'  onclick=\"thistripnt_QuanXuan(this)\">全选</li>");
		   }else{
				echo ("<li class='rightli rightli30' style='padding:0'>全选</li>");
		   }
	       //echo ("<li class='rightli rightli30' style='padding:0'  onclick=\"thistripnt_QuanXuan(this)\">全选</li>");
		   echo ("<li class='rightli rightli30' style='padding:0'>设置</li>");
		   echo ("<li class='rightli rightli30' style='padding:0'>销毁</li>");
	       echo ("<li class='rightli rightli30' style='padding:0'>打印</li>");
		   echo ("<li class='rightli rightli30' style='padding:0'>回收</li>");	
		   echo ("<li class='rightli rightli30' style='padding:0'>删除</li>");
		   echo ("<li class='rightli rightli30' style='padding:0'>修订</li>");
		   echo ("<li class='rightli rightli30' style='padding:0'>查看</li>");
			
		   
		   echo ("<li class='rightli rightli30' style='padding:0'>批准</li>");
		   echo ("<li class='rightli rightli30' style='padding:0'>审核</li>");
		   echo ("<li class='rightli rightli30' style='padding:0'>经办</li>");
		   echo ("<li class='rightli rightli30' style='padding:0'>分配</li>");
		   echo ("<li class='rightli rightli30' style='padding:0'>编制</li>");
		  
		   echo ("<li class='rightli rightli30' style='width:155px;padding:0'>管辖范围</li>");
		   //echo ("<li class='rightli rightli30' style='padding:0'>$nowrecordcount_jlmb</li>");
	       echo ('</ul>');
			
	    };//while end
		
    };//else end
    mysqli_free_result($rs);//释放内存
	  mysqli_close($Conn);//关闭数据库
	  mysqli_close($Connadmin);//关闭数据库
    echo ('</div><br><br><br><br><br>');
	echo ("<script>$('.DFtables ul').first().click();</script>");
	//echo ("<h3>&nbsp;&nbsp;</h3>")//EditSTDZhiLeng_Edit();
  };
  
  // 【ok】======================================================================= : 职能分配二级菜单
  function ZhiZheQuanXian_GET_date(){
    global $Conn,$Connadmin,$hy,$nowgsbh,$sys_jlbhzt;//得到全局变量
	global $re_id,$bh,$sys_q_xiug,$sys_q_shanc,$sys_q_cak,$sys_q_dayin;//引用权限 //得到全局变量
	
	$id=$_REQUEST['id'];
	  //echo $id;
	$zwid=$_REQUEST['zwid'];
	  //echo $zwid;
	$sql = "select * from `msc_zhiwei` where id ='$zwid' and sys_huis=0 ";
		//echo($sql);
	$rs = mysqli_query( $Connadmin , $sql );
	$row = mysqli_fetch_array( $rs );
	
	  //echo $now_q_seid;
	$now_q_fanwei=$row['sys_q_fanwei'];       //范围
	$now_q_cak=$row['sys_q_cak'];             //查看
	$now_q_tianj=$row['sys_q_tianj'];         //添加
	$now_q_xiug=$row['sys_q_xiug'];           //修改
	$now_q_shenghe=$row['sys_q_shenghe'];     //审核
	$now_q_pizhun=$row['sys_q_pizhun'];       //批准
	$now_q_zhixing=$row['sys_q_zhixing'];     //执行
	$now_q_shanc=$row['sys_q_shanc'];         //删除
	$now_q_huis=$row['sys_q_huis'];           //回收
	$now_q_xiaohui=$row['sys_q_xiaohui'];     //销毁
	$now_q_dayin=$row['sys_q_dayin'];         //打印
	$now_q_seid=$row['sys_q_seid'];           //设定
	
	mysqli_free_result( $rs ); //释放内存
	  
	  
	  
    echo ("<div class='tables2'>");//这里是二级菜单标识
    $ii=$re_datapage_list=$re_id2=$nowcard=$bumenID=$bumenname=$This_quanxianlist=$nowrecordcount='';
	$sql="select * From Sys_jlmb where sys_yfzuid='$hy' and sys_huis='0' and Id_MenuBigClass='$id' order by id Asc";
	  //echo $sql;
	$rs=mysqli_query( $Conn,$sql );
	$nowrecordcount=mysqli_num_rows($rs);//统计数量
    if ($nowrecordcount<=0){//当没有数据时也要显示一行
	    echo ("<ul class='nodataul'><i class='fa fa-nodata'></i>&nbsp;sorry,没有相关菜单，请在“菜单管理”中添加。</ul>");
    }else{
       while ( $row = mysqli_fetch_array( $rs ) ) {
	       $re_datapage_list=$row['datapage_list'];
		   //echo $re_id2;
	       $re_id2=$row['id'];
	       $nowcard=$row['sys_card'];
	       $nowbanben=$row['banben'];
	       $nowxiugaicishu=$row['xiugaicishu'];
	       $nowcardall=$nowgsbh.'.'.$sys_jlbhzt.'-'.$re_id2.'-'.$nowbanben.'/'.$nowxiugaicishu;
	       echo ("<ul class='twomenu hoverthis'>");
		   
		   echo  ("<li class='headbh leftli' style='padding-top:2px'><i class='fa fa-25-1'></i></li><li class='textleft w140'>".$nowcardall."</li><li class='textleft'>".$nowcard."</li>");
		   
		    echo ("<li class='rightli rightli30' style='padding:0;width:30px;'>&nbsp;</li>");
		    //---------------------------------------------------------------------------------------------------- 横选
		    if ( $sys_q_xiug > -1 or $bh=='9001') {
				echo ("<li class='rightli rightli30' style='padding:0;'  bumenID='$zwid' re_id='$re_id2' onclick=\"thistripnt_hengxiang(this)\">横选</li>");
			}else{
				echo ("<li class='rightli rightli30' style='padding:0;color:#CCC'  bumenID='$zwid' re_id='$re_id2'>横选</li>");
			}
            //echo ("<li class='rightli rightli30' style='padding:0'  bumenID='$zwid' re_id='$re_id2' onclick=\"thistripnt_hengxiang(this)\">横选</li>");
		    //---------------------------------------------------------------------------------------------------- 设定
		    echo  ("<li class='rightli rightli30' style='padding:0'><label><input name='sys_q_seid' type='checkbox' bumenID='$zwid' value='$zwid' at='$re_id2' onchange=\"thistripnt_zhiwei('Edit_ZWquanxian_Update',this,'$hy')\" ");
	        if (getN($now_q_seid,$re_id2)>=0) echo (' checked ');
			if ( $sys_q_xiug > -1 or $bh=='9001') {//设定
			}else{
				   echo " disabled ";
			};
	        echo  ("></label></li>");
		    //---------------------------------------------------------------------------------------------------- 销毁
			echo  ("<li class='rightli rightli30' style='padding:0'><label><input name='sys_q_xiaohui' type='checkbox' bumenID='$zwid' value='$zwid' at='$re_id2' onchange=\"thistripnt_zhiwei('Edit_ZWquanxian_Update',this,'$hy')\" ");
	        if (getN($now_q_xiaohui,$re_id2)>-1) echo (' checked ');
			if ( $sys_q_xiug > -1 or $bh=='9001') {//
			}else{
				   echo " disabled ";
			};
	        echo  ("></label></li>");
		    //---------------------------------------------------------------------------------------------------- 打印
			echo  ("<li class='rightli rightli30' style='padding:0'><label><input name='sys_q_dayin' type='checkbox' bumenID='$zwid' value='$zwid' at='$re_id2' onchange=\"thistripnt_zhiwei('Edit_ZWquanxian_Update',this,'$hy')\" ");
	        if (getN($now_q_dayin,$re_id2)>-1) echo (' checked ');
			if ( $sys_q_xiug > -1 or $bh=='9001') {
			}else{
				   echo " disabled ";
			};
	        echo  ("></label></li>");
			//---------------------------------------------------------------------------------------------------- 回收
	        echo  ("<li class='rightli rightli30' style='padding:0'><label><input name='sys_q_huis' type='checkbox' bumenID='$zwid'  value='$zwid' at='$re_id2' onchange=\"thistripnt_zhiwei('Edit_ZWquanxian_Update',this,'$hy')\" ");
	        if (getN($now_q_huis,$re_id2)>-1) echo (' checked ');
			if ( $sys_q_xiug > -1 or $bh=='9001') {//修改权限
			}else{
				   echo " disabled ";
			};
	        echo  ('></label></li>');
			//---------------------------------------------------------------------------------------------------- 删除
	        echo  ("<li class='rightli rightli30' style='padding:0'><label><input name='sys_q_shanc' type='checkbox' bumenID='$zwid' value='$zwid' at='$re_id2' onchange=\"thistripnt_zhiwei('Edit_ZWquanxian_Update',this,'$hy')\" ");
	        if (getN($now_q_shanc,$re_id2)>-1 ) echo  (' checked ');
			if ( $sys_q_xiug > -1 or $bh=='9001') {//修改权限
			}else{
				   echo " disabled ";
			};
	        echo  ('></label></li>');
		    //---------------------------------------------------------------------------------------------------- 修改
	        echo  ("<li class='rightli rightli30' style='padding:0'><label><input name='sys_q_xiug' type='checkbox' bumenID='$zwid' value='$zwid' at='$re_id2' onchange=\"thistripnt_zhiwei('Edit_ZWquanxian_Update',this,'$hy')\" ");
	        if (getN($now_q_xiug,$re_id2)>-1 ) echo  (' checked ');
			
			if ( $sys_q_xiug > -1 or $bh=='9001') {//修改权限
			}else{
				   echo " disabled ";
			};
	        echo  ('></label></li>');
		    //---------------------------------------------------------------------------------------------------- 查看
		    echo  ("<li class='rightli rightli30' style='padding:0'><label><input name='sys_q_cak' type='checkbox' bumenID='$zwid' value='$zwid' at='$re_id2' onchange=\"thistripnt_zhiwei('Edit_ZWquanxian_Update',this,'$hy')\" ");
	        if (getN($now_q_cak,$re_id2)>-1) echo  (' checked ');
			
			if ( $sys_q_xiug > -1 or $bh=='9001') {//修改权限
			}else{
				   echo " disabled ";
			};
	        echo  ('></label></li>');
		    
		    //---------------------------------------------------------------------------------------------------- 批准
		    echo  ("<li class='rightli rightli30' style='padding:0'><label><input name='sys_q_pizhun' type='checkbox' bumenID='$zwid'  value='$zwid' at='$re_id2' onchange=\"thistripnt_zhiwei('Edit_ZWquanxian_Update',this,'$hy')\" ");
	        if (getN($now_q_pizhun,$re_id2)>-1) echo (' checked ');
			if ( $sys_q_xiug > -1 or $bh=='9001') {//修改权限
			}else{
				   echo " disabled ";
			};
	        echo  ('></label></li>');
			//---------------------------------------------------------------------------------------------------- 审核
	        echo  ("<li class='rightli rightli30' style='padding:0'><label><input name='sys_q_shenghe' type='checkbox' bumenID='$zwid' value='$zwid' at='$re_id2' onchange=\"thistripnt_zhiwei('Edit_ZWquanxian_Update',this,'$hy')\" ");
	        if (getN($now_q_shenghe,$re_id2)>-1 ) echo  (' checked ');
			if ( $sys_q_xiug > -1 or $bh=='9001') {//修改权限
			}else{
				   echo " disabled ";
			};
	        echo  ('></label></li>');
			//---------------------------------------------------------------------------------------------------- 经办
		    echo  ("<li class='rightli rightli30' style='padding:0'><label><input name='sys_q_zhixing' type='checkbox' bumenID='$zwid'  value='$zwid' at='$re_id2' onchange=\"thistripnt_zhiwei('Edit_ZWquanxian_Update',this,'$hy')\" ");
	        if (getN($now_q_zhixing,$re_id2)>-1) echo (' checked ');
			if ( $sys_q_xiug > -1 or $bh=='9001') {//修改权限
			}else{
				   echo " disabled ";
			};
	        echo  ('></label></li>');
		    //---------------------------------------------------------------------------------------------------- 分配
		    echo  ("<li class='rightli rightli30' style='padding:0'><label><input name='sys_q_zhixing' type='checkbox' bumenID='$zwid'  value='$zwid' at='$re_id2' onchange=\"thistripnt_zhiwei('Edit_ZWquanxian_Update',this,'$hy')\" ");
	        if (getN($now_q_zhixing,$re_id2)>-1) echo (' checked ');
			if ( $sys_q_xiug > -1 or $bh=='9001') {//修改权限
			}else{
				   echo " disabled ";
			};
	        echo  ('></label></li>');
			//---------------------------------------------------------------------------------------------------- 添加
	        echo  ("<li class='rightli rightli30' style='padding:0'><label><input name='sys_q_tianj' type='checkbox' bumenID='$zwid' value='$zwid' at='$re_id2' onchange=\"thistripnt_zhiwei('Edit_ZWquanxian_Update',this,'$hy')\" ");//添加
	        if (getN($now_q_tianj,$re_id2)>-1 ) echo  (' checked ');
			if ( $sys_q_xiug > -1 or $bh=='9001') {//修改权限
			}else{
				   echo " disabled ";
			};
	        echo  ('></label></li>');
			
	        
			
			echo  ("<li class='rightli' style='width:155px;padding:0'>");//权限
			$now_q_fanwei=$now_q_fanwei;//所有权限值
	        $zu_id=Q_fanwei_ID($now_q_fanwei,$re_id2);//查询到权限id等级值 0-4
			//echo "001";
			echo GUANXIA_FANWEI('msc_zhiwei','sys_q_fanwei','sys_q_fanwei',$zu_id,$re_id2,$zwid);
			
	        echo  ('</li>');
		    
		   
		   
		   
		   
		   
		   
		   echo ('</ul>');		   
		   //======================================================部门清单  end
	   }//while 01 end
		mysqli_free_result($rs);//释放内存
		mysqli_close($Conn);//关闭数据库
		//mysqli_close($Connadmin);//关闭数据库
		
	echo ('</div>');
  };//if end
};//function end
//【ok】=========================================================================职责范围
function GUANXIA_FANWEI( $tabalename, $inputname, $inputid, $zu_id, $jlmbid, $ZhiWei_id ) { //
	global $sys_id_login;
	if($sys_id_login!=1){//无权限时
    echo"<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    echo"<br><br><font style='color:red;padding-left:30px;font-size:12px;'>您无此栏目管理权限!</font>";
    exit();
}

	global $sys_q_xiug, $re_id, $Conn, $bh, $hy; //全局变量
	$To_SQL_input = '';

	$nowchange = " onchange=\"thistripnt('Edit_ZWquanxian_Update',this,'$hy')\" ";
	$To_SQL_input = "<select name='$inputname' at='$jlmbid' bumenID='$ZhiWei_id' id='$inputid' $nowchange class='addboxinput inputfocus' type='select' style='width:100%;height:100%;border:0;margin:0;padding:0;' ";
	if ( $sys_q_xiug > -1 or $bh == '9001' ) { //修改权限
	} else {
		$To_SQL_input .= " disabled ";
	};
	$To_SQL_input .= " >";

	$To_SQL_input .= "<option  value='0' ";
	if ( $zu_id == 0 ) {
		$To_SQL_input .= ' selected ';
	};
	$To_SQL_input .= ">个人</option>";

	$To_SQL_input .= "<option  value='1' ";
	if ( $zu_id == 1 ) {
		$To_SQL_input .= ' selected ';
	};
	$To_SQL_input .= ">部门</option>";

	$To_SQL_input .= "<option  value='2' ";
	if ( $zu_id == 2 ) {
		$To_SQL_input .= ' selected ';
	};
	$To_SQL_input .= ">公司/分公司</option>";

	$To_SQL_input .= "<option  value='3' ";
	if ( $zu_id == 3 ) {
		$To_SQL_input .= ' selected ';
	};
	$To_SQL_input .= ">总公司/集团</option>";
	$To_SQL_input .= "</select>";
	//echo $To_SQL_input;
	return $To_SQL_input;

} //function end

//======================================================================================================修改密码
function mima() {
	global $Conn; //得到全局变量
	echo( "<div class='ULTable'>" );
	echo( "<ul><li class='w20'></li><li class='w80'></li></ul>" );
	echo( "<ul><li class='w20'>原密码:</li><li  class='w80'><input id='ymima' name='ymima' type='password' class='w300'></li></ul>" );
	echo( "<ul><li class='w20'>新密码:</li><li class='w80'><input id='Xmima' name='Xmima' type='password'  class='w300'></li></ul>" );
	echo( "<ul><li class='w20'>确认新密码:</li><li  class='w80'><input id='Xmima2' name='Xmima2' type='password' class='w300'></li></ul>" );
	echo( "<ul><li class='w20'>&nbsp;</li><li class='w80'><input name=''  value='确认修改' type='button' onClick='Mima_XG(this)'></li></ul>" );
	echo '</div><div id=post_jg></div>';
	//echo( "<script>$('#bbsTabntq #ymima').attr('value','00000');</script>" );
};

    // 【ok】============================================================================================云会员
function YunHuiYuan_Edit(){
	global $sys_id_login;
	if($sys_id_login!=1){//无权限时
    echo"<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    echo"<br><br><font style='color:red;padding-left:30px;font-size:12px;'>您无此栏目管理权限!</font>";
    exit();
}

    global $Connadmin,$hy,$bh;//得到全局变量
	$i=$NOW_ZhiWei_id=$SYS_UserName=$NOW_menubigclass=$iig='';
	echo ("<div class='DFtables' id='Zhiquan_Edit'>");
	$sql="select * From msc_user_reg where SYS_reg_num='$hy' and sys_yfzuid='$hy' and  sys_huis=0  order by sys_web_shenpi,id desc";
	$rs=mysqli_query( $Connadmin , $sql );
	$nowrecordcount=mysqli_num_rows($rs);//统计数量
    if ($nowrecordcount<=0){//当没有数据时也要显示一行
	    echo ("<ul class='nodataul'><i class='fa fa-nodata'></i>&nbsp;sorry,没有数据，请先添加/设置。</ul>");
    }else{
		echo ("<ul  class='head headbg hoverthis'>");
	       echo ("<li class='headbh leftli' style='width:40px'>ID</li>");
		   echo ("<li  class='textleft' style='width:60px'> 工号</li>");
		   echo ("<li  class='textleft' style='width:80px'> 姓名</li>");
		   echo ("<li  class='textleft' style='width:100px'>手机号</li>");
		   echo ("<li  class='textleft' style='width:100px'>职位</li>");
		   //echo ("<li  class='textleft' style='width:40px'>公司id</li>");
		   echo ("<li  class='textleft' style='width:130px'>注册时间</li>");
		   echo ("<li  class='textleft' style='width:130px'>上次登录时间</li>");
		   echo ("<li  class='textleft' style='width:130px'>最近登录时间</li>");
		   echo ("<li  class='textleft' style='width:60px'>登录次数</li>");
		   
		   echo ("<li  class='textleft' style='width:60px'>性别</li>");
		   echo ("<li  class='textleft' style='width:80px'>允许登录</li>");
		   echo ("<li  class='textleft' style='width:50px'>基础工资</li>");
		   echo ("<li  class='textleft' style='width:50px'>职务工资</li>");
		   echo ("<li  class='textleft' style='width:50px'>工龄工资</li>");
           echo ("<li  class='textleft' style='width:350px'>工资卡</li>");
           echo ("<li  class='textleft' style='width:50px'>Del</li>");
           
		   echo ("<li  class='textleft'>&nbsp;</li>");
		   echo "</ul>";
		$iig=0;
        while ($row = mysqli_fetch_array($rs)){
		   $iig++;
		   if($iig < 10){
	          $iig='0'.$iig ;
	       }
           $id=$row['id'];
           $onchange="JL_updata_changdata(this,'JL_updata_changdata','msc_user_reg',$id,this.name)";
	       //------------------------------------- 统计数据 end
		   
	       echo ("<ul  class='head hoverthis' style='height:28px;line-height:28px'>");
	       echo ("<li class='headbh leftli' style='width:40px;height:28px;line-height:28px'>$iig</li>");
		   echo ("<li  class='textleft' style='width:60px;height:28px;line-height:28px'><input name='SYS_GongHao' type='text' style='width:100%;' value='".$row["SYS_GongHao"]."' onchange=".$onchange." /></li>");
		   echo ("<li  class='textleft' style='width:80px;height:28px;line-height:28px'><input name='SYS_UserName' type='text' style='width:100%;' value='".$row["SYS_UserName"]."' onchange=".$onchange." /></li>");
		   echo ("<li  class='textleft' style='width:100px;height:28px;line-height:28px'><input name='SYS_ShouJi' type='text' style='width:100%;' value='".$row["SYS_ShouJi"]."' onchange=".$onchange." /></li>");
		   echo ("<li  class='textleft' style='width:100px;height:28px;line-height:28px'>");
		   $nowSYS_QuanXian=$row['SYS_QuanXian'];//当前权限值
	       if( $bh=='9001' ){
			   //$onchange="JL_updata_changdata(this,'JL_updata_changdata','msc_user_reg',$id,'SYS_QuanXian')";
			   
		       $sql2="select * from `msc_zhiwei` where sys_yfzuid='$hy' and sys_huis=0 ";
		       $rs2=mysqli_query($Connadmin,$sql2);
		       echo( "<select name='SYS_QuanXian'  onchange=$onchange  class='addboxinput inputfocus' style='width:100%'>" ); 
			    echo( "<option  value=''>未选择</option>");
		       while($row2=mysqli_fetch_array($rs2)){
				   $rowdid=$row2["id"];
				   $rowzu=$row2["zu"];
		           echo( "<option  value='$rowdid' " );
		           if ( $nowSYS_QuanXian == $rowdid ){
				     echo( 'selected' );
				   }
		           echo( ">{$rowzu}</option>" );
				  
		       }
			   echo( '</select>' );
			   $row2=mysqli_fetch_array($rs2);
		   }else{
			   $sql3="select * from `msc_zhiwei` where id='$nowSYS_QuanXian'";
		       $rs3=mysqli_query($Connadmin,$sql3);
			   $row3=mysqli_fetch_array($rs3);
			   echo( "{$row3['zu']}" );
			   mysqli_free_result($rs3);//释放内存
		   }
		   
		    echo( '</li>' );
			$sys_web_shenpi=$row['sys_web_shenpi'];
		    if($sys_web_shenpi==1){
			   $web_shenpi="<i class=\"fa fa-28-3\" changeid='$id' style='height:25px;margin-top:2px' onclick='changeon(this)'></i>";//关
		    }else{
			   $web_shenpi="<i class=\"fa fa-27-3\" changeid='$id' style='height:25px;margin-top:2px' onclick='changeon(this)'></i>";//开
			}
		   
		   //echo ("<li  class='textleft' style='width:40px'>".$row['SYS_Company_id']."&nbsp;</li>");
		   echo ("<li  class='textleft' style='width:130px;height:28px;line-height:28px'>".$row['sys_adddate']."&nbsp;</li>");
		   echo ("<li  class='textleft' style='width:130px;height:28px;line-height:28px'>".$row['SYS_a_logintime']."&nbsp;</li>");
		   echo ("<li  class='textleft' style='width:130px;height:28px;line-height:28px'>".$row['sys_adddate_g']."&nbsp;</li>");
		   echo ("<li  class='textleft' style='width:60px;height:28px;line-height:28px'>".$row['SYS_ZD_DengLuCiShu']."&nbsp;</li>");
		   echo ("<li  class='textleft' style='width:60px;height:28px;line-height:28px'><input name='SYS_XingBie' type='text' style='width:100%;' value='".$row["SYS_XingBie"]."' onchange=".$onchange." />&nbsp;</li>");
		   echo ("<li  class='textleft' style='width:80px;height:28px;line-height:28px'>$web_shenpi&nbsp;</li>");
			
		   echo ("<li  class='textleft' style='width:50px;height:28px;line-height:28px'><input name='sys_jichugongzi' type='text' style='width:100%;' value='".$row["sys_jichugongzi"]."' onchange=".$onchange." /></li>");
		   echo ("<li  class='textleft' style='width:50px;height:28px;line-height:28px'><input name='sys_zhiwugongzi' type='text' style='width:100%;' value='".$row["sys_zhiwugongzi"]."' onchange=".$onchange." /></li>");
		   echo ("<li  class='textleft' style='width:50px;height:28px;line-height:28px'><input name='sys_gonglinggongzi' type='text' style='width:100%;' value='".$row["sys_gonglinggongzi"]."' onchange=".$onchange." /></li>");

		   //echo ("<li  class='textleft' style='width:3%;text-align:center;padding:0;margin:0;'><i class='fa fa-add'></i></li>");
            
           echo ("<li  class='textleft' style='width:350px;height:28px;line-height:28px'><input name='SYS_YinXingKaHao' type='text' style='width:100%;' value='".$row["SYS_YinXingKaHao"]."' onchange=".$onchange." /></li>");
        
           echo ("<li  class='textleft' style='width:50px;height:28px;line-height:28px'><i class=\"fa fa-del-mini\" sys_id='$id' sys_tablename='msc_user_reg' sys_zd='sys_huis' style='height:25px;margin-top:5px' onclick='delul_user(this)'></i>&nbsp;</li>");
            
		   echo "</ul>";
        };//while end 
    };// if else end
	mysqli_free_result($rs);//释放内存
	mysqli_close($Connadmin);//关闭数据库
    echo ('</div>');
	//echo ("<div id='ceishi888'>00</div><br>");
	//echo ("<script>$('.DFtables ul').first().click();<//script>");
  };//function end
 
 

  
  // 【】======================================================================= : 这里为自动对应Sys_MenuBigClass的id到Sys_Jlmb的id_MenuBigClass列
  function jlmb_update(){
  	global $Conn;//得到全局变量
    $sql='select id,quanxian From Sys_MenuBigClass';
	$rs=mysqli_query( $Conn , $sql );
	$nowrscount=mysqli_num_rows($rs);//统计数量
    
	while($row = mysqli_fetch_array($rs)){
	    $nowbigid=$row['id'];
        $nowquanxianarry=$row['quanxian'];//这里查询到所有的权限数组
		$nowarry=explode(',',$nowquanxianarry);
		for ($ii=0 ;$ii<count($nowarry);$ii++){
		   $nowquanxianid=nowarryy($ii);
		   $sql="UPDATE  Sys_Jlmb  set Id_MenuBigClass='$nowbigid' WHERE id='$nowquanxianid'";
		   mysqli_query( $Conn , $sql );//更新多条记录
		};
	    //$rs.movenext;
	};
     mysqli_free_result($rs);//释放内存
	 mysqli_close($Conn);//关闭数据库
  };

	


?>