<?php
session_start();
include "mysql.php";
function check($var) {
	return isset($var) && !empty($var);
}
if (isset($_SESSION["username"]) && check($_POST["nomFrench"]) && check($_POST["nomEnglish"]) && check($_POST["prixPost"]) && check($_POST["categoriePost"])
	&& check($_POST["descriptionFrench"]) && check($_POST["descriptionEnglish"]) && check($_POST["latitude"]) && check($_POST["longitude"])) {
	$mysqli->query("INSERT INTO site_annonce VALUES (DEFAULT, '".$_POST["nomFrench"]."', '".$_POST["nomEnglish"]."', '".$_POST["descriptionFrench"]."',
		'".$_POST["descriptionEnglish"]."', ".$_POST["prixPost"].",'".$_POST["categoriePost"]."', '".$_SESSION["userId"]."',
		'".$_POST["latitude"]."', ".$_POST["longitude"].", NOW())");
}
header("Location: index.php");
?>