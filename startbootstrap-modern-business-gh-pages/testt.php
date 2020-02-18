<?php
session_start();
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
 <!-- opmaak gemaakt door diangelo -->
  <link href="css/diangelostyle.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

  <script type="text/javascript">

   function wijzig()
  {
  var ok = true;
  if (document.getElementById("naam").value==""){
      document.getElementById("naamVerplicht").innerHTML="Gelieve een naam in te vullen";
      ok=false;
          }
      else{
          document.getElementById("naamVerplicht").innerHTML="";
      }

   if (document.getElementById("paswoord").value==""){
      document.getElementById("paswoordVerplicht").innerHTML="Gelieve een paswoord in te vullen";
      ok=false;
          }
      else{
          document.getElementById("paswoordVerplicht").innerHTML="";
      }

  if (document.getElementById("paswoord").value != "") {
     var string=document.getElementById("paswoord").value;

  	var filter=/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;

       if ( filter.test(string)){
       document.getElementById("paswoordControle").innerHTML="";
      }
      else{
           document.getElementById("paswoordControle").innerHTML="Ongeldig paswoord, bevat minstens 1 cijfer en 1 hoofdletter en kleine letter, minimum 8 characters";
          ok=false;
      }
   }
    if (document.getElementById("paswoordConfirm").value==""){
      document.getElementById("paswoordConfirmVerplicht").innerHTML="Gelieve een bevestigingspaswoord in te vullen";
      ok=false;
          }
      else{
          document.getElementById("paswoordConfirmVerplicht").innerHTML="";

    if (!(document.getElementById("paswoordConfirm").value==document.getElementById("paswoord").value)){
      document.getElementById("paswoordConfirmVerplicht").innerHTML="bevestigingspaswoord en paswoord komen niet overeen";
      ok=false;
          }
      else{
          document.getElementById("paswoordConfirmVerplicht").innerHTML +="";
      }
  	}
  if (ok==true){

  }
  }
  </script>

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
  		  <a class="nav-link" href="contact.php">Contact</a>
  		</li>
  	  <li class="nav-item">
  		  <a class="nav-link" href="producten.php">Producten</a>
  		</li>
  		  <li class="nav-item">
  		  <a class="nav-link" href="Subscribtie.php">Subscribtie</a>
  		</li>
  		   <?php
  		 //kijkt of de gebruiker is ingelogd en indien ja komt dit tevoorschijn.
  		 if(!isset($_SESSION["ingelogd"])){
  			 ?>
  		<li class="nav-item">
  		  <a class="nav-link" href="registreer.php">Registreer</a>
  		</li>
  		  <li class="nav-item">
  		  <a class="nav-link" href="Inloggen.php">inloggen</a>
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
  			  <?php
  			// dit is alleen zichtbaar waneer de gebruiker een admin is.
  			if($_SESSION["adminkey"] == true){?>
  			<a class="dropdown-item" href="toonklanten.php">Gebruikers Bekijken</a>
			<a class="dropdown-item" href="addproducten.php"> Producten Toevoegen</a>
			<a class="dropdown-item" href="weizigproducten.php"> Producten Weizigen</a>
  			  <?php } ?>
  		  </div>
  		</li>
  		  <?php
  		  }
  		//hierna word het winkelwagentje getoont. Als er niets is ingevuld dan toont hij niet het aantel prodcuten maar als dit wel zo is geeft hij weer hoeveel er van 1 product aanwezig is in de winkelwagentje.
  		  ?>
  	  <li class="nav-item">
  			<a class="notification" href="winkelwagen.php"><span class="glyphicon">&#x1f6d2;</span><span class="badge"><?php if($_SESSION["count"] != 0){echo $_SESSION["count"];} ?></span></a>
  		</li>
  	  </ul>
  	</div>
    </div>
    </nav>

<?php
    //bij succesvol inloggen komt de gebruiker terug naar de beginpagina.
    if(isset($_SESSION["ingelogd"])){header("location:index.php");}
    ?>
  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Registreren
      <small>Gegevens</small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Registratie</li>
    </ol>



<form name="inlogpagina" id="myForm" method="post" action="aangemeld.php">
<table cellspacing="4">
<tr>
<td><label for="naam">Naam:</label></td>
<td><input type="text" name="naam" id="naam"></td>
<td><label id="naamVerplicht" class="fout"></label></td>
</tr>
<tr>
<tr>
<td><label for="paswoord">paswoord:</label></td>
<td><input type="password" name="paswoord" id="paswoord"  ></td>
<td><label id="paswoordControle" class="fout"></label><label id="paswoordVerplicht" class="fout"></label></td>
</tr>
<tr>
<td><label for="paswoordConfirm">bevestiging paswoord:</label></td>
<td><input type="password" name="paswoordConfirm" id="paswoordConfirm"  ></td>
<td><label id="paswoordConfirmControle" class="fout"></label><label id="paswoordConfirmVerplicht" class="fout"></label></td>
</tr>
<tr>
<td></td>
<td>
<input type="button" value="inloggen" onclick="wijzig()" />
</td>
</tr>
</table>
</form>

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Athena's Game 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Contact form JavaScript -->
  <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
  <script src="js/jqBootstrapValidation.js"></script>

  <!-- Javascript voor paswoord -->
  <script src="js/paswoordvalidatie.js"></script>
  <script src="js/foutcontrole.js"></script>
</body>

</html>
