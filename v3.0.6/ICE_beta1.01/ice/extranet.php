<?php
session_start();
$_SESSION['nomsession']= "tyty";
echo "Valeur de 'nomsession': ";
echo $_SESSION['nomsession'];
echo session_id();
session_destroy();
?>
