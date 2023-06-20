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



  <h1>Listagem de Emprestimo</h1>
  <a href="novo" class="btn btn-primary">Novo</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Figura</th>
        <th>Titulo</th>
        <th>Aluno</th>
        <th>Data</th>
        <th>Exemplar</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($emprestimos as $emprestimo)
          <tr>
            <td>{{$emprestimo->id}}</td>
            <td>
              @if ($emprestimo->imagem != "")
                <img style="width: 50px;" src="/storage/imagens/{{$emprestimo->imagem}}">
              @endif            </td>
            <td>{{$emprestimo->titulo}}</td>
            <td>{{$emprestimo->aluno->nome}}</td>
            <td>{{$emprestimo->data->format('d/m/Y')}}</td>
            <td>{{$emprestimo->exemplar->descricao}}</td>
            <td><a class='btn btn-primary' href='editar/{{$emprestimo->id}}'>+</a></td>
            <td><a class='btn btn-danger' href='excluir/{{$emprestimo->id}}'>-</a></td>
          </tr>
      @endforeach

   </tbody>
  </table>
  {{ $emprestimos->links() }}
@endsection
