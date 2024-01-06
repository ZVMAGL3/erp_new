<?php
header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
date_default_timezone_set( 'PRC' );
if ( !session_id() )session_start(); //初始化会话数据
include_once './inc/Function_All.php';
include_once './inc/B_connadmin.php'; //连上注册数据库
$_SESSION['logged_in'] = false;
$cuow = $gh = $SYS_UserName = $nowpassword = $nowtype = $SYS_PassWord = "";
if ( isset( $_SESSION[ "cuow" ] ) ) {
    $cuow = intval( $_SESSION[ "cuow" ] );
}
if ( $cuow == "" )$cuow = 0; //得到错误几次
if ( $_REQUEST[ "action" ] = "login" ) {

    if ( isset( $_POST[ 'username' ] ) ) {
        $SYS_ShouJi = trim( htmlspecialchars( $_POST[ "username" ] ) ); //用户名接收
    }
    if ( isset( $_POST[ 'SYS_PassWord' ] ) ) {
        $nowpassword = trim( strtoupper( md5( htmlspecialchars( $_POST[ "SYS_PassWord" ] ) ) ) ); //密码接收
    }

    if ( isset( $_REQUEST[ 'nowtype' ] ) ) {
        $nowtype = trim( htmlspecialchars( $_REQUEST[ "nowtype" ] ) );

    }

    if ( '1' . $SYS_ShouJi == '1'
        or '1' . $nowpassword == '1' ) {
        echo( "<script>alert('对不起，账号或密码不能为空！');window.history.go(-1)</script>" ); //
        exit();
    };
    if ( $cuow >= 4 ) { //需要验证码时
        $nowcodeinput = intval( $_POST[ "codeinput" ] ); //输入的验证码接收
        $nowY_codeinput = intval( $_POST[ "Y_codeinput" ] ); //生成的原始验证码
        if ( $nowcodeinput != $nowY_codeinput ) {
            echo( "<script>alert('您输入的验证码错误，请重新输入！');window.history.go(-1)</script>" ); //
            exit();
        };
    };

    $query =  "SELECT * FROM `msc_user_reg` WHERE SYS_PassWord= ? AND SYS_ShouJi= ? ";
    $params = array($nowpassword,$SYS_ShouJi);
    $queryResult = $db->query($query, $params);
    if ($queryResult['error'] == null) {
        if ($db->numRows($queryResult['result']) > 0) {
            $error = null;
            $_SESSION['logged_in'] = true; //记录登录状态
            $result = mysqli_fetch_assoc($queryResult['result']);

            $user_id = $_SESSION['user_id'] = $_SESSION['const_id_login'] = $result['id'];
            $SYS_UserName = $_SESSION['SYS_UserName'] = $result['SYS_UserName'];
            $SYS_ShouJi = $_SESSION['SYS_ShouJi'] = $result['SYS_ShouJi'];
            $hy = $_SESSION['hy'] = $result['sys_yfzuid'];
            $sys_web_shenpi = $_SESSION['sys_web_shenpi'] = $result['sys_web_shenpi'];

            if($hy != 0 && $sys_web_shenpi){
                $error = selectQuanXian($hy,$user_id,$db);
            }else{
                $query = "SELECT state,sys_yfzuid FROM msc_user_hy WHERE user_id = ? AND state = 1 ";
                $params = array($user_id);
                $queryResult = $db->query($query, $params);
                if ($queryResult['error'] == null) {
                    echo $user_id;
                    if ($db->numRows($queryResult['result']) > 0) {

                        $result = mysqli_fetch_assoc($queryResult['result']);
                        $hy = $_SESSION['hy'] = $result['sys_yfzuid'];
                        $error = selectQuanXian($hy,$user_id,$db);
                    }
                }
            }
            
            //========================================================================= ip函数
            function get_real_ip(){
                $ip = FALSE;
                //客户端IP 或 NONE
                if ( !empty( $_SERVER[ "HTTP_CLIENT_IP" ] ) ) {
                    $ip = $_SERVER[ "HTTP_CLIENT_IP" ];
                }
                //多重代理服务器下的客户端真实IP地址（可能伪造）,如果没有使用代理，此字段为空
                if ( !empty( $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] ) ) {
                    $ips = explode( ", ", $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] );
                    if ( $ip ) {
                        array_unshift( $ips, $ip );
                        $ip = FALSE;
                    }
                    for ( $i = 0; $i < count( $ips ); $i++ ) {
                        if ( !preg_match( '/^(10│172.16│192.168)./i', $ips[ $i ] ) ) {
                            $ip = $ips[ $i ];
                            break;
                        }
                    }
                }
                //客户端IP 或 (最后一个)代理服务器 IP
                return ( $ip ? $ip : $_SERVER[ 'REMOTE_ADDR' ] );
            }
    
            $getIp = $_SESSION['getIp'] = get_real_ip(); //ip地址
    
            $SYS_HTTP_REFERER = $_SERVER[ "HTTP_REFERER" ]; //来源地址
            $nowdata = date( 'Y-m-d H:i:s' );
            if ( $nowtype == 'pc' ) {
                $P_M = 0;
            } else {
                $P_M = 1;
            }
            $_SESSION['P_M'] = $P_M;
            //========================================================================= 登录记录
            $sql = "";

            $query =  "INSERT INTO `msc_yonghudenglujilu`(SYS_IPDiZhi,sys_id_login,SYS_PC_Mobile)VALUES( ? , ? , ? )";
            $params = array($getIp,$user_id,$P_M?'手机端':'电脑端');
            $queryResult = $db->query($query, $params);
    
            $_SESSION[ "cuow" ] = 0; //初始验证码为0
    
            //========================================================================= 执行更新登录次数
            
            $query = "UPDATE `msc_user_reg` SET SYS_ZD_DengLuCiShu=SYS_ZD_DengLuCiShu+1 where id= ? ";
            $params = array($user_id);
            $queryResult = $db->query($query, $params);
    
            if($error){
                echo $error;
            }else{
                if($hy){
                    if ( $nowtype == 'pc' ) { //当为电脑端时
                        header( "Location:/MachineV1.0/B_main.php" ); //这里打开后台界面
                    }else{
                        header( "Location:m/Machine_MobileV1.0/M_desk.php" ); //这里打开后台界面
                    }
                }else{
                    header( "Location:/MachineV1.0/companyPage.php" ); //打开创建/加入企业页面
                }
            }
        }else{
            echo ("<script>alert('您输入的登录信息有误，请重新输入！');window.history.go(-1)</script>");
            if (isset($_SESSION['cuow'])) {
                $_SESSION['cuow'] += 1;
            } else {
                $_SESSION['cuow'] = 1;
            }
        }
    }else{
        echo ("<script>alert('数据库异常，请重试')</script>");
    }
}

?>
<?php

// header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
// date_default_timezone_set( 'PRC' );
// //ob_start();      	//打开缓冲区
// if ( !session_id() )session_start(); //初始化会话数据
// include_once 'inc/B_connadmin.php'; //连上注册数据库

// $cuow = $hy = $gh = $SYS_UserName = $nowpassword = $nowtype = $SYS_PassWord = "";
// if ( isset( $_SESSION[ "cuow" ] ) ) {
//     $cuow = intval( $_SESSION[ "cuow" ] );
// }
// if ( $cuow == "" )$cuow = 0; //得到错误几次
// //echo $cuow;

// if ( $_REQUEST[ "action" ] = "login" ) {

//     if ( isset( $_POST[ 'username' ] ) ) {
//         $SYS_UserName = trim( htmlspecialchars( $_POST[ "username" ] ) ); //用户名接收
//         setcookie( "username", $SYS_UserName, time() + 360000 ); //这里设定cookie
//     }
//     if ( isset( $_POST[ 'SYS_PassWord' ] ) ) {
//         $SYS_PassWord = trim( htmlspecialchars( $_POST[ "SYS_PassWord" ] ) ); //密码接收
//         $nowpassword = trim( strtoupper( md5( htmlspecialchars( $_POST[ "SYS_PassWord" ] ) ) ) ); //密码接收
//     }

//     if ( isset( $_REQUEST[ 'nowtype' ] ) ) {
//         $nowtype = trim( htmlspecialchars( $_REQUEST[ "nowtype" ] ) ); //用户名接收

//     }


//     if ( '1' . $SYS_UserName == '1'
//         or '1' . $nowpassword == '1' ) {
//         echo( "<script>alert('对不起，用户名或密码不能为空！');window.history.go(-1)</script>" ); //
//         exit();
//     };
//     if ( $cuow >= 4 ) { //需要验证码时
//         $nowcodeinput = intval( $_POST[ "codeinput" ] ); //输入的验证码接收
//         $nowY_codeinput = intval( $_POST[ "Y_codeinput" ] ); //生成的原始验证码
//         if ( $nowcodeinput != $nowY_codeinput ) {
//             echo( "<script>alert('您输入的验证码错误，请重新输入！');window.history.go(-1)</script>" ); //
//             exit();
//         };
//     };

//     //===========================================================================================以下为验证注册用户是否正确
//     $sql = "select * From `msc_user_reg` where SYS_PassWord='$nowpassword' and SYS_ShouJi='$SYS_UserName' "; //用户登录表
//     //echo $sql;
//     $rs = mysqli_query( $Connadmin, $sql );
//     $row = mysqli_fetch_array( $rs );
//     $countrows = mysqli_num_rows( $rs ); //得到数量
//     //离职时执行
//     $const_id_login = $row[ 'id' ]; //员工档案id
//     $bh = $row[ "SYS_GongHao" ]; //工号
//     $web_shenpi = $row[ "sys_web_shenpi" ]; //云端访问权限 0 为禁止 1为允许访问
//     $nowzzzt = intval( $row[ 'SYS_ZD_ZaiZhiZhuangTai' ] ); //在职状态0为在职，1为离职
//     $SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
//     $SYS_ShouJi = $row[ 'SYS_ShouJi' ]; //手机号
//     $hy = $row[ "SYS_reg_num" ]; //公司注册号
//     $hy = $row[ "hy" ]; //公司注册id      51
//     $SYS_QuanXian = $row[ 'SYS_QuanXian' ]; //权限
//     //echo $SYS_QuanXian;
//     //exit();
//     mysqli_free_result( $rs ); //释放内存
//     //===========================================================================================以下为查询到公司信息
//     $sql = "select * From `msc_huiyuan_reg` where id='$hy' "; //公司表
//     //echo $sql;
//     $rs = mysqli_query( $Connadmin, $sql );
//     $row = mysqli_fetch_array( $rs );
//     //$countrows = mysqli_num_rows( $rs ); //得到数量
//     //离职时执行
//     $gongsimingceng = $row[ "gongsimingceng" ]; //公司名
//     //exit();
//     mysqli_free_result( $rs ); //释放内存


//     if ( $countrows == 0 ) { //没有查到相应信息时
//         echo( "<script>alert('您输入的登录信息有误，请重新输入！');window.history.go(-1);</script>" );
//         if ( isset( $_SESSION[ 'cuow' ] ) ) {
//             $_SESSION[ 'cuow' ] = $_SESSION[ 'cuow' ] + 1; //这里记录错的次数+1
//         } else {
//             $_SESSION[ 'cuow' ] = 1; //首次记录时设定为1
//         };

//     } else {
//         //echo ("<script>alert('验证通过');<//script>");//window.history.go(-1);
//         if ( $nowzzzt == 1 ) { //当为离职状态时
//             echo( "<script>alert('对不起，您当前为 离职状态。');window.history.go(-1);</script>" ); //离职提醒
//         } elseif ( $web_shenpi == 0 ) {
//             echo( "<script>alert('对不起，您已被禁止使用云端服务。');window.history.go(-1);</script>" ); //离职提醒
//         } else {
//             //========================================================================= ip函数
//             function get_real_ip()

//             {

//                 $ip = FALSE;

//                 //客户端IP 或 NONE

//                 if ( !empty( $_SERVER[ "HTTP_CLIENT_IP" ] ) ) {

//                     $ip = $_SERVER[ "HTTP_CLIENT_IP" ];

//                 }

//                 //多重代理服务器下的客户端真实IP地址（可能伪造）,如果没有使用代理，此字段为空

//                 if ( !empty( $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] ) ) {

//                     $ips = explode( ", ", $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] );

//                     if ( $ip ) {
//                         array_unshift( $ips, $ip );
//                         $ip = FALSE;
//                     }

//                     for ( $i = 0; $i < count( $ips ); $i++ ) {

//                         if ( !preg_match( '/^(10│172.16│192.168)./i', $ips[ $i ] ) ) {

//                             $ip = $ips[ $i ];

//                             break;

//                         }

//                     }

//                 }

//                 //客户端IP 或 (最后一个)代理服务器 IP

//                 return ( $ip ? $ip : $_SERVER[ 'REMOTE_ADDR' ] );

//             }


//             $getIp = get_real_ip(); //ip地址

//             $SYS_HTTP_REFERER = $_SERVER[ "HTTP_REFERER" ]; //来源地址
//             $nowdata = date( 'Y-m-d H:i:s' );
//             if ( $nowtype == 'pc' ) {
//                 $P_M = '电脑端';
//             } else {
//                 $P_M = '手机端';
//             }
//             //========================================================================= 登录记录
//             $sql = "INSERT INTO `msc_yonghudenglujilu`(SYS_YongHuMing,SYS_ShouJi,SYS_SuoShuGongSi_id,SYS_SuoShuGongSi,SYS_IPDiZhi,SYS_HTTP_REFERER,SYS_DiZhi,SYS_QuanXian,SYS_QuanXian_Name,sys_adddate,sys_adddate_g,sys_id_login,sys_login,sys_yfzuid,sys_huis,SYS_PC_Mobile)VALUES('$SYS_UserName','$SYS_ShouJi','$hy','$gongsimingceng','$getIp','$SYS_HTTP_REFERER','未识别','$SYS_QuanXian','$SYS_QuanXian','$nowdata','$nowdata','$bh','$SYS_UserName','$hy','0','$P_M')";
//             //echo $sql;
//             //exit;
//             mysqli_query( $Connadmin, $sql );


//             $_SESSION[ "bh" ] = $bh; //员工编号  9001
//             $_SESSION[ "SYS_UserName" ] = $SYS_UserName; //姓名     曾小波

//             $_SESSION[ "hy" ] = $hy; //公司号   9007
//             $_SESSION[ "SYS_QuanXian" ] = $SYS_QuanXian; //权限

//             $_SESSION[ "hy" ] = $hy; //拥有公司id
//             $_SESSION[ "const_id_login" ] = $const_id_login; //员工档案id
//             //$_SESSION[ "reg_database" ] = $data_use;                        //使用数据库
//             //echo $hy;

//             //【】========================================================================= SESSION 生成会员登录状态信息
//             $_SESSION[ "cuow" ] = 0; //初始验证码为0

//             //========================================================================= 执行更新登录次数
//             $sqls = "UPDATE `msc_user_reg` SET SYS_ZD_DengLuCiShu=SYS_ZD_DengLuCiShu+1,SYS_a_logintime=SYS_b_logintime,SYS_b_logintime='$nowdata',sys_adddate_g='$nowdata'   where id='$const_id_login'";
//             mysqli_query( $Connadmin, $sqls );
//             //echo $sqls;


//             setcookie( "SYS_PassWord", $SYS_PassWord, time() + 360000 );
//             if ( $nowtype == 'pc' ) { //当为电脑端时
//                 $cache_file = "MachineV1.0/cache/$hy/B_quanxian/B_quanxian_$SYS_QuanXian.php";
//                 $cache_file2 = "MachineV1.0/cache/$hy/B_menu_desk/B_menu_desk_$SYS_QuanXian.php";
//                 $cache_file3 = "m/Machine_MobileV1.0/cache/$hy/M_quanxian/M_quanxian_$SYS_QuanXian.php";
//                 $cache_file4 = "m/Machine_MobileV1.0/cache/$hy/M_menu_desk/M_menu_desk_$SYS_QuanXian.php";
//                 if ( file_exists( $cache_file ) && file_exists( $cache_file2 ) && file_exists( $cache_file3 ) && file_exists( $cache_file4 ) ) { //文件存在时
//                     header( "Location:MachineV1.0/B_main.php" ); //这里打开后台界面
//                 } else {
//                     echo '<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script><script type="text/javascript" src="js/B_login_fnction.js"></script>';
//                     echo "<script>php_Post('$SYS_QuanXian','pc');</script>";
//                 }
//             } else { //手机端时

//                 $cache_file = "MachineV1.0/cache/$hy/B_quanxian/B_quanxian_$SYS_QuanXian.php";
//                 $cache_file2 = "MachineV1.0/cache/$hy/B_menu_desk/B_menu_desk_$SYS_QuanXian.php";
//                 $cache_file3 = "m/Machine_MobileV1.0/cache/$hy/M_quanxian/M_quanxian_$SYS_QuanXian.php";
//                 $cache_file4 = "m/Machine_MobileV1.0/cache/$hy/M_menu_desk/M_menu_desk_$SYS_QuanXian.php";
//                 if ( file_exists( $cache_file ) && file_exists( $cache_file2 ) && file_exists( $cache_file3 ) && file_exists( $cache_file4 ) ) { //文件存在时
//                     header( "Location:m/Machine_MobileV1.0/M_desk.php" ); //这里打开后台界面
//                 } else {
//                     echo '<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
//                       <script type="text/javascript" src="js/B_login_fnction.js"></script>';
//                     echo "<script>php_Post('$SYS_QuanXian','mobile');</script>";
//                 }

//             }


//         }
//     }

// }

// mysqli_close( $Connadmin ); //关闭数据库

?>