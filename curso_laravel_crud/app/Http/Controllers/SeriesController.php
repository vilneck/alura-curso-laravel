<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use App\Temporada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
   function index(Request $request)
   {
       $series = Serie::query()->orderBy('nome')->get();

       $mensagem = $request->session()->get('mensagem');
       $request->session()->remove('mensagem');

       return view('series.index',compact('series','mensagem'));
    }
    function create()
    {
        return view('series.create');
    }

    function editaNome(int $id,Request $request)
    {
        $novoNome = $request->nome;

        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }
    function store(SeriesFormRequest $request,CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie($request->nome,$request->qtd_temporadas,$request->ep_por_temporada);

        $request->session()->flash('mensagem',"Série, temporadas e episódios criados com sucesso!");
        return redirect('/series');
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);

        $request->session()
            ->flash(
                'mensagem',
                "Série $nomeSerie removida com sucesso"
            );
        return redirect()->route('listar_series');
    }
}
