<?php
	$nickname=isset($_POST['nickname'])?htmlspecialchars($_POST['nickname']):'';
	$blogname=isset($_POST['blogname'])?htmlspecialchars($_POST['blogname']):'';
	$motto=isset($_POST['motto'])?htmlspecialchars($_POST['motto']):'';
	$gender=isset($_POST['gender'])?htmlspecialchars($_POST['gender']):'';
	$location=isset($_POST['location'])?htmlspecialchars($_POST['location']):'';
	$hobby=isset($_POST['hobby'])?htmlspecialchars($_POST['hobby']):'';
	$QQ=isset($_POST['QQ'])?htmlspecialchars($_POST['QQ']):'';
	$uid=$_COOKIE['userid'];
	if(!$uid){
		echo json_encode("wrong");
		exit;
	}
	require("../../public/php/sqlFunctions.php");
	$conn=mConnectSql();
	if(!$conn){
		echo json_encode("连接数据库失败");
		exit;
	}
	$res=mUpdate('user_detail',"nickname='$nickname',gender='$gender',blogname='$blogname',motto='$motto',hobby='$hobby',location='$location',QQ='$QQ'","uid=$uid");
	$res2=mUpdate('article',"author='$nickname'","uid=$uid");
	$res3=mUpdate('q',"author='$nickname'","uid=$uid");
	$res4=mUpdate('a',"author='$nickname'","uid=$uid");
	if($res&&$res2&&$res3&&$res4)echo json_encode("ok");
	else echo json_encode("wrong");
?>