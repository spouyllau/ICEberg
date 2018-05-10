<? 

include("config.php");
include("entete.php");

include("menu.php");
print "
$tablestyle
			<tr>
				<td class='tdf'>";
		
	// Affichage auteur
	print "			<b>Oeuvres de $head_title</b>";

print "			</td>
			</tr>
			<tr>
				<td class='tdc'>";

	// Affichage type de books
	print "<ul>";
	for ($i=0;$i<count($tabTypefr);$i++) {
		$t=$i+1;
		print "		<li>".$t." : <a href='ice_book_list.php?num=0&type=$t'>$tabTypefr[$i]</a>
					- $tabTypeen[$i]
					- $tabIcon[$i]
					<br>";
	}
	print "</ul>";
	
print "			</td>
			</tr>
		</table>";
		
include("fin_de_page.php");
	
?>