<?php
  $properties = array(
    'Descrição' => 'descricao',
    'Identificador' => 'identificacao',
    'Coleção' => 'colecao',
    'Grupo' => 'grupo',
    'Espécie' => 'tipologia',
    'Autoria' => 'autoria',
    'Quantidade' => 'quantidade',
    'Local de produção' => 'local_producao',
    'Gênero' => 'genero'
  );
  $url = get_bloginfo('url');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#solicitar-acesso').click(function(){
      $.ajax({
        url: '<?php echo e($url); ?>' + '/wp-json/acervo-api/solicitar-acesso',
        type: 'POST',
        dataType: 'json',
        data: {
          itemId: '<?php echo e($_GET['id']); ?>',
          userId: <?php echo e(get_current_user_id()); ?>

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
</script>
<style media="screen">
  .properties li {
    font-size: 17px;
    font-weight: bold;
    color: black;
    margin-top: 5px;
  }

  .properties {
    list-style: none;
    margin: 0;
    margin-bottom: 30px;
  }

  .propertyTitle {
    color: gray;
  }

  .acervo-title {
    margin-bottom: 22px;
  }

  .social-share-bar {
    display:none !important;
  }

</style>
<div class="container">
  <div class="row">
    <div class="col-md-6 acervo-title">
      <h2 class="short"><?php echo e($item->titulo); ?></h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-sm-6">
      <div class="single-artwork-images">
        <div class="artwork-slider">
          <div id="artwork-images" class="flexslider format-gallery">
            <ul class="slides">
              <li class="format-image" style="display: list-item;">
                <a href="<?php echo e($itemModel->getUploadImage($item)); ?>" class="magnific-gallery-image media-box">
                  <img src="<?php echo e($itemModel->getUploadImage($item)); ?>" alt="Artwork">
                  <span class="zoom"><span class="icon"><i class="icon-expand"></i></span></span>
                  <span class="zoom">
                    <span class="icon"><i class="fa fa-arrow-right"></i></span>
                  </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="additional-images">
            <div id="artwork-thumbs" class="flexslider">
              <div class="flex-viewport">
                <ul class="slides">
                  <?php
                    $first = true;
                  ?>
                  <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>:
                    <?php if( $first ): ?>
                      <li class="flex-active-slide" style="width: 100px; float: left; display: block;">
                        <a href="<?php echo e($image); ?>">
                          <img src="<?php echo e($image); ?>" alt="Artwork">
                        </a>
                      </li>
                      <?php $first = false; ?>
                    <?php else: ?>
                      <li style="width: 100px; float: left; display: block;" class="">
                        <a href="<?php echo e($image); ?>">
                          <img src="<?php echo e($image); ?>" alt="Artwork">
                        </a>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <ul class="flex-direction-nav">
                <li><a class="flex-prev flex-disabled" href="#"></a></li>
                <li><a class="flex-next flex-disabled" href="#"></a></li>
              </ul>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 pt-5">
      <ul class="properties">
        <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
            <span class="propertyTitle"><?php echo e($name); ?>: </span><?php echo e($item->{$property} == null ? 'Desconhecido': $item->{$property}); ?>

          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
      <p class="post-content">
        <button id="solicitar-acesso" type="button" class="btn btn-primary">Solicitar acesso</button>
      </p>
      <div class="accordion" id="artist-accordion">
          <div class="accordion-group panel">
              <div class="accordion-heading accordionize"> <a class="accordion-toggle active" data-toggle="collapse" data-parent="#artist-accordion" href="#oneArea" aria-expanded="false"> Mais da mesma série <i class="fa fa-angle-down"></i> </a> </div>
              <div id="oneArea" class="accordion-body" aria-expanded="false">
                  <div class="accordion-inner">
                    <div class="row">
                      <?php $__currentLoopData = $itemModel->getRelationItems($item); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="col-md-6">
                                <a href="<?php echo e(get_page_link(get_queried_object()->ID) . '?id=' . $item->id); ?>">
                                  <img src="<?php echo e($itemModel->getUploadImage($item)); ?>">
                                  <?php if($item->autoria !== null): ?>
                                    <div>Por <?php echo e($item->autoria); ?></div>
                                  <?php else: ?>
                                    <div>Autor desconhecido</div>
                                  <?php endif; ?>
                                </a>
                              </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\acervo\wp-content\plugins\acervo-digital-plugin\src\frontend/single-item.blade.php ENDPATH**/ ?>