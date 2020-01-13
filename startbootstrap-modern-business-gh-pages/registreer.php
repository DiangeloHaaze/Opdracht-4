<?php
$foutreg = 0;
session_start();
include("php/postcodeid.php");

    If(isset($_POST["versturen"]) && isset($_POST["voornaam"]) && $_POST["voornaam"] != "" && isset($_POST["achternaam"]) && $_POST["achternaam"] != "" && isset($_POST["gebruikersnaam"]) && $_POST["gebruikersnaam"] != "" &&  isset($_POST["postcode"]) && $_POST["postcode"] != "" &&  isset($_POST["gemeente"]) && $_POST["gemeente"] != "" && isset($pcid)){

   

    $mysqli = mysqli_connect('localhost', 'root', '', 'athenagames');
      if(mysqli_connect_errno()) {trigger_error('Fout bij verbinding: '.$mysqli->error); }
           else {
               
  	$username = $_POST['gebruikersnaam'];
  	$email = $_POST['email'];
  	$password = $_POST['paswoord'];

  	$sql_u = "SELECT * FROM tblklanten WHERE gebruikersnaam='$username'";
  	$sql_e = "SELECT * FROM tblklanten WHERE email='$email'";
    
  	$res_u = mysqli_query($mysqli, $sql_u);
  	$res_e = mysqli_query($mysqli, $sql_e);

  	if (mysqli_num_rows($res_u) > 0 && mysqli_num_rows($res_e) > 0) {
        $foutreg = 1;
  	}else if(mysqli_num_rows($res_u) > 0){
        $foutreg = 2;
    }else if(mysqli_num_rows($res_e) > 0){
       $foutreg = 3;
  	}else{


         $sql = "        
         INSERT INTO tblklanten ( voornaam, achternaam, gebruikersnaam, postcodeid, email, paswoord) VALUES ( ?,?,?,?,?,?)";
        if($stmt = $mysqli->prepare($sql))
        {
        $stmt->bind_param('sssiss',$voornaam,$achternaam,$gebruikersnaam2,$postcodeid,$email2,$paswoord2);
         $voornaam= $_POST["voornaam"];
         $achternaam = $_POST["achternaam"];
         $gebruikersnaam2= $_POST["gebruikersnaam"];
            $_SESSION["gebruikernaam"] = $_POST["gebruikersnaam"];
         $postcodeid = $pcid;
         $email2 = $_POST["email"];
         $paswoord2 = $_POST["paswoord"];
            $_SESSION["paswoord"] = $_POST["paswoord"];
             if(!$stmt->execute()){
            echo 'het uitvoeren van de query is mislukt:';
             }
             else
                 { 
                 $_SESSION["ingelogd"] = true;
                 ; }
                $stmt->close();
                }
         else{ echo 'Er zit een fout in de query'; }
                }
    
        
 }
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
 <!-- opmaak gemaakt door diangelo -->
  <link type="text/css" href="css/Stylediangelo.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

    
    
</head>

<body>
  
  <!-- navigatie -->
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
             <?php if(!isset($_SESSION["ingelogd"])){ ?>
          <li class="nav-item">
            <a class="nav-link" href="registreer.php">Registreer</a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="Inloggen.php">inloggen</a>
          </li>
            <?php } else{ ?>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION["gebruikernaam"]; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="Weizigen.php">Aanpassen</a>
              <a class="dropdown-item" href="php/uitloggen.php">Uitloggen</a>
                <?php if($_SESSION["adminkey"] == true){?>
              <a class="dropdown-item" href="toonklanten.php">Gebruikers bekijken</a>
                <?php } ?>
            </div>
          </li>
            <?php
            }
            ?>
        </ul>
      </div>
    </div>
  </nav>
<?php
    //gaan naar start na het inloggen
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
      <!-- Map Column -->
      
     

    <!-- Contact Form -->
    <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <div class="row">
      <div class="col-lg-9 mb-4">
        <h3></h3>
        <form name="sentMessage" id="contactForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="control-group form-group">
            <div class="controls">
              <label>Voornaam:</label>
              <input type="text" class="form-control" name="voornaam" id="voornaam" required data-validation-required-message="Gelieve u voornaam in te voeren.">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>Achternaam:</label>
              <input type="text" class="form-control" name="achternaam" id="achternaam" required data-validation-required-message="Gelieve u achternaam in te voeren.">
            </div>
          </div>
            <div class="control-group form-group">
            <div class="controls">
              <label>Gemeente:</label>
              <input type="text" class="form-control" name="gemeente" id="gemeente" required data-validation-required-message="Gelieve u gemeente in te voeren.">
            </div>
          </div>
            <div class="control-group form-group">
            <div class="controls">
              <label>Postcode:</label>
              <input type="text" class="form-control" name="postcode" id="postcode" pattern="[0-9]{4}" required data-validation-required-message="Gelieve u postcode in te voeren.">
            </div>
          </div>
            <div class="control-group form-group">
            <div class="controls">
              <label>Gebruikersnaam:</label>
              <input type="text" class="form-control" name="gebruikersnaam" id="gebruikersnaam" required data-validation-required-message="Gelieve u gebruikersnaam in te voeren.">
            </div>
          </div>
            <div class="control-group form-group">
            <div class="controls">
              <label>Email:</label>
              <input type="email" class="form-control" name="email" id="email"  required data-validation-required-message="Gelieve u email in te voeren.">
            </div>
          </div>
            <div class="control-group form-group">
            <div class="controls">
              <label>Paswoord:</label>
               <input type="password" class="form-control" name="paswoord" id="paswoord" required data-validation-required-message="Gelieve u paswoord in te voeren." pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Moet minstens 1 hoofdletter, 1 kleine letter, 1 cijfer en moet minstens 8 letters groot zijn">
            </div>
            </div>
            <div id="message">
              <h3>Het wachtwoord moet minstens :</h3>
              <p id="letter" class="fout">Een <b>Kleine</b> letter</p>
              <p id="capital" class="fout">Een <b>Hoofdletter</b></p>
              <p id="number" class="fout">Een <b>nummer</b></p>
              <p id="length" class="fout">Minimum <b>8 karakters</b></p>
            </div>
            <?php
                 switch($foutreg){
                     case 1: ?>
                          <p class="fout"> Je hebt een email en gebruikersnaam ingegeven die al bestaan </p>
                         <?php break;
                     case 2: ?>
                         <p class="fout"> Je hebt een gebruikersnaam ingegeven die al bestaat</p>
                         <?php break;
                     case 3: ?>
                         <p class="fout"> Je hebt een email ingegeven die al bestaat</p>
                        <?php  break;
                 }
                 ?>
          <div id="success"></div>
          <!-- For success/fail messages -->
          <button type="submit" name="versturen" class="btn btn-primary" id="sendMessageButton">Versturen</button>
         </form>
      </div>

    </div>
    <!-- /.row -->

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

</body>

</html>