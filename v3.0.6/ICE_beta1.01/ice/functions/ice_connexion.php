<?php
function ice_connexion ($bdd) {
$host = "localhost";
$user = "crhst";
$pass = "ytepobuza";
// connection avec MySQL 
$ice_connexion = mysql_connect($host,$user,$pass) 
	or die("Ooops > DB connexion false, please contact hotline"); 
@mysql_select_db("$_GET[bdd]")
	or die("Ooops > DB selection false, please contact hotline");
}
?>