<?php
session_start();
include "mysql.php";
if (!isset($_COOKIE['language'])) {
	setcookie("language", "en", time()+3600*24);
	$_COOKIE['language'] = "en";
}
echo '<?xml version="1.0" encoding="UTF-8"?>' ;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel = "stylesheet" href = "css/design.css" type = "text/css"/> <!-- lien vers la feuille de style -->
	<title>AdHub</title> 
</head> 
<body>
	<div class="header"> <!-- Entete du site -->
		<form id="formLanguage" action="changeLanguage.php" method="post">
			<input src="images/<? echo $_COOKIE['language']; ?>.jpg" type="image" value="submit" name="submitLanguage"/>
		</form>
		<h1>AdHub by Aristochats Team</h1> <!-- Titre important du site -->
		<div class="buttonsHeader"> <!-- Menu actions -->
			<div class="buttonFind">
				<p>
					<?php
					$results = $mysqli->query("SELECT * FROM site_menu WHERE id <= 3");
					$menuValue = array();
					while ($row = $results->fetch_assoc()) {
						array_push($menuValue, $row['item_'.$_COOKIE['language']]);
					}
					echo $menuValue[0];
					?>
				</p>
			</div>
			<div class="buttonPost">
				<p><?php echo $menuValue[1]; ?></p>
			</div>
			<?php
			if (isset($_SESSION["username"])) {
				echo "<div class=\"buttonAccountConnected\"><p>".$_SESSION["username"]."</p></div>";
			} else { ?>
			<div class="buttonAccount">
				<p><?php echo $menuValue[2]; ?></p>
			</div>
			<?php
			}?>
		</div>
	</div>
	<?php
	$results = $mysqli->query("SELECT * FROM site_option WHERE option_type = 'panel'");
	$panelValue = array();
	while ($row = $results->fetch_assoc()) {
		array_push($panelValue, $row['option_'.$_COOKIE['language']]);
	}
	?>
	<div class="panelFind">
		<form action="#"> <!-- Formulaire "Trouver" -->
			<table>
				<tr>
					<td>
						<label for="mot"><? echo $panelValue[1];?></label> <!-- Label de Mot Cle -->
					</td>
					<td>
						<input type="text" name="mot" id="mot" size="18"/> <!-- Champ du label mot -->
					</td>
				</tr>
				<tr>
					<td>
						<label for="categorie"><? echo $panelValue[0];?>:</label> <!-- Label de Categorie -->
					</td>
					<td>
						<select id="categorie" name="categorie"> <!-- Options du label Categorie -->
							<?php
							$results = $mysqli->query("SELECT * FROM site_option WHERE option_type = 'category' ORDER BY id DESC");
							while ($row = $results->fetch_assoc()) {
								echo "<option>".$row['option_'.$_COOKIE['language']]."</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="prix"> <? echo $panelValue[2];?>: </label> <!-- Label de Prix -->
					</td>
					<td>
						<select id="prix" name="prix"> <!-- Options du label Prix -->
							<?php
							$results = $mysqli->query("SELECT * FROM site_option WHERE option_type = 'price'");
							$priceArray = array();
							while ($row = $results->fetch_assoc()) {
								array_push($priceArray, $row['option_'.$_COOKIE['language']]);
							}
							?>
							<option><? echo $priceArray[0];?></option>
							<option><? echo $priceArray[1];?> 100$</option>
							<option><? echo $priceArray[2];?> 100$ <? echo $priceArray[3];?> 500$</option>
							<option><? echo $priceArray[2];?> 500$ <? echo $priceArray[3];?> 1000$</option>
							<option><? echo $priceArray[2];?> 1000$ <? echo $priceArray[3];?> 5000$</option>
							<option><? echo $priceArray[2];?> 5000$ <? echo $priceArray[3];?> 10000$</option>
							<option><? echo $priceArray[4];?> 10000$</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label id="trie" for="trier"> <? echo $panelValue[7];?>: </label> <!-- Label de Trier -->
					</td>
					<td>
						<select id="trier" name="trier"> <!-- Options du label Trier -->
							<?php
							$results = $mysqli->query("SELECT * FROM site_option WHERE option_type = 'sort'");
							while ($row = $results->fetch_assoc()) {
								echo "<option>".$row['option_'.$_COOKIE['language']]."</option>";
							}
							?>
						</select>
					</td>
					<td>
						<input type="submit" value="<? echo $panelValue[4];?>"/> <!-- Bouton Cherche -->
					</td>
				</tr>									
			</table>
		</form>
	</div>
	<div class="panelPost">
		<form id="panelPost" method="post" action= "post.php"> <!-- Formulaire "Poster" -->
			<table>

				<tr>
					<td>
						<label for="nomEnglish"><?
						echo $panelValue[8]." ";
						echo ($_COOKIE['language'] == "en") ? $panelValue[10]: $panelValue[10];
						?>
						:</label> <!-- Label Nom -->
					</td>
					<td>
						<input type="text" name="nomEnglish" id="nomEnglish" size="18" /> <!-- Champ pour remplir le nom -->
					</td>
				</tr>

				<tr>
					<td>
						<label for="nomFrench"><?
						echo $panelValue[8]." ";
						echo ($_COOKIE['language'] == "en") ? $panelValue[9]: $panelValue[9];
						?>
						:</label> <!-- Label Nom -->
					</td>
					<td>
						<input type="text" name="nomFrench" id="nomFrench" size="18" /> <!-- Champ pour remplir le nom -->
					</td>
				</tr>

				<tr>
					<td>
						<label for="prix"><? echo $panelValue[2];?>:</label> <!-- Label Prix -->
					</td>
					<td>
						<input type="text" name="prixPost" id="prixPost" size="18" /> <!-- Champ pour remplir le prix -->
					</td>
				</tr>
				<tr>
					<td>
						<label for="latitude">Latitude:</label> <!-- Label latitude -->
					</td>
					<td>
						<input type="text" name="latitude" id="latitude" size="18" /> <!-- Champ pour remplir le latitude -->
					</td>
				</tr>
				<tr>
					<td>
						<label for="longitude">Longitude:</label> <!-- Label longitude -->
					</td>
					<td>
						<input type="text" name="longitude" id="longitude" size="18" /> <!-- Champ pour remplir le longitude -->
					</td>
				</tr>
				<tr>
					<td>
						<label for="categorie"> <? echo $panelValue[0];?>: </label> <!-- Label Categorie -->
					</td>
					<td>
						<select id="categoriePost" name="categoriePost"> <!-- Options du label Categorie -->
							<?php
							$results = $mysqli->query("SELECT * FROM site_option WHERE option_type = 'category' ORDER BY id DESC");
							while ($row = $results->fetch_assoc()) {
								echo "<option value=\"".$row['option_name']."\">".$row['option_'.$_COOKIE['language']]."</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="descriptionEnglish">
						<?
						echo $panelValue[3]." ";
						echo ($_COOKIE['language'] == "en") ? $panelValue[10]: $panelValue[10];
						?>
						: <br /> <!-- Label Description -->
						</label> 
					</td>
					<td>
						<textarea  name="descriptionEnglish" id="descriptionEnglish" rows="6" cols="30" ></textarea> <!-- Champ pour remplir la description de l'objet -->
					</td>
				</tr>
				<tr>
					<td>
						<label for="descriptionFrench">
						<?
						echo $panelValue[3]." ";
						echo ($_COOKIE['language'] == "en") ? $panelValue[9]: $panelValue[9];
						?>
						: <br /> <!-- Label Description -->
						</label> 
					</td>
					<td>
						<textarea  name="descriptionFrench" id="descriptionFrench" rows="6" cols="30" ></textarea> <!-- Champ pour remplir la description de l'objet -->
					</td>
				</tr>
				<tr>
					<td>
						<input type="reset" value="<? echo $panelValue[6];?>" /> <!-- Bouton "Reinitialiser -->
					</td>
					<td>
					</td>
					<td>
						<input id="postButton" type="submit" value="<? echo $panelValue[5];?>" /> <!-- Bouton "Publier" -->
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div class="panelAccount">
	<?php
	if (isset($_SESSION["username"])) {
		echo $_SESSION["username"];?>
		<form action="connexion.php" method="post"> <!-- Formulaire "Compte" -->
			<input type="submit" value="Logout"/> <!-- Bouton Cherche -->
		</form>
	<?} else { ?>
		<form action="connexion.php" method="post"> <!-- Formulaire "Compte" -->
			<table>
				<tr>
					<td>
						<label for="username">Username:</label> <!-- Label de Mot Cle -->
					</td>
					<td>
						<input type="text" name="username" id="username" size="18"/> <!-- Champ du label mot -->
					</td>
				</tr>
				<tr>
					<td>
						<label for="password">Password:</label> <!-- Label de Categorie -->
					</td>
					<td>
						<input type="password" name="password" id="password" size="18"/> <!-- Champ du label mot -->
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="Login"/> <!-- Bouton Cherche -->
					</td>
				</tr>									
			</table>
		</form>
	<?php
	} ?>
	</div>
	<div class="content">
		<div class="frontView">
			<table> <!-- Annonces du site -->
				<tr class="tabHeader">
					<?php
					$results = $mysqli->query("SELECT * FROM site_menu WHERE id > 3");
					while ($row = $results->fetch_assoc()) {
						echo "<th>".$row['item_'.$_COOKIE['language']]."</th>";
					}
					?>
				</tr>
				<?php
				$results = $mysqli->query("SELECT * FROM site_annonce ORDER BY date DESC, id DESC LIMIT 3");
				while ($row = $results->fetch_assoc()) {
					echo "<tr class=\"toHide\">\n";
					echo "<td><img src=\"images/128x128/".$row['category_option_name'].".png\" alt=\"".$row['title_'.$_COOKIE['language']]."\" /></td>\n";
					$resultsCat = $mysqli->query("SELECT * FROM site_option WHERE option_name = '".$row['category_option_name']."'");
					while ($rowCat = $resultsCat->fetch_assoc()) {
						echo "<td>".$rowCat['option_'.$_COOKIE['language']]."</td>\n";
					}
					echo "<td>$".$row['price']."</td>\n";
					echo "<td>Toulouse</td>\n";
					echo "<td>".$row['title_'.$_COOKIE['language']]."</td>\n";
					echo "<td>".$row['description_'.$_COOKIE['language']]."</td>\n";
					echo "</tr>\n";
				}
				?>
			</table>
			
			<div class="buttonSwitch quickFlipCta"> <!-- Bouton Flip -->
				<p>Carte</p>
			</div>
		</div>
		<div class="backView"> <!-- Page quand le bouton Flip est cliqué -->
			<div id="map_canvas"></div>
			<i class="top"></i>
			<i class="right"></i>
			<i class="bottom"></i>
			<i class="left"></i>
			<i class="top left"></i>
			<i class="top right"></i>
			<i class="bottom left"></i>
			<i class="bottom right"></i>
			<div class="buttonSwitch quickFlipCta">
				<p>Liste</p>
			</div>
		</div>
	</div>
	<p>
		<a href="http://validator.w3.org/check?uri=referer"> <!-- Lien vers la vérification w3 du contenu xhtml -->
			<img src="http://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" />
		</a>
		<a href="http://jigsaw.w3.org/css-validator/check/referer"> <!-- Lien vers la vérification w3 du ccs -->
			<img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="CSS Valide !" />
		</a>
	</p>
	<!-- Appels des scripts JS -->
	<script type="text/javascript" src="javascript/jquery-1.10.2.min.js"></script>
	<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
	<script type="text/javascript" src="javascript/jquery-ui.min.js"></script>
	<script type="text/javascript" src="javascript/jquery.autocomplete.min.js"></script>
	<script type="text/javascript" src="javascript/jquery.quickflip.min.js"></script>
	<script type="text/javascript" src="javascript/jquery.corner.js"></script>
	<script type="text/javascript" src="javascript/site.js"></script>
</body>	
</html>