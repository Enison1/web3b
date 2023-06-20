@extends('template')

@section('conteudo')
  <h1>Listagem de Alunos</h1>
  <a href="novo" class="btn btn-primary">Novo</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Figura</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($alunos as $aluno)
          <tr>
            <td>{{$aluno->id}}</td>
            <td>
              @if ($aluno->imagem != "")
                <img style="width: 50px;" src="/storage/imagens/{{$aluno->imagem}}">
              @endif            </td>
            <td>{{$aluno->nome}}</td>
            <td>{{$aluno->email}}</td>
            <td><a class='btn btn-primary' href='editar/{{$aluno->id}}'>+</a></td>
            <td><a class='btn btn-danger' href='excluir/{{$aluno->id}}'>-</a></td>
            <td><a class='btn btn-primary' href='mensagem/{{$aluno->id}}'>Mensagem</a></td>
          </tr>
      @endforeach

   </tbody>
  </table>
@endsection
