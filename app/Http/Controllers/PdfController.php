<?php

namespace App\Http\Controllers;

use App\Models\Titulo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PdfController extends Controller
{
    public function egresso(Request $request)
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Relatório Egresso"], ['name' => "Relatório"]];
        $pageConfigs = ['blankPage' => true];
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
        })
        ->where('perfil', 2)
        ->where('ativo', 1)
        ->orderBy('name')
        ->get();
           
        $pdf = PDF::loadView('/admin/relatorio/pdf/rel-egresso', compact(['breadcrumbs' ,'pageConfigs', 'egressos', ]))
                        ->setOptions(['defaultFont' => 'sans-serif',]);
     
        return $pdf->download('egresso.pdf');
    }

    public function titulo()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Relatório Título"], ['name' => "Relatório"]];
        $pageConfigs = ['blankPage' => true];

        $titulos = DB::table('titulos')
        ->select('titulos.descricao as descricao', DB::raw('count(*) as total'))
        ->join('users', 'users.titulo_id', 'titulos.id')
        ->where('titulos.ativo', 1)
        ->where('users.ativo', 1)
        ->orderBy('titulos.descricao')
        ->groupBy('titulos.descricao')
        ->get();

        $pdf = PDF::loadView('/admin/relatorio/pdf/rel-titulo', compact(['breadcrumbs' ,'pageConfigs', 'titulos', ]))
                        ->setOptions(['defaultFont' => 'sans-serif',]);
     
        return $pdf->download('titulo.pdf');
    }

    public function area()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Relatório Área"], ['name' => "Relatório"]];
        $pageConfigs = ['blankPage' => true];

        $areas = DB::table('areas')
        ->select('areas.descricao as descricao', DB::raw('count(*) as total'))
        ->join('users', 'users.area_id', 'areas.id')
        ->where('areas.ativo', 1)
        ->where('users.ativo', 1)
        ->orderBy('areas.descricao')
        ->groupBy('areas.descricao')
        ->get();

        $pdf = PDF::loadView('/admin/relatorio/pdf/rel-area', compact(['breadcrumbs' ,'pageConfigs', 'areas', ]))
                        ->setOptions(['defaultFont' => 'sans-serif',]);
     
        return $pdf->download('area.pdf');
    }

    public function cidade()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Relatório Cidade"], ['name' => "Relatório"]];
        $pageConfigs = ['blankPage' => true];

        $cidades = DB::table('cidades')
        ->select(
            'cidades.name as name',
            'ufs.abbr as abbr',
            DB::raw('count(*) as total')
        )
        ->join('users', 'users.cidade_mora', 'cidades.id')
        ->join('ufs', 'ufs.id', 'cidades.uf_id')
        ->where('cidades.ativo', 1)
        ->where('users.ativo', 1)
        ->orderBy('cidades.name')
        ->groupBy('cidades.name', 'ufs.abbr')
        ->get();

        $pdf = PDF::loadView('/admin/relatorio/pdf/rel-cidade', compact(['breadcrumbs' ,'pageConfigs', 'cidades', ]))
                        ->setOptions(['defaultFont' => 'sans-serif',]);
     
        return $pdf->download('cidade.pdf');
    }

    public function formatura()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Relatório por Ano de Formatura"], ['name' => "Relatório"]];
        $pageConfigs = ['blankPage' => true];

        $anos = User::select('users.ano_formatura as ano')
                        ->where('users.ativo', 1)
                        ->where('users.perfil', 2)
                        ->orderBy('users.ano_formatura')
                        ->distinct()
                        ->get();

        if($anos)
        {
            foreach($anos as $a)
            {
                $egressos_ano = User::select(
                                    'users.id as id',
                                    'users.name as name',
                                    'users.ano_ingresso as ano_ingresso',
                                    'titulos.descricao as titulo',
                                    'areas.descricao as area',
                                    'users.outro as outro',
                                    'users.funcao as funcao'
                                )
                                ->leftJoin('titulos', 'titulos.id', 'users.titulo_id')
                                ->leftJoin('areas', 'areas.id', 'users.area_id')
                                ->where('users.ativo', 1)
                                ->where('users.perfil', 2)
                                ->where('users.ano_formatura', $a->ano)
                                ->orderBy('users.ano_formatura')
                                ->orderBy('users.name')
                                ->get();

                if($egressos_ano)
                {
                    foreach($egressos_ano as $e)
                    {
                        $egressos[$a->ano][$e->id] = [
                            'name' => $e->name,
                            'ano_ingresso' => $e->ano_ingresso,
                            'titulo' => $e->titulo,
                            'area' => ($e->outro)?"$e->area ({$e->outro})":$e->area,
                            'funcao' => $e->funcao,                   
                        ];
                    }
                }
            }
        }
        
        $pdf = PDF::loadView('/admin/relatorio/pdf/rel-ano-formatura', compact(['breadcrumbs' ,'pageConfigs', 'egressos', ]))
                        ->setOptions(['defaultFont' => 'sans-serif',]);
     
        return $pdf->download('formatura.pdf');
    }
}
