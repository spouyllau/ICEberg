<?php
// Menu
print "
<table>
<tr>
	<td>"; 
	if ($lang=="fr") {
		print "Accueil";
	}
	if ($lang=="en") {
		print "Home";
	}
	print "</td>
</tr>
<tr>
	<td>"; 
	if ($lang=="fr") {
		print "--";
	}
	if ($lang=="en") {
		print "--";
	}
	print "</td>
</tr>
<tr>
	<td>"; 
	if ($lang=="fr") {
		print "Publications";
	}
	if ($lang=="en") {
		print "Papers";
	}
	print "</td>
</tr>
<tr>
	<td>"; 
	if ($lang=="fr") {
		print "Crédits";
	}
	if ($lang=="en") {
		print "Team";
	}
	print "</td>
</tr>
<tr>
	<td>"; 
	if ($lang=="fr") {
		print "Intranet";
	}
	if ($lang=="en") {
		print "Intranet";
	}
	print "</td>
</tr>
</table>";
?>