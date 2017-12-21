$(document).ready(function(){

  $('.usuarioFila').on('click',function(){
    url = $(this).attr('link');
    location.href = url;
  });

});
