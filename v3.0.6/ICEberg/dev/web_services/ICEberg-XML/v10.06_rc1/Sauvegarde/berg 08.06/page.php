<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

require("config.inc.php");
require("entete.php");

require("functions/berg_page.php");

if (isset($_GET['page']))
	$page = $_GET['page'];
else
	$page = 0;

if ($_REQUEST['action'] == "view") {

	//Affichage de la liste des pages du book
	berg_list_page($_REQUEST['bookId'],$_REQUEST['typebook'],$page);
}

if ($_REQUEST['action'] == "modify") {	
	
	//Modification d'une page
	berg_form_page("mod",$_POST['bookId'],$_POST['typebook'],$_POST['pageId']);
	
}

if ($_REQUEST['action'] == "add") {

	// Ajout d'une page
	berg_form_page("add",$_POST['bookId'],$_POST['typebook'],$_POST['pageId']);
}

if ($_REQUEST['action'] == "delete") {

	// Suppression d'une page
	berg_del_page($_POST['bookId'],$_POST['typebook'],$_POST['pageOrder']);
}

if (isset($_POST['confirm'])) {

	if ($_POST['choix']=="no") {
		print "Suppression of the page ".$_POST['pageOrder']." cancelled";
		berg_list_page($_POST['bookId'],$_POST['typebook'],$_POST['pageOrder']);
	}
	else {
		$typebook = $_POST['typebook'];
		print "The page ".$_POST['pageOrder']." was removed";
		unlink($icorpuspic_tab.$tabTypes[$typebook-1]."/".$_POST['bookId']."/$repxml".$_POST['pageOrder'].".xml");
		berg_list_page($_POST['bookId'],$typebook,0);
	}
	
}
	
require("pieddepage.php");

?>