<?php
	$pic=$_FILES['editormd-image-file'];
	$status=1;
	$msg="未知原因上传失败啦qwq";
	$url;
	$error=$pic['error'];
	if($error==1){
		$status=0;
		$msg="图片太大啦qwq";
	}
	else if($error==0){
		$name=$pic['name'];
		$url="../../user/".$_COOKIE['username']."/img/".$name;
		$tmp=$pic['tmp_name'];
		if(file_exists($url))
		{
			$status=0;
			$msg="这个名字的图片已经存在啦,在文件地址写上'../user/你的用户名/img/'+文件名使用哦 ovo";
		}
		else{
			move_uploaded_file($tmp,$url);
		}
		$url="../user/".$_COOKIE['username']."/img/".$name;
	}
	else $status=0;
	echo json_encode(array(
	   'success'    => $status, 
	   'url'       => $url,
	   'message'    =>  $msg
	));
?>
