<?php
include("config.inc.php");
include("functions/ice_book_queries.php");
include("functions/ice_connexion.php");
include("functions/ice_format_view.php");
print "<table border=1 width=$tablewidth>
<tr>
	<td>";
	ice_connexion("$_GET[bdd]");
	$sql = "SELECT * FROM $_GET[table]_book INNER JOIN $_GET[table]_typebook ";
	$sql .= "ON $_GET[table]_book.typeofbookId = $_GET[table]_typebook.typeofbookId ";
	$sql .= "WHERE bookId = '$_GET[bookId]' LIMIT 0,1";
	$result = mysql_query($sql);
	$val = mysql_fetch_array($result);
	print "<a href=\"ice_book_list.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&typeofbookId=$val[typeofbookId]&num=$_GET[num]\">$val[typeofbookDes]</a> &#8226; <em>$val[bookShortTitle]</em>";
	$typeofbookDes = $val['typeofbookDes'];
	mysql_free_result($result);
	mysql_close();
	print "</td>
<tr>
</table>
<table border=1 width=$tablewidth>
<tr>
	<td>";
ice_detail_book("$_GET[lang]","$_GET[bdd]","$_GET[table]","$_GET[bookId]");
print "</td>
</tr>
</table>";
if ($_GET['type']=="img") {
print"<table border=2 width=$tablewidth>
<tr>
	<td>";
ice_detail_book_gal("$_GET[lang]","$_GET[bdd]","$_GET[table]","$_GET[bookId]","$typeofbookDes");
print "</td>
</tr>
</table>";
} 
if ($_GET['type']=="text") {
print"<table border=1 width=$tablewidth>";
ice_detail_book_mat("$_GET[lang]","$_GET[bdd]","$_GET[table]","$_GET[bookId]","$typeofbookDes");
print "</table>";
}
?>