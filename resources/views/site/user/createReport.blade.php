@extends('layouts.user')

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

        @error('success')
        <div class="alert alert-success"> {{ $message }} </div>
        @enderror
    
        @error('fail')
        <div class="alert alert-danger"> {{ $message }} </div>
        @enderror

        <form action="/user/create-report/{{$LoggedUsersInfo->id}}" method="POST">
          @csrf
        <div class="mb-3">
          <textarea id="description" name="description" class="form-control" rows="3" placeholder="Faça sua descrição aqui."></textarea>
          @error('description')<div class="text-danger">{{$message}}</div>@enderror
      </div>
        <div class="mb-3 col-2">
          <input type="date" name="day" id="day" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control">
          @error('day')<div class="text-danger">{{$message}}</div>@enderror
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </body>
</html>

@endsection