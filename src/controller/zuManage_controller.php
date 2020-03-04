<?php

require_once dirname(__FILE__).'/../common/path.php';
require_once $rootpath.'/src/common/db.php';
require_once $rootpath.'/src/common/function.php';
session_start(); //开启session
$action = $_POST['action'];

switch ($action) {
//初始化查询列表
case 'init':

  //连接数据库
  $responce = new stdClass();
  $responce->code = 0;

  $con = DbOpen();
  $sql = 'SELECT * FROM txl_zu WHERE ZU_ID <> 0 ORDER BY ZU_ID ASC';
  $result = DbSelect($con, $sql);

  $i = 0;
  $res = [];
  while ($row = mysqli_fetch_array($result)) {
      $res[$i] = [
          'ZU_ID'     => $row['ZU_ID'],
          'PARENT_ID' => $row['PARENT_ID'],
          'ZU_NAME'   => $row['ZU_NAME'],
      ];
      $i++;
  }

  $responce->data = $res;
  echo json_encode($responce);
  DbClose($con);
break;

//保存事件
case 'save':
  if (!isset($_POST['table1Data'])) {
      $tableData = [];
  } else {
      $tableData = $_POST['table1Data'];  //获取表格数据
  }

  for ($i = 0; $i < count($tableData); $i++) {  //遍历表单数据
      if (!isset($tableData[$i]['ZU_ID'])) {
          break;
          echo 'not';
      }
      if (!isset($tableData[$i]['PARENT_ID'])) {
          break;
          echo 'not';
      }
      if (!isset($tableData[$i]['ZU_NAME'])) {
          break;
          echo 'not';
      }

      $sql2 = "
      UPDATE txl_zu SET 
      PARENT_ID = '".$tableData[$i]['PARENT_ID']."',
      ZU_NAME = '".$tableData[$i]['ZU_NAME']."'
      WHERE ZU_ID = '".$tableData[$i]['ZU_ID']."' 
    ";
      $con = DbOpen();
      DbSelect($con, $sql2);
      DbClose($con);
  }

  echo 'ok';
break;

//删除事件
case 'delete':
  $zuid = $_POST['zuid'];  //获取zuid

  //删除符合zuid的数据
  $sql1 = "DELETE FROM txl_zu WHERE ZU_ID = '".$zuid."'";
  $con = DbOpen();
  DbSelect($con, $sql1);
  DbClose($con);

  echo 'ok';

break;

//添加组事件
case 'add':
  $zuid = $_POST['zuid'];
  $parentid = $_POST['parentid'];
  $zuname = $_POST['zuname'];

  if (!isset($zuid)) {
      break;
      echo 'not';
  }

  //添加到数据库
  $sql1 = "INSERT INTO txl_zu (ZU_ID,PARENT_ID,ZU_NAME) VALUES ('".$zuid."','".$parentid."','".$zuname."')";
  $con = DbOpen();
  DbSelect($con, $sql1);
  DbClose($con);

  echo 'ok';

break;

}
