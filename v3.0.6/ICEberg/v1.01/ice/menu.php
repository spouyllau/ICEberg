<?php
// Menu
print "
<form action=\"$url/ice_search.php\" method=\"get\">
<input type=\"hidden\" name=\"lang\" value=\"$_GET[lang]\" />
<input type=\"hidden\" name=\"type\" value=\"$_GET[type]\" />
<input type=\"hidden\" name=\"bdd\" value=\"$_GET[bdd]\" />
<input type=\"hidden\" name=\"table\" value=\"$_GET[table]\" />
<input type=\"hidden\" name=\"typeofbookId\" value=\"$_GET[typeofbookId]\" />
<input type=\"hidden\" name=\"num\" value=\"0\" />
$tablestyle
<tr>
	<td align=\"left\" class=\"tdf\">
	";
	if ($_GET[lang]=="fr") {
		print "<a href=\"$url/index.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]\">Accueil</a> &#8226; ";
	}
	if ($_GET[lang]=="en") {
		print "<a href=\"$url/index.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]\">Home</a> &#8226; ";
	}
	if ($_GET[lang]=="fr") {
		print "<a href=\"$url/extranet/extranet.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]\">Extranet</a>";
	}
	if ($_GET[lang]=="en") {
		print "<a href=\"$url/extranet/extranet.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]\">Extranet</a>";
	}
	print "
	</td>
	<td class=\"tdf\" align=\"right\">";
	if ($_GET[lang]=="fr") {
		print "Recherche simple par mot 
		<input type=\"text\" name=\"q1\" size=\"15\" maxlength=\"10\" />
		<input type=\"submit\" value=\"Lancer\" />
		";
	}
	if ($_GET[lang]=="en") {
		print "Quick search by word
		<input type=\"text\" name=\"q1\" size=\"15\" maxlength=\"10\" />
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
