@php
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
@endphp
<script type="text/javascript">
  root = '{{ get_bloginfo('url') }}';
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
</script>
<div class="container">
  <div class="row">
    <div class="col-md-6 acervo-title">
      <h2 class="short">{{ $item->titulo }}</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-sm-6">
      <div class="single-artwork-images">
        <div class="artwork-slider">
          <div id="artwork-images" class="flexslider format-gallery">
            <ul class="slides">
              <li class="format-image" style="display: list-item;">
                <a href="{{ $itemModel->getUploadImage($item) }}" class="magnific-gallery-image media-box">
                  @if( $item->publicar )
                    <img src="{{ $itemModel->getUploadImage($item) }}" alt="Artwork">
                  @else
                    <img src="{{ $itemModel->getUploadImage($item, true) }}" alt="Artwork">
                  @endif
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
                  @php
                    $first = true;
                  @endphp
                  @foreach($images as $image):
                    @if( $first )
                      <li class="flex-active-slide" style="width: 100px; float: left; display: block;">
                        <a href="{{ $image }}">
                          <img src="{{ $image }}" alt="Artwork">
                        </a>
                      </li>
                      @php $first = false; @endphp
                    @else
                      <li style="width: 100px; float: left; display: block;" class="">
                        <a href="{{ $image }}">
                          <img src="{{ $image }}" alt="Artwork">
                        </a>
                      </li>
                    @endif
                  @endforeach
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
        @foreach($properties as $name => $property)
          <li>
            <span class="propertyTitle">{{ $name }}: </span>{{ $item->{$property} == null ? 'Desconhecido': $item->{$property} }}
          </li>
        @endforeach
      </ul>
      <p class="post-content">
        @if( get_current_user_id() > 0 )
          @if( count( $favorito ) > 0 )
            <button type="button" favorito="{{ $favorito[0]->ID }}" class="btn btn-primary desfavoritar">
              <i class="fa fa-star"></i> Remover de favorito
            </button>
          @else
            <button type="button" item="{{ $item->id }}" user="{{ $userId }}" class="btn btn-primary favoritar">
              <i class="fa fa-star"></i> Favoritar
            </button>
          @endif
          <button type="button" id="solicitar-acesso" class="btn btn-primary">
            Solicitar acesso
          </button>
        @endif
      </p>
      <div class="accordion" id="artist-accordion">
          <div class="accordion-group panel">
              <div class="accordion-heading accordionize"> <a class="accordion-toggle active" data-toggle="collapse" data-parent="#artist-accordion" href="#oneArea" aria-expanded="false"> Mais da mesma série <i class="fa fa-angle-down"></i> </a> </div>
              <div id="oneArea" class="accordion-body" aria-expanded="false">
                  <div class="accordion-inner">
                    <div class="row">
                      @foreach ($itemModel->getRelationItems($item) as $item)
                        <div class="col-md-6">
                          <a href="{{ get_page_link(get_queried_object()->ID) . '?id=' . $item->id }}">
                            <img src="{{ $itemModel->getUploadImage($item) }}">
                            @if($item->autoria !== null)
                              <div>Por {{ $item->autoria }}</div>
                            @else
                              <div>Autor desconhecido</div>
                            @endif
                          </a>
                        </div>
                      @endforeach
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
