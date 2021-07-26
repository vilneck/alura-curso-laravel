
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
        <ul class="list-group ">
            @foreach($temporadas as $temporada)
            <li class='list-group-item d-flex justify-content-between'>
                   <a href="/temporadas/{{$temporada->id}}/episodios">Temporada {{$temporada->numero}}</a>
                   <span class="badge badge-secondary">{{$temporada->getEpisodiosAssistidos()->count()}} / {{ $temporada->episodios->count()}}</span>
            </li>
            @endforeach
        </ul>
        @endsection
