<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Listar Administradores"], ['name' => "Administradores"]];
        $filtros = $request->except('_token');

        $administradores = User::where(function($query) use ($request){
            if($request->name)
            {
                $query->where('name', 'like', "%{$request->name}%");
            }

            if($request->email)
            {
                $query->where('email', 'like', "%{$request->email}%");
            }

            if($request->ativo)
            {
                $query->where('ativo', $request->ativo);
            }
        })
        ->where('perfil', 1)
        ->orderBy('ativo')
        ->orderBy('name')
        ->paginate();

        return view('/admin/usuario/administrador/listar-administrador', compact(['breadcrumbs', 'filtros', 'administradores', ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Inserir Administrador"], ['name' => "Administrador"]];
        return view('/admin/usuario/administrador/inserir-administrador', compact(['breadcrumbs',]));
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
            'email.unique' => 'Já existe usuário cadastrado com este e-mail!',
        ];

        $request->validate([
            'email' => 'unique:users,email',
        ], $mensagens);

        $administrador = new User();
        $administrador->name = $request->name;
        $administrador->email = $request->email;
        $administrador->password = Hash::make($request->password);
        $administrador->perfil = 1;
        $administrador->criador = Auth::id();
        $administrador->modificador = Auth::id();
        $administrador->save();

        return redirect()->route('create-administrador')->with('success', config('egresso.success'));
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
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Editar Administrador"], ['name' => "Administrador"]];
        $administrador = User::find($id);

        return view('/admin/usuario/administrador/editar-administrador', compact(['breadcrumbs', 'administrador', ]));
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
        $administrador = user::find($id);
        $administrador->name = $request->name;

        if($request->has('password'))
        {
            $administrador->password = Hash::make($request->password);
        }

        $administrador->ativo = $request->ativo;
        $administrador->modificador = Auth::id();
        $administrador->save();

        return redirect()->route('edit-administrador', $id)->with('success', config('egresso.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $administrador = User::find($id);

        if($administrador)
        {
            $administrador->delete();
            return redirect()->route('index-administrador')->with('success', config('egresso.success'));
        }
    }
}
