@extends('layouts.app', ["current" => "categorias"])

@section('body')

<div class="card-border">
    <div class="card-body">
        <form action="/categorias" method="POST">
        @csrf

        <div class="form-group">
            <label for="nomeCategoria">Nome da categoria</label>
            <input type="text" class="form-control" name="nomeCategoria" placeholder="ex.. celular">

        </div>
        <button type="submit" class="btn btn-sm btn-primary">Salvar</button>
        </form>
    </div>

</div>
    
@endsection