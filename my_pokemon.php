<?php
session_start();
require('bdd.php');
$idTrainer = $_SESSION['id'];
echo($idTrainer);
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
            <h2 class="display-4">Mes pokemons</h2>
            <p class="lead"></p>
        </div>
    </div>
    <div class="container">
        <table class='table table-secondary col align-self-cente'>
            <thead class="thead-dark">
                <tr>
                    <th>id</th>
                    <th>nom</th>
                    <th>genre</th>
                    <th>xp</th>
                    <th>niveau</th>
                </tr>
            </thead>

            <?php 
            $pokemonList = getTrainerPokemonList($idTrainer);
            foreach ($pokemonList as $row) {
            echo "<tr >
                    <td>#".$row[0]."</td>
                    <td>".$row[1]."</td>
                    <td>".$row[2]."</a></td>
                    <td>".$row[3]."</td>
                    <td>".$row[4]."</td>
                </tr>";
            }
            ?>
        </table>
    </div>
    
</body>

</html> 