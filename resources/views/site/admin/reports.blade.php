@extends('layouts.admin')

@section('Title')

@section('content')

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Relatórios</title>
    
  </head>
  <body>
    <div class="card">
      <div class="card-body">
        <div class="col"><h3>Relatórios</h3></div>

        @error('success')
        <div class="alert alert-success"> {{ $message }} </div>
        @enderror
    
        @error('fail')
        <div class="alert alert-danger"> {{ $message }} </div>
        @enderror

        <table class="table table-striped table-hover" >
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Dia</th>
              <th scope="col">Id Usuário</th>
              <th scope="col">Descrição</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($reports as $reports)
            <tr>
              <td>{{$reports->id}}</td>
              <td>{{$reports->day}}</td>
              <td>{{$reports->user_id}}</td>
              <td>{{$reports->description}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>

@endsection