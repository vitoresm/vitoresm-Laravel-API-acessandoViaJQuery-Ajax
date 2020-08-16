@extends('layouts.app', ["current" => "categorias"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">categorias</h5>
            @if(count($categorias))
            <table class="table table-ordered table-hover">
                <thead>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                    @foreach($categorias as $item)
                        
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->nome}}</td>
                            <td>
                                <a href="/categorias/editar/{{$item->id}}" class="btn btn-sm btn-primary">Editar</a>
                                <a href="/categorias/apagar/{{$item->id}}" class="btn btn-sm btn-danger">Apagar</a>
                            </td>
    
                        </tr>                        

                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

        <div class="card-footer">
            <a href="/categorias/novo" class="btn btn-sm btn-primary">Nova categoria</a>
        </div>

    </div>
    
@endsection