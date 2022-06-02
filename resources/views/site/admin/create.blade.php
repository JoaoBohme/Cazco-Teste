@extends('layouts.site')

@section('content')

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar usuário</title>
  </head>
  <body>
    <div class="card">
      <div class="card-body">
        <h3>Criar usuário</h3>
        <form action="/admin/create" method="POST">
          @csrf
        <div class="input-group mb-3">
          <input type="text" id="name" name="name" class="form-control" placeholder="Nome" aria-label="Username" aria-describedby="basic-addon1">
      </div>
        <div class="input-group mb-3">
            <input type="text" id="email" name="email" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Senha" aria-label="Password" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
          <input type="password" id="passwordConfirmation" name="passwordConfirmation" class="form-control" placeholder="Confirmação de senha" aria-label="Password" aria-describedby="basic-addon1">
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </body>
</html>

@endsection