<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////
//Configuration XML$ficTypesBook = "TypeOfBook.xml";$ficBook = "Book.xml";$icorpuspic_tab = "../i-corpuspic/tab/";$repxml = "xml/";$title = "ICEberg XML v1.0";
$tablecolor = "#ffffff";
$tablewidth = "850";
$tablestyle = "<table bgcolor=\"$tablecolor\" width=\"$tablewidth\">";$doctype_page = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n
<!DOCTYPE PAGE SYSTEM \"../../../../../ice/dtd/TypeOfBook.dtd\">\n";/* Liste des types of Book(l'id correspond à l'indice+1 des tableaux) */	
$types = simplexml_load_file($icorpuspic_tab.$ficTypesBook);

foreach ($types->typeOfBook as $unType)
	$tabTypes[]=utf8_decode($unType->typeDes);
?>
