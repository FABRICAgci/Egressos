
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
                  <td style="text-align: center">{{ $egresso['ano_ingresso'] }}</td>
                  <td>{{ $egresso['titulo'] }}</td>
                  <td>{{ $egresso['area'] }}</td>
                  <td>{{ $egresso['funcao'] }}</td>
                </tr>
              </tbody>
            @endforeach

          @endforeach
      @endif

    </table>

  </body>
</html>