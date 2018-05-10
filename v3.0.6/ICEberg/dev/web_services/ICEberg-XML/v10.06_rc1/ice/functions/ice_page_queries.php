<?php

function ice_page_view_texte ($page,$number,$bookid,$rauteur,$type,$title,$chap,$lang,$doctype,$tab,$search,$query) {

	// Description du type du book
	$desc=$tab[$type-1];
	// Chargement du fichier XML page
	$p=simplexml_load_file($rauteur.$bookid."/".$page.".xml");
	
	// Navigation pages
	nextprevi_page ($bookid,$page,$number,$rauteur,$type,$title,$chap,$lang,$doctype,$tab,$search);
	
	// Html - affichage texte et facsimile
	if ($_GET['facsimile'] == 'off') {
		print "<!-- tableau d'affichage du texte et des facsimilés -->";
		print "<table width='860' cellpadding='5' class='tdf'><tr width='860'>";
		// Affichage figure
		if (isset ($_GET['fig'])) {
			print "
					<td colspan=\"2\">
						<div align=\"center\">
							<img border=\"0\" src=\"$rauteur/i-corpuspic/tab/$desc/$bookid/$_GET[fig]\" alt=\"&copy CRHST-CNRS\">
						</div>
					</td>
					</tr>";
		}
		print "<td valign='top' width='690'>";	
		
		
		$t=$p->pageTitle;
		$chap=utf8_decode($p->pageChapter);
		$text=utf8_decode($p->pageText);
		$note=utf8_decode($p->pageNote);
			
		// Affichage texte (chapitre, titre, texte)
		
		if ($t == $chap) {
				$pageTitle = format_pagetext ($t, "80");
				print "<pre><center><strong>$pageTitle</strong></center></pre>";
			} 
		else {
			if(($p->pageChapter)!="") {
				$pageChapter = format_pagetext ($chap, "80");
				print "<pre><center><strong>$pageChapter</strong></center></pre>";
			}
		}
		
		$pageText =  format_pagetext ($text,"120");
		$pageNote =  format_pagetext ($note, "80");
			
		if ($search==yes) {
			$pageTextHighlight = eregi_replace($query,"<b style=\"border-bottom-style: solid; border-bottom-width: 3px;\">$query</b>",$pageText);
			print "
				<pre>$pageTextHighlight</pre>
			";
			if ($note) {
				$pageNoteHighlight = eregi_replace($query,"<b style=\"border-bottom-style: solid; border-bottom-width: 2px;\">$query</b>",$pageNote);
				print "<hr>
					<pre><font class=\"note\">$pageNoteHighlight</font></pre>
				";
			}
		}
		else {
	
			print "<pre>$pageText</pre>";
		
			// Affichage des notes de page
			if ($note)
				print "<hr><pre><font class=note>$pageNote</font></pre>";
			print "		</td>";
		}
		

		
		// Affichage facsimile et figure(s)
		if ($p->pageImage) {
			$img=$rauteur."i-corpuspic/tab/".$desc."/$bookid/vig/".$p->pageImage;
			$urltitle=urlencode($title);
			$ch=urlencode($chap);
			print "	<td valign=\"top\" width='200'>
						<div align=\"center\"><p>
							<a href=\"$_SERVER[PHP_SELF]?type=$type&page=$page&facsimile=on&book=$bookid&title=$urltitle&chap=$ch\">
								<img border=\"0\" src=\"$img\" alt=\"&copy CRHST-CNRS\">
							</a></p>";
							
			if ($p->figure['fig1']) {
				$fig1=$p->figure['fig1'];
				$fig=$rauteur."i-corpuspic/tab/".$desc."/$bookid/vig/".$fig1;
				print "		<p>
							<a href=\"$_SERVER[PHP_SELF]?type=$type&page=$page&facsimile=off&book=$bookid&title=$urltitle&chap=$ch&fig=$fig1\">
								<img border=\"0\" src=\"$fig\" alt=\"&copy CRHST-CNRS\"></img>
							</a></p>";
			}
			
			if ($p->figure['fig2']) {
				$fig2=$p->figure['fig2'];
				$fig=$rauteur."i-corpuspic/tab/".$desc."/$bookid/vig/".$fig2;
				print "		<p>
							<a href=\"$_SERVER[PHP_SELF]?type=$type&page=$page&facsimile=off&book=$bookid&title=$urltitle&chap=$ch&fig=$fig2\">
								<img border=\"0\" src=\"$fig\" alt=\"&copy CRHST-CNRS\"></img>
							</a></p>";
			}
			
			if ($p->figure['fig3']) {
				$fig3=$p->figure['fig3'];
				$fig=$rauteur."i-corpuspic/tab/".$desc."/$bookid/vig/".$fig3;
				print "		<p>
							<a href=\"$_SERVER[PHP_SELF]?type=$type&page=$page&facsimile=off&book=$bookid&title=$urltitle&chap=$ch&fig=$fig3\">
								<img border=\"0\" src=\"$fig\" alt=\"&copy CRHST-CNRS\"></img>
							</a></p>";
			}
			
			print "		</div>
					</td>
			</tr>";
		}
	}
	
	// Affichage facsimile seul
	if ($_GET['facsimile'] == 'on') {
		$img1=$rauteur."i-corpuspic/tab/".$desc."/$bookid/".$p->pageImage;
		$urltitle=urlencode($title);
		$ch=urlencode($chap);
		print "
			<table width='860' class='tdf'>
				<tr>
					<td>
						<a lang=\"$lang\" href=\"$_SERVER[PHP_SELF]?page=$page&type=$type&book=$bookid&facsimile=off&title=$urltitle&chap=$ch\">";
						
		if ($lang == 'fr') print "retour au texte";
		if ($lang == 'en') print "back to text";
		print "			</a>
					</td>
				</tr>
				<tr>
					<td >
						<div align=\"center\">
							<a lang=\"$GET_[lang]\" href=\"$_SERVER[PHP_SELF]?page=$page&type=$type&book=$bookid&facsimile=off&title=$urltitle&chap=$ch\">
								<img border=\"0\" src=\"$img1\" alt=\"&copy CRHST-CNRS\">
							</a>
						</div>
					</td>
				</tr>";
	}
}

function ice_page_view_image ($doctype,$search,$query,$page,$number,$lang,$bookid,$tab,$rauteur,$type,$title,$chap,$cfzoom) {

	// Chargement de la page
	$p=simplexml_load_file($rauteur.$bookid."/".$page.".xml");
	$pn=$p->pageOrder;
	
	$img=$rauteur."i-corpuspic/tab/".$tab[$type-1]."/$bookid/".$p->pageImage;
	$vig=$rauteur."i-corpuspic/tab/".$tab[$type-1]."/$bookid/vig/".$p->pageImage;
	
	// Image seule
	if (($p->pageImage!="") AND (!$p->pageText)) {
	
		// Navigation pages
		nextprevi_page ($bookid,$page,$number,$rauteur,$type,$title,$chap,$lang,$doctype,$tab,$search);
	
		// Utilisation de la GD 2.0
		list($width, $height, $type1, $attr) = getimagesize($img);
			if (!$cfzoom)
				$width_data = $width/2;
			else
				$width_data = $width/$cfzoom;
			
		$urltitre=urlencode($title);
		
		// Affichage image
		print "
			<table width=\"860\" class='tdc'>
				<tr>
					<td>
						<a href='ice_book_detail.php?book=$bookid&num=0&type=$type&title=$urltitre'>";
						
		if ($lang == 'fr') print "retour au plan du document<br><br>";
		if ($lang == 'en') print "back to document's plan<br><br>";	
		
		print "			</a>
					</td>
				</tr>
				<tr>
					<td>
					zoom :  
						<a href=\"ice_page_detail.php?doctype=img&page=$pn&type=$type&book=$bookid&nump=$_GET[nump]&nav=1&cfzoom=1&title=$title\">100%</a>
						<a href=\"ice_page_detail.php?doctype=img&page=$pn&type=$type&book=$bookid&nump=$_GET[nump]&nav=1&cfzoom=1.5&title=$title\">75%</a>
						<a href=\"ice_page_detail.php?doctype=img&page=$pn&type=$type&book=$bookid&nump=$_GET[nump]&nav=1&cfzoom=2&title=$title\">50%</a>
						<a href=\"ice_page_detail.php?doctype=img&page=$pn&type=$type&book=$bookid&nump=$_GET[nump]&nav=1&cfzoom=2.5&title=$title\">25%</a>
						<br><br>
					</td>
				</tr>
				<tr>
					<td align=\"center\">
						<center><img width=\"$width_data\" src=\"$img\" alt=\"&copy 2003 - CRHST\"></center><br><br>
					</td>
				</tr>
			</table>";
	}
	
	// Texte et image
	if (($p->pageImage) AND ($p->pageText))
		ice_page_view_texte ($page,$number,$bookid,$rauteur,$type,$title,$chap,$lang,$doctype,$tab,$search,$query);
		
}
?>