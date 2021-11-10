@extends('layouts.app')

@section('title', 'Listagem de Cliente')

@section('sidebar')
@parent
@endsection

@section('grafico')
<div class="row">
    <div class="col-6">
        {{ $chartCliente->container() }}
        {{ $chartCliente->script() }}
    </div>
</div>
@endsection

@section('content')

<h4 style="margin: 20px 0">Lista de Cliente</h4>

<!-- Buscar registro -->
<form action="{{action('App\Http\Controllers\ClienteController@search')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-3">
            <input type="text" name="valor" class="form-control" placeholder="Digite sua busca..." id="">
        </div>
        <div class="col-3">
            <select name="tipo" class="form-control" id="">
                <option value="nome">Nome</option>
                <option value="telefone">Telefone</option>
                <option value="email">Email</option>
                <option value="data_inicio">Data Início</option>
                <option value="data_final">Data Final</option>
            </select>
        </div>
        <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Buscar</button>
        <div class="col">
            <a href="{{url("/cliente/create")}}" class="btn btn-outline-success"><i class="fas fa-plus"></i>
                Cadastrar</a>
            <a href="{{url("/cliente-relatorio")}}" class="btn btn-outline-danger"> <i class="fas fa-file-pdf"></i>
                Relatório</a>
            <a href="{{url("/cliente-email")}}" class="btn btn-outline-secondary"> <i class="fas fa-paper-plane"></i>
                Enviar Email</a>
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
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Email</th>
            <th scope="col">Data Início</th>
            <th scope="col">Data Final</th>
            <th scope="col">Ação</th>
            <th scope="col">Ação</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $item)
        <tr>
            <th scope='row'>{{$item->id}}</th>
            <td>{{$item->nome}}</td>
            <td>{{$item->telefone}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->data_inicio}}</td>
            <td>{{$item->data_final}}</td>
            <td><a href="{{action('App\Http\Controllers\ClienteController@edit', $item->id)}}" style='color: #FFC857'><i
                        class='fas fa-edit'></i></a></td>
            <td><a href="{{action('App\Http\Controllers\ClienteController@destroy', $item->id)}}"
                    onclick="return confirm('Deseja realmente remover o registro?');" style='color:red;'><i
                        class='fas fa-trash'></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">{{ $clientes->links() }}</div>
@endsection
