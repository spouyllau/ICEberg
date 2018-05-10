<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////
	
	// Se positionne sur le repertoire
	$dir=opendir($repBook) or die("Cannot open the directory $repBook");

	// Lit les fichiers du repertoire et les mets dans le tableau $tabPages
	while ($f = readdir($dir)) {
		if(is_file($repBook.$f))
			$tabPages[]=$f;
	}
	closedir($dir);
	// Tri les pages dans l'ordre (num�rique)
	if ($tabPages)
		sort($tabPages,SORT_NUMERIC);
	// Renvoi le tableau des pages
	return $tabPages;
}

function berg_list_page($bookId,$typebook,$pageO) {
			<select name=\"page\">\n";
			for($i=0;$i<count($tabPages);$i++){
				print "		<option value=\"".$opt."\" title=\"View the page $opt\" ";
					if($opt == $pageO) //On positionne la liste sur la page en cours
						print "selected";
				print ">$opt</option>\n";
			}
		print "</select> ";
		print "&nbsp;<input type=\"submit\" style=\"width:40px;\" value=\"go\">";
		print "</form>";
	<input type=\"hidden\" name=\"action\" value=\"add\" />
	<input type=\"hidden\" name=\"typebook\" value=\"$typebook\" />
	<input type=\"submit\" value=\"add a page\" />
	</form>";
					<input type=\"hidden\" name=\"bookId\" value=\"$bookId\" />
					<input type=\"hidden\" name=\"pageId\" value=\"".$page->pageId ."\" />";		
					<input type=\"submit\" name=\"action\" title=\"modifier cette page\" value=\"modify\" />
}
	<table>
		<td align=\"right\" valign=\"top\" title=\"Le pageId est automatique\"><strong>pageId : </strong></td>
		<td align=\"left\" ><input type=\"text\" name=\"pageId\" size=\"5\" value=\"$pageId\" readonly /> </td> 
				<!-- text HTML tools (<i>, <b>, <center>) 
					<script language=\"JavaScript1.2\" type=\"text/javascript\">
						function format(f){
							var str = document.selection.createRange().text;
							document.form_page.pageText.focus();
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
				 text HTML tools (<i>, <b>, <center>) -->					
		</td>
		print "<input type=\"submit\" value=\"add this page\" />";
	print "</form>
	";
?>