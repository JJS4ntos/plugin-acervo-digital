<script type="text/javascript">
  root = '{{ get_bloginfo('url') }}';
</script>
<div class="list-item blog-list-item format-standard post-29 artwork type-artwork status-publish has-post-thumbnail hentry">
  <div class='row item'>
    <div class="col-md-4 text-center">
      <!--<img src='http://acervofredericomorais.com.br/arquivos/images/th/{{$item->identificacao}}_da-1_th.jpg'>-->
      <a href="{{ $link }}?id={{$item->id}}"><img src="{{ $thumbnail }}" class="thumb-item img-thumbnail wp-post-image"></a>
    </div>
    <div class='col-md-6'>
      <h3><a href='{{ $link }}?id={{$item->id}}'>{{$item->titulo}}</a></h3>
      <div class="meta-data alt">
        @if($item->autoria !== null)
          <div>Por {{ $item->autoria }}</div>
        @else
          <div>Autor desconhecido</div>
        @endif
      </div>
      <ul>
        <li>Dimensão: {{ $item->dimensao }}</li>
      </ul>
      <p class='text-muted'>{{$item->descricao}}</p>
      <div class="post-actions">
          <a href="{{ $link }}?id={{$item->id}}" class="btn btn-primary btn-default">LEIA MAIS</a>
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
          @endif
      </div>
    </div>
  </div>
</div>
