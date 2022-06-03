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
        <div class="form-group">
          <input type="text" id="name" name="name" class="form-control" placeholder="Nome" value="{{ old('name')}}">
          @error('name')<span class="text-danger">{{ $message }} </span>@enderror
      </div>
        <div class="form-group">
            <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email')}}">
            @error('email')<span class="text-danger">{{ $message }} </span>@enderror
        </div>
        <div class="form-group">
            <input type="password" id="password" name="password" class="form-control" placeholder="Senha">
            @error('password')<span class="text-danger">{{ $message }} </span>@enderror
        </div>
        <div class="form-group">
          <input type="password" id="passwordConfirmation" name="passwordConfirmation" class="form-control" placeholder="Confirmação de senha" aria-label="Password" aria-describedby="basic-addon1">
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </body>
</html>

@endsection