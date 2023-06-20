<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlunoMensagem;

class AlunoController extends Controller
{
  function listar() {
    $alunos = Aluno::orderBy('nome')->get();
    return view('listagemAluno',
                  compact('alunos'));
  }

  function novo() {
    $aluno = new Aluno();
    $aluno->id = 0;
    return view('frmAluno', compact('aluno'));
  }

  function salvar(Request $request) {
    if ($request->input('id') == 0) {
      $aluno = new Aluno();
    } else {
      $aluno = Aluno::find($request->input('id'));
    }
    if ($request->hasFile('arquivo')) {
        $file = $request->file('arquivo');
        $upload = $file->store('public/imagens');
        $upload = explode("/", $upload);
        $tamanho = sizeof($upload);
        if ($aluno->imagem != "") {
          Storage::delete("public/imagens/".$aluno->imagem);
        }
        $aluno->imagem = $upload[$tamanho-1];
    }


    $aluno->nome = $request->input('nome');
    $aluno->email = $request->input('email');
    $aluno->save();
    return redirect('aluno/listar');
  }

  function editar($id) {
    $aluno = Aluno::find($id);
    return view('frmAluno', compact('aluno'));
  }

  function excluir($id) {
    $aluno = Aluno::find($id);
    if ($aluno->imagem != "") {
      Storage::delete("public/imagens/".$aluno->imagem);
    }
    $aluno->delete();
    return redirect('aluno/listar');
  }

  function mensagem($id) {
    $aluno = Aluno::find($id) ;
    return view('frmMensagem', compact('aluno'));

  }

  function enviarMensagem(Request $request) {
    $id = $request->input('id');
    $mensagem = $request->input('mensagem');
    $aluno = Aluno::find($id) ;
    Mail::to($aluno->email)->send(new AlunoMensagem($aluno, $mensagem));
    return redirect('aluno/listar');
  }


}
