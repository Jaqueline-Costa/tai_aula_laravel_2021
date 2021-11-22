@extends('layouts.app')

@section('title', 'Listagem de Funcionário')

@section('sidebar')
    @parent
@endsection

@section('content')

<h4 style="margin: 20px 0">Listagem de Funcionários</h4>

<!-- Buscar registro -->
<form action="{{action('App\Http\Controllers\FuncionarioController@search')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-3">
            <input type="text" name="valor" class="form-control" placeholder="Digite sua busca..." id="">
        </div>
        <div class="col-3">
            <select name="tipo" class="form-control" id="">
                <option value="nome">Nome</option>
                <option value="cnpj">CNPJ</option>
                <option value="categoria">Categoria</option>
                <option value="telefon">Telefone</option>
                <option value="salario">Salário</option>
                <option value="horario">Horário</option>
            </select>
        </div>
        <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Buscar</button>
        <div class="col">
            <a href="{{url("/funcionario/create")}}" class="btn btn-outline-success"><i class="fas fa-plus"></i> Cadastrar</a>
            <a href="{{url("/funcionario-relatorio")}}" class="btn btn-outline-danger"> <i class="fas fa-file-pdf"></i> Relatório</a>
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
            <th scope="col">CNPJ</th>
            <th scope="col">Categoria</th>
            <th scope="col">Telefone</th>
            <th scope="col">Salário</th>
            <th scope="col">Horário</th>
            <th scope="col">Editar</th>
            <th scope="col">Excluir</th>
        </tr>
    </thead>
    <tbody>
        @foreach($funcionarios as $item)
            <tr>
                <th scope='row'>{{$item->id}}</th>
                <td>{{$item->nome}}</td>
                <td>{{$item->cnpj}}</td>
                <td>{{$item->categorias->nome ?? "" }}</td>
                <td>{{$item->telefon}}</td>
                <td>{{$item->salario}}</td>
                <td>{{$item->horario}}</td>
                <td><a href="{{action('App\Http\Controllers\FuncionarioController@edit', $item->id)}}"  style='color: #FFC857'><i class='fas fa-edit'></i></a></td>
                <td><a href="{{action('App\Http\Controllers\FuncionarioController@destroy', $item->id)}}"  onclick="return confirm('Deseja realmente remover o registro?');" style='color:red;'><i class='fas fa-trash'></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">{{ $funcionarios->links() }}</div>
@endsection
