-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Mer 03 Décembre 2014 à 21:32
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `adHub`
--

-- --------------------------------------------------------

--
-- Structure de la table `site_annonce`
--

CREATE TABLE `site_annonce` (
`id` int(11) NOT NULL,
  `title_fr` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `description_fr` text NOT NULL,
  `description_en` text NOT NULL,
  `price` int(11) NOT NULL,
  `category_option_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `site_annonce`
--

INSERT INTO `site_annonce` (`id`, `title_fr`, `title_en`, `description_fr`, `description_en`, `price`, `category_option_name`, `user_id`, `latitude`, `longitude`, `date`) VALUES
(8, 'Televiseur', 'Nice Flat TV', 'Televiseur Ã  Ecran plat 42'' marque samsung, 3D, acquis il y''a 2 ans. Raison de la vente: achat d''un televiseur plus grand. A qui la chance', 'Nice flat screen TV acquired 2 years a go. Brand Samsung, size 42'', support 3D', 750, 'electronic', 3, 46.801084, -71.243890, '2014-01-25'),
(10, 'RefrigÃ©rateur', 'Fridge', 'Frigo comme neuf. Garantie encore valable. 1 ans d''usage. Marque Frigidaire.', '1 year of usage, under warranty, brand Frigidaire', 1200, 'appliances', 2, 46.351916, -72.590637, '2014-03-19'),
(11, 'Honda Civic 2008', 'Honda Civic 2008', 'Belle Honda Civic 97K, achetÃ© chez le concessionnaire en 2008. Raison de la vente: achat d''un nouveau vÃ©hicule', 'Nice and well maintained Honda Civic. 2008 and 97K.', 8660, 'automobile', 5, 46.360683, -72.570724, '2014-03-25'),
(12, 'PoÃªle Propre', 'Stove Well Maintained', 'Je vend ma poÃªle de marque LG,  2 ans d''usure. Propre, bien entretenu.', 'I am selling my LG stove, 2 years of wear. Clean, well maintained.', 590, 'appliances', 6, 46.342555, -72.562999, '2014-07-01'),
(13, 'Condo', 'Condo', 'Petit Ã  Condo Ã  louer prÃ¨s du fleuve, Ã  10 minute du centreville de trois-riviÃ¨res. 650$/mois', 'Little Condo for rent near the river, 10 minutes from downtown Trois-RiviÃ¨res 650$/Month', 750, 'lodging', 5, 46.360683, -72.580724, '2014-11-25'),
(14, 'Telephone Iphone', 'Mobile phone', 'Iphone 5s a vendre, encore dans son emballage, debloquÃ©', 'IPhone 5s for sale, still in its packaging, unlocked', 450, 'electronic', 4, 45.645448, -73.503716, '2014-11-26'),
(15, 'Television 52p', '52 inc Tv', 'televiseur Sony 2009 en excellente condition Ã  vendre', 'Sony tv in 2009 in excellent condition for sale', 800, 'electronic', 4, 45.550322, -73.594353, '2014-11-27'),
(16, 'Honda Accord 2009', 'Honda Civic 2008', 'Jolie Honda Accord 106K, achetÃ© chez le concessionnaire en 2010. Encore sous garantie  jusqu''Ã  200K, 2016', 'Jolie Honda Accord 106K, bought from the dealer in 2010. Still under warranty up to 200K, 2016', 12660, 'automobile', 6, 46.360683, -72.770724, '2014-12-01'),
(26, 'Appart', 'Loft', 'petit appart posÃ©', 'litlle spatio', 6000, 'lodging', 2, -70.876500, 23.908700, '2014-12-03');

-- --------------------------------------------------------

--
-- Structure de la table `site_menu`
--

CREATE TABLE `site_menu` (
`id` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `item_fr` varchar(255) NOT NULL,
  `item_en` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `site_menu`
--

INSERT INTO `site_menu` (`id`, `menu_name`, `item_fr`, `item_en`) VALUES
(1, 'find', 'Trouver', 'Find'),
(2, 'post', 'Poster', 'Post'),
(3, 'account', 'Compte', 'Account'),
(4, 'picture', 'Photo', 'Picture'),
(5, 'category', 'Categorie', 'Category'),
(6, 'price', 'Prix', 'Price'),
(7, 'city', 'Ville', 'City'),
(8, 'title', 'Titre', 'Title'),
(9, 'description', 'Description', 'Description');

-- --------------------------------------------------------

--
-- Structure de la table `site_option`
--

CREATE TABLE `site_option` (
`id` int(11) NOT NULL,
  `option_type` varchar(11) NOT NULL,
  `option_name` varchar(255) NOT NULL,
  `option_fr` varchar(255) NOT NULL,
  `option_en` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `site_option`
--

INSERT INTO `site_option` (`id`, `option_type`, `option_name`, `option_fr`, `option_en`) VALUES
(1, 'category', 'electronic', 'Electronique', 'Electronic'),
(2, 'category', 'appliances', 'Electromenager', 'Appliances'),
(3, 'category', 'automobile', 'Automobile', 'Automobile'),
(4, 'category', 'lodging', 'Logement', 'Lodging'),
(5, 'panel', 'category', 'CatÃ©gorie', 'Category'),
(6, 'panel', 'keyword', 'Mot ClÃ©', 'Keyword'),
(7, 'panel', 'price', 'Prix', 'Price'),
(9, 'panel', 'description', 'Description', 'Description'),
(10, 'panel', 'search', 'Chercher', 'Search'),
(11, 'panel', 'publish', 'Publier', 'Publish'),
(12, 'panel', 'reset', 'RÃ©initialiser', 'Reset'),
(14, 'category', 'allCategories', 'Toutes les catÃ©gories', 'All categories'),
(15, 'price', 'allPrices', 'Tous les prix', 'All prices'),
(17, 'price', 'lessThan', 'Moins de', 'Less than'),
(18, 'price', 'between', 'Entre', 'Between'),
(19, 'price', 'and', 'et', 'and'),
(20, 'price', 'moreThan', 'Plus de', 'More than'),
(22, 'panel', 'sort', 'Trier par', 'Sort by'),
(23, 'sort', 'distance', 'Distance', 'Distance'),
(24, 'sort', 'price', 'Prix', 'Price'),
(25, 'sort', 'category', 'CatÃ©gorie', 'Category'),
(26, 'panel', 'name', 'Nom', 'Name'),
(30, 'panel', 'language_fr', 'francais', 'french'),
(31, 'panel', 'language_en', 'anglais', 'english'),
(32, 'panel', 'switch_map', 'Carte', 'Map'),
(33, 'panel', 'switch_list', 'Liste', 'List');

-- --------------------------------------------------------

--
-- Structure de la table `site_user`
--

CREATE TABLE `site_user` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `site_user`
--

INSERT INTO `site_user` (`id`, `username`, `password`, `email`, `city`) VALUES
(2, 'line', 'edcdc783cbdf24114c3bdd72000904a5', 'line.lajoie@yahoo.ca', 'Trois-RiviÃ¨res'),
(3, 'paul', 'a71a272d8db841f1a0bdc86210389304', 'paul.marchand@gmail.com', 'QuÃ©bec'),
(4, 'giles', 'adfa43168fdca7a3d9b372cd51ba2b56', 'giles.goudreau@mtech.ca', 'MontrÃ©al'),
(5, 'chantal', '8591c3afaff0a5ae4e477cbc2b2204e9', 'chantal.garant@uqtr.ca', 'Trois-RiviÃ¨res'),
(6, 'geneviÃ¨ve', '9daea045b1f4638f2a982229501bceef', 'genevieve.gagne@hotmail.com', 'Trois-RiviÃ¨res');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `site_annonce`
--
ALTER TABLE `site_annonce`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `site_menu`
--
ALTER TABLE `site_menu`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `site_option`
--
ALTER TABLE `site_option`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `site_user`
--
ALTER TABLE `site_user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `site_annonce`
--
ALTER TABLE `site_annonce`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `site_menu`
--
ALTER TABLE `site_menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `site_option`
--
ALTER TABLE `site_option`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `site_user`
--
ALTER TABLE `site_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
