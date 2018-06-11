<?php
require_once dirname(__FILE__).'/src/nav.php';

?>
<link rel="stylesheet" href="<?php $rootpath ?>/src/css/index.css">
<script src="<?php $rootpath ?>/src/js/clipboard.min.js"></script>
<script src="<?php $rootpath ?>/src/js/jquery.nicescroll.min.js"></script>

<div class="wrap">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md9">
      <form class="layui-form layui-form-pane" action="">
        <div class="layui-form-item search-wrap" pane>
          <label class="layui-form-label search-button"><span class="iconfont">&#xe6b3;</span></label>
          <div class="layui-input-block search-input">
            <input type="text" name="title" placeholder="在这里搜索 / Search" autocomplete="off" class="layui-input">
          </div>
          <div class="filter-button"><span class="iconfont">&#xe684;</span><span lang="筛选"></span></div>
          <div class="list-count">
            <span lang="共"></span>
            <span class="listCount">0</span>
            <span lang="位联系人"></span>
          </div>
        </div>
      </form>

    </div>
    <div class="layui-col-md3">
      <div class="layui-btn-group">
        <button class="layui-btn layui-btn-normal JS-add">
          <i class="layui-icon">&#xe654;</i> <span lang="添加联系人"></span>
        </button>
        <button class="layui-btn layui-btn-primary JS-batch">
          <i class="layui-icon">&#xe614;</i> <span lang="批量管理"></span>
        </button>
      </div>
    </div>
  </div>
  <div class="layui-row">
    <div class="area1">
      <div class="layui-progress jindutiao" lay-filter="jindutiao">
        <div class="layui-progress-bar layui-bg-blue" lay-percent="0%"></div>
      </div>
      <table class="layui-table" id="table1" lay-filter="table1"></table>
    </div>
  </div>
  <div class="layui-row">
    <div class="footer-line">© 2018 MES1 Team License</div>
  </div>
</div>

<script type="text/javascript" src="<?php $rootpath ?>/src/js/custom.js"></script>
<script type="text/javascript">
$("#index").addClass("layui-this");
//初始化语言
initLang('index',''+langNow+'');
langPages.push('index');

//全局变量，判断表格是否刷新
var tableRef = false;

//使用layui前端框架
layui.use(['table', 'form','element'], function(){
  var table = layui.table;
  var form = layui.form;
  var element = layui.element;
  
  var timer = setInterval(function(){});
  function progressRandom(start,stop){
    if($('.layui-progress-bar').css('width') == '100%'){
      element.progress('jindutiao', '0%');
    }
    $('.jindutiao').show();
    clearInterval(timer);
    timer = setInterval(function(){
      start = start + Math.random()*10|0;
      if(start > stop){
        start = stop;
        clearInterval(timer);
      }
      if(start == 100){
        element.progress('jindutiao', '100%');
        $('.jindutiao').fadeOut(1500);
      }else{
        element.progress('jindutiao', start+'%');
      }
    }, 10+Math.random()*100);
  }
  //页面首次打开自动加载表格
  initTable('');
  
  var table1;
  var table1Data;
  function initTable(name){
    action = 'init';
    progressRandom(0,90);
    table1 = table.render({
      elem:'#table1',
      height: 528, //容器高度
      url: rootpath+'/src/controller/list_controller.php',
      where: {name:name,action:action},
      even:true,
      size:'sm',
      method: 'post',
      id:'table1',
      page: false, //是否开启分页
      cols:  [[ //标题栏
        {field: 'GUID',width:1,title:''},
        {field: 'XING_MING',title:'<span lang="姓名"></span>',width:90, sort: true,align:'center',style:"text-align:center;font-size:13px;",templet: '#template2'},
        {field: 'GONG_SI', title: '<span lang="公司"></span>', width:200, sort: true,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'SHOU_JI', title: '<span lang="手机"></span>', width:110,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'ZUO_JI', title: '<span lang="座机"></span>', width:110, sort: true,align:'center',style:"text-align:center;font-size:13px;"},
        {field: 'YOU_XIANG', title: '<span lang="邮箱"></span>', width:220,align:'center',style:"text-align:left;font-size:13px;"},
        {field: 'BEI_ZHU', title: '<span lang="备注"></span>',align:'center', sort: true,style:"text-align:left;font-size:13px;"},
        {field: 'QUAN_XIAN', title: '<span lang="权限"></span>',width:95,fixed:'right',align:'center',style:"text-align:center;font-size:13px;",templet: '#template1'},
      ]],
      done: function(res, curr, count){
        progressRandom(90,100);
        
        initLang('index',''+langNow+'');//初始化语言
        table1Data = res.data;
        //显示联系人数量
        $(".listCount").text(res.data.length);
        //移除滚动条
        $(".nicescroll-rails").remove();
        //自定义中间滚动条初始化
        $(".layui-table-body").niceScroll({
          cursorcolor:"#888",
          cursorwidth:"3px",
          autohidemode:false
        });
      }
    }); 
   
  }
  
  //搜索输入监听 - 重新加载表格
  var inputStat = 0;
  $('.search-input input').bind('input propertychange', function() {
    inputStat += 1;
    //延迟执行，防止快速输入时频繁刷新表格
    setTimeout(function(){
      inputStat -= 1;
      if(inputStat==0){
        //筛选表格
        name = Trim($('.search-input input').val());
        if(name!=''){
          $('.layui-table-body .layui-table').find('tr').hide();
          
          for (var id in table1Data){  // 按块模糊搜索算法
            var searchStr = '';
            index = table1Data[id]['LAY_TABLE_INDEX'];  //获取此行索引值
            
            for(var key in table1Data[id]){  // 遍历行数据
              var piPeiDu = 0; 
              if(key!='GUID'&&key!='QUAN_XIAN'&&key!='USER_ID'&&key!='LAY_TABLE_INDEX'){
                var dataCache = table1Data[id][key];
                for(k in name){  // 匹配度计算
                  if(dataCache !=null){
                    var piPei = dataCache.toUpperCase().indexOf(name[k].toUpperCase());  //转大写，匹配大小写
                    if(piPei!=-1){
                      piPeiDu += 1;
                      dataCache = dataCache.slice(piPei+1);
                    }
                  }
                }
              }
              if(piPeiDu == name.length){  // 如果匹配查询
                $('.layui-table-body tr[data-index="'+index+'"]').show();  //此行显示
              }
            }
          }
          
        }else{
          $('.layui-table-body tr').show();
        }
        
      }
      $(".layui-table-body").getNiceScroll().resize();  //重置滚动条
    },300);
    
  });  
  
  //添加联系人按钮点击事件
  $('.JS-add').click(function(){
    //打开添加弹出层
    layer.open({
      type: 2,
      title: '添加联系人 - Add contacts',
      shade: 0.4,
      area: ['830px','510px'],
      content: rootpath+'/src/view/addIframe.php',
      end:function(){
        if(tableRef==true){
          initTable('');
          tableRef = false;
        }
      }
    }); 
  });
  
  $('.JS-batch').click(function(){
    location.href = '/manage/piLiang';
    
  });
  //通讯录表格行双击事件 - 弹出查看详细窗口
  $('body').on('dblclick', '.layui-table>tbody>tr', function (){
      var self = $(this);
      dataIndex = self.attr('data-index');    //获取此行id
      GUID = $(this).find("div[class*='-GUID']").text();    //获取此行id

      //打开添加弹出层
      layer.open({
        type: 2,
        title: '查看联系人 - View contacts',
        shade: 0.4,
        area: ['830px','510px'],
        content: rootpath+'/src/view/editIframe.php',
        end:function(){
          if(tableRef==true){
            initTable('');
            tableRef = false;
          }
        }
      }); 
  })
  
  //通讯录姓名点击事件 - 弹出查看详细窗口
  $('body').on('click', '.namehref', function (){
      GUID = $(this).parents('tr').find("div[class*='-GUID']").text();    //获取此行id
      //打开添加弹出层
      layer.open({
        type: 2,
        title: '查看联系人 - View contacts',
        shade: 0.4,
        area: ['830px','510px'],
        content: rootpath+'/src/view/editIframe.php',
        end:function(){
          if(tableRef==true){
            initTable('');
            tableRef = false;
          }
        }
      }); 
      
  })
  
  //通讯录表格移入事件 - 显示复制按钮
  $('body').on('mouseenter', '.layui-table>tbody>tr>td', function (){
    var self = $(this);
    var type = self.attr('data-field');
    var text = self.find('.layui-table-cell').text();
    if(type=='YOU_XIANG'){
      self.append(
        '<a class="iconfont icon-email" href="mailto:'+text+'">&#xe84f;</a>'+
        '<div class="iconfont icon-copy" data-clipboard-text="'+text+'">&#xe633;</div>'
      );
    }else if(type!='QUAN_XIAN'){
      self.append('<div class="iconfont icon-copy" data-clipboard-text="'+text+'">&#xe633;</div>');
    }
    

    
  });
  $('body').on('mouseleave', '.layui-table>tbody>tr>td', function (){
    var self = $(this);
    self.find('.iconfont').remove();
  });

  var clipboard = new Clipboard('.icon-copy');

  clipboard.on('success', function(e) {
      layer.msg('已复制到粘贴板：'+e.text);

      e.clearSelection();
  });
  
  //筛选按钮点击事件
  $('.filter-button').click(function(){
    //打开筛选弹出层
    layer.open({
      type: 2,
      title: '',
      shade: 0.4,
      area: ['540px','378px'],
      content: rootpath+'/src/view/filterIframe.php',
      end:function(){
        initTable('');
      }
    }); 
    
  });
  
});


</script>

<!--模板引擎1：显示权限-->
<script type="text/html" id="template1">
{{#  if(d.USER_ID=='<?php echo $_SESSION['USER_ID'];?>'){ }}
  <span class="layui-icon icon-blue">&#xe612;</span>
{{#  } else if(d.QUAN_XIAN=='2'){ }}
  <span class="layui-icon icon-green">&#xe613;</span>
{{#  } else { }}    
  <span class="layui-icon icon-gray">&#xe613;</span>
{{#  } }}  

</script>

<!--模板引擎2：姓名列-->
<script type="text/html" id="template2">
<div class="namehref">{{d.XING_MING}}</div>

</script>