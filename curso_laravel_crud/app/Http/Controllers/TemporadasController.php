<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;

class TemporadasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(int $serieId)
    {
        $serie = Serie::find($serieId);
        $temporadas = $serie->temporadas;

        return view('temporadas.index',compact('temporadas','serie'));
    }
}
