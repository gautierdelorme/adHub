<?php
session_start();
include "mysql.php";
if (isset($_SESSION["username"])) {
	session_destroy();
} else {
	if(isset($_POST["username"]) && !empty($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["password"])) {
		if ($mysqli->query("SELECT * FROM site_user WHERE username = '".$_POST["username"]."' AND password = '".md5($_POST["password"])."'")) {
			$_SESSION["username"] = $_POST["username"];
		}
	}
}
header("Location: index.php");  
?>