<?php
function ice_book_mod ($lang,$bdd,$table,$bookId) {
ice_connexion("$_GET[bdd]");
$sql = "SELECT * FROM ".$table."_book WHERE bookId = '$_GET[bookId]'";
$result = mysql_query($sql);
$valbook = mysql_fetch_array($result);

// creation du formulaire de modification
$sql_fields = "SHOW FIELDS FROM ".$table."_book";
$result_fields = mysql_query($sql_fields);
	while ($valfields = mysql_fetch_array($result_fields)) {
	$field_name = htmlspecialchars($valfields['Field']);
	$field_name_label = strtoupper($field_name);
	print "
	<tr>
		<td valign=\"top\" align=\"right\">$field_name_label : </td>
		<td><textarea name=\"$field_name\" rows=\"7\" cols=\"50\">$valbook[$field_name]</textarea></td>
	</tr>
	";
	} 
}
function ice_page_mod ($lang,$bdd,$table,$bookId,$pageId) {
ice_connexion("$_GET[bdd]");
$sql = "SELECT * FROM ".$table."_page WHERE bookId = '$_GET[bookId]' AND pageId = '$_GET[pageId]'";
$result = mysql_query($sql);
$valpage = mysql_fetch_array($result);

// creation du formulaire de modification
$sql_fields = "SHOW FIELDS FROM ".$table."_page";
$result_fields = mysql_query($sql_fields);
	while ($valfields = mysql_fetch_array($result_fields)) {
	$field_name = htmlspecialchars($valfields['Field']);
	$field_name_label = strtoupper($field_name);
	print "
	<tr>
		<td valign=\"top\" align=\"right\">$field_name_label : </td>
		<td><textarea name=\"$field_name\" rows=\"7\" cols=\"50\">$valpage[$field_name]</textarea></td>
	</tr>
	";
	} 
}
?>