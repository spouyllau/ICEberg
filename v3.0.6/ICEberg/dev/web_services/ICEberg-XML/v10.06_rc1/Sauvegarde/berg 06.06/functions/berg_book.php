<?php
// /////////////////////////////////////////////
// ICEberg v. 1.0
// author : Stephane POUYLLAU, CRHST/CNRS
// s.pouyllau@cite-sciences.fr
// /////////////////////////////////////////////
function berg_typebook ($ficTypesBook) {
		print "<option value='".$type->typeId."'>".utf8_decode($type->typeDes)."</option>";
	print "</select>";
}
function berg_list_book($ficBook,$typebook) {
			<tr align=\"center\">
				<td><strong>bookId</strong></td>
				<td><strong>BookTitle</strong></td>
				<td><strong>BookShortTitle</strong></td>
				<td colspan=\"2\">action</td>
			</tr>";
			<tr align=\"center\">
				<td align=\"center\" valign=\"top\">N�<strong>".$book->id."</strong></td>
				<td valign=\"top\" title=\"".utf8_decode($book->title['name'])."\"><strong>".utf8_decode($book->title['short'])."...</strong></td>
				<td valign=\"top\" title=\"".utf8_decode($book->title['short'])."\">".utf8_decode($bookShortTitle[0])."...</td>
				<form action=\"page.php\" method=\"post\" name=\"listbook\" target=\"mainFrame\">
					<input type=\"submit\" style=\"width:70px;\" title=\"list pages of this book\" value=\"list pages\" />
				
			</tr>\n";
print "</table>\n";
}
function berg_list_fields_book($action, $bookId, $typebook) {
	<form action=\"book_edit.php\" method=\"post\" name=\"formBook\" onSubmit=\"return verifBook(this);\">
		<td align=\"right\" valign=\"top\" title=\"bookId is automatic\">bookId : </td>
		<td><input type=\"text\" name=\"id\" size=\"3\" value=\"$id\" disabled=\"true\" /></td>
	   </tr>";
		<td align=\"right\" valign=\"top\">Book type : </td>
		<td><select name=\"typeOfBook\" size=\"1\">";
			print "<option value='".$type->typeId."'";
	print "</select></td>
	   </tr>";
			<td align=\"right\" valign=\"top\" rowspan=\"3\">Title : </td>
			<td>Short title<br/> <textarea cols=\"45\" rows=\"1\" name=\"title_short\">\n";
		<td align=\"right\" valign=\"top\" >Date : </td>
		<td><input type=\"text\" name=\"bookDate\" size=\"4\" value=\"";
	   </tr>\n";	
		<td align=\"right\" valign=\"top\" rowspan=\"2\">Author : </td>
		<td>Name : <br/><input type=\"text\" name=\"author_name\" size=\"40\" value=\"";
		</tr>
		</tr>";
		<td align=\"right\" valign=\"top\" rowspan=\"2\">Editor : </td>
		<td>Name : <br/><input type=\"text\" name=\"editor\" size=\"40\" value=\"";
		</tr>
		<td>City : <input type=\"text\" name=\"placeEditor\" size=\"34\" value=\"";
		</tr>";
		<td align=\"right\" valign=\"top\" >Number of pages : </td>
		<td><input type=\"text\" name=\"pagesNumber\" size=\"40\" value=\"";
	   </tr>\n";	
		<td align=\"right\" valign=\"top\" >Cover image : </td>
		<td><input type=\"text\" name=\"coverImage\" size=\"40\" value=\"";
	   </tr>\n";	
		<td align=\"right\" valign=\"top\" >Volume number : </td>
		<td><input type=\"text\" name=\"volNumber\" size=\"4\" value=\"";
	   </tr>\n";	
		<td align=\"right\" valign=\"top\">Book observations : </td>
		<td><textarea cols=\"45\" rows=\"3\" name=\"bookObservations\">\n";
		<td align=\"right\" valign=\"top\" rowspan=\"$max_numerisation_persons\">Numerisation : </td>\n";
	print "<td>Person ".($i+1)." : <br/><input type=\"text\" name=\"numerisation_person".($i+1)."\" size=\"40\" value=\"";
		</tr>\n";
		<td align=\"right\" valign=\"top\" >Book order : </td>
		<td><input type=\"text\" name=\"bookOrder\" size=\"4\" value=\"";
	   </tr>\n";
		<td align=\"right\" valign=\"top\" rowspan=\"2\">Download : </td>
		<td>Microsoft Word format :<br/><input type=\"text\" size=\"40\" name=\"format_doc\" value=\"";
		</tr>
		<td>Acrobat format : <br/><input type=\"text\" size=\"40\" name=\"format_pdf\" value=\"";
		</tr>\n";
		echo "$name : $node\n";
			   echo "<b>$attribute</b>=", $value, "\n<br>";
			}
	}
?>