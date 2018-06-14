<?php
$view = 'manage';

require_once $_SERVER['DOCUMENT_ROOT'].'/src/nav.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/src/view.php';
?>
<link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT']?>/src/view/<?php echo $view.'.css'; ?>">

<div class="layui-body">
  <div class="layui-row mianbao">
    <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/plan"><span lang="生产计划"></span></a>
    <span class="layui-icon">&#xe602;</span>   
    <a href="javascript:;"><span lang="首页"></span></a>
  </div>
  <div class="wrap">
    <div class="layui-row">
      <table class="layui-table">
        <colgroup>
          <col width="300">
          <col>
        </colgroup>
        <thead>
          <tr>
            <th><span lang="功能"></span></th>
            <th><span lang="描述"></span></th>
          </tr> 
        </thead>
        <tbody>
          <tr>
            <td><span lang="批量管理"></span></td>
            <td><span lang="使用批量工具管理通讯录"></span></td>
          </tr>
          <tr>
            <td><span lang="批量导入"></span></td>
            <td><span lang="使用Excel、TXT等方式轻松导入联系人"></span></td>
          </tr>
          <tr>
            <td><span lang="更改密码"></span></td>
            <td><span lang="修改自己账号的密码"></span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>



<script type="text/javascript">
//初始化语言
initLang('<?php echo $view; ?>',''+langNow+'');
langPages.push('<?php echo $view;?>');
//初始化焦点页面
var idx = '<?php echo $view;?>';
</script>