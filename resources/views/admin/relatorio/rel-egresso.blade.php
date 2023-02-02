
@extends('layouts/contentLayoutMaster')

@section('title', $breadcrumbs[1]['name'])

@section('vendor-style')
  <!-- vendor css files -->
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
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
            <form class="dt_adv_search" action="{{ route('rel-egresso') }}" method="POST">
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

  <div align="right">
    <a href="{{ route('pdf-egresso') }}" >
      <span class="badge rounded-pill bg-warning">
        <i data-feather='printer'></i>
        <span>PDF</span>
      </span>
    </a>
  </div>

  <div class="mb-1"></div>

<!-- Basic Tables start -->
<div class="row" id="basic-table">
  <div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table">

          @if ($egressos->isNotEmpty())
              @foreach($egressos as $e)
                <thead>
                    <tr>
                    <th>{{ $e->name }}</th>
                    <th>Ano Ingresso</th>
                    <th>Ano Formatura</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>
                        @if (!empty($e->cidadeondemora->name))
                        <p><span class="fw-bold">Cidade atual: {{ $e->cidadeondemora->name }}</span></p>
                        @endif

                        @if (!empty($e->titulo->descricao))
                        <p><span class="fw-bold">Titulação: {{ $e->titulo->descricao }}</span></p>
                        @endif

                        @if (!empty($e->area->descricao))
                        <p><span class="fw-bold">Área de atuação: {{ $e->area->descricao }} @if($e->area_id == 13) ({{ $e->outro }}) @endif</span></p>
                        @endif

                        @if (!empty($e->funcao))
                        <p><span class="fw-bold">Função: {{ $e->funcao }}</span></p>
                        @endif

                        @if (!empty($e->empresa))
                        <p><span class="fw-bold">Empresa: {{ $e->empresa }}</span></p>
                        @endif

                    </td>
                    <td>{{ $e->ano_ingresso }}</td>
                    <td>{{ $e->ano_formatura }}</td>
                    </tr>
                </tbody>
              @endforeach
          @endif

        </table>
      </div>
    </div>
  </div>
</div>
<!-- Basic Tables end -->

@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/modal-edit-user.js')) }}"></script>
@endsection
