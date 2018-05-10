<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

require("config.inc.php");require("functions/berg_page.php");
require("entete.php");print "Traitement de l'ajout";print "<pre>";var_dump($_POST);print "</pre>";$pagexml = $doctype_page;$pagexml .= "<PAGE>\n\n	<pageId>".$_POST['pageId']."</pageId>\n	<bookId>".$_POST['bookId']."</bookId>\n	<volNumber>".$_POST['volNumber']."</volNumber>\n	<pageOrder>".$_POST['pageOrder']."</pageOrder>\n	<pageChapter>".$_POST['pageChapter']."</pageChapter>\n	<pageTitle>".$_POST['pageTitle']."</pageTitle>\n	<pageText>".$_POST['pageText']."</pageText>\n	<pageNumber>".$_POST['pageNumber']."</pageNumber>\n	<pageNote>".$_POST['pageNote']."</pageNote>\n	<pageUrl>".$_POST['pageUrl']."</pageUrl>\n	<pageImage>".$_POST['pageImage']."</pageImage>\n	<figure fig1=\"".$_POST['fig1']."\" fig2=\"".$_POST['fig2']."\" fig3=\"".$_POST['fig3']."\" />\n	</PAGE>";$nf = fopen($icorpuspic_tab.$tabTypes[$_POST['typebook']-1]."/".$_POST['bookId']."/$repxml".$_POST['pageOrder'].".xml","w");fwrite($nf,$pagexml);fclose($nf);	berg_list_page($_POST['bookId'],$_POST['typebook'],$_POST['pageOrder']);
/*	ice_connexion("$host","$user","$pass","$bdd");
	$sql = "SHOW FIELDS FROM ".$table."_page";
	$result = mysql_query($sql);
	while($val = mysql_fetch_array($result)) {
		$field[] = $val['Field'];
	}
	reset($field);
	$set = "";
	for ($i = 0; $i < count($field); $i++) {
		$index = key($field);
			if (next($field)) {
				// fields list
				$addfield = "$field[$index]";
				// data
				$data = urldecode($$field[$index]);
				$data = addslashes($data);
				$set .= "`$addfield`='$_POST[$addfield]', ";
			} 
			else {
				// fields list
				$addfield = "$field[$index]";
				// data
				$data = urldecode($$field[$index]);
				$data = addslashes($data);
				$set .= "`$addfield`='$_POST[$addfield]'";
			}	
	}
	// sql
	$mod = "UPDATE ".$table."_page SET $set WHERE pageId = '$_POST[pageId]' LIMIT 1";
	print "SQL : <div class=\"sql\">$mod</div><p>modification de page => ok</p>
	<!-- <input type=\"button\" value=\"retour\" onClick=\"window.history.go(-2)\"> -->";
		$action = mysql_query($mod) or die("erreur de modification");
	mysql_free_result($result);
	mysql_close();		*/
require("pieddepage.php");
?>