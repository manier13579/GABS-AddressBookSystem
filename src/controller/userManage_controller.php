<?php
require $_SERVER ['DOCUMENT_ROOT'].'/src/common/db.php';
require $_SERVER ['DOCUMENT_ROOT'].'/src/common/function.php';
session_start(); //开启session
$action = $_POST['action'];

switch ($action){
//初始化查询列表
case 'init':
  
  //连接数据库
  $responce = new stdClass();
  $responce->code = 0;
  
  $con=DbOpen();
  $sql = "SELECT a.*,b.ZU_ID,c.ZU_NAME FROM TXL_USER a
          LEFT JOIN TXL_USER_ZU b
          ON a.USER_ID = b.USER_ID
          LEFT JOIN TXL_ZU c
          ON b.ZU_ID = c.ZU_ID
          ORDER BY a.USER_ID ASC";
  $result = DbSelect($con,$sql);

  $i = 0;
  $res = [];
  while ($row = mysqli_fetch_array($result)) {
    $res[$i] = array (
      'USER_ID' => $row['USER_ID'],
      'USER_NAME' => $row['USER_NAME'],
      'USER_TYPE' => $row['USER_TYPE'],
      'FAILED_LOGINS' => $row['FAILED_LOGINS'],
      'LAST_IP' => $row['LAST_IP'],
      'JOIN_DATE' => $row['JOIN_DATE'],
      'LAST_LOGIN' => $row['LAST_LOGIN'],
      'EMAIL' => $row['EMAIL'],
      'ZU_ID' => $row['ZU_ID'],
      'ZU_NAME' => $row['ZU_NAME'],
      'ZU' => $row['ZU_NAME'].' ['.$row['ZU_ID'].']'
    );
    $i++;
  }

  $responce ->data = $res;
  echo json_encode($responce);
  DbClose($con);
break; 


//编辑事件
case 'edit':
  $userid = $_POST['userid'];  
  $password = md5(md5($_POST['password']));
  $username = $_POST['username']; 
  $permission = $_POST['permission']; 
  $email = $_POST['email']; 
  $group = $_POST['group']; 
  $group = substr(explode('[',$group)[1], 0, -1);//字符串截取为组id
  
  //添加到数据库
  $sql1 = "UPDATE TXL_USER SET USER_NAME = '".$username."',PASS = '".$password."',USER_TYPE = '".$permission."',EMAIL = '".$email."' WHERE USER_ID = '".$userid."'";
  $con=DbOpen();
  DbSelect($con,$sql1);
  DbClose($con);

  //添加到数据库用户组表
  $sql2 = "UPDATE TXL_USER_ZU SET ZU_ID = '".$group."' WHERE USER_ID = '".$userid."'";
  $con=DbOpen();
  DbSelect($con,$sql2);
  DbClose($con);
  
  echo 'ok';
break;

//删除事件
case 'delete':
  $userid = $_POST['userid'];  //获取userid

  //删除符合zuid的数据
  $sql1 = "DELETE FROM TXL_USER WHERE USER_ID = '".$userid."'";
  $con=DbOpen();
  DbSelect($con,$sql1);
  DbClose($con);
  
  echo 'ok';


break;

//添加用户事件
case 'add':
  $userid = $_POST['userid'];  
  $password = md5(md5($_POST['password']));
  $username = $_POST['username']; 
  $permission = $_POST['permission']; 
  $email = $_POST['email']; 
  $group = $_POST['group']; 
  $group = substr(explode('[',$group)[1], 0, -1);//字符串截取为组id
  
  //添加到数据库
  $sql1 = "INSERT INTO TXL_USER (USER_ID,USER_NAME,PASS,USER_TYPE,EMAIL,JOIN_DATE) VALUES ('".$userid."','".$username."','".$password."','".$permission."','".$email."',now())";
  $con=DbOpen();
  DbSelect($con,$sql1);
  DbClose($con);
  
  //添加到数据库用户组表
  $sql2 = "INSERT INTO TXL_USER_ZU (USER_ID,ZU_ID) VALUES ('".$userid."','".$group."')";
  $con=DbOpen();
  DbSelect($con,$sql2);
  DbClose($con);
  
  echo 'ok';

break;

}
?>