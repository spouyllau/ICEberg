<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

require("config.inc.php");
require("entete.php");
if($_POST['action'] == "view") {
	<input type=\"hidden\" name=\"action\" value=\"add\" />
	<input type=\"hidden\" name=\"typebook\" value=\"".$_POST['typebook']."\" />
	<input type=\"submit\" value=\"add a new book\" />
	</form>
	";
	berg_list_book($icorpuspic_tab.$ficBook, $_POST['typebook']);
}
if($_POST['action'] == "add") {
	berg_list_fields_book("add", NULL , $_POST['typebook']);
}
if($_POST['action'] == "edit") {
		berg_list_fields_book("mod", $_POST['bookId'], $_POST['typebook']);
}
?>