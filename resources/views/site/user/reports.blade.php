@extends('layouts.site')

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
        <div class="row">
            <div class="col-6"><h3>Relatórios</h3></div>
            <div class="col"><a href="create-report" type="button" class="btn btn-primary">Criar relatório</a></div>
          </div>
        <table class="table table-striped table-hover" >
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Dia</th>
              <th scope="col">Id Usuário</th>
              <th scope="col">Descrição</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($reports as $report)
              <tr>
                <td>{{$report->id}}</td>
                <td>{{$report->day}}</td>
                <td>{{$report->user_id}}</td>
                <td>{{$report->description}}</td>
                <td>
                  <a href="edit-report/{{$report->id}}" type="button" class="btn btn-warning">Editar</a>
                </td>
              @endforeach
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>

@endsection