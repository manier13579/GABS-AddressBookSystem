<?php
$view = 'manage';
$page = 'zuManage';

require_once $_SERVER['DOCUMENT_ROOT'].'/src/nav.php';

if ($_SESSION['USER_TYPE'] == '1') {
    header('Location:http://'.$_SERVER['HTTP_HOST']);
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'].'/src/view.php';

?>
<script src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/jquery.nicescroll.min.js"></script>
<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/view/<?php echo $view.'/'.$page.'.css'; ?>">

<div class="layui-body">
  <div class="layui-row mianbao">
    <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/manage"><span lang="管理"></span></a>
    <span class="layui-icon">&#xe602;</span>
    <a href="javascript:;"><span lang="系统管理"></span></a>
    <span class="layui-icon">&#xe602;</span>
    <a><cite><span lang="组织结构管理"></span></cite></a>
  </div>
  <div class="wrap">
    <div class="layui-row">
      <div class="layui-form layui-form-pane">
        <div class="layui-form-item">
          <div class="layui-inline btn-wrap">
            <div class="layui-btn-group">
              <button class="layui-btn layui-btn-normal" id="save"><span lang="保存"></span></button>
              <button class="layui-btn" id="add"><span lang="添加"></span></button>
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
$("a[id='<?php echo $page; ?>']").parent().addClass('layui-this');
//初始化语言
initLang('<?php echo $page; ?>',''+langNow+'');
langPages.push('<?php echo $page;?>');
//初始化焦点页面
var idx = '<?php echo $view;?>';

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
      url: rootpath+'/src/controller/zuManage_controller.php',
      where: {
        name:name,
        action:action
      },
      even:true,
      size:'sm',
      method: 'post',
      page: false, //是否开启分页
      cols:  [[ //标题栏
        {field: 'ZU_ID',title:'ID', fixed: 'left',width:90, sort: true,align:'center',style:"text-align:left;font-size:13px;"},
        {field: 'PARENT_ID',title:'<span lang="父节点ID"></span>', edit: 'text',width:150, sort: true,align:'center',style:"text-align:left;font-size:13px;"},
        {field: 'ZU_NAME', title: '<span lang="组织结构名"></span>', edit: 'text', sort: true,align:'center',style:"text-align:left;font-size:13px;"},
        {title: '', fixed: 'right',width:80, align:'center', templet: '#template1'} 
      ]],
      done: function(res, curr, count){
        initLang('zuManage',''+langNow+'');//初始化语言
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
  
  //保存按钮点击事件
  $('#save').click(function(){
    //console.log(table1Data);
    action = 'save';
    $.ajax({
      type:'POST',
      url:rootpath+'/src/controller/zuManage_controller.php',
      data:{
        action:action,
        table1Data:table1Data
      },
      beforeSend:function(){
        loadingDiv('load');
      },
      success:function(res){
        loadingDiv();
        console.log(res);
        if(res=='ok'){
          layer.msg('保存成功 | Success');
        }else if(res=='notok'){
          layer.msg('不能有空值 | Data is empty');
        }
      }
      
    });
  });
  
  //删除按钮点击事件
  $('body').on('click','#del',function(){
    var self = $(this);
    var index = self.parents('tr').attr('data-index');
    zuid = table1Data[index].ZU_ID;
    zuname = table1Data[index].ZU_NAME;
    layer.confirm(zuname, {
        btn: ['Yes', 'No'],
        time: 0,
        title:'确定删除? - Delete?',
      }, function(){
        action = 'delete';
        ajax = $.ajax({
          url:rootpath+"/src/controller/zuManage_controller.php",
          async:true,
          type: 'post',
          data: {
            action:action,
            zuid:zuid
          },
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

  });
  
  //添加按钮点击事件
  $('#add').click(function(){
    layer.open({  //打开组选择弹出层
      type: 2,
      title: '',
      shade: 0.4,
      area: ['380px','218px'],
      content: rootpath+'/src/view/manage/zuManageIframe.php',
      end:function(){
        if(tableRef==true){
          initTable('');
          tableRef = false;
        }
      }
    }); 

  });
  
  //刷新按钮点击事件
  $('#refresh').click(function(){
    initTable('');
  });
  
});

</script>

<!--模板引擎1：工具-->
<script type="text/html" id="template1">
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" id="del">删除</a>
</script>
