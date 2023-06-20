@extends('template')

@section('conteudo')
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <h1>Cadastro de Emprestimos</h1>
  @if ($emprestimo->imagem != "")
    <img style="width: 200px;height:200px;object-fit:cover" src="/storage/imagens/{{$emprestimo->imagem}}">
  @endif


  <form action="{{url('emprestimo/salvar')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="id" class="form-label">ID</label>
      <input readonly class="form-control" readonly type="text" name="id" value="{{$emprestimo->id}}">
    </div>
    <div class="mb-3">
      <label for="id" class="form-label">Título</label>
      <input class="form-control @error('titulo') is-invalid @enderror" type="text" name="titulo" value="{{old('titulo', $emprestimo->titulo)}}">
      @error('titulo')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="descricao" class="form-label">Descrição</label>
      <input class="form-control @error('descricao') is-invalid @enderror" type="text" name="descricao" value="{{old('descricao', $emprestimo->descricao)}}">
      @error('descricao')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

    </div>
    <div class="mb-3">
      <label for="data" class="form-label">Data</label>
      <input class="form-control @error('data') is-invalid @enderror" type="date" name="data" value="{{old('data', $emprestimo->data->format('Y-m-d'))}}">
      @error('data')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

    </div>
    <div class="mb-3">
      <label for="aluno" class="form-label">Aluno</label>
      <select class="form-select @error('aluno_id') is-invalid @enderror" name="aluno_id">
        @foreach($alunos as $aluno)
          <option {{ $aluno->id == old('aluno_id', $emprestimo->aluno_id) ?'selected': ''}} value="{{$aluno->id}} ">{{$aluno->nome}}</option>
        @endforeach
      </select>
      @error('aluno_id')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

    </div>
    <div class="mb-3">
      <label for="exemplar_id" class="form-label">Exemplar</label>
      <select class="form-select @error('exemplar_id') is-invalid @enderror" name="exemplar_id">
        @foreach($exemplares as $exemplar)
          <option {{ $exemplar->id == old('exemplar_id', $emprestimo->exemplar_id) ?'selected': ''}} value="{{$exemplar->id}} ">{{$exemplar->descricao}}</option>
        @endforeach
      </select>
      @error('exemplar_id')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

    </div>
    <div class="mb-3">
      <label for="arquivo" class="form-label">Figura</label>
      <input class="form-control" type="file" name="arquivo" accept="image/*">
    </div>

    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
  </form>
@endsection
