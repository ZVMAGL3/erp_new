<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once '../../inc/B_conn.php'; //连上注册数据库
include_once '../../inc/B_Config.php'; //执行接收参数及配置
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_powers_terms_Set.php'; //连上参数设定

if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata( $id ); //标准条款清单
}

//[ok]=========================================================================【标准条款 输出数据】
function listdata( $id ) {
    global $Connadmin, $Conn,$huis, $tablename, $colsname, $modRoles, $parent_id;
    // echo json_encode($modRoles,JSON_UNESCAPED_UNICODE);
    $father_id = 0;
    if(in_array($parent_id,$modRoles)){
        $sql = "
            SELECT z2.id,z2.bumen
            FROM `msc_zhiwei` z1 
            JOIN `msc_zhiwei` z2 ON z1.bumen = z2.bumen 
            WHERE z1.id = '$parent_id' and z2.FuZeRen = 1
        ";
        // echo $sql;
        $rs = mysqli_query( $Connadmin, $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
        if($parent_id == $row[ 'id' ]){
            $bumen = $row[ 'bumen' ]; //标准名称
            $sql = "
                SELECT z.id
                FROM `msc_zhiwei` z
                JOIN `msc_bumenlist` b ON b.parent = z.bumen 
                WHERE z.FuZeRen = 1 and b.id = $bumen
            ";
            // echo $sql;
            $rs = mysqli_query( $Connadmin, $sql );
            $row = mysqli_fetch_array( $rs );
            mysqli_free_result( $rs ); //释放内存
        }
        $father_id = $row[ 'id' ]; //标准名称
        
    }else{
        // echo '不可修改';
    }
    // echo $parent_id.$father_id;
    //---------------------------------------------------------------------得到大类菜单
    $sql = $rs = $listdata = '';
    $sql = "select id,number,name From `msc_standard` where id='$id' order by id Asc";
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    $name = $row[ 'name' ]; //标准名称
    $number = $row[ 'number' ]; //标准编号
    mysqli_free_result( $rs ); //释放内存

    //$listdata = '<li><a href="M_RecordList_terms_edit.php?id='.$id.'">' . $sys_konggei . $tiaok . '&nbsp;' . $name  . $nowhuishtml . '</a></li>';
    $listdata = '<li style="margin-top:12px;margin-bottom:8px;"><a href="#"><i class="fa fa-23-4"></i><strong>&nbsp;&nbsp;' . $number . '&nbsp;' . $name . '</strong><dd class="hui"> &nbsp;</dd></a></li>';

    $sql = $rs = '';
    //---------------------------------------------------------------------
    //if ( $nowkeyword . '1' != '1' ) { //不为空时
    //$sql = "select id,$colsname,sys_adddate From `$tablename` where sys_huis='$huis' and $colsname like '%$nowkeyword%' and sys_id_standard='$id' order by sys_paixu Asc";
    //} else {
    $sql = "select id,$colsname,sys_adddate From `$tablename` where sys_huis='$huis'  and sys_id_standard='$id' order by $colsname,sys_paixu Asc";
    //}   msc_menubigclass

    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 

    $i = 0;$j = 0;
    if ( $record_count == 0 ) {
        $listdata .= '<li><a href="#"><font color="red"> Sorry, No Data!</font></a></li>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $i++;
            $id2 = $row[ 'id' ]; //id
            $sys_GuoChengMingChen = $row[ $colsname ]; //过程名称
            //$sys_bh = $row[ 'sys_bh' ]; //编号
            //------------------------------------------条款符号
            if ( $i < 10 ) {
                $ii = '0' . $i;
            } else {
                $ii = $i;
            }
            //-------------------------------------------------------------------------------------统计下属分类数量
            $sql2 = "select * From `sys_jlmb`  where Id_MenuBigClass = '$id2' and  sys_huis='$huis' order by id Desc";
            // echo $sql2.'_'; 
            $rs2 = mysqli_query( $Conn, $sql2 );
            $record_count2 = mysqli_num_rows( $rs2 ); //统计总记录数
            mysqli_free_result( $rs2 ); //释放内存


            $i = 0;
            $listdata3 = listdata_jlmb( $id2,$i,$father_id);
            $listdata2 = '<li><a><strong><font color="#CCC">' . $ii . '</font>&nbsp;&nbsp;' . $sys_GuoChengMingChen . '</strong>&nbsp;-&nbsp;[' . $i . ']' . '</a></li>';
            if($i){
                $j += $i;
                $listdata .= $listdata2;
                $listdata .= $listdata3;
            }
        }
        $listdata .= '<li><a><dd class="hui">记录总数：' . $j . '</dd></a></li>';
    }
    mysqli_free_result( $rs ); //释放内存
    return $listdata;
}
//[ok]=========================================================================【记录清单  输出数据】
function listdata_jlmb( $id,&$i,$father_id) {
    global $Conn, $nowkeyword, $huis, $parent_id;

    //echo "<br><br><br><br>".$id ;
    $sql = $rs = $listdata = '';
    $sql = $rs = '';
    //---------------------------------------------------------------------记录清单
    if ( $nowkeyword . '1' != '1' ) { //不为空时
        $sql = "select id,sys_card,sys_bh,banben,xiugaicishu,sys_adddate From `sys_jlmb` where sys_huis='$huis' and `sys_card` like '%$nowkeyword%' and Id_MenuBigClass='$id' order by sys_bh Asc";
    } else {
        $sql = "select id,sys_card,sys_bh,banben,xiugaicishu,sys_adddate From `sys_jlmb` where sys_huis='$huis'  and Id_MenuBigClass='$id' order by sys_bh Asc";
    }

    //echo $sql.'_'; 
    $rs = mysqli_query( $Conn, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 

    if ( $record_count == 0 ) {
        $listdata .= '<li><a href="#"><font color="red"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sorry, No Data！</font></a></li>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $id2 = $row[ 'id' ]; //id
            $name = $row[ 'sys_card' ]; //标准名称
            $sys_qx_count=0;
            $list_quanxian_tongji=list_quanxian_tongji( $id2,$parent_id,$sys_qx_count );//统计职权范围+权限
            $sys_qx_count2=0;
            if($father_id){
                list_quanxian_tongji( $id2,$father_id,$sys_qx_count2 );//统计职权范围+权限
            }//???
            if($sys_qx_count || $sys_qx_count2){
                $i++;
                $nowhuishtml = "<dd class='hui'>$list_quanxian_tongji</dd>";
                $listdata .= '<li onclick="quanxian_mobile(this,\'list\',' . $id2 . ',' . $parent_id . ')"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-25-1"></i>&nbsp;' . $name . '' . $nowhuishtml . '</a></li>';
            }
        }
    }
    mysqli_free_result( $rs ); //释放内存
    return $listdata;
}

function list_quanxian_tongji( $id,$zhiwei_id,&$sys_qx_count ) {
    global $Connadmin;
    //---------------------------------------------------------------------职位权限查询
    $sql = "select * From `msc_ZhiWei` where  id='$zhiwei_id' ";
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );

    $sys_q_fanwei = $row[ 'sys_q_fanwei' ]; //sys_q_fanwei 权限范围
    if ( getN( $sys_q_fanwei, $id . '_0', ',' ) >= 0 ) {
        $checkfanwei = "个人";
    } elseif ( getN( $sys_q_fanwei, $id . '_1', ',' ) >= 0 ) {
        $checkfanwei = "部门";
    } elseif ( getN( $sys_q_fanwei, $id . '_2', ',' ) >= 0 ) {
        $checkfanwei = "公司";
    } elseif ( getN( $sys_q_fanwei, $id . '_3', ',' ) >= 0 ) {
        $checkfanwei = "集团";
    }else{
        $checkfanwei = "未选";
    }
    $list_quanxian_tongji='['.$checkfanwei.']';
    $sys_q_tianj = $row[ 'sys_q_tianj' ]; //sys_q_tianj
    if ( getN( $sys_q_tianj, $id, ',' ) >= 0 ) {
        $sys_qx_count += 1;
    }

    $sys_q_shenghe = $row[ 'sys_q_shenghe' ]; //sys_q_shenghe
    if ( getN( $sys_q_shenghe, $id, ',' ) >= 0 ) {
        $sys_qx_count += 1;
    } 

    $sys_q_pizhun = $row[ 'sys_q_pizhun' ]; //sys_q_pizhun
    if ( getN( $sys_q_pizhun, $id, ',' ) >= 0 ) {
        $sys_qx_count += 1;
    } 

    $sys_q_cak = $row[ 'sys_q_cak' ]; //sys_q_cak
    if ( getN( $sys_q_cak, $id, ',' ) >= 0 ) {
        $sys_qx_count += 1;
    } 

    $sys_q_xiug = $row[ 'sys_q_xiug' ]; //sys_q_xiug
    if ( getN( $sys_q_xiug, $id, ',' ) >= 0 ) {
        $sys_qx_count += 1;
    }

    $sys_q_shanc = $row[ 'sys_q_shanc' ]; //sys_q_shanc
    if ( getN( $sys_q_shanc, $id, ',' ) >= 0 ) {
        $sys_qx_count += 1;
    } 

    $sys_q_huis = $row[ 'sys_q_huis' ]; //sys_q_huis
    if ( getN( $sys_q_huis, $id, ',' ) >= 0 ) {
        $sys_qx_count += 1;
    } 

    $sys_q_dayin = $row[ 'sys_q_dayin' ]; //sys_q_dayin
    if ( getN( $sys_q_dayin, $id, ',' ) >= 0 ) {
        $sys_qx_count += 1;
    } 

    $sys_q_xiaohui = $row[ 'sys_q_xiaohui' ]; //sys_q_xiaohui
    if ( getN( $sys_q_xiaohui, $id, ',' ) >= 0 ) {
        $sys_qx_count += 1;
    }

    $sys_q_zhixing = $row[ 'sys_q_zhixing' ]; //sys_q_zhixing
    if ( getN( $sys_q_zhixing, $id, ',' ) >= 0 ) {
        $sys_qx_count += 1;
    } 

    $sys_q_seid = $row[ 'sys_q_seid' ]; //sys_q_seid
    if ( getN( $sys_q_seid, $id, ',' ) >= 0 ) {
        $sys_qx_count += 1;
    } 
    $list_quanxian_tongji='['.$sys_qx_count.'/11]&nbsp;'.$list_quanxian_tongji;
    mysqli_free_result( $rs ); //释放内存
    return $list_quanxian_tongji;

}

// function listdata_jlmb_son( $id,&$i) {
//     global $Connadmin, $Conn, $hy, $nowkeyword, $huis, $textsname, $phpstart, $tablename, $colsname, $nowgsbh, $parent_id;

//     //echo "<br><br><br><br>".$id ;
//     $sql = $rs = $listdata = '';
//     $sql = $rs = '';
//     //---------------------------------------------------------------------记录清单
//     if ( $nowkeyword . '1' != '1' ) { //不为空时
//         $sql = "select id,sys_card,sys_bh,banben,xiugaicishu,sys_adddate From `sys_jlmb` where sys_huis='$huis' and `sys_card` like '%$nowkeyword%' and Id_MenuBigClass='$id' order by sys_bh Asc";
//     } else {
//         $sql = "select id,sys_card,sys_bh,banben,xiugaicishu,sys_adddate From `sys_jlmb` where sys_huis='$huis'  and Id_MenuBigClass='$id' order by sys_bh Asc";
//     }

//     //echo $sql.'_'; 
//     $rs = mysqli_query( $Conn, $sql );
//     $record_count = mysqli_num_rows( $rs ); //统计总记录数
//     //echo record_count.'_'; 

//     if ( $record_count == 0 ) {
//         $listdata .= '<li><a href="#"><font color="red"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sorry, No Data！</font></a></li>';
//     } else {
//         while ( $row = mysqli_fetch_array( $rs ) ) {
//             $id2 = $row[ 'id' ]; //id
//             $name = $row[ 'sys_card' ]; //标准名称
//             $sys_qx_count=0;
//             $list_quanxian_tongji=list_quanxian_tongji( $id2,$parent_id,$sys_qx_count );//统计职权范围+权限
//             if($sys_qx_count){
//                 $i++;
//                 $nowhuishtml = "<dd class='hui'>$list_quanxian_tongji</dd>";
//                 $listdata .= '<li onclick="quanxian_mobile(this,\'list\',' . $id2 . ',' . $parent_id . ')"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-25-1"></i>&nbsp;' . $name . '' . $nowhuishtml . '</a></li>';
//             }
//         }
//     }
//     mysqli_free_result( $rs ); //释放内存
//     return $listdata;
// }

// function list_quanxian_tongji_son( $id,$zhiwei_id,&$sys_qx_count ) {
//     global $Connadmin, $Conn, $hy,  $nowgsbh, $parent_id;
//     //---------------------------------------------------------------------职位权限查询
//     $sql = "select * From `msc_ZhiWei` where  id='$zhiwei_id' ";
//     $rs = mysqli_query( $Connadmin, $sql );
//     $row = mysqli_fetch_array( $rs );

//     $sys_q_fanwei = $row[ 'sys_q_fanwei' ]; //sys_q_fanwei 权限范围
//     if ( getN( $sys_q_fanwei, $id . '_0', ',' ) >= 0 ) {
//         $checkfanwei = "个人";
//     } elseif ( getN( $sys_q_fanwei, $id . '_1', ',' ) >= 0 ) {
//         $checkfanwei = "部门";
//     } elseif ( getN( $sys_q_fanwei, $id . '_2', ',' ) >= 0 ) {
//         $checkfanwei = "公司";
//     } elseif ( getN( $sys_q_fanwei, $id . '_3', ',' ) >= 0 ) {
//         $checkfanwei = "集团";
//     }else{
//         $checkfanwei = "未选";
//     }
//     $list_quanxian_tongji='['.$checkfanwei.']';
//     $sys_q_tianj = $row[ 'sys_q_tianj' ]; //sys_q_tianj
//     if ( getN( $sys_q_tianj, $id, ',' ) >= 0 ) {
//         $sys_qx_count += 1;
//     }

//     $sys_q_shenghe = $row[ 'sys_q_shenghe' ]; //sys_q_shenghe
//     if ( getN( $sys_q_shenghe, $id, ',' ) >= 0 ) {
//         $sys_qx_count += 1;
//     } 

//     $sys_q_pizhun = $row[ 'sys_q_pizhun' ]; //sys_q_pizhun
//     if ( getN( $sys_q_pizhun, $id, ',' ) >= 0 ) {
//         $sys_qx_count += 1;
//     } 

//     $sys_q_cak = $row[ 'sys_q_cak' ]; //sys_q_cak
//     if ( getN( $sys_q_cak, $id, ',' ) >= 0 ) {
//         $sys_qx_count += 1;
//     } 

//     $sys_q_xiug = $row[ 'sys_q_xiug' ]; //sys_q_xiug
//     if ( getN( $sys_q_xiug, $id, ',' ) >= 0 ) {
//         $sys_qx_count += 1;
//     }

//     $sys_q_shanc = $row[ 'sys_q_shanc' ]; //sys_q_shanc
//     if ( getN( $sys_q_shanc, $id, ',' ) >= 0 ) {
//         $sys_qx_count += 1;
//     } 

//     $sys_q_huis = $row[ 'sys_q_huis' ]; //sys_q_huis
//     if ( getN( $sys_q_huis, $id, ',' ) >= 0 ) {
//         $sys_qx_count += 1;
//     } 

//     $sys_q_dayin = $row[ 'sys_q_dayin' ]; //sys_q_dayin
//     if ( getN( $sys_q_dayin, $id, ',' ) >= 0 ) {
//         $sys_qx_count += 1;
//     } 

//     $sys_q_xiaohui = $row[ 'sys_q_xiaohui' ]; //sys_q_xiaohui
//     if ( getN( $sys_q_xiaohui, $id, ',' ) >= 0 ) {
//         $sys_qx_count += 1;
//     }

//     $sys_q_zhixing = $row[ 'sys_q_zhixing' ]; //sys_q_zhixing
//     if ( getN( $sys_q_zhixing, $id, ',' ) >= 0 ) {
//         $sys_qx_count += 1;
//     } 

//     $sys_q_seid = $row[ 'sys_q_seid' ]; //sys_q_seid
//     if ( getN( $sys_q_seid, $id, ',' ) >= 0 ) {
//         $sys_qx_count += 1;
//     } 
//     $list_quanxian_tongji='['.$sys_qx_count.'/11]&nbsp;'.$list_quanxian_tongji;
//     mysqli_free_result( $rs ); //释放内存
//     return $list_quanxian_tongji;

// }




mysqli_close( $Connadmin ); //关闭数据库 
mysqli_close( $Conn ); //关闭数据库 
?>
