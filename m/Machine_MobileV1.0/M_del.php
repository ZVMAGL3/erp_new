<?php
header('Content-type: text/html; charset=utf-8');//设定本页编码
include_once '../../session.php' ;
include_once( 'M_quanxian.php' );                      //接收职位权限信息
include_once '../../inc/Function_All.php';
include_once '../../inc/Sub_All.php';
include_once '../../inc/B_Config.php';//执行接收参数及配置
include_once '../../inc/B_conn.php';
include_once '../../inc/B_connadmin.php';



//ok==============================================================================接收参数开始
$act=$DELtablename=$id='';
if (isset($_POST['act']))          $act=$_POST['act'];
if (isset($_POST['tablename']))    $DELtablename=$_POST['tablename'];
if (isset($_POST['id']))           $id=htmlspecialchars(str_replace(' ','',$_POST['id']));//ID接收D
$Conn=ChangeConn($DELtablename);   //这里选择数据库

if ($act=='Del_To_Huis' and $id >''){
    dels();
}elseif($act=='dels_true' and $id>''){
    dels_true();
}elseif($act=='dels_huis' and $id>''){
    dels_huis();
}else{
    echo ('指令有误！');
};
//[ok]============================================================================批量 删除到回收站
function dels(){
    global $Conn,$id,$const_q_shanc,$re_id,$DELtablename,$tablename,$colsname,$textsname,$phpstart;//得到全局变量
    $str2=$rs=$sql=$i='';
    if ($const_q_shanc>-1){//有删除权限
       $str2=explode(',',$id);//字符串转为数组
       $countArry=count($str2);
       for ($i=0 ;$i< $countArry;$i++){
          $sql="update `$DELtablename` set sys_huis = '1' where id=".intval($str2[$i]);
           //echo($sql);
          mysqli_query( $Conn , $sql );//执行添加与更新
       };
	//echo "$('.nowcolfirst').show();";
    };
};
//[ok]============================================================================批量 回收数据
function dels_huis(){
   global $Conn,$id,$const_q_huis,$re_id,$DELtablename,$tablename,$colsname,$textsname,$phpstart;//得到全局变量
   //echo("$re_id'_'$DELtablename'_'$id");
   $str2=$rs=$sql=$i='';
   if ($const_q_huis>-1){//有回收权限
       $str2=explode(',',$id);//字符串转为数组
       $countArry=count($str2);
       for ($i=0 ;$i< $countArry;$i++){
		   //echo intval($str2[$i]);
          $sql="update `$DELtablename` set sys_huis = '0' where `id`=".intval($str2[$i]);
           //echo $sql;
          mysqli_query( $Conn , $sql );//执行添加与更新
       };
   };
};

//[ok]============================================================================彻底删除数据
function dels_true(){
   global $Conn,$id,$const_q_shanc,$re_id,$DELtablename,$tablename,$colsname,$textsname,$phpstart;//得到全局变量
   $str2=$rs=$sql=$i='';
   $str2=explode(',',$id);
   $countArry=count($str2);
    //echo $id;
   if ($const_q_xiug > -1){//有删除权限
      for ($i=0 ;$i< $countArry;$i++){
         $sql='delete  From '.$DELtablename.' where id='.trim($str2[$i]);
          //echo $sql;
	     mysqli_query( $Conn , $sql );//执行完全删除
         //-----------------------------------------------删除质量记录时执行
         if($DELtablename=='sys_jlmb'){
             table_del_Modular( $DELtablename );//删除数据表
         }
      };
   //=待增加=//（还差相关数据）删除时执行其它动作
   };
};

mysqli_close($Conn);//关闭数据库
//mysqli_close($Connadmin);//关闭云数据库
?>
