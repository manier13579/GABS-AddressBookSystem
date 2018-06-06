<?php
$view='manage';
$page='piLiang';

require_once $_SERVER ['DOCUMENT_ROOT'].'/nav.php';
require_once $_SERVER ['DOCUMENT_ROOT'].'/view.php';
?>
<script src="<?php $_SERVER ['DOCUMENT_ROOT']?>/js/jquery.nicescroll.min.js"></script>
<link rel="stylesheet" href="<?php $_SERVER ['DOCUMENT_ROOT']?>/view/<?php echo $view.'/'.$page.'.css';?>">

<div class="layui-body">
  <div class="layui-row mianbao">
    <a href="<?php $_SERVER ['DOCUMENT_ROOT']?>/manage"><span lang="管理"></span></a>
    <span class="layui-icon">&#xe602;</span>
    <a href="javascript:;"><span lang="通讯录管理"></span></a>
    <span class="layui-icon">&#xe602;</span>
    <a><cite><span lang="批量管理"></span></cite></a>
  </div>
  <div class="wrap">
    <div class="layui-row">
      <div class="layui-form layui-form-pane">
        <div class="layui-form-item">
          <div class="layui-inline btn-wrap">
            <button class="layui-btn layui-btn-normal" id="save"><span lang="保存编辑"></span></button>
            <div class="layui-btn-group">
              <button class="layui-btn" id="zu"><span lang="批量修改组"></span></button>
              <button class="layui-btn" id="quanxian"><span lang="批量修改权限"></span></button>
              <button class="layui-btn layui-btn-danger" id="del"><span lang="批量删除"></span></button>
            </div>
            <button class="layui-btn layui-btn-primary" id="refresh"><span class="iconfont">&#xe69c;</span></button>
          </div>
        </div>
      </div>
    </div>
    <div class="layui-row">
      <table class="layui-table" id="table1"></table>
    </div>
  </div>
</div>



<script type="text/javascript">
$("a[id='<?php echo $page;?>']").parent().addClass('layui-this');
//初始化语言
initLang('<?php echo $page;?>',''+langNow+'');
langPages.push('<?php echo $page;?>');

//定义页面全局变量
var guidArr = [],
  tishi = '';
var tableRef = false;  //全局变量，判断表格是否刷新

layui.use('table', function(){
  var table = layui.table;
  var form = layui.form;
  //页面首次打开自动加载表格
  initTable('');
  
  var table1;
  var table1Data;
  function initTable(name){
    action = 'init';
    table1 = table.render({
      elem:'#table1',
      height: 542, //容器高度
      url: rootpath+'/controller/piLiang_controller.php',
      where: {name:name,action:action},
      even:true,
      size:'sm',
      method: 'post',
      page: false, //是否开启分页
      cols:  [[ //标题栏
        {type:'checkbox', fixed: 'left'},
        {field: 'XING_MING',title:'<span lang="姓名"></span>', fixed: 'left', edit: 'text',width:90, sort: true,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'PIN_YIN',title:'<span lang="拼音"></span>', edit: 'text',width:150, sort: true,align:'center',style:"text-align:left;font-size:13px;"},
        {field: 'GONG_SI', title: '<span lang="公司"></span>', edit: 'text',width:200, sort: true,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'SHOU_JI', title: '<span lang="手机"></span>', edit: 'text',width:110,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'ZUO_JI', title: '<span lang="座机"></span>', edit: 'text',width:110, sort: true,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'YOU_XIANG', title: '<span lang="邮箱"></span>', edit: 'text',width:220,align:'center',style:"text-align:left;font-size:13px;"},
        {field: 'BEI_ZHU', title: '<span lang="备注"></span>',edit: 'text',width:250,align:'center', sort: true,style:"text-align:left;font-size:13px;"},
        {field: 'ZU_ID', title: '<span lang="组"></span>', sort: true, width:250, align:'center', style:"text-align:left;font-size:13px;",templet: '#template2'},
        {field: 'QUAN_XIAN', title: '<span lang="权限"></span>', sort: true, width:100, align:'center', templet: '#template1'} 
      ]],
      done: function(res, curr, count){
        initLang('piLiang',''+langNow+'');//初始化语言
        table1Data = res.data;
        
        //移除滚动条
        $(".nicescroll-rails").remove();
        //自定义中间滚动条初始化
        $(".layui-table-main").niceScroll({
          cursorcolor:"#888",
          cursoropacitymax:'0.8',
          background: "#ddd",
          cursorwidth:"14px",
          autohidemode:false
        });
        
      }
    }); 
   
  }
  
  //保存编辑按钮点击事件
  $('#save').click(function(){
    //console.log(table1Data);
    action = 'save';
    $.ajax({
      type:'POST',
      url:rootpath+'/controller/piLiang_controller.php',
      data:{action,table1Data},
      beforeSend:function(){
        loadingDiv('load');
      },
      success:function(res){
        loadingDiv();
        console.log(res);
        if(res=='ok'){
          layer.msg('保存成功 | Success');
        }else if(res=='notok'){
          layer.msg('姓名不能为空 | Name is empty');
        }
      }
      
    });
  });
  
  //批量删除按钮点击事件
  $('#del').click(function(){
    var checkStatus = table.checkStatus('table1')
    ,data = checkStatus.data;
    //console.log(data);
    if(data.length==0){
      layer.msg('请选择要删除的行 | No Line Selected');
      
    }else{
    
      guidArr = [],tishi = '';
      for(i=0;i<data.length;i++){
        tishi += data[i].XING_MING + ' , ';
        guidArr.push(data[i].GUID);
      }
      tishi = tishi.substring(0,tishi.length-2);
      layer.confirm(tishi, {
          btn: ['Yes', 'No'],
          time: 0,
          title:'确定删除? - Delete?',
        }, function(){
          action = 'delete';
          ajax = $.ajax({
            url:rootpath+"/controller/piLiang_controller.php",
            async:true,
            type: 'post',
            data: {action,guidArr},
            beforeSend:function(){
              loadingDiv('load');
            },
            success:function(res){
              loadingDiv();
              if(res=='ok'){
                parent.layer.closeAll();
                parent.layer.msg('删除成功');
                initTable('');
              }
            }
          });
        }
      
      );
    }

  });
  
  //批量修改组按钮点击事件
  $('#zu').click(function(){
    var checkStatus = table.checkStatus('table1')
    ,data = checkStatus.data;
    //console.log(data);
    if(data.length==0){
      layer.msg('请选择要修改组的行 | No Line Selected');
    }else{
      guidArr = [],tishi = '';
      for(i=0;i<data.length;i++){
        tishi += data[i].XING_MING + ' , ';
        guidArr.push(data[i].GUID);
      }
      tishi = tishi.substring(0,tishi.length-2);
      layer.open({  //打开组选择弹出层
        type: 2,
        title: '',
        shade: 0.4,
        area: ['380px','118px'],
        content: rootpath+'/view/manage/piLiangZuIframe.php',
        end:function(){
          if(tableRef==true){
            initTable('');
            tableRef = false;
          }
        }
      }); 
      

    }

  });
  
  //批量修改权限按钮点击事件
  $('#quanxian').click(function(){
    var checkStatus = table.checkStatus('table1')
    ,data = checkStatus.data;
    //console.log(data);
    if(data.length==0){
      layer.msg('请选择要修改权限的行 | No Line Selected');
    }else{
      guidArr = [],tishi = '';
      for(i=0;i<data.length;i++){
        tishi += data[i].XING_MING + ' , ';
        guidArr.push(data[i].GUID);
      }
      tishi = tishi.substring(0,tishi.length-2);
      layer.open({  //打开组选择弹出层
        type: 2,
        title: '',
        shade: 0.4,
        area: ['380px','118px'],
        content: rootpath+'/view/manage/piLiangQuanxianIframe.php',
        end:function(){
          if(tableRef==true){
            initTable('');
            tableRef = false;
          }
        }
      }); 
    }

  });
  
  //表格权限修改监听
  form.on('switch(quanxian)', function(obj){
    index = $(this).parents('tr').attr('data-index');
    if(obj.value != '2'){
      obj.elem.value = '2'
      table1Data[index]['QUAN_XIAN'] = '2';
    }else{
      obj.elem.value = '1'
      table1Data[index]['QUAN_XIAN'] = '1';
    }
    console.log(table1Data);
  });
  
  //表格组点击事件
  $('body').on('click','td[data-field="ZU_ID"]',function(){
    var self = $(this);
    index = self.parents('tr').attr('data-index');
    zuid = self.attr('data-content');

    layer.open({  //打开组选择弹出层
      type: 2,
      title: '',
      shade: 0.4,
      closeBtn:0,
      area: ['540px','540px'],
      content: rootpath+'/view/zuIframe.php',
      end:function(){
        //console.log(getCookie('ztext'));
        if(getCookie('ztext')=='cancel'){
        }else if(getCookie('ztext')!=''){
          self.find('.zu-wrap').val(getCookie('ztext'));
          table1Data[index]['ZU_ID'] = getCookie('zid');
        }else{
          self.find('.zu-wrap').val('');
          table1Data[index]['ZU_ID'] = '';
        }
        form.render();
      }
    }); 
    
  });
  
  //刷新按钮点击事件
  $('#refresh').click(function(){
    initTable('');
  });
  
});

</script>

<!--模板引擎1：权限-->
<script type="text/html" id="template1">
  <input type="checkbox" name="quanxian" value="{{d.QUAN_XIAN}}" lay-filter="quanxian" lay-skin="switch" lay-text="编辑|只读" {{ d.QUAN_XIAN == 2 ? 'checked' : '' }}>

</script>
<!--模板引擎2：组-->
<script type="text/html" id="template2">

{{#  if(d.ZU_ID!= undefined &&d.ZU_ID!= ''){}}
  <input class="zu-wrap" placeholder="私有" value="{{d.ZU_NAME}}[{{d.ZU_ID}}]" />
{{#  } else { }}    
  <input class="zu-wrap" placeholder="私有" />
{{#  } }}  

</script>
