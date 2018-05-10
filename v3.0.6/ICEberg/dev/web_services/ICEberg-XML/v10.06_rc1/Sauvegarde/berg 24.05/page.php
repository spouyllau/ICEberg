<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

require("config.inc.php");
require("entete.php");

require("functions/berg_page.php");

if ($_POST['action'] == "view") {
		
	//Affichage de la liste des pages du book
	berg_list_page($_POST[bookId]);
}

if ($_POST['action'] == "mod") {	
	
	//Modification d'une page
	berg_mod_page($bookId,$_POST[pageId]);
}
	
require("pieddepage.php");
?>