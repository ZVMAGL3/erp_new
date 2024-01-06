<?php
 include_once( '../../session.php' );                   //接收session信息
 include_once( 'M_quanxian.php' );                      //接收职位权限信息
include_once '../../inc/B_conn.php';
include_once '../../inc/B_connadmin.php';
//接收参数开始

$act =$id=$Tablename=$zdname==$InputType=$thisvale='' ;
//echo $databiao;
//========================================================================================================================接收数据
if ( isset( $_POST[ 'act' ] ) )          $act = htmlspecialchars( $_POST[ 'act' ] );                                   //act
if ( isset( $_POST[ 'id' ] ) )           $id = htmlspecialchars( trim( $_POST[ 'id' ] ) );                         //修改id
if ( isset( $_POST[ 'Tablename' ] ) )    $Tablename = htmlspecialchars( trim( $_POST[ 'Tablename' ] ) );             //表名
if ( isset( $_POST[ 'zdname' ] ) )       $zdname = htmlspecialchars( trim( $_POST[ 'zdname' ] ) );                //字段名
if ( isset( $_POST[ 'sql' ] ) )     			$sql = $_POST[ 'sql' ] ;                             					//字段值

switch ( $act ) {
	case 'edit_Connadmin': //-------------------------------- B_moban_edit.php编辑记录
		edit_Connadmin();
		break;
	case 'mysqli_query_all': 
		mysqli_query_all($sql);
		break;
	case 'mysqli_query_method':
		mysqli_query_all($sql,true);
		break;
	case 'mysqli_query_select':
		mysqli_query_select($sql);
		break;
	default:
		echo '非法指令！';
}

//[ok]=========================================================================================修改记录
function edit_Connadmin() {
	global $Connadmin,$const_id_login,$thisvale,$Tablename,$zdname;
	if ( $const_id_login > 0 ) { //有id时执行修改
		$sql = "UPDATE `$Tablename`  set $zdname='$thisvale'  where const_id_login='$const_id_login'"; //更新SQL
		echo $sql;
		mysqli_query( $Connadmin , $sql ); //执行更新
        mysqli_close( $Connadmin ); //关闭数据库
		//---------------------------更新云端注册信息
	}
}

function mysqli_query_all($sql,$met = false) {
	global $Connadmin;

	$result = mysqli_query($Connadmin, $sql);
	if($met){
		if ($result) {
			$response = array(
				"error" => null,
				"mysqli_insert_id" => mysqli_insert_id($Connadmin)
			);
		} else {
			$response = array(
				"error" => mysqli_error($Connadmin),
				"mysqli_insert_id" => null
			);
		};
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		//  . mysqli_insert_id($Connadmin);

	}
	mysqli_close( $Connadmin ); //关闭数据库

}

function mysqli_query_select($sql){
	global $Connadmin;
	$result = mysqli_query($Connadmin, $sql);
	echo json_encode(mysqli_fetch_assoc($result));
	mysqli_close( $Connadmin ); //关闭数据库
}

?>
