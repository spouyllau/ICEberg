<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

require("config.inc.php");
require("entete.php");
require("functions/ice_db_command.php");
require("functions/ice_book.php");

	ice_connexion("$host","$user","$pass","$bdd");
	$sql = "SHOW FIELDS FROM ".$table."_book";
	$result = mysql_query($sql);
	while($val = mysql_fetch_array($result)) {
		$field_name = htmlspecialchars($val['Field']);
		$field[] = $val['Field'];
	}
	$field = $field;
reset($field);
$data = "";
$addfield = "";
for ($i = 0; $i < count($field); $i++) {
	$index = key($field);
			if (next($field)) {
				// fields list
				$addfield .= "`$field[$index]`, ";
				// data
				$data .= "'";
				$data .= urldecode(addslashes($$field[$index]));
				$data .= "', ";
			} 
			else {
				// fields list
				$addfield .= "`$field[$index]`";
				// data
				$data .= "'";
				$data .= urldecode(addslashes($$field[$index]));
				$data .= "'";
			}
}
// sql
	$add = "INSERT INTO ".$table."_book ($addfield) VALUES ($data) LIMIT 1";
	print "SQL : <div class=\"sql\">$add</div><p>ajout du book => ok</p>";
		$action = mysql_query($add) or die("erreur d'ajout");
	mysql_free_result($result);
	mysql_close();		
require("pieddepage.php");
?>