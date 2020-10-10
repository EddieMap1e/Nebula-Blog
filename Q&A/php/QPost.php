<?php
	$title=isset($_POST['title'])?htmlspecialchars($_POST['title']):'';
	$author=isset($_POST['author'])?htmlspecialchars($_POST['author']):'';
	$content=isset($_POST['content'])?$_POST['content']:'';
	$uid=$_COOKIE['userid'];
	$content = addslashes($content);
	$title = addslashes($title);
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
	$is_exited=mGetRow('q',"uid='$uid'&&title='$title'");
	if($is_exited){
		echo json_encode("same");
		exit;
	}
	$res=mInsert("q","null,'$uid','$title','$content','$author',default,default,default");
	if(!$res)echo json_encode("wrong");
	else echo json_encode("ok");
?>