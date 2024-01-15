<?php

//*************************本页为有返回值的函数*********************************//
//[ok]=========================================================================【依据数据表选择执行的数据库】
function IsConn( $Table_Name ) {
    $msc_table = substr( $Table_Name, 0, 4 ); //取表前四个字母 msc_
    if ( $msc_table == 'msc_' ) { //判断使用的如果是msc_开头的
        $Conns = 'Connadmin';
    } else {
        $Conns = "Conn";
    }
    return $Conns;
}
//[ok]=========================================================================【依据数据表选择执行的数据库】
function ChangeConn( $Table_Name ) {
    global $Conn, $Connadmin;
    $msc_table = substr( $Table_Name, 0, 4 ); //取表前四个字母 msc_

    if ( $msc_table == 'msc_' ) { //判断使用的如果是msc_开头的
        return $Connadmin;
    } else {
        return $Conn;
    }
}

function Changedb( $Table_Name ) {
    global $db, $db_vip;
    $msc_table = substr( $Table_Name, 0, 4 ); //取表前四个字母 msc_
    if ( $msc_table == 'msc_' ) { //判断使用的如果是msc_开头的
        return $db;
    } else {
        return $db_vip;
    }
}


//[ok]=========================================================================【查询msc_inputtype是否允许设置高度】
function zd_xianshi_height_is( $typeid ) {
    global $db;
    $sql = "select * From  `msc_inputtype` where id='$typeid' "; //查询到对应记录
    $rs = $db -> query($sql);
    $row = mysqli_fetch_array( $rs['result'] );
    $zd_xianshi_height = $row[ 'zd_xianshi_height' ]; //得到是否允许设置高度
    return $zd_xianshi_height;
}

//[ok]=========================================================================【查询字符串中的value】用于js赋值
function sqlarrvalue( $arr, $zdname, $typeid ) {
    //echo $arr;
    $sqlarrvalue = '';
    if ( $typeid == 27 ) {
        $fharry = explode( '"', $arr );
        $fhlenght = count( $fharry ); //得到字符串组数
        for ( $i = 0; $i < $fhlenght; $i++ ) {
            $mor = $i % 2; //余数为0时为偶数
            if ( $mor == 0 ) { //为奇时
                $ii = $i + 1;
                $arrprev = $fharry[ $i ]; //得到前面值； 用于查询是否包含些zdname
                $arr3 = $fharry[ $ii ];
                $arr3 = str_replace( '%', '', $arr3 );
                $arr3 = str_replace( ',', '', $arr3 );
                if ( strpos( $arrprev, $zdname ) !== false ) { //查询前面是否是针对该字段的
                    $sqlarrvalue .= $arr3 . ',';
                }

            } else {
                $sqlarrvalue = $sqlarrvalue;
            }
        };
        $sqlarrvalue = QuChong( $sqlarrvalue );
    } else {
        $startll = strpos( $arr, ' ' . $zdname . ' ' ); //查找到字符串中字段的开始位置
        if ( $startll == 0 ) {
            return "";
        }
        $arr = substr( $arr, $startll ); //除前面数据
        $firstfh = strpos( $arr, '"' ) + 1; //查找到字符串中首个包含符号的开始位置
        $arr2 = substr( $arr, $firstfh ); //除前面数据

        $endfh = strpos( $arr2, '"' ); //查找到字符串中第二个包含符号的开始位置
        $arr3 = substr( $arr2, 0, $endfh ); //除后面数据
        $sqlarrvalue = str_replace( '%', '', $arr3 );
    }

    return move_arrynull( $sqlarrvalue );
}
//[ok]=========================================================================【依据数据表查询显示列、锁定列数】
function SHOW_FULL_COLUMNS( $Table_Name, $beizhunum ) {
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    $sql = "SHOW FULL COLUMNS FROM `$Table_Name`";
    $rs = $connect -> query($sql);
    $i = 0;
    while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
        $zd_en_name = $row[ 'Field' ]; //字段
        $zdbeizhu = $row[ 'Comment' ]; //备注
        $NEW_zdbeizhu = colbeizhu( $zdbeizhu, $zd_en_name );
        //0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
        $zd_ok = textN( $NEW_zdbeizhu, $beizhunum, ',' ); //中文字段名找值0  1
        if ( $zd_ok == 1 and $zd_en_name != 'id' ) {
            $i++;
        }
    }
    return $i; //返回备注数值
}
//=========================================================================没有指令的返回命令
function NoZhiLing() {
    $NoZhiLing = "对不起，没有要执行的指令";
    return $NoZhiLing;
} //function end 

//[ok]=========================================================================生成随机数
function GetRanNum() { //如GetRanNum()，即输出200409071553464617，为2004年09月07日15时53分46秒4617随机数
    ini_set( 'date.timezone', 'PRC' ); //设定为北京时间
    $nowdate = date( 'YmdHis' ); //生成当时日期的数据串
    $suijinum = rand( 1, 10000 ); //生成4位数字随机数
    $GetRanNum = $nowdate . $suijinum;
    return $GetRanNum;
} //function end
//============================================================================$查询到分类的数组
function zu_all_list( $re_id ) {
    global $db_vip, $hy;
    $zu_all_list = '';
    $sql = 'select id,lname1 From Sys_ZuAll where sys_yfzuid=' . $hy . ' and tableid=' . $re_id . ' and sys_huis <> 1 order by lname1 Asc';
    $rs = $db_vip -> query($sql);
    //$recordcount=mysqli_num_rows($rs);//得到总数 无用
    while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
        $now_id = $row[ 'id' ];
        $now_lname1 = $row[ 'lname1' ];
        $zu_all_list .= $now_id . '=' . $now_lname1 . ',';
    };

    return $zu_all_list;
} //function end
//[ok]=========================================================================取出字符串中的数字
function findNum( $str = '' ) {
    return preg_replace( '/[^\.0123456789]/s', '', $str );
}
//[ok]=========================================================================判断为空时停正执行
function IsNullExit( $str ) {
    //echo $str;
    if ( $str == '' ) {
        die(); //停止程序运行，输出内容
    }; //这里验证为空时
} //function end
//[ok]=========================================================================取出字符类型中的数字
function ZDleixinToNum( $zdtype = '' ) {
    if ( $zdtype == 'longtext' )$zdtype = '10000'; //默认字段类型长度
    return findNum( $zdtype );
}
//[ok]=========================================================================算出字符的长度
function countstr( $str = '', $width = '5' ) {
    $strlen = strlen( $str ); //算出字符串长度
    if ( $width < $strlen ) {
        $str = substr( $str, 0, $width ) . '...';
    };
    return $str;
}
//[ok]=========================================================================没有访问权限
function NOQuanXian() {
    $str = "<ul><li class='w20'><i class='fa fa-nodata'></i></li><li class='w80'><font color='red'  style='cursor:hand;'>对不起，没有查看权限！</font></li></ul>";
    return $str;
}
//[ok]=========================================================================查询数据库所有表str arry
function Conn_Table_All() { //在
    $Table_Name = '';
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    $sql = "show tables";
    $rs = $connect -> query($sql);
    while ( $row = mysqli_fetch_array( $rs ) ) {
        $Table_Name .= ',' . $row[ 0 ]; //得到表名
    };
    return Trim( $Table_Name, "," );
};


//[ok]=========================================================================查看数据库表是否存在
function Conn_Table_In( $Table_Name, $Connnow = '' ) { //在

    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    //echo "tablename:$Table_Name";
    if ( $Connnow == '' )$Connnow = $connect;
    $Tablecol_list = '-1';
    if ( '1' . $Table_Name != '1' ) {
        $Conn_Table_All = Conn_Table_All( $connect ); //查询所有表
        //echo "Conn_Table_All:$Conn_Table_All";
        $Tablecol_list = getN( $Conn_Table_All, $Table_Name ); //查到是否有该 表
    };
    return $Tablecol_list;
} //function end
//[ok]=========================================================================根据字段类型算出长度
function zd_type_to_long( $str = '' ) {
    $str = strtolower( $str );
    if ( getN( 'datetime,date,time,year,timestamp', $str ) >= 0 ) { //当为时间格式时
        return 30;
    } elseif ( $str == 'tinytext' ) {
        return 255;
    } elseif ( $str == 'text' ) {
        return 65000;
    } else { //其它的直接获取里面的数字如int(10)->10
        return findNum( $str );
    };
}
//[ok]=========================================================================返回一个元素在数组中位置的函数function
function SYS_str( $str = 0 ) { //在$arrx中查找$y的位置getN($nsquanxian,$re_id)>-1
    global $xt_m_ziduan;
    $str = strtolower( $str );
    if ( strpos( $str, "sys_" ) === 0 or strpos( $str, "msc_" ) === 0 or getN( $xt_m_ziduan, $str ) >= 0 ) {
        $str = 1; //
    } else {
        $str = 0; //
    };
    return $str;
} //function end
//[ok]=========================================================================判断以sys_开头 0不是系统字段，1是系统字段
function SYS_is( $str, $startstr = 'sys_' ) {
    $str = strtolower( $str );
    if ( strpos( $str, $startstr ) === 0 or strpos( $str, "msc_" ) === 0 ) {
        $str = 1; //
    } else {
        $str = 0; //
    };
    return $str;
} //function end


//[ok]=========================================================================$得到两个数组的交集
function TWOarryy_find_chong( $A_ziduan, $arry2_ziduan ) { //1两数组有相同元素
    if ( '1' . $arry2_ziduan == '1' ) {
        $jiaoji = "";
    } else {
        $A_ziduan = explode( ',', $A_ziduan ); //转换为数组
        $arry2_ziduan = explode( ',', $arry2_ziduan );
        $jiaoji = array_intersect( $A_ziduan, $arry2_ziduan ); //查询两数组的交集
        $jiaoji = implode( ',', $jiaoji );
    };
    return $jiaoji; //统计数量
} //function end

//[ok]=========================================================================$A_ziduan数组和deltextarry数组是否有相同的元素,$A_ziduan循环
function HAS_arryy( $A_ziduan, $arry2_ziduan ) { //1两数组有相同元素
    $A_ziduan = explode( ',', $A_ziduan ); //转换为数组
    $arry2_ziduan = explode( ',', $arry2_ziduan );
    $jiaoji = array_intersect( $A_ziduan, $arry2_ziduan ); //查询两数组的交集
    return count( $jiaoji ); //统计数量
} //function end

//[ok]=========================================================================数组式字符串去重
function QuChong( $str , $fh = ',') {
    if (!$fh){
        $fh=",";
    }
    $QuChong = $i = $SpStr = '';
    $str = trim( $str, $fh ); //去除头尾的逗号
    if ( '1' . $str == '1' ) {
        return $QuChong;
    } else {
        $SpStr = explode( $fh, $str ); //转换为数组
        $SpStr = array_flip( $SpStr ); //去重数组
        $SpStr = array_keys( $SpStr ); //修复键值
        $QuChong = implode( $fh, $SpStr ); //数组转成字符串
    };
    return trim( $QuChong, $fh ); //去除头尾的逗号
} //function end

//[ok]=========================================================================【在一个数组中，去除另一数组的值】
function TwoArryQuChong( $strarry, $removearry, $fgf ) {
    if ( '1' . trim( $removearry ) == '1'
        or is_null( $removearry ) ) {
        $TwoArryQuChong = $strarry;
    } elseif ( '1' . trim( $strarry ) == '1'
        or is_null( $strarry ) ) {
        $TwoArryQuChong = '';
    } else {
        $TwoArryQuChong = '';
        $strarry = explode( $fgf, trim( $strarry, $fgf ) ); //字符串转数组
        $removearry = explode( $fgf, trim( $removearry, $fgf ) ); //字符串转数组
        $TwoArryQuChong = array_diff( $strarry, $removearry ); //数组的差集
        $TwoArryQuChong = implode( ',', $TwoArryQuChong ); //数组转成字符串 
    };
    return trim( $TwoArryQuChong, $fgf ); //去前后符号
} //function end

//=========================================================================【返回字符串数组元素个数】
function Uboundarryy( $x, $fh ) {
    $x = trim( $x, $fh );
    $arr = '';
    if ( '1' . $x == '1' ) {
        $Uboundarry = -1;
    };
    $arr = explode( $fh, $x );
    return count( $arr );
} //function end
//=========================================================================【返回一个元素在数组中位置】
function getN_FH( $arrx, $y, $fh ) { //在$arrx中查找$y的位置
    $getN_FH = '';
    if ( '1' . $arrx == '1' ) {
        $getN_FH = -1;
    } else {
        $Arr = explode( $fh, $arrx ); //生成数组
        $getN_FH = array_search( $y, $Arr ); //查找首次出现的键值
    };
    return $getN_FH;
} //function end
//=========================================================================【字符串数组去空】【字符串去首尾逗号】
function move_arrynull( $str, $fh = "," ) {
    $fharry = explode( $fh, $str );
    $strs = '';
    for ( $i = 0; $i < count( $fharry ); $i++ ) {
        $nowval = $fharry[ $i ];
        if ( $nowval == '' ) {
            $strs = $strs;
        } else {
            $strs = $strs . $fh . $nowval;
        };
    };
    return Trim( $strs, $fh );
} //function end
//=========================================================================【去中括符】
function move_zkh( $str = '', $fh = "'" ) {
    //$STR_zkh='';
    $fharry = explode( ',', $fh );
    //$continstr=count($fharry);
    foreach ( $fharry as $value ) {
        $str = str_replace( $value, '', $str );
    };
    //$str=str_replace(']','', $str);
    //$STR_zkh=trim($STR_zkh,',');
    return $str;
} //function end
//=========================================================================【没有符号加符号】
function ADD_zkh($str = '', $fh = "'") {
    $ADD_zkh = '';
    $strarray = explode(',', $str); // 使用正确的变量名 $strarray 替代 $strarry
    foreach ($strarray as $value) {
        $trimmedValue = trim($value);
        $firstChar = substr($trimmedValue, 0, 1);
        $lastChar = substr($trimmedValue, -1);

        if ($firstChar !== $fh) {
            $trimmedValue = $fh . $trimmedValue;
        }
        if ($lastChar !== $fh) {
            $trimmedValue .= $fh;
        }

        $ADD_zkh .= $trimmedValue . ',';
    }

    $ADD_zkh = trim($ADD_zkh, ',');
    return $ADD_zkh;
}

//=========================================================================【查找数组统计】
function continstr( $strarry, $fh ) {
    $strarry = trim( $strarry, $fh ); //去除前后的符号
    if ( '1' . $strarry == '1' ) {
        $continstr = 0;
    } else {
        $strarry = explode( $fh, $strarry );
        $continstr = count( $strarry );
    };
    return $continstr;
}; //function end
//=========================================================================【在X中查找Y位置的内容】
function textN( $x, $y = 0, $fgf = ',' ) {
    // echo $x.'_-_'.$y;
    $textN = $Marr = '';
    $x = trim( $x, $fgf );
    $y = intval( $y );
    if ( $x != ''
        and $y >= 0 ) {
        $Marr = explode( $fgf, $x );
        $textN = $Marr[ $y ];
    } else {
        $textN = '';
    };
    return $textN;
} //function end

//=========================================================================【依据表对系统字段进行重新命名设定】
function SysChangeName( $zd_cn_name, $databiao ) { //在X中查找Y位置的内容

    if ( $databiao == 'sys_yuangongdanganbiao' ) {
        if ( $zd_cn_name == '[系统]自动编号' ) {
            $zd_cn_name = '自动编号';
        } elseif ( $zd_cn_name == '权限' ) {
            $zd_cn_name = '职位';
        };
    };
    return $zd_cn_name;

} //function end
//=========================================================================【查询表中字段备注】
function findzdbeizhu( $Table_Name, $zdname ) {
    // echo 123;
    $nowtable = $Table_Name;
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    $sql = "select * from information_schema.columns where table_name = '{$nowtable}' and column_name = '{$zdname}' ";
    // echo $sql;
    $rs = $connect -> query($sql);
    $row = mysqli_fetch_array( $rs['result'] );
    $nowbeizu = $row[ 'COLUMN_COMMENT' ]; //查询到备注内容
    //echo $nowbeizu;
    $nowbeizu = colbeizhu( $nowbeizu, $zdname ); //格式化补齐
    return $nowbeizu;

} //function end
//=========================================================================【字段备注 格式化】
function colbeizhu( $zdbeizhu, $zd_en_name ) {
    //echo '22'.$zdbeizhu.'33';
    if ( $zdbeizhu . '1' == '1' ) {
        $zdbeizhu = $zd_en_name;
    }
    if ( $zdbeizhu == '-'
        or continstr( $zdbeizhu, ',' ) <= 14 ) {
        //$colbeizhu = $colname; //得到默认备注
        $colbeizhu = "$zdbeizhu,80,0,0,2,0,0,0,0,0,0,0,0,0,0";
        //得到默认值  0【备注】,1【显示宽】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
        //ziduan_edit_Modular($Table_Name,$zd_en_name,$zd_en_name,$colbeizhu,'','');//添加备注
    } else {
        $colbeizhu = $zdbeizhu;
    };

    if ( $zd_en_name == 'sys_id_zu' ) { //sys_id_zu默认值
        $colbeizhu = updateN( $colbeizhu, 4, 15, ',' ); //默认样式为下拉框
    }
    return $colbeizhu;

} //function end
//=========================================================================【字符串排序。】
function Str_paixu( $str, $fh ) {
    $Arr_ziduan = explode( $fh, $str );
    $Str_paixu = '';
    sort( $Arr_ziduan );
    $countArry = count( $Arr_ziduan );
    for ( $i = 0; $i < $countArry; $i++ ) {
        $Str_paixu .= $Arr_ziduan[ $i ] . $fh;
    };
    $Str_paixu = trim( $Str_paixu, $fh );
    return $Str_paixu;
}


//=========================================================================【返回另一数组中位置在当前数组中排序方案，并去除当前数组多余元素,返回相同数组，并按$A原先排序的排序。&&返回两数组相同处，并按$A原先排序排序。】

function PXN( $A, $A_text ) {
    $A = explode( ',', $A ); //转成数组
    $A_text = explode( ',', $A_text ); //转成数组
    $PXN = array_intersect( $A, $A_text ); //数组交集，并按$A排序
    $PXN = implode( ',', $PXN ); //数组转成字符串
    return trim( $PXN, ',' ); //去前逗号
} //function end

//=========================================================================【返回两数组不同处，并按$A原先排序排序。】
function PND( $A, $A_text ) {
    $A = explode( ',', $A ); //转成数组
    $A_text = explode( ',', $A_text ); //转成数组
    $PND = array_diff( $A, $A_text ); //数组差集，并按$A排序
    $PND = implode( ',', $PND ); //数组转成字符串
    return trim( $PND, ',' ); //去前逗号
} //function end


//=========================================================================在一维数组$A_ziduan中查找$delid的位置去除
function moveN( $A_ziduan, $delid ) { // echo moveN('gg,bb,aa,cc,ko',2)
    $moveN = '';
    $Arr_ziduan = explode( ',', $A_ziduan );
    //$A_ziduan='';
    for ( $i = 0; $i < count( $Arr_ziduan ); $i++ ) {
        if ( $i != $delid ) {
            $moveN = $moveN . ',' . $Arr_ziduan[ $i ];
        } else {
            $moveN = $moveN;
        };
    };
    $moveN = trim( $moveN, ',' );
    return $moveN;
} //function end

//=========================================================================在一维数组在_ziduan中查找$delid的值去除
function movetext( $A_ziduan, $deltext,$fh=',') { //echo movetext('gg,bb,aa,cc,ko','gg');

    $movetext = '';
    $Arr_ziduan = explode( $fh, $A_ziduan );
    $countArry = count( $Arr_ziduan );
    for ( $i = 0; $i < $countArry; $i++ ) {
        if ( $Arr_ziduan[ $i ] <> $deltext ) {
            $movetext .= $Arr_ziduan[ $i ] . $fh;
        } else {
            $movetext = $movetext;
        };
    };
    $movetext = trim( $movetext, $fh );
    return $movetext;
} //function end


//=========================================================================a_ziduan=a,b,c,d,e $nowkeyword关键词//多字段搜索数组函数//echo (searchzd($A_ziduan,$nowkeyword));searchzd(',fans,zu,kood,sdd,','123')
function searchzd( $A_ziduan, $nowkeyword ) {
    $searchzd = '';
    $A_ziduan = trim( $A_ziduan, ',' );
    $Arr_ziduan = explode( ',', $A_ziduan );
    $nowcount = count( $Arr_ziduan );
    $likewords = "'%" . $nowkeyword . "%'";
    for ( $i = 0; $i < $nowcount; $i++ ) {
        $nowziduan = 'CAST(' . $Arr_ziduan[ $i ] . ' AS CHAR)';
        $searchzd = $searchzd . ' or ' . $nowziduan . ' like ' . $likewords;
    };
    $searchzd = trim( $searchzd, ' or ' );
    $searchzd = ' and ' . '(' . $searchzd . ')';
    return $searchzd;
} //function end


//[ok]=========================================================================在二维数组Arrstr中查找$findtext的以$fh为二维数组的分隔符$A2Splitcol值查找值在二维数组位置
function Arr2getN_ID( $Arrstr, $findtext, $A2Splitcol, $fh = '_' ) { //Arr2getN_ID($Arrstr,"321",0,'_')//查找321_开头二维数据位置
    $Arr_ziduan = $Arr2 = '';
    $Arr2movetext = -1;
    $Arr_ziduan = explode( ',', $Arrstr );
    $countArry = count( $Arr_ziduan );

    for ( $i = 0; $i < $countArry; $i++ ) {
        $Arr2 = explode( $fh, $Arr_ziduan[ $i ] );
        if ( $Arr2[ $A2Splitcol ] == $findtext ) {
            $Arr2movetext = $i; //得到位置
        };
    };
    return $Arr2movetext;
} //function end

//[ok]=========================================================================在二维数组A_ziduan中查找$delid的值去除A2explode为二维数组的分隔符$A2explodecol查找值在二维数组位置
function Arr2movetext( $A_ziduan, $deltext, $A2Splitcol, $fh = '_' ) { //Arr2movetext($nowrsnovalue,$re_id,0,'_') 一维数据分隔符默认为“，”，二维数组为$fh自定义
    $Arr_ziduan = $A2_ziduan = $i = $Arr2movetext = $Arr2 = '';

    $Arr_ziduan = explode( ',', $A_ziduan );
    $countArry = count( $Arr_ziduan );
    for ( $i = 0; $i < $countArry; $i++ ) {
        $Arr2 = explode( $fh, $Arr_ziduan[ $i ] );
        if ( $Arr2[ $A2Splitcol ] != $deltext ) {
            $A2_ziduan = $A2_ziduan . ',' . $Arr_ziduan[ $i ];
        } else {
            $A2_ziduan = $A2_ziduan;
        };
    };
    $Arr2movetext = trim( $A2_ziduan, ',' );
    return $Arr2movetext;
} //function end


//ok=========================================================================在$A_ziduan中查找celid的位置添加
function addN( $A_ziduan, $celid, $celid_text ) {
    $addN = 0;
    $Arr_ziduan = explode( ',', $A_ziduan );
    $A_ziduan = '';
    $countArry = count( $Arr_ziduan );
    for ( $i = 0; $i < $countArry; $i++ ) {
        if ( $i == $celid ) {
            if ( $celid == 0 ) {
                $A_ziduan = $celid_text . ',' . $Arr_ziduan[ $i ];
            } else {
                $A_ziduan = $A_ziduan . ',' . $celid_text . ',' . $Arr_ziduan[ $i ];
            };
        } else {
            $A_ziduan = $A_ziduan . ',' . $Arr_ziduan[ $i ];
        };
    };
    $addN = trim( $A_ziduan, ',' );
    return $addN;
} //function end

//ok=========================================================================在A_ziduan重新拖动元素位置
function jharryy( $A_ziduan, $c_okxu, $b_okxu ) { //将$c_okxu内容拖到$b_okxu前面
    $jharry = '';
    $c_okxu = intval( $c_okxu );
    //$Arr_ziduan=explode(',',$A_ziduan);
    //$A_ziduan=''
    if ( $c_okxu <> $b_okxu ) {
        $c_oktxt = textN( $A_ziduan, $c_okxu, ',' ); //在A_ziduan中查找临时移除元素的内容
        $A_ziduan = moveN( $A_ziduan, $c_okxu ); //临时删除元素后数组
        if ( $c_okxu == 0 ) {
            $A_ziduan = addN( $A_ziduan, $b_okxu - 1, $c_oktxt );
        } elseif ( $b_okxu == 0 ) {
            $A_ziduan = $c_oktxt . ',' . $A_ziduan;
        } elseif ( $c_okxu > $b_okxu and $b_okxu <> -1 ) {
            $A_ziduan = addN( $A_ziduan, $b_okxu, $c_oktxt );
        } elseif ( $b_okxu == -1 ) {
            $A_ziduan = $A_ziduan . $c_oktxt . ',';
        } else {
            $A_ziduan = addN( $A_ziduan, $b_okxu - 1, $c_oktxt );
        };
    };
    $jharry = $A_ziduan;
    return $jharry;
} //function end

//ok=========================================================================在$A_ziduan中查找$upda的位置更新
function updateN( $A_ziduan, $upda, $upda_text, $fh ) { //updateN( $A_ziduan,12,0,',')
    if ( '1' . $fh == '1' ) {
        $fh = ',';
    };
    $updateN = '';
    $Arr_ziduan = explode( $fh, $A_ziduan );
    // echo json_encode($Arr_ziduan);
    $A_ziduan = '';
    $countArry = count( $Arr_ziduan );
    for ( $i = 0; $i < $countArry; $i++ ) {
        if ( $i == $upda ) {
            $upall = $upda_text;
        } else {
            $upall = $Arr_ziduan[ $i ];
        };
        $A_ziduan = $A_ziduan . $fh . $upall;
    };
    $updateN = trim( $A_ziduan, $fh );
    return $updateN;
} //function end

//ok=========================================================================在$A_ziduan中查找$upda值更新为$upda_text
function updateArryy( $A_ziduan, $upda, $upda_text ) { //$A_ziduan字符串,$upda更新前元素,$upda_text更新后元素
    $updateArry = '';
    $Arr_ziduan = explode( ',', $A_ziduan );
    $A_ziduan = '';
    $countArry = count( $Arr_ziduan );
    for ( $i = 0; $i < $countArry; $i++ ) {
        if ( $Arr_ziduan[ $i ] == $upda ) {
            $upall = $upda_text;
        } else {
            $upall = $Arr_ziduan[ $i ];
        };
        $A_ziduan = $A_ziduan . ',' . $upall;
    };
    $updateArry = trim( $A_ziduan, ',' );
    return $updateArry;
} //function end

//【ok】=========================================================================在两个数组保持相同位数元素。$arr1：长数组,arr2：短数组,txt：补位元素值,$fh分隔的符号。
function allwidtharr( $arr1, $arr2, $txt, $fh ) {
    $allwidtharr = $i = $J_ziduan = $Arr_arr1 = $Arr_arr2 = $ub_Arr_arr1 = $ub_Arr_arr2 = $c_o = '';
    $Arr_arr1 = explode( $fh, $arr1 );
    $Arr_arr2 = explode( $fh, $arr2 );
    $ub_Arr_arr1 = count( $Arr_arr1 );
    $ub_Arr_arr2 = count( $Arr_arr2 ); //数组元素个数
    $c_o = Abs( $ub_Arr_arr1 - $ub_Arr_arr2 ); //得到差值绝对值

    for ( $i = 0; $i < $c_o; $i++ ) {
        if ( '1' . $J_ziduan == '1' ) {
            $J_ziduan = $txt;
        } else {
            $J_ziduan = $J_ziduan . $fh . $txt;
        };
    };
    $allwidtharr = $arr2 . $J_ziduan;
    return $allwidtharr;
} //function end

//echo (xianshi_a)
//【ok】=========================================================================$A_ziduan数组中的元素在deltextarry中能查询到的元素便去除
function movetext2arryy( $A_ziduan, $deltextarry ) {
    $movetext2arry = '';
    $Arr_ziduan = explode( ',', $A_ziduan );
    $countArry = count( $Arr_ziduan );
    for ( $i = 0; $i < $countArry; $i++ ) {
        if ( getN( $deltextarry, $Arr_ziduan[ $i ] ) > -1 ) {
            $movetext2arry = $movetext2arry;
        } else {
            $movetext2arry = $movetext2arry . ',' . $Arr_ziduan[ $i ];
        };
    };
    $movetext2arry = trim( $movetext2arry, ',' );
    return $movetext2arry;
} //function end


//       ==========================================以下需查询数据库===============================================


//【ok】=========================================================================【返回表单类型元素,用于显示组件。这里用js代替处理】
function Get_out_InputTypes_cols( $typeid, $zd_name = '', $zd_id = '0', $sys_class = '', $sys_value = '', $sys_width = '100%', $sys_height = '', $re_id = '0', $msc_inputtype_colsname = 'Daima_xianshi', $nowaddbox = '', $checked = " checked='checked' ", $onchange = '', $nowtypeid = '' ) { //$nowtypeid为特别指定值样式
    global $ToHtmlID;
    //$typeid=14;
    if ( $typeid == ''
        or $typeid == '0' )$typeid = 1;
    $Get_out_InputTypes = '';
    if ( '1' . $sys_class == '1' ) {
        $sys_class == 'addboxinput inputfocus';
    }; //默认样式
    if ( $nowtypeid > 0 ) {
        $typeid = $nowtypeid;
    } else {
        $typeid = table_col_type_moren( $zd_name, $typeid );
    }

    //if($typeid<0) $typeid=0;
    //echo $typeid;
    if ( $zd_name == 'sys_login' ) {
        $readonly = ' readonly ';
    } else {
        $readonly = '';
    };
    switch ( intval( $typeid ) ) {
        case 1: // 单行文本
            $Get_out_InputTypes = "<input type='text' typeid='$typeid' name='$zd_name' id='$zd_id' class='$sys_class' value='$sys_value' $onchange $readonly />";
            //return Get_out_InputTypes;
            break;
        case 2: // 多行文本框
            if ( $sys_height == '' || $sys_height <= 0 || !$sys_height ) {
                $sys_height = 25;
            }
            $Get_out_InputTypes = "<textarea type='textarea' typeid='$typeid' name='$zd_name' id='$zd_id' class='$sys_class' " . $sys_height . "px;' $onchange $readonly >$sys_value</textarea>";
            //return Get_out_InputTypes;
            break;
        case 3: // 先生/女士
            $gou_checked = $gou_checked2 = '';
            if ( $sys_value == '先生' ) {
                $gou_checked = " checked='checked' ";
            } else {
                $gou_checked2 = " checked='checked' ";
            }
            if ( $gou_checked == '' && $gou_checked2 == '' ) {
                $gou_checked = " checked='checked' ";
            }
            $Get_out_InputTypes = "<label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_0' value='先生'  class='$sys_class' $gou_checked $onchange $readonly />先生&nbsp;&nbsp;&nbsp;</label><label><input name='$zd_name' type='radio' id='" . $zd_id . "_1' class='$sys_class' value='女士' $gou_checked2 $onchange  $readonly />女士</label><script>Inputdate('$zd_name','3','$sys_value','$ToHtmlID','$nowaddbox');</script>";
            break;
        case 4: // 复选框
            $Get_out_InputTypes = "<input type='text' typeid='$typeid' name='$zd_name' id='$zd_id' class='$sys_class' value='$sys_value' $onchange $readonly />";
            break;
        case 5: // 下拉框
            $Get_out_InputTypes = "<input type='text' typeid='$typeid' name='$zd_name' id='$zd_id' class='$sys_class'  value='$sys_value' $onchange $readonly />";
            break;
        case 6: // 图像上传
            $Get_out_InputTypes = "
                <input type='text' typeid='$typeid' name='$zd_name' id='$zd_id".'_$ToHtmlID'."' tidno='$re_id" . '_' . $zd_name . '_' . '$strmk_id\'' . " class='$sys_class $zd_id' value='' style='display:none;width:$sys_width' $onchange $readonly />
                <div id='$zd_name".'_$ToHtmlID'."\".\"_panel_1' style='height:auto; width:auto; float:left; overflow:hidden;'>
                    <div id='$zd_name".'_$ToHtmlID'."\".\"_weizhi_1' style=' text-align:center; background-color:#FFF; height:76px; width:76px; color:#333; line-height:66px; text-align:center;border:1px solid #CCC;font-size:65px;margin:2px;float:left;'>
                        +
                    </div>
                </div>
                <script>
                    createupload_jiaohu({'inputid':'$zd_name','ToHtmlID':'".'$ToHtmlID'."'});
                </script>
            ";
            break;
        case 7: // 文件上传
            $Get_out_InputTypes = "<input type='text' typeid='$typeid' name='$zd_name' id='$zd_id' class='$sys_class' value='$sys_value' $onchange $readonly />";
            break;
        case 8: // 日期框
            $Get_out_InputTypes = "<input type='text' typeid='$typeid' name='$zd_name' id='$zd_id' class='$sys_class' value='$sys_value' $onchange $readonly /><a class='jia jiaok'  onclick=''><i class='fa fa-24-03'></i></a><script>laydate.render({  elem: '#$zd_id',theme: '#393D49',lang: 'cn'});</script>";
            break;
        case 9: // 时间框
            $Get_out_InputTypes = "<input type='text' typeid='$typeid' name='$zd_name' id='$zd_id' class='$sys_class' value='$sys_value'  $onchange $readonly /><a class='jia jiaok'  onclick=''><i class='fa fa-25-03'></i></a><script>laydate.render({  elem: '#$zd_id',theme: '#393D49',type: 'datetime',lang: 'cn'});</script>";
            break;
        case 10: // 密码框
            $Get_out_InputTypes = "<input title='如需修改密码时填写' typeid='9' type='text' name='$zd_name' id='$zd_id' class='$sys_class' value='' $onchange $readonly />";
            break;
        case 11: // 男/女
            $gou_checked = $gou_checked2 = '';
            if ( $sys_value == '男' ) {
                $gou_checked = " checked='checked' ";
            } else {
                $gou_checked2 = " checked='checked' ";
            }
            if ( $gou_checked == '' && $gou_checked2 == '' ) {
                $gou_checked = " checked='checked' ";
            }
            $Get_out_InputTypes = "<label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_0' value='男' class='$sys_class' $gou_checked $checked $onchange $readonly />男&nbsp;&nbsp;&nbsp;</label><label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_1' class='$sys_class' value='女' $gou_checked2 $onchange $readonly />女</label><script>Inputdate('$zd_name','11','$sys_value','$ToHtmlID','$nowaddbox');</script>";
            break;
        case 12: // 递增自动编号
            $Get_out_InputTypes = "<input title='递增编号' typeid='11' type='text' name='$zd_name' id='$zd_id' class='$sys_class' value='' $onchange $readonly />";
            break;
        case 13: // 开启/关闭
            $gou_checked = $gou_checked2 = '';
            if ( $sys_value == '1' ) {
                $gou_checked = " checked='checked' ";
            } else {
                $gou_checked2 = " checked='checked' ";
            }
            if ( $gou_checked == '' && $gou_checked2 == '' ) {
                $gou_checked2 = " checked='checked' ";
            }
            $Get_out_InputTypes = "<label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_0' value='1' class='$sys_class' $gou_checked $onchange $readonly />开启&nbsp;&nbsp;&nbsp;</label><label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_1' class='$sys_class' value='0'  $gou_checked2 $onchange $readonly />关闭</label><script>Inputdate('$zd_name','13','$sys_value','$ToHtmlID','$nowaddbox');</script>";
            break;
        case 14: // 删除到回收站
            $gou_checked = $gou_checked2 = '';
            if ( $sys_value == '0' ) {
                $gou_checked = " checked='checked' ";
            } else {
                $gou_checked2 = " checked='checked' ";
            }

            $Get_out_InputTypes = "<label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_0' value='0' class='$sys_class' $gou_checked $onchange $readonly />正常显示&nbsp;&nbsp;&nbsp;</label><label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_1' class='$sys_class' value='1'  $gou_checked2 $onchange $readonly />删除到回收站</label><script>Inputdate('$zd_name','14','$sys_value','$ToHtmlID','$nowaddbox');</script>";
            break;
        case 15: // 分类框
            $Get_out_InputTypes = Html_input( 'sys_zuall', 'id', 'lname1', $sys_value, 'CheckBox', 'sys_id_zu', $re_id, '', $nowaddbox, $typeid );
            break;
        case 16: // 在离职框
            $gou_checked = $gou_checked2 = '';
            if ( $sys_value == '在职' ) {
                $gou_checked = " checked='checked' ";
            } else {
                $gou_checked2 = " checked='checked' ";
            }
            if ( $gou_checked == '' && $gou_checked2 == '' ) {
                $gou_checked2 = " checked='checked' ";
            }
            $Get_out_InputTypes = "<label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_0' value='在职' class='$sys_class' $gou_checked $onchange $readonly />在职&nbsp;&nbsp;&nbsp;</label><label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_1' class='$sys_class' value='离职' $gou_checked2 $onchange $readonly />离职</label><script>Inputdate('$zd_name','16','$sys_value','$ToHtmlID','$nowaddbox');</script>";
            break;
        case 17: // 是否框
            $gou_checked = $gou_checked2 = '';
            if ( $sys_value == '是' ) {
                $gou_checked = " checked='checked' ";
            } else {
                $gou_checked2 = " checked='checked' ";
            }
            if ( $gou_checked == '' && $gou_checked2 == '' ) {
                $gou_checked2 = " checked='checked' ";
            }
            $Get_out_InputTypes = "<label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_0' value='是' class='$sys_class' $gou_checked $onchange $readonly />是&nbsp;&nbsp;&nbsp;</label><label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_1' class='$sys_class' value=''  $gou_checked2 $onchange $readonly />否</label><script>Inputdate('$zd_name','17','$sys_value','$ToHtmlID','$nowaddbox');</script>";
            break;
        case 18: // ✓ ×
            $gou_checked = $gou_checked2 = '';
            if ( $sys_value == '✓' ) {
                $gou_checked = " checked='checked' ";
            } else {
                $gou_checked2 = " checked='checked' ";
            }
            if ( $gou_checked == '' && $gou_checked2 == '' ) {
                $gou_checked2 = " checked='checked' ";
            }
            $Get_out_InputTypes = "<label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_0' value='✓' class='$sys_class' $gou_checked $onchange $readonly />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_1' class='$sys_class' value='×'  $gou_checked2 $onchange $readonly />× </label><script>Inputdate('$zd_name','18','$sys_value','$ToHtmlID','$nowaddbox');</script>";
            break;
        case 19: // ✓
            $gou_checked = $gou_checked2 = '';
            if ( $sys_value == '✓' ) {
                $gou_checked = " checked='checked' ";
            } else {
                $gou_checked2 = " checked='checked' ";
            }
            if ( $gou_checked == '' && $gou_checked2 == '' ) {
                $gou_checked2 = " checked='checked' ";
            }
            $Get_out_InputTypes = "<label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_0' value='✓' class='$sys_class' $gou_checked $onchange $readonly />✓ &nbsp;&nbsp;&nbsp;</label><label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_1' class='$sys_class' value='' $gou_checked2 $onchange $readonly />空 </label><script>Inputdate('$zd_name','19','$sys_value','$ToHtmlID','$nowaddbox');</script>";
            break;
        case 20: // 审核框
            $Get_out_InputTypes = "<input type='text' typeid='$typeid' name='$zd_name' id='$zd_id' class='$sys_class'  placeholder='请审核'  y-value='$sys_value'  value='$sys_value'  onclick='SignSH(this)' $onchange   readonly='readonly' /><a class='jia jiaok'  onclick='SignSH(this)'><i class='fa fa-20-3'></i></a>";
            break;
        case 21: // 签名框
            $Get_out_InputTypes = "<input type='text' typeid='$typeid' name='$zd_name' id='$zd_id' class='$sys_class' placeholder='请签名'  y-value='$sys_value'  value='$sys_value'  onclick='sign(this)' $onchange   readonly='readonly' /><a class='jia jiaok'  onclick='sign(this)'><i class='fa fa-23-3'></i></a>";
            break;
        case 22: // 批准框
            $Get_out_InputTypes = "<input type='text' typeid='$typeid' name='$zd_name' id='$zd_id' class='$sys_class' placeholder='请批准'  y-value='$sys_value'  value='$sys_value'  onclick='SignPZ(this)' $onchange   readonly='readonly' /><a class='jia jiaok'  onclick='SignPZ(this)'><i class='fa fa-20-4'></i></a>";
            break;
        case 23:
        case 24:
        case 25: // 23姓名框  24为职务框  25日期时间框
            $Get_out_InputTypes = "<input type='text' typeid='$typeid' name='$zd_name' id='$zd_id' class='$sys_class'   value='$sys_value' $onchange   readonly='readonly' />";
            break;
        case 26: // 已婚 未婚
            $gou_checked = $gou_checked2 = '';
            if ( $sys_value == '已婚' ) {
                $gou_checked = " checked='checked' ";
            } else {
                $gou_checked2 = " checked='checked' ";
            }
            if ( $gou_checked == '' && $gou_checked2 == '' ) {
                $gou_checked2 = " checked='checked' ";
            }
            $Get_out_InputTypes = "<label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_0' value='已婚' class='$sys_class' $gou_checked $onchange $readonly />已婚&nbsp;&nbsp;&nbsp;</label><label><input name='$zd_name' type='radio' typeid='$typeid' id='" . $zd_id . "_1' class='$sys_class' value='未婚' $gou_checked2 $onchange $readonly />未婚</label><script>Inputdate('$zd_name','26','$sys_value','$ToHtmlID','$nowaddbox');</script>";
            break;
        case 27: // 月份选择

            //$onchange=" onchange='checkbox_morechecked(this)' ";
            //$nowaddbox='.mains_right_menu';
            $Get_out_InputTypes = "
            <label><input type='checkbox' typeid='$typeid'  name='$zd_name'  id='" . $zd_id . "_0' tit='$sys_value' cnval='1月' value='$sys_value' valid='1月' valstr='' class='$sys_class'  $onchange >1月&nbsp;</label>
            <label><input type='checkbox' typeid='$typeid'  name='$zd_name'  id='" . $zd_id . "_1' tit='$sys_value' cnval='2月' value='$sys_value' valid='2月' valstr='' class='$sys_class'  $onchange >2月&nbsp;</label>
            <label><input type='checkbox' typeid='$typeid'  name='$zd_name'  id='" . $zd_id . "_2' tit='$sys_value' cnval='3月' value='$sys_value' valid='3月' valstr='' class='$sys_class'  $onchange >3月&nbsp;</label>
            <label><input type='checkbox' typeid='$typeid'  name='$zd_name'  id='" . $zd_id . "_3' tit='$sys_value' cnval='4月' value='$sys_value' valid='4月' valstr='' class='$sys_class'  $onchange >4月&nbsp;</label>
            <label><input type='checkbox' typeid='$typeid'  name='$zd_name'  id='" . $zd_id . "_4' tit='$sys_value' cnval='5月' value='$sys_value' valid='5月' valstr='' class='$sys_class'  $onchange >5月&nbsp;</label>
            <label><input type='checkbox' typeid='$typeid'  name='$zd_name'  id='" . $zd_id . "_5' tit='$sys_value' cnval='6月' value='$sys_value' valid='6月' valstr='' class='$sys_class'  $onchange >6月&nbsp;</label>
            <label><input type='checkbox' typeid='$typeid'  name='$zd_name'  id='" . $zd_id . "_6' tit='$sys_value' cnval='7月' value='$sys_value' valid='7月' valstr='' class='$sys_class'  $onchange >7月&nbsp;</label>
            <label><input type='checkbox' typeid='$typeid'  name='$zd_name'  id='" . $zd_id . "_7' tit='$sys_value' cnval='8月' value='$sys_value' valid='8月' valstr='' class='$sys_class'  $onchange >8月&nbsp;</label>
            <label><input type='checkbox' typeid='$typeid'  name='$zd_name'  id='" . $zd_id . "_8' tit='$sys_value' cnval='9月' value='$sys_value' valid='9月' valstr='' class='$sys_class'  $onchange >9月&nbsp;</label>
            <label><input type='checkbox' typeid='$typeid'  name='$zd_name'  id='" . $zd_id . "_9' tit='$sys_value' cnval='10月' value='$sys_value' valid='10月' valstr='' class='$sys_class'  $onchange >10月&nbsp;</label>
            <label><input type='checkbox' typeid='$typeid'  name='$zd_name'  id='" . $zd_id . "_10' tit='$sys_value' cnval='11月' value='$sys_value' valid='11月' valstr='' class='$sys_class'  $onchange >11月&nbsp;</label>
            <label><input type='checkbox' typeid='$typeid'  name='$zd_name'  id='" . $zd_id . "_11' tit='$sys_value' cnval='12月' value='$sys_value' valid='12月' valstr='' class='$sys_class'  $onchange >12月&nbsp;</label>
            
            <script>Inputdate('$zd_name','15','$sys_value','$ToHtmlID','$nowaddbox');</script>";
            break;
        default: // 样式默认：默认为文本框
            $Get_out_InputTypes = "<input type='text' typeid='$typeid' name='$zd_name' id='$zd_id' class='$sys_class'  value='$sys_value' $onchange $readonly />";
            //return Get_out_InputTypes;
    }
    return $Get_out_InputTypes;
} //function end

//[ok]================================================================================================== [ziduan] 查询字段属性值[指定字段]
function msc_inputtype_value( $inputid, $colshuxin = 'dataleixin' ) { //$msc_inputtype表名,在表中搜索字段设定
    //dataleixin[控件类型]     xsname            XiaoShu【小数点】  Moren 
    //VarChar(100)            下拉框，文本框      0，2              默认值
    global $db;
    $mowvalue = '';
    $sql = "select * From  `msc_inputtype` where id=$inputid "; //查询到对应记录
    echo $sql;
    $rs = $db -> query($sql);
    $row = mysqli_fetch_array( $rs['result']);
    if ( $colshuxin == 'dataleixin' ) {
        $mowvalue = $row[ 'dataleixin' ]; //类型
    } elseif ( $colshuxin == 'xsname' ) {
        $mowvalue = $row[ 'xsname' ]; //得到
    } elseif ( $colshuxin == 'XiaoShu' ) {
        $mowvalue = $row[ 'XiaoShu' ]; //得到
    } elseif ( $colshuxin == 'Moren' ) {
        $mowvalue = $row[ 'Moren' ]; //得到
    } else {
        $mowvalue = $row[ 'dataleixin' ]; //得到
    }
    return $mowvalue;
} //function end
//[ok]================================================================================================== [ziduan] 查询字段属性值[指定字段]
function ziduan_search_leixin( $Table_Name, $colname, $colshuxin ) { //$Table_Name表名,$colname列名,$colshuxin添加说明内容
    //Field[字段名] Type【】Collation Null Key Default Extra          Privileges                       Comment
    //id           int(11) NULL     NO   PRI  NULL   auto_increment select,insert,update,references   
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    IsNullExit( $Table_Name ); //为空时停止往下执行。
    $ziduan_search_leixin = '';
    //echo $colshuxin;
    if ( '1' . $colshuxin == '1' )$colshuxin = 'Type';
    $sql = "SHOW FULL COLUMNS FROM `" . $Table_Name . "` where Field='" . $colname . "' ";
    // echo $sql;
    $rs = $connect -> query($sql);
    if ( $row = mysqli_fetch_array( $rs['result'] ) ) {
        $ziduan_search_leixin = $row[ $colshuxin ]; //得到列备注
    } else {
        $ziduan_search_leixin = '';
    };
    return $ziduan_search_leixin;
} //function end

//[ok]======================================================================================================默认显示样式
function table_col_type_moren( $colname = '', $typeid = '0' ) {
    if ( $typeid == ''
        or $typeid == '0' ) {
        $typeid = 1;
    }

    switch ( trim( $colname ) ) {
        case 'id': // 样式默认：ID
            return 1;
            break;
        case 'sys_id_zu': // 样式默认：分类
            return 15;
            break;
        case 'sys_id_fz': // 样式默认：分支
            return 1;
            break;
        case 'sys_yfzuid': // 样式默认：公司ID
            return 1;
            break;
        case 'sys_bh': // 样式默认：记录编号【数字】
            return 1;
            break;
        case 'sys_zt': // 样式默认：[系统]字头
            return 1;
            break;
        case 'sys_zt_bianhao': // 样式默认：[系统]字头编号
            return 1;
            break;
        case 'sys_nowbh': // 样式默认：记录编号【字母与数字组合】
            return 1;
            break;
        case 'sys_huis': // 样式默认：回收
            return 14;
            break;
        case 'bumen_id': // 样式默认：部门
            return 1;
            break;
        case 'sys_id_login': // 样式默认：编制人工号
            return 1;
            break;
        case 'sys_login': // 样式默认：编制人
            return 1;
            break;
        case 'sys_shenpi': // 样式默认：审核人
            return 20;
            break;
        case 'sys_shenpi_all': // 样式默认：批准人
            return 22;
            break;
        case 'sys_chaosong': // 样式默认：经办人
            return 1;
            break;
        case 'sys_web_shenpi': // 样式默认：允许Web访问
            return 13;
            break;
        case 'sys_adddate': // 样式默认：添加时间
            return 9;
            break;
        case 'sys_adddate_g': // 样式默认：更新时间
            return 9;
            break;

        case 'sys_zzzt': // 样式默认：在职/离职
            return 16;
            break;
        default: // 样式默认：默认为文本框
            return $typeid;
    };
}


//[ok]=========================================================================将分类转为代码选框或下拉单选

function Html_input( $Table_Name , $Checkcol , $XScol , $MorenZhi , $LeiXin , $inputname , $re_id , $Checkzu_id, $nowaddbox , $typeid ) { //echo Html_input( 'sys_zuall',  'id',  'lname1',  '默认值', 'CheckBox','sys_id_zu', '321' $typeid显示样式id);
    global $hy, $bh, $ToHtmlID; //全局变量

    $connect = Changedb( $Table_Name ); //依据表自动选择数据库

    //echo $re_id;
    //$Table_Name,LeiXin,XScol,Checkcol,$MorenZhi,$inputname(表名,类型,显示列,选中值列,默认值,input名称) 
    $nowselect = $To_SQL_now_id = $To_SQL_now_lname1 = $To_SQL_input = '';
    if ( $XScol == $Checkcol ) { //当选定值和显示值相同列时
        $nowselect = $XScol;
    } else {
        $nowselect = $XScol . ',' . $Checkcol; //选定值和显示值不同时
    };
    if ( $Table_Name == 'sys_zuall' ) {
        $sql = "select $nowselect From `$Table_Name` where sys_yfzuid='$hy' and tableid='$re_id' and sys_huis<>1 order by $XScol Asc";
    } else {
        $sql = "select $nowselect From `$Table_Name` where sys_yfzuid='$hy' and re_id='$re_id' and sys_huis<>1 order by $XScol Asc";
    }

    //echo $sql;
    $rs = $connect -> query($sql);
    $nowrscount = $connect -> numRows( $rs['result'] ); //统计数量
    //echo $nowrscount;
    //$INPUTs="<input type='' name='$inputname' id='$inputname' value='$MorenZhi'  />"."\n";// checkbox存值的框
    //$INPUTs='';
    $i = 0;
    if ( $nowrscount == 0 ) { //没有数据时
        $To_SQL_input = "\n<label><input type='checkbox' typeid='$typeid' name='" . $inputname . "' id='" . $inputname . $i . "' tit=' $MorenZhi' value='' class='addboxinput inputfocus' checked>&nbsp;所有分类&nbsp;</label>";
    } else {
        //if ( $LeiXin == 'CheckBox' ) { //类型为复选框
        //$To_SQL_input .=$INPUTs;
        //}
        if ( $LeiXin == 'select' ) { //类型为下拉框
            $To_SQL_input = "<select name='" . $inputname . "' id='" . $inputname . "' class='addboxinput inputfocus' type='select' typeid='$typeid'>" . "\n";
        };
        //<option  value=''>选择分类</option>


        while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
            $i++;
            $To_SQL_now_id = trim( $row[ $Checkcol ] ); //选中列值
            $To_SQL_now_lname1 = $row[ $XScol ]; //显示列
            $nowgetN = getN( $MorenZhi, $To_SQL_now_id );

            if ( $LeiXin == 'CheckBox' ) { //类型为复选框

                $To_SQL_input .= "\n<label><input type='checkbox' typeid='$typeid' onchange='checkbox_morechecked(this)' name='$inputname' id='" . $inputname . $i . "' tit='$MorenZhi' cnval='$To_SQL_now_lname1' value='$MorenZhi' valid='$To_SQL_now_id' valstr='' class='addboxinput inputfocus' ";

                if ( $MorenZhi == $To_SQL_now_id or $nowgetN >= 0 ) {
                    $To_SQL_input .= 'checked';
                }

                $To_SQL_input .= '>' . $To_SQL_now_lname1 . '&nbsp;</label>';

            } elseif ( $LeiXin == 'Radio' ) { //类型为单选框
                if ( $MorenZhi == $To_SQL_now_id . ''
                    or getN( trim( $MorenZhi, ',' ) . ',', $To_SQL_now_id ) >= 0 ) {
                    $To_SQL_input .= "<input name='" . $inputname . "' id='" . $inputname . $i . "' tit='" . $To_SQL_now_id . "' value='" . $To_SQL_now_id . "' class='addboxinput inputfocus' type='radio' typeid='$typeid' checked>" . $To_SQL_now_lname1 . "&nbsp;";
                } else {
                    $To_SQL_input .= "<input name='" . $inputname . "' id='" . $inputname . $i . "' tit='" . $To_SQL_now_id . "' value='" . $To_SQL_now_id . "' type='radio' typeid='$typeid' class='addboxinput inputfocus'>" . $To_SQL_now_lname1 . "&nbsp;";
                };
            } elseif ( $LeiXin == 'select' ) { //类型为下拉框
                if ( $MorenZhi == $To_SQL_now_id . ''
                    or getN( trim( $MorenZhi, ',' ) . ',', $To_SQL_now_id ) >= 0 ) {
                    $To_SQL_input .= "<option  value='" . $To_SQL_now_id . "' selected>" . $To_SQL_now_lname1 . "</option>" . "\n";
                } else {
                    $To_SQL_input .= "<option  value='" . $To_SQL_now_id . "'>" . $To_SQL_now_lname1 . "</option>" . "\n";
                };
            };

        }; //while end
        if ( $LeiXin == 'select' ) { //类型为下拉框
            $To_SQL_input .= '</select>';
        };

    };
    //$To_SQL_input=$MorenZhi;
    return $To_SQL_input . "<script>Inputdate('$inputname','15','$MorenZhi','$ToHtmlID','$nowaddbox');</script>";
} //function end


//[ok]=========================================================================得到表的列清单
function Tablecol_list( $Table_Name) { //在
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    $Tablecol_list = $sql2 = $rs2 = '';
    $Table_Name = strtolower( $Table_Name );

    if ( '1' . $Table_Name != '1' ) {

        $sql2 = "select * from `$Table_Name`";
        //echo $sql2;
        $rs2 = $connect -> query($sql2);
        //$nowrscount=mysqli_num_rows($rs2);//统计数量
        if ( !$rs2['error'] ) { //当有记录时
            $finfo = mysqli_fetch_fields( $rs2['result'] );
            foreach ( $finfo as $val ) {
                $name = $val->name; //字段名
                $Tablecol_list .= $name . ',';
            }
        };
        
        $Tablecol_list = trim( $Tablecol_list, ',' );
    };
    return $Tablecol_list;
} //function end


//[ok]=========================================================================得到表的备注中第几列筛选后字段清单【用于显示列，锁定列的查询】
function Tablecol_list_beizhu_cols( $Table_Name, $beizhu_cols = 0 ) { //在
    //0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】

    $connect = Changedb( $Table_Name ); //依据表自动选择数据库

    $Tablecol_list = '';
    //$Table_Name=strtolower($Table_Name);

    if ( '1' . $Table_Name != '1' ) {

        $sql = "SHOW FULL COLUMNS FROM `$Table_Name` "; //检查所有字段

        // echo $sql;
        $rs = $connect -> query($sql);


        if ( $rs ) { //当有记录时
            while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
                $zd_en_name = $row[ 'Field' ]; //字段名
                $zdbeizhu = $row[ 'Comment' ]; //备注
                $zdbeizhu = colbeizhu( $zdbeizhu, $zd_en_name ); //格式化检查,0,0,0,0,50,0,0,
                $beizhu_cols_value = textN( $zdbeizhu, $beizhu_cols, ',' ); //(备注全部，第几列，'分隔符')
                if ( $beizhu_cols_value == 1 ) { //为1是勾选的备注列
                    $Tablecol_list .= ',' . $zd_en_name;
                }
            };
        }
        $Tablecol_list = trim( $Tablecol_list, ',' );
    };
    return $Tablecol_list;
} //function end

//[ok]========================================================================= 查询表显示、锁定等的总宽度
function count_col_num( $Table_Name, $beizhu_cols = 1 ) { // （表名，5显示列）count_col_num( $Table_Name, 5 ) 显示列的总宽
    //0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    $nowcount = 75;
    //$Table_Name=strtolower($Table_Name);
    if ( '1' . $Table_Name != '1' ) {
        $sql = "SHOW FULL COLUMNS FROM `$Table_Name` "; //检查所有字段
        //echo $sql;
        $rs = $connect -> query($sql);
        if ( $rs ) { //当有记录时
            while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
                $zd_en_name = $row[ 'Field' ]; //字段名
                $zdbeizhu = $row[ 'Comment' ]; //备注
                $zdbeizhu = colbeizhu( $zdbeizhu, $zd_en_name ); //格式化检查,0,0,0,0,50,0,0,
                $beizhu_cols_value = textN( $zdbeizhu, $beizhu_cols, ',' ); //(备注全部，第几列，'分隔符')
                if ( $beizhu_cols_value == 1 ) {
                    $zd_xianshi_width = XianShiWidthMoren( $zd_en_name, textN( $zdbeizhu, 1, ',' ) ); //设定系统默认宽度和最小显示宽度
                    $nowcount += $zd_xianshi_width+4; //这里加上宽度值
                }
            }
        }
    };
    return $nowcount;

} //function end

//[ok]======================================================================================================将表列值串联起来
function Tablecol_list_ToStrArry( $Table_Name, $colsname, $wheretext = '' ) { //$Table_Name,$wheretext：where 后面的筛选

    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    if ( '1' . $wheretext <> '1' )$wheretext = ' where ' . $wheretext; //当有条件时执行
    $sql = "select * from $Table_Name $wheretext";
    $rs = $connect->query($sql);
    
    // echo $sql;

    $nowcol = '';
    while ( $row = $row = mysqli_fetch_assoc($rs['result']) ) {
        $nowcol .= "," . $row[ $colsname ];
    };
    return Trim( $nowcol, ',' ); //返回值
} //function end

//[ok]======================================================================================================统计表中记录数
function Tongji_table_rows( $Table_Name, $wheretext = '' ) { //$Table_Name,$wheretext：where 后面的筛选

    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    if ( '1' . $wheretext <> '1' )$wheretext = ' where ' . $wheretext; //当有条件时执行
    $sql = "select * from `" . $Table_Name . "` " . $wheretext;
    //echo $sql;
    $rs = $connect -> query($sql);
    if ( $rs ) {
        $nowcount = mysqli_num_rows( $rs['result'] ); //统计数量
    } else {
        $nowcount = 0;
    };
    return $nowcount;
} //function end

//[ok]=========================================================================查询最大id值返回
function MAX_col_id( $Table_Name, $newfieldsnameZD, $newfieldsname ) { //
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库

    $sql = 'select id From `' . $Table_Name . '` where sys_huis=0 and  `' . $newfieldsnameZD . "`='" . $newfieldsname . "' order by `id` desc";
    $rs = $connect -> query($sql);
    $row = mysqli_fetch_array( $rs );
    $nowid = $row[ 'id' ];
    return $nowid;
} //function end
//[ok]=========================================================================依据re_id查询表名返回
function Find_tablename( $re_id ) { //
    global $db_vip;
    $sql = "select mdb_name_SYS From `sys_jlmb` where id=" . $re_id;
    // echo $sql;
    $rs = $db_vip -> query($sql);
    if ($rs['error'] == null) 
    {
        if ($db_vip->numRows($rs['result']) > 0) 
        {
            $row = mysqli_fetch_array( $rs['result'] );
            $mdb_name_SYS = trim( $row[ 'mdb_name_SYS' ] ); //原数据表名
            return $mdb_name_SYS;
        }
    }
    mysqli_free_result( $rs['result'] ); //释放内存
} //function end
//[ok]=========================================================================依据re_id查询表中文件名返回
function Find_table_CNname_fromre_id( $re_id ) { //
    global $db_vip;
    $sql = "select sys_card From `sys_jlmb` where id=" . $re_id;
    $rs = $db_vip -> query($sql);
    $row = mysqli_fetch_array( $rs['result'] );
    $sys_card = trim( $row[ 'sys_card' ] ); //原数据表名中文名
    return $sys_card;
} //function end
//[ok]=========================================================================【依据表名查 中文名称】
function Find_table_CNname( $databiao ) { //
    global $db_vip;

    $sql = "select sys_card From `sys_jlmb` where `mdb_name_SYS`='$databiao'";
    $rs = $db_vip -> query($sql);
    $row = mysqli_fetch_array( $rs['result'] );
    $card = trim( $row[ 'sys_card' ] ); //原数据表名
    return $card;
} //function end
//[ok]=========================================================================【依据表名查re_id】
function Tablename_Find_re_id( $databiao ) { //
    global $db_vip;
    $sql = "select id From `sys_jlmb` where `mdb_name_SYS`='$databiao'";
    $rs = $db_vip -> query($sql);
    $row = mysqli_fetch_array( $rs['result'] );
    $id = $row[ 'id' ]; //原数据表名
    return $id;
} //function end
//[ok]=========================================================================查询值返回
function Find_Col_Value( $Table_Name, $where, $colname ) { //
    $rs = $sql = $nowvalue = $row = '';
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    $sql = "select `$colname` From `$Table_Name` where $where order by `id` Desc";
    // echo $sql;
    $rs = $connect -> query($sql);

    if ( mysqli_num_rows( $rs['result'] ) ) {
        $row = mysqli_fetch_array( $rs['result'] );
        $nowvalue = $row[ $colname ];
    } else {
        $nowvalue = '';
        //mysql_error();
    }
    return $nowvalue;
} //function end
//[ok]=========================================================================查询最新添加的内容找到id值返回
function ADD_Col_id( $Table_Name, $sys_postzd_list, $sys_postvalue_list ) { //
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    // echo $Table_Name;
    $where = '';
    $Arr_ziduan = explode( ',', $sys_postzd_list );
    $Arr_ziduan_value = explode( ',', $sys_postvalue_list );
    //$A_ziduan='';
    $count = count( $Arr_ziduan );
    for ( $i = 0; $i < $count; $i++ ) {
        $Arr_ziduan_values = $Arr_ziduan_value[ $i ];
        $Arr_ziduan_values = ADD_zkh( $Arr_ziduan_value[ $i ], "'" ); //没有引号加引号
        $where .=  " and ".$Arr_ziduan[ $i ] . "=" . $Arr_ziduan_values;
        // echo $Arr_ziduan_value[ $i ];
    };
    $where = Trim( $where );

    $sql = "select id From `$Table_Name` where sys_huis=0  $where  order by `id` desc";
    $rs = $connect -> query($sql);
    if ($rs['error'] == null) {
        if ($connect->numRows($rs['result']) > 0) {
            $nowid =  mysqli_fetch_assoc($rs['result'])['id'];
            return $nowid;
        }
    }else{
        echo $rs['error'];
    }
} //function end
//============================================================================= 系统字段的默认宽度
function XianShiWidthMoren( $zd_en_name, $XianShiWidthMoren ) {
    //if($zd_en_name=='sys_id_zu'){//当为分类框时
    //$XianShiWidthMoren = 80;
    //}elseif($zd_en_name=='sys_adddate' || $zd_en_name=='sys_adddate_g'){//当为时间|日期|分类框时
    //$XianShiWidthMoren = 130;
    //}
    if ( $XianShiWidthMoren <= 28 ) {
        $XianShiWidthMoren = 28; //设定最少宽度
    }
    return $XianShiWidthMoren;
}

//---------------------------------------------以上已再次编写核对-----------------------------------------------


//===========================================================================================将表Sys_Jlmb列字形成数据字符串
function Searcarryy( $Table_Name, $colname, $ziduan2, $bigid ) { //$Table_Name表名
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库

    $rs = $sql = $i = $Searcarry = '';
    //在记录模版中添加
    $sql = 'select ' . $ziduan2 . ' From `' . $Table_Name . '` where ' . $colname . '=' . $bigid;
    $rs = $connect -> query($sql);
    while ( $row = mysqli_fetch_array( $rs ) ) {
        if ( '1' . $Searcarry == '1' ) {
            $Searcarry = $row[ $ziduan2 ];
        } else {
            $Searcarry = $Searcarry . ',' . $row[ $ziduan2 ];
        };
    };

    return $Searcarry;
} //function end


//【ok】=========================================================================时间格式
function ToData( $str ) {
    $str = date( "Y-m-d H:i:s", $str ); //时间格式
    return trim( $str ); //返回字符串
};

//【ok】=========================================================================判断是否为手机访问
function ISmobile() { //
    $mobileAgent = array( "iphone", "ipod", "ipad", "android", "mobile", "blackberry", "webos", "incognito", "webmate", "bada", "nokia", "lg", "ucweb", "skyfire" );
    //读取用户的浏览器资料
    $browser = $_SERVER[ 'HTTP_USER_AGENT' ]; //浏览器信息
    //echo $browser;
    $isMobile = 'pc';
    //检查开始

    foreach ( $mobileAgent as $search ) {
        if ( stristr( $browser, $search ) != false ) {
            $isMobile = 'mobile';
            //echo $search;
            //exit; //停止运行程序
        };
    };
    return trim( $isMobile ); //返回结果
};
//【ok】=========================================================================提示：数据库表未设定好
function nonelist() {
    global $ToHtmlID;
    $nonelist = "<table width='100%' height='100%' border='0' cellspacing='0' cellpadding='0' tabindex=0><tr><td><center></br></br></br></br></br></br></br><font color='red' style='cursor:hand;'  onClick=" . "\"" . "moban_set_edit(this,'" . $ToHtmlID . "');" . "\"" . "><i class='fa fa-nodata'></i>&nbsp;";
    $nonelist .= '数据库表未设定好！';
    $nonelist .= '</font></center></td></tr></table>';
    return $nonelist;
};
//【ok】=========================================================================提示：您没有查看权限
function nonequxian() {
    $nonequxian = "<table width='100%' height='100%' border='0' cellspacing='0' cellpadding='0' tabindex=0><tr><td></br></br></br></br></br></br></br><center><font color='red'><i class='fa fa-nodata'></i>&nbsp;";
    $nonequxian .= '您没有查看权限！';
    $nonequxian .= '</font></center></td></tr></table>';
    return $nonequxian;
};
function selectQuanXian($hy,$user_id,$db) {
    
    $query =  "SELECT * FROM msc_user_hy WHERE sys_yfzuid = ? AND user_id = ?";
    $params = array($hy,$user_id);
    // echo $hy.$user_id;
    $hyAll = $db->query($query, $params);
    $result = mysqli_fetch_assoc($hyAll['result']);
    // echo json_encode($result,JSON_UNESCAPED_UNICODE);

    $_SESSION['bh'] = $result['SYS_GongHao'];
    $SYS_QuanXian = $_SESSION['SYS_QuanXian'] = $result['zhiwei_id']; 

    $fields_to_check = array(
        'sys_q_fanwei','sys_q_tianj','sys_q_shenghe',
        'sys_q_pizhun','sys_q_cak','sys_q_xiug',
        'sys_q_shanc','sys_q_huis','sys_q_dayin',
        'sys_q_xiaohui','sys_q_zhixing','sys_q_seid'
    );

    $SYS_QuanXian_index = $_SESSION['SYS_QuanXian_index'] = array(); 
    $SYS_QuanXian_list = $_SESSION['SYS_QuanXian_list'] = explode(',', str_ireplace("_", ",", $SYS_QuanXian));
    // echo $SYS_QuanXian_list;
    foreach ($SYS_QuanXian_list as $item) {
        //查询对应职位的权限
        $query =  "SELECT * FROM msc_zhiwei WHERE id = ?";
        $params = array($item);
        $queryResult = $db->query($query, $params);

        // echo mysqli_error($Connadmin);
        if ($queryResult['error'] == null) {
            $result = mysqli_fetch_assoc($queryResult['result']);
            foreach ($fields_to_check as $purview) {
                $SYS_QuanXian_index[$purview] = move_arrynull( QuChong( isset($SYS_QuanXian_index[$purview]) ? $SYS_QuanXian_index[$purview] . ',' . $result[$purview] : $result[$purview] ));
            }
        }else{
            return "<script>alert('数据库异常，请重试')</script>";
        }
    }
    // echo "<script>console.log(" . json_encode($SYS_QuanXian) . ")</script>";
    $_SESSION['SYS_QuanXian_index'] = $SYS_QuanXian_index;
    selectdata($SYS_QuanXian_list);
    return 0;
}

function selectdata($SYS_QuanXian_list) {
    global $Connadmin;
    // echo json_encode($SYS_QuanXian_list,JSON_UNESCAPED_UNICODE);
    $SYS_QuanXian_str = implode(',',$SYS_QuanXian_list);
    $bumenList = array();
    $topBumenIdxList = array();
    $bumenIdxList = array();

    $sql = "
        SELECT bumen.id,bumen.bumenname,bumen.parent
        FROM msc_bumenlist AS bumen 
        JOIN msc_zhiwei AS zhiwei ON zhiwei.bumen = bumen.id
        WHERE zhiwei.id IN($SYS_QuanXian_str)
        ORDER BY bumen.id ASC
    ";
    // echo $sql;
    $rs = mysqli_query( $Connadmin, $sql );
    // echo mysqli_error($Connadmin);
    while ( $row = mysqli_fetch_array( $rs ) ) {
        if(!in_array($row['id'], $bumenIdxList,true)){
            $bumenList []= array('id' => $row['id'], 'bumenname' => $row['bumenname'], 'parent' => $row['parent'], 'prefix' => 0);
            $bumenIdxList []= $row['id'];
            BumenSetall($bumenList,$bumenIdxList,$bumenIdxList,1);    
        }
        if(!in_array($row['id'], $topBumenIdxList,true)){
            $topBumenIdxList []= $row['id'];
        }
    }
    
    // echo json_encode($bumenList,JSON_UNESCAPED_UNICODE);

    mysqli_free_result( $rs ); //释放内存
    $_SESSION['SonBumenList'] = $bumenList;
    $_SESSION['SonBumenIdxList'] = $bumenIdxList;
    $_SESSION['topBumenIdxList'] = $topBumenIdxList;  
}
function BumenSetall(&$bumenList,&$bumenIdxList,$bumenList_old,$prefix) {
    global $Connadmin;
    $bumenList_new = array();
    $bumenStr = implode(',',$bumenIdxList);
    $bumenStr_old = implode(',',$bumenList_old);

    $sql = "SELECT id,bumenname,parent FROM msc_bumenlist WHERE parent IN($bumenStr_old) AND id NOT IN($bumenStr)";
    // echo $sql;
    $rs = mysqli_query( $Connadmin, $sql );

    // $i = 0;
    while ( $row = mysqli_fetch_array( $rs ) ) {
        // $i++;
        if(!in_array($row['id'], $bumenIdxList,true)){
            $bumenList []= array('id' => $row['id'], 'bumenname' => $row['bumenname'], 'parent' => $row['parent'], 'prefix' => $prefix);
            $bumenIdxList []= $row['id'];
            $bumenList_new []= $row['id'];
            BumenSetall($bumenList,$bumenIdxList,$bumenList_new,$prefix+1);
        }
    }
    mysqli_free_result( $rs ); //释放内存

    // if($i <> 0){
    // }
}

function setfun($val,&$list) {
    if (!in_array($val, $list,true)) {
        $list []= $val;
    }
}
function allPosition($id,&$bumenlistStorage,$j,$str,$SYS_QuanXian) {
    // echo 123;
    global $hy,$Connadmin;
    // echo $id;
    $sql3 = "select * from `msc_bumenlist` where sys_yfzuid = '$hy' and $str in($id) and sys_huis = 0 ORDER BY id ASC";
    // echo $sql3;
    $rs3 = mysqli_query( $Connadmin, $sql3 );
    while ( $row3 = mysqli_fetch_array( $rs3 ) ) {
        $rowdid3 = $row3[ "id" ]; //部门id
        if(!in_array($rowdid3, $bumenlistStorage)){
            $bumenlistStorage []= $rowdid3;
            $bumenname3 = $row3[ "bumenname" ]; //部门名称
            echo( "<optgroup label='".str_repeat('---', $j).$bumenname3."'> " );

            //------------------------------职位数据
            $sql2 = "select * from `msc_zhiwei` where sys_yfzuid = '$hy' and bumen = $rowdid3 and sys_huis = 0 ORDER BY id ASC";
            $sql2;
            $rs2 = mysqli_query( $Connadmin, $sql2 );

            while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                $rowdid = $row2[ "id" ];
                $rowzu = $row2[ "zu" ]; //职位名称
                echo( "<option  value='$rowdid' " );
                if ( getN( $SYS_QuanXian, $rowdid, '_' ) >= 0 ) { //如果查得到该字段时 ) {
                    echo( 'selected' );
                }
                echo( ">$rowzu</option>" );
            }

            mysqli_free_result( $rs2 ); //释放内存
            allPosition($rowdid3,$bumenlistStorage,$j+1,'parent',$SYS_QuanXian);
            //------------------------------职位数据end if
            echo( "</optgroup>" );
        }
    }
    mysqli_free_result( $rs3 ); //释放内存
}
?>