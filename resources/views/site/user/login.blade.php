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

    </br>

    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
      <input type="password" class="form-control" placeholder="Senha" aria-label="Password"
        aria-describedby="basic-addon1">
    </div>

    <div style="text-align: center;">
      <a href="#" type="button" class="btn btn-primary">Entrar</a>
    </div>

    <div style="text-align: center; padding-top: 10px;">
      <a href="forgot-password">Esqueci minha senha</a>
    </div>

  </div>

</body>

</html>