<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

require("config.inc.php");require("functions/berg_book.php");
require("entete.php");print "<form action=\"book.php\" method=\"post\" enctype=\"application/x-www-form-urlencoded\" name=\"typebook\" target=\"leftFrame\">\n";
berg_typebook($icorpuspic_tab.$ficTypesBook);print "
<input type=\"hidden\" value=\"view\" name=\"action\" />
<input type=\"submit\" value=\"view the books\" />
</form>";
require("pieddepage.php");
?>