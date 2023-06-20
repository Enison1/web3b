<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emprestimo;
use App\Models\Exemplar;
use App\Models\Aluno;
use App\Http\Requests\EmprestimoRequest;
use Illuminate\Support\Facades\Storage;


class EmprestimoController extends Controller
{
  function listar() {
    $emprestimos = Emprestimo::orderByRaw('data, id')->paginate(5);
    return view('listagemEmprestimo',
                compact('emprestimos'));
   }

   function novo() {
     $emprestimo = new Emprestimo();
     $emprestimo->id = 0;
     $emprestimo->data = now();
     $exemplares = Exemplar::orderBy('descricao')->get();
     $alunos = Aluno::orderBy('nome')->get();
     return view('frmEmprestimo', compact('emprestimo', 'exemplares', 'alunos'));
   }

   function salvar(EmprestimoRequest $request) {

     if ($request->input('id') == 0) {
       $emprestimo = new Emprestimo();
     } else {
       $emprestimo = Emprestimo::find($request->input('id'));
     }
     if ($request->hasFile('arquivo')) {
         $file = $request->file('arquivo');
         $upload = $file->store('public/imagens');
         $upload = explode("/", $upload);
         $tamanho = sizeof($upload);
         if ($emprestimo->imagem != "") {
           Storage::delete("public/imagens/".$emprestimo->imagem);
         }
         $emprestimo->imagem = $upload[$tamanho-1];
     }

     $emprestimo->titulo = $request->input('titulo');
     $emprestimo->descricao = $request->input('descricao');
     $emprestimo->aluno_id = $request->input('aluno_id');
     $emprestimo->data = $request->input('data');
     $emprestimo->exemplar_id = $request->input('exemplar_id');
     $emprestimo->save();
     return redirect('emprestimo/listar')
     ->with(['msg' => "Notícia '$emprestimo->titulo' foi salva"]);
   }



   function salvarOld(Request $request) {
     $validated = $request->validate([
             'titulo' => 'required',
             'texto' => 'required',
             'data' => 'required',
             'aluno_id' => 'required|exists:aluno,id',
             'exemplar_id' => 'required|exists:exemplar,id'
         ]);

     if ($request->input('id') == 0) {
       $emprestimo = new Emprestimo();
     } else {
       $emprestimo = Emprestimo::find($request->input('id'));
     }
     $emprestimo->titulo = $request->input('titulo');
     $emprestimo->descricao = $request->input('descricao');
     $emprestimo->aluno_id = $request->input('aluno_id');
     $emprestimo->data = $request->input('data');
     $emprestimo->exemplar_id = $request->input('exemplar_id');
     $emprestimo->save();
     return redirect('emprestimo/listar');
   }

   function editar($id) {
     $emprestimo = Emprestimo::find($id);
     $exemplares = Exemplar::orderBy('descricao')->get();
     $alunos = Aluno::orderBy('nome')->get();
     return view('frmEmprestimo', compact('emprestimo', 'exemplares', 'alunos'));
   }

   function excluir($id) {
     $emprestimo = Emprestimo::find($id);
     $titulo = $emprestimo->titulo;
     if ($emprestimo->imagem != "") {
       Storage::delete("public/imagens/".$emprestimo->imagem);
     }

     $emprestimo->delete();

     return redirect('emprestimo/listar')
        ->with(['msg' => "Notícia $titulo foi excluída"]);
   }



}
