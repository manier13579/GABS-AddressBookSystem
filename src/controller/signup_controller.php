<?php
require_once dirname(__FILE__).'/../common/path.php';
require_once $rootpath.'/src/common/db.php';

$userid = $_POST['userid'];
$pass = $_POST['pass'];
$usertype = $_POST['usertype'];

//连接数据库
$con=DbOpen();
$sql=DbSelect($con,"select f_signup('".$userid."','".$pass."','".$usertype."')");
$row=mysqli_fetch_row($sql);

if($row[0]=='ok'){
  session_start();
  $_SESSION['userid'] = $userid;
  $_SESSION['usertype'] = $usertype;
  echo $row[0];
}else{
  echo $row[0];
}


DbClose($con);
?>