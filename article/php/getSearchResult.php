<?php
	$keyword=isset($_POST['keyword'])?htmlspecialchars($_POST['keyword']):'';
	require("../../public/php/sqlFunctions.php");
	$conn=mConnectSql();
	if(!$conn){
		echo json_encode("连接数据库失败");
		exit;
	}
    $p=(int)$_POST['page'];
    $limit=($p-1)*12;
    $maxp=floor(mGetCount('article',"title like '%$keyword%' or author like '%$keyword%'")/12)+1;
    $list=mGetAll_r("select art_id,title,author,date from article where title like '%$keyword%' or author like '%$keyword%' order by art_id DESC limit $limit,12");
	$list['maxPageNum']=$maxp;
    echo json_encode($list);
?>