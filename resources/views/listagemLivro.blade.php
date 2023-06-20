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



  <h1>Listagem de Livro</h1>
  <a href="novo" class="btn btn-primary">Novo</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Figura</th>
        <th>Titulo</th>
        <th>Autor</th>
        <th>Data</th>
        <th>Categoria</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($livros as $livro)
          <tr>
            <td>{{$livro->id}}</td>
            <td>
              @if ($livro->imagem != "")
                <img style="width: 50px;" src="/storage/imagens/{{$livro->imagem}}">
              @endif            </td>
            <td>{{$livro->titulo}}</td>
            <td>{{$livro->autor->nome}}</td>
            <td>{{$livro->data->format('d/m/Y')}}</td>
            <td>{{$livro->categoria->descricao}}</td>
            <td><a class='btn btn-primary' href='editar/{{$livro->id}}'>+</a></td>
            <td><a class='btn btn-danger' href='excluir/{{$livro->id}}'>-</a></td>
          </tr>
      @endforeach

   </tbody>
  </table>
  {{ $livros->links() }}
@endsection
