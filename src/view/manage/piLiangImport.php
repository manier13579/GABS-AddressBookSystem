<?php
$view = 'manage';
$page = 'piLiangImport';

require_once $_SERVER['DOCUMENT_ROOT'].'/src/nav.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/src/view.php';
?>
<script src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/xlsx.full.min.js"></script>
<script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT']?>/src/js/pinyin.js"></script>
<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/view/<?php echo $view.'/'.$page.'.css'; ?>">

<div class="layui-body">
  <div class="layui-row mianbao">
    <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/manage"><span lang="管理"></span></a>
    <span class="layui-icon">&#xe602;</span>
    <a href="javascript:;"><span lang="通讯录管理"></span></a>
    <span class="layui-icon">&#xe602;</span>
    <a><cite><span lang="批量导入"></span></cite></a>
  </div>
  <div class="wrap">
    <div class="layui-row">
      <div class="layui-form layui-form-pane">
        <div class="layui-form-item">
          <div class="layui-inline btn-wrap">
            <button class="layui-btn layui-btn-warm" id="download"><span lang="Excel模板下载"></span></button>
            <div class="layui-btn-group">
              <button class="layui-btn" id="ExcelUpload">
                <i class="layui-icon">&#xe67c;</i>
                <span lang="Excel上传"></span>
              </button>
              <input type="file" id="ExcelInput" name="ExcelInput" style="display:none;">
              <button class="layui-btn layui-btn-disabled" id="TXTUpload" disabled>
                <i class="layui-icon">&#xe67c;</i>
                <span lang="TXT上传"></span>
              </button>
              <button class="layui-btn layui-btn-disabled" id="import"><span lang="确认导入"></span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="layui-row">
      <div class="area"><span lang="预览区"></span></div>
      <table class="layui-table" id="table1"></table>
    </div>
  </div>
</div>



<script type="text/javascript">
$("a[id='<?php echo $page; ?>']").parent().addClass('layui-this');
//初始化语言
initLang('<?php echo $page; ?>',''+langNow+'');
langPages.push('<?php echo $page;?>');

//定义页面全局变量
var guidArr = [],
  tishi = '';
var tableRef = false;  //全局变量，判断表格是否刷新

layui.use('table', function(){
  var table = layui.table;
  var form = layui.form;

  //获取拼音函数
  function getPinyin(nameVal){
    var res = nameVal;
    for( var key in pinyin){
      if(key==nameVal){
        res = pinyin[key];
      }
    }
    return res;
  }
    
  //Excel上传事件
  ExcelChuli();
  function ExcelChuli(){
    var input_dom_element = document.getElementsByName('ExcelInput')[0];
    var rABS = true; // true: readAsBinaryString ; false: readAsArrayBuffer
    function handleFile(e) {
      var files = e.target.files, f = files[0];
      var reader = new FileReader();
      reader.onload = function(e) {
        var data = e.target.result;
        if(!rABS) data = new Uint8Array(data);
        //获取Excel数据
        var workbook = XLSX.read(data, {type: rABS ? 'binary' : 'array'});
        //获取工作表1数据
        var worksheet = workbook.Sheets[workbook.SheetNames[0]];
        //页面上显示表格数据
        $('.area').hide();
        $('#table1').html(XLSX.utils.sheet_to_html(worksheet));
        //获取json格式数据
        var roa = XLSX.utils.sheet_to_json(worksheet);
        //遍历加入拼音
        for(var i=0;i<roa.length;i++){
          var pinyinRes = '';
          for(j=0;j<roa[i]['姓名'].length;j++){
            pinyinRes += getPinyin(roa[i]['姓名'][j]);
          }
          roa[i]['拼音'] = pinyinRes;
        }
        console.log(roa);
        //启用确认导入按钮
        $('#import').removeClass('layui-btn-disabled').addClass('layui-btn-normal');
        //确认导入按钮点击事件
        $('#import').click(function(){
          action = 'upload';
          $.ajax({
            type:'POST',
            url:rootpath+'/src/controller/piLiangImport_controller.php',
            data:{action,roa},
            beforeSend:function(){
              loadingDiv('load');
            },
            success:function(res){
              loadingDiv();
              if(res=='ok'){
                layer.msg('导入成功 | Success');
              }else if(res=='notok'){
                layer.msg('姓名不能为空 | Name is empty');
              }
            }
            
          });
          
        });
        
        /* DO SOMETHING WITH workbook HERE */
      };
      if(rABS) reader.readAsBinaryString(f); else reader.readAsArrayBuffer(f);
    }
    input_dom_element.addEventListener('change', handleFile, false);
  }

    
  //Excel上传点击事件
  $('#ExcelUpload').click(function(){
    $('#ExcelInput').click();
  });
  
  //Excel模板下载按钮点击事件
  $('#download').click(function(){
    window.open(rootpath+"/src/file/List Demo.xlsx",'_blank');
  });
});

</script>
