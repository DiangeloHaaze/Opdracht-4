<?php
if(isset($_POST["versturen"])){
	$oudpaswoord = trim($_POST["oudpaswoord"]);
	$nieuwpaswoord = trim($_POST["nieuwpaswoord"]);
	$bnieuwpaswoord = trim($_POST["bnieuwpaswoord"]);

	if(empty($oudpaswoord)){
		$fout = false;
		echo '<div class="alert alert-danger" role="alert">Het veld voor het oude paswoord is niet ingevult. </div>';
	}
	if(empty($nieuwpaswoord)){
		$fout = false;
		echo '<div class="alert alert-danger" role="alert">Het veld voor het nieuwe paswoord is niet ingevult. </div>';
	}
	else{
			if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $nieuwpaswoord)) {
			    $gekeurt = false;
				echo '<div class="alert alert-danger" role="alert">Het nieuwe paswoord komt niet overeen aan de gevraagde eisen. </div>';
			}
		}

	if(empty($bnieuwpaswoord)){
		$fout = false;
		echo '<div class="alert alert-danger" role="alert">Het veld voor het bevestig paswoord is niet ingevult. </div>';
	}
	else{
		if($nieuwpaswoord != $bnieuwpaswoord){
			$fout = false;
			echo '<div class="alert alert-danger" role="alert">Het paswoord en het bevestigd paswoord komen niet overeen met elkaar. </div>';
		}
	}

	$mysqli = mysqli_connect('localhost', 'root', '', 'athenagames');
	      if(mysqli_connect_errno()) {trigger_error('Fout bij verbinding: '.$mysqli->error); }
	           else {
				   $oudpaswoord_s = mysqli_real_escape_string($mysqli,$_POST["oudpaswoord"]);
				   $username_s = mysqli_real_escape_string($mysqli,$_SESSION["gebruikernaam"]);
				   $nieuwpaswoord_s = mysqli_real_escape_string($mysqli,$_POST["nieuwpaswoord"]);
				   $nieuwpaswoord_s = password_hash($nieuwpaswoord_s, PASSWORD_BCRYPT);



			       $sql_p = "SELECT paswoord FROM tblklanten WHERE gebruikersnaam = '$username_s'";

				   $sql_i = "UPDATE tblklanten SET paswoord = '$nieuwpaswoord_s' WHERE gebruikersnaam = '$username_s'";

			   	   $res_p = mysqli_query($mysqli, $sql_p);
			   	   if ($res_p->num_rows == 1) {
			   	   while($row = $res_p->fetch_assoc()){
			   	   $hash = $row["paswoord"];}}

				   if(password_verify($oudpaswoord_s, $hash)){
					   if($stmt = $mysqli->prepare($sql_i))
				  {

				  if(!$stmt->execute()){
				  $fout = false;

			  	  }
				  else {
					  $geslaagd = true;
					  echo '<div class="alert alert-success" role="alert">Het wachtwoord is correct geupdate.</div>';
				  }
				  $stmt->close();

				  }
			   }
			   else
			   {
				   $fout = false;
					   echo '<div class="alert alert-danger" role="alert">Het ingegeven paswoord komt niet overeen met het bestaand paswoord. </div>';

			   }
}}
 ?>
