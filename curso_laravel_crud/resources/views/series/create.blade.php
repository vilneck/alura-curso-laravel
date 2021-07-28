@extends('layout')

@section('cabecalho')
    Séries
@endsection

@section('conteudo')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col col-8">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome">
            </div>
            <div class="col col-2">
                <label for="qtd_temporadas">Qtd temporadas:</label>
                <input type="number" class="form-control" id="qtd_temporadas" name="qtd_temporadas">
            </div>
            <div class="col col-2">
                <label for="ep_por_temporada">Episódios:</label>
                <input type="number" class="form-control" id="ep_por_temporada" name="ep_por_temporada">
            </div>
        </div>
        <div class="row">
            <div class="col col-12">
                <label for="capa">Capa:</label>
                <input type="file" class="form-control" id="capa" name="capa">
            </div>
        </div>
        <button class="btn btn-dark mb-2 mt-2">Adicionar</a>
    </form>
@endsection
