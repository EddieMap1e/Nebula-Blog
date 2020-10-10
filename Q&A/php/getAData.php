<?php
	$qid=isset($_POST['qid'])?$_POST['qid']:'';
	require("../../public/php/sqlFunctions.php");
	$conn=mConnectSql();
	if(!$conn){
		echo json_encode("连接数据库失败");
		exit;
	}
    $list=mGetAll_r("select content,author,username from a where qid=$qid order by aid");
    echo json_encode($list);
?>