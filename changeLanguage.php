<?php
if(isset($_POST["submitLanguage"])) {
	if ($_COOKIE['language'] == "fr") {
		setcookie("language", "en", time()+3600*24);
	} else {
		setcookie("language", "fr", time()+3600*24);
	}
}
header("Location: index.php");   
?>