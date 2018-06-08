<?php
$view='manage';
$page='langRegister';

require_once $_SERVER ['DOCUMENT_ROOT'].'/nav.php';
require_once $_SERVER ['DOCUMENT_ROOT'].'/view.php';

require $_SERVER ['DOCUMENT_ROOT'].'/common/db.php';
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
<script src="<?php $_SERVER ['DOCUMENT_ROOT']?>/js/jquery.nicescroll.min.js"></script>
<link rel="stylesheet" href="<?php $_SERVER ['DOCUMENT_ROOT']?>/view/<?php echo $view.'/'.$page.'.css';?>">

<div class="layui-body">
  <div class="layui-row mianbao">
    <a href="<?php $_SERVER ['DOCUMENT_ROOT']?>/manage"><span lang="管理"></span></a>
    <span class="layui-icon">&#xe602;</span>
    <a href="javascript:;"><span lang="系统管理"></span></a>
    <span class="layui-icon">&#xe602;</span>
    <a><cite><span lang="语言注册"></span></cite></a>
  </div>
  <div class="wrap">
    <div class="layui-row">
      <form class="layui-form" id="form">
        <div class="layui-form-item">
          <label class="layui-form-label">Page Name</label>
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
            <button type="button" class="layui-btn" id="login">OK</button>
          </div>
        </div>
      </form>
    </div>
    <div class="layui-row">
      <table class="layui-table" id="table1"></table>
    </div>
  </div>
</div>



<script type="text/javascript">
$("a[id='<?php echo $page;?>']").parent().addClass('layui-this');
//初始化语言
initLang('<?php echo $page;?>',''+langNow+'');
langPages.push('<?php echo $page;?>');

layui.use('form', function(){
  $('#login').click(function(){
    login();
  });

  //登录函数
  function login(){
    action = 'lang';
    YeMianMing = $('input[name="YeMianMing"]').val();
    CN = $('input[name="CN"]').val();
    EN = $('input[name="EN"]').val();
    if(YeMianMing==''||CN==''||EN==''){
      layer.msg('信息不完整！ | Form Not Complate！');
    }else{
      ajax = $.ajax({
        url:rootpath+"/manage/langRegister",
        async:false,
        type: 'post',
        data: {YeMianMing,CN,EN,action},
        beforeSend:function(){
          loadingDiv('load');
        },
        success:function(msg){
          loadingDiv();
          layer.msg('Success');
          $('input[name="CN"]').val('');
          $('input[name="EN"]').val('');
        }
      });
    }

  }
  
  
  
  
});

</script>