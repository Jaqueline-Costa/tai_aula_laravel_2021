<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
</head>

<body>
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
                    <td><a href="{{action('App\Http\Controllers\ClienteController@edit', $item->id)}}"  style='color: #FFC857'><i class='fas fa-edit'></i></a></td>
                    <td><a href="{{action('App\Http\Controllers\ClienteController@destroy', $item->id)}}"  onclick="return confirm('Deseja realmente remover o registro?');" style='color:red;'><i class='fas fa-trash'></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
