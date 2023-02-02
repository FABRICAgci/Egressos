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
          <th>Cidade</th>
          </tr>
      </thead>
      <tbody>
          <tr>
            <td>
              @if ($cidades->isNotEmpty())
                  @foreach ($cidades as $c)
                  <p><span class="fw-bold">({{ $c->total }}) {{ $c->name }} - {{ $c->abbr }}</span></p>
                  @endforeach
              @endif
            </td>
          </tr>
        </tbody>
      </table>

  </body>
</html>