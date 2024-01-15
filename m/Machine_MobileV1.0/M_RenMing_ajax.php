<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_RenMing_Set.php'; //连上参数设定
include_once '../../inc/B_Config.php';
include_once '../../inc/Function_All.php';

if ( isset( $_REQUEST[ 'zhiwei_id' ] ) )$zhiwei_id = $_REQUEST[ 'zhiwei_id' ]; //职位id
if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata();
} else if ( $act == 'list_renmen' ) { //显示任命人员清单
    echo list_renmen();
} else if ( $act == 'Tongji_renmen' ) { //统计任命人员及数量
    echo Tongji_renmen( $id );
} else if ( $act == 'Get_Renming' ) { //获得任命职位
    echo Get_Renming( $id );
} else if ( $act == 'Add_Renming' ) { //添加职位
    echo Add_Renming( $id );
} else if ( $act == 'Del_Renming' ) { //卸任职位
    echo Del_Renming( $id );
} else if ( $act == 'list_renmen_one' ) { //查询单个人员的对应职位
    echo list_renmen_one( $id );
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
        returnListData($bumenStr,$i,$listdata,0,'id',$zhiweiList,$topidx);

        mysqli_close( $Connadmin ); //关闭数据库 

        if ( $i == 0 ) {
            $listdata .= '<li><a href="#"><font color="red"> Sorry, No Data!</font></a></li>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    return $listdata;
}
//[ok]=========================================================================【得到部门】

function returnListData($id,&$i,&$listdata,$j,$str,&$zhiweiList,$topidx) {
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
            $id2 = $row2[ 'id' ]; //id
            if(!in_array($id2,$topidx)){
                $z++;
                $zhiweiList []= $id2;
                // if(!in_array($id2, $topidx)){
                $name2 = $row2['zu'];
                $edithref = "M_RenMing_edit.php?id=$id2";
                // $listdata2 .= '<li><a href="' . $edithref . '"><font color="#CCC"></font>&nbsp;&nbsp;' . $name2 . '</a></li>';
                $listdata2 .= '<li><a href="' . $edithref . '" style="padding-left:' . $number2 . 'px"><label><input type="checkbox" class="idd" name="ID" value="' . $id2 . '" onchange="checkedGroup_mobile(this)">&nbsp;<i class="fa fa-20-4"></i>&nbsp;&nbsp;'.$name2.'</label></a></li>';
                // }
            }
        }
        
        mysqli_free_result( $rs2 ); //释放内存

        if($z){
            $listdata .= $listdata2;
        }

        returnListData($id,$i,$listdata,$j+1,'parent',$zhiweiList,$topidx);
    }
    
    mysqli_free_result( $rs ); //释放内存
    return $listdata;
}
// function listdata() {
//     global $Connadmin, $hy, $nowkeyword, $huis, $tablename, $colsname, $textsname, $phpstart;

//     $sql2 = $rs2 = $listdata = '';
//     if ( $nowkeyword . '1' != '1' ) { //不为空时
//         $sql2 = "select id,$colsname,bumen From `$tablename` where sys_huis='$huis' and $colsname like '%$nowkeyword%' and sys_yfzuid='$hy' order by bumen Asc";
//     } else {
//         $sql2 = "select id,$colsname,bumen From `$tablename` where sys_huis='$huis' and sys_yfzuid='$hy'  order by bumen Asc";
//     }

//     // echo $sql2.'_'; 
//     $rs2 = mysqli_query( $Connadmin, $sql2 );
//     $record_count2 = mysqli_num_rows( $rs2 ); //统计总记录数
//     //echo record_count2.'_'; 
//     $i = 0;
//     if ( $record_count2 == 0 ) {
//         $listdata .= '<li><a href="#"><font color="red"> Sorry, No Data！</font></a></li>';
//     } else {
//         while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
//             $i++;
//             $id2 = $row2[ 'id' ]; //id
//             $bumen = $row2[ 'bumen' ]; //部门id
//             $name2 = $row2[ $colsname ]; //字段名称
//             //$adddate2 = $row2[ 'sys_adddate' ];   //时间
//             $bumen_name = listdata2( $bumen ); //得到部门名称
//             //-----------------------------------------------------------------------------------------根据部门查找到所属部门名称
//             //echo $bumen_name;
//             $zhiwei_user = RenYuan( $id2 ); //得到职位人员
//             if ( $huis == 1 ) {
//                 $edithref = "#";
//                 $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id2','$tablename','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
//                 //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
//             } else {
//                 $edithref = $phpstart . "_edit.php?id=" . $id2;
//                 $nowhuishtml = "<dd class='hui'> $zhiwei_user  </dd>";
//             }
//             $listdata .= '<li><a href="' . $edithref . '"><i class="fa fa-20-4"></i>&nbsp;&nbsp;' . $name2 . $bumen_name . $nowhuishtml . '</a></li>';
//         }
//     }
//     mysqli_free_result( $rs2 ); //释放内存
//     return $listdata;
//     mysqli_close( $Connadmin ); //关闭数据库 
// }

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

function RenYuan( $zhiweiid ) { //人员任命
    global $Connadmin, $hy, $huis;

    $sql = $rs = $RenYuan = '';
    $sql = "
        SELECT hy.*,msc_user_reg.SYS_UserName
        FROM msc_user_hy AS hy
        INNER JOIN msc_user_reg ON msc_user_reg.id = hy.user_id
        WHERE 
            hy.sys_yfzuid = '$hy' 
            and (
                zhiwei_id  like '%_{$zhiweiid}_%' 
                or zhiwei_id like '{$zhiweiid}_%' 
                or zhiwei_id like '%_{$zhiweiid}' 
                or zhiwei_id ='{$zhiweiid}' 
            )  
            and state = 1 
        ORDER BY id ASC
    ";
    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 
    $i = 0;
    if ( $record_count == 0 ) {
        $RenYuan = '<i class="fa fa-add"></i>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
            //$SYS_GongHao = $row[ 'SYS_GongHao' ]; //工号
            $SYS_QuanXian = $row[ 'zhiwei_id' ]; //权限
            //echo "<br><br><br><br>".$SYS_UserName.',';
            $SYS_QuanXian = str_ireplace( "_", ",", $SYS_QuanXian ); //替换"_"这",";
            $nowxiangtong = getN( $SYS_QuanXian, $zhiweiid );
            //echo "<br><br><br><br>".$nowxiangtong.',';
            if ( $nowxiangtong > -1) {
                $i++;
                if ( $i <= 3 ) {
                    $RenYuan .= '<font color="#CCC">[' . $SYS_UserName . ']&nbsp;</font>';
                }
            }
        }
    }
    if ( $i > 3 ) {
        $RenYuan = $RenYuan . '...';
    }
    $RenYuan .= "<font color='red'>($i)</font>";
    mysqli_free_result( $rs ); //释放内存
    return $RenYuan;
}
//[ok]=========================================================================【输出人员任命M_RenMing_edit.php】
function list_renmen() {
    global $Connadmin, $hy, $nowkeyword, $huis, $tablename, $colsname, $textsname, $phpstart, $id;

    $sql = $rs = $xianshi_ZD_num = $listdata = '';
    if ( $nowkeyword . '1' != '1' ) { //不为空时
        $sql = "select id,SYS_UserName,SYS_GongHao,SYS_XingBie,SYS_QuanXian From `msc_user_reg` where sys_huis='$huis' and sys_yfzuid='$hy' and (`SYS_UserName` like '%{$nowkeyword}%' or `SYS_GongHao` like '%{$nowkeyword}%')  and sys_web_shenpi='1' order by id Asc";
    } else {
        $sql = "
            SELECT hy.*,msc_user_reg.SYS_UserName,msc_user_reg.SYS_XingBie
            FROM msc_user_hy AS hy
            INNER JOIN msc_user_reg ON msc_user_reg.id = hy.user_id
            WHERE 
                hy.sys_yfzuid = '$hy' 
                AND state = 1 
            ORDER BY id ASC
        ";
    }
    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 

    $i = 0;
    if ( $record_count == 0 ) {
        $listdata .= '<li><a href="#">sorry,<font color="#CCC"> . 没有数据，请添加</font></a></li>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $i++;
            $id3 = $row[ 'user_id' ]; //id
            $SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
            $SYS_GongHao = $row[ 'SYS_GongHao' ]; //工号
            $SYS_XingBie = $row[ 'SYS_XingBie' ]; //性别
            $SYS_QuanXian = $row[ 'zhiwei_id' ]; //职位
            $SYS_QuanXian = str_ireplace( "_", ",", $SYS_QuanXian ); //替换"_"这",";
            //echo $SYS_QuanXian;
            $nowxiangtong = getN( $SYS_QuanXian, $id );

            //-----------------------------------------------------------------优先当前职位红色 显示 排前
            $listdata2 = '';
            if ( $nowxiangtong > -1 ) {
                $sql2 = "select zu From `msc_zhiwei` where  id ='$id' ";
                //echo $sql2.'_'; 
                $rs2 = mysqli_query( $Connadmin, $sql2 );
                $row2 = mysqli_fetch_array( $rs2 );
                $zhiwei = $row2[ 'zu' ]; //职位
                $listdata2 = '<font color="red">[' . $zhiwei . ']</font>';
                mysqli_free_result( $rs2 ); //释放内存
            }
            //echo "<Br><Br><br>".$id;
            //-----------------------------------------------------------------其次职位
            $fh = ",";
            $Arr_ziduan = explode( $fh, $SYS_QuanXian );
            sort( $Arr_ziduan );
            $countArry3 = count( $Arr_ziduan );
            for ( $i3 = 0; $i3 < $countArry3; $i3++ ) {
                if ( $id <> $Arr_ziduan[ $i3 ] ) {
                    $sql3 = "select zu From `msc_zhiwei` where  id ='{$Arr_ziduan[ $i3 ]}' ";
                    //echo $sql2.'_'; 
                    $rs3 = mysqli_query( $Connadmin, $sql3 );
                    $row3 = mysqli_fetch_array( $rs3 );
                    $zhiwei = $row3[ 'zu' ]; //职位
                    $listdata2 .= '<font color="#000">[' . $zhiwei . ']</font>';
                    mysqli_free_result( $rs3 ); //释放内存
                }
            }

            //-----------------------------------------------------------------男女图标
            if ( $SYS_XingBie == '男' ) {
                $tubiao_img = '&nbsp;<i class="fa  fa-15-3"></i>'; //男图标
            } else {
                $tubiao_img = '&nbsp;<i class="fa  fa-15-4"></i>'; //女图标
            }
            //-----------------------------------------------------------------数据显示
            if ( $huis == 1 ) {
                $edithref = "#";
                $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id3','msc_user_reg','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
            } else {
                $edithref = $phpstart . "_edit.php?id=" . $id3;
                $nowhuishtml = "<dd class='hui'>$listdata2 </dd>"; //职位
            }
            $listdata .= '<li onclick="Get_Renming(\'Get_Renming\', this, 0, \'' . $phpstart . '\',' . $id3 . ',' . $id . ')"><a><label>' . $tubiao_img . '&nbsp;&nbsp;' . $SYS_UserName . '<font color="#999"> -' . $SYS_GongHao . '</font></label>' . $nowhuishtml . '</a></li>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    return $listdata;
}
//[ok]=========================================================================【输出单个人员对应的职位清单】
function list_renmen_one() {
    global $Connadmin, $hy, $id, $zhiwei_id;
    $sql = $rs = '';
    $sql = "select zhiwei_id From `msc_user_hy` where sys_yfzuid = '$hy' and state='1' and user_id = $id";
    //echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    $SYS_QuanXian = $row[ 'zhiwei_id' ]; //权限
    
    $SYS_QuanXian = str_ireplace( "_", ",", $SYS_QuanXian ); //替换"_"这",";
    //echo $SYS_QuanXian;
    //echo $zhiwei_id;
    $nowxiangtong = getN( $SYS_QuanXian, $zhiwei_id );
    //-----------------------------------------------------------------优先当前职位红色 显示 排前
    $listdata2 = '';
    if ( $nowxiangtong > -1 ) {
        $sql2 = "select zu From `msc_zhiwei` where  id ='$zhiwei_id' ";
        //echo $sql2.'_'; 
        $rs2 = mysqli_query( $Connadmin, $sql2 );
        $row2 = mysqli_fetch_array( $rs2 );
        $zhiwei = $row2[ 'zu' ]; //职位
        if ( $zhiwei . '1' != '1' ) {
            $listdata2 = '<font color="red">[' . $zhiwei . ']</font>';
        }
        mysqli_free_result( $rs2 ); //释放内存
    }
    //echo "<Br><Br><br>".$id;
    //-----------------------------------------------------------------其次职位
    $fh = ",";
    $Arr_ziduan = explode( $fh, $SYS_QuanXian );
    sort( $Arr_ziduan );
    $countArry3 = count( $Arr_ziduan );
    for ( $i3 = 0; $i3 < $countArry3; $i3++ ) {
        if ( $zhiwei_id <> $Arr_ziduan[ $i3 ] ) {
            $sql3 = "select zu From `msc_zhiwei` where  id ='{$Arr_ziduan[ $i3 ]}' ";
            //echo $sql3.'_'; 
            $rs3 = mysqli_query( $Connadmin, $sql3 );
            $row3 = mysqli_fetch_array( $rs3 );
            $zhiwei = $row3[ 'zu' ]; //职位
            if ( $zhiwei . '1' != '1' ) {
                $listdata2 .= '<font color="#000">[' . $zhiwei . ']</font>';
            }
            mysqli_free_result( $rs3 ); //释放内存
        }
    }
    //echo $SYS_QuanXian_YY;
    if ( $nowxiangtong > -1 ) {
        $listdata2 .= "<script type='text/JavaScript'>$('.addparent').hide(0);$('.Del_Renming').show(0);</script>";
    } else {
        $listdata2 .= "<script type='text/JavaScript'>$('.addparent').hide(0);$('.Add_Renming').show(0);</script>";
    }
    
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    return $listdata2;
}
//[ok]=========================================================================【统计人员任命】
function Tongji_renmen( $id ) {
    global $Connadmin, $hy, $huis;
    $sql = $rs = $Tongji_renmen = '';
    //echo $id;
    $sql = "
        select reg.SYS_UserName,hy.zhiwei_id 
        From msc_user_hy AS hy
        JOIN msc_user_reg AS reg ON reg.id = hy.user_id
        where hy.sys_yfzuid='$hy' 
            and (
                SYS_QuanXian  like '%_" . $id . "_%' 
                or SYS_QuanXian like '" . $id . "_%' 
                or SYS_QuanXian like '%_" . $id . "' 
                or SYS_QuanXian ='" . $id . "' 
            ) 
            and sys_web_shenpi=1 
        order by hy.user_id Asc
    ";
    // echo $sql; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo $record_count; 
    $i = 0;
    if ( $record_count == 0 ) {
        $Tongji_renmen = "<ul class='top'>   任命人员:</ul><ul class='left'>   为零！</ul><ul class='right'>0</ul>";
    } else {
        $Tongji_renmen2 = '';
        while ( $row = mysqli_fetch_array( $rs ) ) {

            $SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
            $SYS_QuanXian = $row[ 'zhiwei_id' ]; //权限
            $SYS_QuanXian = str_ireplace( "_", ",", $SYS_QuanXian ); //替换"_"这",";
            //echo $SYS_QuanXian;
            $nowxiangtong = getN( $SYS_QuanXian, $id ); //是否有权限包含
            if ( $nowxiangtong > -1 ) {
                $i++;
                $Tongji_renmen2 .= "[{$SYS_UserName}]&nbsp;";
            }

        }
        $Tongji_renmen = "<ul class='top'>    任命人员:</ul><ul class='left'>{$Tongji_renmen2}</ul><ul class='right'>{$i}</ul>";
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    return $Tongji_renmen;
}
//[ok]=========================================================================【得到任命人员职位清单】
function Get_Renming( $id ) {
    global $Connadmin, $hy, $nowkeyword, $huis, $tablename, $colsname, $textsname, $phpstart, $zhiwei_id;
    $Get_Renming2 = '';
    //echo $zhiwei_id;
    //-----------------------------------------------------------------职位名称查询
    $sql = "select zu From `msc_zhiwei` where  id ='$zhiwei_id' ";
    //echo $sql2.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    //$zhiwei_id = $row[ 'id' ]; //职位id
    $zhiwei = $row[ 'zu' ]; //职位
    //$listdata = '<font color="#000">' . $zhiwei . '</font>';
    mysqli_free_result( $rs ); //释放内存
    //-----------------------------------------------------------------人员对应职权查询
    $sql = $rs = $Get_Renming = '';
    $sql = "select zhiwei_id From `msc_user_hy` where user_id = $id and sys_yfzuid = $hy";
    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    $SYS_QuanXian = $row[ 'zhiwei_id' ]; //权限
    // echo $SYS_QuanXian;
    $SYS_QuanXian = str_ireplace( "_", ",", $SYS_QuanXian ); //替换"_"这",";
    $nowxiangtong = getN( $SYS_QuanXian, $zhiwei_id );

    $Get_Renming2 .= "<dd class='addparent Add_Renming' onclick=Add_Renming('Add_Renming',this,'{$phpstart}','{$id}','{$zhiwei_id}') ><i class='fa fa-add'></i>聘任“{$zhiwei}”</dd>"; //添加职位

    $Get_Renming2 .= "<dd class='addparent Del_Renming' onclick=Del_Renming('Del_Renming',this,'{$phpstart}','{$id}','{$zhiwei_id}') ><i class='fa fa-del'></i>卸任“{$zhiwei}”</dd>"; //添加职位

    $Get_Renming .= "<div class='Get_Renming'> {$Get_Renming2} </div>";

    if ( $nowxiangtong > -1 ) {
        $Get_Renming .= "<script type='text/JavaScript'>$('.addparent').hide(0);$('.Del_Renming').show(300);</script>";
    } else {
        $Get_Renming .= "<script type='text/JavaScript'>$('.addparent').hide(0);$('.Add_Renming').show(300);</script>";
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    return $Get_Renming;

}

//[ok]=========================================================================【得到任命人员职位清单】
function Get_Renming22( $id ) {
    global $Connadmin, $hy, $nowkeyword, $huis, $tablename, $colsname, $textsname, $phpstart, $id, $zhiwei_id;

    //echo $zhiwei_id;
    //-----------------------------------------------------------------任命职位查询
    $sql2 = $rs2 = $listdata2 = '';
    $sql2 = "select id,zu From `msc_zhiwei` where  id ='$zhiwei_id' ";
    //echo $sql2.'_'; 
    $rs2 = mysqli_query( $Connadmin, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
    //$zhiwei_id2 = $row2[ 'id' ]; //职位id
    $zhiwei2 = $row2[ 'zu' ]; //职位
    $listdata2 = '<font color="#000">' . $zhiwei2 . '</font>';
    mysqli_free_result( $rs2 ); //释放内存

    //-----------------------------------------------------------------人员对应职位查询
    $sql = $rs = $xianshi_ZD_num = $Get_Renming = '';
    $sql = "select id,SYS_UserName,SYS_GongHao,SYS_XingBie,SYS_QuanXian,sys_adddate From `msc_user_reg` where id={$id} order by id Asc";
    //echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 
    $i = 0;
    if ( $record_count == 0 ) {
        $Get_Renming .= "<div class='Get_Renming'>sorry,<font color='#CCC'> 没有任命！</font></div>";
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            //$i++;
            $id3 = $row[ 'id' ]; //id

            $SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
            $SYS_GongHao = $row[ 'SYS_GongHao' ]; //工号
            $SYS_XingBie = $row[ 'SYS_XingBie' ]; //性别
            $SYS_QuanXian = $row[ 'SYS_QuanXian' ]; //权限
            $SYS_QuanXian = str_ireplace( "_", ",", $SYS_QuanXian ); //替换"_"这",";
            echo $SYS_QuanXian;
            //-----------------------------------------------------------------职位查询
            $sql2 = $rs2 = $Get_Renming2 = '';
            $sql2 = "select id,zu From `msc_zhiwei` where sys_huis='0' and sys_yfzuid='$hy' and id in ('$SYS_QuanXian') order by id Asc";
            //echo $sql2.'_'; 
            $rs2 = mysqli_query( $Connadmin, $sql2 );
            $record_count2 = mysqli_num_rows( $rs2 ); //统计总记录数
            //echo record_count.'_'; 
            //$i2 = 0;
            $nowxiangtong = 0;
            if ( $record_count2 == 0 ) {
                $Get_Renming2 = '--';
            } else {
                while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                    //$i++;
                    $zhiwei_id = $row2[ 'id' ]; //职位id
                    if ( $id == $zhiwei_id ) {
                        $nowxiangtong = 1;
                    }
                    //$zhiwei = $row2[ 'zu' ]; //职位
                    //$Get_Renming2 .= "<dd class='delparent' dataid='{$zhiwei_id}'>{$zhiwei}</dd>";
                }
            }
            mysqli_free_result( $rs2 ); //释放内存
            $adddate = $row[ 'sys_adddate' ]; //时间
            //$nowhuishtml = "$Get_Renming2 "; //职位
            //echo $nowxiangtong;
            if ( $nowxiangtong == 1 ) {
                $Get_Renming2 .= "<dd class='addparent' onclick=Del_Renming('Del_Renming',this,'{$phpstart}','{$id3}','{$zhiwei_id}') ><i class='fa fa-del'></i>卸任“{$listdata2}”职务</dd>"; //添加职位
            } else {
                $Get_Renming2 .= "<dd class='addparent' onclick=Add_Renming('Add_Renming',this,'{$phpstart}','{$id3}','{$zhiwei_id}') ><i class='fa fa-add'></i>聘任为“{$listdata2}”</dd>"; //添加职位
            }

            $Get_Renming .= "<div class='Get_Renming'> {$Get_Renming2} </div>";
        }
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    return $Get_Renming;

}

//[ok]=========================================================================【增加任命人员职位】
function Add_Renming( $id ) {
    global $db,$Connadmin, $hy, $zhiwei_id,$user_id;

    //-----------------------------------------------------------------人员对应职位查询
    $sql = $rs = $Get_Renming = '';
    $sql = "SELECT zhiwei_id From `msc_user_hy` WHERE user_id = $id and sys_yfzuid = $hy order by id Asc";
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    $SYS_QuanXian = $row[ 'zhiwei_id' ]; //权限
    mysqli_free_result( $rs ); //释放内存

    $str = $SYS_QuanXian . '_' . $zhiwei_id;
    $New_SYS_QuanXian = move_arrynull( QuChong( $str, "_" ), "_" ); //删除指定值为空的值
    $New_SYS_QuanXian = Str_paixu( $New_SYS_QuanXian, "_" ); //排序字符串
    //----------------------------------------------------------------更新数据
    $sql = "UPDATE  `msc_user_hy`  set `zhiwei_id` = '$New_SYS_QuanXian' WHERE user_id = $id and sys_yfzuid = $hy ";
    // echo $sql;
    mysqli_query( $Connadmin, $sql );
    mysqli_close( $Connadmin ); //关闭数据库
    
    selectQuanXian($hy,$user_id,$db);

    return $Get_Renming;
}

//[ok]=========================================================================【删除任命人员职位】
function Del_Renming( $id ) {
    global $db,$Connadmin, $hy, $zhiwei_id,$user_id;

    //-----------------------------------------------------------------人员对应职位查询
    $sql = $rs = $Get_Renming = '';
    $sql = "SELECT zhiwei_id From `msc_user_hy` WHERE user_id = $id and sys_yfzuid = $hy order by id Asc";
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    $SYS_QuanXian = $row[ 'zhiwei_id' ]; //权限
    mysqli_free_result( $rs ); //释放内存

    $New_SYS_QuanXian = movetext( $SYS_QuanXian, $zhiwei_id, "_" ); //删除指定值
    $New_SYS_QuanXian = Str_paixu( $New_SYS_QuanXian, "_" ); //排序字符串

    //----------------------------------------------------------------更新数据
    $sql = "UPDATE  `msc_user_hy`  set `zhiwei_id` = '$New_SYS_QuanXian' WHERE user_id = $id and sys_yfzuid = $hy ";
    // echo $sql;
    mysqli_query( $Connadmin, $sql );
    mysqli_close( $Connadmin ); //关闭数据库 

    selectQuanXian($hy,$user_id,$db);

    return $Get_Renming;
}
?>
