<?php 
session_start();
?>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/layui/layui.js"></script>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/common.js"></script>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/pinyin.js"></script>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/layui/css/layui.css"/>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/view/addIframe.css"/>

<div class="wrap">
  <form class="layui-form layui-form-pane" onsubmit="return false">
    <div class="left">
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="姓名"></span></label>
        <div class="layui-input-inline">
          <input type="text" name="姓名" required  lay-verify="required" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="拼音"></span></label>
        <div class="layui-input-inline">
          <input type="text" name="拼音" required lay-verify="required" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="公司"></span></label>
        <div class="layui-input-inline">
          <input type="text" name="公司" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="手机"></span></label>
        <div class="layui-input-inline">
          <input type="text" name="手机" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="座机"></span></label>
        <div class="layui-input-inline">
          <input type="text" name="座机" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="邮箱"></span></label>
        <div class="layui-input-inline">
          <input type="text" name="邮箱" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="备注"></span></label>
        <div class="layui-input-inline">
          <input type="text" name="备注" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="权限"></span></label>
        <div class="layui-input-inline" style="width:185px !important">
          <input type="text" name="组" placeholder="私有" value="" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-input-inline" style="width:50px !important">
          <input type="checkbox" name="权限" lay-skin="switch" lay-text="编辑|只读" disabled="disabled">
        </div>
      </div>
      <div class="layui-form-item">
        <div class="layui-btn-group button-wrap">
          <button class="layui-btn layui-btn-normal" id="add"><span class="layui-icon">&#xe654;</span><span lang="添加"></span></button>
          <div class="layui-btn layui-btn-primary" id="cancel"><span lang="取消"></span></div>
        </div>
      </div>
    </div>
    
    <div class="right">
      <div class="layui-form-item sex" pane>
        <label class="layui-form-label"><span lang="性别"></span></label>
          <div class="layui-input-inline">
            <input type="radio" name="性别" value="男" title="男" data-lang="男">
            <input type="radio" name="性别" value="女" title="女" data-lang="女">
            <input type="radio" name="性别" value="" title="未知" checked data-lang="未知">
          </div>
      </div>
      <div class="layui-form-item">
        <div class="layui-btn" id="addInfo"><span class="layui-icon">&#xe654;</span><span lang="增加条目"></span></div>
      </div>
    </div>
    
  </form>
  

</div>
<script>

//初始化layui表单组件
layui.use('form', function(){
  var form = layui.form;
  
  //初始化语言
  initLang('addIframe','<?php echo $_SESSION['lang']; ?>');
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
          
          switch(res[i]['XuHao']){
            case '男':
              $('input[data-lang="男"]').attr('title',res[i]['WenZi']);
              form.render('radio');
            break;
            case '女':
              $('input[data-lang="女"]').attr('title',res[i]['WenZi']);
              form.render('radio');
            break;
            case '未知':
              $('input[data-lang="未知"]').attr('title',res[i]['WenZi']);
              form.render('radio');
            break;
            
          }
        }
      }
    });
  }
  
  
  //选择组输入框点击事件 - 弹出组选择窗口
  $('input[name="组"]').click(function(){
    //打开组选择弹出层
    parent.layer.open({
      type: 2,
      title: '',
      shade: 0.4,
      area: ['540px','540px'],
      content: rootpath+'/src/view/zuIframe.php',
      end:function(){
        if(getCookie('ztext')=='cancel'){
        }else if(getCookie('ztext')!=''){
          $('input[name="组"]').val(getCookie('ztext'));
          $('input[name="权限"]').removeAttr('disabled');
        }else{
          $('input[name="组"]').val('');
          $('input[name="权限"]').attr('disabled','disabled');
        }
        form.render();
      }
    }); 
  });
  
  
});

//添加按钮点击事件
$('#add').click(function(){
  if($('input[name="姓名"]').val()!=''&&$('input[name="拼音"]').val()!=''){
    action = 'TianJia';
    formData = $('.layui-form').serialize();
    ajax = $.ajax({
      url:rootpath+"/src/controller/list_controller.php",
      async:true,
      type: 'post',
      data: {
        action:action,
        formData:formData
      },
      beforeSend:function(){
        loadingDiv('load');
      },
      success:function(res){
        loadingDiv();
        if(res=='ok'){
          parent.layer.msg('添加成功');
        }
        //当你在iframe页面关闭自身时
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.tableRef = true;
        parent.layer.close(index); //再执行关闭   
        
      }
    });
  }

});

//取消按钮点击事件
$('#cancel').click(function(){
  //当你在iframe页面关闭自身时
  var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
  parent.layer.close(index); //再执行关闭   
});

//增加条目点击事件
$('#addInfo').click(function(){
  var self = $(this);
  infoHtml = '<div class="layui-form-item addItem">'+
               '<label class="layui-form-label">'+
                 '<input type="text" value="" class="info-input">'+
               '</label>'+
               '<div class="layui-input-inline">'+
                 '<input type="text" name="" placeholder="" value="" autocomplete="off" class="layui-input">'+
               '</div>'+
               '<div class="delBtn"><span class="layui-icon">&#x1006;</span></div>'+
             '</div>';
  self.parent().before(infoHtml);
});

//增加条目-名称输入监听
$('body').on('blur', '.info-input', function(){
  var self = $(this);
  self.parent().parent().find('.layui-input').attr('name',self.val());
  
});

//增加条目-鼠标移入监听-显示删除按钮
$('body').on('mouseover', '.addItem', function(){
  var self = $(this);
  self.find('.delBtn').show();
});
$('body').on('mouseout', '.addItem', function(){
  var self = $(this);
  self.find('.delBtn').hide();
});

//增加条目-删除按钮点击事件
$('body').on('click', '.delBtn', function(){
  var self = $(this);
  self.parent().remove();
});

var inputStat = 0;
//姓名输入监听，拼音同步显示
$('input[name="姓名"]').bind('input propertychange', function() {
  var self = $(this);
  nameVal = $('input[name="姓名"]').val();
  var pinyinRes = '';
  for(i=0;i<nameVal.length;i++){
    
    pinyinRes += getPinyin(nameVal[i]);
    
    function getPinyin(nameVal){
      var res = nameVal;
      for( var key in pinyin){
        if(key==nameVal){
          res = pinyin[key];
        }
      }
      return res;
    }

  }
  $('input[name="拼音"]').val(pinyinRes);
  
});


</script>