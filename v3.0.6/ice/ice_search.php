<?php
include("config.inc.php");
include("entete.php");
include("menu.php");
//
include("functions/ice_search_queries.php");
include("functions/ice_format_view.php");
include("functions/ice_connexion.php");
include("functions/ice_page_queries.php");
print "$tablestyle
<tr>
	<td class=\"tdc\">";	
	ice_words_search ("$_GET[lang]","$_GET[bdd]","$_GET[table]","$_GET[bool]","$_GET[q1]","$_GET[q2]");
print "</td>
</tr>
</table>";
//
include("fin_de_page.php");
?>
