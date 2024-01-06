<?php
header('Content-type: text/html; charset=utf-8');//设定本页编码
include_once '../session.php' ;
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';

include_once '../inc/Sub_All.php';
include_once '../inc/Function_list.php';
include_once '../inc/B_Config.php';//执行接收参数及配置
include_once '../inc/B_conn.php';
include_once '../inc/B_connadmin.php';

  $page_first=($page-1)*$maxrecord+1; //开始的记录数
  if ('1'.$page_first=='1') $page_first=0;
  $page_end=$page_first+$maxrecord-1;  //结束的记录数
  if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};//是否为回收站0为不回收
  
  
  if ($act=='list' ){
     foots();
  }else{
     echo NoZhiLing();//没有执行的命令
  };

function foots(){//分页
  global $Conn,$nowkeyword,$const_q_cak,$re_id,$page_count,$page,$ToHtmlID,$record_count,$hy,$const_q_fanwei,$huis;//全局变量
	
  //------------------------识别是否为页中页
  if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
  if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";	};//关系列id
  if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //j显示页面
  if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                              //是否为回收站0为不回收
  //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                           //是否为回收站0为不回收
  //----------------------页中页结束
	
  //以下为获得页数参数list_0_id_0_Desc_1__1_1_50
  //echo ($act."_".$nowzu."_".$px_ziduan."_".$zd."_".$pxv."_".$pok."_".$nowkeyword."_".$page."_".$page_first."_".$page_end)
  //echo ($const_q_cak);
  // echo 'Q:'.$const_q_fanwei;
 if ($const_q_cak>-1){//有权限时
  //=========================================================================得到记录模版设定信息
   $rs=$sql=$sql2=$databiao1=$databiao_SYS1=$mdb_use_type=$databiao='';
   
   $sql='select mdb_name_SYS,Mtiaoshu From Sys_jlmb where sys_yfzuid='.$hy.' and id='.$re_id;
   $rs=mysqli_query( $Conn , $sql );
   $row = mysqli_fetch_array($rs);
   mysqli_free_result($rs);//释放内存
   $databiao = htmlspecialchars(trim($row['mdb_name_SYS']));//原数据表名
	 
   $Conn=ChangeConn($databiao);
   $Nowmaxrecord = intval($row['Mtiaoshu']);//页显示数
   if ($Nowmaxrecord . '1' != '1' ){
     $maxrecord = $Nowmaxrecord;
   };
   //$rs.Close;
   
   
  if ($databiao.'1'!='1' ){
    $rsstr=$strsql=$record_count=$page_count='';
    $sql2=sql_all_counts($databiao,$nowkeyword,$huis,0);
	  //-------------------关系筛选
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   //-------------------关系筛选END
	
	$sql=sql_search($databiao, $sql2, $nowkeyword, 0 );
	//echo "<script>alert('$sql');</script>";
	//exit;
	$rs=mysqli_query( $Conn , $sql );
	$record_count=mysqli_num_rows($rs);//统计总记录数
	$page_count=ceil($record_count/$maxrecord);//进一取整 总页数
    if ($record_count>0){
      if ($page<1) $page=1;
      if ($page>$page_count) $page=$page_count;
	};
    if ($page_count==0) $page_count=1;
	  
	mysqli_free_result($rs);//释放内存
  }else{
    $page=$page_count=1;
    $record_count=0;
  };
 };


   
   //$page_count=总页数；$page=当前页；
   echo "<script>$('#$ToHtmlID #page_c').val('$page_count');$('#$ToHtmlID #page_v').attr({'cs':'$page','value':'$page','pgc':'$page_count'}); $('#$ToHtmlID #page_count').html('".$page_count."');$('#$ToHtmlID #record_count').html('Σ&nbsp;$record_count');Fpage($page,'ok','$ToHtmlID'); </script>";
	//echo LiYi_Add(280,50,'sys_JiangLiHuoBi');       //利益函数 这里奖励货币
};  
   mysqli_close($Conn);//关闭数据库
   //mysqli_close($Connadmin);//关闭云数据库
   //http://localhost/MachineV1.0/B_moban_foot.php?act=list&page=1&zu=0&keyword=&re_id=321&zd=0&px_name=id&pxv=Desc&pok=1&bh=9001&hy=9007&scroll_left=0
?>
