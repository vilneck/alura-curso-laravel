<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Serie extends Model
{
    protected $fillable = ['nome','capa'];

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }

    function getCapaUrlAttribute()
    {
        if(!$this->capa)
        {
            return Storage::url('/serie/sem-imagem.jpg');
        }
        return Storage::url($this->capa);
    }
}
