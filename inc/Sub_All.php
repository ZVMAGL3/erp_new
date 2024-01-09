<?php
header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码

//*************************本页为没有返回值的函数*********************************// 
//[ok]================================================================================================== [Conn] 数据库所有表系统字段完整性检查
function Conn_table_cols_sys( $Connnow = '' ) { //$Table_Name表名
    //查询是否有这个表
    global $db, $db_vip; //得到全局变量
    //IsNullExit($Connnow);//为空时停止往下执行。
    //$nowid = '';
    $sql = "show tables";
    if ( $Connnow == 'Connadmin' ) {
        $rs = $db -> query($sql);
    } else {
        $rs = $db_vip -> query($sql);
    }
    while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
        $Table_Name = $row[ 0 ]; //得到表名
        //echo $Table_Name.',';
        Table_SYS_Ziduan_CuShi( $Table_Name );
    }
}; //function end
//[ok]================================================================================================== [] 将字符串转为utf-8
function str_to_utf8( $str = '' ) {
    $current_encode = mb_detect_encoding( $str, array( "ASCII", "GB2312", "GBK", 'BIG5', 'UTF-8' ) );
    $encoded_str = mb_convert_encoding( $str, 'UTF-8', $current_encode );
    return $encoded_str;

}
//[ok]================================================================================================== [] 替换文件变量
function Sys_XuanYongMoban( $re_id, $id ) {
    global $Conn; //得到全局变量
    //-------------------------------------------------------------查询到表的版式start
    $sql = 'select sys_banshi From Sys_jlmb where id=' . $re_id;
    $rs = mysqli_query( $Conn, $sql );
    $row = mysqli_fetch_array( $rs );
    $sys_banshi = $row[ 'sys_banshi' ]; //1数据表，2文件自动化
    mysqli_free_result( $rs ); //释放内存
    //-------------------------------------------------------------查询到表的版式end if

    if ( $sys_banshi == 2 ) { //2为文件自动化时
        $sql = "select * From sys_jlmb where id='$re_id'";
        //echo $sql;
        $rs = mysqli_query( $Conn, $sql );
        $row = mysqli_fetch_array( $rs );
        $nowcard = $row[ 'sys_card' ]; //表中文名
        $Table_Name = htmlspecialchars( trim( $row[ 'mdb_name_SYS' ] ) ); //原数据表名
        mysqli_free_result( $rs ); //释放内存
        //------------------------------------------------------------------------查询表表格文件
        $sql = "select * From $Table_Name where id='$id'";
        //echo $sql;
        $rs = mysqli_query( $Conn, $sql );
        $row = mysqli_fetch_array( $rs );
        $Sys_XuanYongMoban = $row[ 'sys_XuanYongMoBan' ]; //原文件名

        mysqli_free_result( $rs ); //释放内存
        //echo $Sys_XuanYongMoban;
        $fharry = explode( ';', $Sys_XuanYongMoban );
        //$continstr=count($fharry);
        foreach ( $fharry as $value ) {
            //$str .= $value.'<>';
            //echo $value.'<>';

            //echo
            $nowdir = dirname( dirname( __FILE__ ) ) . "\\" . $value; //模版物理地址
            $new_dir = dirname( dirname( __FILE__ ) ) . "\\NEW_" . $re_id . "_" . $id . "\\" . $value; //生成的新文件地址
            //echo $nowdir;
            //$nowdir='E:\wwwroot2021\erp\uploads\other\20220113\20220113sj349812.docx';
            //$dir = dirname(__FILE__);
            //echo $dir;
            $PHPWord = new PHPWord();
            //$template = 'test';                                        //新建的文件夹名称    
            //$nowdir=$dir.'/test.docx';
            $loadtemplate = $PHPWord->loadTemplate( $nowdir ); //加载word文件
            //$loadtemplate->setValue('ZD_GongSiMingChen','浙江缙云韩立锯业有限公司');          //替换$zd_en_name内容为$zd_en_name_value

            $sql = "select * From $Table_Name where id='$id'";
            //echo $sql;
            $rs = mysqli_query( $Conn, $sql );
            $row = mysqli_fetch_array( $rs );
            //-------------------------------------------------[]
            $sql2 = "SHOW FULL COLUMNS FROM `$Table_Name`";
            $rs2 = mysqli_query( $Conn, $sql2 );
            while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                $zd_en_name = $row2[ 'Field' ]; //字段英文名，也是需要替换的关键词
                //echo $zd_en_name;
                $zd_en_name_value = $row[ $zd_en_name ]; //字段默认值
                if ( trim( $zd_en_name_value ) != '' ) {
                    $loadtemplate->setValue( $zd_en_name, $zd_en_name_value ); //替换$zd_en_name内容为$zd_en_name_value
                }
            }
            mysqli_free_result( $rs2 );

            mysqli_free_result( $rs );

            $loadtemplate->save( $new_dir ); //从模板生成到新文件
        }; /*foreach end*/
    }


} //function end
//[ok]================================================================================================== [] 利益函数
function LiYi_Add( $re_id, $id, $sys_id_zu, $leixin ) {
    $Table_Name = "sys_jiangfajilu"; //得到添加的表
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    if ( $id == '' ) {
        $id == 0;
    };
    if ( $re_id > 0 ) {
        $sql = "select * From sys_jlmb where id='$re_id'";
        //echo $sql;
        $rs = $connect -> query($sql);
        $row = mysqli_fetch_array( $rs['result'] );
        //$nowcard = $row[ 'sys_card' ];                        //表名
        //$nowstartdate = $row[ 'startdate' ];
        $sys_jiangli_rmb = $row[ 'sys_jiangli_rmb' ]; //奖励现金
        //echo $sys_jiangli_rmb;
        $sys_jiangli_jifen = $row[ 'sys_jiangli_jifen' ]; //奖励积分
        $sys_chufa_rmb = $row[ 'sys_chufa_rmb' ]; //处罚现金
        $sys_chufa_jifen = $row[ 'sys_chufa_jifen' ]; //处罚积分
        //$databiao_SYS_nows = htmlspecialchars( trim( $row[ 'mdb_name_SYS' ] ) ); //原数据表名
        //$Nowmaxrecord = intval( $row[ 'Mtiaoshu' ] ); //页显示数
    }
    //$sys_id_zu 查看533 编制534 修订535 审核536 批准537 经办538 删除539 回收540 打印541 销毁542 设置543
    // echo 'sys_id_zu:'.$sys_id_zu;
    switch ( $sys_id_zu ) {
        case '533': //查看533
            if ( $leixin == '+' ) { //奖励
                $sys_postvalue_list = textN( $sys_jiangli_rmb, 0, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_jiangli_jifen, 0, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'ZD_JiangLiHuoBi,ZD_JiangLiJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            } else { //处罚
                $sys_postvalue_list = textN( $sys_chufa_rmb, 0, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_chufa_jifen, 0, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'sys_FaHuoBi,sys_FaJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            }

            break;
        case '534': //编制534 添加
            if ( $leixin == '+' ) { //奖励
                $sys_postvalue_list = textN( $sys_jiangli_rmb, 1, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_jiangli_jifen, 1, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'ZD_JiangLiHuoBi,ZD_JiangLiJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            } else { //处罚
                $sys_postvalue_list = textN( $sys_chufa_rmb, 1, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_chufa_jifen, 1, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'sys_FaHuoBi,sys_FaJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            }
            break;
        case '535': //修订535 2
            if ( $leixin == '+' ) { //奖励
                $sys_postvalue_list = textN( $sys_jiangli_rmb, 2, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_jiangli_jifen, 2, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'ZD_JiangLiHuoBi,ZD_JiangLiJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            } else { //处罚
                $sys_postvalue_list = textN( $sys_chufa_rmb, 2, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_chufa_jifen, 2, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'ZD_FaHuoBi,ZD_FaJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            }

            break;
        case '536': //审核536 
            if ( $leixin == '+' ) { //奖励
                $sys_postvalue_list = textN( $sys_jiangli_rmb, 3, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_jiangli_jifen, 3, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'ZD_JiangLiHuoBi,ZD_JiangLiJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            } else { //处罚
                $sys_postvalue_list = textN( $sys_chufa_rmb, 3, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_chufa_jifen, 3, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'sys_FaHuoBi,sys_FaJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            }
            break;
        case '537': //批准537 
            if ( $leixin == '+' ) { //奖励
                $sys_postvalue_list = textN( $sys_jiangli_rmb, 4, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_jiangli_jifen, 4, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'ZD_JiangLiHuoBi,ZD_JiangLiJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            } else { //处罚
                $sys_postvalue_list = textN( $sys_chufa_rmb, 4, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_chufa_jifen, 4, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'sys_FaHuoBi,sys_FaJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            }
            break;
        case '538': //经办538 
            if ( $leixin == '+' ) { //奖励
                $sys_postvalue_list = textN( $sys_jiangli_rmb, 5, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_jiangli_jifen, 5, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'ZD_JiangLiHuoBi,ZD_JiangLiJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            } else { //处罚
                $sys_postvalue_list = textN( $sys_chufa_rmb, 5, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_chufa_jifen, 5, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'sys_FaHuoBi,sys_FaJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            }
            break;
        case '539': //删除539 
            if ( $leixin == '+' ) { //奖励
                // echo 1237778;
                $sys_postvalue_list = textN( $sys_jiangli_rmb, 6, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_jiangli_jifen, 6, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'ZD_JiangLiHuoBi,ZD_JiangLiJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            } else { //处罚
                $sys_postvalue_list = textN( $sys_chufa_rmb, 6, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_chufa_jifen, 6, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'sys_FaHuoBi,sys_FaJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            }
            break;
        case '540': //回收540 
            if ( $leixin == '+' ) { //奖励
                $sys_postvalue_list = textN( $sys_jiangli_rmb, 7, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_jiangli_jifen, 7, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'ZD_JiangLiHuoBi,ZD_JiangLiJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            } else { //处罚
                $sys_postvalue_list = textN( $sys_chufa_rmb, 7, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_chufa_jifen, 7, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'sys_FaHuoBi,sys_FaJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            }

            break;
        case '541': //打印541 
            if ( $leixin == '+' ) { //奖励
                $sys_postvalue_list = textN( $sys_jiangli_rmb, 8, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_jiangli_jifen, 8, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'ZD_JiangLiHuoBi,ZD_JiangLiJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            } else { //处罚
                $sys_postvalue_list = textN( $sys_chufa_rmb, 8, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_chufa_jifen, 8, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'sys_FaHuoBi,sys_FaJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            }

            break;
        case '542': //销毁542 
            if ( $leixin == '+' ) { //奖励
                $sys_postvalue_list = textN( $sys_jiangli_rmb, 9, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_jiangli_jifen, 9, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'ZD_JiangLiHuoBi,ZD_JiangLiJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            } else { //处罚
                $sys_postvalue_list = textN( $sys_chufa_rmb, 9, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_chufa_jifen, 9, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'sys_FaHuoBi,sys_FaJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            }

            break;
        case '543': //设置543
            if ( $leixin == '+' ) { //奖励
                $sys_postvalue_list = textN( $sys_jiangli_rmb, 10, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_jiangli_jifen, 10, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'ZD_JiangLiHuoBi,ZD_JiangLiJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            } else { //处罚
                $sys_postvalue_list = textN( $sys_chufa_rmb, 10, ',' ); //货币
                $sys_postvalue_list2 = textN( $sys_chufa_jifen, 10, ',' ); //积分
                if ( $sys_postvalue_list == '' ) {
                    $sys_postvalue_list = 0;
                };
                if ( $sys_postvalue_list2 == '' ) {
                    $sys_postvalue_list2 = 0;
                };
                $sys_postzd_list = 'sys_FaHuoBi,sys_FaJiFen,sys_re_id,sys_cols_id,sys_id_zu';
                $sys_postvalue_list_all = $sys_postvalue_list . ',' . $sys_postvalue_list2 . ',' . $re_id . ',' . $id . ',' . $sys_id_zu;
            }

            break;
        default:
            //echo NoZhiLing();
    };
    /*
	if($colname=='sys_JiangLiHuoBi'){         //奖励现金
		$sys_postvalue_list=textN( $sys_jiangli_rmb, $quanxian_id ,',');//字段对应值
		
	}elseif($colname=='sys_JiangLiJiFen'){    //奖励积分
		$sys_postvalue_list=textN( $sys_jiangli_jifen, $quanxian_id ,',');
   
	}elseif($colname=='sys_FaHuoBi'){         //罚现金
		$sys_postvalue_list=textN( $sys_chufa_rmb, $quanxian_id ,',');
		
	}elseif($colname=='sys_FaJiFen'){         //罚积分
		$sys_postvalue_list=textN( $sys_chufa_jifen, $quanxian_id ,',');
	
	}else{
		$sys_postvalue_list=0;
	};
	*/
    //echo $sys_postzd_list."=".$sys_postvalue_list;
    // echo '##############';
    Jilu_add_Modular( $Table_Name, $sys_postzd_list, $sys_postvalue_list_all ); //添加一条记录

} //function end

//[ok]================================================================================================== [Conn] 更新单条记录
function UpdataJilu( $Table_Name, $id, $ziduan, $newvale ) { //updatajilu($Connnow='',$tablename,$where,$newvale)
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库

    $sql = "UPDATE `$Table_Name`  set  `$ziduan`='$newvale'  where id=$id "; //更新SQL
    //echo $sqls;
    $connect -> query($sql);
} //function end

//-----[Table][Table][Table][Table][Table][Table][Table][Table][Table][Table][Table][Table][Table][Table][Table][Table]-----

//[ok]================================================================================================== [Table] 添加表模块
function table_add_Modular( $Table_Name = '', $tablebeizhu = '', $nowbigid = 0, $jlmb_id = 0 ) { //$Table_Name表名en,表名cn，上级id(当等于0时代表修改时添加)$nowbigid大类id，及0强制添加表，而不添加sys_jlmb
    global $const_id_login;
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    //echo "Table_Name:$Table_Name ,tablebeizhu:$tablebeizhu, nowbigid:$nowbigid , jlmb_id:$jlmb_id";
    //exit();
    IsNullExit( $Table_Name ); //为空时停止往下执行。
    if ( $const_id_login == '1' ) { //当为开发者时
        $nowsys = 0;
    } else {
        $nowsys = SYS_str( $Table_Name );
    }
    if ( '1' . $Table_Name <> '1'
        and $nowsys == 0 ) { //当为0时不为系统字段 1代表为系统字段

        $Table_Name_parent = $Table_Name; //原表

        if ( $jlmb_id > 0 ) { //修改sys_jlmb记录。
            //echo "已有数据";
            $sys_card_Old = Find_Col_Value( 'Sys_jlmb', "`id`='$jlmb_id'", 'sys_card' ); //查询到当前数据表名
            $Table_Name_Old = Find_Col_Value( 'Sys_jlmb', "`id`='$jlmb_id'", 'mdb_name_SYS' ); //查询到当前数据表
            //-------------------------------------------------------------当表中文名有变化时
            if ( strtolower( $sys_card_Old ) <> strtolower( $tablebeizhu ) ) { //当表名有变时
                Jilu_update_Modular( 'Sys_jlmb', "`id`='$jlmb_id'", 'sys_card', $tablebeizhu, $connect ); //更新记录模版里的对应表
                table_beizhu_update_Modular( $Table_Name_Old, $tablebeizhu ); //表备注修改
            }
            //-------------------------------------------------------------当数据表有变化时
            if ( strtolower( $Table_Name_Old ) <> strtolower( $Table_Name ) ) { //当数据表更新时
                //echo '修改数据表了！';
                table_edit_Modular( $Table_Name_Old, $Table_Name, $tablebeizhu, $jlmb_id ); //修改数据表
                //echo""."__";
                //exit();
            } else { //数据表没有更新时
                //-------------------------------------------------------------查询数据库中是否有该表，没有时生成
                $$Table_Name_isset_Old = Conn_Table_In( $Table_Name_Old ); //为空时证明该表不存在[即将要更新的表]
                if ( $$Table_Name_isset_Old == '-1' ) { //当表不存在时。
                    $sql = "CREATE TABLE `$Table_Name_Old` (`id` int(11) NOT NULL auto_increment COMMENT 'ID',PRIMARY KEY (`id`)) DEFAULT CHARSET='UTF8' COMMENT='$tablebeizhu' "; //新建的表默认创建有一个id自增的字段   表备注
                    //echo $sql;
                    mysqli_query( $Conn, $sql ); //这里执行添加新表
                    Table_SYS_Ziduan_CuShi( $Table_Name ); //这里初始化系统字段
                }
            }
        } else { //添加sys_jlmb记录加添加表。
            //echo "没数据，现在添加";
            $sql = "CREATE TABLE `$Table_Name` (`id` int(11) NOT NULL auto_increment COMMENT 'ID',PRIMARY KEY (`id`)) DEFAULT CHARSET='UTF8' COMMENT='$tablebeizhu' "; //新建的表默认创建有一个id自增的字段   表备注
            mysqli_query( $Conn, $sql ); //这里执行添加新表
            Table_SYS_Ziduan_CuShi( $Table_Name ); //这里初始化系统字段
            $sys_postzd_list = "sys_card,banben,mdb_name_SYS,xiugaicishu,Id_MenuBigClass,ok";
            $sys_postvalue_list = "'$tablebeizhu','A','$Table_Name','0','$nowbigid','yes'";

            Jilu_add_Modular( 'sys_jlmb', $sys_postzd_list, $sys_postvalue_list ); //添加数据 并生成添加的id
            $Xcoid_txt = Tablecol_list_ToStrArry( 'sys_jlmb', 'id', " `Id_MenuBigClass`='$nowbigid' " ); //查询当前大类的id值串起来
            Jilu_update_Modular( "sys_menubigclass", " `id`='$nowbigid' ", 'quanxian', $Xcoid_txt, $Conn ); //更新大类菜单权限
            /**/
        };
        //Find_Col_Value( $Table_Name, $where, $colname);//查询相关值
    };

}; //function end


//[ok]================================================================================================== [Table] 修改表名
function table_edit_Modular( $Table_Name = '', $newtablename = '', $tablebeizhu = '', $jlmb_id = 0 ) { //$Table_Name原表名$newtablename新表名  $tablebeizhu为中文名称
    global $const_id_login;
    //echo $Table_Name . ';' . $newtablename . ';' . $tablebeizhu . ';' . $jlmb_id;
    $Table_Name = strtolower( $Table_Name );
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    $Table_Name = strtolower( Find_Col_Value( 'Sys_jlmb', "`id`='$jlmb_id'", 'mdb_name_SYS' ) ); //查询到当前数据表
    IsNullExit( $Table_Name ); //为空时停止往下执行。table_beizhu_update_Modular
    $tableisset = Conn_Table_In( $Table_Name ); //老表为空时证明该表不存在[即将要更新的表]
    $newtablename_isset = Conn_Table_In( $newtablename ); //新表为空时证明该表不存在[即将要更新的表]
    //echo $newtablename_isset;
    if ( $newtablename_isset >= 0 && $newtablename <> $Table_Name )$newtablename = $newtablename . GetRanNum(); //当新表也存在时加上随机码
    //echo $tableisset;
    //exit();
    if ( $tableisset >= 0 && $newtablename <> $Table_Name ) { //查询数据库中也有这个表时
        if ( ( SYS_is( $Table_Name, 'sys_' ) == 0 && SYS_is( $newtablename, 'sys_' ) == 0 && SYS_is( $Table_Name, 'msc_' ) == 0 && SYS_is( $newtablename, 'msc_' ) == 0 ) ) { //当为0时不为系统字段 1代表为系统字段
            //$newtablename表名
            $sql = "alter table `$Table_Name` rename `$newtablename`";
            $connect -> query($sql);
            Jilu_update_Modular( 'Sys_jlmb', " `id`='$jlmb_id' ", 'mdb_name_SYS', $newtablename, $connect ); //更新记录模版里的对应表
        }
        //echo $newtablename;
    } else { //当表没有创建时
        //echo "table_edit_Modular：数据表时添加";
        //table_add_Modular( $newtablename, $tablebeizhu,0,$jlmb_id);//创建数据表
    };
    if ( $tableisset == '-1' && $newtablename_isset == '-1' ) { //当老表和新表都查不到时
        $sql = "CREATE TABLE `$newtablename` (`id` int(11) NOT NULL auto_increment COMMENT 'ID',PRIMARY KEY (`id`)) DEFAULT CHARSET='UTF8' COMMENT='$tablebeizhu' "; //新建的表默认创建有一个id自增的字段   表备注
        //echo $sql;
        $connect -> query($sql);
        Table_SYS_Ziduan_CuShi( $newtablename ); //这里初始化系统字段
        Jilu_update_Modular( 'Sys_jlmb', " `id`='$jlmb_id' ", 'mdb_name_SYS', $newtablename, $connect ); //更新记录模版里的对应表
    }
} //function end

//[ok]================================================================================================== [Table] 删除表
function table_del_Modular( $Table_Name = '' ) { //$Table_Name表名
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    IsNullExit( $Table_Name ); //为空时停止往下执行。
    if ( SYS_is( $Table_Name ) == 0 && SYS_is( $Table_Name, 'msc_' ) == 0 ) { //当为0时不为系统字段 1代表为系统字段
        $sql = "DROP TABLE `$Table_Name` ";
        $connect -> query($sql);
    };
} //function end

//[ok]================================================================================================== [Table] 添加、修改、删除 表扩展备注（删除将备注设为空）
function table_beizhu_update_Modular( $Table_Name, $tablebeizhu ) { //$Table_Name表名
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    IsNullExit( $Table_Name ); //为空时停止往下执行。
    $sql = "alter table `$Table_Name` comment '$tablebeizhu' ";
    $connect -> query($sql);
    //Jilu_update_Modular( 'Sys_jlmb', "`mdb_name_SYS`='$Table_Name'", 'sys_card', $tablebeizhu ,$Conn); //更新记录模版里的对应表
} //function end

//[ok]================================================================================================== [Table] 添加修改表系统默认字段
function Table_SYS_Ziduan_CuShi( $Table_Name = '' ) { //$Table_Name表名
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    $sql = '';

    $col_list = Tablecol_list( $Table_Name ); //查询该表所有字段清单字符串
    //echo "$Table_Name'_'$col_list";
    //echo getN($col_list,"id235");
    //以下  没有该字段时执行添加  //
    //----------------------------------------------------------------id
    if ( getN( $col_list, 'id' ) < 0 ) {
        $sql .= "`id` int(11) NOT NULL auto_increment COMMENT 'ID',PRIMARY KEY (`id`),";
    };
    //----------------------------------------------------------------分类
    if ( getN( $col_list, 'sys_id_zu' ) < 0 ) {
        $sql .= "`sys_id_zu` varchar(200)  DEFAULT NULL COMMENT '分类,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_id_zu', 'sys_id_zu', '分类,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'varchar(200)','', 'changbeizhu');
    };
    //----------------------------------------------------------------分支
    if ( getN( $col_list, 'sys_id_fz' ) < 0 ) {
        $sql .= "`sys_id_fz` int(5)  DEFAULT NULL COMMENT '分支,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_id_fz', 'sys_id_fz', '分支,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'int(5)','', 'changbeizhu');
    };
    //----------------------------------------------------------------公司ID
    if ( getN( $col_list, 'sys_yfzuid' ) < 0 ) {
        $sql .= "`sys_yfzuid` varchar(50)  CHARACTER SET utf8 DEFAULT NULL COMMENT '公司ID,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_yfzuid', 'sys_yfzuid', '公司ID,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'varchar(50)','', 'changbeizhu');
    };
    //----------------------------------------------------------------[系统]编号
    if ( getN( $col_list, 'sys_bh' ) < 0 ) { //编号
        $sql .= "`sys_bh` int(11) DEFAULT NULL COMMENT '编号,50,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_bh', 'sys_bh', '[系统]编号,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'int(11)','', 'changbeizhu');
    };
    //----------------------------------------------------------------[系统]字头
    if ( getN( $col_list, 'sys_zt' ) < 0 ) {
        $sql .= "`sys_zt` varchar(10)  CHARACTER SET utf8 DEFAULT NULL COMMENT '[系统]字头,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_zt', 'sys_zt', '[系统]字头,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'varchar(10)','', 'changbeizhu');
    };
    //----------------------------------------------------------------[系统]字头编号
    if ( getN( $col_list, 'sys_zt_bianhao' ) < 0 ) {
        $sql .= "`sys_zt_bianhao` int(11) DEFAULT NULL COMMENT '字头编号,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_zt_bianhao', 'sys_zt_bianhao', '[系统]字头编号,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'int(11)','', 'changbeizhu');
    };
    //----------------------------------------------------------------[系统]自动编号
    if ( getN( $col_list, 'sys_nowbh' ) < 0 ) {
        $sql .= "`sys_nowbh` varchar(50)  CHARACTER SET utf8 DEFAULT NULL COMMENT '自动编号,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_nowbh', 'sys_nowbh', '[系统]自动编号,80,0,1,1,1,1,0,0,0,0,0,0,0,0', 'varchar(150)','', 'changbeizhu');
    };
    //----------------------------------------------------------------回收ID
    if ( getN( $col_list, 'sys_huis' ) < 0 ) {
        $sql .= "`sys_huis` int(1) DEFAULT '0' COMMENT '回收,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_huis', 'sys_huis', '回收,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'int(1)','0', 'changbeizhu');
    };
    //----------------------------------------------------------------部门ID
    if ( getN( $col_list, 'sys_id_bumen' ) < 0 ) {
        $sql .= "`sys_id_bumen` int(8) DEFAULT NULL COMMENT '部门,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_id_bumen', 'sys_id_bumen', '部门,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'int(8)','0', 'changbeizhu');
    };
    //----------------------------------------------------------------网络显示
    if ( getN( $col_list, 'sys_web_shenpi' ) < 0 ) {
        $sql .= "`sys_web_shenpi` int(1) DEFAULT '0' COMMENT '网络显示,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_web_shenpi', 'sys_web_shenpi', '网络显示,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'int(1)','0', 'changbeizhu');
    };
    //----------------------------------------------------------------创建时间
    if ( getN( $col_list, 'sys_adddate' ) < 0 ) {
        $sql .= "`sys_adddate` varchar(50)  DEFAULT NULL COMMENT '创建时间,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_adddate', 'sys_adddate', '创建时间,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'datetime','', 'changbeizhu');
    };
    //----------------------------------------------------------------更新时间
    if ( getN( $col_list, 'sys_adddate_g' ) < 0 ) {
        $sql .= "`sys_adddate_g` varchar(50)  DEFAULT NULL COMMENT '更新时间,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_adddate_g', 'sys_adddate_g', '更新时间,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'datetime','', 'changbeizhu');
    };
    //----------------------------------------------------------------编制人工号
    if ( getN( $col_list, 'sys_id_login' ) < 0 ) {
        $sql .= "`sys_id_login` int(8) DEFAULT NULL COMMENT '编制人ID,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_id_login', 'sys_id_login', '编制人ID,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'int(8)','0','changbeizhu');
    };
    //----------------------------------------------------------------编制人
    if ( getN( $col_list, 'sys_login' ) < 0 ) {
        $sql .= ",`sys_login` varchar(50)  CHARACTER SET utf8 DEFAULT NULL COMMENT '编制人,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_login', 'sys_login','编制人,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'varchar(50)','', 'changbeizhu');
    };
    //----------------------------------------------------------------审核情况
    if ( getN( $col_list, 'sys_shenpi' ) < 0 ) {
        $sql .= "`sys_shenpi` varchar(255) DEFAULT NULL COMMENT '审核,80,0,0,20,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_shenpi', 'sys_shenpi', '审核,80,0,0,20,0,0,0,0,0,0,0,0,0,0', 'varchar(255)','', 'changbeizhu');
    };
    //----------------------------------------------------------------批准情况
    if ( getN( $col_list, 'sys_shenpi_all' ) < 0 ) {
        $sql .= "`sys_shenpi_all` varchar(255) DEFAULT NULL COMMENT '批准,80,0,0,22,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_shenpi_all', 'sys_shenpi_all', '批准,80,0,0,22,0,0,0,0,0,0,0,0,0,0', 'varchar(255)','', 'changbeizhu');
    };
    //----------------------------------------------------------------经办人
    if ( getN( $col_list, 'sys_chaosong' ) < 0 ) {
        $sql .= "`sys_chaosong` varchar(255)  CHARACTER SET utf8 DEFAULT NULL COMMENT '经办人,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_chaosong', 'sys_chaosong', '经办人,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'varchar(255)','', 'changbeizhu');
    };
    //----------------------------------------------------------------排序
    if ( getN( $col_list, 'sys_paixu' ) < 0 ) {
        $sql .= "`sys_paixu` int(8) DEFAULT NULL COMMENT '排序,80,0,0,1,0,0,0,0,0,0,0,0,0,0',";
    } else {
        //ziduan_edit_Modular( $Table_Name, 'sys_paixu', 'sys_paixu', '排序,80,0,0,1,0,0,0,0,0,0,0,0,0,0', 'int(8)','0','changbeizhu');
    };
    if ( $sql ) {
        $sql = move_arrynull( $sql );
        $sql = "alter table `$Table_Name` add ($sql)";
        $connect -> query($sql);
    };
    //exit();
    //echo $sql;

} //function end


//-----[ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan]-----
//[ok]================================================================================================== [ziduan] 查询字段是否有，没有时便创建
function GuanXiziduan_add( $re_id, $re_id_02 ) {
    //Field[字段名] Type【】Collation Null Key Default Extra          Privileges                       Comment
    //id           int(11) NULL     NO   PRI  NULL   auto_increment select,insert,update,references

    if($re_id_02){
        $Table_Name = Find_tablename( $re_id ); //根据re_id查询到表名
        $Table_Name02 = Find_tablename( $re_id_02 ); //根据re_id查询到表名
        if ( $Table_Name != $Table_Name02 ) { //不为自身表关系自身表
            //-------------------------------------------------------------[关系字段添加]
            $colCNname = Find_table_CNname_fromre_id( $re_id );
            $colname = 'sys_gx_id_' . $re_id; //关系自动生成字段
            $colCNname = '[关系]' . $colCNname . 'ID'; //关系表id
            $connect = Changedb( $Table_Name02 ); //依据表自动选择数据库
            IsNullExit( $Table_Name02 ); //为空时停止往下执行。

            $sql = "SHOW FULL COLUMNS FROM `$Table_Name02` where Field='$colname' ";
            echo $Table_Name02;
            $rs = $connect -> query($sql);
            if ( $connect -> numRows($rs['result']) < 1 ) { //没有查询到时
                $sql = "alter table `$Table_Name02` add `$colname` int(11) NULL DEFAULT NULL COMMENT '{$colCNname},80,0,0,1,0,0,0,0,0,0,0,0,0,0' ";
                $connect -> query($sql);
            }
            Jilu_update_Modular( 'sys_guanxibiao', " `sys_re_id`='$re_id' and `sys_re_id_02`='$re_id_02' ", 'sys_nowid_guanxi_col', $colname, $connect ); //查询到对应关系表的值更新

            //-------------------------------------------------------------[关系字段统计]
            $col_count_CNname = Find_table_CNname_fromre_id( $re_id_02 );
            $col_count_name = 'sys_count_' . $re_id_02; //关系自动生成字段
            $col_count_CNname = 'Σ. ' . $col_count_CNname; //统计总数
            $connect = Changedb( $Table_Name ); //依据表自动选择数据库
            IsNullExit( $Table_Name ); //为空时停止往下执行。

            $sql = "SHOW FULL COLUMNS FROM `$Table_Name` where Field='$col_count_name' ";
            $rs = $connect -> query($sql);

            if ( $connect -> numRows( $rs['result'] ) < 1 ) { //没有查询到时
                $sql = "alter table `$Table_Name` add `$col_count_name` int(11) DEFAULT NULL COMMENT '{$col_count_CNname},80,0,0,1,0,0,0,0,0,0,0,0,0,0' ";
                $connect -> query($sql);
            }
        }
    }else{
        echo '##re_id_02==null##';
    }

    //更新记录模版里的对应表
} //function end
//[ok]=========================================================================更新字段时更新关系表
function change_colname_guanxibiao( $nowre_id, $colname, $newcolname ) { //change_colname_guanxibiao($nowre_id,更改前字段,新字段名)
    //--------------------更新原关系表
    global $Conn;
    $Arr2text_all = '';
    $sql = "select id,sys_GuanXiZDList From `sys_guanxibiao` where `sys_huis`=0 and `sys_re_id`='$nowre_id'"; //查询到原关系表
    //echo $sql;
    $rs = mysqli_query( $Conn, $sql );
    while ( $row = mysqli_fetch_array( $rs ) ) {
        $sys_GuanXi_id = $row[ 'id' ]; //查询关系id
        $sys_GuanXiZDList = $row[ 'sys_GuanXiZDList' ]; //查询关系清单
        if ( $sys_GuanXiZDList . '1' != '1' ) { //判断更新后的值与原值不同时执行更新
            $Arr_ziduan = $A2_ziduan = $i = $Arr2text = $Arr2 = '';
            $Arr_ziduan = explode( ',', $sys_GuanXiZDList );
            $countArry = count( $Arr_ziduan );
            for ( $i = 0; $i < $countArry; $i++ ) {
                $Arr2 = explode( '=', $Arr_ziduan[ $i ] );
                if ( $Arr2[ 0 ] == $colname ) {
                    $A2_ziduan .= $newcolname . '=' . $Arr2[ 1 ] . ','; //当找到时更新
                } else {
                    $A2_ziduan .= $Arr_ziduan[ $i ] . ',';
                }
            }
            $Arr2text = trim( $A2_ziduan, ',' ); //得到更新后的数组
            //以下可批量修改这个数据
            $sql2 = "UPDATE `sys_guanxibiao`  set  `sys_GuanXiZDList`='$Arr2text'  where id=$sys_GuanXi_id "; //更新SQL
            //echo $sqls;
            mysqli_query( $Conn, $sql2 );

        }
        //$Arr2text_all.=$Arr2text.'<br>';
    }
    //return $Arr2text_all;	
    mysqli_free_result( $rs ); //释放内存

    //--------------------更新被关系表
    $sql = "select id,sys_GuanXiZDList From `sys_guanxibiao` where `sys_huis`=0 and  `sys_re_id_02`='$nowre_id'"; //查询到被关系表
    //return $sql;
    $rs = mysqli_query( $Conn, $sql );
    while ( $row = mysqli_fetch_array( $rs ) ) {
        $sys_GuanXi_id = $row[ 'id' ]; //查询关系id
        $sys_GuanXiZDList = $row[ 'sys_GuanXiZDList' ]; //查询关系清单
        if ( $sys_GuanXiZDList . '1' != '1' ) { //判断更新后的值与原值不同时执行更新
            $Arr_ziduan = $A2_ziduan = $i = $Arr2text = $Arr2 = '';
            $Arr_ziduan = explode( ',', $sys_GuanXiZDList );
            $countArry = count( $Arr_ziduan );
            for ( $i = 0; $i < $countArry; $i++ ) {
                $Arr2 = explode( '=', $Arr_ziduan[ $i ] );
                if ( $Arr2[ 1 ] == $colname ) {
                    $A2_ziduan .= $Arr2[ 0 ] . '=' . $newcolname . ','; //当找到时更新
                } else {
                    $A2_ziduan .= $Arr_ziduan[ $i ] . ',';
                }
            }
            $Arr2text = trim( $A2_ziduan, ',' ); //得到更新后的数组
            //以下可批量修改这个数据
            $sql2 = "UPDATE `sys_guanxibiao`  set  `sys_GuanXiZDList`='$Arr2text'  where id=$sys_GuanXi_id "; //更新SQL
            //echo $sqls;
            mysqli_query( $Conn, $sql2 );
        }
        //$Arr2text_all.=$Arr2text.'<br>';
    }
    //return $Arr2text_all;	
    mysqli_free_result( $rs ); //释放内存

    //--------------------修改字段时    更新sys_fenye表
    $sql = "select id,sys_fenye From `sys_fenye` where `sys_re_id`='$nowre_id'"; //查询到被关系表
    //return $sql;
    $rs = mysqli_query( $Conn, $sql );
    while ( $row = mysqli_fetch_array( $rs ) ) {
        $sys_GuanXi_id = $row[ 'id' ]; //查询关系id
        $sys_GuanXiZDList = $row[ 'sys_fenye' ]; //查询关系清单
        $sys_GuanXiZDList = str_replace( ":" . $colname . ",", ":" . $newcolname . ",", $sys_GuanXiZDList );
        $sys_GuanXiZDList = str_replace( "," . $colname . ",", "," . $newcolname . ",", $sys_GuanXiZDList );
        //$sys_GuanXiZDList=str_replace("world","Shanghai",$sys_GuanXiZDList);
        $sql2 = "UPDATE `sys_fenye`  set  `sys_fenye`='$sys_GuanXiZDList'  where id=$sys_GuanXi_id "; //更新SQL
        //echo $sql2;
        mysqli_query( $Conn, $sql2 );
    }
    //return $Arr2text_all;	
    mysqli_free_result( $rs ); //释放内存

} //function end


//[ok]================================================================================================== [ziduan] 添加字段名称、类型、备注
function ziduan_add_Modular( $Table_Name, $colname, $colsType, $colbeizhu, $morenzhi = '' ) { //$Table_Name表名,colname添加的字段名,colsType添加的字段类型
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库

    IsNullExit( $Table_Name ); //为空时停止往下执行。
    $nowlower = strtolower( $colsType );
    echo strpos( $nowlower, 'char' ) . '_' .strpos( $nowlower, 'text' );
    if ( strpos( $nowlower, 'char' ) !== false or strpos( $nowlower, 'text' ) !== false ) { //当为文本框形式时设定为utf-8
        $nowutf8 = "CHARACTER SET utf8";
    } else {
        $nowutf8 = '';
    };
    if ( '1' . $morenzhi <> '1' ) { //当有默认值时
        $morenzhi = " DEFAULT '" . $morenzhi . "'";
    };
    $sqlstr = "`" . $colname . "` " . $colsType . " " . $nowutf8 . " " . $morenzhi . " COMMENT '" . $colbeizhu . "'";
    $sql = "alter table `" . $Table_Name . "` add (" . $sqlstr . ")";
    echo $sql;

    if ( SYS_str( $colname ) == 0 ) { //当为0时不为系统字段 1代表为系统字段
        //echo $sql;
        $connect -> query($sql);
    };
} //function end


//[ok]================================================================================================== [ziduan] 修改字段相关属性【可改表名】【备注】$changbeizhu='changbeizhu',强行让备注执行
function ziduan_edit_Modular( $Table_Name , $colname, $newcolname = '', $zdbeizhu = '', $colsType = '', $coldefault = '', $changbeizhu = '' ) {
    global $xt_m_ziduan;
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    $zdbeizhuYuan = $zdbeizhu;
    $Y_colsType = $colsType;
    $Y_coldefault = $coldefault;
    IsNullExit( $Table_Name ); //为空时停止往下执行。'
    //($Table_Name表名,$colname旧字段名,$newcolname新字段名,$colbeizhu字段说明，$colsType类型,$coldefault默认值,$changbeizhu为空表示不修改) 
    if ( '1' . $newcolname == '1' ) {
        $newcolname = $colname;
    }; //当没有新表名时，修改后的表名为原表名

    if ( $colname and $colname != '' ) {
        $zdbeizhu1 = ziduan_search_leixin( $Table_Name, $colname, 'Comment' );
        $zdbeizhu2 = colbeizhu( $zdbeizhu1, $colname ); //格式化检查,0,0,0,0,50,0,0,
        if ( '1' . $zdbeizhu == '1' || continstr( $zdbeizhuYuan, ',' ) <= 13) {
            $zdbeizhu = $zdbeizhu2; //规换成新内容
        }
        $colsType_yuan = ziduan_search_leixin( $Table_Name, $colname, 'Type' );
        $colKey = ziduan_search_leixin( $Table_Name, $colname, 'Key' ); //查询到字段主键 
        $colNull = ziduan_search_leixin( $Table_Name, $colname, 'Null' ); //查询到字段主键 
        if ( getN( $xt_m_ziduan, $colname ) >= 0 ) { //判断字段是否为系统默认字段
            $colsType = $colsType_yuan;
        } else {
            $colsType = msc_inputtype_value( textN( $zdbeizhu, 4, ',' ), '' ); //样式VarChar(100）
        }
        if ( $coldefault == '' ) { //不为修改备注时，查询并保持原有备注
            $coldefault = ziduan_search_leixin( $Table_Name, $colname, 'Default' );
        } else {
            $coldefault = " DEFAULT '$coldefault'";
        }

        if ( $changbeizhu == 'changbeizhu' ) { //强行改变 当为'changbeizhu'确定要直接更改时
            if ( $Y_coldefault == '' ) {
                $coldefault = " DEFAULT NULL ";
            } else {
                $coldefault = " DEFAULT '$Y_coldefault' ";
            }

        } else {
            $coldefault = " DEFAULT NULL ";
        };
        //echo $coldefault;
        if ( $colKey == 'pri' && $colNull == 'no' ) {
            $coldefault = " NOT NULL AUTO_INCREMENT";
        } elseif ( $colKey != 'pri' && $colNull == 'no' ) {
            $coldefault = " NOT NULL ";
        }
        // echo $changbeizhu;
        //$sql = "ALTER TABLE `" . $Table_Name . "` CHANGE " . $colname . " " . $newcolname . " " . $colsType . " " . $coldefault . " comment '" . $zdbeizhu . "'"; //查询到字段属性;
        //echo $sql;
        //------------------------------------------------------------以下先改备注，保持原类型；解决有时候在修改类型不成功时，备注仍可变
        if ( SYS_str( $colname ) === 0 ) { //非系统字段 可以改表名
            // echo 123;
            $sql = "ALTER TABLE `$Table_Name` MODIFY COLUMN `$colname` $colsType_yuan COMMENT '$zdbeizhu'"; //查询到字段属性;
            $connect -> query($sql);
            $sql2 = "ALTER TABLE `$Table_Name` MODIFY COLUMN `$newcolname` $colsType COMMENT '$zdbeizhu'"; //查询到字段属性;
            $connect -> query($sql2);
            // echo 123;
        } else { //系统字段
            if ( $changbeizhu == 'changbeizhu' ) { //强行改变 当为'changbeizhu'确定要直接更改时
                $sql = "ALTER TABLE `$Table_Name` CHANGE `$colname` `$colname` $Y_colsType COMMENT '$zdbeizhuYuan'"; //查询到字段属性;
            } else {
                $sql = "ALTER TABLE `$Table_Name` CHANGE `$colname` `$colname` $colsType COMMENT '$zdbeizhu'"; //查询到字段属性;
            }
            // echo $sql;
            $connect -> query($sql);
            // echo json_encode($connect);
            // echo 456;
        };
        //------------------------------------------------------------更新
        if ( $colname != $newcolname ) { //当更改字段名称时
            $nowre_id = Tablename_Find_re_id( $Table_Name ); //依据表名查询到re_id
            change_colname_guanxibiao( $nowre_id, $colname, $newcolname );
            // echo 789;
        }
    }

} //function end
//[ok]================================================================================================== [ziduan]【备注专改单选】
function ziduan_beizhu_Modular( $Table_Name , $colname, $colbeizhuvlue , $colid ) { //12为手机锁定列
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    //echo "手机执行";
    //echo $colbeizhuvlue;
    if ( '1' . $Table_Name != '1' ) {
        $sql = "SHOW FULL COLUMNS FROM `$Table_Name` "; //检查所有字段
        //echo $sql;
        $rs = $connect -> query($sql);
        if ( $rs ) { //当有记录时
            while ( $row = mysqli_fetch_array( $rs ) ) {
                $zd_en_name = $row[ 'Field' ]; //字段名
                $zdbeizhu = $row[ 'Comment' ]; //备注
                $zdbeizhu = colbeizhu( $zdbeizhu, $zd_en_name ); //格式化检查,0,0,0,0,50,0,0,
                $zdbeizhu = updateN( $zdbeizhu, 12, 0, ',' ); //全部改成0
                //echo $zdbeizhu;
                ziduan_edit_Modular( $Table_Name, $colname, '', $zdbeizhu, '', '' ); //这里更新备注实现单选
            }
        }
        //sleep(1);
        ziduan_edit_Modular( $Table_Name, $colname, '', $colbeizhuvlue, '', '' ); //这里更新备注实现单选

    };

} //function end


//[ok]================================================================================================== [ziduan]【字段调整位置】
function ZiDuan_PaiXu( $Table_Name, $colname, $tocolnext, $weizhi = 'AFTER' ) {
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    //echo "手机执行";
    //echo $colbeizhuvlue;
    if ( '1' . $Table_Name != '1' ) {
        $colsType = ziduan_search_leixin( $Table_Name, $colname, 'Type' ); //查询到字段类型varchar(50)
        $zdbeizhu = ziduan_search_leixin( $Table_Name, $colname, 'Comment' ); //Comment
        $coldefault = ziduan_search_leixin( $Table_Name, $colname, 'Default' ); //DEFAULT   NULL

        //ziduan_search_leixin( $Table_Name, $colname, 'Default' )
        //Field[字段名] Type【】Collation Null Key Default Extra          Privileges                       Comment
        //id           int(11) NULL     NO   PRI  NULL   auto_increment select,insert,update,references 
        $colKey = strtolower( ziduan_search_leixin( $Table_Name, $colname, 'Key' ) ); //Key
        $colNull = strtolower( ziduan_search_leixin( $Table_Name, $colname, 'Null' ) ); //Null为空属性   NULL


        if ( '1' . $coldefault <> '1' ) {
            $coldefault = " DEFAULT '$coldefault'";
        } elseif ( $colKey == 'pri' && $colNull == 'no' ) {
            $coldefault = " NOT NULL AUTO_INCREMENT";
        } elseif ( $colKey != 'pri' && $colNull == 'no' ) {
            $coldefault = " NOT NULL ";
        } else {
            $coldefault = " DEFAULT NULL ";
        }; //当不为空默认值时

        //$sql="alter table $Table_Name modify $colname  $colsType  after $tocolnext";      //将$colname插入$tocolnext后面
        if ( strtolower( $weizhi ) == 'after' ) {
            $sql = "ALTER TABLE `$Table_Name` CHANGE `$colname` `$colname` $colsType  $coldefault COMMENT '$zdbeizhu' AFTER `$tocolnext`";
        } elseif ( strtolower( $weizhi ) == 'first' ) {
            $sql = "ALTER TABLE `$Table_Name` CHANGE `$colname` `$colname` $colsType  $coldefault COMMENT '$zdbeizhu' FIRST";
        }

        //echo $sql;
        $connect -> query($sql);

    }
} //function end


//function end
//[ok]================================================================================================== [ziduan] 删除字段模块不含系统字段
function ziduan_del_Modular( $Table_Name , $colname ) { //$Table_Name表名,$fieldsname字段名
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    IsNullExit( $Table_Name ); //为空时停止往下执行。
    if ( SYS_str( $colname ) == 0 ) { //当为0时不为系统字段 1代表为系统字段
        $sql = "ALTER TABLE `" . $Table_Name . "` DROP COLUMN `" . $colname . "` ";
        //echo $sql;
        $connect -> query($sql);
    } else {
        echo "系统字段，禁止删除";
    };

} //function end

//[ok]================================================================================================== [ziduan] 删除字段模块包含系统字段
function ziduan_del_Modular_all( $Table_Name , $colname ) { //$Table_Name表名,$fieldsname字段名
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    IsNullExit( $Table_Name ); //为空时停止往下执行。
    $sql = "ALTER TABLE `" . $Table_Name . "` DROP COLUMN `" . $colname . "` ";
    //echo $sql;
    $connect -> query($sql);

} //function end


//-----[ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan][ziduan]-----

//[ok]======================================================================================================添加单条记录
function Jilu_add_Modular( $Table_Name , $sys_postzd_list, $sys_postvalue_list ) { //$Table_Name表名,更新字段$sys_postzd_list
    global $hy, $bh, $SYS_UserName, $const_id_fz, $const_id_bumen;
    // echo $Table_Name;
    // echo '###1#####';
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    // echo '###2#####';

    IsNullExit( $Table_Name ); //为空时停止往下执行。
    // echo $sys_postzd_list.'_---_';
    $sys_postzd_list = trim( $sys_postzd_list, "," );
    // echo $sys_postzd_list.'_---_';


    $sys_postvalue_list = trim( $sys_postvalue_list, "," );
    //Table_SYS_Ziduan_CuShi( $Table_Name ); //这里初始化系统字段
    //$r_zt='GK';                              //查询到该表的字头
    //$r_zt_bianhao='1';                      //查询到该表的字头编号
    // echo 123;
    //--------------------------------------以下为查询到自动编号
    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where mdb_name_SYS='$Table_Name' ";
    // echo $sql;
    $rs = $connect -> query($sql);
    $r_zt_bianhao = 0;
    $r_zt = '';
    if($row = mysqli_fetch_array( $rs['result'] )){
        $r_zt = $row[ 'sys_zt' ]; //设定的字头
        //if($r_zt.'1'=='1'){ $r_zt=0 };
        $r_zt_bianhao = $row[ 'sys_zt_bianhao' ]; //设定的字头
    }

    //--------------------------------------以下为查询到自动编号
    $sql = "select MAX(sys_bh) AS sys_bh From `$Table_Name` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
    // echo $sql;
    $rs = $connect -> query($sql);
    $nowrscount = $connect -> numRows( $rs['result'] ); //统计数量
    $row = mysqli_fetch_array( $rs['result'] );
    if ( $nowrscount == 0 ) {
        $bh_y = $r_zt_bianhao;
    } else {
        $bh_y = $row[ 'sys_bh' ] + 1; //编号+1
    };
    $nowbh = $r_zt . $bh_y;
    $sys_postzd_list = trim( $sys_postzd_list, ',' );
    // echo $sys_postvalue_list.'___';
    $sys_postvalue_list = trim( $sys_postvalue_list, ',' );
    // echo $sys_postvalue_list.'___';
    $nowdata = date( 'Y-m-d H:i:s' );
    // echo $sys_postzd_list;
    $sys_postzd_list = "$sys_postzd_list,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate"; //加上系统默认值
    $sys_postvalue_list = "$sys_postvalue_list,'$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata'";
    // echo $sys_postvalue_list;
    //--------------------------------------以下为执行添加
    $sqlADD = "insert into `$Table_Name` ($sys_postzd_list) values ($sys_postvalue_list)";

    // echo 123;
    // echo $sqlADD;
    $connect -> query($sqlADD);
    // echo 123;
    //这里执行检查是否有同步的列
    $now_add_id = ADD_Col_id( $Table_Name, $sys_postzd_list, $sys_postvalue_list ); //查询添加的id
    //==========================================================查询到添加的id值
    // echo( $now_add_id );
    // echo 123;


} //function end


//[ok]======================================================================================================更新单、多条记录全部更新
function Jilu_update_Modular( $Table_Name , $wheretext, $Xcoid, $Xcoid_txt ) { //$Table_Name表名,$Ycoid,原字段$Ycoid_txt,原字段值$Xcoid,更新字段$Xcoid_txt更新值
    global $Conn,$Connadmin;
    $connect = ChangeConn( $Table_Name ); //依据表自动选择数据库

    IsNullExit( $Table_Name ); //为空时停止往下执行。

    //$nowdata = Tongji_table_rows( $Table_Name, $wheretext ); //这里查询是否有该条记录
    //if ( $nowdata <= 0 ) { //查询没有记录时0
    //Jilu_add_Modular( $Table_Name, $Xcoid, $Xcoid_txt); //这里执行添加
    //};

    $nowdate = date( 'Y-m-d H:i:s' );
    //以下为修改字段类型时执行
    if ( $Xcoid == 'zd_xianshi_input_id' ) { //当为修改权限表 并且修改的是字段类型时
        $sql = "select * From  $Table_Name where $wheretext"; //查询到对应记录
        $rs = mysqli_query($connect,$sql);
        $row = mysqli_fetch_array( $rs);
        $nx_zd_xianshi_input_id = $row[ 'zd_xianshi_input_id' ]; //得到zd_xianshi_input_id
        $nx_re_id = $row[ 're_id' ];
        $nx_mdb_name = $row[ 'mdb_name' ];
        $nx_zd_en_name = $row[ 'zd_en_name' ];
        $nx_zd_cn_name = $row[ 'zd_cn_name' ];
        mysqli_free_result( $rs ); //释放内存
        //查询到需修改的类型参数
        $sql2 = "select * From  `msc_inputtype` where id='$nx_zd_xianshi_input_id'"; //查询到对应记录
        $rs2 = mysqli_query($Connadmin,$sql2);
        $row2 = mysqli_fetch_array( $rs2);
        $msc_dataleixin = $row2[ 'dataleixin' ]; //得到dataleixin
        $msc_Moren = $row2[ 'Moren' ]; //得到Moren
        //以下为修改字段类型
        ziduan_edit_Modular( $nx_mdb_name, $nx_zd_en_name, $nx_zd_en_name, $nx_zd_cn_name, $msc_dataleixin, $msc_Moren ); //修改字段


    };
    $sql = "UPDATE  `$Table_Name`  set `$Xcoid` ='$Xcoid_txt',`sys_adddate_g`='$nowdate' WHERE $wheretext ";
    //echo $sql;
    //if ( SYS_str( $Xcoid_txt ) == 0 ) { //当为0时不为系统字段 1代表为系统字段//检查不为系统字段时执行
    mysqli_query($connect,$sql);
    //};
    if ( $Table_Name == 'sys_jlmb' ) { //当修改sys_jlmb时

    };
    $Table_Name = $sql = '';
} //function end

//[ok]======================================================================================================彻底删除多条记录
function Jilu_del_Modular( $Table_Name , $wheretext ) {
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库

    IsNullExit( $Table_Name ); //为空时停止往下执行。
    if ( $Table_Name == 'sys_jlmb' ) { //这里删除记录模版时删除对应表
        $ENTablename = Find_Col_Value( 'Sys_jlmb', $wheretext, 'mdb_name_SYS' ); //查询到当前记录对应的数据表
        table_del_Modular( $Table_Name ); //彻底删除表名
    };
    $sql = "delete From `$Table_Name` where $wheretext "; //彻底删除记录
    $connect -> query($sql);
} //function end


//[有问题]===========================================================================================初始化Sys_MenuBigClass表中的quanxian列//updata_qx_col('Sys_MenuBigClass','quanxian','id','Sys_Jlmb','Id_MenuBigClass','id');
function updata_qx_col( $Table_Name, $updatecolname, $ziduan, $Table_Name2, $colname, $ziduan2 ) { //$Table_Name表名
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库

    IsNullExit( $Table_Name ); //为空时停止往下执行。
    $sql = 'select * From ' . $Table_Name;
    $rs = $connect -> query($sql);
    while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
        $row[ $updatecolname ] = Searcarryy( $Table_Name2, $colname, $ziduan2, $row[ $ziduan ] );
    };
    //mysqli_query($Conn,$sql);//执行添加与更新
} //function end
//======================================================================================================单条记录里数组更新
function updata_zdarry_col( $Table_Name, $colname, $col_val, $updatecolname, $y_val, $x_val ) { //$Table_Name表名,$colname原字段名,$col_val原字段值,$y_val更新字段,$x_val更新值

    //在记录模版中添加
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库

    IsNullExit( $Table_Name ); //为空时停止往下执行。
    $sql = 'select ' . $updatecolname . " From " . $Table_Name . " where " . $colname . '=' . $col_val;
    $rs = $connect -> query($sql);
    while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
        $nowupdatecolname = $row[ $updatecolname ];
        $row[ $updatecolname ] = updateArryy( $nowupdatecolname, $y_val, $x_val );
    };
    //mysqli_query($Conn,$sql);//执行添加与更新
    mysqli_free_result( $rs ); //释放内存
} //function end
//======================================================================================================指定列记录里数组增减
function updata_qx_zdarry_col( $Table_Name , $updatecolname, $ziduan, $moder, $re_id ) { //$Table_Name表名,$colname原字段名,$col_val原字段值,$y_val更新字段,$x_val更新值
    //在记录模版中添加
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库

    IsNullExit( $Table_Name ); //为空时停止往下执行。
    $moder = intval( $moder );
    $sql = 'select * From ' . $Table_Name . " where id='" . $re_id . "'";
    $rs = $connect -> query($sql);
    while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
        $nowupdatecolname = $row[ $updatecolname ];
        if ( $moder == 0 ) {
            $nowupdatecolname = movetext( $nowupdatecolname, $ziduan ); //去掉指定字段
        } else {
            if ( getN( $nowupdatecolname, $ziduan ) == -1 )$nowupdatecolname = $nowupdatecolname . ',' . $ziduan; //增加指定字段
        };
        $row[ $updatecolname ] = trim( $nowupdatecolname, ',' );
    };
    //mysqli_query($Conn,$sql);//执行添加与更新
    mysqli_free_result( $rs ); //释放内存
} //function end


//[ok]================================================================================================== 注云注册保持一致
function msc_user_reg( $sys_yuangongdanganbiao_id = '1' ) { //
    global $Connadmin, $Conn;
    //----------------------------------------查询到sys_yuangongdanganbiao表的信息
    $sys_yuangongdanganbiao_id = intval( $sys_yuangongdanganbiao_id );
    $sql = "select * from `sys_yuangongdanganbiao` where id='$sys_yuangongdanganbiao_id' "; //查询到当前员工的信息
    //echo $sql;
    $rs = mysqli_query( $Conn, $sql );
    $row = mysqli_fetch_array( $rs );
    $reg_num = $row[ 'sys_yfzuid' ]; //公司注册号
    $SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
    $SYS_GongHao = $row[ 'SYS_GongHao' ]; //工号
    $SYS_PassWord = $row[ 'SYS_PassWord' ]; //密码
    $SYS_ShenFenZheng = $row[ 'SYS_ShenFenZheng' ]; //身份证
    $SYS_ShouJi = $row[ 'SYS_ShouJi' ]; //手机
    $SYS_Email = $row[ 'SYS_Email' ]; //邮箱
    $zzzt = $row[ 'sys_zzzt' ]; //在职状态  0为在职 1为离职
    $web_shenpi = $row[ 'sys_web_shenpi' ]; //云端管理
    mysqli_free_result( $rs ); //释放内存
    //---------------------------------------执行同步

    $sql = "select * From `msc_user_reg` where reg_num='$reg_num' and sys_yuangongdanganbiao_id='$sys_yuangongdanganbiao_id' "; //查询到当前员工的云端信息
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    $countcords = mysqli_num_rows( $rs ); //计数
    $msc_user_reg_id = $row[ 'id' ]; //得到id
    $b_logintime = $row[ 'b_logintime' ]; //得到B时间
    //echo $web_shenpi;
    mysqli_free_result( $rs ); //释放内存

    if ( $web_shenpi == 1 ) {
        ini_set( 'date.timezone', 'Asia/Shanghai' );
        $nowdate = date( 'Y-m-d H:i:s' );
        if ( $countcords == 0 ) { //没有记录时添加
            $sys_postzd_list = "sys_yuangongdanganbiao_id,reg_num,SYS_UserName,SYS_GongHao,SYS_PassWord,SYS_ShenFenZheng,SYS_ShouJi,SYS_Email,sys_zzzt,sys_adddate,sys_web_shenpi"; //加上系统默认值
            $sys_postvalue_list = " '$sys_yuangongdanganbiao_id','$reg_num','$SYS_UserName','$SYS_GongHao','$SYS_PassWord','$SYS_ShenFenZheng','$SYS_ShouJi','$SYS_Email','$zzzt','$nowdate','$web_shenpi' ";
            $sqlADD = "insert into `msc_user_reg` ($sys_postzd_list) values ($sys_postvalue_list)";
            //echo $sqlADD;
            mysqli_query( $Connadmin, $sqlADD ); //执行添加
        } else { //有时记录
            $sql = "UPDATE  `msc_user_reg`  set `reg_num` ='$reg_num',
			`SYS_UserName`='$SYS_UserName',
			`SYS_GongHao`='$SYS_GongHao',
			`SYS_PassWord`='$SYS_PassWord',
			`SYS_ShenFenZheng`='$SYS_ShenFenZheng',
			`SYS_ShouJi`='$SYS_ShouJi',
			`SYS_Email`='$SYS_Email',
			`a_logintime`='$b_logintime',
			`sys_zzzt`='$zzzt',
			`sys_web_shenpi`='$web_shenpi',
			`b_logintime`='$nowdate' WHERE `id` ='$msc_user_reg_id'";
            //echo $sql;
            //mysqli_query( $Connadmin , $sql );
        };
    } else {
        if ( $countcords >= 1 ) { //当有值时执行
            $sql = "delete From `msc_user_reg`  where id='$msc_user_reg_id' ";
            //echo $sql;
            //mysqli_query( $Connadmin , $sql );
        };
    };

}; //function end
//[ok]================================================================================================== 更新对应大类菜单
function Sys_Zu_ZhiWei_bigmenu_updata( $ZhiWei = '' ) {
    global $db_vip, $db;
    IsNullExit( $ZhiWei ); //为空时停止往下执行。
    if ( '1' . $ZhiWei == '1' ) {
        $sql = "select * From msc_zhiwei";
    } else {
        $sql = "select * From msc_zhiwei where id='$ZhiWei'";
    };
    $rs = $db -> query($sql);
    while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
        //echo ($sqlstr)
        $nowZhiWeiid = $row[ 'id' ]; //查询到职位id
        $nowquxianall = $row[ 'sys_q_cak' ] . "," . $row[ 'sys_q_tianj' ] . "," . $row[ 'sys_q_xiug' ] . "," . $row[ 'sys_q_shenghe' ] . "," . $row[ 'sys_q_pizhun' ] . "," . $row[ 'sys_q_zhixing' ] . "," . $row[ 'sys_q_shanc' ] . "," . $row[ 'sys_q_dayin' ] . "," . $row[ 'sys_q_huis' ] . "," . $row[ 'sys_q_xiaohui' ] . "," . $row[ 'sys_q_seid' ]; //查询到让你有的权限并连接起来

        $nowquxianall = move_arrynull( QuChong( $nowquxianall ) ); //去重复+去空值
        //echo $nowquxianall;
        if ( '1' . $nowquxianall != '1' ) {
            $sql2 = 'select id,quanxian From  Sys_MenuBigClass';
            $rs2 = $db_vip -> query($sql2);
            //$nowrscount2 = mysqli_num_rows( $rs2 ); //统计数量
            $nowidall = '';
            while ( $row2 = mysqli_fetch_array( $rs2['result'] ) ) {
                $nowid2 = $row2[ 'id' ];
                $nowquanxianlist2 = move_arrynull( $row2[ 'quanxian' ] ); //得到大类菜单所有小类菜单清单
                $HAS_arryyid = HAS_arryy( $nowquxianall, $nowquanxianlist2 );
                //echo (" '381', '$nowquanxianlist2' ").'_';
                //echo $nowidall.',';

                if ( $HAS_arryyid == 0 ) { //如果=0没有相同交集元素
                    $nowidall = $nowidall;
                } else {
                    $nowidall .= $nowid2 . ','; //得到大类菜单id集合
                };
            }; //for end
            //echo $nowidall.',';

            $nowidall = move_arrynull( $nowidall, ',' ); //去掉空的一维元素
            //echo ( "'msc_zhiwei','id', '$nowZhiWeiid', 'bigmenu','$nowidall' ");
            Jilu_update_Modular( 'msc_zhiwei', "`id`='$nowZhiWeiid'", 'bigmenu', $nowidall, $db ); ////执行更新
        };
    };
}
//【ok】======================================================================================================以表名和id名 更新父级统计字段
function sys_count_fromdel_updata( $Table_Name, $thisdataid ) {
    $connect = Changedb( $Table_Name ); //依据表自动选择数据库
    if ( '1' . $Table_Name != '1' ) {
        $re_id = Tablename_Find_re_id( $Table_Name ); //查询到当前表的re_id
        $sql = "select * from `$Table_Name`";
        //echo $sql;
        $rs = $connect -> query($sql);
        //$nowrscount=mysqli_num_rows($rs);//统计数量
        if ( $rs ) { //当有记录时
            $finfo = mysqli_fetch_fields( $rs['result'] );
            foreach ( $finfo as $val ) {
                $name = $val->name; //字段名
                if ( SYS_is( $name, 'sys_gx_id_' ) == '1' ) {
                    $parentre_id = preg_replace( '/[^\d]*/', '', $name ); //只取末位数字  得到父级re_id
                    $parentdataid = Find_Col_Value( "$Table_Name", "id='$thisdataid'", "$name" ); //查询值返回
                    if ( $parentdataid > 0 ) {
                        sys_count_updata( $parentre_id, $re_id, $parentdataid ); //更新关系父级统计字段
                    }
                }
            }
        }

    }

}
//【ok】======================================================================================================更新关系父级统计字段

function sys_count_updata( $parentre_id, $re_id, $parentdataid ) {
    $Table_name_parent = Find_tablename( $parentre_id ); //父关系表名
    $Table_name_guanxi = Find_tablename( $re_id ); //关系表名
    //----------------------------------------------------------开始查询关系数据

    $nowrscount = Tongji_table_rows( $Table_name_guanxi, "sys_gx_id_{$parentre_id}='{$parentdataid}' and sys_huis='0'" ); //统计数据
    //echo $nowrscount;
    Jilu_update_Modular( $Table_name_parent, "`id`=$parentdataid", "sys_count_$re_id", $nowrscount, '' );
}

//【ok】======================================================================================================PHP复制文件夹及文件夹内的文件
//1.取被复制的文件夹的名字；
//2.写出新的文件夹的名字；
//3.调用此函数，将旧、新文件夹名字作为参数传递；
//4.如需复制文件夹内的文件，第三个参数传1，否则传0
function xCopy($source, $destination, $child = 1){//用法：
        // xCopy("feiy","feiy2",1):拷贝feiy下的文件到 feiy2,包括子目录
        // xCopy("feiy","feiy2",0):拷贝feiy下的文件到 feiy2,不包括子目录
        //参数说明：
        // $source:源目录名
        // $destination:目的目录名
        // $child:复制时，是不是包含的子目录

        if(!is_dir($source)){
            echo("Error:the $source is not a direction!");
            return 0;
        }

        if(!is_dir($destination)){
            mkdir($destination,0777);
        }

        $handle=dir($source);
        while($entry=$handle->read()) {
            if(($entry!=".")&&($entry!="..")){
                if(is_dir($source."/".$entry)){
                    if($child)
                        xCopy($source."/".$entry,$destination."/".$entry,$child);
                    }
                else{
                    copy($source."/".$entry,$destination."/".$entry);
                }
            }
        }
        //return 1;
    }

?>