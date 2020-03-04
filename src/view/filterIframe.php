<?php
session_start();
?>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/layui/layui.js"></script>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/common.js"></script>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/layui/css/layui.css"/>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/view/filterIframe.css"/>

<div class="wrap">
  <div class="zu-wrap">
    <form class="layui-form" action="">
      <div class="layui-form-item">
        <div class="layui-inline" style="width: 225px;">
          <select name="filterName1">
            <option value="">请选择筛选项</option>
            <option value="filter-zu">组织结构</option>
          </select>
        </div>
        <div class="layui-inline" style="width: 225px;">
          <input type="text" name="filterVal1" class="layui-input">
        </div>
      </div>
    </form>
  </div>
  <div class="layui-btn-group">
    <div class="layui-btn " id="privately"><span lang="筛选"></span></div>
    <div class="layui-btn layui-btn-primary" id="cancel"><span lang="取消"></span></div>
  </div>
</div>
<script>

//初始化layui表单组件
layui.use('form', function(){
  var form = layui.form;
  //初始化语言
  
  initLang('filterIframe','<?php echo $_SESSION['lang']; ?>');
  function initLang(pageName,lang){
    ajax=$.ajax({
      url:rootpath+"/src/controller/lang_controller.php",
      type: 'post',
      async:true,
      data: {
        pageName:pageName,
        lang:lang
      },
      success:function(res){
        res = JSON.parse(res);
        for(i=0;i<res.length;i++){
          $('span[lang="'+res[i]['XuHao']+'"]').html(res[i]['WenZi']);
        }
      }
    });
  }
  
});

//私有按钮点击事件
$('#privately').click(function(){
  //设置cookie给编辑页面使用
  setCookie('zid','');
  //当你在iframe页面关闭自身时
  var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
  parent.layer.close(index); //再执行关闭   
});

//取消按钮点击事件
$('#cancel').click(function(){
  //设置cookie给编辑页面使用
  setCookie('zid','cancel');
  //当你在iframe页面关闭自身时
  var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
  parent.layer.close(index); //再执行关闭   
});



</script>