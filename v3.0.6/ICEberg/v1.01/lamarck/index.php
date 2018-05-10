<?php
include("config.php");
include("entete.php");
print "<table border=1 width=\"100%\">
<tr>
	<td width=\"200\">&nbsp;</td>
	<td>
		<h1>$site_title</h1>
		<h2>$second_title</h2>
	</td>
</tr>
<tr>
	<td width=\"200\">
	<!-- Menu -->";
	include("menu.php");
	print "
	</td>
	<td>
	<!-- Data -->
	</td>
</tr>
</table>";
include("fin_de_page.php");