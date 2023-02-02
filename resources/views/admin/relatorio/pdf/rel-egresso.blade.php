<html>
  <head>
      <title>{{ $breadcrumbs[1]['name'] }}</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style>
              tr{
                  font-size: 14pt;
                  background-color: white;
                  color: white;
              }
              th{
                  font-size: 14pt;
                  background-color: gray;
                  color: white;
              }
              td{
                  font-size: 14pt;
                  background-color: white;
                  color: black;
              }
      </style>
  </head>
  <body>
    <h1 style="text-align: center">{{ env('APP_NAME') }}</h1>
    <h3 style="text-align: center">{{ $breadcrumbs[1]['name'] }}</h1>

      <table align="center">

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
                <td style="text-align: center">{{ $e->ano_ingresso }}</td>
                <td style="text-align: center">{{ $e->ano_formatura }}</td>
                </tr>
            </tbody>
          @endforeach
      @endif

    </table>

  </body>
</html>