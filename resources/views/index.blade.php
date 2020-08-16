@extends('layouts.app', ["current" => "inicio"])

@section('body')
    <div class="jumbotron bg-light border border-secondary">
        <div class="row">
            <div class="card-deck">
                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de produto</h5>

                        <p class="card-text">cadastre novos produtos!</p>

                        <a href="/produtos">Cadastrar</a>
                    </div>
                </div> 
                
                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastra nova categoria</h5>

                        <p class="card-text">Cadastre categorias dos produtos!</p>

                        <a href="/categorias">Categorias</a>
                    </div>
                </div>

            </div>

            
        </div>

    </div>
@endsection