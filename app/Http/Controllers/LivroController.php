<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Categoria;
use App\Models\Autor;
use App\Http\Requests\LivroRequest;
use Illuminate\Support\Facades\Storage;


class LivroController extends Controller
{
  function listar() {
    $livros = Livro::orderByRaw('data, id')->paginate(5);
    return view('listagemLivro',
                compact('livros'));
   }

   function novo() {
     $livro = new Livro();
     $livro->id = 0;
     $livro->data = now();
     $categorias = Categoria::orderBy('descricao')->get();
     $autores = Autor::orderBy('nome')->get();
     return view('frmLivro', compact('livro', 'categorias', 'autores'));
   }

   function salvar(LivroRequest $request) {

     if ($request->input('id') == 0) {
       $livro = new Livro();
     } else {
       $livro = Livro::find($request->input('id'));
     }
     if ($request->hasFile('arquivo')) {
         $file = $request->file('arquivo');
         $upload = $file->store('public/imagens');
         $upload = explode("/", $upload);
         $tamanho = sizeof($upload);
         if ($livro->imagem != "") {
           Storage::delete("public/imagens/".$livro->imagem);
         }
         $livro->imagem = $upload[$tamanho-1];
     }

     $livro->titulo = $request->input('titulo');
     $livro->descricao = $request->input('descricao');
     $livro->autor_id = $request->input('autor_id');
     $livro->data = $request->input('data');
     $livro->categoria_id = $request->input('categoria_id');
     $livro->save();
     return redirect('livro/listar')
     ->with(['msg' => "Notícia '$livro->titulo' foi salva"]);
   }



   function salvarOld(Request $request) {
     $validated = $request->validate([
             'titulo' => 'required',
             'texto' => 'required',
             'data' => 'required',
             'autor_id' => 'required|exists:autor,id',
             'categoria_id' => 'required|exists:categoria,id'
         ]);

     if ($request->input('id') == 0) {
       $livro = new Livro();
     } else {
       $livro = Livro::find($request->input('id'));
     }
     $livro->titulo = $request->input('titulo');
     $livro->descricao = $request->input('descricao');
     $livro->autor_id = $request->input('autor_id');
     $livro->data = $request->input('data');
     $livro->categoria_id = $request->input('categoria_id');
     $livro->save();
     return redirect('livro/listar');
   }

   function editar($id) {
     $livro = Livro::find($id);
     $categorias = Categoria::orderBy('descricao')->get();
     $autores = Autor::orderBy('nome')->get();
     return view('frmLivro', compact('livro', 'categorias', 'autores'));
   }

   function excluir($id) {
     $livro = Livro::find($id);
     $titulo = $livro->titulo;
     if ($livro->imagem != "") {
       Storage::delete("public/imagens/".$livro->imagem);
     }

     $livro->delete();

     return redirect('livro/listar')
        ->with(['msg' => "Notícia $titulo foi excluída"]);
   }



}
