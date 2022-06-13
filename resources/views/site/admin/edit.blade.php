@extends('layouts.admin')

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

        @error('success')
        <div class="alert alert-success"> {{ $message }} </div>
        @enderror
    
        @error('fail')
        <div class="alert alert-danger"> {{ $message }} </div>
        @enderror

        <?php
        $id = Crypt::encrypt($users->id);
        ?>
        
        <form action="/admin/edit/{{$id}}" method="POST">
          @csrf
          @method('PUT')
        <div class="mb-3">
          <input id="name" name="name" type="text" class="form-control" value="{{$users->name}}" placeholder="Nome">
          @error('name')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="mb-3">
            <input id="email" name="email" type="text" class="form-control" value="{{$users->email}}" placeholder="Email">
            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </body>
</html>

@endsection