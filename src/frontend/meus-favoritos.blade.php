<div class="container">
  <div class="row">
    <div class="col-md-12">
      @forelse( $favoritos as $favorito )
      <div class="list-group">
        <a href="{{ $link . '?id=' . $favorito[0]->id }}" class="list-group-item">
          <h4 class="list-group-item-heading">{{ $favorito[0]->titulo }}</h4>
          <p class="list-group-item-text">{{ $favorito[0]->descricao }}</p>
        </a>
      </div>
      @empty
      <div class="alert alert-info" role="alert">
        <p class="text-muted"><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;Não há nenhum item favoritado por você, por enquanto.</p>
      </div>
      @endforelse
    </div>  
  </div>
</div>
