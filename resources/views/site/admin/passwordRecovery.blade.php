<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperar senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <div class="card">
      <div class="card-body">

        <h3>Recuperar senha</h3>

        @error('success')
        <div class="alert alert-success"> {{ $message }} </div>
        @enderror
    
        @error('fail')
        <div class="alert alert-danger"> {{ $message }} </div>
        @enderror

        <form action="/admin/password-recovery/{{$email}}" method="post">
          @csrf
          @method('PUT')
        <div class="mb-3"> 
          <input id="password" name="password" type="password" class="form-control" placeholder="Senha">
          @error('password')<div class="text-danger">{{$message}}</div>@enderror
        </div>
        <div class="mb-3">
          <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirmação da senha">
        </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
      </div>
    </div>
  </body>
</html>