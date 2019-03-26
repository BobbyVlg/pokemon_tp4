<?php 
	session_start();
	require('bdd.php');
    //Une fois que le boutton connexion est enclenché
	if(isset($_POST['connexion']))
	{
		$mailCo = htmlspecialchars($_POST['mailCo']);
		$mdpCo = $_POST['mdpCo'];
        
    //On vérifie que les deux champs sont complété
		if(!empty($mailCo) AND !empty($mdpCo))
		{
			$user = connection($mailCo,$mdpCo);
			//Création des variable de session et connexion de l'utilisateur
			if(isset($user))
			{
        $_SESSION['id'] = $user['id'];
				$_SESSION['username'] = $user['username'];
				$_SESSION['email'] = $user['email'];
				$_SESSION['is_active'] = $user['is_active'];
				$_SESSION['nb_piece'] = $user['nb_pieces'];
        $_SESSION['starter_id'] = $user['starter_id'];
				header("location:HOME.php");
				
			}
			else
			{
				$message = "Adresse mail ou mot de passe incorrect !";		
			}
		}
		else{
			$message = "Tous les champs doivent être remplis";
		}
	}
	
?>
<!DOCTYPE html>
<html>

<head>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" media="screen,projection" />
  <link href="css/login-style.css" rel="stylesheet">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

  <div class="row">
    <div class="col l6 offset-l3 s12 m10 offset-m1">
      <div class="card z-depth-3" style="background-color:rgba(0, 0, 0, 0); margin-top: 15%;">
        <div class="card-action title">
          <div class=" center above">
            Pokedex
              <div class=" superpose">
              Pokedex
              </div>
          </div>
          
        </div>
        <div class="card-content">
          <form action="" method="POST">
            <div class="input-field">
              <i class="material-icons prefix ">person</i>
              <input type="text" name="mailCo" id="email">
              <label for="email">Email</label>
            </div>
            <div class="input-field">
              <i class="material-icons prefix">lock</i>
              <input type="password" name="mdpCo" id="password">
              <label for="password">Password</label>
            </div>

            <input type="checkbox" name="" id="checkbox">
            <label for="checkbox">Remember Me</label>
            <div class="btn-container">
              <div class="center">
                <input type="submit" name="connexion" value="Sign-in" class="btn btn-large transparent teal-text">
              </div>
              <div class="center">
                <a href="register.php" class="btn btn-large transparent teal-text">Sign-up</a>
              </div>
            </div>
      </form>
      
		  <?php
        if (isset($message))
        {
        	//Si l'une des boulce ne se passe pas correctement on affiche le mesage d'erreur correspondant
          echo '<font color="red">' . $message . '</font>';
        }
    ?>
        </div>
      </div>
    </div>
  </div>

  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js">
  </script>
</body>

</html>
    