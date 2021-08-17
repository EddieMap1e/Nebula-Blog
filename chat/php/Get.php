<?php
	require("../../public/php/sqlFunctions.php");
	$conn=mConnectSql();
	if(!$conn){
		echo json_encode("连接数据库失败");
		exit;
	}
    $list=mGetAll_r("select * from chat");
    echo json_encode($list);
?>