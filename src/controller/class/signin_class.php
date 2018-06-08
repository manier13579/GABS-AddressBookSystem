<?php
require_once dirname(__FILE__).'/../../common/db.php';

class signin_class{
  public function signin($userid = "",$password = "",$lang = ""){
    $pass_err_count = 5;
    //连接数据库
    $con=DbOpen();

    $sql = "SELECT * FROM TXL_USER WHERE USER_ID = ? AND PASS= ?";
    
    if($stmt = $con->prepare($sql)) {
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
        return $_SESSION['USER_ID'];
      }else{
        //登录失败
        $sql = "select FAILED_LOGINS from TXL_USER where USER_ID = '".$userid."'";
        $result = DbSelect($con,$sql);
        
        $row = mysqli_fetch_array($result);
        if($row['FAILED_LOGINS'] < $pass_err_count){
          return 'warning';
          $sql = "update TXL_USER set FAILED_LOGINS = FAILED_LOGINS + 1 where USER_ID = '".$userid."'";
          DbSelect($con,$sql);
        }else{
          return 'err';
        }
      }

      $stmt->close();
    }else{
      die("Errormessage: ". $con->error);
    }
    
    DbClose($con);
    
    
  }
  
}


?>