<?php

function ice_typeofbook ($tabType) {
	for($i=0;$i<count($tabType);$i++) {
		$type=$tabType[$i];
		$tind=$i+1;
		print "<a href='ice_book_list.php?num=0&type=$tind'>[$type]</a> &#8226;";
	}
}

function ice_list_book ($type,$rep,$num) {
	// Compteur du nombre de books
	$cpt=0; 
	
	// Chargement du fichier XML
	$books=simplexml_load_file($rep); 
	
	// Nombre de pages par type
	$Nmax = 10;
	$Ndeb = $num;
	$Ncur = 0;

	// Recuperation des books
	foreach ($books->book as $book) {
		if ($book->typeOfBook['id']==$type) {
			$titre=utf8_decode($book->title['short']);
			$urltitre=urlencode($titre);
			if ($book->bookDate == "") {
				$tabBook[]= "<a href='ice_book_detail.php?book=$id&num=0&type=$type&title=$urltitre'>$titre</a>";
			}
			else {
				$id=$book->id;
				$tabBook[]= $book->bookDate.", <b><a href='ice_book_detail.php?book=$id&num=0&type=$type&title=$urltitre'>$titre</a></b><br>";
			}
			$cpt++;
		}
	}
	
	// Affichage
	print "<ul>";
	while ($Ncur<$cpt && ($Ncur<$Nmax+$Ndeb)) {
		if($Ncur>=$Ndeb) {
			print "<li>$tabBook[$Ncur]<br>";
		} 
		$Ncur++;
	}
	print "</ul>";
	
	// Navigation
	nextprevi($cpt,$Ndeb,$Nmax,$Ncur,$type);
}
	
function ice_detail_book ($bookId,$rep,$lang,$rauteur) {
	// Chargement du fichier XML
	$books=simplexml_load_file($rep); 
	
	// Recupère les infos du Book
	foreach ($books->book as $book) {
	
		if ($book->id==$bookId) {
			// Infos Titre
			$shorttitle=utf8_decode($book->title['short']);
			$title=utf8_decode($book->title['name']);
			$collec=utf8_decode($book->title['collection']);
			
			// Infos Auteur
			$author=utf8_decode($book->author['name'])." ".utf8_decode($book->author['surname']);
			
			// Autres infos du Book
			$editor=utf8_decode($book->editor)." ".utf8_decode($book->placeEditor);
			$pages=utf8_decode($book->pagesNumber);
			$cover=$book->coverImage;
			$date=$book->bookDate;
			$obs=utf8_decode($book->bookObservations);
			$url=$book->format['url'];
			$doc=$book->format['doc'];
			$pdf=$book->format['pdf'];
		}
		
	}
	
	// En français
	if ($lang == "fr") {
		print "
		<tr>
			<td class=\"tdi\" width=\"20%\">Titre :</td>
			<td class=\"tdi\"><b>$title</b></td>
		</tr>
		<tr> 
			<td class=\"tdi\" width=\"20%\">Auteur :</td>
			<td class=\"tdi\"><b>$author</b></td>
		</tr>";
		if ($pages) { 
			print "<tr>
			<td class=\"tdi\" width=\"20%\">Format :</td>
			<td class=\"tdi\">$pages</td>
		</tr>"; 
		}
		print "
		<tr>
		<td class=\"tdi\" width=\"20%\">Editeur :</td>
		<td class=\"tdi\">$editor</td>
		</tr>
		<tr> 
		<td class=\"tdi\" width=\"20%\">Date :</td>
		<td class=\"tdi\">$date</td>
		</tr>
		<tr>
		<td class=\"tdi\" width=\"20%\">Observations :</td>
		<td class=\"tdi\">$obs</td>
		</tr>
		";
	}
	
	// En anglais
	if ($lang == "en") {
		print "
		<tr>
		<td class=\"tdi\" width=\"20%\">Title :</td>
		<td class=\"tdi\">$title</td>
		</tr>
		<tr> 
		<td class=\"tdi\" width=\"20%\">Author :</td>
		<td class=\"tdi\">$author</td>
		</tr>";
		if ($pages) { 
			print "<tr>
			<td class=\"tdi\" width=\"20%\">Page(s) :</td>
			<td class=\"tdi\">$pages</td>
		</tr>"; 
		}
		print "
		<tr>
		<td class=\"tdi\" width=\"20%\">Editor :</td>
		<td class=\"tdi\">$editor</td>
		</tr>
		<tr> 
		<td class=\"tdi\" width=\"20%\">Date :</td>
		<td class=\"tdi\">$date</td>
		</tr>
		<tr>
		<td class=\"tdi\" width=\"20%\">Observations :</td>
		<td class=\"tdi\">$obs</td>
		</tr>
		<tr>
		<td class=\"tdi\" width=\"20%\">Digitalized document :</td>
		<td class=\"tdi\">
		"; 
	}
	
	if ($doc OR $pdf) {
		print "
		<tr>
		<td class=\"tdi\" width=\"20%\">Document en texte intégral téléchargeable :</td>
		<td class=\"tdi\">";
	}
	if ($doc AND $url){
			print "<img src=\"ico/word.gif\" border=\"0\" alt=\"icone de téléchargement doc/rtf\" />
					<a href=\"$rauteur/$url$doc\" lang=\"$lang\">
						$doc
					</a><br />";
	} 
	if ($pdf AND $url){
			print "<img src=\"ico/pdf.gif\" border=\"0\" alt=\"icone de téléchargement pdf\" />
					<a href=\"$rauteur/$url$pdf\" lang=\"$lang\">
						$pdf
					</a><br />";
	}
	
		print "
		</td>
		</tr>";
}

function ice_list_pages($repBook) {
	// Se positionne sur le repertoire
	$dir=@opendir($repBook);

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

function ice_detail_book_mat ($lang,$bookId,$rauteur,$type,$title) {
	$repBook="$rauteur$bookId/";
	$urltitle=urlencode($title);
	
	// Tableau des pages
	$tabPages=ice_list_pages($repBook);
	
	// Parcours de chaque page du tableau
	for ($i=0;$i<count($tabPages);$i++) {
	
		// Chargement du fichier XML
		$page=simplexml_load_file($repBook.$tabPages[$i]); 
		$chap=$page->pageChapter;
		if ($chap!="") {
			$chap=utf8_decode(str_replace("\\r\\n", " ", $chap));
			$ch=urlencode($chap);
			$po=$page->pageOrder;
			$pn=$page->pageNumber;
			print "
				<tr>
					<td class=\"tdf\"><a href=\"ice_page_detail.php?page=$po&number=$pn&type=$type&book=$bookId&facsimile=off&title=$urltitle&chap=$ch\">".$chap."</a></td>
					<td class=\"tdf\" width='10%' align='center'> p ".$pn.".</td>
				</tr>";
		}
	}
} 

function ice_detail_book_gal ($lang,$rauteur,$bookId,$type,$title,$tabTypefr) {
	$repBook="$rauteur$bookId/";
	$urltitle=urlencode($title);
	$tabPages=ice_list_pages($repBook);
	
	// Nombre total de pages donc d'images [comptage des résultats]
	$cpt=count($tabPages);

	// découpage par bloc de 12
	$Nmax = 10; // nombre par page par defaut
	$Ncur = 0; // n° de la fiche courante
	
	// 1ère fiche transmise par l'URL
	$Ndeb = 0; 
	if(isset($_GET['nump']))
	   $Ndeb=intval($_GET['nump']);
	
	// Type
	$ind=$type-1;
	$desc=$tabTypefr[$ind];

	// affichage de la mosaïque
	if ($result >= 0) {
		echo "<tr align='center' class='tdf'><td><br>";
		while (($Ncur<$cpt) && ($Ncur<$Nmax+$Ndeb)) {
			if($Ncur>=$Ndeb) {
			
				// Chargement du fichier XML
				$page=simplexml_load_file($repBook.$tabPages[$Ncur]); 
				$po=$page->pageOrder;
				$pn=$page->pageNumber;
				$img=$rauteur."i-corpuspic/tab/$desc/$bookId/vig/".$page->pageImage;	
				
				//if ($img!="") {
				print "<a href=\"ice_page_detail.php?doctype=img&page=$po&number=$pn&type=$type&book=$bookId&nump=$_GET[nump]&nav=1&cfzoom=2&title=$title&facsimile=off\">
								<img src=\"$img\" border=\"0\" alt=\"&copy; 2004 CNRS/CRHST - ID:$pn\" align=\"absmiddle\"></a>
								";
							//}
				if ($Ncur+1==$Nmax/2)
					echo "<br><br>";
			} 
			$Ncur++;
		}
		print "<br><br></td></tr><tr align='center' class='tdf'><td>";
		
		// Navigation
		nextprevi_gal($cpt,$Ndeb,$Nmax,$Ncur,$type,$title,$bookId);
		print "</td></tr>";	
	}
}

?>