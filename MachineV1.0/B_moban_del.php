<?php
header('Content-type: text/html; charset=utf-8');//设定本页编码
include_once '../session.php' ;
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php';//执行接收参数及配置
include_once '../inc/B_conn.php';
include_once '../inc/B_connadmin.php';
include_once '../inc/Sub_All.php';


if ( $re_id <> 0 ) {
	$rs = $sql = $r_zt = $r_zt_bianhao = $databiao1 = $databiao_SYS1 = $mdb_use_type = $xiugai_ZD_Arry = $bitian_Arry = $strmkzd = $strmk = '';
	$sql = "select mdb_name_SYS From Sys_jlmb where id='$re_id'";
	$rs = mysqli_query(  $Conn , $sql );
	$row = mysqli_fetch_array( $rs );
	mysqli_free_result( $rs ); //释放内存
	//$r_zt = $row[ 'sys_zt' ]; //系统字头
	//$r_zt_bianhao = $row[ 'sys_zt_bianhao' ]; //系统字头编号
	$databiao = trim( $row[ 'mdb_name_SYS' ] ); //原数据表名
	
};
$Conn=ChangeConn($databiao);    //依据表自动选择数据库

//ok==============================================================================接收参数开始
$act=$DELtablename=$id='';
if (isset($_POST['act']))          $act=$_POST['act'];
if (isset($_POST['DELtablename'])) $DELtablename=$_POST['DELtablename'];
if ('1'.$DELtablename=='1')        $DELtablename=$databiao;
if (isset($_POST['id']))           $id=htmlspecialchars(str_replace(' ','',$_POST['id']));//ID接收D

    if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";	};//关系列id
    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //j显示页面
	if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                              //是否为回收站0为不回收
    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                           //是否为回收站0为不回收

if ($act=='Del_To_Huis' and $id >''){
    dels();
}elseif($act=='dels_true' and $id>''){
    dels_true();
}elseif($act=='dels_huis' and $id>''){
    dels_huis();
}elseif($act=='changeid_zu' and $id>''){
    changeidzu();
}elseif($act=='changeid_login' and $id>''){
    changeidlogin();
}else{
    echo ('指令有误！');
};
//[ok]============================================================================批量 删除到回收站
function dels(){
    global $id,$sys_q_shanc,$re_id,$DELtablename;//得到全局变量
    $str2=$rs=$sql=$i='';
    $connect = Changedb( $DELtablename );
    if ($sys_q_shanc>-1){//有删除权限
       $str2=explode(',',$id);//字符串转为数组
       $countArry=count($str2);
       $connect -> beginTransaction();
       for ($i=0 ;$i< $countArry;$i++){
            $strmk_id=intval($str2[$i]);
            $sql="update `$DELtablename` set sys_huis = '1' where id='$strmk_id' ";
            echo $sql;
            echo json_encode($connect -> query( $sql ),JSON_UNESCAPED_UNICODE);//执行与更新
            sys_count_fromdel_updata($DELtablename,$strmk_id);           //父关系统计
            //-----------------------------------------------添加修改记录
            $sys_editcontent='批量删除到回收站;';
            $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
            $sys_postvalue_list = "'$re_id','$strmk_id','$sys_editcontent'";		
            Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
            //-----------------------------------------------利益
            LiYi_Add($re_id,$strmk_id,539,'+');       //利益函数 这里奖励货币
       };
       $connect -> commit();
    };
};
//[ok]============================================================================批量 回收数据
function dels_huis(){
   global $id,$sys_q_huis,$re_id,$DELtablename;//得到全局变量
   //echo("$re_id'_'$DELtablename'_'$id");
   $connect = Changedb( $DELtablename ); //依据表自动选择数据库
   $str2=$rs=$sql=$i='';
   if ($sys_q_huis>-1){//有回收权限
       $str2=explode(',',$id);//字符串转为数组
       $countArry=count($str2);
       $connect -> beginTransaction();
       for ($i=0 ;$i< $countArry;$i++){
		   //echo intval($str2[$i]);
		  $strmk_id=intval($str2[$i]);
          $sql="update `$DELtablename` set sys_huis = '0' where `id`='$strmk_id' ";
          $connect -> query($sql);//执行添加与更新
		  sys_count_fromdel_updata($DELtablename,$strmk_id);           //父关系统计
		  //-----------------------------------------------添加修改记录
		  $sys_editcontent='从回收站找回;';
		  $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	      $sys_postvalue_list = "'$re_id','$strmk_id','$sys_editcontent'";		
	      Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
		  //-----------------------------------------------利益
		  LiYi_Add($re_id,$strmk_id,540,'+');       //利益函数 这里奖励货币
       };
       $connect -> commit();
   };
};

//[ok]============================================================================分类修改
function changeidzu(){
    global $Conn,$id,$sys_q_xiug,$re_id,$DELtablename;//得到全局变量
	$changeid_zu=$str2=$rs=$sql=$i='';
    if (isset($_POST['changeid_zu'])) $changeid_zu=trim($_POST['changeid_zu'],',');//批量改变的sys_id_zu
    if ($sys_q_xiug > -1){//有删除权限
       $str2=explode(',',$id);
       $countArry=count($str2);
       for ($i=0 ;$i<$countArry;$i++){
		  $strmk_id=intval($str2[$i]);                     //id值
		  
		  //-----------------------------------------------------------查询原记录
          $sql2 = "select sys_id_zu From  `$DELtablename`  where `id`='$strmk_id'";
          $rs2 = mysqli_query( $Conn, $sql2 );
          $row2 = mysqli_fetch_array( $rs2 );
          $Y_sys_id_zu=$row2['sys_id_zu'];
          mysqli_free_result( $rs2 ); //释放内存
		  //-----------------------------------------------更新分类值
          $sql="update ".$DELtablename." set sys_id_zu='".$changeid_zu."' where id=".$strmk_id;
          mysqli_query( $Conn , $sql );                   //执行添加与更新
		  //-----------------------------------------------添加修改记录
		  $sys_editcontent='批量修改分类：'.$Y_sys_id_zu.'=>'.$changeid_zu;
		  $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	      $sys_postvalue_list = "'$re_id','$strmk_id','$sys_editcontent'";		
	      Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
       };
    };
};
   
//[ok]============================================================================所有人修改
function changeidlogin(){
   global $Conn,$id,$sys_q_xiug,$re_id,$DELtablename;//得到全局变量
   //$str2=$changeid_login=$changeid_loginame=$i='';
   
   if (isset($_POST['changeid_login'])) $changeid_login=$_POST['changeid_login'];//批量改变的id_login
   if (isset($_POST['changeid_loginame'])) $changeid_loginame=$_POST['changeid_loginame'];//批量改变的login
	//echo $id;
   if ($sys_q_xiug >-1){//有删除权限
      $str2=explode(',',$id);
      $countArry=count($str2);
      for ($i=0;$i< $countArry;$i++){
		 $strmk_id=intval($str2[$i]);                     //id值
		 //-----------------------------------------------------------查询原记录
         $sql2 = "select sys_id_login,sys_login From  `$DELtablename`  where `id`='$strmk_id'";
         $rs2 = mysqli_query( $Conn, $sql2 );
         $row2 = mysqli_fetch_array( $rs2 );
		 $Y_sys_login=$row2['sys_login'];
         $Y_sys_id_login=$row2['sys_id_login'];
         mysqli_free_result( $rs2 ); //释放内存
		  
         $sql="update `$DELtablename` set sys_id_login='$changeid_login',sys_login='$changeid_loginame' where id=$str2[$i] ";
		  //echo $sql;
         mysqli_query( $Conn , $sql );//执行添加与更新
		 //-----------------------------------------------添加修改记录
		 $sys_editcontent='批量修改编制人：'.$Y_sys_login.'（'.$Y_sys_id_login.'）=>'.$changeid_loginame.'（'.$changeid_login.')';
		 $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	     $sys_postvalue_list = "'$re_id','$strmk_id','$sys_editcontent'";		
	     Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
		  
      };//for end
	  echo "您已成功向【{$changeid_loginame}】转移了【{$countArry}】条记录。";
   };//if end
};//function end

//[ok]============================================================================彻底删除数据
function dels_true(){
   global $Conn,$id,$sys_q_xiaohui,$re_id,$DELtablename; //得到全局变量
   $str2=$rs=$sql=$i='';
   $str2=explode(',',$id);
   $countArry=count($str2);
	//echo "a";
   if ($sys_q_xiaohui > -1){//有删除权限
      for ($i=0 ;$i< $countArry;$i++){
		 $strmk_id=$str2[$i];
         $sql='delete  From '.$DELtablename.' where id='.trim($str2[$i]);
		  //echo $sql;
	     mysqli_query( $Conn , $sql );//执行完全删除
		 //-----------------------------------------------添加修改记录
		 $sys_editcontent='销毁了该条数据';
		 $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	     $sys_postvalue_list = "'$re_id','$strmk_id','$sys_editcontent'";		
	     Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
		 //-----------------------------------------------利益
		 LiYi_Add($re_id,$strmk_id,542,'+');       //利益函数 这里奖励货币
      };
      //=待增加=//（还差相关数据）删除时执行其它动作
   };
};

mysqli_close($Conn);//关闭数据库
//mysqli_close($Connadmin);//关闭云数据库
?>
