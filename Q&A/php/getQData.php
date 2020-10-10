<?php
	$qid=isset($_POST['qid'])?htmlspecialchars($_POST['qid']):'';
	require("../../public/php/sqlFunctions.php");
	$conn=mConnectSql();
	if(!$conn){
		echo json_encode("连接数据库失败");
		exit;
	}
	$data=mGetRow_r("select uid,title,author,content,date,status from q where q_id='$qid'");
	if(!$data)echo json_encode("没有这篇问题");
	else echo json_encode($data);
?>