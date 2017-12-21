$(document).ready(function(){

  $('.usuarioFila').on('click',function(){
    url = $(this).attr('link');
    location.href = url;
  });

  $('.accion').click(function(event){
    event.stopPropagation();
    var url = $(this).attr('data-url');
    swal({
      title: "¿Estás Seguro?",
      text: "No será posible revertir este cambio!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Si",
      closeOnConfirm: false
    },
    function(){
      swal("Éxito!", "Se finalizado con la operación exitosamente.", "success");
      window.location.href = url;
    });
  });

});
