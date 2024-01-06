<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Position_Set.php'; //连上参数设定

if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    $i = 0;
    $listdata = '';
    $bumenStr = implode(',',$topBumenIdxList);
    // echo $bumenStr;  
    listdata($bumenStr,$i,$listdata,0,'id');
    mysqli_close( $Connadmin ); //关闭数据库 
    if ( $i == 0 ) {
        $listdata .= '<li><a href="#"><font color="red"> Sorry, No Data!</font></a></li>';
    }
    echo $listdata;
}
//[ok]=========================================================================【输出数据】


function listdata($id,&$i,&$listdata,$j,$str) {
    global $Connadmin, $hy, $huis, $tablename, $nowkeyword, $colsname, $phpstart;

    $sql = "SELECT id,bumenname,sys_adddate From msc_bumenlist where sys_yfzuid = '$hy' and $str in($id) order by id Asc";
    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );

    while ( $row = mysqli_fetch_array( $rs ) ) {
        $i++;
        $id = $row[ 'id' ]; //id
        $name = $row[ 'bumenname' ]; //字段名称
        $text = '';
        if($j){
            $text = '↳';
        }
        $number = 15+15*($j);
        $number2 = 17+15*($j+1);

        $listdata2 = '<li><a style="padding-left:' . $number . 'px">'. $text .'<label><input type="checkbox" class="idd" name="ID" value="' . $id . '"><i class=\'fa fa-13-3\'></i>&nbsp;&nbsp;' . $name . '</label></a></li>';

        $sql2 = "select id,$colsname,bumen From `$tablename` where sys_huis='$huis' and $colsname like '%$nowkeyword%' and bumen = $id order by bumen Asc";
        $rs2 = mysqli_query( $Connadmin, $sql2 );
        
        $z=0;
        while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
            $z++;
            $id2 = $row2[ 'id' ]; //id
            $name2 = $row2[ $colsname ]; //字段名称

            $edithref = $phpstart . "_edit.php?id=" . $id2;
            
            $listdata2 .= '<li><a href="' . $edithref . '" style="padding-left:' . $number2 . 'px">|<label><input type="checkbox" class="idd" name="ID" value="' . $id2 . '" onchange="checkedGroup_mobile(this)">&nbsp;<i class="fa fa-peple"></i>&nbsp;&nbsp;' . $name2 . '</label></a></li>';
        }
        
        mysqli_free_result( $rs2 ); //释放内存

        if($z){
            $listdata .= $listdata2;
        }

        listdata($id,$i,$listdata,$j+1,'parent');
    }
    
    mysqli_free_result( $rs ); //释放内存
    return $listdata;
}

function listdata2( $bumen ) {
    global $Connadmin, $hy, $huis;

    $sql = $rs = $listdata2 = '';
    $sql = "select id,bumenname From `msc_bumenlist` where sys_huis='$huis' and sys_yfzuid='$hy' and id='$bumen' order by id Asc";
    //echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 
    $i = 0;
    if ( $record_count == 0 ) {
        $listdata2 = '--';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $i++;
            $bumenname = $row[ 'bumenname' ]; //字段名称
            $listdata2 = '<font color="#CCC">[' . $bumenname . ']&nbsp;</font>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    return $listdata2;
}
?>
