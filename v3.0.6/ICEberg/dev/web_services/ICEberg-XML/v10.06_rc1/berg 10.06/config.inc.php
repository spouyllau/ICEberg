<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

$tablecolor = "#ffffff";
$tablewidth = "850";
$tablestyle = "<table bgcolor=\"$tablecolor\" width=\"$tablewidth\">";
<!DOCTYPE PAGE SYSTEM \"../../../../../ice/dtd/TypeOfBook.dtd\">\n";
$types = simplexml_load_file($icorpuspic_tab.$ficTypesBook);

foreach ($types->typeOfBook as $unType)
	$tabTypes[]=utf8_decode($unType->typeDes);
?>