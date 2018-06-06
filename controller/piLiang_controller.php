<?php
require $_SERVER ['DOCUMENT_ROOT'].'/common/db.php';
require $_SERVER ['DOCUMENT_ROOT'].'/common/function.php';
session_start(); //开启session
$action = $_POST['action'];

switch ($action){
//初始化查询列表
case 'init':
  
  //连接数据库
  $responce = new stdClass();
  $responce->code = 0;
  
  $con=DbOpen();
  $sql1 = "
    SELECT a.GUID,a.XING_MING,a.XIANG_MU,a.NEI_RONG,b.USER_ID,b.QUAN_XIAN,b.ZU_ID,c.ZU_NAME FROM TXL_JICHUSHUJU a
    LEFT JOIN TXL_GUID_QUANXIAN b
    ON a.GUID=b.GUID
    LEFT JOIN TXL_ZU c
    ON b.ZU_ID=c.ZU_ID
    WHERE a.GUID IN (  
      SELECT GUID FROM TXL_GUID_QUANXIAN 
      WHERE USER_ID = '".$_SESSION['USER_ID']."' 
    )
    ORDER BY a.XING_MING ASC
    
  ";
  $result = DbSelect($con,$sql1);

  $i = 0;
  $res = [];
  while ($row = mysqli_fetch_array($result)) {
    $res[$i] = array (
      'GUID' => $row['GUID'],
      'XING_MING' => $row['XING_MING'],
      'XIANG_MU' => $row['XIANG_MU'],
      'NEI_RONG' => jiemi($row['NEI_RONG']),
      'USER_ID' => $row['USER_ID'],
      'QUAN_XIAN' => $row['QUAN_XIAN'],
      'ZU_ID' => $row['ZU_ID'],
      'ZU_NAME' => $row['ZU_NAME']
    );
    $i++;
  }
  
  $j = 0;
  $data = [];
  for($i=0;$i<count($res);$i++){

    if($i>0&&$res[$i]['GUID']!=$res[$i-1]['GUID']){
      $j++;
    }
    
    $data[$j]['GUID'] = $res[$i]['GUID'];  //返回GUID
    $data[$j]['XING_MING'] = $res[$i]['XING_MING'];  //返回姓名
    $data[$j]['USER_ID'] = $res[$i]['USER_ID'];  //返回创建者
    $data[$j]['QUAN_XIAN'] = $res[$i]['QUAN_XIAN'];  //返回权限
    $data[$j]['ZU_ID'] = $res[$i]['ZU_ID'];  //返回组ID
    $data[$j]['ZU_NAME'] = $res[$i]['ZU_NAME'];  //返回组名
    
    if($res[$i]['XIANG_MU']=='手机'){
      $data[$j]['SHOU_JI'] = $res[$i]['NEI_RONG'];  //返回手机
    }else if($res[$i]['XIANG_MU']=='座机'){
      $data[$j]['ZUO_JI'] = $res[$i]['NEI_RONG'];  //返回座机
    }else if($res[$i]['XIANG_MU']=='邮箱'){
      $data[$j]['YOU_XIANG'] = $res[$i]['NEI_RONG'];  //返回邮箱
    }else if($res[$i]['XIANG_MU']=='拼音'){
      $data[$j]['PIN_YIN'] = $res[$i]['NEI_RONG'];  //返回拼音
    }else if($res[$i]['XIANG_MU']=='公司'){
      $data[$j]['GONG_SI'] = $res[$i]['NEI_RONG'];  //返回公司
    }else if($res[$i]['XIANG_MU']=='备注'){
      $data[$j]['BEI_ZHU'] = $res[$i]['NEI_RONG'];  //返回备注
    }
  }

  $responce ->data = $data;
  echo json_encode($responce);
  DbClose($con);
break; 


//保存事件
case 'save':
  if(!isset($_POST['table1Data'])){
    $tableData = [];
  }else{
    $tableData = $_POST['table1Data'];  //获取表格数据
  }
  for($i=0;$i<count($tableData);$i++){  //遍历表单数据
    if(!isset($tableData[$i]["GONG_SI"])){$tableData[$i]["GONG_SI"] = '';}
    if(!isset($tableData[$i]["SHOU_JI"])){$tableData[$i]["SHOU_JI"] = '';}
    if(!isset($tableData[$i]["ZUO_JI"])){$tableData[$i]["ZUO_JI"] = '';}
    if(!isset($tableData[$i]["YOU_XIANG"])){$tableData[$i]["YOU_XIANG"] = '';}
    if(!isset($tableData[$i]["BEI_ZHU"])){$tableData[$i]["BEI_ZHU"] = '';}
    if(!isset($tableData[$i]["ZU_ID"])){$tableData[$i]["ZU_ID"] = '';}
    if(!isset($tableData[$i]["PIN_YIN"])){$tableData[$i]["PIN_YIN"] = '';}
    if($tableData[$i]["ZU_ID"]==''){$tableData[$i]["QUAN_XIAN"] = 0;}
    if($tableData[$i]["ZU_ID"]!=''&&$tableData[$i]["QUAN_XIAN"] != 2){$tableData[$i]["QUAN_XIAN"] = 1;}
    
    if($tableData[$i]['XING_MING']==''){echo 'not';break;}
    
    $sql1 = "
      /*拼音*/
      insert into TXL_JICHUSHUJU (GUID,XING_MING,XIANG_MU,NEI_RONG) VALUES ('".$tableData[$i]['GUID']."','".$tableData[$i]['XING_MING']."','拼音','".jiami($tableData[$i]['PIN_YIN'])."') 
      ON DUPLICATE KEY UPDATE NEI_RONG = '".jiami($tableData[$i]['PIN_YIN'])."';
      
      /*公司*/
      insert into TXL_JICHUSHUJU (GUID,XING_MING,XIANG_MU,NEI_RONG) VALUES ('".$tableData[$i]['GUID']."','".$tableData[$i]['XING_MING']."','公司','".jiami($tableData[$i]['GONG_SI'])."')
      ON DUPLICATE KEY UPDATE NEI_RONG = '".jiami($tableData[$i]['GONG_SI'])."';
      
      /*手机*/
      insert into TXL_JICHUSHUJU (GUID,XING_MING,XIANG_MU,NEI_RONG) VALUES ('".$tableData[$i]['GUID']."','".$tableData[$i]['XING_MING']."','手机','".jiami($tableData[$i]['SHOU_JI'])."')
      ON DUPLICATE KEY UPDATE NEI_RONG = '".jiami($tableData[$i]['SHOU_JI'])."';
      
      /*座机*/
      insert into TXL_JICHUSHUJU (GUID,XING_MING,XIANG_MU,NEI_RONG) VALUES ('".$tableData[$i]['GUID']."','".$tableData[$i]['XING_MING']."','座机','".jiami($tableData[$i]['ZUO_JI'])."')
      ON DUPLICATE KEY UPDATE NEI_RONG = '".jiami($tableData[$i]['ZUO_JI'])."';
      
      /*邮箱*/
      insert into TXL_JICHUSHUJU (GUID,XING_MING,XIANG_MU,NEI_RONG) VALUES ('".$tableData[$i]['GUID']."','".$tableData[$i]['XING_MING']."','邮箱','".jiami($tableData[$i]['YOU_XIANG'])."')
      ON DUPLICATE KEY UPDATE NEI_RONG = '".jiami($tableData[$i]['YOU_XIANG'])."';
      
      /*备注*/
      insert into TXL_JICHUSHUJU (GUID,XING_MING,XIANG_MU,NEI_RONG) VALUES ('".$tableData[$i]['GUID']."','".$tableData[$i]['XING_MING']."','备注','".jiami($tableData[$i]['BEI_ZHU'])."')
      ON DUPLICATE KEY UPDATE NEI_RONG = '".jiami($tableData[$i]['BEI_ZHU'])."';
      
      /*权限表更新(组、权限)*/
      UPDATE TXL_GUID_QUANXIAN SET QUAN_XIAN = '".$tableData[$i]['QUAN_XIAN']."',ZU_ID = '".$tableData[$i]['ZU_ID']."' WHERE GUID = '".$tableData[$i]['GUID']."';
      
      /*姓名*/
      UPDATE TXL_JICHUSHUJU SET XING_MING = '".$tableData[$i]['XING_MING']."' WHERE GUID = '".$tableData[$i]['GUID']."';
    ";
    $con=DbOpen();
    DbMultiSelect($con,$sql1);
    DbClose($con);
  }
  
  echo 'ok';
break;

//删除事件
case 'delete':
  $guidArr = $_POST['guidArr'];  //获取guid数组
  $GUID = implode('\',\'', $guidArr);  //guid数组转字符串

  //删除符合GUID的数据
  $sql1 = "DELETE FROM TXL_JICHUSHUJU WHERE GUID IN ('".$GUID."')";
  $con=DbOpen();
  DbSelect($con,$sql1);
  DbClose($con);
  
  //删除权限数据
  $sql2 = "DELETE FROM TXL_GUID_QUANXIAN WHERE GUID IN ('".$GUID."')";
  $con=DbOpen();
  DbSelect($con,$sql2);
  
  echo 'ok';
  DbClose($con);


break;

//批量修改组事件
case 'zu':
  $guidArr = $_POST['guidArr'];  //获取guid数组
  $zutext = $_POST['zutext'];  //获取组数据
  
  $GUID = implode('\',\'', $guidArr);  //guid数组转字符串
  if($zutext!=''){
    $ZU_ID = substr(explode('[',$zutext)[1], 0, -1);//字符串截取为组id
  }else{
    $ZU_ID = '';
  }
  
  //修改符合GUID的数据
  $sql1 = "UPDATE TXL_GUID_QUANXIAN SET ZU_ID = '".$ZU_ID."' WHERE GUID IN ('".$GUID."')";
  $con=DbOpen();
  DbSelect($con,$sql1);
  DbClose($con);
  
  echo 'ok';

break;

//批量修改权限事件
case 'quanxian':
  $guidArr = $_POST['guidArr'];  //获取guid数组
  $QUAN_XIAN = $_POST['switchStat'];  //获取权限
  
  $GUID = implode('\',\'', $guidArr);  //guid数组转字符串
  
  //修改符合GUID的数据
  $sql1 = "UPDATE TXL_GUID_QUANXIAN SET QUAN_XIAN = '".$QUAN_XIAN."' WHERE GUID IN ('".$GUID."')";
  $con=DbOpen();
  DbSelect($con,$sql1);
  DbClose($con);
  
  echo 'ok';

break;
}
?>
