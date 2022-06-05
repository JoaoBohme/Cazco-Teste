@extends('layouts.site')

@section('content')

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar relatório</title>
  </head>
  <body>
    <div class="card">
      <div class="card-body">
        <h3>Criar relatório</h3>
        <form action="/user/create-report/{{$LoggedUsersInfo->id}}" method="POST">
          @csrf
        <div class="input-group mb-3">
          <textarea id="description" name="description" class="form-control" rows="3" placeholder="Faça sua descrição aqui."></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </body>
</html>

@endsection