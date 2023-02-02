<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Cidade;
use App\Models\Countrie;
use App\Models\Titulo;
use App\Models\Uf;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserEgressoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Listar Egressos"], ['name' => "Egressos"]];
        $filtros = $request->except('_token');

        $metricas = [
            'ativos' => User::where('perfil', 2)->where('ativo', 1)->count(),
            'inativos' => User::where('perfil', 2)->where('ativo', 2)->count(),
            'total' => User::where('perfil', 2)->count(),
        ];
        
        $egressos = User::where(function($query) use ($request){
            if($request->opcao == 'name' && !empty($request->termo))
            {
                $query->where('name', 'like', "%{$request->termo}%");
            }

            if($request->opcao == 'ano_ingresso' && !empty($request->termo))
            {
                $query->where('ano_ingresso', $request->termo);
            }

            if($request->opcao == 'ano_formatura' && !empty($request->termo))
            {
                $query->where('ano_formatura', $request->termo);
            }

            if($request->ativo)
            {
                $query->where('ativo', $request->ativo);
            }
        })
        ->where('perfil', 2)
        ->orderBy('name')
        ->paginate();

        $mapa = Uf::select(
            'ufs.abbr as abbr'
        )
        ->join('users', 'users.uf_mora', 'ufs.id')
        ->distinct()
        ->get();

        if($mapa)
        {
            foreach($mapa as $m)
            {
                $ufs[] = $m['abbr'];
            }
        }

        return view('/admin/usuario/egresso/listar-egresso', compact(['breadcrumbs', 'filtros', 'egressos', 'metricas', 'ufs' ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Inserir Egresso"], ['name' => "Egresso"]];
        $titulos = Titulo::where('ativo', 1)->orderBy('descricao')->get();
        $areas = Area::where('ativo', 1)->orderBy('descricao')->get();
        $paises = Countrie::all();
        $ufs = Uf::where('ativo', 1)->orderBy('name')->get();
        return view('/admin/usuario/egresso/inserir-egresso', compact(['breadcrumbs', 'titulos', 'areas', 'paises', 'ufs', ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensagens = [
            'email.unique' => 'Já existe Egresso cadastrado com este e-mail!',
        ];

        $request->validate([
            'email' => 'unique:users',
        ], $mensagens);
        
        $egresso = new User();
        $egresso->name = $request->name;
        $egresso->dt_nascimento = $request->dt_nascimento;
        $egresso->countrie_nascimento = $request->countrie_nascimento;
        $egresso->uf_nascimento = ($request->countrie_nascimento == 32)?$request->uf_nascimento:null;
        $egresso->cidade_nascimento = ($request->countrie_nascimento == 32)?$request->cidade_nascimento:null;
        $egresso->ano_ingresso = $request->ano_ingresso;
        $egresso->ano_formatura = $request->ano_formatura;
        $egresso->countrie_mora = $request->countrie_mora;
        $egresso->uf_mora = ($egresso->countrie_mora == 32)?$request->uf_mora:null;
        $egresso->cidade_mora = ($egresso->countrie_mora == 32)?$request->cidade_mora:null;
        $egresso->titulo_id = ($request->titulo_id)?$request->titulo_id:null;
        $egresso->area_id = ($request->area_id)?$request->area_id:null;
        $egresso->outro = ($request->outro)?$request->outro:null;
        $egresso->funcao = ($request->funcao)?$request->funcao:null;
        $egresso->empresa = ($request->empresa)?$request->empresa:null;
        $egresso->email = $request->email;
        $egresso->imagem = ($request->hasFile('imagem'))?$request->file('imagem')->store('public/egresso'):null;
        $egresso->password = Hash::make($request->password);
        $egresso->criador = Auth::id();
        $egresso->modificador = Auth::id();
        $egresso->save();

        return redirect()->route('create-egresso-admin')->with('success', config('egresso.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Editar Egresso"], ['name' => "Egresso"]];
        $egresso = User::find($id);

        $titulos = Titulo::where('ativo', 1)->orderBy('descricao')->get();
        $areas = Area::where('ativo', 1)->orderBy('descricao')->get();
        $paises = Countrie::all();
        $ufs = Uf::where('ativo', 1)->orderBy('name')->get();
        $cidades_nascimento = Cidade::where('ativo', 1)->where('uf_id', $egresso->uf_nascimento)->orderBy('name')->get();
        $cidades_mora = Cidade::where('ativo', 1)->where('uf_id', $egresso->uf_mora)->orderBy('name')->get();

        return view('/admin/usuario/egresso/editar-egresso', compact([
            'breadcrumbs', 
            'egresso',
            'titulos', 
            'areas',
            'paises', 
            'ufs', 
            'cidades_nascimento',
            'cidades_mora',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $egresso = User::find($id);
        $egresso->name = $request->name;
        $egresso->dt_nascimento = $request->dt_nascimento;
        $egresso->countrie_nascimento = $request->countrie_nascimento;
        $egresso->uf_nascimento = ($request->countrie_nascimento == 32)?$request->uf_nascimento:null;
        $egresso->cidade_nascimento = ($request->countrie_nascimento == 32)?$request->cidade_nascimento:null;
        $egresso->ano_ingresso = $request->ano_ingresso;
        $egresso->ano_formatura = $request->ano_formatura;
        $egresso->countrie_mora = $request->countrie_mora;
        $egresso->uf_mora = ($egresso->countrie_mora == 32)?$request->uf_mora:null;
        $egresso->cidade_mora = ($egresso->countrie_mora == 32)?$request->cidade_mora:null;
        $egresso->titulo_id = ($request->titulo_id)?$request->titulo_id:null;
        $egresso->area_id = ($request->area_id)?$request->area_id:null;

        if($request->area_id != 13)
        {
            $egresso->outro = null;
        }else
        {
            $egresso->outro = $request->outro;
        }
        
        $egresso->funcao = ($request->funcao)?$request->funcao:null;
        $egresso->empresa = ($request->empresa)?$request->empresa:null;

        if($request->hasFile('imagem'))
        {
            if($egresso->imagem)
            {
                Storage::delete($egresso->imagem);
            }

            $egresso->imagem = $request->file('imagem')->store('public/egresso');
        }

        if($request->password)
        {
            $egresso->password = Hash::make($request->password);
        }

        $egresso->modificador = Auth::id();

        $egresso->save();

        return redirect()->route('edit-egresso-admin', $id)->with('success', config('egresso.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $egresso = User::find($id);

        if($egresso)
        {
            if($egresso->imagem)
            {
                Storage::delete($egresso->imagem);
            }

            $egresso->delete();
            return redirect()->route('index-egresso-admin')->with('success', config('egresso.success'));
        }
    }

    public function cidades($uf)
    {
        $cidades = Cidade::where('uf_id', $uf)->orderBy('name')->get();
        return response()->json($cidades);
    }
}
