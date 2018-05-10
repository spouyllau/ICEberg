<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

require("config.inc.php");
require("entete.php");
require("functions/ice_db_command.php");
require("functions/ice_page.php");

	ice_connexion("$host","$user","$pass","$bdd");
	$sql = "SHOW FIELDS FROM ".$table."_page";
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
				$data = urldecode($$field[$index]);
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
	$mod = "UPDATE ".$table."_page SET $set WHERE pageId = '$_POST[pageId]' LIMIT 1";
	print "SQL : <div class=\"sql\">$mod</div><p>modification de page => ok</p>
	<!-- <input type=\"button\" value=\"retour\" onClick=\"window.history.go(-2)\"> -->";
		$action = mysql_query($mod) or die("erreur de modification");
	mysql_free_result($result);
	mysql_close();		
require("pieddepage.php");
?>