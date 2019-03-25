<?php 
session_start();
require('bdd.php');
$pokemons = getPokemonList();
$nb = sizeof($pokemons);
$nbEvo = 0;
$nbPerType = getStatPerType();
foreach ($pokemons as $poke) {
    if ($poke->isEvolution()) {
        $nbEvo++;
    }
}

?>
<html>

<head>
    <meta charset="utf-8" />
    <title>HOME</title>
    <link href="bootstrap-4.3.0-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/home-style.css" rel="stylesheet">
</head>

<body class="container-fluid">
    <?php include("header.html"); ?>
    <div class="card mt-4" style="width: 80%;margin: auto">
    <div class="card-body">
        <h6 class="card-title"><span class=""><?php echo ($nb); ?></span> Pokemon dans ton Pokedex.</h6>

        <h6 class="card-title"><span class=""><?php echo ($nb - $nbEvo); ?></span> base(s)</h6>

        <h6 class="card-title"><span class=""><?php echo ($nbEvo); ?></span> évolution(s)</h6>

        <table class="table table-striped">
            <thead class="thead-dark">
            <th>Type</th>
            <th>Nb Pokemon</th>
            </thead>
            <tbody>
            <?php
            foreach ($nbPerType as $lib => $nb){
                //$pokemon = unserialize($p);
                echo "<tr>";
                echo "<td>".$lib."</td>";
                echo "<td>".$nb."</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


</body>

</html> 