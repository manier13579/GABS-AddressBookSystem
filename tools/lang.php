<?php
require '../common/db.php';
if(!empty($_POST['action'])){
  $action = $_POST['action'];
}else{
  $action = '';
}

switch($action){
  case 'lang':
    
    $YeMianMing = $_POST['YeMianMing'];
    $CN = $_POST['CN'];
    $EN = $_POST['EN'];

    //连接数据库
    $con=DbOpen();
    $sql1 = "insert into TXL_YUYAN values('".$YeMianMing."','CN','".$CN."','".$CN."')";
    $sql2 = "insert into TXL_YUYAN values('".$YeMianMing."','EN','".$CN."','".$EN."')";
    DbSelect($con,$sql1);
    DbSelect($con,$sql2);
    DbClose($con);
  
  break;
}

?>
<script src="<?php $_SERVER ['DOCUMENT_ROOT']?>/js/jquery-1.12.0.min.js"></script>
<script src="<?php $_SERVER ['DOCUMENT_ROOT']?>/js/common.js"></script>
<form class="layui-form" id="form">
  <div class="layui-form-item">
    <label class="layui-form-label">页面名</label>
    <div class="layui-input-block">
      <input type="text" name="YeMianMing" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">CN</label>
    <div class="layui-input-block">
      <input type="text" name="CN" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">EN</label>
    <div class="layui-input-block">
      <input type="text" name="EN" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button type="button" class="layui-btn" id="login">登录</button>
    </div>
  </div>
</form>

<script type="text/javascript">

$('#login').click(function(){
  login();
});

//登录函数
function login(){
  action = 'lang';
  YeMianMing = $('input[name="YeMianMing"]').val();
  CN = $('input[name="CN"]').val();
  EN = $('input[name="EN"]').val();
  ajax = $.ajax({
    url:rootpath+"/tools/lang.php",
    async:false,
    type: 'post',
    data: {YeMianMing,CN,EN,action},
    success:function(msg){
      $('input[name="CN"]').val('');
      $('input[name="EN"]').val('');
    }
  });
}
</script>