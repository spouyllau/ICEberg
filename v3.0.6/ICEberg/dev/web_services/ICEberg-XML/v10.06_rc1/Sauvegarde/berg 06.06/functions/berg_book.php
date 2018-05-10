<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////
function berg_typebook ($ficTypesBook) {	$t=simplexml_load_file($ficTypesBook);		print "book type : <select name=\"typebook\" size=\"1\">";		foreach ($t as $type)
		print "<option value='".$type->typeId."'>".utf8_decode($type->typeDes)."</option>";	
	print "</select>";
}
function berg_list_book($ficBook,$typebook) {//Chargement du fichier de book$b=simplexml_load_file($ficBook);	foreach ($b as $book){		if($book->typeOfBook['id'] == $typebook){						if(!isset($bool)){					print "<p>book(s) detail(s).</p>\n";					print "<table width=\"300\" bgcolor=\"#333333\" cellpadding=\"3\" cellspacing=\"2\">	
			<tr align=\"center\">	
				<td><strong>bookId</strong></td>	
				<td><strong>BookTitle</strong></td>	
				<td><strong>BookShortTitle</strong></td>	
				<td colspan=\"2\">action</td>	
			</tr>";					}				$bool = true;						eregi("^.{10}",$book->title['short'],$bookShortTitle);				$id = $book->id;			print "
			<tr align=\"center\">	
				<td align=\"center\" valign=\"top\">N°<strong>".$book->id."</strong></td>	
				<td valign=\"top\" title=\"".utf8_decode($book->title['name'])."\"><strong>".utf8_decode($book->title['short'])."...</strong></td>	
				<td valign=\"top\" title=\"".utf8_decode($book->title['short'])."\">".utf8_decode($bookShortTitle[0])."...</td>					<td valign=\"middle\">	
				<form action=\"page.php\" method=\"post\" name=\"listbook\" target=\"mainFrame\">					<input type=\"hidden\" name=\"bookId\" value=\"$id\" />					<input type=\"hidden\" name=\"typebook\" value=\"$_POST[typebook]\" />					<input type=\"hidden\" name=\"action\" value=\"view\" />
					<input type=\"submit\" style=\"width:70px;\" title=\"list pages of this book\" value=\"list pages\" />				</form>								<form action=\"book.php\" method=\"post\" name=\"editbook\">					<input type=\"submit\" style=\"width:70px;\" title=\"edit this book\" 					name=\"submit\" value=\"edit\" />					<input type=\"hidden\" name=\"action\" value=\"edit\" />					<input type=\"hidden\" name=\"typebook\" value=\"$_POST[typebook]\" />					<input type=\"hidden\" name=\"bookId\" value=\"$id\" />					<br/>					<input type=\"submit\" style=\"width:70px;\" title=\"delete this book\" 					name=\"submit\" value=\"delete\" />									</form>						</td>	
					
			</tr>\n";		}	}	
print "</table>\n";if(!isset($bool))	print "No book for this type";
}
function berg_list_fields_book($action, $bookId, $typebook) {	global $ficBook;	global $ficTypesBook;	global $icorpuspic_tab;		//Nombre maximum de personnes qui numérisent	$max_numerisation_persons = 4;		//Chargement du fichier de book	$b=simplexml_load_file($icorpuspic_tab.$ficBook);		//Chargement du fichier de typeofbook	$t=simplexml_load_file($icorpuspic_tab.$ficTypesBook);		if($action == "mod")		$title = "Edit a book";	else		$title = "Add a book";		//Si on est en mode ajout, on cherche le book à modifier et sinon on détermine le nouveau  bookId	foreach($b as $boo){		if($boo->id == $bookId){			$book = $boo;		}		$newbookId = $boo->id;	}	$newbookId+=1;		//bookId -> Si on est en mode ajout, le bookId est calculé automatiquement	if($action=="mod") 		$id=$book->id;	else 		$id=$newbookId;		print "	<script language=\"javascript\" src=\"functions/script.js\" />	<center><h3>$title</h3>
	<form action=\"book_edit.php\" method=\"post\" name=\"formBook\" onSubmit=\"return verifBook(this);\">	<input type=\"hidden\" name=\"action\" value=\"$action\" />	<input type=\"hidden\" name=\"bookId\" value=\"$id\" />	<table>";	print "<tr>
		<td align=\"right\" valign=\"top\" title=\"bookId is automatic\">bookId : </td>
		<td><input type=\"text\" name=\"id\" size=\"3\" value=\"$id\" disabled=\"true\" /></td>
	   </tr>";	//book type	print "<tr>
		<td align=\"right\" valign=\"top\">Book type : </td>
		<td><select name=\"typeOfBook\" size=\"1\">";		foreach ($t as $type){
			print "<option value='".$type->typeId."'";			if($type->typeId == $typebook)				print "selected=\"selected\"";			print ">".utf8_decode($type->typeDes)."</option>\n";	}	
	print "</select></td>
	   </tr>";		//Titres	print "<tr>
			<td align=\"right\" valign=\"top\" rowspan=\"3\">Title : </td>
			<td>Short title<br/> <textarea cols=\"45\" rows=\"1\" name=\"title_short\">\n";				if($action=="mod") print utf8_decode($book->title['short']);		print "</textarea></td></tr>		<tr><td>Full title<br/> <textarea cols=\"45\" rows=\"5\" name=\"title_name\">";		if($action=="mod") print utf8_decode($book->title['name']);		print "</textarea></td></tr>	<tr><td>Collection<br/> <input type=\"text\" name=\"title_collection\" size=\"40\"";		if($action=="mod") print "value=\"".utf8_decode($book->title['collection'])."\"";		print "\"></td></tr>\n";		//Date	print "<tr>
		<td align=\"right\" valign=\"top\" >Date : </td>
		<td><input type=\"text\" name=\"bookDate\" size=\"4\" value=\"";		if($action=="mod") print $book->bookDate;		print "\" /></td>
	   </tr>\n";			//Infos sur l'auteur	print "<tr>
		<td align=\"right\" valign=\"top\" rowspan=\"2\">Author : </td>
		<td>Name : <br/><input type=\"text\" name=\"author_name\" size=\"40\" value=\"";		if($action=="mod") print utf8_decode($book->author['name']);		print "\" /></td>
		</tr>		<tr>			<td>Surname : <br/><input type=\"text\" name=\"author_surname\" size=\"40\" value=\"";		if($action=="mod") print utf8_decode($book->author['surname']);		print "\" /></td>
		</tr>";	//Infos sur l'éditeur	print "<tr>
		<td align=\"right\" valign=\"top\" rowspan=\"2\">Editor : </td>
		<td>Name : <br/><input type=\"text\" name=\"editor\" size=\"40\" value=\"";		if($action=="mod") print utf8_decode($book->editor);		print "\" /></td>
		</tr>		<tr>
		<td>City : <input type=\"text\" name=\"placeEditor\" size=\"34\" value=\"";		if($action=="mod") print utf8_decode($book->placeEditor);		print "\" /></td>
		</tr>";		//Nombre de pages	print "<tr>
		<td align=\"right\" valign=\"top\" >Number of pages : </td>
		<td><input type=\"text\" name=\"pagesNumber\" size=\"40\" value=\"";		if($action=="mod") print utf8_decode($book->pagesNumber);		print "\" /></td>
	   </tr>\n";		//Couverture	print "<tr>
		<td align=\"right\" valign=\"top\" >Cover image : </td>
		<td><input type=\"text\" name=\"coverImage\" size=\"40\" value=\"";		if($action=="mod") print $book->coverImage;		print "\" /></td>
	   </tr>\n";		//Numéro de volume	print "<tr>
		<td align=\"right\" valign=\"top\" >Volume number : </td>
		<td><input type=\"text\" name=\"volNumber\" size=\"4\" value=\"";		if($action=="mod") print $book->volNumber;		print "\" /></td>
	   </tr>\n";		//Observations	print "<tr>
		<td align=\"right\" valign=\"top\">Book observations : </td>
		<td><textarea cols=\"45\" rows=\"3\" name=\"bookObservations\">\n";				if($action=="mod") print utf8_decode($book->bookObservations);		print "</textarea></td></tr>\n";	//Numérisé par	print "<tr>
		<td align=\"right\" valign=\"top\" rowspan=\"$max_numerisation_persons\">Numerisation : </td>\n";	//boucle pour créer $max_numerisation_persons champs de numérisateurs		for($i=0;$i<$max_numerisation_persons;$i++){	
	print "<td>Person ".($i+1)." : <br/><input type=\"text\" name=\"numerisation_person".($i+1)."\" size=\"40\" value=\"";		if($action=="mod") print utf8_decode($book->numerisation['person'.($i+1)]);		print "\" /></td>
		</tr>\n";	}		//Numéro de volume	print "<tr>
		<td align=\"right\" valign=\"top\" >Book order : </td>
		<td><input type=\"text\" name=\"bookOrder\" size=\"4\" value=\"";		if($action=="mod") print $book->bookOrder;		print "\" /></td>
	   </tr>\n";		//Documents complets	print "<tr>
		<td align=\"right\" valign=\"top\" rowspan=\"2\">Download : </td>
		<td>Microsoft Word format :<br/><input type=\"text\" size=\"40\" name=\"format_doc\" value=\"";		if($action=="mod")		print utf8_decode($book->format['doc']);		print "\" title=\"Type the filename of the Microsoft Word document here\" /></td>
		</tr>		<tr>
		<td>Acrobat format : <br/><input type=\"text\" size=\"40\" name=\"format_pdf\" value=\"";		if($action=="mod")		print utf8_decode($book->format['pdf']);		print "\" title=\"Type the filename of the Adobe Acrobat document here\" /></td>
		</tr>\n";	print "</table><br/><input type=\"submit\" value=\"";		if($action=="add") 		print "add the book";	else		print "edit the book";		print "\" /> <input type=\"reset\" value=\"reset\" title=\"reset changes\" /> </form>\n";		//Bouton de retour	print "<form action=\"book.php\" name=\"retour\" method=\"post\">			<td>				<input type=\"hidden\" name=\"action\" value=\"view\" />				<input type=\"hidden\" name=\"typebook\" value=\"$typebook\" />				<input type=\"submit\" value=\"back\" />			</td>	</form>	</center>\n";}function berg_book_del($bookId, $typebook) {	print "<center>			<strong>Confirm book n°$bookId deletion ?</strong>			<br/><br/>			<table border=\"0\">			<tr><form action=\"book.php\" name=\"confirmation\" method=\"post\">			<td>					<input type=\"hidden\" name=\"supp\" value=\"del\" />					<input type=\"hidden\" name=\"action\" value=\"view\" />					<input type=\"hidden\" name=\"typebook\" value=\"$typebook\" />					<input type=\"hidden\" name=\"bookId\" value=\"$bookId\" />					<input type=\"submit\" value=\"Confirm\" />					</td></form>			<form action=\"book.php\" name=\"annulation\" method=\"post\">			<td>				<input type=\"hidden\" name=\"action\" value=\"view\" />				<input type=\"hidden\" name=\"typebook\" value=\"$typebook\" />				<input type=\"submit\" value=\"Cancel\" />			</td>			</form></tr>			</table>		</center>";}		/*	foreach($b->book[0]->children() as $name => $node) {
		echo "$name : $node\n";		if($node->attributes()!= ""){						foreach($node->attributes() as $attribute => $value) {
			   echo "<b>$attribute</b>=", $value, "\n<br>";
			}		}		echo "<br>";		//if($name == "")
	}				foreach($b->children() as $name => $node) {		$book[$name] = $node;	}		print "<pre>";		print_r($book);		print "</pre>";	*/
?>