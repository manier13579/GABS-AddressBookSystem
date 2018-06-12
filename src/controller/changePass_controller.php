<?php

require_once dirname(__FILE__).'/../common/path.php';
require_once $rootpath.'/src/common/db.php';
require_once $rootpath.'/src/common/function.php';
session_start(); //开启session

$oldp = md5(md5($_POST['oldp']));
$newp = md5(md5($_POST['newp']));

$con = DbOpen();
$sql1 = "SELECT PASS FROM txl_user WHERE USER_ID = '".$_SESSION['USER_ID']."'";
$result = DbSelect($con, $sql1);
$row = mysqli_fetch_array($result);
DbClose($con);

if ($oldp == $row[0]) {
    $con = DbOpen();
    $sql2 = "UPDATE txl_user SET PASS = '".$newp."' WHERE USER_ID = '".$_SESSION['USER_ID']."'";
    DbSelect($con, $sql2);
    DbClose($con);
    echo 'ok';
} else {
    echo 'err';
}
