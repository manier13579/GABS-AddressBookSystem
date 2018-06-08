<?php 
session_start();
?>
<script type="text/javascript" src="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/layui/layui.js"></script>
<script type="text/javascript" src="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/common.js"></script>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/layui/css/layui.css"/>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/view/manage/userManageIframe.css"/>

<div class="wrap">
  <div class="zu-wrap">
    <form class="layui-form layui-form-pane" action="">
      <div class="layui-form-item">
        <label class="layui-form-label">ID</label>
        <div class="layui-input-inline" style="width:230px !important">
          <input type="text" name="userid" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="密码"></span></label>
        <div class="layui-input-inline" style="width:230px !important">
          <input type="password" name="password" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="用户名"></span></label>
        <div class="layui-input-inline" style="width:230px !important">
          <input type="text" name="username" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="组"></span></label>
        <div class="layui-input-inline" style="width:230px !important">
          <input type="text" name="group" placeholder="" value="" autocomplete="off" class="layui-input">
        </div>
        
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="权限"></span></label>
        <div class="layui-input-inline" style="width:230px !important">
          <select name="permission" lay-verify="">
            <option value=1>user</option>
            <option value=2>admin</option>
          </select>     
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label"><span lang="邮箱"></span></label>
        <div class="layui-input-inline" style="width:230px !important">
          <input type="text" name="email" placeholder="" value="" autocomplete="off" class="layui-input">
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
  
  initLang('userManageIframe','<?php echo $_SESSION['lang'];?>');
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

//添加按钮点击事件
$('#add').click(function(){
  userid = $('input[name="userid"]').val();
  password = $('input[name="password"]').val();
  username = $('input[name="username"]').val();
  permission = $('select[name="permission"]').val();
  email = $('input[name="email"]').val();
  group = $('input[name="group"]').val();
  
  if(userid!=''&&password!=''&&username!=''){
    action = 'add';
    ajax = $.ajax({
      url:rootpath+"/src/controller/userManage_controller.php",
      async:true,
      type: 'post',
      data: {action,userid,password,username,permission,email,group},
      beforeSend:function(){
        loadingDiv('load');
      },
      success:function(res){
        loadingDiv();
        console.log(res);
        if(res=='ok'){
          
          parent.layer.closeAll();
          parent.layer.msg('添加成功 | Add Success');
          parent.tableRef = true;
        }else{
          parent.layer.msg(res);
        }
      }
    });
  }else{
    parent.layer.msg('信息不全 | Please Complete The Form');
  }

  
});

//取消按钮点击事件
$('#cancel').click(function(){
  parent.layer.closeAll();
});

//选择组输入框点击事件 - 弹出组选择窗口
$('input[name="group"]').click(function(){
  //打开组选择弹出层
  parent.layer.open({
    type: 2,
    title: '',
    shade: 0.4,
    area: ['540px','540px'],
    content: rootpath+'/src/view/manage/userManagezuIframe.php',
    end:function(){
      if(getCookie('ztext')=='cancel'){
      }else if(getCookie('ztext')!=''){
        $('input[name="group"]').val(getCookie('ztext'));
      }else{
        $('input[name="group"]').val('');
      }
    }
  }); 
});

</script>