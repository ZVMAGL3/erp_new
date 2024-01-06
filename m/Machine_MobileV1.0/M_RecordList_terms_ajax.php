<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once '../../inc/B_conn.php'; //连上用户数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_RecordList_terms_Set.php'; //连上参数设定


if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata( $id ); //标准条款清单
}

//[ok]=========================================================================【标准条款 输出数据】
function listdata( $id ) {
    global $Connadmin,$Conn, $hy, $nowkeyword, $huis, $textsname, $phpstart, $tablename, $colsname;

    //echo "<br><br><br><br>".$id ;
    $sql = $rs = $listdata = '';

    //---------------------------------------------------------------------得到大类菜单
    $sql = "select id,number,name From `msc_standard` where id='$id'  order by id Asc";
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    $name = $row[ 'name' ]; //标准名称
    $number = $row[ 'number' ]; //标准编号
    mysqli_free_result( $rs ); //释放内存

    //$listdata = '<li><a href="M_RecordList_terms_edit.php?id='.$id.'">' . $sys_konggei . $tiaok . '&nbsp;' . $name  . $nowhuishtml . '</a></li>';
    $listdata = '<li style="margin-top:12px;margin-bottom:8px;"><a href="#"><i class="fa fa-23-4"></i><strong>&nbsp;&nbsp;' . $number . '&nbsp;' . $name . '</strong><dd class="hui"> &nbsp;</dd></a></li>';

    $sql = $rs = '';
    //---------------------------------------------------------------------
    if ( $nowkeyword . '1' != '1' ) { //不为空时
        $sql = "select id,$colsname,sys_adddate From `$tablename` where sys_huis='$huis' and $colsname like '%$nowkeyword%' and sys_id_standard='$id' order by sys_paixu Asc";
    } else {
        $sql = "select id,$colsname,sys_adddate From `$tablename` where sys_huis='$huis'  and sys_id_standard='$id' order by sys_paixu Asc";
    }

    //echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 

    $i = 0;
    if ( $record_count == 0 ) {
        $listdata .= '<li><a href="#"><font color="red"> Sorry, No Data！</font></a></li>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $i++;
            $sys_konggei = '';
            $id2 = $row[ 'id' ]; //id
            $sys_GuoChengMingChen = $row[ $colsname ]; //过程名称
            //$sys_bh = $row[ 'sys_bh' ]; //编号
            $adddate = $row[ 'sys_adddate' ]; //时间
            //------------------------------------------条款符号
            $sys_GuoChengMingChen_size = substr_count( $sys_GuoChengMingChen, '.' ); //得到条款的符号数
            if($i<10){
                $ii='0'.$i;
                     }else{
                $ii=$i;
            }
            //-------------------------------------------------------------------------------------统计下属分类数量
            $sql2 = "select * From `sys_jlmb`  where Id_MenuBigClass = '$id2' and  sys_huis='$huis' order by id Desc";
            //echo $sql.'_'; 
            $rs2 = mysqli_query( $Conn, $sql2 );
            $record_count2 = mysqli_num_rows( $rs2 ); //统计总记录数
            mysqli_free_result( $rs2 ); //释放内存

            if ( $huis == 1 ) {
                $edithref = "#";
                $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id2','$tablename','$huis','$phpstart','$id')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
            } else {
                $edithref = $phpstart . "_show.php?parent_id=$id&id=" . $id2;
                //$sys_bh = $record_count2;
                $nowhuishtml = "<dd class='hui'>[{$record_count2}]</dd>";
            }
            
            $listdata .= '<li><a href="' . $edithref . '"><label><input type="checkbox" class="idd" name="ID" value="' . $id2 . '" onchange="checkedGroup_mobile(this)"><font color="#CCC">'.$ii.'</font>&nbsp;&nbsp;' . $sys_GuoChengMingChen . '</label>' . $nowhuishtml . '</a></li>';
        }
        //-------------------------------------------------------------------------------------统计总记录数量
        $sql2 = "select * From `sys_jlmb`  where sys_huis='$huis' order by id Desc";
        //echo $sql.'_'; 
        $rs2 = mysqli_query( $Conn, $sql2 );
        $record_count3 = mysqli_num_rows( $rs2 ); //统计总记录数
        mysqli_free_result( $rs2 ); //释放内存
        $listdata .= '<li><a><dd class="hui">记录总数：' . $record_count3 . '</dd></a></li>';
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 

    return $listdata;
}
?>
