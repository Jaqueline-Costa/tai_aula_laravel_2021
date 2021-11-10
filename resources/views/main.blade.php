@extends('layouts.app')

@section('title', 'Pagina Filho')

@section('sidebar')
    @parent
@endsection

@section('content')
<p></p>

<div class="row">
    <div class="col-sm-4">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top"
                src="https://images.tcdn.com.br/static_inst/meiosdepagamento/wp-content/uploads/2019/02/atendimento-ao-cliente-perfeito.jpg"
                alt="Card image cap"
                style="height: 200px">
            <div class="card-body">
                <h5 class="card-title">Clientes</h5>
            </div>
            <a href="{{'/cliente'}}" class="btn btn-primary">Abrir</a>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top"
                src="https://publicidadeimobiliaria.com/wp-content/uploads/2021/03/Saiba-como-a-aplicacao-da-NR12-pode-garantir-a-seguranca-para-empresas-e-funcionarios-da-construcao-civil.jpg"
                alt="Card image cap"
                style="height: 200px">
            <div class="card-body">
                <h5 class="card-title">Funcionários</h5>
            </div>
            <a href="{{'/funcionario'}}" class="btn btn-primary">Abrir</a>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top"
                src="https://bwa.global/wp-content/uploads/2020/05/WhatsApp-Image-2019-05-15-at-09.54.12-1160x770-1.jpeg"
                alt="Card image cap"
                style="height: 200px">
            <div class="card-body">
                <h5 class="card-title">Estoque</h5>
            </div>
            <a href="{{'/peca'}}" class="btn btn-primary">Abrir</a>
        </div>
    </div>
</div>
@endsection
