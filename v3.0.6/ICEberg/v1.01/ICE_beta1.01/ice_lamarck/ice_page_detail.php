<?php
include("config.inc.php");
include("functions/ice_book_queries.php");
include("functions/ice_format_view.php");
include("functions/ice_connexion.php");
include("functions/ice_page_queries.php");
print "<table border=2 width=$tablewidth>
<tr>
<td>";
	ice_connexion("$_GET[bdd]");
	$sql = "SELECT * FROM $_GET[table]_book INNER JOIN $_GET[table]_typebook ";
	$sql .= "ON $_GET[table]_book.typeofbookId = $_GET[table]_typebook.typeofbookId ";
	$sql .= "WHERE bookId = '$_GET[bookId]' LIMIT 0,1";
	$result = mysql_query($sql);
	$val = mysql_fetch_array($result);
	if ($_GET['pageChapter']) {
	$chap = stripslashes($_GET['pageChapter']);
		print "<a href=\"ice_book_list.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&typeofbookId=$val[typeofbookId]&num=$_GET[num]\">$val[typeofbookDes]</a> 
		&#8226; <a href=\"ice_book_detail.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$val[bookId]&typeofbookId=$val[typeofbookId]&num=0\"><em>$val[bookShortTitle]</em></a> &#8226 $chap";
	} else {
		print "<a href=\"ice_book_list.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&typeofbookId=$val[typeofbookId]&num=$_GET[num]\">$val[typeofbookDes]</a> 
		&#8226; <a href=\"ice_book_detail.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$val[bookId]&typeofbookId=$val[typeofbookId]&num=0\">$val[bookShortTitle]</a>";	
	}
	mysql_free_result($result);
	mysql_close();
print "</td>
</tr>
</table>
<table border=2 width=$tablewidth>
<tr>
	<td>";
	if ($_GET['type']=="img") {
	ice_page_view_image ("$_GET[lang]","$_GET[bdd]","$_GET[table]","$_GET[bookId]","$_GET[pageOrder]","$_GET[typeofbookDes]","$_GET[cfzoom]");
	} 
	if ($_GET['type']=="text") {
	ice_page_view_texte ("$_GET[lang]","$_GET[bdd]","$_GET[table]","$_GET[bookId]","$_GET[pageOrder]","$_GET[typeofbookDes]");
	}
print "</td>
</tr>
</table>";
?>
