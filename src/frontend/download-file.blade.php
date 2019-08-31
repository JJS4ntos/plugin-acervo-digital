@php
  $url = get_bloginfo('url');
  $redirect = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
@endphp
<style media="screen">
  .social-share-bar {
    display: none;
 }
</style>
@if( is_user_logged_in() )
<div class="container justify-content-center">
  <form action="<?= get_bloginfo('url') . '/wp-json/acervo-api/solicitar-download'?>" method="post">
    <input type="hidden" name="item" value="<?= $_GET['item'] ?>">
    <input type="hidden" name="userId" value="<?= $user->data->ID ?>">
    <button type="submit" class="btn btn-primary">Baixar item solicitado</button>
  </form>
</div>
@else 

<p>Você precisa estar logado para realizar o Download deste documento.</p>
          <form method="post" action="{{ $url }}/wp-json/acervo-api/solicitar-login">
                <input type="hidden" name="redirect" value="{{ $redirect }}">
                <button type="submit" class="btn btn-primary">
                        Fazer login
                </button>
          </form>
@endif
