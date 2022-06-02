@extends('layouts.site')

@section('title', $report->name)

@section('content')

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar relatório {{$report->id}}</title>
  </head>
  <body>
    <div class="card">
      <div class="card-body">
        <h3>Editar relatório {{$report->id}}</h3>
        <div class="input-group mb-3">
          <textarea rows="3" class="form-control" placeholder="Faça sua descrição aqui.">{{$report->description}}</textarea>
      </div>
      <button type="button" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </body>
</html>

@endsection