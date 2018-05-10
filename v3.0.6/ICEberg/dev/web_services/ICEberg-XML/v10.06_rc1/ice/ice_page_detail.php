<?php

include("functions/ice_book_queries.php");
include("functions/ice_page_queries.php");
include("functions/ice_format_view.php");
include("config.php");
include("entete.php");

//include("functions/ice_format_view.php");

$type=$_GET['type'];
$ind=$type-1;

if (isset($_GET['search']))
	$search=$_GET['search'];
else
	$search="no";

if (isset($_GET['query']))
	$query=stripslashes($_GET['query']);
else
	$query="";	

$title=urldecode(stripslashes($_GET['title']));
$urltitle=urlencode($title);
$id=$_GET['book'];
$p=simplexml_load_file("$rauteur$id/".$_GET['page'].".xml");
$chap1=utf8_decode($p->pageChapter);

if(isset($_GET['number']))
	$number=$_GET['number'];
else
	$number=$p->pageNumber;

include("menu.php");
print "$tablestyle
			<tr height='50'>
				<td class=\"tdi\">
					<a href='ice_book_list.php?num=0&type=$type'>$tab[$ind]</a> &#8226; 
					<a href='ice_book_detail.php?book=$id&num=0&type=$type&title=$urltitle'>$title</a>";
if($chap1) {
	$chap1=str_replace("\\r\\n"," ",$chap1);
	$chap1=stripslashes($chap1);
	print " &#8226; $chap1";
}

print "			</td>
			</tr>
		</table>

";

	ice_page_view_image ($doctype,$search,$query,$_GET['page'],$number,$lang,$id,$tab,$rauteur,$type,stripslashes($_GET['title']),$chap1,$_GET['cfzoom']);


print "
	</table>";

include("fin_de_page.php");

?>
