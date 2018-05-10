<?php
session_start(); 
// ON inclut le fichier de configuration 
require("../functions/ice_connexion.php");
// Connection
ice_connexion($_GET['bdd']);
// On selectionne quand le champs login correspond au login entré 
// et le champs passe au pass entré. 
$sql = "SELECT * FROM $_POST['table']_session WHERE login='$_POST[l]' AND pass='$_POST[p]' LIMIT 0, 1"; 
$query = mysql_query($sql); 
$exist = mysql_num_rows($query);
if(!$exist) { 
	include("../config.inc.php");
	include("../entete.php");
	include("../menu.php");
	print "$_POST['table']_session
	<strong>Acc&egrave;s refus&eacute;, veuillez recommencer l'identification</strong></font>
	";
	require("../fin_de_page.php");
} 
else {
// On enregistre la variable login qu'on fera passer sur ttes les pages 
// ATTENTION : Notez bien l'absence de $ devant login 
session_register("login");
session_register("pass"); 
// définissons d'abord les variables
$date = date("Y");
$adresseclient = $_SERVER[REMOTE_ADDR];
$nomdefaut = ($adresseclient+$date);
$sess_nom = $nomdefaut; 
$id = session_id();
$idnam = session_name(); 
$sess_id = ($id*$date); 
	// Affichons si on veut le nom est l'id de la session 
	include("../config.inc.php");
	include("../entete.php");
	include("../menu.php");
	print "
	Numéro d'identification de la session : <b>$id</b><br>
	Date de début de la session : <strong>$date</strong><br>
	Adresse URL : <strong>$adresseclient</strong>
	";
	require("../fin_de_page.php");
} 
mysql_free_result($query);
mysql_close($connexion);
?> 
