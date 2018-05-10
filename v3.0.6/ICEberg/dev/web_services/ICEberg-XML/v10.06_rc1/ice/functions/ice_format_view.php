<?php

function nextprevi ($num,$Ndeb,$Nmax,$Ncur,$type) {
	// Navigation précédente
	if($Ndeb > 0) {
		$lesprecedentes = $Ndeb-$Nmax;
		print "<a href='ice_book_list.php?type=$type&num=$lesprecedentes'><< </a>";
	}
	
	// Page courante
	print "$Ncur d. / $num"; 
	
	// Des fiches après ?
	if($Ncur<$num)
		print "<a href='ice_book_list.php?type=$type&num=$Ncur'> >></a>";
}

function nextprevi_gal ($num,$Ndeb,$Nmax,$Ncur,$type,$title,$bookId) {
	// Navigation précédente
	if($Ndeb > 0) {
		$lesprecedentes = $Ndeb-$Nmax;
		print "<a href=\"ice_book_detail.php?type=$type&book=$bookId&nump=$lesprecedentes&title=$title\"><<</a>";
	}
	
	// Nombre de pages
	$Npag = ceil($num/$Nmax);
	
	for($i = 1;$i<=$Npag;$i++) {
		if($Ndeb == ($i-1)*$Nmax)
			print " <strong>[$i]</strong> ";
		else {
			$pageavoir = ($i-1)*$Nmax;
			print " <a href=\"ice_book_detail.php?type=$type&book=$bookId&nump=$pageavoir&title=$title\">$i</a> ";
		}
	}
	
	// Des fiches après ?
	if($Ncur<$num)
		print "<a href=\"ice_book_detail.php?type=$type&book=$bookId&nump=$Ncur&title=$title\"> >></a>";
}

function format_pagetext ($string,$cols) {
	
	$t_lines = split( "\n", $string);

    $outlines = "";

	while(list(, $thisline) = each($t_lines)) {
	    if(strlen($thisline) > $cols) {
			$newline = "";
			$t_l_lines = split(" ", $thisline);

			while(list(, $thisword) = each($t_l_lines)) {
				while((strlen($thisword) + strlen($prefix)) > $cols) {
					$cur_pos = 0;
					$outlines .= $prefix;

					for($num=0; $num < $cols-1; $num++) {
						$outlines .= $thisword[$num];
						$cur_pos++;
					}

					$outlines .= "\n";
					$thisword = substr($thisword, $cur_pos, (strlen($thisword)-$cur_pos));
				}

				if((strlen($newline) + strlen($thisword)) > $cols) {
					$outlines .= $prefix.$newline."\n";
					$newline = $thisword." ";
				} 
				else
					$newline .= $thisword." ";
			}

			$outlines .= $prefix.$newline."\n";
	    }
		else
			$outlines .= $prefix.$thisline."\n";
	}
	$outlines=str_replace("\\r\\n","<br>",$outlines);
	return $outlines;
}

function nextprevi_page ($bookid,$page,$number,$rauteur,$type,$title,$chap,$lang,$doctype,$tab,$search) {

	$rep=$rauteur.$bookid."/";
	$tabPages=ice_list_pages($rep);

	// page courante $tabPages[$i]
	for ($i=0;$i<count($tabPages);$i++) {
		$pg=simplexml_load_file($rep.$tabPages[$i]);
		if ($pg->pageOrder == $page)
			break;
	}

	// -----------------------
	// premiere page
	// -----------------------
	$pp=simplexml_load_file($rep.$tabPages[0]);
	$prepag = $pp->pageOrder;
	$prepagNumber = $pp->pageNumber;

	// -----------------------
	// derniere page
	// -----------------------
	$nb=count($tabPages)-1;
	$dp=simplexml_load_file($rep.$tabPages[$nb]);
	$derpag = $dp->pageOrder;
	$derpagNumber = $dp->pageNumber;
	
	// -----------------------
	// navigation dans les pages
	// -----------------------
	if ($i) {
		$pagep=simplexml_load_file($rep.$tabPages[$i-1]);
		$pageNumberp = $pagep->pageNumber;
		$pageOrderp=$pagep->pageOrder;
	}

	if ($i!=$nb) {
		$pages=simplexml_load_file($rep.$tabPages[$i+1]);
		$pageNumbers = $pages->pageNumber;
		$pageOrders=$pages->pageOrder;
	}
	else
		$derniere=true;

	$facsimile=$_GET['facsimile'];
	
	print "		<table width='860' height='50' border='0'><tr valign=\"center\" class='tdc'>";
	if (($doctype == "text")) {
		print "	
		
		<form method=\"GET\" action=\"$_SERVER[PHP_SELF]\">
		<td align=\"left\" valign=\"middle\"><input type=\"hidden\" name=\"type\" value=\"$type\">
		<input type=\"hidden\" name=\"lang\" value=\"$lang\">
		<input type=\"hidden\" name=\"book\" value=\"$bookid\">
		<input type=\"hidden\" name=\"title\" value=\"$title\">
		<input type=\"hidden\" name=\"search\" value=\"$search\">
		<input type=\"hidden\" name=\"typeofbookDes\" value=\"".$tab[$type-1]."\">
		<input type=\"hidden\" name=\"facsimile\" value=\"$_GET[facsimile]\">
		";	
	
		if ($lang == "fr") { print "Aller à la page : "; }
		if ($lang == "en") { print "Page browser : "; }
		
		//liste déroulante pour naviguer
		print "
		<select name=\"page\">\n";
		for($i=0;$i<count($tabPages);$i++){
			$pageXML=simplexml_load_file($rep.$tabPages[$i]);
			$chain = utf8_decode($pageXML->pageChapter);
			$chain = utf8_decode(str_replace("\\r\\n"," ",$pageXML->pageChapter));
			if(!empty($chain)){ //Si la page est une tête de chapitre, on affiche le début du titre du chapitre dans la liste
				eregi("^.{12}",$chain,$debutchap);
				print "		<option value=\"$pageXML->pageOrder\" title=\"$chain\" ";
				if($pageXML->pageOrder == $page) //On positionne la liste sur la page en cours
					print "selected";
				print ">$debutchap[0]..., p.$pageXML->pageNumber</option>\n";
			}
			else{
				print "		<option value=\"$pageXML->pageOrder\" ";
				if($pageXML->pageOrder == $page) //On positionne la liste sur la page en cours
					print "selected";
				print ">&nbsp;&nbsp;p.$pageXML->pageNumber</option>\n";
			}
		}
		print "</select> ";
		if ($lang == 'fr') { print "<input type=\"submit\" style=\"width:40px;\" value=\"voir\">"; }
		if ($lang == 'en') { print "<input type=\"submit\" style=\"width:40px;\" value=\"go\">"; }
		print "</td></form>
		
		";
	}	
	print "<td width='25%' align='right'>";
	// Page précédente
	if ($pageOrderp >= $prepag)
		print "			<a href=\"$_SERVER[PHP_SELF]?page=$prepag&number=$prepagNumber&type=$type&chap=$chap&title=$title&book=$bookid&facsimile=$facsimile\">
							<strong>|<<</strong>
						</a>&nbsp;
		
		
		<a href=\"$_SERVER[PHP_SELF]?page=$pageOrderp&number=$pageNumberp&type=$type&chap=$chap&title=$title&book=$bookid&facsimile=$facsimile\">
							<strong><</strong>
						</a>&nbsp;";
	
	// Page courante
	print "Page : <strong>$number</strong>";
	
	// Page suivante
	if ($pageOrders <= $derpag && !$derniere)
		print "&nbsp;	<a href=\"$_SERVER[PHP_SELF]?page=$pageOrders&number=$pageNumbers&type=$type&chap=$chap&title=$title&book=$bookid&facsimile=$facsimile\">
							<strong>></strong>
						</a>&nbsp;
						
						<a href=\"$_SERVER[PHP_SELF]?page=$derpag&number=$derpagNumber&type=$type&chap=$chap&title=$title&book=$bookid&facsimile=$facsimile\">
							<strong>>>|</strong>
						</a>";
	print "			</td>
	</tr></table>";
}

?>