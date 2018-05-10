<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////

require("config.inc.php");require("functions/berg_page.php");
require("entete.php");print "Page ".$_POST['pageOrder'];if ($_POST['action']=="add")	print " add";else 	print " modified";$pagexml = $doctype_page;$pagexml .= "<PAGE>\n\n	<pageId>".$_POST['pageId']."</pageId>\n	<bookId>".$_POST['bookId']."</bookId>\n	<volNumber>".trim($_POST['volNumber'])."</volNumber>\n	<pageOrder>".trim($_POST['pageOrder'])."</pageOrder>\n	<pageChapter>".trim(stripslashes($_POST['pageChapter']))."</pageChapter>\n	<pageTitle>".trim(stripslashes($_POST['pageTitle']))."</pageTitle>\n	<pageText>".trim(stripslashes($_POST['pageText']))."</pageText>\n	<pageNumber>".$_POST['pageNumber']."</pageNumber>\n	<pageNote>".trim(stripslashes($_POST['pageNote']))."</pageNote>\n	<pageUrl>".$_POST['pageUrl']."</pageUrl>\n	<pageImage>".$_POST['pageImage']."</pageImage>\n	<figure fig1=\"".$_POST['fig1']."\" fig2=\"".$_POST['fig2']."\" fig3=\"".$_POST['fig3']."\" />\n	</PAGE>";$nf = fopen($icorpuspic_tab.$tabTypes[$_POST['typebook']-1]."/".$_POST['bookId']."/$repxml".$_POST['pageOrder'].".xml","w");fwrite($nf,$pagexml);fclose($nf);	berg_list_page($_POST['bookId'],$_POST['typebook'],$_POST['pageOrder']);
require("pieddepage.php");
?>