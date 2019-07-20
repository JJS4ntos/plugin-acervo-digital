$(document).ready(function(){
  $('#solicitar-acesso').click(function(){
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
  });
})
