<?php
	$type=isset($_POST['type'])?htmlspecialchars($_POST['type']):'';
	require("../../public/php/sqlFunctions.php");
	$conn=mConnectSql();
	if(!$conn){
		echo json_encode("连接数据库失败");
		exit;
	}
	if($type=="all"){
		$p=(int)$_POST['page'];
		$limit=($p-1)*10;
		$maxp=floor(mGetCount('article')/10)+1;
		$list=mGetAll_r("select art_id,title,author,date from article order by art_id DESC limit $limit,10");
		$list['maxPageNum']=$maxp;
		echo json_encode($list);
	}
	else if($type="my"){
		$uid=$_COOKIE['userid'];
		$p=(int)$_POST['page'];
		$limit=($p-1)*10;
		$maxp=floor(mGetCount('article')/10)+1;
		$list=mGetAll_r("select art_id,title,date from article where uid='$uid' order by art_id DESC limit $limit,10");
		$list['maxPageNum']=$maxp;
		echo json_encode($list);
	}
?>