<?php
// Menu
print "
<form action=\"ice_search.php\" method=\"post\" enctype=\"multipart/form-data\">
$tablestyle
<tr>
	<td align=\"left\" class=\"tdf\">
	";
	if ($lang=="fr") {
		print "<a href=\"index.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]\">Accueil</a> &#8226; ";
	}
	if ($lang=="en") {
		print "<a href=\"index.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]\">Home</a> &#8226; ";
	}
	if ($lang=="fr") {
		print "<a href=\"extranet.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]\">Extranet</a>";
	}
	if ($lang=="en") {
		print "<a href=\"extranet.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]\">Extranet</a>";
	}
	print "
	</td>
	<td class=\"tdf\" align=\"right\">";
	if ($lang=="fr") {
		print "Rechercher un mot 
		<input type=\"text\" name=\"query\" size=\"10\" maxlength=\"10\" />
		<input type=\"submit\" value=\"Lancer\" />
		";
	}
	if ($lang=="en") {
		print "word search
		<input type=\"text\" name=\"query\" size=\"10\" maxlength=\"10\" />
		<input type=\"submit\" value=\"Ok\" />
		";
	}
	print "
	</td>
</tr>
</table>
</form>
";
?>
