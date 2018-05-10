<?php

include("functions/ice_book_queries.php");
include("functions/ice_format_view.php");
include("config.php");
include("entete.php");

$type=$_GET['type'];
$title=stripslashes($_GET['title']);
$ind=$type-1;

include("menu.php");
print "
$tablestyle
<tr>
	<td class='tdc' colspan='2'>
		[<a href='ice_book_list.php?num=0&type=$type'>$tab[$ind]</a>] &#8226; <em>$title</em>
	</td>
</tr>";
	ice_detail_book($_GET['book'],$rep,$lang,$rauteur);
print "
</table>";

if ($doctype=="img") {
	print "
$tablestyle
	<tr><td colspan='2' class='tdf' align='center'>Liste des images / Plan du document</td></tr>
	<tr><td>";
		ice_detail_book_gal($lang,$rauteur,$_GET['book'],$type,$title,$tabTypefr);
	print "
		</td>
	</tr>
</table>";
}

if ($doctype=="text") {
	print "
$tablestyle
	<tr>
		<td colspan='2' class='tdf' align='center'>Table des matières / Plan du document</td>
	</tr>";
	ice_detail_book_mat($lang,$_GET['book'],$rauteur,$type,$title);
print "
</table>";
}

include("fin_de_page.php");

?>