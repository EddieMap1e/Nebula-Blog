<?php
	$id=isset($_POST['id'])?$_POST['id']:'';
	require("../../public/php/sqlFunctions.php");
	$conn=mConnectSql();
	if(!$conn){
		echo json_encode("连接数据库失败");
		exit;
	}
	$res=mDelete('article',"art_id='$id'");
	if($res)echo json_encode("ok");
	else echo json_encode("wrong");
?>