<?php
// Menu

print "
<form action=\"ice_search.php\" method=\"GET\" enctype=\"multipart/form-data\">
<table cellpadding='5' border='0' width='860' class='tdf'>
<tr>
	<td align=\"left\">
	";
	if ($lang=="fr") {
		print "<a href='index.php'>Accueil</a> &#8226;
	</td> ";
	}
	if ($lang=="en") {
		print "<a href='index.php'>Home</a> &#8226;
	</td>
  ";
	}

	print "
	<td align=\"right\">";
	if ($lang=="fr") {
		print "Rechercher un mot 
		<input type=\"text\" name=\"query\" size=\"20\" maxlength=\"30\" />
		<input type='hidden' name='num' value='0'>
		<input type=\"submit\" value=\"Lancer\" />
		";
	}
	if ($lang=="en") {
		print "Word search
		<input type=\"text\" name=\"query\" size=\"20\" maxlength=\"30\" />
		<input type='hidden' name='num' value='0'>
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
