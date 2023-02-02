@extends('layouts/contentLayoutMaster')

@section('title', $breadcrumbs[1]['name'])

@section('vendor-style')
  <!-- vendor css files -->
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/modal-create-app.css')) }}">
@endsection

@section('content')

<!-- Advanced Search -->
<section id="advanced-search-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h4 class="card-title">Opções de Busca</h4>
        </div>
        <!--Search Form -->
        <div class="card-body mt-2">
          <form class="dt_adv_search" action="{{ route('index-egresso-admin') }}" method="POST">
            @csrf
            <div class="row g-1 mb-md-1">
              <div class="col-md-4">
                <label class="form-label" for="select2-basic">Dados do Egresso</label>
                  <select class="select2 form-select" name="opcao" id="select1-basic">
                    <option value="name" @if(!empty($filtros['opcao']) && $filtros['opcao'] == 'name') selected @endif>Nome</option>
                    <option value="ano_ingresso" @if(!empty($filtros['opcao']) && $filtros['opcao'] == 'ano_ingresso') selected @endif>Ano de ingresso</option>
                    <option value="ano_formatura" @if(!empty($filtros['opcao']) && $filtros['opcao'] == 'ano_formatura') selected @endif>Ano de formatura</option>
                  </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Termo da busca</label>
                <input
                type="text"
                id="basic-addon-name"
                name="termo"

                @if (!empty($filtros['termo']))
                  value="{{ $filtros['termo'] }}"
                @else
                  value=""
                @endif

                class="form-control"
                placeholder="Nome, Ano de Ingresso, Ano de formatura"
                aria-label="Name"
                aria-describedby="basic-addon-name"
              />
            </div>
              <div class="col-md-4">
                <div class="mb-1">
                  <label class="form-label" for="select2-basic">Situação</label>
                  <select class="select2 form-select" name="ativo" id="select3-basic">
                    <option value="1" @if(!empty($filtros['ativo']) && $filtros['ativo'] == 1) selected @endif>Ativo</option>
                    <option value="2" @if(!empty($filtros['ativo']) && $filtros['ativo'] == 2) selected @endif>Inativo</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row g-1 mb-md-1">
              <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <button 
                  type="submit" 
                  class="form-control btn btn-primary"
                >Pesquisar</button>
              </div>
            </div>
          </form>
        </div>
        <hr class="my-0" />
      </div>
    </div>
  </div>
</section>
<!--/ Advanced Search -->

@if(session('success'))
  <div class="alert alert-success role='alert'">
    <h4 class="alert-heading">{{ session('success') }}</h4>
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger role='alert'">
    <h4 class="alert-heading">{{ session('error') }}</h4>
  </div>
@endif

<section id="modal-examples">
  <div class="row">
    <!-- aqui create app card-->
    <div class="col-md-12">
      <div class="card">
        <div align="right">
          <a href="#" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#createAppModal-mapa">
            <span class="badge rounded-pill bg-warning">
              <i data-feather='map'></i>
              <span>Mapa</span>
            </span>
          </a>
        </div>
        <div class="card-body text-center">
          <i data-feather="user-check" class="font-large-2 mb-1"></i>
          <h5 class="card-title">{{ $breadcrumbs[2]['name'] }}</h5>

          <div class="mb-1">
            <span class="card-title">{{ $metricas['total'] }}</span>
          </div>

          @if ($egressos->isNotEmpty())
              @foreach($egressos as $e)
                <div class="row d-flex justify-content-center">
                  <div class="col-md-3">
                    <a href="#" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#createAppModal-{{ $e->id }}">
                      <p>
                        <div class=@if($e->ativo == 1) "card-text fst-italic text-info" @else "card-text fst-italic text-secondary" @endif>
                          
                          @if ($e->imagem)
                          <img
                          src="{{ asset(str_replace('public', 'storage', $e->imagem)) }}"
                          class="card-img-top"
                          />
                        @endif

                        <p>
                          <i data-feather="chevrons-right"></i>
                          {{ $e->name }}
                        </p>
                        
                        </div>
                      </p>
                    </a>
                    <a href="{{ route('edit-egresso-admin', $e->id) }}">
                      <span class="badge rounded-pill bg-success">
                        <i data-feather='check-square'></i>
                        <span>Editar</span>
                      </span>
                    </a>
                    <a href="{{ route('destroy-egresso-admin', $e->id) }}" onclick='return confirm("Deseja mesmo excluir {{$e->name}}?");'>
                      <span class="badge rounded-pill bg-danger">
                        <i data-feather='trash'></i>
                        <span>Apagar</span>
                      </span>
                    </a>
                  </div>
                </div>

                <div class=@if($e->ativo == 1) "divider divider-info" @else "divider divider-secondary" @endif>
                  <div class="divider-text"><i data-feather='more-horizontal'></i></div>
                </div>

                @include('admin/usuario/egresso/detalhes')
                @include('admin/usuario/egresso/mapa')
                
              @endforeach
          @endif

        </div>
      </div>
    </div>
    <!-- / create app card-->
  </div>
</section>

<div>
  @if (!empty($filtros)) {{$egressos->appends($filtros)->links()}} @else {{$egressos->links()}} @endif
</div>

@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/modal-add-new-cc.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/page-pricing.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/modal-add-new-address.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/modal-create-app.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/modal-two-factor-auth.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/modal-edit-user.js')) }}"></script>
   <script src="{{ asset(mix('js/scripts/pages/modal-share-project.js')) }}"></script>
@endsection
