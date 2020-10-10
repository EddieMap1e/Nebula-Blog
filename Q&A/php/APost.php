<?php
	$title=isset($_POST['title'])?htmlspecialchars($_POST['title']):'';
	$content=isset($_POST['content'])?$_POST['content']:'';
	$author=isset($_POST['author'])?$_POST['author']:'';
	$qid=isset($_POST['qid'])?$_POST['qid']:'';
	$uid=$_COOKIE['userid'];
	$username=$_COOKIE['username'];
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
	$res=mInsert("a","null,'$uid','$content',default,'$qid','$author','$username'");
	if(!$res)echo json_encode("wrong");
	else {
		$cnt=mGetRow_r("select answer from q where q_id=$qid");
		$cnt=$cnt['answer']+1;
		mUpdate("q","answer='$cnt'","q_id=$qid");
		echo json_encode("ok");
	}
?>