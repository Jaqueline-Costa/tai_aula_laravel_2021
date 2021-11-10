<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\FuncionarioCategoria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objResult = Funcionario::paginate(10);

        return view("funcionario.list")->with(['funcionarios'=>$objResult]);
    }

    /**
     * Show the create for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $funcionario_categorias = FuncionarioCategoria::all();

        return view("funcionario.form")->with(['funcionario_categorias'=>$funcionario_categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), Funcionario::rules(), Funcionario::msg())->validate();

        Funcionario::create([
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'funcionario_categoria_id' => $request->funcionario_categoria_id,
            'telefon' => $request->telefon,
            'salario' => $request->salario,
            'horario' => $request->horario
        ]);
        return \redirect()->action('App\Http\Controllers\FuncionarioController@index')->with('success','Registro incluído com sucesso!');
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
        $objFuncionario = Funcionario::find($id);
        $funcionario_categorias = FuncionarioCategoria::all();

        return view("funcionario.form")->with(['funcionario' => $objFuncionario, 'funcionario_categorias' => $funcionario_categorias]);
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
        Validator::make($request->all(), Funcionario::rules(), Funcionario::msg())->validate();

        Funcionario::updateOrCreate(
            ['id' => $request->id],
            [
                'nome' => $request->nome,
                'cnpj' => $request->cnpj,
                'funcionario_categoria_id' => $request->funcionario_categoria_id,
                'telefon' => $request->telefon,
                'salario' => $request->salario,
                'horario' => $request->horario,
            ]
        );

        return \redirect()->action('App\Http\Controllers\FuncionarioController@index')->with('success','Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail($id);

        $funcionario->delete();

        return \redirect()->action('App\Http\Controllers\FuncionarioController@index')->with('error','Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if ($request->tipo == "nome") {
            $objResult = Funcionario::where('nome', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "cnpj") {
            $objResult =  Funcionario::where('cnpj', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "telefon") {
            $objResult =  Funcionario::where('telefon', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "salario") {
            $objResult =  Funcionario::where('salario', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "horario") {
            $objResult =  Funcionario::where('horario', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "categoria") {
            $objResult = Funcionario::whereHas('categorias', function (Builder $query) use (&$request) {
                $query->where('nome', 'like', "%" . $request->valor . "%");
            })->get();
        }

        return view("funcionario.list")->with(['funcionarios' => $objResult]);
    }

    public function gerarFuncionarioPDF()
    {
        $funcionarios = Funcionario::all();

        return PDF::loadView('pdf.funcionarioList', compact('funcionarios'))
            ->download('relatorioFuncionario.pdf');
    }
}
