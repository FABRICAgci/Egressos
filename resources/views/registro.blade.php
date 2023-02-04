@extends('layouts/fullLayoutMaster')

@section('title', 'Registro')

@section('vendor-style')
  {{-- Vendor Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')

<div class="auth-wrapper auth-basic px-2">
  <div class="auth-inner my-2">
    <!-- Register basic -->
    <div class="card mb-0">
      <div class="card-body">
        
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

        <a href="#" class="brand-logo">
          <svg
            viewbox="0 0 139 95"
            version="1.1"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            height="28"
          >
            <defs>
              <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                <stop stop-color="#000000" offset="0%"></stop>
                <stop stop-color="#FFFFFF" offset="100%"></stop>
              </lineargradient>
              <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                <stop stop-color="#FFFFFF" offset="100%"></stop>
              </lineargradient>
            </defs>
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                <g id="Group" transform="translate(400.000000, 178.000000)">
                  <path
                    class="text-primary"
                    id="Path"
                    d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                    style="fill: currentColor"
                  ></path>
                  <path
                    id="Path1"
                    d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                    fill="url(#linearGradient-1)"
                    opacity="0.2"
                  ></path>
                  <polygon
                    id="Path-2"
                    fill="#000000"
                    opacity="0.049999997"
                    points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"
                  ></polygon>
                  <polygon
                    id="Path-21"
                    fill="#000000"
                    opacity="0.099999994"
                    points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"
                  ></polygon>
                  <polygon
                    id="Path-3"
                    fill="url(#linearGradient-2)"
                    opacity="0.099999994"
                    points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"
                  ></polygon>
                </g>
              </g>
            </g>
          </svg>
          <h2 class="brand-text text-primary ms-1">{{ env('APP_NAME') }}</h2>
        </a>

        <h4 class="card-title mb-1">Faça o seu cadastro e entre para nossa comunidade!</h4>

        <form action="{{ route('store-registro') }}" method="POST" class="auth-register-form mt-2" enctype="multipart/form-data">
          @csrf
          <div class="mb-1">
            <label class="form-label" for="basic-default-email1">Email <strong class="text-danger">(Obrigatório)</strong></label>
            <input
              type="email"
              id="basic-default-email1"
              name="email"
              
              @if (old('email'))
                  value="{{ old('email') }}"
              @endif

              class="form-control"
              placeholder="Ex: joao@email.com"
              aria-label="joao@email.com"
              required
            />
            <div class="invalid-feedback">Por favor, informe E-mail.</div>
          </div>
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
                    <option value="{{ $p->id }}" @if(old('countrie_nascimento') == $p->id) selected @else @if($p->id == 32) selected @endif @endif>{{ $p->name }}</option>
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
                    <option value="{{ $u->id }}" @if(old('uf_nascimento') == $u->id) selected @endif>{{ $u->name }}</option>
                  @endforeach
                @endif
              </select>
            </div> 

            <div class="mb-1 n32">
              <label class="form-label" for="select2-basic" id="label_cidade_nascimento">Cidade onde nasceu <strong class="text-danger">(Obrigatório)</strong></label>
              <select class="select2 form-select" name="cidade_nascimento" id="cidade_nascimento" required>
                <option value="">Selecione um Estado primeiro</option>
              </select>
            </div> 

            <div class="mb-1">
              <label class="form-label" for="select2-basic">Ano de Ingresso <strong class="text-danger">(Obrigatório)</strong></label>
              <select class="select2 form-select" name="ano_ingresso" id="ano_ingresso" required>
                <option value="">Selecione uma Opção</option>
                @for ($i = 2010; $i <= 2030; $i++)
                  <option value="{{ $i }}" @if(old('ano_ingresso') == $i) selected @endif>{{ $i }}</option>
                @endfor
              </select>
            </div>

            <div class="mb-1">
              <label class="form-label" for="select2-basic">Ano de formatura <strong class="text-danger">(Obrigatório)</strong></label>
              <select class="select2 form-select" name="ano_formatura" id="ano_formatura" required>
                <option value="">Selecione uma Opção</option>
                @for ($i = 2015; $i <= 2030; $i++)
                  <option value="{{ $i }}" @if(old('ano_formatura') == $i) selected @endif>{{ $i }}</option>
                @endfor
              </select>
            </div>

            <div class="mb-1">
              <label class="form-label" for="select2-basic">País onde mora</label>
              <select class="select2 form-select" name="countrie_mora" id="countrie_mora" required>
                <option value="">Selecione uma Opção</option>
                @if ($paises->isNotEmpty())
                  @foreach ($paises as $p)
                    <option value="{{ $p->id }}" @if(old('countrie_mora') == $p->id) selected @else @if($p->id == 32) selected @endif @endif>{{ $p->name }}</option>
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
                    <option value="{{ $u->id }}" @if(old('uf_mora') == $u->id) selected @endif>{{ $u->name }}</option>
                  @endforeach
                @endif
              </select>
            </div> 

            <div class="mb-1 m32">
              <label class="form-label" for="select2-basic" id="label_cidade_mora">Cidade onde mora <strong class="text-danger">(Obrigatório)</strong></label>
              <select class="select2 form-select" name="cidade_mora" id="cidade_mora" required>
                <option value="">Selecione um Estado primeiro</option>
              </select>
            </div>

            <div class="mb-1">
              <label class="form-label" for="select2-basic">Título acadêmico</label>
              <select class="select2 form-select" name="titulo_id" id="titulo_id">
                <option value="">Selecione uma Opção</option>
                @if ($titulos->isNotEmpty())
                  @foreach ($titulos as $t)
                    <option value="{{ $t->id }}" @if(old('titulo_id') == $t->id) selected @else @if($t->id == 1) selected @endif  @endif>{{ $t->descricao }}</option>
                  @endforeach
                @endif
              </select>
            </div>

            <div class="mb-1">
              <label class="form-label" for="select2-basic">Área de atuação</label>
              <select class="select2 form-select" name="area_id" id="area_id">
                <option value="">Selecione uma Opção</option>
                @if ($areas->isNotEmpty())
                  @foreach ($areas as $a)
                    <option value="{{ $a->id }}" @if(old('area_id') == $a->id) selected @endif>{{ $a->descricao }}</option>
                  @endforeach
                @endif
              </select>
            </div>

            <div class="mb-1 13" style="display: none;">
              <label class="form-label" for="basic-addon-name">Especifique a outra área de atuação <strong class="text-danger">(Obrigatório)</strong></label>

              <input
                type="text"
                id="outro"
                name="outro"

                @if (old('outro'))
                  value="{{ old('outro') }}"
                @endif  

                class="form-control"
                placeholder="Informe a outra área de atuação"
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

                @if (old('funcao'))
                  value="{{ old('funcao') }}"
                @endif  

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

                @if (old('empresa'))
                  value="{{ old('empresa') }}"
                @endif  

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
              <label for="register-password" class="form-label">Senha <strong class="text-danger">(Obrigatório)</strong></label>
  
              <div class="input-group input-group-merge form-password-toggle">
                <input
                  type="password"
                  class="form-control form-control-merge"
                  id="register-password"
                  name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="register-password"
                  tabindex="3"
                  required
                />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
          <button type="submit" id="salvar" class="btn btn-primary w-100" tabindex="5">Salvar</button>
        </form>

        <p class="text-center mt-2">
          <span>já tem uma conta?</span>
          <a href="{{url('login')}}">
            <span>Faça login em vez disso</span>
          </a>
        </p>
      </div>
    </div>
    <!-- /Register basic -->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('js/scripts/pages/auth-register.js')}}"></script>
@endsection

<script src="{{ asset(mix('vendors/js/jquery/jquery.min.js')) }}"></script>

<script type="text/javascript">

  $(document).ready(function () {
    
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
          $.get('/cidade/' + uf_nascimento, function (cidades) {
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
          $.get('/cidade/' + uf_mora, function (cidades) {
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
