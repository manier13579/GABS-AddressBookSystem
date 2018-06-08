<?php
require $_SERVER ['DOCUMENT_ROOT'].'/src/common/db.php';

$userid = $_POST['userid'];
$password = md5(md5($_POST['password']));
$lang = $_POST['lang'];

$pass_err_count = 5;
//连接数据库
$con=DbOpen();

$sql = "SELECT * FROM TXL_USER WHERE USER_ID = ? AND PASS= ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $userid, $password);
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();
if($row and $row['FAILED_LOGINS'] < $pass_err_count){
  //登录成功
  $ip = $_SERVER["REMOTE_ADDR"];
  $sql = "update TXL_USER set FAILED_LOGINS = 0, LAST_LOGIN = now(), LAST_IP = '".$ip."' where USER_ID = '".$userid."'";
  DbSelect($con,$sql);
  
  session_start();
  $_SESSION['USER_ID'] = $row['USER_ID'];
  $_SESSION['USER_NAME'] = $row['USER_NAME'];
  $_SESSION['USER_TYPE'] = $row['USER_TYPE'];
  $_SESSION['LANG'] = $lang;
  echo $_SESSION['USER_ID'];
}else{
  //登录失败
  $sql = "select FAILED_LOGINS from TXL_USER where USER_ID = '".$userid."'";
  $result = DbSelect($con,$sql);
  
  $row = mysqli_fetch_array($result);
  if($row['FAILED_LOGINS'] < $pass_err_count){
    echo 'warning';
    $sql = "update TXL_USER set FAILED_LOGINS = FAILED_LOGINS + 1 where USER_ID = '".$userid."'";
    DbSelect($con,$sql);
  }else{
    echo 'err';
  }
}

$stmt->close();
DbClose($con);
?>