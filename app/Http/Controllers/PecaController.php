<?php

namespace App\Http\Controllers;

use App\Models\Peca;
use App\Models\PecaCategoria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF;

class PecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objResult = Peca::paginate(5);

        return view("peca.list")->with(['pecas'=>$objResult]);
    }

    /**
     * Show the create for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $peca_categorias = PecaCategoria::all();

        return view("peca.form")->with(['peca_categorias'=>$peca_categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        Validator::make($request->all(), Peca::rules(), Peca::msg())->validate();

        $input = $request->all();
        $imagem = $request->file('nome_arquivo');

        if ($imagem) {
            $nome_arquivo = date('YmdHis') . "." . $imagem->getClientOriginalExtension();

            $request->nome_arquivo->storeAs('public/imagem', $nome_arquivo);

            $input['nome_arquivo'] = $nome_arquivo;
        }


        Peca::create($input);

        return \redirect()->action('App\Http\Controllers\PecaController@index')->with('success','Registro incluído com sucesso!');
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
        $objPeca = Peca::find($id);
        $peca_categorias = PecaCategoria::all();

        return view("peca.form")->with(['peca' => $objPeca, 'peca_categorias' => $peca_categorias]);
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
        Validator::make($request->all(), Peca::rules(), Peca::msg())->validate();

        $input = $request->all();
        $imagem = $request->file('nome_arquivo');

        if ($imagem) {
            $nome_arquivo = date('YmdHis') . "." . $imagem->getClientOriginalExtension();

            $request->nome_arquivo->storeAs('public/imagem', $nome_arquivo);

            $input['nome_arquivo'] = $nome_arquivo;
        }


        Peca::updateOrCreate(
            ['id' => $request->id],
            $input
        );

        return \redirect()->action('App\Http\Controllers\PecaController@index')->with('success','Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peca = Peca::findOrFail($id);

        if(Storage::exists('public/imagem/' . $peca->nome_arquivo)){
            Storage::delete('public/imagem/' . $peca->nome_arquivo);
        }

        $peca->delete();

        return \redirect()->action('App\Http\Controllers\PecaController@index')->with('error','Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if ($request->tipo == "nome") {
            $objResult = Peca::where('nome', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "marca") {
            $objResult =  Peca::where('marca', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "quantidade") {
            $objResult =  Peca::where('quantidade', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "preco") {
            $objResult =  Peca::where('preco', 'like', "%" . $request->valor . "%")->get();
        } else if ($request->tipo == "categoria") {
            $objResult = Peca::whereHas('categorias', function (Builder $query) use (&$request) {
                $query->where('nome', 'like', "%" . $request->valor . "%");
            })->get();
        }

        return view("peca.list")->with(['pecas' => $objResult]);
    }

    public function gerarPecaPDF()
    {
        $pecas = Peca::all();

        return PDF::loadView('pdf.pecaList', compact('pecas'))
            ->download('relatorioPeca.pdf');
    }
}
