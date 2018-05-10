<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

function berg_list_page($bookId) {	echo "list page : id =".$bookId;	/*
	$sql_list_page = "SELECT * FROM ".$table."_page INNER JOIN ".$table."_book ";
	$sql_list_page .= "ON ".$table."_page.bookId = ".$table."_book.bookId ";
	$sql_list_page .= "WHERE ".$table."_page.bookId = '$bookId' ORDER BY pageOrder ASC";
	print "<!-- $sql_list_page -->
	<table bgcolor=\"#FFFFFF\">";
	$result_list_page = mysql_query($sql_list_page);
	while($val_list_page = mysql_fetch_array($result_list_page)) {
	print "
	<tr>
		<td>";
			$sqlf = "SHOW FIELDS FROM ".$table."_page";
			$resultf = mysql_query($sqlf);
				while($valf = mysql_fetch_array($resultf)) {
				$field_name = htmlspecialchars($valf['Field']);
					if ($field_name == "pageId") {
						print "<p>$field_name : $val_list_page[$field_name]</p>";
					} else {
						print "<p>$field_name : <span style='background-color:#FFFFFF'><strong>$val_list_page[$field_name]</strong></span></p>";
					}
				}
				mysql_free_result($resultf);
	print "
		<p align=\"center\">
			<form action=\"page.php\" method=\"post\" enctype=\"application/x-www-form-urlencoded\" name=\"typebook\" target=\"mainFrame\">
					<input type=\"hidden\" name=\"bookId\" value=\"$val_list_page[bookId]\" />
					<input type=\"hidden\" name=\"pageId\" value=\"$val_list_page[pageId]\" />
					<input type=\"hidden\" name=\"action\" value=\"mod\" />
					<input type=\"submit\" title=\"modifier cette page\" value=\"modify\" />
			</form>
		</p>
		</td>
	</tr>";
	}
	mysql_free_result($result_list_page);
	mysql_close();
	print "</table>
	<br />
	";	*/
}
function berg_mod_page($bookId,$pageId) {	echo "mod page : bookid =".$bookId." et pageid=".$pageId;	/*
	$sql_mod_page = "SELECT * FROM ".$table."_page WHERE (pageId = '$pageId' AND bookId = '$bookId')";
	print "<!-- $sql_mod_page -->
	<form name=\"pagemod\" action=\"page_mod.php\" method=\"post\">
	<table>";
	$result_mod_page = mysql_query($sql_mod_page);
	$val_mod_page = mysql_fetch_array($result_mod_page);
		$sqlf = "SHOW FIELDS FROM ".$table."_page";
			$resultf = mysql_query($sqlf);
				while($valf = mysql_fetch_array($resultf)) {
				$field_name = htmlspecialchars($valf['Field']);
					if ($field_name == "pageText" ) {
					print "<tr>
							<td align=\"right\" valign=\"top\"><strong>$field_name</strong> :<br />
							<br />
								<!-- text HTML tools (<i>, <b>, <center>) -->
									<script language=\"JavaScript1.2\" type=\"text/javascript\">
									function format(f){
												var str = document.selection.createRange().text;
												document.pagemod.pageText.focus();
												var sel = document.selection.createRange();
												sel.text = \"<\" + f + \"\>\" + str + \"</\" + f + \">\";
												return 0;
									}
									</script>
									<div>
									mise en forme : <br />
									[<a href=\"#\" OnClick=\"format('b');\"><strong>Bold</strong></a>]<br />
									[<a href=\"#\" OnClick=\"format('i');\"><em>Italic</em></a>]<br />
									[<a href=\"#\" OnClick=\"format('center');\">Center</a>]<br />
									[<a href=\"#\" OnClick=\"format('li');\">List</a>]<br />
									<br />
									[<a href=\"#\" OnClick=\"format('h1');\"> H1</a>]<br />
									[<a href=\"#\" OnClick=\"format('h2');\"> H2</a>]<br />
									[<a href=\"#\" OnClick=\"format('h3');\"> H3</a>]<br />
									</div>
								<!-- text HTML tools (<i>, <b>, <center>) -->					
							</td>
							<td><textarea cols=\"60\" rows=\"12\" name=\"$field_name\">$val_mod_page[$field_name]</textarea></td>
						   </tr>";
					}
					elseif ($field_name == "pageNote" ) {
					print "<tr>
							<td align=\"right\" valign=\"top\"><strong>$field_name</strong> :</td>
							<td><textarea cols=\"60\" rows=\"6\" name=\"$field_name\">$val_mod_page[$field_name]</textarea></td>
						   </tr>";
					} else {
					print "<tr>
							<td align=\"right\" valign=\"top\"><strong>$field_name</strong> :</td>
							<td><input name=\"$field_name\" size=\"60\" value=\"$val_mod_page[$field_name]\"></td>
						   </tr>";
					}
				}
	mysql_free_result($result_mod_page);
	mysql_close();
	print "</table>
	<input type=\"hidden\" name=\"table\" value=\"$table\" />
	<input type=\"submit\" value=\"modify now this page\" />
	</form>
	";	*/

}
?>