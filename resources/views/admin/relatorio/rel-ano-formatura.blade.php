
@extends('layouts/contentLayoutMaster')

@section('title', $breadcrumbs[1]['name'])

@section('vendor-style')
  <!-- vendor css files -->
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')

<div align="right">
  <a href="{{ route('pdf-formatura') }}" >
    <span class="badge rounded-pill bg-warning">
      <i data-feather='printer'></i>
      <span>PDF</span>
    </span>
  </a>
</div>

<div class="mb-1"></div>

<div class="row" id="basic-table">
  <div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table">

          @if ($egressos)
              @foreach($egressos as $chave => $valor)
                <thead>
                    <tr>
                    <th>Egressos {{ $chave }}</th>
                    <th>Ano de Ingresso</th>
                    <th>Titulação</th>
                    <th>Área</th>
                    <th>Total: {{ count($valor) }}</th>
                    </tr>
                </thead>

                @foreach ($valor as $egresso)
                  <tbody>
                    <tr>
                      <td>{{ $egresso['name'] }}</td>
                      <td>{{ $egresso['ano_ingresso'] }}</td>
                      <td>{{ $egresso['titulo'] }}</td>
                      <td>{{ $egresso['area'] }}</td>
                      <td>{{ $egresso['funcao'] }}</td>
                    </tr>
                  </tbody>
                @endforeach

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
