


var flashBag = {
  mensajes: new Array(),
  setMsj: function(mensaje) {
    this.mensajes.push(mensaje);
  },
  getMsj: function(){
    $("#flashBag").show();
    ul = $("#flashBag").children('ul');
    ul.empty();
    $.each(this.mensajes , function(i, val) {
      ul.append("<li>"+val+"</li>");
    });
    this.mensajes = new Array();
  }
}
$(".alert").on('click',function(){
  $(this).hide( "slow" );
});
