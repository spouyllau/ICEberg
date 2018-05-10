<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

require("config.inc.php");
require("entete.php");
require("functions/berg_book.php");

print "<center>";

if(isset($_POST['action'])){

	$action = $_POST['action'];

	//Traitement du formulaire d'ajout ou de moficiation d'un book
	if($action == "add"|| $action== "mod"){
		//On supprime les caractères ajoutés par le passage en post et on convertit en UTF8
		$_POST = replace_deep($_POST);
		
		//On construit l'entrée XML (nouvelle ou modifiée) du book
		$xml_book = "<book>
		<id>".$_POST['bookId']."</id>
		<title 	short=\"".$_POST['title_short']."\"
				name=\"".$_POST['title_name']."\" 
				collection=\"".$_POST['title_collection']."\" />
		<typeOfBook id=\"".$_POST['typeOfBook']."\" />
		<bookDate>".$_POST['bookDate']."</bookDate>
		<author name=\"".$_POST['author_name']."\" surname=\"".$_POST['author_surname']."\" />
		<editor>".$_POST['editor']."</editor>
		<placeEditor>".$_POST['placeEditor']."</placeEditor>
		<pagesNumber>".$_POST['pagesNumber']."</pagesNumber>
		<coverImage>".$_POST['coverImage']."</coverImage>
		<volNumber>".$_POST['volNumber']."</volNumber>
		<bookObservations>".$_POST['bookObservations']."</bookObservations>
		<numerisation person1=\"".$_POST['numerisation_person1']."\" person2=\"".$_POST['numerisation_person2']."\" person3=\"".$_POST['numerisation_person3']."\" person4=\"".$_POST['numerisation_person4']."\" />
		<format doc=\"".$_POST['format_doc']."\" pdf=\"".$_POST['format_pdf']."\" />
		<bookOrder>".$_POST['bookOrder']."</bookOrder>
	</book>";
	}
	
	if($action == "add") {	//Mode ajout d'un book
	
		berg_edit_book($xml_book, $icorpuspic_tab.$ficBook, $action,$_POST['typeOfBook'], $_POST['bookId']);
				
		print "<br/>Book n°".$_POST['bookId']." added";
	}
	
	if($action == "mod") {	//Mode modification d'un book
		
		berg_edit_book($_POST, $icorpuspic_tab.$ficBook, $action, NULL, NULL);
		
		print "<br/>Book n°".$_POST['bookId']." modified";		
	}
	
	if($action == "del"){	//Mode suppression d'un book

		berg_edit_book($_POST, $icorpuspic_tab.$ficBook, $action, NULL, NULL);
	
		print "<br/>Book n°".$_POST['bookId']." deleted";
	
	}

}

print "<br /><br />	<form action=\"book.php\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">	
	<input type=\"hidden\" name=\"action\" value=\"view\" />	
	<input type=\"hidden\" name=\"typebook\" value=\"".$_POST['typeOfBook']."\" />	
	<input type=\"submit\" value=\"back\" />	
	</form>
	</center>";
		
require("pieddepage.php");
?>