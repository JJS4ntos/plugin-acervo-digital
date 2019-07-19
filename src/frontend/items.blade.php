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
      <!--<img src='http://acervofredericomorais.com.br/arquivos/images/th/{{$item->identificacao}}_da-1_th.jpg'>-->
      <a href="{{ $link }}?id={{$item->id}}"><img src="{{$thumbnail}}" class="thumb-item img-thumbnail wp-post-image"></a>
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
      </div>
    </div>
  </div>
</div>
