<?php
require('Pokemon.php');
function getPDO()
{
    $dbName = "pokegame";
    $user = 'Pokegame';
    $strConnection = 'mysql:host=localhost;dbname=' . $dbName; //Ligne 1
    $arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); //Ligne 2
    $pdo =  new PDO($strConnection, $user, $dbName, $arrExtraParam);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}


function getTypePokemon()
{
    $pdo = getPDO();
    $query = 'SELECT id,libelle FROM ref_elementary_type';
    $res = $pdo->query($query)->fetchAll();
    $list = [];
    foreach ($res as $row) {
        $list[$row['id']] = $row['libelle'];
    }
    return $list;
}

function getNbPokemon()
{
    $pdo = getPDO();
    $query = 'SELECT count(id) FROM ref_pokemon';
    $res = $pdo->query($query)->fetch();

    return $res;
}

//Connexion a la bdd
function getPokemonList()
{
    $pdo = getPDO();
    $query = 'SELECT id,nom,evolution FROM ref_pokemon';
    $res = $pdo->query($query)->fetchAll();
    $list = [];
    //FIXME : les types sont nuls...
    foreach ($res as $row) {
        $list[] = new Pokemon($row['id'], $row['nom'], "", "", $row['evolution']);
    }
    return $list;
}

function getStatPerType()
{
    $pdo = getPDO();
    $query = 'SELECT libelle as type, count(*) as nb FROM ((SELECT t.id, t.libelle from ref_elementary_type t LEFT JOIN ref_pokemon p ON t.id = p.type_1) UNION ALL
(SELECT t.id, t.libelle from ref_elementary_type t LEFT JOIN ref_pokemon p ON t.id = p.type_2)) as s GROUP BY id';
    $res = $pdo->query($query)->fetchAll();
    $list = [];
    foreach ($res as $row) {
        $list[$row["type"]] = $row["nb"];
    }
    return $list;
}

function getPokemonById($id)
{
    $pdo = getPDO();
    //Select de tous les types du pokemon
    $query = 'SELECT p.id as pokeId, p.nom, p.evolution, p.type_1, p.type_2  FROM ref_pokemon p WHERE p.id = :id';
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    $prep->execute();
    $res = $prep->fetchAll();

    //init var
    $types = [];
    $id = null;
    $nom = null;
    $evo = null;
    $type1 = null;
    $type2 = null;
    foreach ($res as $row) {
        if (!isset($poke)) {
            $id = $row['pokeId'];
            $nom = $row['nom'];
            $type1 = $row['type_1'];
            $type2 = $row['type_2'];
            $evo = $row['evolution'];
        }
    }
    return new Pokemon($id, $nom, $type1, $type2, $evo);
}

function addPokemon($pokemon)
{
    $pdo = getPDO();
    //Insert pokemon
    $query = "INSERT INTO ref_pokemon (nom, evolution, type_1, type_2) VALUES (:nom, :evolution, :type1, :type2)";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':nom', $pokemon->getNom(), PDO::PARAM_STR);
    $prep->bindValue(':evolution', $pokemon->isEvolution(), PDO::PARAM_BOOL);
    $prep->bindValue(':type1', $pokemon->getType1(), PDO::PARAM_INT);
    $prep->bindValue(':type2', $pokemon->getType2(), PDO::PARAM_INT);
    $prep->execute();
}

function removePokemon($id)
{
    $pdo = getPDO();
    $query = "DELETE FROM ref_pokemon WHERE id = :pokeId";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':pokeId', $id, PDO::PARAM_INT);
    $prep->execute();
}

// trainer connection

function connection($mail, $pwd)
{
    $pdo = getPDO();
    $query = $pdo->prepare("SELECT * FROM trainer WHERE email=:trainerEmail AND password=:pwd");
    $query->bindValue(':trainerEmail', $mail, PDO::PARAM_STR);
    $query->bindValue(':pwd', $pwd, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    return $user;
}

/**
 * Train subscription
 * @return 1 if the requeste is done successfully and 0 if an error occured
 */
function subscription($username, $mail, $pwd, $starter)
{
    $pdo = getPDO();

    $query = $pdo->prepare("INSERT INTO trainer(username, password, email, is_active, nb_pieces,starter_id) VALUES(:username, :pwd, :trainerEmail, true, 1000,:starterId)");
    $query->bindValue(':trainerEmail', $mail, PDO::PARAM_STR);
    $query->bindValue(':pwd', $pwd, PDO::PARAM_STR);
    $query->bindValue(':username', $username, PDO::PARAM_STR);
    $query->bindValue(':starterId', $starterId, PDO::PARAM_INT);
    $query->execute();
    $addTrainer = $query->rowCount();

    linkPokemonToTrainer($starter,'M',0,1,0,0,null,1);

    return $addTrainer;
}

/**
 * @return 1 if the user exist or 0
 */
function checkMail($traineEmail)
{
    $pdo = getPDO();
    $query = $pdo->prepare("SELECT * FROM trainer WHERE email=:trainerEmail");
    $query->bindValue('trainerEmail', $traineEmail, PDO::PARAM_STR);
    $query->execute();

    $userExist = $query->rowCount();

    return $userExist;
}
function linkPokemonToTrainer($pokemonId, $sexe, $xp, $niveau, $a_vendre, $prix, $dtLastTrain, $dreseurId)
{ 
    $pdo = getPDO();
    $query = $pdo->prepare("INSERT INTO pokemon (ref_pokemon_id, sexe,xp, niveau, a_vendre, prix, date_dernier_entrainement, dresseur_id)
             VALUES (:pokemonId, :sexe, :xp, :niveau, :aVendre, :prix, :dtDernierTraining, :dresseurId)");
    $query->bindValue(':pokemonId', $pokemonId, PDO::PARAM_INT);
    $query->bindValue(':sexe', $sexe, PDO::PARAM_STR_CHAR);
    $query->bindValue(':xp', $xp, PDO::PARAM_INT);
    $query->bindValue(':niveau', $niveau, PDO::PARAM_INT);
    $query->bindValue(':aVendre', $a_vendre, PDO::PARAM_INT);
    $query->bindValue(':prix', $prix, PDO::PARAM_INT);
    $query->bindValue(':dtDernierTraining', $dtLastTrain, PDO::PARAM_STR);
    $query->bindValue(':dresseurId', $dreseurId, PDO::PARAM_INT);

    $query->execute();

 
}

function getTrainerPokemonList($id) {
    $pdo = getPDO();
    $query = 'SELECT p.ref_pokemon_id,nom,sexe,xp,niveau FROM pokemon p, ref_pokemon rp
              WHERE p.ref_pokemon_id = rp.id
              AND dresseur_id = :idDresseur';
    $prep = $pdo->prepare($query);
    $prep->bindValue(':idDresseur', $id, PDO::PARAM_INT);

    $prep -> execute();
    $res = $prep->fetchAll();
    return $res;

}
