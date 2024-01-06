
<?php
header('Content-type: text/html; charset=utf-8');//设定本页编码
include_once '../session.php';
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php';//执行接收参数及配置
include_once '../inc/B_conn.php';
include_once '../inc/B_connadmin.php';



$strmk=$strmkzd='';
//接收参数开始
$act=trim($_REQUEST['act']);

if( isset($_REQUEST['strmkzd'])){
	$strmkzd=htmlspecialchars(trim($_REQUEST['strmkzd']));
};//更新动态接收
if( isset($_REQUEST['strmk'])){
	$strmk=htmlspecialchars(trim($_REQUEST['strmk']));
};//更新动态接收

if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";	};//关系列id
    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //j显示页面
	if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                              //是否为回收站0为不回收
    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                           //是否为回收站0为不回收

if ($act='list'){
  lists();
}elseif($act='add'){
  edit();
};

function lists(){
  global $Conn,$Connadmin,$re_id,$hy,$ToHtmlID;//得到全局变量
  //$databiao=Find_tablename( $re_id );   //得到表名
  //echo $databiao;
  //$Conn=ChangeConn($databiao);
  $rs=$sql=$nowrscount=$SYS_GongHao=$SYS_UserName='';
  //echo $re_id;
	//echo $hy;
  $sql="select SYS_GongHao,SYS_UserName From `msc_user_reg` where sys_yfzuid='$hy'";
	//echo $sql;
  $rs=mysqli_query( $Connadmin, $sql );
  $nowrscount=mysqli_num_rows($rs);//统计数量
	//echo $nowrscount;
  

  echo ("<form id='post_form' autocomplete='off'><div id='mobanaddbox' class='NowULTable' style='text-align:right;width:220px;height:420px;float:left;'>");
  echo ("<ul><li style='text-align:right;width:20%;'><i class='fa fa-bookmark'></i>&nbsp;</li><li style='width:80%;'><font style='cursor:hand;'>批量修改“添加人”</font></br><select name='changeid_login' size='20' id='changeid_login' class='addboxinput'  style='width:200px;'>");
    //=========================================================================得到员工信息
  if ($nowrscount==0){
    echo ("<option value='0'>无员工信息！</option>");
	
  }else{
    while($row = mysqli_fetch_array($rs)){//当有数据时
       $SYS_GongHao=$row['SYS_GongHao'];
       $SYS_UserName=$row['SYS_UserName'];
	   echo ('<option value=\''.$SYS_GongHao.'\'>'.$SYS_UserName.'</option>');
       //$rs.movenext;
    };
  }
  mysqli_free_result($rs);//释放内存
  echo ('</select></li></ul>');
  echo ("<ul><li style='text-align:right;width:20%;'>&nbsp;</li><li style='width:80%;'><input id='SYS_submit' value='&nbsp;确定修改&nbsp;' type='button' title='Ctrl+Enter提交' class='button'   onclick="."looddata(14,'".$ToHtmlID."')"." /></li></ul>");
  echo ('</div>');
  
  //=================================================================02
    echo ("<div id='mobanaddbox2' class='NowULTable' style='text-align:right;width:220px;height:420px;float:left;'>");
    echo ("<ul><li style='text-align:right;width:20%;'><i class='fa fa-bookmark'></i>&nbsp;</li><li style='width:80%;'><font style='cursor:hand;'>批量修改“分类”</font></br>");
	$sql="select id,lname1 From `sys_zuall` where sys_yfzuid='$hy' and tableid='$re_id' and sys_huis=0 order by sys_nowbh Asc";
	//echo $sql;
	echo ("<select name='changeid_zu' size='20' id='changeid_zu' class='addboxinput'  style='width:160px;'>");
    //=========================================================================得到分类信息
	//echo ("<option value='0'>请选择分类</option>");
    
	$rs=mysqli_query( $Conn , $sql );
    while($row2 = mysqli_fetch_array($rs)){//当有数据时
       $now_id=$row2['id'];
       $now_lname1=$row2['lname1'];
	   echo ('<option value=\''.$now_id.'\'>'.$now_lname1.'</option>');
       //$rs.movenext;
    };
    mysqli_free_result($rs);//释放内存
	
	
    
 
  
  echo ('</select></li></ul>');
  echo ("<ul><li style='text-align:right;width:20%;'>&nbsp;</li><li style='width:80%;'><input id='SYS_submit' value='&nbsp;确定修改&nbsp;' type='button' title='Ctrl+Enter提交' class='button'  onkeydown='' onclick="."looddata(13,'".$ToHtmlID."')"." /></li></ul>");
  echo ('</div></form>');
  
  
};


  
  mysqli_close($Conn);//关闭数据库
  //mysqli_close($Connadmin);//关闭云数据库
?>
