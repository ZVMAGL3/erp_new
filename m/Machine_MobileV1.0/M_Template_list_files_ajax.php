<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Template_list_files_Set.php'; //连上参数设定

if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata(); //标准清单
} 
//[ok]=========================================================================【标准分类 输出数据】
function listdata() {
    global $Connadmin, $hy, $nowkeyword, $huis, $tablename, $colsname, $textsname, $phpstart,$parent_id;
    //echo $parent_id;
    $sql = $rs = $xianshi_ZD_num = $listdata = '';
    if ( $nowkeyword . '1' != '1' ) { //不为空时
        $sql = "select id,size,$colsname,ext,sys_adddate From `$tablename` where sys_huis='$huis' and $colsname like '%$nowkeyword%' and sys_Id_MenuBigClass='$parent_id' order by id Asc";
    } else {
        $sql = "select id,size,$colsname,ext,sys_adddate From `$tablename` where sys_huis='$huis' and sys_Id_MenuBigClass='$parent_id'  order by id Asc";
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
            $id = $row[ 'id' ]; //id
            $name = $row[ $colsname ]; //标准名称
            $size = round($row[ 'size' ]/1024/1024,2); //尺寸
            $sys_zt = $row[ 'sys_zt' ]; //字头
            $ext = $row[ 'ext' ]; //格式
            if($ext==''){
                $ext='jpg';
            }
            //$adddate = $row[ 'sys_adddate' ]; //时间
            if ( $huis == 1 ) {
                $edithref = "#";
                $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id','$tablename','$huis','$phpstart','','$parent_id')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
            } else {
                $edithref = $phpstart . "_edit.php?parent_id=$parent_id&id=$id";
                $nowhuishtml = "<dd class='hui'>$size M</dd>";//$adddate
            }
            
            $listdata .= '<li><a href="' . $edithref . '"><label><input type="checkbox" class="idd" name="ID" value="' . $id . '" onchange="checkedGroup_mobile(this)"><img src="../../uploadhtml5e/images/'.$ext.'.png" height="38" width="38" style="margin-top:-3px;">&nbsp;&nbsp;</label><strong>' . $name . '</strong>' . $nowhuishtml . '</a></li>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    return $listdata;
}

?>
