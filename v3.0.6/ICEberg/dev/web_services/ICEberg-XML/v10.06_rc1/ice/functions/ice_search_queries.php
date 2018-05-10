<?php
function ice_words_search ($lang,$query,$rep,$rauteur,$tabTypes) {

	// Nombre de pages par type
	$Nmax = 10;
	$Ndeb = $_GET['num'];
	$Ncur = 0;
	$cpt=0;
	
	// Chargement du fichier XML (book)
	$books=simplexml_load_file($rep); 
	
	// Recuperation des books dans tabBook
	foreach ($books->book as $book) {
		$name="";
		$tabBook[] = $book->id;
		if($book->author['name'])
			$name=$book->author['name'].", ";
		$surname=$book->author['surname'].", ";
		
		// IdType
		$tabIdTypes[]=$book->typeOfBook['id'];
		
		// Book Id
		$tabBooksId[]=$book->id;
		
		// Titre livres
		$tabTitles[]=utf8_decode(str_replace('\r\n','',$book->title['short']));
		
		// Auteur
		$tabAuthor[]=$name.$surname;
	}
	
	// Recherche dans tous les books
	for ($i=0;$i<count($tabBook);$i++) {
		// $tabBook[$i] -> un book
		$tabPages = ice_list_pages($rauteur.$tabBook[$i]."/");
		
		for ($j=0;$j<count($tabPages);$j++) {
			// $tabPages[$j] -> une page
			$rpage=$rauteur.$tabBook[$i]."/".$tabPages[$j];
			
			// Chargement du fichier XML (page)
			$page=simplexml_load_file($rpage);
			
			// Recherche dans pageText et pageNote
			$txt=utf8_decode(str_replace('\r\n','',$page->pageText));
			$note=utf8_decode(str_replace('\r\n','',$page->pageNote));
			$po=$page->pageOrder;
			$pn=$page->pageNumber;

			$chap=utf8_decode(str_replace('\r\n','',$page->pageChapter));
			$ch=urlencode($chap);
			$bookId=$tabBooksId[$i];
			$type=$tabIdTypes[$i];

			$query=stripslashes($query);
			
			if($pos1 = stripos($txt,$query)) {
				if ($cpt>=$Ndeb && $Ncur<$Nmax) {
					print $tabAuthor[$i]."<a href=\"ice_page_detail.php?page=$po&number=$pn&type=$type&book=$bookId&facsimile=off&title=".urlencode($tabTitles[$i])."&chap=$ch&search=yes&query=$query\">".$tabTitles[$i]."</a>, p. $pn.<br>";
					highlight($query,$txt);
					$Ncur++;
					$cpt++;
				}
				else 
					$cpt++;
			}
			else {
				if($pos2 = stripos($note,$query)) {
					if ($cpt>=$Ndeb && $Ncur<$Nmax) {
						print $tabAuthor[$i]."<a href=\"ice_page_detail.php?page=$po&number=$pn&type=$type&book=$bookId&facsimile=off&title=".urlencode($tabTitles[$i])."&chap=$ch&search=yes&query=$query\">".$chap."</a>, p. $pn.<br>";
						highlight($query,$note);
						$Ncur++;
						$cpt++;
					}
					else
						$cpt++;
				}
			}
		}
	}
	
	$s=$Ncur+$Ndeb;
	if ($Ncur==0)
		print "Aucun résultat pour \"$query\"<br><br>";

	$query=urlencode($query);
	// Navigation précédente
	if($Ndeb > 0) {
		$lesprecedentes = $Ndeb-$Nmax;
		print "<a href='ice_search.php?query=$query&num=$lesprecedentes'><<</a>";
	}
	
	// Page courante
	print " $s d. / $cpt "; 
	
	// Des fiches après ?
	if($s<$cpt)
		print "<a href='ice_search.php?query=$query&num=$s'>>></a>";
		
}


function highlight ($q1,$pageText) {
		$nbCar=35;
		
		$exp='(.){0,'.$nbCar.'}'.$q1.'(.){0,'.$nbCar.'}';
		eregi($exp,$pageText,$sequence);

		$seqbefore = strstr($sequence[0], ' ');
		$seqspace = eregi_replace(" ","&nbsp;",$seqbefore);
		$seqafter = strrchr($seqspace, '&nbsp;');
		$phrase = eregi_replace("$seqafter$","",$seqspace);
		$highlight =  eregi_replace("$q1","<font class=\"highlight\">$q1</font>",$phrase);
		print "<font class=\"extrait\">... $highlight ...</font><br />";
		$highlight = 0;
		echo "<hr>";
}
?>