<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Events\NovaSerie as EventsNovaSerie;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\NovaSerie;
use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use App\Temporada;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $serie = $criadorDeSerie->criarSerie($request->nome,$request->qtd_temporadas,$request->ep_por_temporada,$request->capa);
        if($request->hasFile('capa'))
        {
            $serie->capa = $request->file('capa')->store('serie');
            $serie->save();
        }

        $eventoNovaSerie = new EventsNovaSerie($request->nome,$request->qtd_temporadas,$request->ep_por_temporada);
        event($eventoNovaSerie);

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
