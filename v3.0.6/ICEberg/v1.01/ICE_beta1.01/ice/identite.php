<?php
session_start(); 
// ON inclut le fichier de configuration 
require ("connectid.php");
// Connection
$connexion = @mysql_connect($host,$user,$pass);
@mysql_select_db("$bdd");
// On selectionne quand le champs login correspond au login entré 
// et le champs passe au pass entré. 
$sql = "SELECT * FROM $table WHERE login='$login' AND pass='$mpass' LIMIT 0, 1"; 
// On execute la requête de selection 
$query = mysql_query($sql); 
// On compte le nombre de ligne des resultats 
// 1 : si valide 0 si aucun login ne correspond 
$exist = mysql_num_rows($query);
// Si la variable $exist = 0 --> login inexistant ou faux pass 
if(!$exist) { 
    // On affiche ce message d'erreur
	require("config.php");
	require("config.php");
	require("entete-entree.php");
	require("e-corpus-cartouche.php");
	print "
	<font class=\"texte\">
	<font color=\"#FF0000\"><strong>Acc&egrave;s refus&eacute;, veuillez recommencer l'identification</strong></font>
	</font>
	<br>
	<br>
	";
	require("pieddepage.php");
    // On inclut le formulaire d'identification  
} 
// Sinon, si le login et pass sont valides 
else {
// On ouvre la session 

// On enregistre la variable login qu'on fera passer sur ttes les pages 
// ATTENTION : Notez bien l'absence de $ devant login 
session_register("login");
session_register("pass"); 
// définissons d'abord les variables
$date = date("j-m-y");
$adresseclient = $REMOTE_ADDR;
$nomdefaut = ($adresseclient+$date);
$sess_nom = $nomdefaut; 
$id = session_id();
$idnam = session_name(); 
$sess_id = ($id*$date); 
// Affichons si on veut le nom est l'id de la session 
require("config.php");
require("entete-entree.php");
require("e-corpus-cartouche.php");
print "
<head>
<meta http-equiv=\"REFRESH\" content=\"5; url=index.php?lang=$lang\"> 
</head>
<body bgcolor=\"$bgcolorentree\">
<font class=\"texte\">Authentification en cours, patientez quelques secondes...<br>
Numéro d'identification de la session : <b>$id</b><br>
Date de début de la session : <strong>$date</strong><br>
Adresse URL : <strong>$adresseclient</strong>
</font>
<br>
<br>
";
require("pieddepage.php");
} 
mysql_free_result($query);
mysql_close($connexion);
?> 
