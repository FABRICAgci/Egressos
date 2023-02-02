
@extends('layouts/contentLayoutMaster')

@section('title', $breadcrumbs[1]['name'])

@section('content')

<div align="right">
  <a href="{{ route('pdf-titulo') }}" >
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
          <thead>
            <tr>
            <th>Titulação</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td>
                @if ($titulos->isNotEmpty())
                    @foreach ($titulos as $t)
                    <p><span class="fw-bold">({{ $t->total }}) {{ $t->descricao }}</span></p>
                    @endforeach
                @endif
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Basic Tables end -->

@endsection
