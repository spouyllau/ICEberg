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
function berg_list_book($ficBook,$typebook) {	//Chargement du fichier de book	$b=simplexml_load_file($ficBook);	foreach ($b as $book){		if($book->typeOfBook['id'] == $typebook){						if(!isset($bool)){					print "<p>book(s) detail(s).</p>\n";					print "<table width=\"300\" bgcolor=\"#333333\" cellpadding=\"3\" cellspacing=\"2\">	
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
	print "</table>\n";		if(!isset($bool))		print "No book for this type";
}function replace_deep($value)
{
	$value = is_array($value) ?
				array_map('replace_deep', $value) :
				utf8_encode(str_replace("\'", "'", str_replace('"', "'", $value)));

	return $value;
}
function berg_list_fields_book($action, $bookId, $typebook) {	global $ficBook;	global $ficTypesBook;	global $icorpuspic_tab;		//Nombre maximum de personnes qui numérisent	$max_numerisation_persons = 4;		//Chargement du fichier de book	$b=simplexml_load_file($icorpuspic_tab.$ficBook);		//Chargement du fichier de typeofbook	$t=simplexml_load_file($icorpuspic_tab.$ficTypesBook);		if($action == "mod")		$title = "Edit a book";	else		$title = "Add a book";		//Si on est en mode ajout, on cherche le book à modifier et sinon on détermine le nouveau  bookId	foreach($b as $boo){		if($boo->id == $bookId){			$book = $boo;		}		$newbookId = $boo->id;	}	$newbookId+=1;		//bookId -> Si on est en mode ajout, le bookId est calculé automatiquement	if($action=="mod") 		$id=$book->id;	else 		$id=$newbookId;		print "<script type=\"text/javascript\" src=\"functions/script.js\" /></script>	<h3 align=\"center\">$title</h3>
	<form action=\"book_edit.php\" method=\"post\" name=\"formBook\" onSubmit=\"return verifBook(this);\">	<input type=\"hidden\" name=\"action\" value=\"$action\" />	<table>";	print "<tr>
		<td align=\"right\" valign=\"top\" title=\"bookId is automatic\">bookId : </td>
		<td><input type=\"text\" name=\"bookId\" size=\"3\" value=\"$id\" readonly /></td>
	   </tr>";	//book type	print "<tr>
		<td align=\"right\" valign=\"top\">Book type : </td>
		<td><select name=\"typeOfBook\" size=\"1\">";		foreach ($t as $type){
			print "<option value='".$type->typeId."'";			if($type->typeId == $typebook)				print "selected=\"selected\"";			print ">".utf8_decode($type->typeDes)."</option>\n";	}	
	print "</select></td>
	   </tr>";		//Titres	print "<tr>
			<td align=\"right\" valign=\"top\" rowspan=\"3\">Title : </td>
			<td>Short title<br/> <textarea cols=\"45\" rows=\"2\" name=\"title_short\">\n";				if($action=="mod") print utf8_decode($book->title['short']);		print "</textarea></td></tr>		<tr><td>Full title<br/> <textarea cols=\"45\" rows=\"5\" name=\"title_name\">";		if($action=="mod") print utf8_decode($book->title['name']);		print "</textarea></td></tr>	<tr><td>Collection<br/> <input type=\"text\" name=\"title_collection\" size=\"40\"";		if($action=="mod") print "value=\"".utf8_decode($book->title['collection'])."\"";		print "\"></td></tr>\n";		//Date	print "<tr>
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
		</tr>\n";	print "</table><br/>	<center><input type=\"submit\" value=\"";		if($action=="add") 		print "add the book";	else		print "edit the book";		print "\" /> <input type=\"reset\" value=\"reset\" title=\"reset changes\" /> </form>\n";		//Bouton de retour	print "<form action=\"book.php\" name=\"retour\" method=\"post\">			<td>				<input type=\"hidden\" name=\"action\" value=\"view\" />				<input type=\"hidden\" name=\"typebook\" value=\"$typebook\" />				<input type=\"submit\" value=\"back\" />			</td>	</form>	</center>";}//Confirmation avant la suppressionfunction berg_confirm_book_del($bookId, $typebook) {	print "<center>			<strong>Confirm book n°$bookId deletion ?</strong>			<br/>The book and all of its pages will be deleted.<br/><br/>			<table border=\"0\">			<tr><form action=\"book_edit.php\" name=\"confirmation\" method=\"post\">			<td>					<input type=\"hidden\" name=\"action\" value=\"del\" />					<input type=\"hidden\" name=\"typeOfBook\" value=\"$typebook\" />					<input type=\"hidden\" name=\"bookId\" value=\"$bookId\" />					<input type=\"submit\" value=\"Confirm\" />					</td></form>			<form action=\"book.php\" name=\"annulation\" method=\"post\">			<td>				<input type=\"hidden\" name=\"action\" value=\"view\" />				<input type=\"hidden\" name=\"typebook\" value=\"$typebook\" />				<input type=\"submit\" value=\"Cancel\" />			</td>			</form></tr>			</table>		</center>";}function berg_edit_book($book, $ficBook, $action, $typeBook, $bookId){	$b = simplexml_load_file($ficBook);		//Cas de la modification d'un book	if($action == "mod"){		foreach($b as $boo){			//On cherche le book à modifier puis on le remplace par celui qu'on a construit avant			if($boo->id == $book['bookId']){				$boo->title['short'] = $book['title_short'];				$boo->title['name'] = $book['title_name'];				$boo->title['collection'] = $book['title_collection'];				$boo->typeOfBook['id'] = $book['typeOfBook'];				$boo->bookDate = $book['bookDate'];				$boo->author['name'] = $book['author_name'];				$boo->author['surname'] = $book['author_surname'];				$boo->editor = $book['editor'];				$boo->placeEditor = $book['placeEditor'];				$boo->pagesNumber = $book['pagesNumber'];				$boo->coverImage = $book['coverImage'];				$boo->volNumber = $book['volNumber'];				$boo->bookObservations = $book['bookObservations'];				$boo->numerisation['person1'] = $book['numerisation_person1'];				$boo->numerisation['person2'] = $book['numerisation_person2'];				$boo->numerisation['person3'] = $book['numerisation_person3'];				$boo->numerisation['person4'] = $book['numerisation_person4'];				$boo->bookOrder = $book['bookOrder'];				$boo->format['doc'] = $book['format_doc'];				$boo->format['pdf'] = $book['format_pdf'];				break;			}		}	}	else{ //Si on supprime ou on ajoute un book			//On instancie un objet DOM pour manipuler l'arbre XML du fichier de book		$dom = new DOMDocument('1.0');		//On charge le fichier de book $ficBook dans l'objet DOM		$dom->load($ficBook);		$thedoc = $dom->documentElement;			//Cas de la suppression d'un book		if($action == "del"){					//On cherche le noeud XML du book à supprimer (on stocke l'indice dans $i)			$i = 0;			foreach($b as $boo){				if($boo->id == $book['bookId']){					break;				}				$i++;			}						//On supprime le noeud XML de l'arbre du fichier de book			$test = $thedoc->getElementsByTagName('book')->item($i);			$test = $thedoc->removeChild($test);					}				//Cas de l'ajout d'un book		if($action == "add"){					//On convertit le book créé en un noeud XML pour le manipuler avec le DOM 			//(j'ai du importer la chaine en simpleXML puis convertir l'element simpleXML en un noeud DOM parce que je n'y arrivais pas directement)			$sxbook = simplexml_load_string($book);			$dom_sxe = dom_import_simplexml($sxbook);						if (!$dom_sxe) {
				echo 'Erreur lors de la conversion du XML';
				exit;
			}						//On associe le noeud à importer avec le document courant			$dom_sxe = $dom->importNode($dom_sxe, true);			//On ajoute le noeud DOM à l'arbre XML			$dom->documentElement->appendChild($dom_sxe);		}				//On reconvertit l'objet DOM en un objet simpleXML pour l'export dans le fichier		$b = simplexml_import_dom($dom);	}		//On supprime le fichier de book et on écrit un nouveau (on pourrait le vider, mais touch ne fait rien ??)	unlink($ficBook);		//On créé et on ouvre le fichier de book
	if(!$fp = fopen($ficBook,"x+")){
		print "Cannot open book file $ficBook or file already exists";
		exit();
	}		if(fwrite($fp, $b->asXML()) == false){
		print "Cannot write to book file $ficBook";
		exit();
	}		//On ferme le fichier de book
	fclose($fp);		//On supprime le répertoire du book si on est en mode suppression (à faire)	//On créé le répertoire du book et ses sous-répertoires si on est en mode ajout (à faire ??)	if($action == "del" || $action=="add"){		global $tabTypes;		global $icorpuspic_tab;				$rep = $icorpuspic_tab.$tabTypes[$typeBook-1]."/".$bookId;				if($action == "add"){			mkdir($rep, 0777) or die("Cannot create book directory $rep");			print "Book n°$bookId Directory created<br/>";			mkdir($rep."/xml", 0777) or die("Cannot create book directory $rep/xml");			print "Directory xml created<br/>";			mkdir($rep."/download", 0777) or die("Cannot create book directory $rep/download");			print "Directory download created<br/>";			mkdir($rep."/img", 0777) or die("Cannot create book directory $rep/img");			print "Directory img created<br/>";			}				//if($action == "del")			//vider tout le dossier puis le supprimer	}	
}
?>