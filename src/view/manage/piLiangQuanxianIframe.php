<?php 
session_start();
?>
<script type="text/javascript" src="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/layui/layui.js"></script>
<script type="text/javascript" src="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/common.js"></script>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/layui/css/layui.css"/>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/view/manage/piLiangQuanxianIframe.css"/>

<div class="wrap">
  <div class="zu-wrap">
    <form class="layui-form" action="">
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="权限"></span></label>
        <div class="layui-input-inline" style="width:100px !important">
          <input type="checkbox" name="quanxian" lay-filter="quanxian" lay-skin="switch" lay-text="编辑|只读">
        </div>
      </div>
    </form>
  </div>
  <div class="layui-btn-group">
    <div class="layui-btn" id="change"><span lang="修改"></span></div>
    <div class="layui-btn layui-btn-primary" id="cancel"><span lang="取消"></span></div>
  </div>
</div>
<script>

//初始化layui表单组件
layui.use('form', function(){
  var form = layui.form;
  //初始化语言
  
  initLang('piLiangQuanxianIframe','<?php echo $_SESSION['lang'];?>');
  function initLang(pageName,lang){
    ajax=$.ajax({
      url:rootpath+"/src/controller/lang_controller.php",
      type: 'post',
      async:true,
      data: {pageName,lang},
      success:function(res){
        res = JSON.parse(res);
        for(i=0;i<res.length;i++){
          $('span[lang="'+res[i]['XuHao']+'"]').html(res[i]['WenZi']);
        }
      }
    });
  }
  
  var switchStat = false;
  form.on('switch(quanxian)', function(data){
    switchStat = data.elem.checked;
  });  
  //修改按钮点击事件
  $('#change').click(function(){
    var guidArr = parent.guidArr;
    if(switchStat==true){
      switchText = '编辑';
      switchStat = '2';
    }else{
      switchText = '只读';
      switchStat = '1';
    }
    parent.layer.confirm('['+parent.tishi+']<br>--'+'>'+switchText, {
        btn: ['Yes', 'No'],
        time: 0,
        title:'确定修改? - Change?',
      }, function(){
        action = 'quanxian';
        ajax = $.ajax({
          url:rootpath+"/src/controller/piLiang_controller.php",
          async:true,
          type: 'post',
          data: {action,guidArr,switchStat},
          beforeSend:function(){
            loadingDiv('load');
          },
          success:function(res){
            loadingDiv();
            if(res=='ok'){
              parent.layer.closeAll();
              parent.layer.msg('修改权限成功 | Change Success');
              parent.tableRef = true;
            }
          }
        });
      }
    
    );
  });
});



//取消按钮点击事件
$('#cancel').click(function(){
  parent.layer.closeAll();
});


</script>