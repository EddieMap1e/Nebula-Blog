<?php
	$content=isset($_POST['content'])?$_POST['content']:'';
	$author=isset($_POST['author'])?$_POST['author']:'';
	$uid=$_COOKIE['userid'];
	$username=$_COOKIE['username'];
	$content = addslashes($content);
	if(!$uid){
		echo json_encode("wrong");
		exit;
	}
	require("../../public/php/sqlFunctions.php");
	$conn=mConnectSql();
	if(!$conn){
		echo json_encode("连接数据库失败");
		exit;
	}
	$res=mInsert("chat","null,'$uid','$username','$author','$content',default");
	if(!$res)echo json_encode("wrong");
	else echo json_encode("ok");
?>