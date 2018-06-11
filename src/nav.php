<?php
session_start();
if(!isset($_SESSION['USER_ID'])){header("Location:/account");}
?>

<html>
<head>
  <title>通讯录系统 - GABS</title>
  <meta http-equiv="content-type" content="text/html" charset="UTF-8">
  <script src="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/jquery-1.12.0.min.js"></script>
	<script type="text/javascript" src="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/layui/layui.js"></script>
  <script src="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/common.js"></script>
  
	<link rel="stylesheet" type="text/css" href="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/js/layui/css/layui.css"/>
	<link rel="stylesheet" type="text/css" href="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/css/custom.css"/>
  <link rel="stylesheet" href="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/css/nav.css">
  
  <link rel="shortcut icon" href="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/images/favicon.ico"type="image/vnd.microsoft.icon">
  <link rel="icon"href="<?php $_SERVER ['DOCUMENT_ROOT']?>/src/images/favicon.ico" type="image/vnd.microsoft.icon">
</head>
<body>
<div class="layui-layout layui-layout-admin">

  <div class="layui-header">
    <ul class="layui-nav" lay-filter="demo">
      <li class="topbar-logo"><span lang="通讯录"></span></li>
      <li class="topbar-logo2">Global Address Book System</li>
      <li class="layui-nav-item" id="index"><a href="<?php $_SERVER ['DOCUMENT_ROOT']?>/"><span lang="首页"></span></a></li>
      <li class="layui-nav-item" id="manage"><a href="<?php $_SERVER ['DOCUMENT_ROOT']?>/manage"><span lang="管理"></span></a></li>
      <li class="layui-nav-item topbar-user">
        <a href=""><i class="layui-icon">&#xe612;</i><?php echo $_SESSION['USER_NAME'];?></a>
        <dl class="layui-nav-child">
          <dd><a href="<?php $_SERVER ['DOCUMENT_ROOT']?>/manage/changePass"><span lang="更改密码"></span></a></dd>
          <dd><a id="exit"><span lang="退出"></span></a></dd>
        </dl>
      </li>
      <li class="layui-nav-item topbar-user">
        <a href=""><span id="langNow">中文</span></a>
        <dl class="layui-nav-child">
          <dd><a href="javascript:;" class="lang" id="CN">中文</a></dd>
          <dd><a href="javascript:;" class="lang" id="EN">English</a></dd>
        </dl>
      </li>
    </ul>
  </div>
</div>

<script type="text/javascript">

layui.use('element', function(){
  var element = layui.element;

});



//鼠标经过用户名
$(".topbar-user").mouseover(function(){
	$(".topbar-user").css("color","#fff");
	$(".topbar-user-menu").width($(".topbar-user").width());
	$(".topbar-user-menu").show();
	$(".topbar-user").mouseout(function(){
    $(".topbar-user").removeAttr("style");
		$(".topbar-user-menu").hide();
	});
});

//禁止超链接被选中变白
$("a").mousedown(function(){
  return false;
});

$("a[id='exit']").click(function(){
  ajax=$.ajax({
    url:rootpath+"/src/controller/logout_controller.php",
    async:true,
    complete:function(){
      parent.location.href = rootpath+'/account';
    }
	});
});

var langPages = ['nav'];
var langNow = '<?php 
if(!isset($_SESSION['lang'])){
  echo 'CN';
}else{
  echo $_SESSION['lang'];
}
?>';

$(".lang").click(function(){
  lang = $(this).attr("id");
  langNow = lang;
  for(i=0;i<langPages.length;i++){
    initLang(langPages[i],lang);
  }
  
});

function initLang(pageName,lang){
  langName = $('#'+lang).html();
  $("#langNow").html(langName);
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
//初始化语言
initLang('nav','<?php echo $_SESSION['lang'];?>');


//监听所有ajax请求
var xhr = new XMLHttpRequest();
window.addEventListener('ajaxReadyStateChange', function (e){
  if(e.detail.readyState==1){loadingDiv('load');}
  else if(e.detail.readyState==2){loadingDiv();}
});
</script>