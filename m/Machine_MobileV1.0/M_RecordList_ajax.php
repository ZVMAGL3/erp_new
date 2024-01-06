<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once '../../inc/B_conn.php'; //连上数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_RecordList_Set.php'; //连上参数设定
include_once '../../inc/B_Config.php';
include_once '../../inc/Function_All.php';
if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata(); //标准清单
} 
//[ok]=========================================================================【标准分类 输出数据】
function listdata() {
    global $Connadmin,$Conn, $hy, $nowkeyword, $huis, $tablename, $colsname, $textsname, $phpstart;

    $sql = $rs = $xianshi_ZD_num = $listdata = '';
    if ( $nowkeyword . '1' != '1' ) { //不为空时
        $sql = "select id,number,$colsname,sys_adddate From `$tablename` where sys_huis='$huis' and $colsname like '%$nowkeyword%' order by id Asc";
    } else {
        $sql = "select id,number,$colsname,sys_adddate From `$tablename` where sys_huis='$huis'  order by id Asc";
    }

    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    // echo $record_count.'_'; 

    $i = 0;
    if ( $record_count == 0 ) {
        $listdata .= '<li><a href="#"><font color="red"> Sorry, No Data！</font></a></li>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            
            $i++;
            $id = $row[ 'id' ]; //id
            $name = $row[ $colsname ]; //标准名称
            $number = $row[ 'number' ]; //标准编号
            //$adddate = $row[ 'sys_adddate' ]; //时间
            //-------------------------------------------------------------------------------------统计总记录数量
            $sql2 = "select * From `msc_menubigclass`  where sys_huis='$huis' and sys_id_standard='$id' order by id Desc";
            // echo $sql2.'_'; 
            $rs2 = mysqli_query( $Connadmin, $sql2 );
            $nowid='';
            $record_count2 = mysqli_num_rows( $rs2 );
            while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                $ids = $row2[ 'id' ]; 
                // echo $ids.'_';
                $nowid.=$ids.',';
            }
            mysqli_free_result( $rs2 ); //释放内存
            $nowid=move_arrynull( $nowid );
            if($record_count2){
            //-------------------------------------------------------------------------------------统计总记录数量
                $sql3 = "select * From `sys_jlmb`  where sys_huis='$huis' and Id_MenuBigClass in($nowid);";
                // echo $sql3.'_'; 
                $rs3 = mysqli_query( $Conn, $sql3 );
                // echo mysqli_error($Conn);
                $record_count3 = mysqli_num_rows( $rs3 ); //统计总记录数
                mysqli_free_result( $rs3 ); //释放内存
                if ( $huis == 1 ) {
                    $edithref = "#";
                    $nowhuishtml = "<dd ><p onclick=DelToHuishou_mobile_one('dels_huis','$id','$tablename','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                    //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
                } else {
                    $edithref = $phpstart . "_terms.php?id=" . $id;
                    $nowhuishtml = "<dd  class='hui'>{$record_count3}</dd>";//$adddate
                }
                $listdata .= '<li><a href="' . $edithref . '"><label><input type="checkbox" class="idd" name="ID" value="' . $id . '" onchange="checkedGroup_mobile(this)"><i class="fa fa-23-4"></i>&nbsp;&nbsp;</label>' . $number . '&nbsp;' . $name . '' . $nowhuishtml . '</a></li>';
            }
        }
    }
    
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    mysqli_close( $Conn ); //关闭数据库 
    return $listdata;
}

?>
