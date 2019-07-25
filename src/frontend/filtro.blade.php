<h3>Encontre itens do acervo através de busca.</h3>
<form>
  <div class="row">
    <div class="col-md-3">
      <input type="text" class="form-control" placeholder="Digite o nome ou código do item" name="search">
    </div>
    <div class="col-md-3">
      <select class="form-control" name="colecao" id="colecao">
        <option value="">Selecione a coleção...</option>
        @foreach( $colecoes as $colecao )
          <option value="{{ $colecao->id }}">{{ $colecao->colecao }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-control" name="grupo" id="grupo">
        <option value="">Selecione a grupo...</option>
      </select>
    </div>
    <div class="col-md-3">
      <select class="form-control" name="serie" id="serie">
        <option value="">Selecione a série...</option>
      </select>
    </div>
  </div>
  <div class="row justify-content-end">
    <div class="col-md-3">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
  </div>
</form>

<hr>
