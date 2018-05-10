<?php
include("functions/ice_mod_function.php");
include("../functions/ice_connexion.php");
print "
<form action=\"ice_page_mod_action.php\" method=\"post\" enctype=\"application/x-www-form-urlencoded\">
<table>";
ice_page_mod("$_GET[lang]","$_GET[bdd]","$_GET[table]","$_GET[bookId]","$_GET[pageId]");
print "
</table>
</form>";
?>