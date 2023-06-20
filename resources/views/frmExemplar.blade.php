@extends('template')

@section('conteudo')
  <h1>Cadastro de Exemplar</h1>
  @if ($exemplar->imagem != "")
    <img style="width: 200px;height:200px;object-fit:cover" src="/storage/imagens/{{$exemplar->imagem}}">
  @endif

  <form action="{{url('exemplar/salvar')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3 @if($exemplar->id==0) d-none @endif">
      <label for="id" class="form-label">ID</label>
      <input readonly class="form-control" readonly type="text" name="id" value="{{$exemplar->id}}">
    </div>
    <div class="mb-3">
      <label for="id" class="form-label">Descrição</label>
      <input class="form-control" type="text" name="descricao" value="{{$exemplar->descricao}}">
    </div>
    <div class="mb-3">
      <label for="arquivo" class="form-label">Figura</label>
      <input class="form-control" type="file" name="arquivo" accept="image/*">
    </div>


    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
  </form>
@endsection
