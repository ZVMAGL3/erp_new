<?php
include_once( '../../session.php' );          //接收session信息
include_once( 'M_quanxian.php' );             //接收职位权限信息
include_once '../../inc/B_connadmin.php';     //连上注册数据库
include_once 'M_Department_Set.php';          //连上参数设定

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
    global $Connadmin, $hy, $huis, $tablename, $colsname, $phpstart;

    $sql = "SELECT id,$colsname,sys_adddate From `$tablename` where sys_huis = '$huis' and sys_yfzuid = '$hy' and $str in($id) order by id Asc";
    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );

    while ( $row = mysqli_fetch_array( $rs ) ) {
        $i++;
        $id = $row[ 'id' ]; //id
        $name = $row[ $colsname ]; //字段名称
        $adddate = $row[ 'sys_adddate' ]; //时间
        if ( $huis == 1 ) {
            $edithref = "#";
            $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id','$tablename','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
            //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
        } else {
            $edithref = $phpstart . "_edit.php?id=" . $id;
            $nowhuishtml = "<dd class='hui'>$adddate </dd>";
        }
        $text = '';
        $number = 0;
        if($j){
            $text = str_repeat(' ', $j*4) . '↳ ';
            $number = 15+15*($j-1);
        }
        $listdata .= '<li><a href="' . $edithref . '" style="padding-left:' . $number . 'px">'. $text .'<label><input type="checkbox" class="idd" name="ID" value="' . $id . '" onchange="checkedGroup_mobile(this)"><i class=\'fa fa-13-3\'></i>&nbsp;&nbsp;' . $name . '</label>' . $nowhuishtml . '</a></li>';
        listdata($id,$i,$listdata,$j+1,'parent');
    }
    
    mysqli_free_result( $rs ); //释放内存
    return $listdata;
}


?>
