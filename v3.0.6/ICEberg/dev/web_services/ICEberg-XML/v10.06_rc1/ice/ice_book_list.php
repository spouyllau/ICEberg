<?php

include("functions/ice_book_queries.php");
include("functions/ice_format_view.php");
include("config.php");
include("entete.php");
include("menu.php");

print "
$tablestyle
<tr>
	<td class='tdc'>";
		ice_typeofbook($tab);
print "	
	</td>
</tr>
<tr>
	<td class='tdi'><br>";

	ice_list_book($_GET['type'],$rep,$_GET['num']);
print "		
	</td>
</tr>
</table>";

include("fin_de_page.php");

?>