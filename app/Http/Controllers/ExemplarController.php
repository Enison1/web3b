<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Exemplar;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ExemplarController extends Controller
{
    //
    function listar() {
      $exemplares = Exemplar::orderBy('id')->get();
      return view('listagemExemplar',
                    compact('exemplares'));
    }

    function novo() {
      $exemplar = new Exemplar();
      $exemplar->id = 0;
      $exemplar->imagem = "";
      $exemplar->descricao = "";
      return view('frmExemplar', compact('exemplar'));
    }

    function salvar(Request $request) {
      if ($request->input('id') == 0) {
        $exemplar = new Exemplar();
      } else {
        $exemplar = Exemplar::find($request->input('id'));
      }
      if ($request->hasFile('arquivo')) {
          $file = $request->file('arquivo');
          $upload = $file->store('public/imagens');
          $upload = explode("/", $upload);
          $tamanho = sizeof($upload);
          if ($exemplar->imagem != "") {
            Storage::delete("public/imagens/".$exemplar->imagem);
          }
          $exemplar->imagem = $upload[$tamanho-1];
      }

      $exemplar->descricao = $request->input('descricao');
      $exemplar->save();
      return redirect('exemplar/listar');
    }

    function editar($id) {
      $exemplar = Exemplar::find($id);
      return view('frmExemplar', compact('exemplar'));
    }

    function excluir($id) {
      $exemplar = Exemplar::find($id);
      if ($exemplar->imagem != "") {
        Storage::delete("public/imagens/".$exemplar->imagem);
      }
      try {
        $exemplar->delete();
      } catch(\Exception $e) {
        return redirect('exemplar/listar')->with(['msg' => 'Exemplar não pode ser excluída']);
      }
      return redirect('exemplar/listar')->with(['msg'=> 'Exemplar excluída']);

    }

    function relatorio() {
      $exemplares = Exemplar::orderBy('descricao')->get();
      $pdf = Pdf::loadView('relatorioExemplar', compact('exemplares'));
      return $pdf->download('exemplares.pdf');
    }
}
