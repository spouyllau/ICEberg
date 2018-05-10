function verifBook(form){

if(form.title_short.value == ""){
	alert("Fill the short title");
	form.title_short.focus();
	return false;
}

if(form.author_name.value == ""){
	alert("Fill the author name");
	form.author_name.focus();
	return false;
}

return true;
}