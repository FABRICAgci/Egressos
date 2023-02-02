
@extends('layouts/contentLayoutMaster')

@section('title', $breadcrumbs[1]['name'])

@section('content')

<div align="right">
  <a href="{{ route('pdf-area') }}" >
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
            <th>Área de atuação</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td>
                @if ($areas->isNotEmpty())
                    @foreach ($areas as $a)
                    <p><span class="fw-bold">({{ $a->total }}) {{ $a->descricao }}</span></p>
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
