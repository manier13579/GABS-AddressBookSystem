<?php
$view = 'manage';
$page = 'userManage';

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
    <a><cite><span lang="用户管理"></span></cite></a>
  </div>
  <div class="wrap">
    <div class="layui-row">
      <div class="layui-form layui-form-pane">
        <div class="layui-form-item">
          <div class="layui-inline btn-wrap">
            <button class="layui-btn" id="add"><span lang="新增用户"></span></button>
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
      url: rootpath+'/src/controller/userManage_controller.php',
      where: {name:name,action:action},
      even:true,
      size:'sm',
      method: 'post',
      page: false, //是否开启分页
      cols:  [[ //标题栏
        {field: 'USER_ID',title:'ID', fixed: 'left',width:100, sort: true,align:'center',style:"text-align:left;font-size:13px;"},
        {field: 'USER_NAME',title:'<span lang="用户名"></span>', fixed: 'left', width:120, sort: true,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'ZU', title: '<span lang="所在组"></span>', sort: true, width:200,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'USER_TYPE', title: '<span lang="权限"></span>', sort: true, width:120,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'FAILED_LOGINS', title: '<span lang="登录失败次数"></span>', sort: true, width:130,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'LAST_IP', title: '<span lang="最后登录IP"></span>', sort: true, width:150,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'JOIN_DATE', title: '<span lang="注册日期"></span>', sort: true, width:150,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'LAST_LOGIN', title: '<span lang="最后登录时间"></span>', sort: true, width:150,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'EMAIL', title: '<span lang="邮箱"></span>', sort: true, width:200,align:'center',style:"text-align:left;font-size:13px;"},
        {title: '', fixed: 'right',width:120, align:'center', templet: '#template1'} 
      ]],
      done: function(res, curr, count){
        initLang('userManage',''+langNow+'');//初始化语言
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
  
  //编辑按钮点击事件
  $('body').on('click','#edit',function(){
    var self = $(this);
    var index = self.parents('tr').attr('data-index');
    userid = table1Data[index].USER_ID;
    username = table1Data[index].USER_NAME;
    usertype = table1Data[index].USER_TYPE;
    email = table1Data[index].EMAIL;
    zu = table1Data[index].ZU;
    zuid = table1Data[index].ZU_ID;
    
    layer.open({  //打开组选择弹出层
      type: 2,
      title: '',
      shade: 0.4,
      area: ['380px','378px'],
      content: rootpath+'/src/view/manage/userManageEditIframe.php?userid='+userid+'&username='+username+'&usertype='+usertype+'&email='+email+'&zu='+zu+'&zuid='+zuid,
      end:function(){
        if(tableRef==true){
          initTable('');
          tableRef = false;
        }
      }
    }); 

  });
  
  //删除按钮点击事件
  $('body').on('click','#del',function(){
    var self = $(this);
    var index = self.parents('tr').attr('data-index');
    userid = table1Data[index].USER_ID;
    username = table1Data[index].USER_NAME;
    layer.confirm(userid + ' - ' + username, {
        btn: ['Yes', 'No'],
        time: 0,
        title:'确定删除? - Delete?',
      }, function(){
        action = 'delete';
        ajax = $.ajax({
          url:rootpath+"/src/controller/userManage_controller.php",
          async:true,
          type: 'post',
          data: {action,userid},
          beforeSend:function(){
            loadingDiv('load');
          },
          success:function(res){
            console.log(res);
            loadingDiv();
            if(res=='ok'){
              parent.layer.closeAll();
              parent.layer.msg('删除成功');
              initTable('');
            }
          },
          error:function(e){
              console.log(e);
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
      area: ['380px','378px'],
      content: rootpath+'/src/view/manage/userManageIframe.php',
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
  <a class="layui-btn layui-btn-warm layui-btn-xs" lay-event="edit" id="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" id="del">删除</a>
</script>
