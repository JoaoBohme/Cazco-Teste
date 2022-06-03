<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}" media="screen" />

</head>

<body>
  <div class="wrapper">

    <div style="text-align: center;">
      <h3>Entrar</h3>
    </div>


    @error('msg')
    <div class="alert alert-danger"> {{ $message }} </div>
    @enderror

    </br>
<form action="/admin/login" method="POST">
  @csrf

    <div class="form-group">
      <input type="text" id="email" name="email" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
      @error('email')<div class="text-danger">{{ $message }} </div>@enderror
    </div>
    <div class="input-group mb-3">
      <input type="password" id="password" name="password" class="form-control" placeholder="Senha" aria-label="Password">

      @error('password')<div class="text-danger">{{ $message }} </div>@enderror
    </div>

    <div style="text-align: center;">
      <button type="submit" class="btn btn-primary">Entrar</button>
    </div>

    <div style="text-align: center; padding-top: 10px;">
      <a href="forgot-password">Esqueci minha senha</a>
    </div>

  </div>

</body>

</html>