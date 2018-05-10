<?php

include("functions/ice_search_queries.php");
include("functions/ice_format_view.php");
include("functions/ice_page_queries.php");
include("functions/ice_book_queries.php");

include("config.php");
include("entete.php");
include("menu.php");

print "$tablestyle
<tr>
	<td class=\"tdi\">";	
	if (strlen(stripslashes($_GET['query']))<3)
		die ("Nombre de caractères insuffisant pour lancer la recherche (minimum 3)");	
	ice_words_search ($lang,$_GET['query'],$rep,$rauteur,$tab);
print "</td>
</tr>
</table>";

include("fin_de_page.php");
?>
