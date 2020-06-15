<?php
session_start();
include('php/opzeggenabbo.php');
if(!isset($_SESSION["adminkey"])){
    header('location:index.php');
}
else{
    include('php/opzoeken.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Athena's Game</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">
  <link href="css/gipstyle.css" rel="stylesheet">
</head>

<body>


	<!-- De navigatie balk bovenaan de pagina op elke pagina. -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
  	<a class="navbar-brand" href="index.php">Athena's Game</a>
  	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
  	  <span class="navbar-toggler-icon"></span>
  	</button>
  	<div class="collapse navbar-collapse" id="navbarResponsive">
  	  <ul class="navbar-nav ml-auto">
  	  <li class="nav-item">
  		  <a class="nav-link" href="producten.php">Producten</a>
  		</li>
  		  <li class="nav-item">
  		  <a class="nav-link" href="Subscribtie.php">Subscriptie</a>
  		</li>
  		   <?php
  		 //kijkt of de gebruiker is ingelogd en indien ja komt dit tevoorschijn.
  		 if(!isset($_SESSION["ingelogd"])){
  			 ?>
  		<li class="nav-item">
  		  <a class="nav-link" href="registreer.php">Registreer</a>
  		</li>
  		  <li class="nav-item">
  		  <a class="nav-link" href="Inloggen.php">Inloggen</a>
  		</li>
  		  <?php }
  		// en als je niet ingelogd ben krijg je dit te zien.
  		else{ ?>
  		  <li class="nav-item dropdown">
  		  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  			<?php echo $_SESSION["gebruikernaam"]; ?>
  		  </a>
  		  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
  			<a class="dropdown-item" href="Weizigen.php">Aanpassen</a>
  			<a class="dropdown-item" href="php/uitloggen.php">Uitloggen</a>
			<a class="dropdown-item" href="wijzigpaswoord.php">Aanpassen wachtwoord</a>
			<a class="dropdown-item" href="eigenfacturen.php">Eigen facturen bekijken</a>
			<?php
			//kijkt of de gebruiker een abbonnement heeft
			if(
			$_SESSION["klantabbonement"] != 1){ ?>
			<a class="dropdown-item" href="<?php echo $_SERVER['PHP_SELF']; ?>?opzeggen=goed">Opzeggen abonnement</a>
  			  <?php
		  }
  			// dit is alleen zichtbaar waneer de gebruiker een admin is.
  			if($_SESSION["adminkey"] == true){?>
  			<a class="dropdown-item" href="toonklanten.php">Gebruikers Bekijken</a>
			<a class="dropdown-item" href="addproducten.php"> Producten Toevoegen</a>
			<a class="dropdown-item" href="weizigproducten.php"> Producten Wijzigen</a>
			<a class="dropdown-item" href="Voegstocktoe.php">Stock toevoegen</a>
			<a class="dropdown-item" href="bekijk_alle_factuurs.php">Facturen bekijken</a>
  			  <?php } ?>
  		  </div>
  		</li>
  		  <?php
  		  }
  		//hierna word het winkelwagentje getoont. Als er niets is ingevuld dan toont hij niet het aantel producten maar als dit wel zo is geeft hij weer hoeveel er van 1 product aanwezig is in de winkelwagentje.
  		  ?>
  	  <li class="nav-item">
  			<a class="notification" href="winkelwagen.php"><span class="glyphicon">&#x1f6d2;</span><span class="badge"><?php if($_SESSION["count"] != 0){echo $_SESSION["count"];} ?></span></a>
  		</li>
  	  </ul>
  	</div>
    </div>
    </nav>

  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Klanten Zoeken
      <small></small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Het opzoeken van klanten</li>
    </ol>




     <div class="col-lg-9 mb-4">
        <h3></h3>
        <form name="sentMessage" id="contactForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php if(!isset($toon)){ ?>
            <div class="control-group form-group">
            <div class="controls">
              <label>Welk soort:</label><br>
              <input type="radio" name="keus" value="voornaam"> &nbsp; <label>Voornaam</label><br>
              <input type="radio" name="keus" value="achternaam"> &nbsp; <label>Achternaam</label><br>
              <input type="radio" name="keus" value="gebruikersnaam" <?php if(isset($_POST["versturen"]) && $_POST["zoekwaarde"] == "gebruikersnaam"){ ?>checked <?php }else if(!isset($_POST["versturen"])){ ?>checked<?php } ?> > &nbsp; <label>Gebruikersnaam</label><br>
              <input type="radio" name="keus" value="email"> &nbsp; <label>Email</label><br>

              <label>Zoekwaarde:</label>
              <input type="text" class="form-control" name="zoekwaarde" value="<?php if(isset($_POST["zoekwaarde"])){echo $_POST["zoekwaarde"];} ?>" id="zoekwaarde" required data-validation-required-message="Gelieve u zoekwaarde in te voeren.">
            </div>
          </div>
          <div id="success"></div>
          <button type="submit" name="versturen" class="btn btn-primary" id="sendMessageButton">Versturen</button>
            <?php } else{ for($i = 0; $i < $teller; $i++){ ?>
            <div class="klantendisplay">
          <p><b>Voornaam: </b>  <?php echo $voornaam[$i]; ?> </p>
          <p><b>Achternaam: </b><?php echo $achternaam[$i]; ?> </p>
          <p><b>gebruikersnaam: </b><?php echo $gebruikersnaam[$i]; ?> </p>
          <p><b>Email: </b><?php echo $email[$i]; ?> </p>
		  <p><b>Soort Abbonement: </b><?php switch ($klantabbonement[$i]) {
		  	case 2:
		  		echo "Basis";
		  		break;
			case 3:
			  	echo "Plus";
			  		break;
			case 4:
				echo "Ultra";
					break;
		  	default:
		  		echo "Heeft geen abbonement";
		  		break;
		  } ?></p>
          <p><b>Postcode en gemeente </b><?php $postcodeid = $postcodeids[$i]; include('php/Rpostcodeid.php'); echo $pcid; ?> </p>

          <br />
        </div>
            <?php }}; ?>
         </form>
      </div>


    </div>

  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Athena's Game</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
