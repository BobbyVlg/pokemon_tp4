<html>
  <head>
    <meta charset="utf-8" />
    <link href="bootstrap-4.3.0-dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>

  <body>
    <?php include("header.html"); ?>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h2 class="display-4">Ajouter un pokemon</h2>
        <p class="lead"></p>
      </div>
    </div>

    <form method="GET" action="" class="form-group col-md-6">
      <label>Nom</label>
      <input type="text" name="nom" class="form-control" />

      <label>courbe xp</label>
      <input type="text" name="xp" class="form-control" />

      <label>evolution</label>
      <input type="text" name="evolution" class="form-control" />

      <label>type</label>
      <input type="text" name="type" class="form-control" />

      <label>type secondaire</label>
      <input type="text" name="typeSecondaire" class="form-control" />

      <button type="submit" class="btn btn-outline-secondary">Ajouter</button>
    </form>
  </body>
</html>
