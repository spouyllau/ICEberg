<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

require("config.inc.php");
require("entete.php");
require("functions/berg_book.php");

function replace_deep($value)
{
	$value = is_array($value) ?
				array_map('replace_deep', $value) :
				str_replace("\'", "'", str_replace('"', "'", $value));

	return $value;
}

if(isset($_POST['action'])){

	$action = $_POST['action'];

	if($action == "add") {
		print "Ajout du book n°".$_POST['bookId'];
	}
	
	if($action == "mod") {
		print "Modification du book n°".$_POST['bookId'];		
	}

	$_POST = replace_deep($_POST);
	
	$xml_book = "
	<book>
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
	</book>\n";
	
	print "<pre>";
	print($xml_book);
	print "</pre>";	

}
		
require("pieddepage.php");
?>