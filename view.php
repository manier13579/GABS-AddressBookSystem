<link rel="stylesheet" href="<?php $_SERVER ['DOCUMENT_ROOT']?>/css/view.css">
<div class="layui-side layui-bg-black">
  <div class="layui-side-scroll">
    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
    <ul class="layui-nav layui-nav-tree">
      <li class="layui-nav-item layui-nav-itemed">
        <a class="side-title" href="javascript:;"><span lang="通讯录管理"></span></a>
        <dl class="layui-nav-child">
          <dd><a href="/manage/piLiang" id="piLiang"><span lang="批量管理"></span></a></dd>
          <dd><a href="/manage/piLiangImport" id="piLiangImport"><span lang="批量导入"></span></a></dd>
        </dl>
      </li>
      <li class="layui-nav-item layui-nav-itemed">
        <a class="side-title" href="javascript:;"><span lang="个人管理"></span></a>
        <dl class="layui-nav-child">
          <dd><a href="/manage/changePass" id="changePass"><span lang="更改密码"></span></a></dd>
        </dl>
      </li>
      <?php 
        if($_SESSION['USER_TYPE']=='2'){
          echo '
            <li class="layui-nav-item layui-nav-itemed">
              <a class="side-title" href="javascript:;"><span lang="系统管理"></span></a>
              <dl class="layui-nav-child">
                <dd><a href="/manage/zuManage" id="zuManage"><span lang="组织结构管理"></span></a></dd>
                <dd><a href="/manage/userManage" id="userManage"><span lang="用户管理"></span></a></dd>
                <dd><a href="/manage/langRegister" id="langRegister"><span lang="语言注册"></span></a></dd>
              </dl>
            </li>
          ';
        
        }
      ?>

    </ul>
  </div>
</div>

  
<script type="text/javascript">
$("#manage").addClass("layui-this");
//初始化语言
initLang('view',''+langNow+'');
langPages.push('view');

layui.use('element', function(){
  var element = layui.element;
});



</script>