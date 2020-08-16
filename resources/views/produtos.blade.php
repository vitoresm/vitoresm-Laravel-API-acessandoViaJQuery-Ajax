@extends('layouts.app', ["current" => "categorias"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">categorias</h5>
         
            <table class="table table-ordered table-hover" id="tabelaProdutos">
                <thead>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Departamento</th>
                    <th>Ações</th>
                </thead>
                <tbody>
                                         
                </tbody>
            </table>
    
        </div>

        <div class="card-footer">
            <button class="btn btn-sm btn-primary" onclick="novoProduto()">Nova Produto</button>
        </div>

    </div>

    <div class="modal" tabindex="1" role="dialog" id=dlgProdutos>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formProduto" action="">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Produto</h5>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class="form-group">
                            <label for="nomeProduto" class="control-label"> Nome do produto</label>
                            <input type="text" class="form-control" id="nome">
                        </div>
                        
                        <div class="form-group">
                            <label for="preco" class="control-label">Preço</label>
                            <input type="number" class="form-control" id="preco">
                        </div>

                        <div class="form-group">
                            <label for="estoque" class="control-label">Estoque</label>
                            <input type="number" class="form-control" id="estoque">
                        </div>

                        <div class="form-group">
                            <label for="categoria" class="control-label">Categoria do produto</label>
                            <div class="input-group">
                                <select class="form-control" id="categoria"></select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>

            </div>

        </div>

    </div>
    
@endsection

@section('javascript')
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
        }
    });

    function novoProduto(){
        $('#id').val('');
        $('#nome').val('');
        $('#preco').val('');
        $('#estoque').val('');
        $('#dlgProdutos').modal('show')
    } 

    function carregarCategorias(){
        $.getJSON('/api/categorias', function(data){
          
            for(i=0;i<data.length;i++){
                opcao = '<option value="'+ data[i].id + '">' + data[i].nome + '</option>';
                $('#categoria').append(opcao);
            }
        } )
    }

    function montarLinha(p) {
        var linha = "<tr>" +
            "<td>" + p.id + "</td>" +
            "<td>" + p.nome + "</td>" +
            "<td>" + p.estoque + "</td>" +
            "<td>" + p.preco + "</td>" +  
            "<td>" + p.categoria_id + "</td>" +
            "<td>" +
                '<button class="btn btn-sm btn-primary" onclick="editar('+ p.id +')">Editar</button>' +
                '<button class="btn btn-sm btn-danger" onclick="remover('+ p.id +')">Apagar</button>' +
            "</td>" +
            "</tr>";
            return linha;


    }

    function editar(id){
        $.getJSON('/api/produtos/' + id, function(data){
            $('#id').val(data.id);
            $('#nome').val(data.nome);
            $('#preco').val(data.preco);
            $('#estoque').val(data.estoque);
            $('#categoria').val(data.categoria_id);
            $('#dlgProdutos').modal('show');
            }
         )
    }

    function remover(id) {
                $.ajax({
                    type: "DELETE",
                    url: "/api/produtos/" + id,
                    context: this,
                    success: function() {
                        linhas  = $("#tabelaProdutos>tbody>tr");
                        e = linhas.filter( function(i, elemento){
                            return elemento.cells[0].textContent == id;
                        });
                        if(e){
                            e.remove();
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }       

    function carregarProdutos() {
        $.getJSON('/api/produtos', function(produtos){
          
            for(i=0;i<produtos.length;i++){
               linha = montarLinha(produtos[i]);
    
               $('#tabelaProdutos>tbody').append(linha);
               
            }
        } )
    }
    function criarProduto() {
        produto = {
            nome: $("#nome").val(),
            preco: $("#preco").val(),
            estoque: $("#estoque").val(),
            categoria_id: $("#categoria").val()

        }

        $.post("/api/produtos", produto, function(data){
          
            produto = JSON.parse(data);
            linha = montarLinha(produto); 
    $('#tabelaProdutos>tbody').append(linha);
        });
    }

    function salvarProduto(){
        produto = {
            id: $("#id").val(),
            nome: $("#nome").val(),
            preco: $("#preco").val(),
            estoque: $("#estoque").val(),
            categoria_id: $("#categoria").val()
        };
        console.log(produto);
        $.ajax({
                    type: "PUT",
                    url: "/api/produtos/" + produto.id,
                    context: this,
                    data: produto,
                    success: function(data) {
                        data = JSON.parse(data);
                        linhas  = $("#tabelaProdutos>tbody>tr");
                        e = linhas.filter( function(i, elemento){
                            return elemento.cells[0].textContent == data.id;
                        });
                       
                        if(e){

                            e[0].cells[0].textContent = data.id;
                            e[0].cells[1].textContent = data.nome;
                            e[0].cells[2].textContent = data.preco;
                            e[0].cells[3].textContent = data.estoque;
                            e[0].cells[4].textContent = data.categoria_id;  

                        }
                    },
                    error: function(error) {
                    },
                });
    }

    $("#formProduto").submit( function(event){ 
        event.preventDefault(); 
        if($('#id').val() != '')
            salvarProduto();
        else
            criarProduto();
        $("#dlgProdutos").modal('hide');
        });

    $(function(){
        carregarCategorias();
        carregarProdutos();
    })
</script>

    
@endsection