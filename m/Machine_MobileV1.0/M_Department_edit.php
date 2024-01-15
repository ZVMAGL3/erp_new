<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Department_Set.php'; //连上参数设定

//================================================================以下为处理数据

if ( isset( $_POST[ 'act' ] ) )$act = $_POST[ 'act' ]; //act
if ( isset( $_REQUEST[ 'id' ] ) )$id = $_REQUEST[ 'id' ]; //id
//echo($_POST[ 'data' ]);

if ( $act == 'edit_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    if ( isset( $_POST[ 'name' ] ) )$name = $_POST[ 'name' ]; //name
    if ( $name . '1' == '1' ) {
        echo "部门名称不能为空！";
    } else {
        $error = null;

        if($idx = array_search($id, $SonBumenIdxList)){
            $parent = $SonBumenList[$idx]['parent'];
            while(true){
                $index = array_search($parent, $SonBumenIdxList);
                if($SonBumenList[$index]['bumenname'] == $name){
                    echo "上级部门已有\"" . $name . "\"。";
                    $error = true;
                    break;
                }else{
                    $parent = $SonBumenList[$index]['parent'];
                    if(!$parent){
                        break;
                    }
                }
            }
        }
        
        if(!$error){
            $parent = $SonBumenList[$idx]['parent'];
            $sql = "SELECT id From `$tablename` where $colsname='$name' and parent = $parent and sys_yfzuid = '$hy' and id <> $id";
            // echo $sql.'_'; 
            $rs = mysqli_query( $Connadmin, $sql );
            $record_count = mysqli_num_rows( $rs ); //统计总记录数
            mysqli_free_result( $rs ); //释放内存
    
            if ( $record_count > 0 ) { //有重复值时
                echo "所在部门已有\"" . $name . "\"。";
                $error = true;
            }
        }

        function sonBumenList($bumen_id) {
            global $Connadmin,$hy,$name;
            $sql = "SELECT id,bumenname From msc_bumenlist where parent = $bumen_id and sys_yfzuid = '$hy'";
            // echo $sql;
            $rs = mysqli_query( $Connadmin, $sql );
            $record_count = mysqli_num_rows( $rs ); //统计总记录数
            if($record_count > 0){
                while($row = mysqli_fetch_array($rs)){
                    $id=$row['id'];
                    $bumenname=$row['bumenname'];
                    if($bumenname == $name){
                        return true;
                    }else{
                        if(sonBumenList($id)){
                            return true;
                        }
                    }
                }
            }
            return false;
        }

        if(!$error){
            if(!sonBumenList($id)){
                // $sql = "
                //     START TRANSACTION;
                //         INSERT INTO msc_bumenlist (bumenname, sys_yfzuid, parent) VALUES ( '$name' , $hy, $bumen );
                //         SET @bumen_id = LAST_INSERT_ID();
                //         INSERT INTO msc_zhiwei (sys_yfzuid, zu, bumen) VALUES ($hy, '". $name ."主任', @bumen_id);
                //         SET @authority_id = LAST_INSERT_ID();
                //     COMMIT;   
                // ";
                // // echo $sql;
                // mysqli_query( $Connadmin, $sql ); //执行添加
                echo "添加成功！"; /*这里只能禁止修改*/            
            }else{
                echo "下属部门已有\"" . $name . "\"。";
                $error = true;
            }
        }
    }
    //echo $name;
} else {
    //查询到相关值

    $sql = $rs = $row = '';
    if ( $id > 0 ) {
        $sql = "select id,$colsname From `$tablename` where id='$id' and sys_yfzuid='$hy' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        //$record_count = mysqli_num_rows( $rs ); //统计总记录数
        $row = mysqli_fetch_array( $rs );
        $name = $row[ $colsname ]; //设定的字头
        mysqli_free_result( $rs ); //释放内存
        mysqli_close( $Connadmin ); //关闭数据库 
    }

    ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="format-detection" content="telephone=no"/>
<title>SQP Certificate Mobile</title>
<link href="theme/style.css" rel="stylesheet" type="text/css"/>
<link href='../../style/menuimage.css' rel='stylesheet' type='text/css' />
</head>

<body>
<div id="wrapper">
    <div id="header"> <a href="<?php echo $phpstart ?>.php?id=<?php echo $id ?>" class="home"></a> <em class="eleft"><?php echo $textsname ?> 修改</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <form autocomplete='off' οnsubmit='return false' οnkeydοwn="if(event.keyCode==13){return false;}">
        <div id='mobanaddbox' class='NowULTable nocopytext' >
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>&nbsp;<?php echo $textsname ?>名称:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='name' id='name' class='addboxinput inputfocus'  value='<?php echo $name ?>' onkeydown="if(event.keyCode == 13){return false;}" />
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            <?php if ( $sys_q_tianj >= 0 ) { //有添加权限时 ?>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'>
                    <input id='SYS_submit' value='提 交' type='button' title='Ctrl+Enter提交' class='button button_ADD' onclick="add_edit_mobile(this,'<?php echo $phpstart ?>_edit.php','edit_mobile','<?php echo $phpstart ?>.php?act=list')"    />
                </li>
            </ul>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'> <font id='editsuccess' class='font_red' ></font></li>
            </ul>
            <?php
            }
            ?>
            <input type='hidden' name='id' id='id' value='<?php echo $id ?>' />
            <input type='hidden' name='act' id='act' value='edit_mobile' />
        </div>
    </form>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>
<?php
}
?>
