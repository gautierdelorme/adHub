<?php
session_start();
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
<?php
$mysqli = new mysqli("localhost", "root", "root", "adHub");
if ($mysqli->connect_errno) {
	echo "Echec lors de la connexion à MySQL : (".$mysqli-> connect_errno.") ".$mysqli->connect_error;
}
?>
	<div class="header"> <!-- Entete du site -->
		<form id="formLanguage" action="changeLanguage.php" method="post">
			<input type="submit" name="submitLanguage"/>
		</form>
		<h1>AdHub by Aristochats Team</h1> <!-- Titre important du site -->
		<div class="buttonsHeader"> <!-- Menu actions -->
			<div class="buttonFind">
				<p>Trouver</p>
			</div>
			<div class="buttonPost">
				<p>Poster</p>
			</div>
			<div class="buttonAccount">
				<p>Compte</p>
			</div>
		</div>
	</div>
	<div class="panelFind">
		<form action="#"> <!-- Formulaire "Trouver" -->
			<table>
				<tr>
					<td>
						<label for="mot">Mot Clé:</label> <!-- Label de Mot Cle -->
					</td>
					<td>
						<input type="text" name="mot" id="mot" size="18"/> <!-- Champ du label mot -->
					</td>
				</tr>
				<tr>
					<td>
						<label for="categorie">Catégorie:</label> <!-- Label de Categorie -->
					</td>
					<td>
						<select id="categorie" name="categorie"> <!-- Options du label Categorie -->
							<option>Toutes les catégories</option>
							<option>Electronique</option>
							<option>Electromenager</option>
							<option>Logement</option>
							<option>Mobilier</option>
							<option>Service</option>
							<option>Voiture</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="prix"> Prix: </label> <!-- Label de Prix -->
					</td>
					<td>
						<select id="prix" name="prix"> <!-- Options du label Prix -->
							<option>Tous les prix</option>
							<option>Moins de 100$</option>
							<option>Entre 100$ et 500$</option>
							<option>Entre 500$ et 1000$</option>
							<option>Entre 1000$ et 5000$</option>
							<option>Entre 5000$ et 10000$</option>
							<option>Plus de 10000$</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="ville"> Ville: </label> <!-- Label de Ville -->
					</td>
					<td>
						<select id="ville" name="ville"> <!-- Options du label ville -->
							<option>Toutes les villes</option>
							<option>Trois-Rivières</option>
							<option>Montréal</option>
							<option>Québec</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label id="trie" for="trier"> Trier par: </label> <!-- Label de Trier -->
					</td>
					<td>
						<select id="trier" name="trier"> <!-- Options du label Trier -->
							<option>Distance</option>
							<option>Prix</option>
							<option>Catégorie</option>
						</select>
					</td>
					<td>
						<input type="submit" value="Chercher"/> <!-- Bouton Cherche -->
					</td>
				</tr>									
			</table>
		</form>
	</div>
	<div class="panelPost">
		<form id="panelPost" method="post" action= "" onsubmit="return validate()"> <!-- Formulaire "Poster" -->
			<table>

				<tr>
					<td>
						<label for="nom">Nom:</label> <!-- Label Nom -->
					</td>
					<td>
						<input type="text" name="nom" id="nom" size="18" /> <!-- Champ pour remplir le nom -->
					</td>
				</tr>

				<tr>
					<td>
						<label for="prix">Prix:</label> <!-- Label Prix -->
					</td>
					<td>
						<input type="text" name="prixPost" id="prixPost" size="18" /> <!-- Champ pour remplir le prix -->
					</td>
				</tr>
				<tr>
					<td>
						<label for="categorie"> Catégorie: </label> <!-- Label Categorie -->
					</td>
					<td>
						<select id="categoriePost" name="categoriePost"> <!-- Options du label Categorie -->
							<option>Electronique</option>
							<option>Electromenager</option>
							<option>Logement</option>
							<option>Mobilier</option>
							<option>Service</option>
							<option>Voiture</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="ville"> Ville : </label> <!-- Label Ville -->
					</td>
					<td>
						<select id="villePost" name="ville"> <!-- Options du Label Ville du formulaire Poster -->
							<option>Toutes les villes</option>
							<option>Trois-Rivières</option>
							<option>Montréal</option>
							<option>Québec</option>
						</select>
					</td>
				</tr>

				<tr>
					<td>
						<label for="description">Description: <br /> <!-- Label Description -->
						</label> 
					</td>
					<td>
						<textarea  name="description" id="description" rows="6" cols="30" ></textarea> <!-- Champ pour remplir la description de l'objet -->
					</td>
				</tr>

				<tr>
					<td>
						<label for="email">Email:</label> <!-- Label email -->
					</td>
					<td>
						<input type="text" name="email" id="email" size="18" /> <!-- Champ pour remplir l'email -->
					</td>
				</tr>

				<tr>
					<td>
						<input type="reset" value="Réinitialiser" /> <!-- Bouton "Reinitialiser -->
					</td>
					<td>
					</td>
					<td>
						<input id="postButton" type="submit" value="Publier" /> <!-- Bouton "Publier" -->
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div class="content">
		<div class="frontView">
			<table> <!-- Annonces du site -->
				<tr>
					<?php
					$results = $mysqli->query("SELECT * FROM site_menu WHERE id > 3");
					while ($row = $results->fetch_assoc()) {
						echo "<th>".$row['item_'.$_COOKIE['language']]."</th>";
					}
					?>
				</tr>
				<?php
				$results = $mysqli->query("SELECT * FROM site_annonce WHERE id > 3");
				while ($row = $results->fetch_assoc()) {
					echo "<tr>\n";
					echo "<td><img src=\"images/128x128/".$row['category_option_name'].".png\" alt=\"".$row['title_'.$_COOKIE['language']]."\" /></td>\n";
					$resultsCat = $mysqli->query("SELECT * FROM site_option WHERE option_name = '".$row['category_option_name']."'");
					while ($rowCat = $resultsCat->fetch_assoc()) {
						echo "<td>".$rowCat['option_'.$_COOKIE['language']]."</td>\n";
					}
					echo "<td>$".$row['price']."</td>\n";
					echo "<td>Toulouse</td>\n";
					echo "<td>$".$row['description_'.$_COOKIE['language']]."</td>\n";
					echo "<tr>\n";
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
	<script type="text/javascript" src="javascript/jquery-ui.min.js"></script>
	<script type="text/javascript" src="javascript/jquery.quickflip.min.js"></script>
	<script type="text/javascript" src="javascript/jquery.corner.js"></script>
	<script type="text/javascript" src="javascript/site.js"></script>
</body>	
</html>