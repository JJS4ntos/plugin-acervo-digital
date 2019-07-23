$(document).ready(function(){
  /*$('#solicitar-acesso').click(function(){
    $.ajax({
      url: '{{ $url }}' + '/wp-json/acervo-api/solicitar-acesso',
      type: 'POST',
      dataType: 'json',
      data: {
        itemId: '{{ $_GET['id'] }}',
        userId: {{ get_current_user_id() }}
      },
      beforeSend: function( jqXHR, settings ) {
        $('#solicitar-acesso').html('Solicitando...');
      },
      complete: function() {
        alert('Solicitação enviada com sucesso! Aguarde a aprovação do administrador, você receberá um e-mail quando isto acontecer.');
        $('#solicitar-acesso').html('Acesso solicitado');
        $('#solicitar-acesso').attr('disabled', 'true');
      }
    });
  });*/

  $('#favoritar').click(function(){
    $('#favoritar').html('Favoritando...');
    $('#favoritar').attr('disabled', 'true');
    $.ajax({
      url: root + '/wp-json/acervo-api/favoritar-item',
      type: 'POST',
      data: {
        itemId: $('#favoritar').attr('item'),
        userId: $('#favoritar').attr('user')
      },
      success: function(data){
        $('#favoritar').html(data);
      }
    });

  });

  $('#desfavoritar').click(function(){
    $('#desfavoritar').html('Removendo de favoritos...');
    $('#desfavoritar').attr('disabled', 'true');
    $.ajax({
      url: root + '/wp-json/acervo-api/desfavoritar-item',
      type: 'POST',
      data: {
        favoritoId: $('#desfavoritar').attr('favorito')
      },
      success: function(data){
        $('#desfavoritar').html(data);
      }
    });
  });

});
