
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
        <form method="POST">
            @csrf
            <div class="form-group">
                <label for="nome" >Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome">
            </div>
            <button class="btn btn-dark mb-2">Adicionar</a>
        </form>
        @endsection
