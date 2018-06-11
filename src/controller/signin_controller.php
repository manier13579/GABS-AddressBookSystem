<?php
require_once dirname(__FILE__).'/../common/path.php';
require_once $rootpath.'/src/class/signin_class.php';

$userid = $_POST['userid'];
$password = md5(md5($_POST['password']));
$lang = $_POST['lang'];

$sign = new signin_class;
$response = $sign->signin($userid,$password,$lang);

echo $response;
?>