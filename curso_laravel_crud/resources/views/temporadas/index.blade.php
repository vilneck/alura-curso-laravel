
        @extends('layout')

        @section('cabecalho')
        Temporadas - {{$serie->nome}}
        @endsection

        @section('conteudo')
        @if (!empty($mensagem))
        <div class="alert alert-success">
            {{$mensagem}}
        </div>
        @endif
        <div class="row">
            <div class="col-12 text-center mb-4">
                <img src="{{$serie->capa_url}}" alt="" class="img-thumbnail" width="400px" height="400px">
            </div>
        </div>
        <ul class="list-group ">
            @foreach($temporadas as $temporada)
            <li class='list-group-item d-flex justify-content-between'>
                   <a href="/temporadas/{{$temporada->id}}/episodios">Temporada {{$temporada->numero}}</a>
                   <span class="badge badge-secondary">{{$temporada->getEpisodiosAssistidos()->count()}} / {{ $temporada->episodios->count()}}</span>
            </li>
            @endforeach
        </ul>
        @endsection
