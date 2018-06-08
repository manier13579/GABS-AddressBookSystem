<?php 
session_start();
?>
<script type="text/javascript" src="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/layui/layui.js"></script>
<script type="text/javascript" src="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/common.js"></script>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/layui/css/layui.css"/>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/view/manage/piLiangZuIframe.css"/>

<div class="wrap">
  <div class="zu-wrap">
    <form class="layui-form layui-form-pane" action="">
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="选择组"></span></label>
        <div class="layui-input-inline" style="width:230px !important">
          <input type="text" name="组" placeholder="私有" value="" autocomplete="off" class="layui-input">
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
  
  initLang('piLiangZuIframe','<?php echo $_SESSION['lang'];?>');
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
  
});

//修改按钮点击事件
$('#change').click(function(){
  var guidArr = parent.guidArr;
  zutext = $('input[name="组"]').val();
  parent.layer.confirm('['+parent.tishi+']<br>--'+'>'+zutext, {
      btn: ['Yes', 'No'],
      time: 0,
      title:'确定修改? - Change?',
    }, function(){
      action = 'zu';
      ajax = $.ajax({
        url:rootpath+"/src/controller/piLiang_controller.php",
        async:true,
        type: 'post',
        data: {action,guidArr,zutext},
        beforeSend:function(){
          loadingDiv('load');
        },
        success:function(res){
          loadingDiv();
          if(res=='ok'){
            parent.layer.closeAll();
            parent.layer.msg('修改组成功 | Change Success');
            parent.tableRef = true;
          }
        }
      });
    }
  
  );
});

//取消按钮点击事件
$('#cancel').click(function(){
  parent.layer.closeAll();
});

//选择组输入框点击事件 - 弹出组选择窗口
$('input[name="组"]').click(function(){
  //打开组选择弹出层
  parent.layer.open({
    type: 2,
    title: '',
    shade: 0.4,
    closeBtn:0,
    area: ['540px','540px'],
    content: rootpath+'/src/view/zuIframe.php',
    end:function(){
      if(getCookie('ztext')=='cancel'){
      }else if(getCookie('ztext')!=''){
        $('input[name="组"]').val(getCookie('ztext'));
      }else{
        $('input[name="组"]').val('');
      }
    }
  }); 
});

</script>