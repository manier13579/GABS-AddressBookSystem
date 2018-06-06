<?php
require $_SERVER ['DOCUMENT_ROOT'].'/common/db.php';
require $_SERVER ['DOCUMENT_ROOT'].'/common/function.php';
session_start(); //开启session

$oldp = md5(md5($_POST['oldp']));
$newp = md5(md5($_POST['newp']));

$con=DbOpen();
$sql1 = "SELECT PASS FROM TXL_USER WHERE USER_ID = '".$_SESSION['USER_ID']."'";
$result = DbSelect($con,$sql1);
$row = mysqli_fetch_array($result);
DbClose($con);

if($oldp == $row[0]){
  $con=DbOpen();
  $sql2 = "UPDATE TXL_USER SET PASS = '".$newp."' WHERE USER_ID = '".$_SESSION['USER_ID']."'";
  DbSelect($con,$sql2);
  DbClose($con);
  echo 'ok';
}else{
  echo 'err';
}





?>
