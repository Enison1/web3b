@extends('templateNews')

@section('conteudo')
  <main>
    <h1 style="font-size: 3rem;color: blue;display:flex;align-items: center;justify-content:space-between">{{$livroAtual->categoria->descricao}}
      <img style="width: 25%;aspect-ratio: 2;object-fit: cover;" src="/storage/imagens/{{$livroAtual->categoria->imagem}}">
    </h1>
    <h2 style="color: green;margin-top: 2rem;">{{$livroAtual->titulo}}</h2>
    <h3 style="font-size: 0.75rem;"><img style="width:50px;height:50px;object-fit:cover;border-radius:50%;" src="/storage/imagens/{{$livroAtual->autor->imagem}}">{{$livroAtual->autor->nome}} - {{$livroAtual->data->format('d/m/Y')}}</h3>
    <img style="width:100%;height:10rem;object-fit:cover" src="/storage/imagens/{{$livroAtual->imagem}}">
    <p style="margin-top: 2rem;">{{$livroAtual->descricao}}</p>
  </main>
  <div class="">
    @foreach($livrosCategoria as $livro)
    <div style="display:flex;border-bottom:1px dotted gray; padding: 0.5rem;">
      <img style="width:25%; aspect-ratio: 2;object-fit:cover;" src="/storage/imagens/{{$livro->imagem}}">
      <div style="display: flex; flex-direction: column;
      align-items: center;justify-content: center;flex-grow: 1">
        <h1 style="font-size: 1rem;"><a href='{{url("news/livro/$livro->id")}}'>
          {{$livro->titulo}}</a></h1>
        <p style="font-size:0.75rem">{{$livro->autor->nome}} - {{$livro->data->format('d/m/Y')}} </p>
      </div>
    </div>
    @endforeach
    {{$livrosCategoria->links()}}
  </div>
@endsection
