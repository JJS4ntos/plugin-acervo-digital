<style media="screen">
  .social-share-bar {
    display: none;
  }
</style>
<div class="container justify-content-center">
  <form action="<?= get_bloginfo('url') . '/wp-json/acervo-api/solicitar-download'?>" method="post">
    <input type="hidden" name="item" value="<?= $_GET['item'] ?>">
    <input type="hidden" name="userId" value="<?= $user->user_id ?>">
    <button type="submit" class="btn btn-primary">Baixar item solicitado</button>
  </form>
</div>
