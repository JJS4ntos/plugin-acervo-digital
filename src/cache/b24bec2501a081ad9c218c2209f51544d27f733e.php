<script type="text/javascript">
  root = '<?php echo e(get_bloginfo('url')); ?>';
</script>
<div class="list-item blog-list-item format-standard post-29 artwork type-artwork status-publish has-post-thumbnail hentry">
  <div class='row item'>
    <div class="col-md-4 text-center">
      <!--<img src='http://acervofredericomorais.com.br/arquivos/images/th/<?php echo e($item->identificacao); ?>_da-1_th.jpg'>-->
      <a href="<?php echo e($link); ?>?id=<?php echo e($item->id); ?>"><img src="<?php echo e($thumbnail); ?>" class="thumb-item img-thumbnail wp-post-image"></a>
    </div>
    <div class='col-md-6'>
      <h3><a href='<?php echo e($link); ?>?id=<?php echo e($item->id); ?>'><?php echo e($item->titulo); ?></a></h3>
      <div class="meta-data alt">
        <?php if($item->autoria !== null): ?>
          <div>Por <?php echo e($item->autoria); ?></div>
        <?php else: ?>
          <div>Autor desconhecido</div>
        <?php endif; ?>
      </div>
      <ul>
        <li>Dimensão: <?php echo e($item->dimensao); ?></li>
      </ul>
      <p class='text-muted'><?php echo e($item->descricao); ?></p>
      <div class="post-actions">
          <a href="<?php echo e($link); ?>?id=<?php echo e($item->id); ?>" class="btn btn-primary btn-default">LEIA MAIS</a>
          <?php if( get_current_user_id() > 0 ): ?>
            <?php if( count( $favorito ) > 0 ): ?>
              <button type="button" favorito="<?php echo e($favorito[0]->ID); ?>" class="btn btn-primary desfavoritar">
                <i class="fa fa-star"></i> Remover de favorito
              </button>
            <?php else: ?>
              <button type="button" item="<?php echo e($item->id); ?>" user="<?php echo e($userId); ?>" class="btn btn-primary favoritar">
                <i class="fa fa-star"></i> Favoritar
              </button>
            <?php endif; ?>
          <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\acervo\wp-content\plugins\acervo-digital-plugin\src\frontend/items.blade.php ENDPATH**/ ?>