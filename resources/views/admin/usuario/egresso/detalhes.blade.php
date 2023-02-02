<!-- create app modal -->
<div class="modal fade" id="createAppModal-{{ $e->id }}" tabindex="-1" aria-labelledby="createAppTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h1 class="text-center mb-1" id="createAppTitle">Dados do Egresso</h1>
        
        <div class="row d-flex justify-content-center">
          <div class="col-md-3">
            @if ($e->imagem)
              <img
                src="{{ asset(str_replace('public', 'storage', $e->imagem)) }}"
                class="card-img-top"
              />
            @endif
          </div>
        </div>

        <div class="card">
          <div class="card-body my-2 py-25">
            <div class="row">
              <div class="col-md-12">
                
                <div class="mb-2 pb-50">
                  <h5>E-mail</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">{{ $e->email }}</span>
                </div>

                <div class="mb-2 pb-50">
                  <h5>Nome</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">{{ $e->name }}</span>
                </div>

                <div class="mb-2 pb-50">
                  <h5>Data de nascimento</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">
                    
                    @php
                        $dbDate = \Carbon\Carbon::parse($e->dt_nascimento);
                        $diffYears = \Carbon\Carbon::now()->diffInYears($dbDate);
                    @endphp

                    {{\Carbon\Carbon::parse($e->dt_nascimento)->format("d/m/Y")}} (Idade: {{$diffYears}})
                  </span>
                </div>

                <div class="mb-2 pb-50">
                  <h5>País onde nasceu</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">{{ $e->countrie->name }}</span>
                </div>
                
                <div class="mb-2 pb-50">
                  <h5>Estado onde nasceu</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">@if(!empty($e->uf->name)) {{ $e->uf->name }} @else Não informado @endif</span>
                </div>

                <div class="mb-2 pb-50">
                  <h5>Cidade onde nasceu</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">@if(!empty($e->cidade->name)) {{ $e->cidade->name }} @else Não informado @endif</span>
                </div>

                <div class="mb-2 pb-50">
                  <h5>Ano de ingresso</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">{{ $e->ano_ingresso }}</span>
                </div>

                <div class="mb-2 pb-50">
                  <h5>Ano de formatura</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">{{ $e->ano_formatura }}</span>
                </div>

                <div class="mb-2 pb-50">
                  <h5>País onde mora</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">{{ $e->countrieondemora->name }}</span>
                </div>

                <div class="mb-2 pb-50">
                  <h5>Estado onde mora</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">@if(!empty($e->ufondemora->name)) {{ $e->ufondemora->name }} @else Não informado @endif</span>
                </div>

                <div class="mb-2 pb-50">
                  <h5>Cidade onde mora</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">@if(!empty($e->cidadeondemora->name)) {{ $e->cidadeondemora->name }} @else Não informado @endif</span>
                </div>

                <div class="mb-2 pb-50">
                  <h5>Título acadêmico</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">@if(!empty($e->titulo->descricao)) {{ $e->titulo->descricao }} @else Não informado @endif</span>
                </div>    

                <div class="mb-2 pb-50">
                  <h5>Área de formação</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">@if(!empty($e->area->descricao)) {{ $e->area->descricao }} @if($e->area_id == 13) ({{ $e->outro }}) @endif @else Não informado @endif</span>
                </div>

                <div class="mb-2 pb-50">
                  <h5>Função</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">@if(!empty($e->funcao)) {{ $e->funcao }} @else Não informado @endif</span>
                </div>

                <div class="mb-2 pb-50">
                  <h5>Empresa</h5>
                  <span class="mt-1 mb-2 text-primary fst-italic">@if(!empty($e->empresa)) {{ $e->empresa }} @else Não informado @endif</span>
                </div>
                
              </div>
            </div>
          </div>
        </div>   
      </div>
    </div>
  </div>
</div>
<!-- / create app modal -->
