<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

require("config.inc.php");
require("entete.php");
berg_typebook($icorpuspic_tab.$ficTypesBook);
<input type=\"hidden\" value=\"view\" name=\"action\" />
<input type=\"submit\" value=\"view the books\" />
</form>";
require("pieddepage.php");
?>