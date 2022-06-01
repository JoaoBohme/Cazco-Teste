@extends('layouts.site')

@section('content')

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar relatório</title>
  </head>
  <body>
    <div class="card">
      <div class="card-body">
        <h3>Editar relatório</h3>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Faça sua descrição aqui.">
      </div>
      <button type="button" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </body>
</html>

@endsection