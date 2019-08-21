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
<style>
.modal-header {
  background-color: white;
  height: 45px;
}

.modal-dialog-acervo {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}

.modal-content-acervo {
  height: auto;
  min-height: 100%;
  border-radius: 0;
}
</style>
<script type="text/javascript" defer>
  function resizeIframe(obj) {
    //obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }

  root = '<?php echo e(get_bloginfo('url')); ?>';
  
  $(document).ready(function(){
    var el = document.getElementById("telefone");
    VMasker(el).maskPattern("(99) 9999-9999");
  });
  $('#solicitar-acesso').click(function(){
    if( $('#telefone').val() !== '' && $('#telefone').val() !== '' ) {
      $.ajax({
        url: '<?php echo e($url); ?>' + '/wp-json/acervo-api/solicitar-acesso',
        type: 'POST',
        dataType: 'json',
        data: {
          itemId: '<?php echo e($_GET['id']); ?>',
          userId: <?php echo e(get_current_user_id()); ?>,
          telefone: $('#telefone').val(),
          justificativa: $('#justificativa').val()
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
    } else {
      alert('Preencha todos os campos para realizar uma solicitação');
    }
  });
</script>
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
                <a href="<?php echo e($itemModel->getUploadImage($item)); ?>" class="media-box"  data-toggle="modal" data-target=".bd-example-modal-xl">
                  <?php if( $item->publicar ): ?>
                    <img src="<?php echo e($itemModel->getUploadImage($item)); ?>" >
                  <?php else: ?>
                    <img src="<?php echo e($itemModel->getUploadImage($item, true)); ?>">
                  <?php endif; ?>
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
                        <a href="<?php echo e($image); ?>" data-toggle="modal" data-target=".bd-example-modal-xl">
                          <img src="<?php echo e($image); ?>" alt="Artwork">
                        </a>
                      </li>
                      <?php $first = false; ?>
                    <?php else: ?>
                      <li style="width: 100px; float: left; display: block;" class="">
                        <a href="<?php echo e($image); ?>" data-toggle="modal" data-target=".bd-example-modal-xl">
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
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAcesso">
            Solicitar acesso
          </button>
        <?php endif; ?>
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
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog-acervo modal-xl">
    <div class="modal-content-acervo">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAcessoTitle"><?php echo e($item->titulo); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="embed-responsive embed-responsive-16by9">
          <!--<iframe class="embed-responsive-item" src="http://<?php echo e($markedFiles[0]); ?>" frameborder="0"></iframe>-->
          <iframe class="embed-responsive-item" src="http://45.76.12.210/arquivos/images/publico_marca/BRFM_AM_18_0003_da_pubmd.pdf" frameborder="0" scrolling="no" onload="resizeIframe(this)"></iframe>
        </div> 
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAcesso" tabindex="-1" role="dialog" aria-labelledby="modalAcesso" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAcessoTitle">Formulário de solicitação de acesso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="justificativa">Justificativa:</label>
          <input class="form-control" type="text" name="justificativa" id="justificativa" placeholder="Informe a justificativa" required>
        </div>
        <div class="form-group">
          <label for="telefone">Telefone:</label>
          <input class="form-control" type="text" name="telefone" id="telefone" placeholder="Digite o seu telefone" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="solicitar-acesso" class="btn btn-primary">
          Solicitar acesso
        </button>
      </div>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\acervo\wp-content\plugins\acervo-digital-plugin\src\frontend/single-item.blade.php ENDPATH**/ ?>