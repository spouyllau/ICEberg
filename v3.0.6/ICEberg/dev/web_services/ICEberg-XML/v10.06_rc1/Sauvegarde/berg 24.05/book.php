<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

require("config.inc.php");require("functions/berg_book.php");
require("entete.php");if(isset($_POST['supp'])){	//Suppression définitive du book		echo "SUPPRESSION du book n°".$_POST['bookId'];}
if ($_POST['action'] == "view") {		print "	<form action=\"book.php\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">
	<input type=\"hidden\" name=\"action\" value=\"add\" />
	<input type=\"hidden\" name=\"typebook\" value=\"".$_POST['typebook']."\" />
	<input type=\"submit\" value=\"add a new book\" />
	</form>
	";	//Affichage de la liste des books
	berg_list_book($icorpuspic_tab.$ficBook, $_POST['typebook']);
}
if ($_POST['action'] == "add") {		//En mode ajout, on n'envoie pas le bookId
	berg_list_fields_book("add", NULL , $_POST['typebook']);
}
if ($_POST['action'] == "edit") {	//Si l'utilisateur a cliqué sur delete	if($_POST['submit'] == "delete"){		berg_book_del($_POST['bookId'],$_POST['typebook']);	}		else{ //Modification du book
		berg_list_fields_book("mod", $_POST['bookId'], $_POST['typebook']);	}
}require("pieddepage.php");
?>