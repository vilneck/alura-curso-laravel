<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
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
    function destroy(Request $request)
    {
        Serie::destroy($request->id);
        $request->session()->flash('mensagem',"Série removida com sucesso!");
        return redirect('/series');
    }
    function store(SeriesFormRequest $request)
    {
        $serie = Serie::create($request->all());
        $request->session()->flash('mensagem',"Série criada com sucesso!");
        return redirect('/series');
    }
}
