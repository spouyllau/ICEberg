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
		$field[] = $val['Field'];
	}
	reset($field);
	$set = "";
	for ($i = 0; $i < count($field); $i++) {
		$index = key($field);
			if (next($field)) {
				// fields list
				$addfield = "$field[$index]";
				// data
				$data = urldecode($$field['$index']);
				$data = addslashes($data);
				$set .= "`$addfield`='$_POST[$addfield]', ";
			} 
			else {
				// fields list
				$addfield = "$field[$index]";
				// data
				$data = urldecode($$field[$index]);
				$data = addslashes($data);
				$set .= "`$addfield`='$_POST[$addfield]'";
			}	
	}
	// sql
	$mod = "UPDATE ".$table."_book SET $set WHERE bookId = '$_POST[bookId]' LIMIT 1;";
	print "SQL : <div class=\"sql\">$mod</div><p>modification du book => ok</p>";
		//$action = mysql_query($mod) or die("erreur de modification");
	mysql_free_result($result);
	mysql_close();		
require("pieddepage.php");
?>