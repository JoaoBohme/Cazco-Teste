@extends('layouts.site')

@section('Title', $users->name)

@section('content')

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar usuário</title>
  </head>
  <body>
    <div class="card">
      <div class="card-body">
        <h3>Editar {{$users->name}}</h3>
        <form action="/admin/edit/{{$users->id}}" method="POST">
          @csrf
          @method('PUT')
        <div class="input-group mb-3">
          <input id="name" name="name" type="text" class="form-control" value="{{$users->name}}" placeholder="Nome" aria-label="Username" aria-describedby="basic-addon1">
      </div>
        <div class="input-group mb-3">
            <input id="email" name="email" type="text" class="form-control" value="{{$users->email}}" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </div>

  </body>
</html>

@endsection