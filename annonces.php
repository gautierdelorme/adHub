<?php
session_start();
include "mysql.php";
if(isset($_GET['query'])) {
	$q = mysqli_real_escape_string($mysqli, $_GET['query']);
	$regex = "[^a-zA-Z0-9]".$q."\w*";
	$regex2 = "^".$q."";
	$results = $mysqli->query("SELECT id FROM site_annonce WHERE description_fr REGEXP '".$regex."' OR description_fr REGEXP '".$regex2."'
		OR title_fr REGEXP '".$regex."' OR title_fr REGEXP '".$regex2."'
		OR description_en REGEXP '".$regex."' OR description_en REGEXP '".$regex2."'
		OR title_en REGEXP '".$regex."' OR title_en REGEXP '".$regex2."' ORDER BY date");
	while ($r = $results->fetch_assoc()) {
		$suggestions['suggestions'][] = $r['id'];
	}
	print json_encode($suggestions);
} else if (isset($_GET['load'])) {
	$q = mysqli_real_escape_string($mysqli, $_GET['load']);
	$loadedIds = explode(",", $q);
	$queryString = "SELECT * FROM site_annonce WHERE ";
	foreach ($loadedIds as $key => $value) {
		$queryString = $queryString."id = ".$value." OR ";
	}
	$queryString = substr($queryString, 0,-3);
	$queryString = $queryString."ORDER BY date LIMIT 3";
	$results = $mysqli->query($queryString);
	$i = 0;
	while ($r = $results->fetch_assoc()) {
		$suggestions['annonces'][$i] = $r;
		$resultsCat = $mysqli->query("SELECT * FROM site_option WHERE option_name = '".$suggestions['annonces'][$i]['category_option_name']."'");
		while ($rowCat = $resultsCat->fetch_assoc()) {
			$suggestions['categories'][] = $rowCat['option_'.$_COOKIE['language']];
		}
		$i++;
	}
	print json_encode($suggestions);
}
?>