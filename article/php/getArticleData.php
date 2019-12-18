<?php
	$artid=isset($_POST['artid'])?htmlspecialchars($_POST['artid']):'';
	require("../../public/php/sqlFunctions.php");
	$conn=mConnectSql();
	if(!$conn){
		echo json_encode("连接数据库失败");
		exit;
	}
	$data=mGetRow_r("select title,author,content,date from article where art_id='$artid'");
	if(!$data)echo json_encode("没有这篇文章");
	else {
		$ret=[];
		$ret['title']=$data['title'];
		$ret['author']=$data['author'];
		$ret['content']=$data['content'];
		$ret['date']=$data['date'];
		echo json_encode($ret);
	}
?>