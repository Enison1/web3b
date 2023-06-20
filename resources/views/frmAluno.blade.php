@extends('template')

@section('conteudo')
  <h1>Cadastro de Aluno</h1>
  @if ($aluno->imagem != "")
    <img style="width: 200px;height:200px;object-fit:cover" src="/storage/imagens/{{$aluno->imagem}}">
  @endif

  <form action="{{url('aluno/salvar')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="id" class="form-label">ID</label>
      <input readonly class="form-control" readonly type="text" name="id" value="{{$aluno->id}}">
    </div>
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input class="form-control" type="text" name="nome" value="{{$aluno->nome}}">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">E-mail</label>
      <input class="form-control" type="email" name="email" value="{{$aluno->email}}">
    </div>
    <div class="mb-3">
      <label for="arquivo" class="form-label">Figura</label>
      <input class="form-control" type="file" name="arquivo" accept="image/*">
    </div>


    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
  </form>
@endsection
