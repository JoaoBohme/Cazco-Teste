@extends('layouts.admin')

@section('content')

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de usuários</title>
    
  </head>
  <body>
    <div class="card">
      <div class="card-body">
      <div class="row">
        <div class="col-6"><h3>Usuários</h3></div>
        <div class="col"><a href="create" type="button" class="btn btn-primary">Criar Usuário</a></div>
      </div>

      @error('success')
      <hr>
      <div class="alert alert-success"> {{ $message }} </div>
      @enderror

      @error('fail')
      <hr>
      <div class="alert alert-danger"> {{ $message }} </div>
      @enderror
<hr>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $users)
            <tr>
              <th>{{$users->id}}</th>
              <th>{{$users->name}}</th>
              <th>{{$users->email}}</th>
              <?php
                $id = Crypt::encrypt($users->id);
              ?>
              <td>
                <a href="reports/{{$id}}" type="button" class="btn btn-success">Relatórios</a>
                <a href="edit/{{$id}}" type="button" class="btn btn-warning">Editar</a>
              </td>
              <td>
                <form action="/admin/users/{{$users->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>

@endsection