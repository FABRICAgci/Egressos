
@extends('layouts/contentLayoutMaster')

@section('title', $breadcrumbs[1]['name'])

@section('vendor-style')
  {{-- Vendor Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endsection

@section('content')
<!-- Validation -->
<section class="bs-validation">
  <div class="row">
    <!-- Bootstrap Validation -->
    <div class="col-md-6 col-12">
        @if ($errors->any())
        <div class="alert alert-danger role='alert'">
          <h4 class="alert-heading">Erros</h4>
          <div class="alert-body">
            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

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
      
      <div class="card">
        <div class="card-body">
          <form action="{{ route('store-administrador') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="mb-1">
              <label class="form-label" for="basic-addon-name">Nome <strong class="text-danger">(Obrigatório)</strong></label>

              <input
                type="text"
                id="basic-addon-name"
                name="name"
               
                @if (old('name'))
                    value="{{ old('name') }}"
                @endif
                
                class="form-control"
                placeholder="Informe nome"
                aria-label="Name"
                aria-describedby="basic-addon-name"
                required
              />
              <div class="invalid-feedback">Por favor, informe nome.</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-addon-name">E-mail <strong class="text-danger">(Obrigatório)</strong></label>

              <input
                type="email"
                id="basic-addon-name"
                name="email"
               
                @if (old('email'))
                    value="{{ old('email') }}"
                @endif
                
                class="form-control"
                placeholder="Informe e-mail"
                aria-label="Name"
                aria-describedby="basic-addon-name"
                required
              />
              <div class="invalid-feedback">Por favor, informe e-mail.</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-default-password1">Password <strong class="text-danger">(Obrigatório)</strong></label>
              <input
                type="password"
                name="password"
                id="basic-default-password1"
                class="form-control"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                required
              />
              <div class="invalid-feedback">Por favor, informe senha.</div>
            </div>
            <button type="submit" class="btn btn-primary me-1">Salvar</button>
            <a href="{{ route('index-administrador') }}" class="btn btn-outline-secondary">Voltar</a>
          </form>
        </div>
      </div>
    </div>
    <!-- /Bootstrap Validation -->
  </div>
</section>
<!-- /Validation -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
@endsection
