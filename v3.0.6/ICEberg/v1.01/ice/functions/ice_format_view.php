<?php
function nextprevi ($lang,$num,$Ndeb,$Nmax,$Ncur,$val) {
		if($Ndeb > 0) {
		$lesprecedentes = $Ndeb-$Nmax;
		print "<a href=\"ice_book_list.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&typeofbookId=$_GET[typeofbookId]&num=$lesprecedentes\"><< </a>";
		} else {}
		print "$Ncur d. / $num"; 
		// Des fiches après ?
		if($val) {
		print "<a href=\"ice_book_list.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&typeofbookId=$_GET[typeofbookId]&num=$Ncur\"> >></a>";
		} else {}
}
function nextprevi_gal ($lang,$nump,$Ndeb,$Nmax,$Ncur,$val) {
		if($Ndeb > 0) {
			$lesprecedentes = $Ndeb-$Nmax;
			print "<a href=\"ice_book_detail.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&typeofbookId=$_GET[typeofbookId]&num=$_GET[num]&nump=$lesprecedentes\"><< </a>";
		} else {}
		$Npag = ceil($nump/$Nmax);
		for($i = 1;$i<=$Npag;$i++) {
			if($Ndeb == ($i-1)*$Nmax) {
				print " <strong>[$i]</strong> ";
			} else {
				$pageavoir = ($i-1)*$Nmax;
				print " <a href=\"ice_book_detail.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&typeofbookId=$_GET[typeofbookId]&num=$_GET[num]&&nump=$pageavoir\">$i</a> ";
			}
		}
		// Des fiches après ?
		if($val) {
			print "<a href=\"ice_book_detail.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&typeofbookId=$_GET[typeofbookId]&num=$_GET[num]&&nump=$Ncur\"> >></a>";
		} else {}
}
function format_pagetext ($string,$cols,$prefix) {
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
		    } else {
			$newline .= $thisword." ";
		    }
		}

		$outlines .= $prefix.$newline."\n";
	    } else {
		$outlines .= $prefix.$thisline."\n";
	    }
	}
	return $outlines;
}
function nextprevi_page ($lang,$bdd,$table,$bookId,$pageOrder,$pageNumber) {
// -----------------------
// navigation dans les pages
// -----------------------
$pageNumberp = $_GET['pageOrder'] - 1;
$pageNumbers = $_GET['pageOrder'] + 1;
// -----------------------
// premiere page
// -----------------------
$sqlprepage = "SELECT pageNumber, pageOrder FROM ".$table."_page WHERE bookId=$_GET[bookId] ORDER BY pageOrder ASC LIMIT 0,1";
$prepagequery = mysql_query($sqlprepage);
$prepagval = mysql_fetch_array($prepagequery);
$prepag = $prepagval['pageOrder'];
mysql_free_result($prepagequery);
// -----------------------
// navigation
// -----------------------
$sqlderpage = "SELECT pageNumber, pageOrder FROM ".$table."_page WHERE bookId=$_GET[bookId] ORDER BY pageOrder DESC LIMIT 0,1";
$derpagequery = mysql_query($sqlderpage);
$derpagval = mysql_fetch_array($derpagequery);
$derpag = $derpagval['pageOrder'];
mysql_free_result($derpagequery);
print "
<table width=\"100%\">
<tr>
	<td width=\"230\" class=\"tdf\" align=\"left\">Page : <strong>$pageNumber</strong></td>
	<td class=\"tdc\" align=\"left\">
				";
				if ($pageNumberp >= $prepag) {
					print "<a href=\"$_SERVER[PHP_SELF]?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&typeofbookDes=$_GET[typeofbookDes]&pageOrder=$prepag&facsimile=$_GET[facsimile]&search=no\">
					<strong>|<</strong></a>&nbsp;";
				} else { }
				if ($pageNumberp >= $prepag) {
					print "<a href=\"$_SERVER[PHP_SELF]?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&typeofbookDes=$_GET[typeofbookDes]&pageOrder=$pageNumberp&facsimile=$_GET[facsimile]&search=no\">
					<strong><<</strong></a>&nbsp;";
				} else { }
				print "Page : <strong>$pageNumber</strong>";
				// page suivante
				if ($pageNumbers <= $derpag) {
					print "&nbsp;<a href=\"$_SERVER[PHP_SELF]?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&typeofbookDes=$_GET[typeofbookDes]&pageOrder=$pageNumbers&facsimile=$_GET[facsimile]&search=no\"><strong>>></strong></a>";
				} else { }
				// dernière page
				if ($pageNumbers <= $derpag) {
					print "&nbsp;<a href=\"$_SERVER[PHP_SELF]?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$_GET[bookId]&typeofbookDes=$_GET[typeofbookDes]&pageOrder=$derpag&facsimile=$_GET[facsimile]&search=no\"><strong>>|</strong></a>";
				} else { }
				print "
	</td>
</tr>
</table>";
}
?>