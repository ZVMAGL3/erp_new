<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once '../../inc/B_conn.php'; //连上注册数据库
include_once '../../inc/Function_All.php'; //
include_once '../../inc/B_Config.php'; //执行接收参数及配置
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_RecordList_terms_show_Set.php'; //连上参数设定

if ( isset( $_REQUEST[ 'parent_id2' ] ) )$parent_id2 = $_REQUEST[ 'parent_id2' ]; //接收parent_id2
if ( $act == 'chanshu_pinyin_mobile' ) {
    echo chanshu_pinyin_mobile(); //查询表是否有重复值
}

//[ok]=========================================================================【查询表是否有重复值】
function chanshu_pinyin_mobile() {
    global $Connadmin, $Conn, $hy, $nowkeyword, $huis, $textsname, $phpstart, $tablename, $colsname, $nowgsbh, $parent_id, $id;
    if ( isset( $_REQUEST[ 'id' ] ) )$id = $_REQUEST[ 'id' ]; //接收id
    if ( isset( $_REQUEST[ 'tablename' ] ) )$tablename = $_REQUEST[ 'tablename' ]; //接收tablename
    if ( isset( $_REQUEST[ 'thisvalue' ] ) )$thisvalue = $_REQUEST[ 'thisvalue' ]; //thisvalue
    if ( isset( $_REQUEST[ 'thisvaluePY' ] ) )$thisvaluePY = $_REQUEST[ 'thisvaluePY' ]; //接收thisvaluePY
   
    //echo $id;
    if($id>0){
        $sql = "select id From `$tablename` where sys_keyword_en='$thisvaluePY' and sys_Id_MenuBigClass='$parent_id' and id<>'$id'  order by id Asc";
    }else{
        $sql = "select id From `$tablename` where sys_keyword_en='$thisvaluePY' and sys_Id_MenuBigClass='$parent_id'  order by id Asc";
    }
    
    //echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo $record_count;
    if ( $record_count == 0 ) { //没有查到时
        $Table_Name = $thisvaluePY;
    } else {
        $Table_Name = $thisvaluePY . GetRanNum(); //当新表也存在时加上随机码
    }

    return $Table_Name;
    //return '0';
}
mysqli_close( $Connadmin ); //关闭数据库 
mysqli_close( $Conn ); //关闭数据库 
?>
