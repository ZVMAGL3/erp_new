<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once '../../inc/B_conn.php'; //连上数据库
include_once '../../inc/B_Config.php'; //执行接收参数及配置
include_once '../../inc/Function_All.php';

include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_DataCheck_Set.php'; //连上参数设定

if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata(); //标准清单
}
//[ok]=========================================================================【标准分类 输出数据】
function listdata() {
    global $Connadmin, $hy, $nowkeyword, $huis, $tablename, $colsname, $textsname, $phpstart;

    $sql = $rs = $xianshi_ZD_num = $listdata = '';
    if ( $nowkeyword . '1' != '1' ) { //不为空时
        $sql = "select id,number,$colsname,sys_adddate From `$tablename` where sys_huis='$huis'  and sys_yfzuid='$hy' and $colsname like '%$nowkeyword%' order by id Asc";
    } else {
        $sql = "select id,number,$colsname,sys_adddate From `$tablename` where sys_huis='$huis'  and sys_yfzuid='$hy'  order by id Asc";
    }

    //echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 

    $i = 0;
    if ( $record_count == 0 ) {
        $listdata .= '<li><a><font color="red">Sorry, No Data！</font></a></li>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) { //标准
            $i++;
            $id = $row[ 'id' ]; //id
            $name = $row[ $colsname ]; //标准名称
            $number = $row[ 'number' ]; //标准编号
            //$adddate = $row[ 'sys_adddate' ]; //时间
            if ( $huis == 1 ) {
                $edithref = "#";
                $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id','$tablename','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
            } else {
                //$edithref = $phpstart . "_terms.php?id=" . $id;
                $nowhuishtml = "<dd class='hui'> &nbsp;</dd>"; //$adddate
            }
            $listdata .= '<li><a><i class="fa fa-23-4"></i>&nbsp;&nbsp;<strong>' . $number . '&nbsp;' . $name . '</strong>' . $nowhuishtml . '</a></li>';

            $listdata .= listdata2( $id );

        }
        $listdata .= '<li><a>&nbsp;&nbsp;<strong>》》未分配的表《《</strong></a></li>';
        $listdata .= Table_quchong();
    }
    mysqli_free_result( $rs ); //释放内存

    return $listdata;
}

function listdata2( $id ) {
    global $Connadmin, $hy, $nowkeyword, $huis, $tablename, $colsname, $textsname, $phpstart;
    //---------------------------------------这里进行管理过程
    if ( $nowkeyword . '1' != '1' ) { //不为空时
        $sql2 = "select id,sys_GuoChengMingChen,sys_adddate From `msc_menubigclass` where sys_huis='$huis' and sys_yfzuid='$hy' and sys_GuoChengMingChen like '%$nowkeyword%' and sys_id_standard='$id' order by id Asc";
    } else {
        $sql2 = "select id,sys_GuoChengMingChen,sys_adddate From `msc_menubigclass` where sys_huis='$huis' and sys_yfzuid='$hy' and sys_id_standard='$id'  order by id Asc";
    }

    //echo $sql.'_'; 
    $rs2 = mysqli_query( $Connadmin, $sql2 );
    $record_count2 = mysqli_num_rows( $rs2 ); //统计总记录数
    //echo record_count.'_'; 

    $i2 = 0;
    $listdata2 = '';
    if ( $record_count2 == 0 ) {
        $listdata2 .= '<li><a><font color="red"> &nbsp;&nbsp;&nbsp;Sorry, No Data！</font></a></li>';
    } else {
        while ( $row2 = mysqli_fetch_array( $rs2 ) ) { //标准
            $i2++;
            $id2 = $row2[ 'id' ]; //id
            $sys_GuoChengMingChen = $row2[ 'sys_GuoChengMingChen' ]; //标准名称

            //$adddate = $row[ 'sys_adddate' ]; //时间
            if ( $huis == 1 ) {
                $edithref = "#";
                //$nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id2','msc_menubigclass','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
            } else {
                //$edithref = $phpstart . "_terms.php?id=" . $id2;
                $nowhuishtml2 = "<dd class='hui'> &nbsp;</dd>"; //$adddate
            }
            if ( $i2 < 10 ) {
                $ii2 = '0' . $i2;
            } else {
                $ii2 = $i2;
            }
            $listdata2 .= '<li><a><strong>&nbsp;' . $sys_GuoChengMingChen . '</strong>' . $nowhuishtml2 . '</a></li>';
            $listdata2 .= listdata3( $id2 );
        }

    }
    mysqli_free_result( $rs2 ); //释放内存

    return $listdata2;
}

function listdata3( $id ) {
    global $Conn, $hy, $nowkeyword, $huis;
    //---------------------------------------这里进行管理过程
    if ( $nowkeyword . '1' != '1' ) { //不为空时
        $sql3 = "select id,sys_card,mdb_name_SYS,sys_adddate From `sys_jlmb` where sys_huis='$huis' and sys_yfzuid='$hy' and sys_card like '%$nowkeyword%' and Id_MenuBigClass='$id' order by id Asc";
    } else {
        $sql3 = "select id,sys_card,mdb_name_SYS,sys_adddate From `sys_jlmb` where sys_huis='$huis' and sys_yfzuid='$hy' and Id_MenuBigClass='$id'  order by id Asc";
    }

    //echo $sql3.'_'; 
    $rs3 = mysqli_query( $Conn, $sql3 );
    $record_count3 = mysqli_num_rows( $rs3 ); //统计总记录数
    //echo record_count.'_'; 

    $i3 = 0;
    $listdata3 = '';
    if ( $record_count3 == 0 ) {
        $listdata3 .= '<li><a><font color="red"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sorry, No Data！</font></a></li>';
    } else {
        while ( $row3 = mysqli_fetch_array( $rs3 ) ) { //标准
            $i3++;
            $id3 = $row3[ 'id' ]; //id
            $sys_card = $row3[ 'sys_card' ]; //标准名称
            $mdb_name_SYS = $row3[ 'mdb_name_SYS' ]; //标准名称

            //$adddate = $row[ 'sys_adddate' ]; //时间
            if ( $huis == 1 ) {
                $edithref = "#";
                //$nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id2','msc_menubigclass','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
            } else {
                //$edithref = $phpstart . "_terms.php?id=" . $id2;
                $nowhuishtml3 = "<dd class='hui'>&nbsp;</dd>"; //$adddate
            }
            if ( $i3 < 10 ) {
                $ii3 = '0' . $i3;
            } else {
                $ii3 = $i3;
            }
            $listdata3 .= '<li style="height:35px;line-height:35px;"><a><font color="#CCC">&nbsp;&nbsp;&nbsp;<i class=\'fa fa-25-1\'></i>&nbsp;' . $ii3 . '</font>&nbsp;' . $sys_card . '<font color="#CCC">.' . $mdb_name_SYS . '</font>' . $nowhuishtml3 . '</a></li>';

        }
    }
    mysqli_free_result( $rs3 ); //释放内存
    return $listdata3;
}



function Table_quchong() {

    global $Conn, $Connadmin, $hy, $nowgsbh, $const_jlbhzt; //得到全局变量

    $listdata4='';
    $sql = "select * From `sys_menubigclass` where sys_huis=0 and sys_yfzuid='$hy' order by sys_GuoChengMingChen asc";
    $rs = mysqli_query( $Conn, $sql );

    //$nowrscount = mysqli_num_rows( $rs ); //统计数量
    $i = 0;
    $mdb_name_SYS_arry = '';
    while ( $row = mysqli_fetch_array( $rs ) ) {
        $i++;
        $menuid = $row[ 'id' ];
        $id = $row[ 'id' ];
        $sql2 = "select * From `sys_jlmb` where Id_MenuBigClass='$id' and sys_huis=0 and sys_yfzuid='$hy' order by id asc";
        $rs2 = mysqli_query( $Conn, $sql2 );
        while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
            $mdb_name_SYS = $row2[ 'mdb_name_SYS' ];
            if ( $mdb_name_SYS . '1' != '1' ) {
                $mdb_name_SYS_arry .= $mdb_name_SYS . ',';
            }
        };

        mysqli_free_result( $rs2 ); //释放内存
    };
    mysqli_free_result( $rs ); //释放内存

    $sql = "show tables";
    $rs = mysqli_query( $Conn, $sql );
    $nowrecordcount = mysqli_num_rows( $rs ); //统计数量
    if ( $nowrecordcount <= 0 ) { //当没有数据时也要显示一行
        echo( "&nbsp;sorry,没有数据，请先添加/设置。" );
    } else {

        $ii = 0;
        //echo $mdb_name_SYS_arry;

        while ( $row = mysqli_fetch_array( $rs ) ) {
            $Table_Name = $row[ 0 ]; //得到表名
            if ( getN( $mdb_name_SYS_arry, $Table_Name ) == -1 ) {
                $ii++;
                if ( $ii < 10 ) {
                    $iii = '0' . $ii;
                }else{
                    $iii = $ii;
                }
                $listdata4 .= '<li><a>&nbsp;&nbsp;<font color="#CCC">' . $iii . '&nbsp;' . $Table_Name . '</font></a></li>';
            }
        }; //while end 
        return $listdata4;
    }; // if else end
    mysqli_free_result( $rs ); //释放内存

}; //function end


mysqli_close( $Connadmin ); //关闭数据库 
mysqli_close( $Conn ); //关闭数据库 
?>
