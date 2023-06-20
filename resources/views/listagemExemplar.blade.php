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


  <h1>Listagem de Exemplares</h1>
  <a href="novo" class="btn btn-primary">Novo</a>
  <a href="relatorio" class="btn btn-primary">Relatório</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Descrição</th>
        <th>Figura</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($exemplares as $exemplar)
          <tr>
            <td>{{$exemplar->id}}</td>
            <td>{{$exemplar->descricao}}</td>
            <td>
              @if ($exemplar->imagem != "")
                <img style="width: 50px;" src="/storage/imagens/{{$exemplar->imagem}}">
              @endif            </td>
            <td><a class='btn btn-primary' href='editar/{{$exemplar->id}}'>+</a></td>
            <td><a class='btn btn-danger' href='excluir/{{$exemplar->id}}'>-</a></td>
          </tr>
      @endforeach

   </tbody>
  </table>
@endsection
