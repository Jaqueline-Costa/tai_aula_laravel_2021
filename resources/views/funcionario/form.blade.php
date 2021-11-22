@extends('layouts.app')

@section('title', 'Forlmulário de Funcionário')

@section('sidebar')
@parent
@endsection

@section('script')
<script>
    $(document).ready(function($){
        $('#telefon').mask('(00) 00000-0000');
        $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
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
$action = action('App\Http\Controllers\FuncionarioController@update', $funcionario->id);
}else{
$action = action('App\Http\Controllers\FuncionarioController@store');
};
@endphp

<h4 style="margin: 20px 0 40px 0 ">Formulário de Funcionários</h4>

<form action="{{$action}}" method="post">
    @csrf

    <div class="form-row">
        <input type="hidden" name="id"
        value="@if (!empty(old('id'))) {{old('id')}} @elseif (!empty($funcionario->id)){{$funcionario->id}} @endif">

        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome"
                value="@if (!empty(old('nome'))) {{old('nome')}} @elseif (!empty($funcionario->nome)){{$funcionario->nome}} @endif"
                placeholder="Nome" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="cnpj">CNPJ</label>
            <input type="text" name="cnpj" id="cnpj"
                value="@if (!empty(old('cnpj'))) {{old('cnpj')}} @elseif (!empty($funcionario->cnpj)){{$funcionario->cnpj}} @endif"
                placeholder="00.000.000/0000-00" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="funcionario_categoria_id">Categoria</label>
            <select name="funcionario_categoria_id" class="form-control">
                @foreach ($funcionario_categorias as $item)
                <option value="{{$item->id}}" @if($item->id == old('funcionario_categoria_id',
                    !empty($funcionario->funcionario_categoria_id))) selected="selected" @endif >
                    {{$item->nome}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="telefon">Telefone</label>
            <input type="text" name="telefon" id="telefon"
                value="@if (!empty(old('telefon'))) {{old('telefon')}} @elseif (!empty($funcionario->telefon)){{$funcionario->telefon}} @endif"
                placeholder="(00) 00000-0000" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="salario">Salário</label>
            <input type="text" name="salario" id="salario"
                value="@if (!empty(old('salario'))) {{old('salario')}} @elseif (!empty($funcionario->salario)){{$funcionario->salario}} @endif"
                placeholder="R$" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="horario">Horário</label>
            <input type="horario" name="horario" id="horario"
                value="@if (!empty(old('horario'))) {{old('horario')}} @elseif (!empty($funcionario->horario)){{$funcionario->horario}} @endif"
                placeholder="hh:mm - hh:mm" class="form-control">
        </div>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{url("/funcionario")}}" class="btn btn-info"><i class="fas fa-chevron-left"></i> Voltar</a>
</form>
@endsection
