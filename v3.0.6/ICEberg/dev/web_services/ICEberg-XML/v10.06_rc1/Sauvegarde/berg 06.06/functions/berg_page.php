<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////function berg_list_pages($repBook) {
	
	// Se positionne sur le repertoire
	$dir=opendir($repBook);

	// Lit les fichiers du repertoire et les mets dans le tableau $tabPages
	while ($f = readdir($dir)) {
		if(is_file($repBook.$f))
			$tabPages[]=$f;
	}
	closedir($dir);
	
	// Tri les pages dans l'ordre
	if ($tabPages)
		sort($tabPages); 

	// Renvoi le tableau des pages
	return $tabPages;
}

function berg_list_page($bookId,$typebook,$pageO) {	global $tabTypes;	global $icorpuspic_tab;	global $repxml;		// $page = 0 c'est la première 		$tabPages = berg_list_pages($icorpuspic_tab.$tabTypes[$typebook-1]."/$bookId/$repxml");		if ($pageO == 0) {		// Première page		$pageO = substr($tabPages[0],0,strlen($tabPages[0])-4);		$pageSuiv = substr($tabPages[1],0,strlen($tabPages[1])-4);	}	else {		$pageXML = $pageO.".xml";			for ($i=0;$i<count($tabPages);$i++) {			if($tabPages[$i] == $pageXML)				break;		}			// Page précédente		$pagePrec = substr($tabPages[$i-1],0,strlen($tabPages[$i-1])-4);				if ($i!=count($tabPages))			$pageSuiv = substr($tabPages[$i+1],0,strlen($tabPages[$i+1])-4);	}			print "<form action=\"page.php\" method=\"get\" target=\"mainFrame\">				<center>go to page : 				<input type=\"hidden\" name=\"action\" value=\"view\" />			<input type=\"hidden\" name=\"bookId\" value=\"$bookId\" />			<input type=\"hidden\" name=\"typebook\" value=\"$typebook\" />			
		<select name=\"page\">\n";
		for($i=0;$i<count($tabPages);$i++){			$opt = substr($tabPages[$i],0,strlen($tabPages[$i])-4);
			print "		<option value=\"".$opt."\" title=\"View the page $opt\" ";
				if($opt == $pageO) //On positionne la liste sur la page en cours
					print "selected";
			print ">$opt</option>\n";
		}
	print "</select> ";
	print "&nbsp;<input type=\"submit\" style=\"width:40px;\" value=\"go\">";	
	print "</form>";			$dp = simplexml_load_file($icorpuspic_tab.$tabTypes[$typebook-1]."/$bookId/$repxml".$tabPages[count($tabPages)-1]);	$p = $dp->pageId + 1;	print "	<form action=\"page.php\" method=\"post\" enctype=\"application/x-www-form-urlencoded\" target=\"mainFrame\">
	<input type=\"hidden\" name=\"action\" value=\"add\" />
	<input type=\"hidden\" name=\"typebook\" value=\"$typebook\" />	<input type=\"hidden\" name=\"bookId\" value=\"$bookId\" />	<input type=\"hidden\" name=\"pageId\" value=\"$p\" />
	<input type=\"submit\" value=\"add a page\" />
	</form></center>		page(s) detail(s).<br><br>		<table bgcolor=\"#FFFFFF\" height=\"400\">";			$page = simplexml_load_file($icorpuspic_tab.$tabTypes[$typebook-1]."/$bookId/$repxml$pageO.xml");		print "<tr valign=\"top\"><td><br />";		foreach($page as $cle=>$valeur) {			if ($cle=="figure") {				foreach ($page->$cle->attributes() as $cle2=>$valeur2) {					print "$cle2 : $valeur2<br>\n";				}			}			else				print "$cle : ".utf8_decode($valeur)."<br>\n";		}		print "<p align=\"center\">
			<form action=\"page.php\" method=\"post\" enctype=\"application/x-www-form-urlencoded\" name=\"typebook\" target=\"mainFrame\">
					<input type=\"hidden\" name=\"bookId\" value=\"$bookId\" />					<input type=\"hidden\" name=\"typebook\" value=\"$typebook\" />
					<input type=\"hidden\" name=\"pageId\" value=\"".$page->pageId ."\" />";												foreach($page as $cle=>$valeur) {						if ($cle=="figure") {							foreach ($page->$cle->attributes() as $cle2=>$valeur2) {								print "<input type=\"hidden\" name=\"$cle2\" value=\"$valeur2\" />\n";							}						}						else							print "<input type=\"hidden\" name=\"$cle\" value=\"".utf8_decode($valeur)."\" />\n";					}										print "
					<input type=\"submit\" name=\"action\" title=\"modifier cette page\" value=\"modify\" />					<input type=\"submit\" name=\"action\" title=\"supprimer cette page\" value=\"delete\" />
			</form>
		</p>";				print "</td></tr>";			print "</table>";			print "<br /><center>pageOrder<br />";		if ($pagePrec!="")		print "<a href=\"page.php?page=$pagePrec&action=view&bookId=$bookId&typebook=$typebook\"> <<</a>";			print " $pageO ";		if ($pageSuiv!="")		print "<a href=\"page.php?page=$pageSuiv&action=view&bookId=$bookId&typebook=$typebook\">>> </a>";
}function berg_del_page($bookId,$typebook,$pageO) {	print "del page -> bookId : $bookId, typebook : $typebook, pageOrder : $pageO";		print "<br>Delete this page ?";		print "<form action=\"page.php\" method=\"post\">			<input type=\"hidden\" name=\"bookId\" value=\"$bookId\" />\n		<input type=\"hidden\" name=\"typebook\" value=\"$typebook\" />\n		<input type=\"hidden\" name=\"pageOrder\" value=\"$pageO\" />\n		<input type=\"hidden\" name=\"confirm\" />\n		<input type=\"submit\" name=\"choix\" style=\"width:70px\" value=\"yes\" />\n		<input type=\"submit\" name=\"choix\" style=\"width:70px\" value=\"no\" />\n					</form>";}function berg_form_page($action,$bookId,$typebook,$pageId) {	global $tabTypes;		if ($action == "add") {		print "add page -> bookId : $bookId, typebook : $typebook, pageId : $pageId";	}	if ($action == "mod") {		print "mod page -> bookId : $bookId, typebook : $typebook, pageId : $pageId, pageOrder : ".$_POST['pageOrder'];	}	print "	<form name=\"form_page\" action=\"page_$action.php\" method=\"post\">	<input type=\"hidden\" name=\"bookId\" value=\"$bookId\" />\n	<input type=\"hidden\" name=\"typebook\" value=\"$typebook\" />\n	
	<table>		<tr>
		<td align=\"right\" valign=\"top\" title=\"Le pageId est automatique\"><strong>pageId : </strong></td>
		<td><input type=\"text\" name=\"pageId\" size=\"5\" value=\"$pageId\" disabled /> </td> 		</tr>	<tr>			<td align=\"right\" valign=\"top\" ><strong>bookId : </strong></td>				<td><input type=\"text\" name=\"bookId\" size=\"5\" value=\"$bookId\" disabled /> </td>			</tr>	<tr>			<td align=\"right\" valign=\"top\" ><strong>volNumber : </strong></td>				<td><input type=\"text\" name=\"volNumber\" size=\"5\" value=\"".$_POST['volNumber']."\" /> </td>			</tr>	<tr>			<td align=\"right\" valign=\"top\" ><strong>pageOrder : </strong></td>				<td><input type=\"text\" name=\"pageOrder\" size=\"5\" value=\"".$_POST['pageOrder']."\" /> </td>			</tr>	<tr>			<td align=\"right\" valign=\"top\" ><strong>pageChapter : </strong></td>				<td><textarea cols=\"45\" rows=\"2\" name=\"pageChapter\" >".stripslashes($_POST['pageChapter'])." </textarea> </td>			</tr>	<tr>			<td align=\"right\" valign=\"top\" ><strong>pageTitle : </strong></td>				<td><textarea cols=\"45\" rows=\"2\" name=\"pageTitle\" >".stripslashes($_POST['pageTitle'])." </textarea> </td>			</tr>	<tr>			<td align=\"right\" valign=\"top\" ><strong>pageText : </strong>					<br /> <br />
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
		</td>		<td><textarea cols=\"45\" rows=\"12\" name=\"pageText\" >"./*str_replace("\\r\\n","&#10",stripslashes($_POST['pageText']))*/stripslashes($_POST['pageText'])." </textarea> </td>			</tr>	<tr>			<td align=\"right\" valign=\"top\" ><strong>pageNumber : </strong></td>				<td><input type=\"text\" name=\"pageNumber\" size=\"5\" value=\"".$_POST['pageNumber']."\" /> </td>			</tr>	<tr>			<td align=\"right\" valign=\"top\" ><strong>pageNote : </strong></td>				<td><textarea cols=\"45\" rows=\"2\" name=\"pageNote\" >".stripslashes($_POST['pageNote'])." </textarea> </td>			</tr>	<tr>			<td align=\"right\" valign=\"top\" ><strong>pageUrl : </strong></td>				<td><input type=\"text\" name=\"pageUrl\" size=\"46\" value=\"".$_POST['pageUrl']."\" /> </td>			</tr>	<tr>			<td align=\"right\" valign=\"top\" ><strong>pageImage : </strong></td>				<td><input type=\"text\" name=\"pageImage\" size=\"23\" value=\"".$_POST['pageImage']."\" /> </td>			</tr>	<tr>			<td align=\"right\" valign=\"top\" ><strong>fig1 : </strong></td>				<td><input type=\"text\" name=\"fig1\" size=\"23\" value=\"".$_POST['fig1']."\" /> </td>			</tr>	<tr>			<td align=\"right\" valign=\"top\" ><strong>fig2 : </strong></td>				<td><input type=\"text\" name=\"fig2\" size=\"23\" value=\"".$_POST['fig2']."\" /> </td>			</tr>	<tr>			<td align=\"right\" valign=\"top\" ><strong>fig3 : </strong></td>				<td><input type=\"text\" name=\"fig3\" size=\"23\" value=\"".$_POST['fig3']."\" /> </td>			</tr>		</table>";		if ($action == "add")	
		print "<input type=\"submit\" value=\"add this page\" />";	if ($action == "mod")		print "<input type=\"submit\" value=\"modify now this page\" />";	
	print "</form>
	";}
/*function berg_mod_page($bookId,$typebook,$pageId) {	echo "mod page -> bookId : $bookId, typebook : $typebook, pageId : $pageId";
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
	";	

}*/
?>