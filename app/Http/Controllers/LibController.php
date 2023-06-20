<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Livro;


class LibController extends Controller
{
    function index() {
      $categorias = Categoria::orderBy('descricao')->get();

      $ultimasLivros = Livro::orderBy('data', 'desc')->limit(5)->get();

      return view('lib', compact('categorias', 'ultimasLivros'));
    }

    function livro($id) {
      $livroAtual = Livro::find($id);
      $categorias = Categoria::orderBy('descricao')->get();
      $livrosCategoria = Livro::where('categoria_id',
        $livroAtual->categoria->id)->orderBy('data', 'desc')->paginate(5);
      return view('livro', compact('livroAtual', 'categorias', 'livrosCategoria'));
    }

    function categoria($id) {
      $categorias = Categoria::orderBy('descricao')->get();
      $livrosCategoria = Livro::where('categoria_id',
        $id)->orderBy('data', 'desc')->paginate(5);
      $livroAtual = $livrosCategoria
      ->shift();
      return view('livro', compact('livroAtual', 'categorias', 'livrosCategoria'));
    }
}
