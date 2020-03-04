//底部版权点击事件
$('body').on('click','.footer-line',function(){
  layer.open({
    type: 1,
    shadeClose:true,
    anim:2,
    title: false,  //不显示标题栏
    closeBtn: false,
    area: '380px;',
    shade: 0.8,
    moveType: 1,  //拖拽模式，0或者1
    content: 
      '<div class="footer-contact">'+
        '<span>发起人 : 鹏</span>'+
        '<span class="contact2">Architect : Peng</span>'+
        '<span>设计 | 开发 : 炳</span>'+
        '<span class="contact2">Front-end | Back-end | Databace : Bing</span>'+
        '<div class="logo"><span class="iconfont">&#xe654;</span></div>'+
      '</div>'
  });
  
  var css = {top:'-30px',right:'30px'};
  $('.logo').animate(css,1200,rowBack);  
  
  function rowBack(){
    if(css.top==='-30px'&&css.right==='30px'){
      css.top='40px';  
      $('.logo').animate(css,1200,rowBack);  
    }else if(css.top==='40px'&&css.right==='30px'){
      css.right='-50px';  
      $('.logo').animate(css,1200,rowBack);  
    }else if(css.right==='-50px'){
      css.right='30.1px';  
      $('.logo').animate(css,1200,rowBack);  
    }else if(css.right==='30.1px'){
      css.top='-30px';  
      css.right='30px'
      $('.logo').animate(css,1200,rowBack);  
    }
    
  }
});