<?php

namespace App\Http\Controllers;

use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    public function index(Request $request,Temporada $temporada)
    {
        $episodios = $temporada->episodios;
        $mensagem = $request->session()->get('mensagem');
        $request->session()->remove('mensagem');

        return view('episodios.index', compact('episodios', 'temporada','mensagem'));
    }

    public function assistir(Temporada $temporada, Request $request)
    {
        $epsAssistidos = $request->episodios;
        $temporada->episodios->each(function ($episodio) use ($epsAssistidos) {
            $episodio->assistido = in_array($episodio->id,$epsAssistidos)?true:false;
        });
        $temporada->push();

        $request->session()->flash('mensagem',"Episódios assistidos com sucesso!");

        return redirect()->back();
    }
}
