<?php
include("config.inc.php");
include("functions/ice_book_queries.php");
include("functions/ice_connexion.php");
include("functions/ice_format_view.php");
print "<table border=1 width=$tablewidth>
<tr>";
ice_typeofbook("$_GET[lang]","$_GET[type]","$_GET[bdd]","$_GET[table]");
print "<tr>
</table>
<table border=1 width=$tablewidth>
<tr>
	<td>";
ice_list_book("$_GET[lang]","$_GET[type]","$_GET[bdd]","$_GET[table]","$_GET[typeofbookId]","$_GET[num]"); 
print "</td>
</tr>
</table>";
?>