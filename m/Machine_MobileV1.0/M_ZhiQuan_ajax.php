<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once '../../inc/B_Config.php';
include_once '../../inc/Function_All.php';
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_ZhiQuan_Set.php'; //连上参数设定

if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata();
}
//[ok]=========================================================================【输出数据】


function listdata() {
    global $Connadmin, $SYS_QuanXian_list, $topBumenIdxList;
    $SYS_QuanXian_str = implode(',',$SYS_QuanXian_list);
    $topBumenIdxStr = implode(',',$topBumenIdxList);
    $listdata = '';
    // echo $SYS_QuanXian_str;
    $sql = "
        SELECT id,bumen
        FROM msc_zhiwei
        WHERE bumen in($topBumenIdxStr)
            and FuZeRen = 1
            and id in($SYS_QuanXian_str)
    ";
    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数

    if ( $record_count == 0 ) {
        $listdata .= '<li><a href="#"><font color="red"> Sorry, No Data!</font></a></li>';
    } else {
        $bumenList = array();
        $topidx = array();
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $bumenList []= $row['bumen'];
            $topidx []= $row['id'];
        }
        $i = 0;
        $listdata = '';
        $bumenStr = implode(',',$bumenList);
        $zhiweiList = array();
        returnListData($bumenStr,$i,$listdata,0,'id',$zhiweiList);
        $_SESSION[ 'modRoles' ] = array_values(array_diff($zhiweiList, $topidx)); // 得到可以修改权限的对象
        $last_zhiwei = array_diff($SYS_QuanXian_list, $zhiweiList);
        if($last_zhiwei){
            $last_zhiwei_str = implode(',',$last_zhiwei);
            $sql2 = "
                SELECT id,bumen
                FROM msc_zhiwei
                WHERE id in($last_zhiwei_str)
            ";
            // echo $sql2;
            $rs2 = mysqli_query( $Connadmin, $sql2 );
            $bumenList = array();
            while ( $row = mysqli_fetch_array( $rs2 ) ) {
                if(!in_array($row['bumen'],$bumenList)){
                    $bumenList []= $row['bumen'];
                }
                $topidx []= $row['id'];
            }
            mysqli_free_result( $rs2 ); //释放内存
            $_SESSION[ 'topZhiWeiIdxList' ] = $topidx;
            $bumenStr = implode(',',$bumenList);
            last_returnListData($bumenStr,$i,$listdata,0,$last_zhiwei_str);
        }else{
            $_SESSION[ 'topZhiWeiIdxList' ] = $topidx;
        }
        mysqli_close( $Connadmin ); //关闭数据库 

        if ( $i == 0 ) {
            $listdata .= '<li><a href="#"><font color="red"> Sorry, No Data!</font></a></li>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    return $listdata;
}
//[ok]=========================================================================【得到部门】

function returnListData($id,&$i,&$listdata,$j,$str,&$zhiweiList) {
    global $Connadmin, $hy, $huis, $tablename, $nowkeyword, $colsname;
    $sql = "SELECT id,bumenname,sys_adddate From msc_bumenlist where sys_yfzuid = '$hy' and $str in($id) order by id Asc";
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

        $listdata2 = '<li><a style="padding-left:' . $number . 'px;background:#FFF no-repeat right center;">'. $text .'<label><input type="checkbox" class="idd" name="ID" value="' . $id . '"><i class=\'fa fa-13-3\'></i>&nbsp;&nbsp;' . $name . '</label></a></li>';

        $sql2 = "select id,zu,bumen From `$tablename` where sys_huis='$huis' and $colsname like '%$nowkeyword%' and bumen = $id order by FuZeRen DESC";
        $rs2 = mysqli_query( $Connadmin, $sql2 );
        
        $z=0;
        while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
            $z++;
            $id2 = $row2[ 'id' ]; //id
            $zhiweiList []= $id2;
            // if(!in_array($id2, $topidx)){
            $name2 = $row2['zu'];
            $edithref = "M_powers.php?id=$id2";
            // $listdata2 .= '<li><a href="' . $edithref . '"><font color="#CCC"></font>&nbsp;&nbsp;' . $name2 . '</a></li>';
            $listdata2 .= '<li><a href="' . $edithref . '" style="padding-left:' . $number2 . 'px">|<label><input type="checkbox" class="idd" name="ID" value="' . $id2 . '" onchange="checkedGroup_mobile(this)">&nbsp;<i class="fa fa-peple"></i>&nbsp;&nbsp;'.$name2.'</label></a></li>';
            // }
        }
        
        mysqli_free_result( $rs2 ); //释放内存

        if($z){
            $listdata .= $listdata2;
        }

        returnListData($id,$i,$listdata,$j+1,'parent',$zhiweiList);
    }
    
    mysqli_free_result( $rs ); //释放内存
    return $listdata;
}
function last_returnListData($id,&$i,&$listdata,$j,$last_zhiwei_str) {
    global $Connadmin, $hy, $huis, $tablename, $nowkeyword, $colsname;
    $sql = "SELECT id,bumenname,sys_adddate From msc_bumenlist where sys_yfzuid = '$hy' and id in($id) order by id Asc";
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

        $listdata2 = '<li><a style="padding-left:' . $number . 'px;background:#FFF no-repeat right center;">'. $text .'<label><input type="checkbox" class="idd" name="ID" value="' . $id . '"><i class=\'fa fa-13-3\'></i>&nbsp;&nbsp;' . $name . '</label></a></li>';

        $sql2 = "select id,zu,bumen From `$tablename` where sys_huis='$huis' and $colsname like '%$nowkeyword%' and bumen = $id and id in('$last_zhiwei_str') order by bumen Asc";
        // echo $sql2;
        $rs2 = mysqli_query( $Connadmin, $sql2 );
        
        $z=0;
        while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
            $z++;
            $id2 = $row2[ 'id' ]; //id
            $zhiweiList []= $id2;
            // if(!in_array($id2, $topidx)){
            $name2 = $row2['zu'];
            $edithref = "M_powers.php?id=$id2";
            // $listdata2 .= '<li><a href="' . $edithref . '"><font color="#CCC"></font>&nbsp;&nbsp;' . $name2 . '</a></li>';
            $listdata2 .= '<li><a href="' . $edithref . '" style="padding-left:' . $number2 . 'px">|<label><input type="checkbox" class="idd" name="ID" value="' . $id2 . '" onchange="checkedGroup_mobile(this)">&nbsp;<i class="fa fa-peple"></i>&nbsp;&nbsp;'.$name2.'</label></a></li>';
            // }
        }
        
        mysqli_free_result( $rs2 ); //释放内存

        if($z){
            $listdata .= $listdata2;
        }

    }
    
    mysqli_free_result( $rs ); //释放内存
    return $listdata;
}

function listdata2( $bumen ) {
    global $Connadmin, $hy, $huis;
    $sql = $rs = $listdata2 = '';
    $sql = "select id,bumenname From `msc_bumenlist` where sys_yfzuid='$hy' and  id='$bumen' order by id Asc";
    //echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    $row = mysqli_fetch_array( $rs );
    //echo record_count.'_'; 
    if ( $record_count == 0 ) {
        $listdata2 = '-';
    } else {
        $bumenname = $row[ 'bumenname' ]; //字段名称
        $listdata2 = "<font color='#CCC'>-[{$bumenname}]</font>";
    }
    mysqli_free_result( $rs ); //释放内存
    return $listdata2;
}



?>
