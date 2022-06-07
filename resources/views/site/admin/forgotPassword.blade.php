<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trocar senha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
  <div class="card">
    <div class="card-body">
      <h3>Insira seu email</h3>

      <form action="/admin/forgot-password" method="post">
        @csrf
      <div class="input-group mb-3">
        <input id="email" name="email" type="text" class="form-control" placeholder="Email" aria-label="Username"
          aria-describedby="basic-addon1">
      </div>
      @error('email')<div class="text-danger">{{ $message }} </div>@enderror
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    </div>
  </div>

</body>

</html>