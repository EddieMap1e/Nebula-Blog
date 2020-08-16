<?php
	$userid=isset($_POST['uid'])?htmlspecialchars($_POST['uid']):'';
	$retdata=[];
	require("./sqlFunctions.php");
	$conn=mConnectSql();
	if(!$conn){
		echo json_encode("连接数据库失败");
		exit;
	}
	$userdata=mGetRow('user_detail',"uid='$userid'");
	if(!$userdata)echo json_encode("获取用户信息失败");
	$retdata['nickname']=$userdata['nickname'];
	$retdata['gender']=$userdata['gender'];
	$retdata['hobby']=$userdata['hobby'];
	$retdata['blogname']=$userdata['blogname'];
	$retdata['motto']=$userdata['motto'];
	$retdata['QQ']=$userdata['QQ'];
	$retdata['location']=$userdata['location'];
	$userdata=mGetRow('user_info',"uid='$userid'");
	$retdata['tel']=$userdata['tel'];
	$retdata['mail']=$userdata['mail'];
	$retdata['username']=$userdata['username'];
	echo json_encode($retdata);
?>