<?php 
session_start();
require('bdd.php');
?>
<html>
<head>
    <meta charset="utf-8" />
    <link href="bootstrap-4.3.0-dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    //Preparation affichage detail
    $types = getTypePokemon();
    $id = $_GET["id"];
    $pokemon = getPokemonById($id);

    ?>
    <?php include("header.html"); ?>
    

    <div class="card mt-5" style="width: 80%;margin: auto">
    <div class="card-body">
        <h5 class="card-title">Infos détaillées</h5>
        <p>Numéro de Pokédex : <?php echo $pokemon->getId()?></p>
        <p>Nom : <?php echo $pokemon->getNom()?></p>
        <p>Type1 : <?php echo $types[$pokemon->getType1()]?></p></p>
        <p>Type2 : <?php echo isset($types[$pokemon->getType2()])?$types[$pokemon->getType2()]:"-" ?></p></p>
        <p>Est une <?php echo $pokemon->isEvolution()?'Evolution':'Base'?></p>
        <?php echo "<p><a href=\"index.php?page=list&action=remove&id=".$pokemon->getId()."\">Supprimer</a></p>"; ?>
    </div>
</div>

</body>
<?php 
if (isset($_POST['delete'])) {
  //TO DO
  // delete from array 
  // redirect to List Page
  // Inform user ( pop up)
}
?>

</html> 