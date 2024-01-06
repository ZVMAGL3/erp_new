<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Standard_terms_Set.php'; //连上参数设定

if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata( $id ); //标准条款清单
}else if($act == 'leftNavigationBar'){
    echo leftNavigationBar( $id ); //标准条款清单
}

//[ok]=========================================================================【标准条款 输出数据】
function listdata( $id ) {
    global $Connadmin, $hy, $nowkeyword, $huis, $textsname, $phpstart, $tablename, $colsname;

    //echo "<br><br><br><br>".$id ;
    $sql = $rs = $listdata = '';

    //---------------------------------------------------------------------得到大类菜单
    $sql = "select id,number,name From `msc_standard` where id='$id'  order by id Asc";
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    $name = $row[ 'name' ]; //标准名称
    $number = $row[ 'number' ]; //标准编号

    mysqli_free_result( $rs ); //释放内存

    //$listdata = '<li><a href="M_Standard_terms_edit.php?id='.$id.'">' . $sys_konggei . $tiaok . '&nbsp;' . $name  . $nowhuishtml . '</a></li>';
    $listdata = '<li style="margin-top:12px;margin-bottom:8px;"><a href="M_Standard_edit.php?id=' . $id . '"><i class="fa fa-23-4"></i>&nbsp;&nbsp;' . $number . '&nbsp;' . $name . '<dd class="hui"> &nbsp;</dd></a></li>';

    $sql = $rs = '';
    //---------------------------------------------------------------------
    if ( $nowkeyword . '1' != '1' ) { //不为空时
        $sql = "select id,tiaok,$colsname,sys_bh,sys_adddate From `$tablename` where sys_huis='$huis' and $colsname like '%$nowkeyword%' and Id_MenuBigClass='$id' order by sys_bh Asc";
    } else {
        $sql = "select id,tiaok,$colsname,sys_bh,sys_adddate From `$tablename` where sys_huis='$huis'  and Id_MenuBigClass='$id' order by sys_bh Asc";
    }

    // echo $sql.'_'; 
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
            // echo $id2;
            $tiaok = $row[ 'tiaok' ]; //条款
            $sys_bh = $row[ 'sys_bh' ]; //编号
            $name = $row[ $colsname ]; //标准名称
            //------------------------------------------条款符号
            $tiaok_size = substr_count( $tiaok, '.' ); //得到条款的符号数
            $res = substr( $tiaok, 0, 1 ); //以零开头的

            if ( $res != 0 ) {
                for ( $i = 0; $i < $tiaok_size; $i++ ) {
                    $sys_konggei .= '&nbsp;&nbsp;&nbsp;&nbsp;'; //有几个符号就有几个空格
                }
            } else {
                $i = 0;
            }

            if ( $huis == 1 ) {
                $edithref = "#";
                $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id2','$tablename','$huis','$phpstart','$id')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
            } else {
                $edithref = $phpstart . "_edit.php?parent_id=$id&id=" . $id2;
                $sys_bh = '';
                $nowhuishtml = "<dd class='hui'>$sys_bh </dd>";
            }
            $listdata .= '<li class="fenji' . $i . '"><a href="' . $edithref . '"><label><input type="checkbox" class="idd" name="ID" value="' . $id2 . '" onchange="checkedGroup_mobile(this)">' . $sys_konggei . $tiaok . '&nbsp;' . $name . '</label>' . $nowhuishtml . '</a></li>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    return $listdata;
}
function leftNavigationBar($id) {
    global $Connadmin, $hy, $nowkeyword, $huis, $textsname, $phpstart, $tablename, $colsname;

    //echo "<br><br><br><br>".$id ;
    $sql = $rs = '';
    $obj = array();
    //---------------------------------------------------------------------得到大类菜单
    $sql = "select id,number,name From `msc_standard` where id='$id'  order by id Asc";
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    $obj['name'] = $row[ 'name' ]; //标准名称
    $obj['number'] = $row[ 'number' ]; //标准编号
    mysqli_free_result( $rs ); //释放内存

    $sql = "select id,tiaok,$colsname,sys_bh,sys_adddate From `$tablename` where sys_huis='$huis'  and Id_MenuBigClass='$id' order by sys_bh Asc";
    // echo $sql;
    $rs = mysqli_query( $Connadmin, $sql );
    $i=-1;
    $j=-1;
    while ( $row = mysqli_fetch_array( $rs ) ) {
        $id2 = $row[ 'id' ]; //id
        $tiaok = $row[ 'tiaok' ]; //条款
        $name = $row[ $colsname ]; //标准名称
        $tiaok_size = substr_count( $tiaok, '.' ); //得到条款的符号数
        $res = substr( $tiaok, 0, 1 ); //以零开头的

        $entry = array('name' => $name, 'number' => $tiaok, 'id' => $id2);
        if ( $res != 0 && $tiaok_size ) {
            if ( $tiaok_size-1 ) {
                $obj['data'][$i]['data'][$j]['data'][] = $entry;
            }else{
                $j++;
                $obj['data'][$i]['data'][] = $entry;
            }
        } else {
            $i++;
            $j=-1;
            $obj['data'][] = $entry;
        }
    }

    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    echo json_encode($obj, JSON_UNESCAPED_UNICODE);
}
?>
