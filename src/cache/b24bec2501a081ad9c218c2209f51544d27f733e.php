<style media="screen">
  .thumb-item {
    height: 200px;
  }

  .thumb-line {
    border: 1px solid gray;
    border-radius: 5px;
    padding: 10px;
  }

  .item {
    margin-bottom: 25px;
  }

  .btn-default {
    background-color: #42cdd4;
    border-color: #42cdd4;
  }

  .btn-default:hover {
    background-color: #42cdd9;
  }

</style>
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
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\acervo\wp-content\plugins\acervo-digital-plugin\src\frontend/items.blade.php ENDPATH**/ ?>