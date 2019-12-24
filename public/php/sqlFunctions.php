<?php
	//连接数据库
	function mConnectSql(){
		static $conn=null;
		if($conn===null){
			//数据库参数可修改:(host,username,password)
			$conn= mysqli_connect("localhost:3306","root","Maplestory");
			mysqli_query($conn,'use nebula');
			mysqli_query($conn,'set names utf8');
		}
		return $conn;
	}
	
	//数据库语句
	function mQuery($cmd){
		$rs = mysqli_query(mConnectSql(),$cmd);
		//调用日志记录
		if($rs){
			mLog($cmd);
		}
		else{
			mLog($cmd."\n".mysqli_error(mConnectSql()));
		}
		return $rs;
	}
	
	
	//获取表所有行数据
	function mGetAll($tablename){
		$cmd="select * from $tablename";
		$rs=mQuery($cmd);
		if(!$rs){
			return false;
		}
		$data=array();
		while($row=mysqli_fetch_array($rs)){
			$data[]=$row;
		}
		return $data;
	}
	
	//获取指定行数据
	function mGetRow($tablename,$x){
		$cmd="select * from $tablename where $x";
		$rs=mQuery($cmd);
		if(!$rs){
			return false;
		}
		return mysqli_fetch_assoc($rs);
	}
	
	
	//获取所有行数据，自定义sql语句
	function mGetAll_r($r){
		$rs=mQuery($r);
		if(!$rs){
			return false;
		}
		$data=array();
		while($row=mysqli_fetch_array($rs)){
			$data[]=$row;
		}
		return $data;
	}
	
	
	//获取指定行数据，自定义sql语句
	function mGetRow_r($r){
		$rs=mQuery($r);
		if(!$rs){
			return false;
		}
		return mysqli_fetch_assoc($rs);
	}
	
	
	//获取一个指定条件的数量
	function mGetCount($tablename,$x='1'){
		$cmd="select count(*) from $tablename where $x";
		$rs=mQuery($cmd);
		if(!$rs){
			return false;
		}
		return mysqli_fetch_row($rs)[0];
	}
	
	
	//插入行
	function mInsert($tablename,$values){
		$cmd="insert into $tablename values ($values)";
		return mQuery($cmd);
	}
	
	//更改数据
	function mUpdate($tablename,$change,$target){
		$cmd="update $tablename set $change where $target";
		return mQuery($cmd);
	}
	
	//删除数据
	function mDelete($tablename,$x){
		$cmd="delete from $tablename where $x";
		return mQuery($cmd);
	}
	
	//数据库log日志记录
	function mLog($str){
		$filename=dirname(__DIR__).'/SQLlog.txt';
		$log="-----------------------------------------\n".date('Y/m/d H:i:s')."\n".$str."\n-----------------------------------------\n\n";
		file_put_contents($filename,$log,FILE_APPEND);
	}
?>