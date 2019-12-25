<?php
	$username=$_COOKIE['username'];
	$src=$_FILES['file']['tmp_name'];
	$filename=$_FILES['file']['name'];
	$tmppath="../user/$username/$filename";
	move_uploaded_file($src,"../$tmppath");
	list($src_w, $src_h,$type) = getimagesize("../$tmppath");
	$ret=[];
	$ret['status']='wrong';
	$size=min($src_h,$src_w);
	$percent=min(1,200/$size);
	$new_w=$src_w*$percent;
	$new_h=$src_h*$percent;
	switch($type){
	    case 1:
	        $img = imagecreatefromgif("../$tmppath");//原图片资源
	        break;
	    case 2:
	        $img = imagecreatefromjpeg("../$tmppath");//原图片资源
	        break;
	    case 3:
	        $img = imagecreatefrompng("../$tmppath");//原图片资源
	        break;
	    default:
			echo json_encode($ret);
			exit;
	}
	$dst=ImageCreateTrueColor($new_w,$new_h);
	imagecopyresampled($dst,$img,0,0,0,0,$new_w,$new_h,$src_w,$src_h);
	imagejpeg($dst,"../../user/$username/ProfilePhoto.jpg");
	imagedestroy($img);
	imagedestroy($dst);
	unlink("../$tmppath");
	$ret['status']="ok";
	$ret['path']="../user/$username/ProfilePhoto.jpg";
	echo json_encode($ret);
?>