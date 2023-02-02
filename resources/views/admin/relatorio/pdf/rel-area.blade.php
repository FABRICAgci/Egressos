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

    <table>
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

  </body>
</html>