$(document).ready(function(){

  $('.multiselect').multiselect({
    nonSelectedText: 'Seleccione al menos un Rol del listado'
  });


  $("#submit").on('click',function(event){

    retorno = true;
    if($('.multiselect option:selected').length == 0){
      flashBag.setMsj("Debe seleccionar al menos un Rol");
      retorno = false;
    }

    if(!retorno){
      event.preventDefault();
      flashBag.getMsj();
    }
    return retorno;
  });




});
