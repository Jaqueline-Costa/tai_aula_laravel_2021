@extends('layouts.app')

@section('title', 'Lista de Peça')

@section('sidebar')
@parent
@endsection

@section('grafico')
<div class="row">
    <div class="col-6">
        {{ $chartPeca->container() }}
        {{ $chartPeca->script() }}
    </div>
</div>
@endsection

@section('content')

<h4 style="margin: 20px 0">Listagem de Peças</h4>

<!-- Buscar registro -->
<form action="{{action('App\Http\Controllers\PecaController@search')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-3">
            <input type="text" name="valor" class="form-control" placeholder="Digite sua busca..." id="">
        </div>
        <div class="col-3">
            <select name="tipo" class="form-control" id="">
                <option value="nome">Nome</option>
                <option value="marca">Marca</option>
                <option value="categoria">Categoria</option>
                <option value="quantidade">Quantidade</option>
                <option value="preco">Preço</option>
            </select>
        </div>
        <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Buscar</button>
        <div class="col">
            <a href="{{url("/peca/create")}}" class="btn btn-outline-success"><i class="fas fa-plus"></i> Cadastrar</a>
            <a href="{{url("/peca-relatorio")}}" class="btn btn-outline-danger"> <i class="fas fa-file-pdf"></i> Relatório</a>
        </div>
    </div>
</form>

<!-- Lista de registros -->
<table class="table table-hover">
    <br><br>
    <thead>
        <tr>
            <!--cabeçalho-->
            <th scope="col">ID</th>
            <th scope="col">Imagem</th>
            <th scope="col">Nome</th>
            <th scope="col">Marca</th>
            <th scope="col">Categoria</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Preço</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pecas as $item)
        @php
        !empty($item->nome_arquivo) ? $nome_arquivo = $item->nome_arquivo : $nome_arquivo = "sem_img.png";
        @endphp
            <tr>
                <th scope='row'>{{$item->id}}</th>
                <td><img src="/storage/imagem/{{$nome_arquivo}}" width="100px"/></td>
                <td>{{$item->nome}}</td>
                <td>{{$item->marca}}</td>
                <td>{{$item->categorias->nome ?? "" }}</td>
                <td>{{$item->quantidade}}</td>
                <td>{{$item->preco}}</td>
                <td><a href="{{action('App\Http\Controllers\PecaController@edit', $item->id)}}"  style='color: #FFC857'><i class='fas fa-edit'></i></a></td>
                <td><a href="{{action('App\Http\Controllers\PecaController@destroy', $item->id)}}"  onclick="return confirm('Deseja realmente remover o registro?');" style='color:red;'><i class='fas fa-trash'></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">{{ $pecas->links() }}</div>

@endsection
