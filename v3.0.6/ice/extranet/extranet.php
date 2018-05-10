<?php
//
// ouverture session 
session_start(); 
// effacement de la session login 
session_unregister("login");
// suppression de toutes les variables
session_unset(); 
// destruction totale des sessions
session_destroy(); 
// html 
include("../config.inc.php");
include("../entete.php");
include("../menu.php");

print "
<form method=\"post\" action=\"identite.php\">
		<input type=\"hidden\" name=\"lang\" value=\"$_GET[lang]\"></input>
		<input type=\"hidden\" name=\"bdd\" value=\"$_GET[bdd]\"></input>
		<input type=\"hidden\" name=\"table\" value=\"$_GET[table]\"></input>
		<input type=\"hidden\" name=\"typeofbookId\" value=\"$_GET[typeofbookId]\"></input>
		Identification : <input type=\"text\" name=\"l\"></input>
		Mot de passe : <input type=\"password\" name=\"m\" maxlength=\"8\"></input>
		<input type=\"submit\" value=\"Identification\" SELECTED >
</form>
";
require("../fin_de_page.php");
?>
