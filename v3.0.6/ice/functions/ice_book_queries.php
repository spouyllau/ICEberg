<?php
function ice_typeofbook ($lang,$type,$bdd,$table) {
ice_connexion("$bdd");
$sql = "SELECT * FROM ".$table."_typebook";
$result = mysql_query($sql);
	while ($val = mysql_fetch_array($result)) {
		if ($lang == "fr") {
			print "<a href=\"$_SERVER[PHP_SELF]?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&typeofbookId=$val[typeofbookId]&num=0\">[$val[typeofbookDes]]</a>&nbsp;";
		}
		if ($lang == "en") {
			print "<a href=\"$_SERVER[PHP_SELF]?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&typeofbookId=$val[typeofbookId]&num=0\">[$val[typeofbookDesGb]]</a>&nbsp;";
		}
	}
mysql_free_result($result);
mysql_close();
}
function ice_list_book ($lang,$type,$bdd,$table,$typeofbookId,$num) {
ice_connexion("$bdd"); 
$sql = "SELECT * FROM ".$table."_book LEFT JOIN ".$table."_typebook ON ";
$sql .= "".$table."_book.typeofbookId=".$table."_typebook.typeofbookId WHERE ".$table."_book.typeofbookId = '$_GET[typeofbookId]' ORDER BY bookDate";
$result = mysql_query($sql);
// découpage par bloc de 10
$Nmax = 10; // nombre de page par defaut
$Ncur = 0; // n° de la fiche courante
// 1ère fiche transmise par l'URL
$Ndeb = 0;
if(isset($_GET['num'])) {
	$Ndeb=intval($_GET['num']);
}
$num = mysql_num_rows($result);
// affichage
	while (($val = mysql_fetch_array($result)) && ($Ncur<$Nmax+$Ndeb)) {
	  if($Ncur>=$Ndeb) {
		print "
		&#8226; $val[bookDate], <a href=\"ice_book_detail.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$val[bookId]&typeofbookId=$val[typeofbookId]&num=$_GET[num]\" id=\"$val[bookId]\"><b>$val[bookShortTitle]</b></a><br />
		";
	  } $Ncur++;
	}
	nextprevi("$lang","$num","$Ndeb","$Nmax","$Ncur","$val");

mysql_free_result($result);
mysql_close();
}
//
function ice_detail_book ($lang,$bdd,$table,$bookId) {
ice_connexion("$_GET[bdd]");
$sql = "SELECT * FROM ".$table."_book LEFT JOIN ".$table."_typebook ON ";
$sql .= "".$table."_book.typeofbookId=".$table."_typebook.typeofbookId WHERE bookId = '$bookId'";
$result = mysql_query($sql);
$valbook = mysql_fetch_array($result);
if ($lang == "fr") {
	print "
	<table width=\"100%\">
	<tr>
	<td class=\"tdc\" width=\"20%\">Titre</td>
	<td class=\"tdi\">$valbook[bookTitle]</td>
	</tr>
	<tr> 
	<td class=\"tdc\" width=\"20%\">Auteur</td>
	<td class=\"tdi\">$valbook[bookAuthorName] $valbook[bookAuthorSurname]</td>
	</tr>";
	if ($valbook['bookPagesNumber']) { 
		print "<tr>
		<td class=\"tdc\" width=\"20%\">Format</td>
		<td class=\"tdi\">$valbook[bookPagesNumber]</td>
	</tr>"; 
	}
	print "<tr>
	<td class=\"tdc\" width=\"20%\">Editeur</td>
	<td class=\"tdi\">$valbook[bookEditor] $valbook[bookPlaceEditor]</td>
	</tr>
	<tr> 
	<td class=\"tdc\" width=\"20%\">Date</td>
	<td class=\"tdi\">$valbook[bookDate]</td>
	</tr>
	<tr>
	<td class=\"tdc\" width=\"20%\">Observations</td>
	<td class=\"tdi\">$valbook[bookObservations]</td>
	</tr>
	";
	if (($valbook['bookDoc']) OR ($valbook['bookPdf'])) {
	print "
	<tr>
	<td class=\"tdc\" width=\"20%\">Document en texte intégral téléchargeable</td>
	<td class=\"tdi\">";
	}
	if (($valbook['bookDoc']) AND ($valbook['bookUrl'])){
		print "<a href=\"$valbook[bookUrl]$valbook[bookDoc]\" lang=\"fr\">
		<img src=\"ico/word.gif\" border=\"0\" alt=\"icone de téléchargement doc/rtf\">$valbook[bookDoc]</img></a><br />";
	} 
	if (($valbook['bookPdf']) AND ($valbook['bookUrl'])){
		print "<a href=\"$valbook[bookUrl]$valbook[bookPdf]\" lang=\"fr\">
		<img src=\"ico/pdf.gif\" border=\"0\" alt=\"icone de téléchargement pdf\">$valbook[bookPdf]</img></a><br />";
	}
	print "
	</td>
	</tr>
	</table>";
}
if ($lang == "en") {
	print "
	<table width=\"100%\">
	<tr>
	<td class=\"tdc\" width=\"20%\">Title</td>
	<td class=\"tdi\">$valbook[bookTitle]</td>
	</tr>
	<tr> 
	<td class=\"tdc\" width=\"20%\">Author</td>
	<td class=\"tdi\">$valbook[bookAuthorName] $valbook[bookAuthorSurname]</td>
	</tr>";
	if ($valbook['bookPagesNumber']) { 
		print "<tr>
		<td class=\"tdc\" width=\"20%\">Page(s)</td>
		<td class=\"tdi\">$valbook[bookPagesNumber]</td>
	</tr>"; 
	}
	print "
	<tr>
	<td class=\"tdc\" width=\"20%\">Editor</td>
	<td class=\"tdi\">$valbook[bookEditor] $valbook[bookPlaceEditor]</td>
	</tr>
	<tr> 
	<td class=\"tdc\" width=\"20%\">Date</td>
	<td class=\"tdi\">$valbook[bookDate]</td>
	</tr>
	<tr>
	<td class=\"tdc\" width=\"20%\">Observations</td>
	<td class=\"tdi\">$valbook[bookObservations]</td>
	</tr>
	<tr>
	<td class=\"tdc\" width=\"20%\">Digitalized document</td>
	<td class=\"tdi\">
	"; 
	if ($valbook['bookDoc']){
		print "<a href=\"$valbook[bookUrl]$valbook[bookDoc]\" lang=\"fr\">
		<img src=\"ico/word.gif\" border=\"0\" alt=\"icone de téléchargement doc/rtf\">$valbook[bookDoc]</img></a><br />";
	} 
	if ($valbook['bookPdf']){
		print "<a href=\"$valbook[bookUrl]$valbook[bookPdf]\" lang=\"fr\">
		<img src=\"ico/pdf.gif\" border=\"0\" alt=\"icone de téléchargement pdf\">$valbook[bookPdf]</img></a><br />";
	}
	print "
	</td>
	</tr>
	</table>";
}
mysql_free_result($result);
mysql_close();
}
//
function ice_detail_book_mat ($lang,$bdd,$table,$bookId,$typeofbookDes) {
ice_connexion("$bdd");
$sql = "SELECT pageChapter, pageNumber, pageOrder, ".$table."_book.bookId FROM ".$table."_book INNER JOIN ".$table."_page ON ";
$sql .= "".$table."_book.bookId=".$table."_page.bookId ";
$sql .= "WHERE (".$table."_book.bookId='$bookId' AND ".$table."_page.pageChapter > '0') ";
$sql .= "OR (".$table."_book.bookId='$bookId' AND ".$table."_page.pageTitle > '0') ";
$sql .= "ORDER BY ".$table."_page.pageOrder ASC";
$result = mysql_query($sql);
	while ($valpage = mysql_fetch_array($result)) {
			if ($valpage['pageChapter']) {
				print "
				<tr>
					<td class=\"tdi\"><a href=\"ice_page_detail.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&typeofbookDes=$typeofbookDes&bookId=$valpage[bookId]&pageChapter=$valpage[pageChapter]&pageOrder=$valpage[pageOrder]&facsimile=off&search=no&num=$_GET[num]&nav=1\">$valpage[pageChapter]</a></td>
					<td class=\"tdi\">$valpage[pageNumber]</td>
				</tr>";
			}
	}
}
function ice_detail_book_gal ($lang,$bdd,$table,$bookId,$typeofbookDes) {
	ice_connexion("$bdd");
	$sql = "SELECT * FROM ".$table."_typebook, ".$table."_book ";
	$sql .= "LEFT JOIN ".$table."_page ON ".$table."_book.bookId=".$table."_page.bookId ";
	$sql .= "WHERE (".$table."_book.bookId='$bookId' AND ".$table."_typebook.typeofbookDes='$typeofbookDes') ";
	$sql .= "ORDER BY ".$table."_page.pageOrder ASC";
	$result = mysql_query($sql);
	// découpage par bloc de 10
	$Nmax = 10; // nombre par page par defaut
	$Ncur = 0; // n° de la fiche courante
	// 1ère fiche transmise par l'URL
	$Ndeb = 0; 
	if(isset($_GET['nump'])) {
	   $Ndeb=intval($_GET['nump']);
	}
	// comptage des résultats
	$nump = mysql_num_rows($result);
	// affichage de la mosaïque
		if ($result >= 0) {
				while (($val = mysql_fetch_array($result)) && ($Ncur<$Nmax+$Ndeb)) {
					  if($Ncur>=$Ndeb) {
							//if ($valpage['pageImage']) {
								print "		
								<a href=\"ice_page_detail.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$bookId&pageOrder=$val[pageOrder]&typeofbookDes=$val[typeofbookDes]&nump=$_GET[nump]&nav=1&cfzoom=2&facsimile=off\">
								<img src=\"../i-corpuspic/tab/$val[typeofbookDes]/$val[bookTitleCollection]/vig/$val[pageImage]\" border=\"0\" alt=\"&copy; 2004 CNRS/CRHST - ID:$val[pageNumber]\" align=\"absmiddle\"></a>
								";
							//}
					  } $Ncur++;
				}
				print "<br />";	
				nextprevi_gal("$lang","$nump","$Ndeb","$Nmax","$Ncur","$val");
		}
}
?>