<?php 
session_start();
?>

<html>
<head>
  <title>通讯录系统 - GABS</title>
  <meta http-equiv="content-type" content="text/html" charset="UTF-8">
  <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/jquery-1.12.0.min.js"></script>
	<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/layui/layui.js"></script>
  <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/common.js"></script>
  
	<link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/layui/css/layui.css"/>
	<link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/css/custom.css"/>
	<link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/css/account.css"/>

  <link rel="shortcut icon" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/images/favicon.ico"type="image/vnd.microsoft.icon">
  <link rel="icon"href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/images/favicon.ico" type="image/vnd.microsoft.icon">
</head>

<body>
<div class="info">
  <span>提示：仁和生产系统科的小伙伴可以直接登录，用户名与密码都是工号</span>
</div>

<div class="wrap">
	<div class="layui-row">
		<div class="title"><span lang="通讯录"></span></div>
		<div class="title2">Global Address Book System</div>
    <div class="switch-wrap">
      <div class="switch-button-wrap">
        <span class="switch-button" id="signup"><span lang="注册"></span></span>
        <span class="switch-button active" id="signin"><span lang="登录"></span></span>
        <span class="switch-button-bottom"></span>
      </div>
    </div>
	</div>
	<div class="layui-row tab-signin">
    <div class="group-inputs">
      <div class="account input-wrapper">
        <input name="userid" placeholder="账号 ID" type="text">
      </div>
      <div class="verification input-wrapper">
        <input name="password" placeholder="密码 PASS" type="password">
      </div>
    </div>
    <div class="signin-button"><span lang="登录"></span></div>
    
    
	</div>
  
	<div class="layui-row tab-signup">
    <div class="group-inputs">
      <div class="account input-wrapper">
        <input name="userid" placeholder="账号 ID" type="text">
      </div>
      <div class="verification input-wrapper">
        <input name="password" placeholder="密码 PASS" type="password">
      </div>
      <div class="verification input-wrapper">
        <input name="password2" placeholder="确认密码 CONFIRM PASS" type="password">
      </div>
    </div>
    <div class="signup-button"><span lang="暂未开放"></span></div>
	</div>
  
  
  <div class="layui-row">
    <div class="lang">
      <div class="lang-title">Language</div>
      <form class="layui-form" action="">
        <div class="layui-form-item">
            <select name="lang" lay-verify="required" lay-filter="lang">
              <option value="CN">中文</option>
              <option value="EN">English</option>
            </select>
        </div>
      </form>
    </div>
  </div>
  <div class="layui-row footer">
    <hr class="layui-bg-gray">
    <div class="footer-line">© 2018 MES1 Team License</div>
  </div>
</div>


</body>
</html>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/custom.js"></script>
<script type="text/javascript">

layui.use('form', function(){
  var form = layui.form;
  
  form.on('select(lang)', function(data){
    lang = data.value;
    initLang('account',lang);
  });

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
  var langNow = '<?php 
  if (!isset($_SESSION['lang'])) {
      echo 'CN';
  } else {
      echo $_SESSION['lang'];
  }
  ?>';
  initLang('account',langNow);
  $('select[name="lang"]').val(langNow);
  form.render();
});

//全局回车事件
$(function(){
	document.onkeydown = function(e){
		password = $('#password').val();
		//判断按回车且密码输入框有值时才触发登录事件。
		if(e.keyCode==13&password!=""){
			login();
		}
	}
});   

$('.signin-button').click(function(){
  login();
});

//登录函数
function login(){
  lang = $('select[name="lang"]').val();
  userid = $('input[name="userid"]').val();
  password = $('input[name="password"]').val();
  if(userid==''){
    layer.tips('请填写账号', 'input[name="userid"]',{
      tipsMore: true,
      tips: [2, '#888']
    });
  }
  if(password==''){
    layer.tips('请填写密码', 'input[name="password"]',{
      tipsMore: true,
      tips: [2, '#888']
    });
  }
  if(userid!=''&&password!=''){
    ajax = $.ajax({
      url:rootpath+"/src/controller/signin_controller.php",
      async:false,
      type: 'post',
      data: {userid,password,lang},
      success:function(msg){
        rec = msg.split(",");
        if(rec[0]==userid){
          location.href = rootpath+"/";
        }else if(rec[0]=="warning"){
          layer.msg('账号或密码不正确', {
            icon: 3,
            time: 1500 //1.5秒关闭
          }, function(){
            $('input[name="userid"]').val('');
            $('input[name="password"]').val('');
          });   
        }else if(rec[0]=="err"){
          layer.msg('您的账号已被锁定,请联系管理员', {
            icon: 2,
            time: 1500 //1.5秒关闭
          }, function(){
            $('input[name="userid"]').val('');
            $('input[name="password"]').val('');
          });  
        }else{
          layer.msg("请稍后再试："+rec[0], {
            icon: 4,
            time: 1500 //1.5秒关闭
          }, function(){
            $('input[name="userid"]').val('');
            $('input[name="password"]').val('');
          });  
        }
      }
    });
  }

}

$('.switch-button').click(function(){
  var self = $(this);
  if(self.hasClass('active')){
  }else{
    $('.switch-button').removeClass('active');
    self.addClass('active');
    if($('.switch-button-bottom').css('left')=='77px'){
      $('.switch-button-bottom').css('left','0px');
    }else{
      $('.switch-button-bottom').css('left','77px');
    }
    if(self.attr('id')=='signin'){
      $('.tab-signin').show();
      $('.tab-signup').hide();
    }else{
      $('.tab-signin').hide();
      $('.tab-signup').show();
    }
    
  }

  
});


</script>