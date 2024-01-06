<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Template_terms_Set.php'; //连上参数设定

if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata( $id ); //标准条款清单
}

//[ok]=========================================================================【标准条款 输出数据】
function listdata( $id ) {
    global $Connadmin, $hy, $nowkeyword, $huis, $textsname, $phpstart, $tablename, $colsname;
    
    //echo "<br><br><br><br>".$id ;
    $sql = $rs = $listdata = '';
    //---------------------------------------------------------------------得到大类菜单
    $sql = "select * From `msc_renzhengmoban` where id='$id'  order by id Asc";
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    $sys_beizhu = $row[ 'sys_beizhu' ];
    $sys_title = $row[ 'sys_title' ];
    $sys_hangye = $row[ 'sys_hangye' ];
    mysqli_free_result( $rs ); //释放内存

    //$listdata = '<li><a href="M_Template_terms_edit.php?id='.$id.'">' . $sys_konggei . $tiaok . '&nbsp;' . $name  . $nowhuishtml . '</a></li>';
    $listdata = '<li style="margin-top:12px;margin-bottom:8px;"><a href="M_Template_edit.php?id=' . $id . '"><i class="fa fa-sitting-ziduan"></i>&nbsp;&nbsp;<strong>' . $sys_title . '</strong><dd class="hui">' . $sys_hangye . '</dd></a></li>';
    
    //---------------------------------------------------------------------得到参数
    $sql2 = "select * From `msc_renzhengmoban_chanshu` where sys_Id_MenuBigClass='$id' and sys_huis='0' and sys_yfzuid='$hy'  order by id Asc";
    $rs2 = mysqli_query( $Connadmin, $sql2 );
    $record_count2 = mysqli_num_rows( $rs2 ); //统计总记录数
    mysqli_free_result( $rs2 ); //释放内存
    
    $listdata .= '<li class="fenji"><a href="M_Template_list.php?parent_id='.$id.'">&nbsp;&nbsp;<i class="fa fa-11-4"></i>&nbsp;参数<dd class=\'hui\'>'.$record_count2.'</dd></a></li>';
    
    //---------------------------------------------------------------------得到模版文件
    $sql3 = "select * From `msc_renzhengmoban_files` where sys_Id_MenuBigClass='$id' and sys_huis='0' and sys_yfzuid='$hy'  order by id Asc";
    $rs3 = mysqli_query( $Connadmin, $sql3 );
    $record_count3 = mysqli_num_rows( $rs3 ); //统计总记录数
    mysqli_free_result( $rs3 ); //释放内存
    
    $listdata .= '<li class="fenji"><a href="M_Template_list_files.php?parent_id='.$id.'">&nbsp;&nbsp;<i class="fa fa-11-4"></i>&nbsp;模版<dd class=\'hui\'>'.$record_count3.'</dd></a></li>';

    mysqli_close( $Connadmin ); //关闭数据库 
    return $listdata;
}
?>
