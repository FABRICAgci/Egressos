<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Listar Áreas"], ['name' => "Áreas"]];
        $filtros = $request->except('_token');

        $areas = Area::where(function($query) use ($request){
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

        return view('/admin/area/listar-area', compact(['breadcrumbs', 'filtros', 'areas', ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Inserir Área"], ['name' => "Área"]];
        return view('/admin/area/inserir-area', compact(['breadcrumbs',]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $area = new Area();
        $area->descricao = $request->descricao;
        $area->criador = Auth::id();
        $area->modificador = Auth::id();
        $area->save();

        return redirect()->route('create-area')->with('success', config('egresso.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Editar Área"], ['name' => "Área"]];
        $area = Area::find($id);

        return view('/admin/area/editar-area', compact(['breadcrumbs', 'area', ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $area = Area::find($id);
        $area->descricao = $request->descricao;
        $area->ativo = $request->ativo;
        $area->modificador = Auth::id();
        $area->save();

        return redirect()->route('edit-area', $id)->with('success', config('egresso.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::find($id);

        if($area)
        {
            $area->delete();
            return redirect()->route('index-area')->with('success', config('egresso.success'));
        }
    }
}
