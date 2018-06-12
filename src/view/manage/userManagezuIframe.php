<?php 
session_start();
?>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/layui/layui.js"></script>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/common.js"></script>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/layui/css/layui.css"/>
<link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/view/manage/userManagezuIframe.css"/>

<div class="wrap">
  <div class="zu-wrap"></div>
  <div class="layui-btn-group">
    <div class="layui-btn layui-btn-primary" id="cancel"><span lang="取消"></span></div>
  </div>
</div>
<script>

//初始化layui表单组件
layui.use('form', function(){
  var form = layui.form;
  //初始化语言
  
  initLang('zuIframe','<?php echo $_SESSION['lang']; ?>');
  function initLang(pageName,lang){
    ajax=$.ajax({
      url:rootpath+"/controller/lang_controller.php",
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
  
  readZu();
  function readZu(){
    action = 'read';
    ajax = $.ajax({
      url:rootpath+"/src/controller/zu_controller.php",
      async:true,
      type: 'post',
      data: {action},
      beforeSend:function(){
        loadingDiv('load');
      },
      success:function(res){
        loadingDiv();
        res = JSON.parse(res);
        if(res!=''){
          for(i=0;i<res.length;i++){
            //console.log(res[i]);
            if(res[i]['ZU_ID']=='0'){
              //显示根节点
              $('.zu-wrap').append('<div class="zu level1" zid="0"><span class="JS-zuConfirm">'+res[i]['ZU_NAME']+'</span></div>');
            }else{
              //将子节点追加到相应的父节点上
              $('div[zid="'+res[i]['PARENT_ID']+'"]').append(
                '<div class="zu level'+res[i]['LEVEL']+'" zid="'+res[i]['ZU_ID']+'">'+
                  '<span class="layui-icon">&#xe7a0;</span>'+
                  '<span class="JS-zuConfirm">'+res[i]['ZU_NAME']+'</span>'+
                '</div>'
              );
            }
            
          }
        }
        //没有子组织的层级浅色显示
        $('.zu').each(function(){
          if($(this).find('div').length == 0){
            $(this).find('.layui-icon').html('&#xe622;');
            $(this).find('.layui-icon').css('color','#ccc');
          }
        });

        //文件夹图标点击事件，展开收起层级
        $('.layui-icon').click(function(e){
          e.stopPropagation();
          if($(this).parent().children('div').css('display')!='none'){
            $(this).parent().children('div').hide();
            $(this).parent().children('.layui-icon').html('&#xe622;');
          }else{
            $(this).parent().children('div').show();
            $(this).parent().children('.layui-icon').html('&#xe7a0;');
          }

        });
        
        //组点击事件
        $('.JS-zuConfirm').click(function(e){
          var self = $(this);
          zid = self.parent().attr('zid');
          zname = self.text();
          ztext = zname+'['+zid+']';
          //设置cookie给编辑页面使用
          setCookie('zid',zid);
          setCookie('ztext',ztext);
          
          //当你在iframe页面关闭自身时
          var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
          parent.layer.close(index); //再执行关闭   
        });
        
      }
    });
    
  }


  
});

//私有按钮点击事件
$('#privately').click(function(){
  //设置cookie给编辑页面使用
  setCookie('ztext','');
  setCookie('zid','');
  //当你在iframe页面关闭自身时
  var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
  parent.layer.close(index); //再执行关闭   
});

//取消按钮点击事件
$('#cancel').click(function(){
  //设置cookie给编辑页面使用
  setCookie('ztext','cancel');
  //当你在iframe页面关闭自身时
  var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
  parent.layer.close(index); //再执行关闭   
});



</script>