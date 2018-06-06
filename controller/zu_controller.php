<?php
require $_SERVER ['DOCUMENT_ROOT'].'/common/db.php';
require $_SERVER ['DOCUMENT_ROOT'].'/common/function.php';
session_start(); //开启session
$action = $_POST['action'];

switch ($action){

//读取组织结构
case 'read':
  $con=DbOpen();
  $sql = "SELECT ZU_ID,PARENT_ID,ZU_NAME FROM TXL_ZU ORDER BY ZU_ID ASC";
  $result = DbSelect($con,$sql);
  
  $i = 0;
  while ($row = mysqli_fetch_array($result)) {
    $res[$i] = array (
      'ZU_ID' => $row['ZU_ID'],
      'PARENT_ID' => $row['PARENT_ID'],
      'ZU_NAME' => $row['ZU_NAME']
    );
    $i++;
    
  }
  
  echo json_encode($res);
  DbClose($con);

break;

}
?>
