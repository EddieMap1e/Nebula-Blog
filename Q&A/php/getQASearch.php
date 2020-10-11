<?php
	$keyword=isset($_POST['keyword'])?htmlspecialchars($_POST['keyword']):'';
	require("../../public/php/sqlFunctions.php");
	$conn=mConnectSql();
	if(!$conn){
		echo json_encode("连接数据库失败");
		exit;
	}
    $p=(int)$_POST['page'];
    $limit=($p-1)*9;
    $maxp=floor(mGetCount('q',"title like '%$keyword%' or author like '%$keyword%'")/9)+1;
    $list=mGetAll_r("select q_id,title,author,date,answer,status from q where title like '%$keyword%' or author like '%$keyword%' order by q_id DESC limit $limit,9");
	$list['maxPageNum']=$maxp;
    echo json_encode($list);
?>