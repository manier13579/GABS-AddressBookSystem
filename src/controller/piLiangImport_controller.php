<?php

require_once dirname(__FILE__).'/../common/path.php';
require_once $rootpath.'/src/common/db.php';
require_once $rootpath.'/src/common/function.php';
session_start(); //开启session
$action = $_POST['action'];

switch ($action) {

//上传事件
case 'upload':
  if (!isset($_POST['roa'])) {
      $roa = [];
  } else {
      $roa = $_POST['roa'];  //获取数据
  }

  for ($i = 0; $i < count($roa); $i++) {  //遍历表单数据
      if (!isset($roa[$i]['姓名']) || $roa[$i]['姓名'] == '') {
          echo 'not';
          break;
      } else {
          //生成1个GUID
          $GUID = com_create_guid();
          $GUID = str_replace('{', '', $GUID);
          $GUID = str_replace('}', '', $GUID);

          $con = DbOpen();
          $sql = 'INSERT INTO txl_jichushuju VALUES ';
          foreach ($roa[$i] as $key => $value) {
              if ($key != '姓名') {
                  $sql = $sql."('".$GUID."','".$roa[$i]['姓名']."','".$key."','".jiami($value)."'),";
              }
          }
          $sql = rtrim($sql, ',');
          //插入权限表为私有
          $sql = $sql.";INSERT INTO txl_guid_quanxian (GUID,USER_ID,QUAN_XIAN,ZU_ID) VALUES ('".$GUID."','".$_SESSION['USER_ID']."','0','');";

          DbMultiSelect($con, $sql);
          DbClose($con);
      }
  }

  echo 'ok';
break;

}
