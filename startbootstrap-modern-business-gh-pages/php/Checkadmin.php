<?php
//bekijkt of welk soort gebruiker zich juist heeft aangelogd. Zodat de gepaste opties voor die gebruiker dan ter beschikking word gestelt. Bv. Als er een admin inlogt moet dit ervoor zorgen dat hij dus ook admin privileges krijgt bij het inloggen van de website
if(isset($_SESSION["gebruikernaam"]) && isset($_SESSION["soortklant"]) ){
					if($_SESSION["soortklant"]){
						$_SESSION["adminkey"] = true;
					}
					else{
						$_SESSION["adminkey"] = false;
					}
}
// Behoort tot de pagina index.php.
?>
