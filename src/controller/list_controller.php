<?php

require_once dirname(__FILE__).'/../common/path.php';
require_once $rootpath.'/src/class/list_class.php';

$action = $_POST['action'];

switch ($action) {
  //初始化查询列表
  case 'init':
    $list = new list_class();
    $response = $list->init();
    echo json_encode($response);
  break;

  //添加事件
  case 'TianJia':
    $formData = urldecode($_POST['formData']);
    $list = new list_class();
    $response = $list->TianJia($formData);
    echo $response;
  break;

  //查看详细事件
  case 'XiangXi':
    $GUID = $_POST['GUID'];
    $list = new list_class();
    $response = $list->XiangXi($GUID);
    echo json_encode($response);
  break;

  //保存事件
  case 'BaoCun':
    $formData = urldecode($_POST['formData']);  //获取表单数据
    $GUID = $_POST['GUID'];  //获取GUID
    $list = new list_class();
    $response = $list->BaoCun($formData, $GUID);
    echo $response;
  break;

  //删除事件
  case 'ShanChu':
    $GUID = $_POST['GUID'];  //获取GUID
    $list = new list_class();
    $response = $list->ShanChu($GUID);
    echo $response;

}
