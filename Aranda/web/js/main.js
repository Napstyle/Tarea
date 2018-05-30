$(function(){
  $('#modalButtonCliente').click(function(){
    $('#modal').modal('show').find('#modalContentCliente').load($(this).attr('value'));
  });
});
