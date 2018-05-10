<?php
function ice_page_view_texte ($lang,$bdd,$table,$bookId,$pageOrder,$typeofbookDes) {
	ice_connexion("$bdd");
	//$sql = "SELECT ".$table."_page.bookId, pageOrder, pageChapter, pageTitle, pageText, pageVolNumber, pageNumber, pageNote, pageImage, pagefigure1, pagefigure2, pagefigure3 FROM ".$table."_page INNER JOIN ".$table."_book ON ".$table."_page.bookId = ".$table."_book.bookId ";
	$sql = "SELECT * FROM ".$table."_page INNER JOIN ".$table."_book ON ";
	$sql .= "".$table."_page.bookId = ".$table."_book.bookId ";
	//
	if ($_GET['nav'] = "1") {
		$sql .= "WHERE ".$table."_page.pageOrder = '$pageOrder' AND ".$table."_page.bookId = '$bookId' ORDER BY pageOrder ASC LIMIT 0,1";
	} else {
		$sql .= "WHERE ".$table."_page.bookId = '$bookId' ORDER BY pageOrder ASC LIMIT 0,1";
	}
	$result = mysql_query($sql);
	$p = mysql_num_rows($result);
	$valpage = mysql_fetch_array($result);
	// navigation pages
	nextprevi_page ($_GET['lang'],$_GET['bdd'],$_GET['table'],$_GET['bookId'],$valpage['pageOrder'],$valpage['pageNumber']);
	// html - affichage texte et facsimile
	if ($_GET['facsimile'] == 'off') {
	print "<!-- tableau d'affichage du texte et des facsimilés -->";
		// affichage figure
		if ($_GET['fig']) {
		print "
		<table width=\"100%\">
		<tr>
			<td colspan=\"2\" witdh=\"100%\">
			<div align=\"center\">
			<img border=\"0\" src=\"../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/$_GET[fig]\" alt=\"&copy CRHST-CNRS\"></img>
			</div>
			</p>
			</td>
		</tr>
		</table>";
		} else {}
	print "
	<table width=\"100%\">
	<tr>
		<td width=\"80%\">
		";		
			if ($valpage['pageTitle'] == $valpage['pageChapter']) {
				$pageTitle =  format_pagetext ($valpage['pageTitle'], "80","");
				print "<pre><center><strong>$pageTitle</strong></center></pre>";
				} else {
				$pageChapter =  format_pagetext ($valpage['pageChapter'], "80","");
				print "<pre><center><strong>$pageChapter</strong></center></pre>";
			}
				// Texte : action du moteur de recherche
				if ($_GET[search] == "no") { 
					$pageText =  format_pagetext ($valpage['pageText'],"80","");
					print "
					<pre>$pageText</pre>
					";
				}
				if ($_GET[search] == "yes") {
					$pageText =  format_pagetext ($valpage['pageText'],"80","");
					$pageTextHighlight = eregi_replace("$_GET[q1]","<b style=\"border-bottom-style: solid; border-bottom-width: 3px;\">$_GET[q1]</b>",$pageText);
					print "
					<pre>$pageTextHighlight</pre>
					";
				}
						// Notes : action du moteur de recherche
					if ($valpage['pageNote']) {
						if ($_GET[search] == "no") { 
							$pageNote =  format_pagetext ($valpage['pageNote'],"80","");
							print "<hr>
							<pre>$pageNote</pre>
							";
						}
						if ($_GET[search] == "yes") {
							$pageNote =  format_pagetext ($valpage['pageNote'],"80","");
							$pageNoteHighlight = eregi_replace("$_GET[q1]","<b style=\"border-bottom-style: solid; border-bottom-width: 2px;\">$_GET[q1]</b>",$pageNote);
							print "<hr>
							<pre><font class=\"note\">$pageNoteHighlight</font></pre>
							";
						}
					}
			print "
			</td>
			";
			if ($valpage['pageImage']) {
			print "
			<td width=\"20%\" valign=\"top\">
				<div align=\"center\">
				<p>
				<a href=\"$_SERVER[PHP_SELF]?$_SERVER[QUERY_STRING]&facsimile=on&search=no\">
				<img border=\"0\" src=\"../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/vig/$valpage[pageImage]\" alt=\"&copy CRHST-CNRS\"></img>
				</a>
				</p>
				";
				if ($valpage['pagefigure1']) {
					print "<p>
					<a href=\"$_SERVER[PHP_SELF]?$_SERVER[QUERY_STRING]&fig=$valpage[pagefigure1]&search=no\">
					<img border=\"0\" src=\"../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/vig/$valpage[pagefigure1]\" alt=\"&copy CRHST-CNRS\"></img>
					</a></p>";
				}
				if ($valpage['pagefigure2']) {
					print "<p>
					<a href=\"$_SERVER[PHP_SELF]?$_SERVER[QUERY_STRING]&fig=$valpage[pagefigure2]&search=no\">
					<img border=\"0\" src=\"../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/vig/$valpage[pagefigure2]\" alt=\"&copy CRHST-CNRS\"></img>
					</a></p>";
				}
				if ($valpage['pagefigure3']) {
					print "<p>
					<a href=\"$_SERVER[PHP_SELF]?$_SERVER[QUERY_STRING]&fig=$valpage[pagefigure3]&search=no\">
					<img border=\"0\" src=\"../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/vig/$valpage[pagefigure3]\" alt=\"&copy CRHST-CNRS\"></img>
					</a></p>";
				}
				print "
				</div>
			</td>
			";
			}
	print "
	</tr>
	</table>";
	}
	if ($_GET['facsimile'] == 'on') {
	print "
	<table width=\"100%\">
	<tr>
		<td>
		<a lang=\"$GET_[lang]\" href=\"$_SERVER[PHP_SELF]?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&typeofbookDes=$_GET[typeofbookDes]&pageOrder=$_GET[pageOrder]&facsimile=off&search=no\">
		"; 
		if ($lang == 'fr') { print "retour au texte"; }	
		if ($lang == 'en') { print "back to text"; }
		print "
		</a>
		</td>
	</tr>
	<tr>
		<td width=\"100%\">
		<div align=\"center\">
		<a lang=\"$GET_[lang]\" href=\"$_SERVER[PHP_SELF]?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&typeofbookDes=$_GET[typeofbookDes]&pageOrder=$_GET[pageOrder]&facsimile=off&search=no\">
			<img width=\"$tablewidth\" border=\"0\" src=\"../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/$valpage[pageImage]\" alt=\"&copy CRHST-CNRS\"></img>
		</a>
		</div>
		</td>
	</tr>
	</table>
	";
	}
	mysql_free_result($result);
	mysql_close();
}
function ice_page_view_image ($lang,$bdd,$table,$bookId,$pageOrder,$typeofbookDes,$cfzoom) {
	ice_connexion("$bdd");
	$sql = "SELECT * FROM ".$table."_page, ".$table."_typebook INNER JOIN ".$table."_book ON ";
	$sql .= "".$table."_page.bookId=".$table."_book.bookId ";
	$sql .= "WHERE ".$table."_page.pageOrder = '$pageOrder' AND ".$table."_page.bookId = '$bookId' LIMIT 0,1";
	$result = mysql_query($sql);
	$valpage = mysql_fetch_array($result);
	// navigation pages
	nextprevi_page ($_GET[lang],$_GET[bdd],$_GET[table],$_GET[bookId],$valpage['pageOrder'],$valpage['pageNumber']);
	// image seule
	if (($valpage[pageImage]) AND (!$valpage[pageText])) {
		// utilisation de la GD 2.0
		list($width, $height, $type, $attr) = getimagesize("../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/$valpage[pageImage]");
			if (!$cfzoom) {
				$width_data = $width/2;
			} else {
				$width_data = $width/$cfzoom;
			}
		// affichage image
		print "
		<table width=\"100%\">
		<tr>
			<td>
			zoom : 
			<a href=\"ice_page_detail.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&
			pageOrder=$_GET[pageOrder]&typeofbookDes=$_GET[typeofbookDes]&nump=$_GET[nump]&nav=1&cfzoom=1\">100%</a>
			<a href=\"ice_page_detail.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&
			pageOrder=$_GET[pageOrder]&typeofbookDes=$_GET[typeofbookDes]&nump=$_GET[nump]&nav=1&cfzoom=1.5\">75%</a>
			<a href=\"ice_page_detail.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&
			pageOrder=$_GET[pageOrder]&typeofbookDes=$_GET[typeofbookDes]&nump=$_GET[nump]&nav=1&cfzoom=2\">50%</a>
			<a href=\"ice_page_detail.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&
			pageOrder=$_GET[pageOrder]&typeofbookDes=$_GET[typeofbookDes]&nump=$_GET[nump]&nav=1&cfzoom=2.5\">25%</a>
			</td>
		</tr>
		<tr>
			<td align=\"center\">
				<center>
				<img width=\"$width_data\" src=\"../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/$valpage[pageImage]\" alt=\"&copy 2003 - CRHST\">
				</center>
			</td>
		</tr>
		</table>";
	}
	// texte et image
	if (($valpage['pageImage']) AND ($valpage['pageText'])) {
		$pageText =  format_pagetext ($valpage['pageText'], $cols = "120", $prefix = "");
		if ($_GET['facsimile'] == 'off') {
		print "<!-- tableau d'affichage du texte et des facsimilés -->";
		// affichage figure
		if ($_GET['fig']) {
		print "
		<table width=\"100%\">
		<tr>
			<td colspan=\"2\" witdh=\"100%\">
			<div align=\"center\">
			<img border=\"0\" src=\"../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/$_GET[fig]\" alt=\"&copy CRHST-CNRS\"></img>
			</div>
			</p>
			</td>
		</tr>
		</table>";
		}
		else {}
		print "
		<table width=\"100%\">
		<tr>
			<td width=\"80%\">
			";		
			if ($valpage['pageTitle'] == $valpage['pageChapter']) {
				$pageTitle =  format_pagetext ($valpage['pageTitle'], "80","");
				print "<pre><center><strong>$pageTitle</strong></center></pre>";
				} else {
				$pageChapter =  format_pagetext ($valpage['pageChapter'], "80","");
				print "<pre><center><strong>$pageChapter</strong></center></pre>";
			}
				// Texte : action du moteur de recherche
				if ($_GET[search] == "no") { 
					$pageText =  format_pagetext ($valpage['pageText'],"80","");
					print "
					<pre>$pageText</pre>
					";
				}
				if ($_GET[search] == "yes") {
					$pageText =  format_pagetext ($valpage['pageText'],"80","");
					$pageTextHighlight = eregi_replace("$_GET[q1]","<b style=\"border-bottom-style: solid; border-bottom-width: 3px;\">$_GET[q1]</b>",$pageText);
					print "
					<pre>$pageTextHighlight</pre>
					";
				}
				  // Notes : action du moteur de recherche
				  if ($valpage['pageNote']) {	
					 if ($_GET[search] == "no") { 
					 	$pageNote =  format_pagetext ($valpage['pageNote'],"80","");
					 	print "<hr>
					 	<pre>$pageNote</pre>
					 	";
					 }
					 if ($_GET[search] == "yes") {
						$pageNote =  format_pagetext ($valpage['pageNote'],"80","");
						$pageNoteHighlight = eregi_replace("$_GET[q1]","<b style=\"border-bottom-style: solid; border-bottom-width: 2px;\">$_GET[q1]</b>",$pageNote);
						print "<hr>
						<pre><font class=\"note\">$pageNoteHighlight</font></pre>
						";
					 }
				  }
			print "
			</td>
			";
			if ($valpage['pageImage']) {
			print "
			<td width=\"20%\" valign=\"top\">
				<div align=\"center\">
				<p>
				<a href=\"$_SERVER[PHP_SELF]?$_SERVER[QUERY_STRING]&facsimile=on&search=no\">
				<img border=\"0\" src=\"../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/vig/$valpage[pageImage]\" alt=\"&copy CRHST-CNRS\"></img>
				</a>
				</p>
				";
				if ($valpage['pagefigure1']) {
					print "<p>
					<a href=\"$_SERVER[PHP_SELF]?$_SERVER[QUERY_STRING]&fig=$valpage[pagefigure1]&search=no\">
					<img border=\"0\" src=\"../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/vig/$valpage[pagefigure1]\" alt=\"&copy CRHST-CNRS\"></img>
					</a></p>";
				}
				if ($valpage['pagefigure2']) {
					print "<p>
					<a href=\"$_SERVER[PHP_SELF]?$_SERVER[QUERY_STRING]&fig=$valpage[pagefigure2]&search=no\">
					<img border=\"0\" src=\"../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/vig/$valpage[pagefigure2]\" alt=\"&copy CRHST-CNRS\"></img>
					</a></p>";
				}
				if ($valpage['pagefigure3']) {
					print "<p>
					<a href=\"$_SERVER[PHP_SELF]?$_SERVER[QUERY_STRING]&fig=$valpage[pagefigure3]&search=no\">
					<img border=\"0\" src=\"../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/vig/$valpage[pagefigure3]\" alt=\"&copy CRHST-CNRS\"></img>
					</a></p>";
				}
				print "
				</div>
			</td>
			";
			}
		print "
		</tr>
		</table>";
		}
		if ($_GET['facsimile'] == 'on') {
		print "
		<table width=\"100%\">
		<tr>
			<td>
			<a lang=\"$GET_[lang]\" href=\"$_SERVER[PHP_SELF]?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&typeofbookDes=$_GET[typeofbookDes]&pageOrder=$_GET[pageOrder]&facsimile=off&search=no\">
			"; 
			if ($lang == 'fr') { print "retour au texte"; }	
			if ($lang == 'en') { print "back to text"; }
			print "
			</a>
			</td>
		</tr>
		<tr>
			<td width=\"100%\">
			<div align=\"center\">
			<a lang=\"$GET_[lang]\" href=\"$_SERVER[PHP_SELF]?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&typeofbookDes=$_GET[typeofbookDes]&pageOrder=$_GET[pageOrder]&facsimile=off&search=no\">
				<img width=\"$tablewidth\" border=\"0\" src=\"../i-corpuspic/tab/$typeofbookDes/$valpage[bookTitleCollection]/$valpage[pageImage]\" alt=\"&copy CRHST-CNRS\"></img>
			</a>
			</div>
			</td>
		</tr>
		</table>";
		}
	mysql_free_result($result);
	mysql_close();
	}	
}
?>