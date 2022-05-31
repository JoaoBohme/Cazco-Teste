<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>

    <div class="card">
      <div class="card-body">
        <h3>Usuários</h3>
        <table class="table table-striped table-hover" >
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Mark@gmail.com</td>
              <td>
                <a href="#" type="button" class="btn btn-success">Ver relatórios</a>
                <a href="edit" type="button" class="btn btn-warning">Editar</a>
                <a href="#" type="button" class="btn btn-danger">Excluir</a>
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Jacob@outlook.com</td>
              <td>
                <a href="#" type="button" class="btn btn-success">Ver relatórios</a>
                <a href="edit" type="button" class="btn btn-warning">Editar</a>
                <a href="#" type="button" class="btn btn-danger">Excluir</a>
              </td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry the Bird</td>
              <td>LarrytheBird@qbit.com.br</td>
              <td>
                <a href="#" type="button" class="btn btn-success">Ver relatórios</a>
                <a href="edit" type="button" class="btn btn-warning">Editar</a>
                <a href="#" type="button" class="btn btn-danger">Excluir</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </body>
</html>