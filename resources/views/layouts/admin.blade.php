<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand mx-2" href="#">Cazco Teste</a>


  @if (session()->has('LoggedAdmin'))

  <div class="col-10">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/admin/users">Lista de usuários <span class="sr-only"></span></a>
      </li>
    </ul>
  </div>


    <a href="/admin/logout">Sair</a>

  @endif

</nav>

<div class="mx-2 my-2"> 
  @yield('content')
  </div>