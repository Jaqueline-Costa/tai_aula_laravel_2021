@extends('layouts.app')

@section('title', 'Forlmulário de Peça')

@section('sidebar')
@parent
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
$action = action('App\Http\Controllers\PecaController@update', $peca->id);
}else{
$action = action('App\Http\Controllers\PecaController@store');
};
@endphp

<h4 style="margin: 20px 0 40px 0 ">Formulário de Peças</h4>

<form action="{{$action}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-row">
        <input type="hidden" name="id"
            value="@if (!empty(old('id'))) {{old('id')}} @elseif (!empty($peca->id)){{$peca->id}} @endif">

        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome"
                value="@if (!empty(old('nome'))) {{old('nome')}} @elseif (!empty($peca->nome)){{$peca->nome}} @endif"
                placeholder="Nome" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="marca">Marca</label>
            <input type="text" name="marca" id="marca"
                value="@if (!empty(old('marca'))) {{old('marca')}} @elseif (!empty($peca->marca)){{$peca->marca}} @endif"
                placeholder="" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="peca_categoria_id">Categoria</label>
            <select name="peca_categoria_id" class="form-control">
                @foreach ($peca_categorias as $item)
                <option value="{{$item->id}}" @if($item->id == old('peca_categoria_id',
                    !empty($peca->peca_categoria_id))) selected="selected" @endif >
                    {{$item->nome}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="quantidade">Quantidade</label>
            <input type="text" name="quantidade" id="quantidade"
                value="@if (!empty(old('quantidade'))) {{old('quantidade')}} @elseif (!empty($peca->quantidade)){{$peca->quantidade}} @endif"
                placeholder="" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="preco">Preço</label>
            <input type="text" name="preco" id="preco"
                value="@if (!empty(old('preco'))) {{old('preco')}} @elseif (!empty($peca->preco)){{$peca->preco}} @endif"
                placeholder="R$" class="form-control">
        </div>
        @php
        !empty($peca->nome_arquivo) ? $nome_arquivo = $peca->nome_arquivo : $nome_arquivo = "sem_img.png";
        @endphp
        <div class="form-group col-md-6">
            <label for="nome_arquivo">Imagem</label>
            <input type="file" name="nome_arquivo" id="nome_arquivo" class="form-control">
            <img src="/storage/imagem/{{$nome_arquivo}}" width="250px"/>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{url("/peca")}}" class="btn btn-info"><i class="fas fa-chevron-left"></i> Voltar</a>
</form>
@endsection
