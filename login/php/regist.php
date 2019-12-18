<?php
	$username=isset($_POST['username'])?htmlspecialchars($_POST['username']):'';
	$password=isset($_POST['password'])?htmlspecialchars($_POST['password']):'';
	$tel=isset($_POST['tel'])?htmlspecialchars($_POST['tel']):'';
	$mail=isset($_POST['mail'])?htmlspecialchars($_POST['mail']):'';
	$password=md5($password."*NebulA*");
	require('../../public/php/sqlFunctions.php');
	$conn=mConnectSql();
	if(!$conn){
		echo "哎呀连接数据库失败了";
		exit;
	}
	$is_exited=mGetRow('user_info',"username='$username'");
	if($is_exited){
		echo "该用户名已存在了呢";
		exit;
	}
	$is_exited=mGetRow('user_info',"mail='$mail'");
	if($is_exited){
		echo "你可以使用该邮箱登录了哦";
		exit;
	}
	$is_exited=mGetRow('user_info',"tel='$tel'");
	if($is_exited){
		echo "你可以使用该邮箱登录了哦";
		exit;
	}
	$res=mInsert('user_info',"null,'$username','$password','$tel','$mail'");
	$res2=mInsert('user_detail',"null,'$username','$username 的小天地','','男','','',''");
	if($res&&$res2){
		mkdir("../../user/$username");
		mkdir("../../user/$username/img")
		$res=copy("../../public/img/defaultProfilePhoto.jpg","../../user/$username/ProfilePhoto.jpg");
		if($res)echo "注册成功";
		else echo "注册成功可是初始化头像失败了qwq";
	}
	else echo "未知错误";
?>