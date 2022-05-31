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
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nome" aria-label="Username" aria-describedby="basic-addon1">
      </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Senha" aria-label="Password" aria-describedby="basic-addon1">
        </div>
        
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirmação de senha" aria-label="Password" aria-describedby="basic-addon1">
      </div>
      <button type="button" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </body>
</html>

@endsection