<?php
include("config.inc.php");
include("entete.php");
include("menu.php");
//
include("config.inc.php");
include("functions/ice_book_queries.php");
include("functions/ice_connexion.php");
include("functions/ice_format_view.php");
print "
$tablestyle
<tr>
	<td class=\"tdf\">";
ice_typeofbook("$_GET[lang]","$_GET[type]","$_GET[bdd]","$_GET[table]");
print "
	</td>
<tr>
</table>
$tablestyle
<tr>
	<td class=\"tdc\">";
ice_list_book("$_GET[lang]","$_GET[type]","$_GET[bdd]","$_GET[table]","$_GET[typeofbookId]","$_GET[num]"); 
print "</td>
</tr>
</table>
";
//
include("fin_de_page.php");
?>