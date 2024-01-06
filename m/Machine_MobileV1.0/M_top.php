<?php
if ( !isset( $navid ) ) {
	$navid = 0;
};


if ( isset( $_REQUEST[ 'navid' ] ) ) {
	$navid = intval( $_REQUEST[ 'navid' ] );
};


//echo $navid;
//以下为查询到栏目名称
$D_cat_name = '';
?>