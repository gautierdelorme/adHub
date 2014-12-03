<?php
session_start();
include "mysql.php";
if (isset($_SESSION["username"])) {
	session_destroy();
} else {
	if(isset($_POST["username"]) && !empty($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["password"])) {
		if ($results = $mysqli->query("SELECT * FROM site_user WHERE username = '".$_POST["username"]."' AND password = '".md5($_POST["password"])."'")) {
			$_SESSION["username"] = $_POST["username"];
			while ($row = $results->fetch_assoc()) {
				$_SESSION["userId"] = $row["id"];
			}
		}
	}
}
header("Location: index.php");  
?>