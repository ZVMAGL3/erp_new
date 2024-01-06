<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Template_Set.php'; //连上参数设定

if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata(); //标准清单
}
//[ok]=========================================================================【标准分类 输出数据】
function listdata() {
    global $Connadmin, $hy, $nowkeyword, $huis, $tablename, $colsname, $textsname, $phpstart;
    
    $sql = $rs = $xianshi_ZD_num = $listdata = '';
    $sql_stand = "select id,number,name,sys_zt,sys_adddate From `msc_standard` where sys_huis='0'  order by id Asc";
    $rs_stand = mysqli_query( $Connadmin, $sql_stand );
    $record_count_stand = mysqli_num_rows( $rs_stand ); //统计总记录数
    while ( $row_stand = mysqli_fetch_array( $rs_stand ) ) {

        $id_stand = $row_stand[ 'id' ]; //标准id
        $number_stand = $row_stand[ 'number' ]; //标准名称
        $name_stand = $row_stand[ 'name' ]; //标准名称
        $listdata .= '<tm class="headtitle"><i class="fa fa-11-4"></i>&nbsp;'.$number_stand.'&nbsp;'.$name_stand . '</tm>';


        
        if ( $nowkeyword . '1' != '1' ) { //不为空时
            $sql = "select id,sys_beizhu,$colsname,sys_hangye,sys_zt,sys_adddate From `$tablename` where sys_Id_MenuBigClass='$id_stand' and sys_huis='$huis' and $colsname like '%$nowkeyword%' order by id Asc";
        } else {
            $sql = "select id,sys_beizhu,$colsname,sys_hangye,sys_zt,sys_adddate From `$tablename` where sys_Id_MenuBigClass='$id_stand' and sys_huis='$huis'  order by id Asc";
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
                $sys_hangye = $row[ 'sys_hangye' ]; //标准编号
                $sys_beizhu = $row[ 'sys_beizhu' ]; //标准编号
                $sys_zt = $row[ 'sys_zt' ]; //字头
                //$adddate = $row[ 'sys_adddate' ]; //时间
                if ( $huis == 1 ) {
                    $edithref = "#";
                    $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id','$tablename','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                    //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
                } else {
                    $edithref = $phpstart . "_terms.php?id=" . $id;
                    $nowhuishtml = "<dd class='hui'>$sys_hangye</dd>"; //$adddate
                }
                $listdata .= '<li><a href="' . $edithref . '"><label>&nbsp;<input type="checkbox" class="idd" name="ID" value="' . $id . '" onchange="checkedGroup_mobile(this)">&nbsp;<i class="fa fa-21-1"></i>&nbsp;</label><strong>' . $name . '</strong>' . $nowhuishtml . '</a></li>';
            }
        }
        mysqli_free_result( $rs ); //释放内存
    }
    mysqli_free_result( $rs_stand ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    return $listdata;
}

?>
