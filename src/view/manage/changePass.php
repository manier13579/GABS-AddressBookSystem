<?php
$view = 'manage';
$page = 'changePass';

require_once $_SERVER['DOCUMENT_ROOT'].'/src/nav.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/src/view.php';
?>
<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/view/<?php echo $view.'/'.$page.'.css'; ?>">

<div class="layui-body">
  <div class="layui-row mianbao">
    <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/manage"><span lang="管理"></span></a>
    <span class="layui-icon">&#xe602;</span>
    <a href="javascript:;"><span lang="个人管理"></span></a>
    <span class="layui-icon">&#xe602;</span>
    <a><cite><span lang="更改密码"></span></cite></a>
  </div>
  <div class="wrap">
    <div class="layui-row">
      <form class="layui-form layui-form-pane" action="">
        <div class="layui-form-item">
          <label class="layui-form-label"><span lang="用户ID"></span></label>
          <div class="layui-input-inline">
            <input type="text" name="userid" value="<?php echo $_SESSION['USER_ID']?>" class="layui-input" disabled>
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label"><span lang="原密码"></span></label>
          <div class="layui-input-inline">
            <input type="password" name="old" required lay-verify="required" placeholder="原密码 / Old Password" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label"><span lang="新密码"></span></label>
          <div class="layui-input-inline">
            <input type="password" name="new1" required lay-verify="required" placeholder="新密码 / New Password" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label"><span lang="新密码"></span></label>
          <div class="layui-input-inline">
            <input type="password" name="new2" required lay-verify="required" placeholder="再次输入 / Once Again" autocomplete="off" class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="form"><span lang="修改"></span></button>
            <button id="reset" type="reset" class="layui-btn layui-btn-primary"><span lang="重置"></span></button>
          </div>
        </div>
      </form>
 
    </div>
  </div>
</div>



<script type="text/javascript">
$("a[id='<?php echo $page; ?>']").parent().addClass('layui-this');
//初始化语言
initLang('<?php echo $page; ?>',''+langNow+'');
langPages.push('<?php echo $page;?>');
  
layui.use('form', function(){
  var form = layui.form;
  //监听提交
  form.on('submit(form)', function(data){
    if(data.field.new1==data.field.new2){
      var oldp = data.field.old;
      var newp = data.field.new1;
      ajax = $.ajax({
        url:rootpath+"/src/controller/changePass_controller.php",
        async:true,
        type: 'post',
        data: {oldp,newp},
        beforeSend:function(){
          loadingDiv('load');
        },
        success:function(res){
          loadingDiv('');
          $('#reset').click();
          if(res=='ok'){
            layer.msg('修改成功! / Change Success!');
          }else if(res=='err'){
            layer.msg('原密码错误! / Old Password Wrong!');
          }else{
            layer.msg('修改失败! / Change Fail!');
          }
        }
      });
    }else{
      layer.msg('两次密码不一致! / New Password Mismatch!');
    }
    
    return false;
  });
  
});

</script>
