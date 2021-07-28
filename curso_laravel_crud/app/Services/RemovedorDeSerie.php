<?php
namespace App\Services;

use App\{Serie,Temporada,Episodio};
use Illuminate\Support\Facades\Storage;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId): string
    {
        $serie = Serie::find($serieId);
        $nomeSerie = $serie->nome;
        $serie->temporadas->each(function (Temporada $temporada) {
            $temporada->episodios()->each(function(Episodio $episodio) {
                $episodio->delete();
            });
            $temporada->delete();

        });
        $serie->delete();

        if($serie->capa)
        {
            Storage::delete($serie->capa);
        }

        return $nomeSerie;
    }
}
