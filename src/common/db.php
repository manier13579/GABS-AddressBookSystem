<?php
//直接访问本文件，重定向到首页
if (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1)=="db.php"){
  header("Location:http://".$_SERVER ['HTTP_HOST']);
  exit;
}
//开启数据库连接
function DbOpen()
{
	$host = "127.0.0.1";
	$db_user = "root";
	$db_pass = "root";
	$db_name = "gabs";
	$timezone = "Asia/Beijing";
	$setutf8 = "SET NAMES utf8";

	$con = mysqli_connect($host, $db_user, $db_pass, $db_name);
	//错误处理
	if (!$con)
	  {
	  	die('Could not connect:'.mysqli_error());
	  }
	mysqli_query($con,$setutf8);
	//防止中间路径转换为乱码：client→connection→server
	//http://blog.csdn.net/wzwsj1986/article/details/1723658
	
	//如果连接数据库是使用如下语句：
	//$con = mysqli_connect($host, $db_user, $db_pass);
	//还需要使用下面语句选择数据库
	//mysqli_select_db($con,$db_name);
	
	return $con;
}

//单条sql语句执行
function DbSelect($con,$query)
{
	$sql=mysqli_query($con,$query);
	//错误处理
	if (!$sql) {
		printf("Error: %s\n", mysqli_error($con));
		exit();
	}
	return $sql;
}

//多条sql语句执行
function DbMultiSelect($con,$query)
{
	$sql=mysqli_multi_query($con,$query);
	//错误处理
	if (!$sql) {
		printf("Error: %s\n", mysqli_error($con));
		exit();
	}
	return $sql;
}

//关闭数据库连接
function DbClose($con)
{
	mysqli_close($con);
}

//返回数据量大的查询可以用来清空内存
//mysqli_free_result($sql);

?>