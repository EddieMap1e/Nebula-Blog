<?php
	$title=isset($_POST['title'])?htmlspecialchars($_POST['title']):'';
	$content=isset($_POST['content'])?$_POST['content']:'';
	$uid=isset($_POST['uid'])?$_POST['uid']:'';
	$art_id=isset($_POST['aid'])?$_POST['aid']:'';
	$content = addslashes($content);
	$title = addslashes($title);
	if(!$uid||!$art_id){
		echo json_encode("用户或文章不存在");
		exit;
	}
	require("../../public/php/sqlFunctions.php");
	$conn=mConnectSql();
	if(!$conn){
		echo json_encode("连接数据库失败");
		exit;
	}
	$is_exited=mGetRow('article',"uid='$uid'&&art_id='$art_id'");
	if(!$is_exited){
		echo json_encode("fuck");
		exit;
	}
	$res=mUpdate("article","title='$title',content='$content',date=current_timestamp","art_id='$art_id'");
	if(!$res)echo json_encode("wrong");
	else echo json_encode("ok");
?>