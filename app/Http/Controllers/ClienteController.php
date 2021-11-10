<?php

namespace App\Http\Controllers;

use App\Mail\SendMailCliente;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PDF;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objResult = Cliente::paginate(10);

        return view("cliente.list")->with(['clientes' => $objResult]);
    }

    /**
     * Show the create for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cliente.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), Cliente::rules(), Cliente::msg())->validate();

        Cliente::create([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'data_inicio' => $request->data_inicio,
            'data_final' => $request->data_final
        ]);
        return \redirect()->action('App\Http\Controllers\ClienteController@index')->with('success','Registro incluído com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the create for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objCliente = Cliente::find($id);

        return view("cliente.form")->with(['cliente'=>$objCliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), Cliente::rules(), Cliente::msg())->validate();

        Cliente::updateOrCreate(
            ['id' => $request->id],
            [
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'data_inicio' => $request->data_inicio,
                'data_final' => $request->data_final
            ]
        );

        return \redirect()->action('App\Http\Controllers\ClienteController@index')->with('success','Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->delete();

        return \redirect()->action('App\Http\Controllers\ClienteController@index')->with('error','Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if ($request->tipo == "nome") {
            $objResult = Cliente::where('nome', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "telefone") {
            $objResult =  Cliente::where('telefone', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "email") {
            $objResult =  Cliente::where('email', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "data_inicio") {
            $objResult =  Cliente::where('data_inicio', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "data_final") {
            $objResult =  Cliente::where('data_final', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "categoria") {
            $objResult = Cliente::whereHas('categorias', function (Builder $query) use (&$request) {
                $query->where('nome', 'like', "%" . $request->valor . "%");
            })->get();
        }

        return view("cliente.list")->with(['clientes' => $objResult]);
    }

    public function gerarClientePDF()
    {
        $clientes = Cliente::all();

        return PDF::loadView('pdf.clienteList', compact('clientes'))
            ->download('relatorioCliente.pdf');
    }

    public function sendEmail()
    {
        $cliente = [];
        $cliente['clientes'] = Cliente::orderBy('nome')->get();

        Mail::to('jaqueline.ass.costa@gmail.com')
        ->send(new SendMailCliente($cliente));

        return \redirect()->action('App\Http\Controllers\ClienteController@index')->with('success','Email enviado com sucesso!');
    }
}
