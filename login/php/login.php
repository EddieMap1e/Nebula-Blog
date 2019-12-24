<?php
	$username=isset($_POST['username'])?htmlspecialchars($_POST['username']):'';
	$password=isset($_POST['password'])?htmlspecialchars($_POST['password']):'';
	$password=md5($password."*NebulA*");
	require('../../public/php/sqlFunctions.php');
	$conn=mConnectSql();
	$data=[];
	if(!$conn){
		$data["status"]="连接数据库失败";
		echo json_encode($data);
		exit;
	}
	$info=mGetRow('user_info',"username='$username'");
	if(!$info)$info=mGetRow('user_info',"mail='$username'");
	if(!$info)$info=mGetRow('user_info',"tel='$username'");
	if(!$info){
		$data["status"]="用户名不存在";
		echo json_encode($data);
		exit;
	}
	if($info['password']!=$password){
		$data["status"]="密码错误";
		echo json_encode($data);
		exit;
	}
	$username=$info['username'];
	$data["status"]="登陆成功";
	$data["userid"]=$info['uid'];
	setcookie('userid',$info['uid'],time()+60*60*24,'/');
	setcookie('username',$username,time()+60*60*24,'/');
	setcookie('password',md5($username."*NebulA*"),time()+60*60*24,'/');
	echo json_encode($data);
?>