
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
          <form action="{{ route('update-egresso-admin', $egresso->id) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row d-flex justify-content-center">
              <div class="col-md-6">
                @if ($egresso->imagem)
                  <img
                      src="{{ asset(str_replace('public', 'storage', $egresso->imagem)) }}"
                      class="card-img-top"
                  />
                @endif
              </div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-default-email1">Email</label>
              <input
                type="email"
                id="basic-default-email1"
                name="email"
                value="{{ $egresso->email }}"
                class="form-control"
                placeholder="Ex: joao@email.com"
                aria-label="joao@email.com"
                readonly
              />
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-addon-name">Nome <strong class="text-danger">(Obrigatório)</strong></label>

              <input
                type="text"
                id="basic-addon-name"
                name="name"
               
                @if (old('name'))
                    value="{{ old('name') }}"
                @else
                    value="{{ $egresso->name }}"
                @endif
                
                class="form-control"
                placeholder="Informe Nome"
                aria-label="Name"
                aria-describedby="basic-addon-name"
                required
              />
              <div class="invalid-feedback">Por favor, informe Nome.</div>
            </div>
            <div class="mb-1">
                <label class="form-label" for="basic-addon-name">Data de Nascimento <strong class="text-danger">(Obrigatório)</strong></label>
  
                <input
                  type="date"
                  id="basic-addon-name"
                  name="dt_nascimento"

                  @if (old('dt_nascimento'))
                    value="{{ old('dt_nascimento') }}"
                  @else
                        value="{{ $egresso->dt_nascimento }}"
                  @endif
                
                  class="form-control"
                  placeholder="Informe Data de Nascimento"
                  aria-label="Name"
                  aria-describedby="basic-addon-name"
                  required
                />
                <div class="invalid-feedback">Por favor, informe Data de Nascimento.</div>
              </div>

              <div class="mb-1">
                <label class="form-label" for="select2-basic">País onde nasceu</label>
                <select class="select2 form-select" name="countrie_nascimento" id="countrie_nascimento" required>
                  <option value="">Selecione uma Opção</option>
                  @if ($paises->isNotEmpty())
                    @foreach ($paises as $p)
                      <option value="{{ $p->id }}" @if($p->id == $egresso->countrie_nascimento) selected @endif>{{ $p->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>

              <div class="mb-1 n32">
                <label class="form-label" for="select2-basic" id="label_uf_nascimento">Estado onde nasceu <strong class="text-danger">(Obrigatório)</strong></label>
                <select class="select2 form-select" name="uf_nascimento" id="uf_nascimento" required>
                  <option value="">Selecione uma Opção</option>
                  @if ($ufs->isNotEmpty())
                    @foreach ($ufs as $u)
                      <option value="{{ $u->id }}" @if($u->id == $egresso->uf_nascimento) selected @endif>{{ $u->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div> 

              <div class="mb-1 n32">
                <label class="form-label" for="select2-basic" id="label_cidade_nascimento">Cidade onde nasceu <strong class="text-danger">(Obrigatório)</strong></label>
                <select class="select2 form-select" name="cidade_nascimento" id="cidade_nascimento" required>
                  @if ($cidades_nascimento->isNotEmpty())
                    @foreach ($cidades_nascimento as $c)
                      <option value="{{ $c->id }}" @if($c->id == $egresso->cidade_nascimento) selected @endif>{{ $c->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>

              <div class="mb-1">
                <label class="form-label" for="select2-basic">Ano de Ingresso <strong class="text-danger">(Obrigatório)</strong></label>
                <select class="select2 form-select" name="ano_ingresso" id="ano_ingresso" required>
                  <option value="">Selecione uma Opção</option>
                  @for ($i = 2010; $i <= 2030; $i++)
                    <option value="{{ $i }}" @if($i == $egresso->ano_ingresso) selected @endif>{{ $i }}</option>
                  @endfor
                </select>
              </div>

              <div class="mb-1">
                <label class="form-label" for="select2-basic">Ano de formatura <strong class="text-danger">(Obrigatório)</strong></label>
                <select class="select2 form-select" name="ano_formatura" id="ano_formatura" required>
                  <option value="">Selecione uma Opção</option>
                  @for ($i = 2015; $i <= 2030; $i++)
                    <option value="{{ $i }}" @if($i == $egresso->ano_formatura) selected @endif>{{ $i }}</option>
                  @endfor
                </select>
              </div>

              <div class="mb-1">
                <label class="form-label" for="select2-basic">País onde mora</label>
                <select class="select2 form-select" name="countrie_mora" id="countrie_mora" required>
                  <option value="">Selecione uma Opção</option>
                  @if ($paises->isNotEmpty())
                    @foreach ($paises as $p)
                      <option value="{{ $p->id }}" @if($p->id == $egresso->countrie_mora) selected @endif>{{ $p->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>

              <div class="mb-1 m32">
                <label class="form-label" for="select2-basic" id="label_uf_mora">Estado onde mora <strong class="text-danger">(Obrigatório)</strong></label>
                <select class="select2 form-select" name="uf_mora" id="uf_mora" required>
                  <option value="">Selecione uma Opção</option>
                  @if ($ufs->isNotEmpty())
                    @foreach ($ufs as $u)
                      <option value="{{ $u->id }}" @if($u->id == $egresso->uf_mora) selected @endif>{{ $u->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div> 

              <div class="mb-1 m32">
                <label class="form-label" for="select2-basic" id="label_cidade_mora">Cidade onde mora <strong class="text-danger">(Obrigatório)</strong></label>
                <select class="select2 form-select" name="cidade_mora" id="cidade_mora" required>
                  @if ($cidades_mora->isNotEmpty())
                    @foreach ($cidades_mora as $c)
                      <option value="{{ $c->id }}" @if($c->id == $egresso->cidade_mora) selected @endif>{{ $c->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>

              <div class="mb-1">
                <label class="form-label" for="select2-basic">Título acadêmico</label>
                <select class="select2 form-select" name="titulo_id" id="titulo_id">
                  <option value="">Selecione uma Opção</option>
                  @if ($titulos->isNotEmpty())
                    @foreach ($titulos as $t)
                      <option value="{{ $t->id }}" @if($t->id == $egresso->titulo_id) selected @endif>{{ $t->descricao }}</option>
                    @endforeach
                  @endif
                </select>
              </div>

              <div class="mb-1">
                <label class="form-label" for="select2-basic">Área de formação</label>
                <select class="select2 form-select" name="area_id" id="area_id">
                  <option value="">Selecione uma Opção</option>
                  @if ($areas->isNotEmpty())
                    @foreach ($areas as $a)
                      <option value="{{ $a->id }}" @if($a->id == $egresso->area_id) selected @endif>{{ $a->descricao }}</option>
                    @endforeach
                  @endif
                </select>
              </div>

              <div class="mb-1 13" @if($egresso->area_id != 13) style="display: none;" @endif>
                <label class="form-label" for="basic-addon-name">Especifique a outra área de formação  <strong class="text-danger">(Obrigatório)</strong></label>
  
                <input
                  type="text"
                  id="outro"
                  name="outro"
                  value="{{ $egresso->outro }}"
                  class="form-control"
                  placeholder="Informe a outra área de formação"
                  aria-label="Name"
                  aria-describedby="basic-addon-name"
                />
              </div>

              <div class="mb-1">
                <label class="form-label" for="basic-addon-name">Qual sua função</label>
  
                <input
                  type="text"
                  id="basic-addon-name"
                  name="funcao"
  
                  value="{{ $egresso->funcao }}" 
  
                  class="form-control"
                  placeholder="Informe sua função"
                  aria-label="Name"
                  aria-describedby="basic-addon-name"
                />
              </div>

              <div class="mb-1">
                <label class="form-label" for="basic-addon-name">Qual sua empresa</label>
  
                <input
                  type="text"
                  id="basic-addon-name"
                  name="empresa"
  
                  value="{{ $egresso->empresa }}" 
  
                  class="form-control"
                  placeholder="Informe sua empresa"
                  aria-label="Name"
                  aria-describedby="basic-addon-name"
                />
              </div>
              
              <div class="mb-1">
                <label class="form-label" for="staticprice">Sua foto</label>
                <input 
                  class="form-control" 
                  name="imagem"
                  id="imagem"
                  value="{{ old('imagem') }}"
                  type="file"
                  accept=".jpeg,.jpg,.png,.webp"
                />
              </div>  
            <div class="mb-1">
              <label class="form-label" for="basic-default-password1">Senha</label>
              <input
                type="password"
                name="password"
                id="basic-default-password1"
                class="form-control"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
              />
            </div>
            <button type="submit" class="btn btn-primary me-1">Salvar</button>
            <a href="{{ route('index-egresso-admin') }}" class="btn btn-outline-secondary">Voltar</a>
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

<script src="{{ asset(mix('vendors/js/jquery/jquery.min.js')) }}"></script>

<script type="text/javascript">
  $(document).ready(function () { 

    var countrie_nascimento = $("#countrie_nascimento").val();
    var countrie_mora = $("#countrie_mora").val();

    if(countrie_nascimento != 32)
    {
      $('#uf_nascimento').attr('required', false);
      $('#cidade_nascimento').attr('required', false);
      $('.n32').hide();
    }

    if(countrie_mora != 32)
    {
      
      $('#uf_mora').attr('required', false);
      $('#cidade_mora').attr('required', false);
      $('.m32').hide();
    }

    $('select[name=area_id]').change(function () {

      var camp1 = $('#area_id');
      var camp2 = $('#outro');

      if(camp1.val() == 13){
        camp2.attr('required', true);
      }

    });

    $('select[name=countrie_nascimento]').change(function () {

      var camp1 = $('#countrie_nascimento');
      var camp2 = $('#uf_nascimento');
      var camp3 = $('#cidade_nascimento');

      if(camp1.val() != 32){
        camp2.attr('required', false);
        camp3.attr('required', false);
        $('#label_uf_nascimento').html("Estado onde nasceu");
        $('#label_cidade_nascimento').html("Cidade onde nasceu");
      }else
      {
        camp2.attr('required', true);
        camp3.attr('required', true);
        $('#label_uf_nascimento').html("Estado onde nasceu <strong class='text-danger'>(Obrigatório)</strong>");
        $('#label_cidade_nascimento').html("Cidade onde nasceu <strong class='text-danger'>(Obrigatório)</strong>");
      }

      });

      $('select[name=countrie_mora]').change(function () {

        var camp1 = $('#countrie_mora');
        var camp2 = $('#uf_mora');
        var camp3 = $('#cidade_mora');

        if(camp1.val() != 32){
          camp2.attr('required', false);
          camp3.attr('required', false);
          $('#label_uf_mora').html("Estado onde mora");
          $('#label_cidade_mora').html("Cidade onde mora");
        }else
        {
          camp2.attr('required', true);
          camp3.attr('required', true);
          $('#label_uf_mora').html("Estado onde mora <strong class='text-danger'>(Obrigatório)</strong>");
          $('#label_cidade_mora').html("Cidade onde mora <strong class='text-danger'>(Obrigatório)</strong>");
        }

      });

    $('select[name=uf_nascimento]').change(function () {
        var uf_nascimento = $(this).val();
        $('select[name=cidade_nascimento]').html('').append('<option value="">  Carregando...  </option>');
          $.get('/egresso/cidade/' + uf_nascimento, function (cidades) {
            $('select[name=cidade_nascimento]').empty();
            $('select[name=cidade_nascimento]').html('').append(
              '<option value="">Selecione uma Cidade</option>'
            );
            $.each(cidades, function (key, value) {
                $('select[name=cidade_nascimento]').append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        });
    });

    $('select[name=uf_mora]').change(function () {
        var uf_mora = $(this).val();
        $('select[name=cidade_mora]').html('').append('<option value="">  Carregando...  </option>');
          $.get('/egresso/cidade/' + uf_mora, function (cidades) {
            $('select[name=cidade_mora]').empty();
            $('select[name=cidade_mora]').html('').append(
              '<option value="">Selecione uma Cidade</option>'
            );
            $.each(cidades, function (key, value) {
                $('select[name=cidade_mora]').append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        });
    });

    //Select para mostrar e esconder divs
    $('#area_id').on('change', function() {
        var SelectValue = '.' + $(this).val();
        $('.13').hide();
        $(SelectValue).toggle();
    });

    $('#countrie_nascimento').on('change', function() {

      var SelectValue = '.n' + $(this).val();
      $('.n32').hide();
      $(SelectValue).toggle();

      });

    $('#countrie_mora').on('change', function() {

      var SelectValue = '.m' + $(this).val();
      $('.m32').hide();
      $(SelectValue).toggle(); 

    });

  });
  </script>
