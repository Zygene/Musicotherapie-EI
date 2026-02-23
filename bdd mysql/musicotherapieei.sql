-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 21 fév. 2026 à 18:29
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `musicotherapieei`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `prenom`, `nom`, `email`, `telephone`, `message`, `date`) VALUES
(1, 'Thomas', 'Girard', 'thomas.girard@gmail.com', '+3307 81 45 92 63', 'Bonjour,\r\n\r\nJe vous contacte pour mon fils de 9 ans qui rencontre des difficultés de concentration et d’anxiété scolaire. \r\nJ’aimerais savoir comment se déroule une première séance pour un enfant et si un entretien préalable avec les parents est prévu.\r\n\r\nJe reste disponible pour échanger par téléphone si besoin.\r\n\r\nCordialement,\r\n\r\nThomas Girard', '2026-02-20 21:10:16'),
(2, 'Marie', 'Laurent', 'marie.laurent@hotmail.com', '+32 406 24 87 15', 'Bonjour,\r\n\r\nJe souhaite obtenir des informations concernant les séances individuelles pour adulte. Je traverse une période de stress important et je cherche une approche complémentaire pour m’aider à mieux gérer mes émotions.\r\n\r\nPouvez-vous m\'indiquer les disponibilités actuelles afin de prendre rendez-vous s\'il-vous-plaît ?\r\n\r\nMerci d’avance pour votre réponse.\r\n\r\nBien cordialement,\r\n\r\nMarie Laurent', '2026-02-20 21:07:52'),
(3, 'Elodie', 'Dupont', 'elodie.bernard@gmail.com', '+320473 54 21 88', 'Bonjour,\r\n\r\nJe serais intéressée par les séances de groupe. Pourriez-vous m’indiquer les prochaines dates ainsi que le tarif ? Je n’ai jamais pratiqué la musicothérapie auparavant et je souhaiterais savoir si une expérience musicale est nécessaire.\r\n\r\nMerci pour votre retour.\r\n\r\nÉlodie Dupont', '2026-02-20 21:35:11'),
(4, 'Julien', 'Moreau', 'julien.moreau@hotmail.com', '+352621 45 78 90', 'Bonjour,\r\nJe souhaiterais prendre rendez-vous pour une première consultation en individuel.\r\n\r\nSerait-il possible d’avoir un créneau en fin de journée après 18h ?\r\nJe reste à votre disposition pour toute information complémentaire.\r\n\r\nMerci beaucoup.\r\n\r\nJulien Moreau', '2026-02-20 21:37:29');

-- --------------------------------------------------------

--
-- Structure de la table `identifiant`
--

DROP TABLE IF EXISTS `identifiant`;
CREATE TABLE IF NOT EXISTS `identifiant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `identifiant`
--

INSERT INTO `identifiant` (`id`, `login`, `password`, `email`, `photo`) VALUES
(1, 'wilmesr', '$2y$10$8LuqRTPWSjuCiMXqxXLhxuX3nzTgzxJhkDU6k02P6L0qrtOtR79na', 'wilmesrobin2001@hotmail.fr', '11536914LenaRousseau.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `objectifs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `duree` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `prix` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `nom`, `description`, `objectifs`, `duree`, `prix`, `image`, `date`) VALUES
(1, 'Séance individuelle', 'Adolescents, adultes, seniors', 'Gestion des émotions, stress, confiance en soi, soutien lors de périodes de transition', '45 - 60 minutes', '50', '1177034352SeanceIndividuelle.jpg', '2026-02-12'),
(2, 'Séance enfant', 'Enfants à partir de 3 ans', 'Apaisement, attention, communication, expression émotionnelle', '45 - 60 minutes', '45', '837746058SeanceEnfant.jpg', '2026-02-12'),
(3, 'Séance parent-enfant', 'Parent(s) et enfant(s)', 'Lien affectif, compréhension mutuelle, accompagnement relationnel', '45 - 60 minutes', '60', '229756658SeanceParentEnfant.jpg', '2026-02-12'),
(4, 'Séance de couple', 'Couples', 'Communication, écoute, gestion des tensions, reconnexion', '45 - 60 minutes', '60', '1035113087SeanceCouple.jpg', '2026-02-12'),
(5, 'Séance de groupe', 'Groupes constitués', 'Interaction sociale, expression émotionnelle, cohésion de groupe', '60 - 90 minutes', 'Sur devis, selon la durée et le nombre de participants', '468945140SeanceGroupe.jpg', '2026-02-12');

-- --------------------------------------------------------

--
-- Structure de la table `temoignages`
--

DROP TABLE IF EXISTS `temoignages`;
CREATE TABLE IF NOT EXISTS `temoignages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `contexte` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `texte` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `visible` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `temoignages`
--

INSERT INTO `temoignages` (`id`, `nom`, `contexte`, `texte`, `date`, `visible`) VALUES
(1, 'Paul G.', 'Parent d’un enfant suivi', 'Mon fils de 8 ans adore ses séances de musicothérapie. J’ai constaté de réels progrès dans sa concentration et sa communication avec les autres enfants. Les activités musicales lui permettent d’exprimer ses émotions et il revient toujours enthousiaste après chaque séance.', '2026-02-12', 1),
(2, 'Sophie L.', 'Participante adulte en séance individuelle', 'Avant de commencer, je doutais beaucoup et je me sentais constamment sous pression. La musicothérapie m’a permis de déposer ce stress dans un cadre sécurisant. L’improvisation, le travail sur les sons et les échanges après coup m’aident à prendre du recul sur mes difficultés. Avec le temps, j’ai appris à mieux écouter mes besoins et à me faire davantage confiance. Ces séances sont devenues un véritable soutien dans ma vie personnelle comme professionnelle.', '2026-02-12', 1),
(3, 'Julien M.', 'Participant adulte à une séance individuelle', 'J’avais tendance à tout garder pour moi. Grâce aux séances, j’ai trouvé une façon d’exprimer ce que je ressens sans forcément devoir l’expliquer. L’accompagnement est toujours bienveillant et respectueux de mon rythme. Aujourd’hui, je me sens plus stable et plus confiant.', '2026-02-12', 1),
(4, 'Amélie F.', 'Adolescente participant à un groupe', 'Participer aux séances en groupe m’a beaucoup apporté. C’est un moment où l’on peut se reconnecter avec soi-même tout en partageant des émotions avec les autres, c’est vraiment apaisant.', '2026-02-12', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
