<?php
	$username=isset($_COOKIE['username'])?htmlspecialchars($_COOKIE['username']):'';
	$password=isset($_COOKIE['password'])?htmlspecialchars($_COOKIE['password']):'';
	$userid=isset($_COOKIE['userid'])?htmlspecialchars($_COOKIE['userid']):'';
	$retdata=[];
	if(md5($username."*NebulA*")!=$password){
		$retdata["nickname"]="登录/注册";
		echo json_encode($retdata);
		exit;
	}
	require("./sqlFunctions.php");
	$conn=mConnectSql();
	if(!$conn){
		echo json_encode("连接数据库失败");
		exit;
	}
	$userdata=mGetRow('user_detail',"uid='$userid'");
	$retdata['nickname']=$userdata['nickname'];
	$retdata['username']=$username;
	$retdata['userid']=$userid;
	$retdata['gender']=$userdata['gender'];
	$retdata['hobby']=$userdata['hobby'];
	$retdata['blogname']=$userdata['blogname'];
	$retdata['motto']=$userdata['motto'];
	$retdata['QQ']=$userdata['QQ'];
	$retdata['location']=$userdata['location'];
	$userdata=mGetRow('user_info',"uid='$userid'");
	$retdata['tel']=$userdata['tel'];
	$retdata['mail']=$userdata['mail'];
	echo json_encode($retdata);
?>