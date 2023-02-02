<?php

namespace App\Http\Controllers;

use App\Models\Titulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TituloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Listar Títulos"], ['name' => "Títulos"]];
        $filtros = $request->except('_token');

        $titulos = Titulo::where(function($query) use ($request){
            if($request->termo)
            {
                $query->where('descricao', 'like', "%{$request->termo}%");
            }

            if($request->ativo)
            {
                $query->where('ativo', $request->ativo);
            }
        })
        ->orderBy('ativo')
        ->orderBy('descricao')
        ->paginate();

        return view('/admin/titulo/listar-titulo', compact(['breadcrumbs', 'filtros', 'titulos', ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Inserir Título"], ['name' => "Título"]];
        return view('/admin/titulo/inserir-titulo', compact(['breadcrumbs',]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $titulo = new Titulo();
        $titulo->descricao = $request->descricao;
        $titulo->criador = Auth::id();
        $titulo->modificador = Auth::id();
        $titulo->save();

        return redirect()->route('create-titulo')->with('success', config('egresso.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Titulo  $titulo
     * @return \Illuminate\Http\Response
     */
    public function show(Titulo $titulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Titulo  $titulo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Editar Título"], ['name' => "Título"]];
        $titulo = Titulo::find($id);

        return view('/admin/titulo/editar-titulo', compact(['breadcrumbs', 'titulo', ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Titulo  $titulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $titulo = Titulo::find($id);
        $titulo->descricao = $request->descricao;
        $titulo->ativo = $request->ativo;
        $titulo->modificador = Auth::id();
        $titulo->save();

        return redirect()->route('edit-titulo', $id)->with('success', config('egresso.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Titulo  $titulo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $titulo = Titulo::find($id);

        if($titulo)
        {
            $titulo->delete();
            return redirect()->route('index-titulo')->with('success', config('egresso.success'));
        }
    }
}
