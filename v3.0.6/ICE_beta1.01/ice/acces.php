<?php
require("config.php"); // fichier de config
// On commence par ouvrir la session 
session_start(); 
// On désenregistre la session login 
session_unregister("login"); 
// On supprime ttes les variables de la session 
session_unset(); 
// On détruit totalement la session 
session_destroy(); 
// On réaffiche le formulaire d'identification
require("config.php");
require("entete-entree.php");
require("e-corpus-cartouche.php");
echo "
<br>
	<div align=\"center\">
	
	<table width=\"300\" cellspacing=\"1\" border=\"0\">
		<form method=\"post\" action=\"identite.php\">
		<input type=\"hidden\" name=\"lang\" value=\"fr\">
		<tr>
			<td>
				<img src=\"images/id.png\" alt=\"\" border=\"0\"> 
			</td>
		</tr>
		<tr>
		<td>
			<center>Identification : <input type=\"text\" name=\"login\"></center></td>
		</tr>
		<tr>
		<td>
			<center>Mot de passe : <input type=\"password\" name=\"mpass\" maxlength=\"8\"></center></td>
		</tr> 
		<tr>
		<td align=\"right\">
			<input type=\"submit\" value=\"Identification\" SELECTED class=\"bouton\">
		</td>
		</tr>
		</form>
	</table>
	
	</div>
";
require("pieddepage.php");
?>