<?php 
require('bdd.php');
?>
<html>

<head>
    <meta charset="utf-8" />
    <link href="bootstrap-4.3.0-dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include("header.html"); ?>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h2 class="display-4">Liste des pokemons</h2>
            <p class="lead"></p>
        </div>
    </div>
    <table class='table table-secondary col align-self-cente'>
        <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>nom</th>
                <th>details</th>
                <th>Supprimer</th>
            </tr>
        </thead>

        <?php 
        $pokemonList = getPokemonList();
        foreach ($pokemonList as $row) {
          echo "<tr >
                  <td>#".$row->getId()."</td>
                  <td>".$row->getNom()."</td>
                  <td><a href='DETAIL.php?id=".$row->getId()."'>details</a></td>
                  <td>Supprimer</td>
              </tr>";
        }
        ?>
    </table>
</body>

</html> 