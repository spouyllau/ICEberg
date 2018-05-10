<?

$fbook="Book.xml";
$ftype="TypeOfBook.xml";

if(!isset($_GET['lang']))
	$lang="fr";
else
	$lang=$_GET['lang'];
	
if(!isset($_GET['doctype']))
	$doctype="text";
else
	$doctype=$_GET['doctype'];
	
// * L'auteur *
$rauteur="Lamarck/";
$rep=$rauteur.$fbook;
$name="Jean-Baptiste Lamarck";
$date="(1744-1829)";

// * Liste des types of Book * (l'id correspond à l'indice+1 des tableaux)	
$types = simplexml_load_file($ftype);

foreach ($types->typeOfBook as $unType) {
	$tabTypefr[]=utf8_decode($unType->typeDes);
	$tabTypeen[]=utf8_decode($unType->typeDesGb);
	$tabIcon[]=utf8_decode($unType->typeOfBookIcon);
}

// * tab correspond au tableau des types *
if ($lang=="fr")
	$tab=$tabTypefr;
if ($lang=="en")
	$tab=$tabTypeen;

// * Site web *
$head_title = "Oeuvres de $name $date";
$year = "2004";
$keywords = "ICE, ICE3";
$description = "ICE : gestion de corpus scientifique";

// * Couleurs *
$bodybgcolor = "#ffffff";
$colorf = "#339933";
$colorc = "#FFcccc";
$colori = "#cccccc";

// * Tableaux *
$tablecolor = "#ffffff";
$tablestyle = "<table bgcolor=\"$tablecolor\" width=\"860\" cellpadding=\"5\">";

?>