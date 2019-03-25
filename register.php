<?php
session_start();
require('bdd.php');
//Une fois que le boutton connexion est enclenché
if (isset($_POST['inscription'])) {
    $username = htmlspecialchars($_POST['username']);
    $pwd = $_POST['pwd'];
    $pwdR = $_POST['pwdR'];
    $email = htmlspecialchars($_POST['email']);
    $starter = $_POST['starter'];

    
    //On vérifie que les deux champs sont complété
    if (!empty($username) or !empty($pwd) or !empty($pwdR) or !empty($email)) {
        // $userExist = connection($mailCo, $mdpCo);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mailExist =  checkMail($email);
            if ($mailExist == 0) {
                if ($pwd == $pwdR) {
                    if (!isset($starter)) {
                        $erreur = "choose a starter pokemon";
                    } else {
                        $creationUtilisateur = subscription($username,$email,$pwd,$starter);
                        if($creationUtilisateur == 1){
                            $erreur = "Votre compte a bien été crée";
                        }
                        else {
                            $erreur = "Erreur lors de la création du compte";
                        }
                    }
                } else {
                    $erreur = "Passwords does not match";
                }
            } else {
                $erreur = "email already existing";
            }
        } else {
            $erreur = "email format not valid";
        }
    } else {
        $message = "Empty fields";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link type="text/css" rel="stylesheet" href="./css/materialize.min.css" media="screen,projection">

    <link href="css/register-style.css" rel="stylesheet">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    <div class="row">
        <div class="col l6 offset-l3 s12 m10 offset-m1">
            <div class="card z-depth-3">
                <div class="card-action title">
                    <div class="center above">
                        Pokedex
                        <div class=" superpose">
                            Pokedex
                        </div>
                    </div>

                </div>
                <p class="center">Create your account</p>
                <div class="card-content">
                    <form action="register.php" method="POST">
                        <div class="input-field">
                            <i class="material-icons prefix">person</i>
                            <input type="text" name="username" id="username" class="validate">
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field">
                            <i class="material-icons prefix">lock</i>
                            <input type="password" name="pwd" id="password" class="validate">
                            <label for="password">Password</label>
                        </div>
                        <div class="input-field">
                            <i class="material-icons prefix">lock</i>
                            <input type="password" name="pwdR" id="passwordR" class="validate">
                            <label for="passwordR">Repeat passowrd</label>
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" name="email" class="validate">
                            <label for="email">Email</label>
                        </div>

                        <div class="input-field">
                            <div class='center'>
                                <i class="material-icons prefix">pets</i>
                                <a class="waves-effect waves-light btn modal-trigger center" href="#modal1">Starter</a>
                            </div>
                        </div>
                        <div id="modal1" class="modal bottom-sheet">
                        <div class="modal-content">
                            <h4>Choose your starter pokemon</h4>
                            <div class=" container row">

                                <div class="col s4">
                                        <div class="card green hoverable">
                                            <div class="card-content white-text modal-action modal-close">
                                                <span class="card-title center-align"><img src="./img/bullbasaur.png" class="circle responsive-img tooltipped" data-position="top" data-delay="50" data-tooltip="Choose me!" />
                                                </span>
                                                <p class="center-align">Bulbizarre</p>
                                            </div>
                                            <div class="card-action">
                                                <input name="starter" type="radio" id="bulbizarre" value="1"/>
                                                <label for="bulbizarre" class="white-text">CHOISIR BULBIZARRE</label>
                                            </div>
                                        </div>
                                </div>

                                <div class="col s4">
                                        <div class="card amber darken-3 hoverable">
                                            <div class="card-content white-text modal-action modal-close">
                                                <span class="card-title center-align"><img src="./img/charmander.png" class="circle responsive-img tooltipped" data-position="top" data-delay="50" data-tooltip="Choose me!" />
                                                </span>
                                                <p class="center-align">Salameche</p>
                                            </div>
                                            <div class="card-action">
                                                <input name="starter" type="radio" id="salameche" value="4"/>
                                                <label for="salameche" class="white-text">CHOISIR SALAMECHE</label>
                                            </div>
                                        </div>

                                </div>

                                <div class="col s4">
                                        <div class="card light-blue lighten-3 hoverable">
                                            <div class="card-content white-text modal-action modal-close">
                                                <span class="card-title center-align">
                                                    <img src="./img/squirtle.png" class="circle responsive-img tooltipped" data-position="top" data-delay="50" data-tooltip="Choose me!" />
                                                </span>
                                                <p class="center-align">Carapuce</p>
                                            </div>
                                            <div class="card-action">
                                                <input name="starter" type="radio" id="carapuce" value="7"/>
                                                <label for="carapuce" class="white-text">CHOISIR CARAPUCE</label>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                        </div>
                    </div>

                        <div class="input-field btn-container">
                            <div class="center">
                                <input type="submit" name="inscription" value="Sign-up" class="waves-effect waves-light btn btn-small">
                            </div>
                        </div>

                    </form>
                    <span class="right-align">Vous avez déjà un compte ? <a href="login.php" class="">connectez-vous </a></span>

                    <?php
                    if (isset($erreur)) {
                        //Si l'une des conditions ne se passe pas correctement on affiche le mesage d'erreur correspondant
                        echo '<font color="red">' . $erreur . '</font>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!--Import jQuery before materialivze.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="./js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.modal').modal();
            $('.tooltipped').tooltip({
                delay: 50
            });
        });
    </script>
</body>

</html> 