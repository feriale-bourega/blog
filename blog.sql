-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 17 mai 2022 à 10:59
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` text NOT NULL,
  `images` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `article`, `images`, `id_utilisateur`, `id_categorie`, `date`) VALUES
(2, 'Chaise métallique', 'chaise-metallique.jpg', 2, 3, '2022-01-27 14:16:22'),
(3, 'Table métallique', 'table-metallique.jpg', 1, 3, '2022-01-27 14:16:22'),
(4, 'Chaise céramique', 'chaise-ceramique.jpg', 3, 2, '2022-01-27 14:17:12'),
(5, 'Table argile', 'table-argile.jpg', 4, 4, '2022-01-27 14:17:12'),
(6, 'Miroir boisé', 'miroir-boisé.jpg', 2, 1, '2022-01-31 14:40:54'),
(7, 'Chaise boisée', 'chaise-boisé.jpg', 3, 1, '2022-03-09 10:45:52'),
(8, 'Table céramique', 'table-ceramique.jpg', 4, 2, '2022-03-09 10:52:35'),
(9, 'Miroir céramique', 'miroir-ceramique.jpg', 2, 2, '2022-03-09 10:52:35'),
(10, 'Miroir métallique', 'miroir-metallique.jpg', 1, 3, '2022-03-09 10:59:22'),
(11, 'Chaise argile', 'chaise-argile.jpg', 4, 4, '2022-03-09 11:11:31'),
(12, 'Miroir Argile', 'miroir-argile.jpg', 2, 4, '2022-03-09 11:11:31'),
(14, 'Vase métallique', 'vase-metallique.jpg', 1, 2, '2022-04-18 14:46:48'),
(15, 'Vase boisée', 'vase-bois.jpg', 1, 1, '2022-04-18 14:46:48'),
(16, 'Vase céramique', 'vase-ceramique.jpg', 2, 2, '2022-04-18 14:46:48'),
(17, 'Vase argile', 'vase-argile.JPG', 2, 4, '2022-04-18 14:46:48'),
(18, 'Sol argile', 'sol-argile.jpg', 3, 4, '2022-04-18 14:46:48'),
(19, 'Sol bois', 'sol-bois.jpg', 3, 1, '2022-04-18 14:46:48'),
(20, 'Sol ceramique', 'sol-ceramique.jpg', 4, 2, '2022-04-18 14:46:48'),
(21, 'Sol metallique', 'sol-metallique.jpg', 4, 3, '2022-04-18 14:46:48');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'boisé'),
(2, 'céramique'),
(3, 'métallique'),
(4, 'argile');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(1024) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES
(1, 'Jolie', 1, 1, '2022-01-27 14:19:31'),
(2, 'C\'est fade.', 1, 2, '2022-01-27 14:21:36'),
(3, 'J\'aime bien.', 1, 3, '2022-01-27 14:21:36'),
(4, 'Pas mal.', 2, 1, '2022-01-27 14:21:36'),
(5, 'Bof', 2, 3, '2022-01-27 14:21:36'),
(6, 'Pas intéressant !', 4, 1, '2022-01-27 14:21:36'),
(7, 'Belle couleur', 4, 2, '2022-01-27 14:21:36'),
(8, 'Amazing', 3, 1, '2022-01-27 14:22:58'),
(9, 'Beautiful', 3, 2, '2022-01-27 14:22:58'),
(10, 'Quelle beauté !!!', 5, 1, '2022-04-25 11:32:43'),
(11, 'test', 6, 1, '2022-04-25 12:26:42'),
(13, 'Largement beau', 6, 4, '2022-04-25 21:07:58'),
(14, 'merci', 7, 5, '2022-04-25 21:21:04'),
(16, 'test 2', 8, 5, '2022-04-25 21:21:39'),
(24, 'bl', 9, 5, '2022-04-25 21:25:51'),
(39, 'test', 14, 14, '2022-05-13 11:06:52'),
(38, 'Belle couleur brillante', 16, 16, '2022-05-13 10:55:26'),
(28, 'bien', 10, 6, '2022-04-25 21:29:38'),
(29, 'bien', 11, 6, '2022-04-25 21:29:42'),
(30, 'test', 16, 7, '2022-04-25 21:29:49'),
(31, 'test', 15, 7, '2022-04-25 21:30:08'),
(32, 'bon', 14, 8, '2022-04-25 21:31:21'),
(33, 'J\'aime bien', 13, 8, '2022-04-25 21:32:02'),
(36, 'Belle couleur', 12, 9, '2022-04-25 21:51:52'),
(37, 'Très beau vase', 14, 10, '2022-05-12 23:38:16');

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateur'),
(42, 'modérateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateurs` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateurs`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateurs`, `login`, `password`, `email`, `id_droits`) VALUES
(6, 'kilisa', '$2y$10$L7pd2Y5izDNObKFHKnb2j.EsX25xELjF2qr1Uqm7p5ehe9OjYj3FG', 'kilisa@kilisa.fr', 1337),
(2, 'Cella', '$2y$10$FjZ2F/qw15KlD3OmM0fvYun2NeeM7UvUD1RTOCkjmly8GyYFidFqO', 'vivia@vivia.fr', 1),
(3, 'dil', '$2y$10$5NJGYEniBt4Okz8LkIHYQ.p6Fa805mhGRiOKgPB8vgx8w/5Jx4y0m', 'dil@dil.fr', 42),
(7, 'vivim', '$2y$10$zvhQ3PMdNwKEkS75QBNJqePWOrEyhbzjMytaeM.rmdWJzRRxi2awC', 'vivim@vivim.fr', 1),
(9, 'wol', '$2y$10$oARM940gjH4zqpgTvZbHkudr0Joe1JO.VfCMu4HVhgVwycGamDv6G', 'wol@wol.fr', 1),
(10, 'lolo', '$2y$10$i1MhlagkHWCxeG995JPYR.RqDrM4lLiJNF7Dq9c3DtlElDj6lZSXO', 'lolo@lolo.fr', 1),
(16, 'ill', '$2y$10$b.AnVIHMGx9DUx24cm.RYuB6CbLCVb7AkOfmxy/qnVuacte4HGo/C', 'ill@ill.fr', 1),
(15, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@test.fr', 1),
(14, 'admin', '$2y$10$mdNW9Tdq.w08ErGcmwwGv.MTyM0PslrRYUhQBxLaTwAaOUtqbX69q', 'admin@admin.fr', 1337),
(13, 'sam', '$2y$10$gLfyF1qP4MTSkWBCwCIPLOOHQpNZ/d.fEQ18Kd1UU1Sj3Wl2BkGgC', 'sam@sam.fr', 1),
(12, 'alo', '$2y$10$17f41iFC6OwExqNKvQFifOx7hbUtMIKa0N/2G5lMNCEaARYVbIIdm', 'alo@alo.fr', 1),
(11, 'ouip', '$2y$10$XrpCd6Rd.xsaMYTgGSXvkeGq0tzreC.McD.EKkf4uyjkH9uG85rXO', 'ouip@ouip.fr', 1),
(5, 'clidia', '$2y$10$UEkN/ELg/Ss/mgyhFyADgeXOqXsfuEco7QI/kBGAiEll/ytDu2ju.', 'clidia@clidia.fr', 1),
(4, 'moderateur', '$2y$10$VzZAzKqrgqN8FLshuZP4JOltXIcWrLL1A6gIpH32UHSOxFX5soIkC', 'moderateur@moderateur.fr', 42);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
