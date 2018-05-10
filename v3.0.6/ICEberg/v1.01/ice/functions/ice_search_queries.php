<?php
function ice_words_search ($lang,$bdd,$table,$bool,$q1,$q2) {
	ice_connexion("$bdd");
	$sql = "SELECT * FROM ".$table."_page INNER JOIN ".$table."_book ";
	$sql .= "ON ".$table."_page.bookId = ".$table."_book.bookId ";
	$sql .= "WHERE ((".$table."_page.pageText LIKE '% $q1 %') OR (".$table."_page.pageNote LIKE '$q1'))";
	//$sql .= "$bool ((".$table."_page.pageText LIKE ' $q2 ') OR (".$table."_page.pageNote LIKE ' $q2 '))";
	$result = mysql_query($sql);
	$Nmax = 10; // nombre de page par defaut	$Ncur = 0; // n° de la fiche courante	// 1ère fiche transmise par l'URL	$Ndeb = 0;
	if(isset($_GET['num'])) {
		$Ndeb=intval($_GET['num']);
	}
	$num = mysql_num_rows($result);
	while (($val = mysql_fetch_array($result)) && ($Ncur<$Nmax+$Ndeb)) {
		if($Ncur>=$Ndeb) {
		print "&#8226; ";
			if ($val[bookAuthorName]) {
				print "$val[bookAuthorName],";
			}
			if ($val[bookAuthorSurname]) {
				print "$val[bookAuthorSurname],";
			}
		print "<strong><a href=\"ice_page_detail.php?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&bookId=$val[bookId]&pageOrder=$val[pageOrder]&facsimile=off&search=yes&q1=$_GET[q1]\">
		$val[bookShortTitle]</strong></a></strong>, p. $val[pageNumber].<br />
		";
		highlight ("$q1","$val[pageText]");
		print "<hr />
		";
		} $Ncur++;
	}
		//
		if($Ndeb > 0) {
		$lesprecedentes = $Ndeb-$Nmax;
		print "<a href=\"$_SERVER[PHP_SELF]?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&typeofbookId=$_GET[typeofbookId]&q1=$_GET[q1]&num=$lesprecedentes\"><< </a>";
		} else {}
		print "$Ncur d. / $num"; 
		// Des fiches après ?
		if($val) {
		print "<a href=\"$_SERVER[PHP_SELF]?lang=$_GET[lang]&type=$_GET[type]&bdd=$_GET[bdd]&table=$_GET[table]&typeofbookId=$_GET[typeofbookId]&q1=$_GET[q1]&num=$Ncur\"> >></a>";
		} else {}
	mysql_free_result($result);
	mysql_close();
}
function highlight ($q1,$pageText) {
		eregi(".{35}$q1.{35}",$pageText,$sequence);
		$seqbefore = strstr($sequence[0], ' ');
		$seqspace = eregi_replace(" ","&nbsp;",$seqbefore);
		$seqafter = strrchr($seqspace, '&nbsp;');
		$phrase = eregi_replace("$seqafter$","",$seqspace);
		$highlight =  eregi_replace("$q1","<font class=\"highlight\">$q1</font>",$phrase);
		print "<font class=\"extrait\">... $highlight ...</font><br />";
		$highlight = 0;
}
?>