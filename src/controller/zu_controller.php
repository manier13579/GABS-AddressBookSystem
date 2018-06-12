<?php

require_once dirname(__FILE__).'/../common/path.php';
require_once $rootpath.'/src/common/db.php';
require_once $rootpath.'/src/common/function.php';
session_start(); //开启session
$action = $_POST['action'];

switch ($action) {

//读取组织结构
case 'read':
  $con = DbOpen();
  $sql = 'SELECT ZU_ID,PARENT_ID,ZU_NAME FROM txl_zu ORDER BY ZU_ID ASC';
  $result = DbSelect($con, $sql);

  $i = 0;
  while ($row = mysqli_fetch_array($result)) {
      $res[$i] = [
      'ZU_ID'     => $row['ZU_ID'],
      'PARENT_ID' => $row['PARENT_ID'],
      'ZU_NAME'   => $row['ZU_NAME'],
    ];
      $i++;
  }

  echo json_encode($res);
  DbClose($con);

break;

}
