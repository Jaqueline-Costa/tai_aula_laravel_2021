@extends('layouts.app')

@section('title', 'Forlmulário de Estoque')

@section('sidebar')
@parent
@endsection

@section('script')
<script>
    $(document).ready(function($){
        $('#telefone').mask('(00) 00000-0000');
    });
</script>
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@php
if(!empty(Request::route('id'))){
    $action = action('App\Http\Controllers\ClienteController@update', $cliente->id);
}else{
    $action = action('App\Http\Controllers\ClienteController@store');
}
@endphp

<h4 style="margin: 20px 0 40px 0 ">Formulário de Clientes</h4>

<form action="{{$action}}" method="post">
    @csrf

    <div class="form-row">
        <input type="hidden" name="id"
        value="@if (!empty(old('id'))) {{old('id')}} @elseif (!empty($cliente->id)){{$cliente->id}} @endif">

        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome"
            value="@if (!empty(old('nome'))) {{old('nome')}} @elseif (!empty($cliente->nome)){{$cliente->nome}} @endif"
            placeholder="Nome" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone"
            value="@if (!empty(old('telefone'))) {{old('telefone')}} @elseif (!empty($cliente->telefone)){{$cliente->telefone}} @endif"
            placeholder="(00) 00000-0000" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" name="email" id="email"
            value="@if (!empty(old('email'))) {{old('email')}} @elseif (!empty($cliente->email)){{$cliente->email}} @endif"
            placeholder="exemplo@gmail.com" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label for="data_inicio">Data Início</label>
            <input type="date" name="data_inicio" id="data_inicio"
            value="@if (!empty(old('data_inicio'))) {{old('data_inicio')}} @elseif (!empty($cliente->data_inicio)){{$cliente->data_inicio}} @endif"
            placeholder="dd/mm/aaaa" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label for="data_final">Data Final</label>
            <input type="date" name="data_final" id="data_final"
            value="@if (!empty(old('data_final'))) {{old('data_final')}} @elseif (!empty($cliente->data_final)){{$cliente->data_final}} @endif"
            placeholder="dd/mm/aaaa" class="form-control">
        </div>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{url("/cliente")}}" class="btn btn-info"><i class="fas fa-chevron-left"></i> Voltar</a>
</form>
@endsection
