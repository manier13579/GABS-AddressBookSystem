<?php 
session_start();
?>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/layui/layui.js"></script>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/common.js"></script>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/layui/css/layui.css"/>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/view/manage/zuManageIframe.css"/>

<div class="wrap">
  <div class="zu-wrap">
    <form class="layui-form layui-form-pane" action="">
      <div class="layui-form-item">
        <label class="layui-form-label">ID</label>
        <div class="layui-input-inline" style="width:230px !important">
          <input type="text" name="zuid" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="父节点ID"></span></label>
        <div class="layui-input-inline" style="width:230px !important">
          <input type="text" name="parentid" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="组织结构名"></span></label>
        <div class="layui-input-inline" style="width:230px !important">
          <input type="text" name="zuname" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
      </div>
    </form>
  </div>
  <div class="layui-btn-group">
    <div class="layui-btn" id="add"><span lang="添加"></span></div>
    <div class="layui-btn layui-btn-primary" id="cancel"><span lang="取消"></span></div>
  </div>
</div>
<script>

//初始化layui表单组件
layui.use('form', function(){
  var form = layui.form;
  //初始化语言
  
  initLang('zuManageIframe','<?php echo $_SESSION['lang']; ?>');
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

//修改按钮点击事件
$('#add').click(function(){
  zuid = $('input[name="zuid"]').val();
  parentid = $('input[name="parentid"]').val();
  zuname = $('input[name="zuname"]').val();
  
  action = 'add';
  ajax = $.ajax({
    url:rootpath+"/src/controller/zuManage_controller.php",
    async:true,
    type: 'post',
    data: {
      action:action,
      zuid:zuid,
      parentid:parentid,
      zuname:zuname
    },
    beforeSend:function(){
      loadingDiv('load');
    },
    success:function(res){
      loadingDiv();
      if(res=='ok'){
        parent.layer.closeAll();
        parent.layer.msg('添加成功 | Add Success');
        parent.tableRef = true;
      }else if(res=='notok'){
        parent.layer.msg('ID不能为空 | ID is empty');
      }else{
        parent.layer.msg(res);
      }
    }
  });
  
});

//取消按钮点击事件
$('#cancel').click(function(){
  parent.layer.closeAll();
});


</script>