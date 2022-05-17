-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Feb 17, 2022 alle 07:10
-- Versione del server: 5.7.31
-- Versione PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `articles`
--

INSERT INTO `articles` (`id`, `article`, `id_utilisateur`, `id_categorie`, `date`) VALUES
(2, 'Jitter Recipes: Book 1, Recipes 0-12\r\nJitter Recipes: Book 1, Recipes 0-12\r\nSo, you&amp;#39;ve finished the tutorials, you understand the basics of digital audio, and you can imagine using a jitter matrix for something. Perhaps you are looking for a couple of new recipes to expand your repertoire...\r\nThe following is a collection of simple examples that began as weekly posts to the Max mailing list. Here you will find some clever solutions, advanced trans-coding techniques, groovy audio/visual toys, and basic building blocks for more complex processing. The majority of these recipes are specific implementations of a more general patching concept. As with any collection of recipes, you will want to take these basic techniques and personalize them for your own uses. I encourage you to take them all apart, add in your own touches and make these your own.', 4, 3, '2022-01-29 05:20:57'),
(3, 'Trend Cemetery: Long Live Mugler. Welcome to Trend Cemetery, a new bi-weekly column where our Senior Editor Taylore Scarabelli tries to make sense of meaningless micro-trends, luxury fashion, and street style in the age of social media. This week, she mourns the loss of  Thierry Mugler, glamour, and André Leon Talley. \r\n\r\n———\r\n\r\nAs the late André Leon Talley once said, “It’s been a bleak streak over here in America…It’s a famine of beauty.” That was a quote from the 2009 documentary, The September Issue, but it lands in 2022—not only because of a supposed dearth of innovation on the runways and in our feeds—but because style, in the contemporary milieu, feels devoid of glamour. In 2022, the dominant silhouette is oversized, and the most common looks at fashion events mix bright colors and logos in the way advertisements at sporting arenas might. This is not to say that we are without ostentation in fashion, but rather that our collective fashion fantasy has more to do with looking bold than it does with character building or storytelling. Bucket hats and flight jackets rear their comfortable silhouettes season after season, only slightly altered to mirror trending colorways or particular brands. And though consumers seem to be growing tired of the dominant normcore-inspired fashion du-jour, we continue buying bigger boots and bags, all in the hopes of getting attention online, and off.', 9, 3, '2022-01-29 05:20:58'),
(5, 'The Rapper and Hedi Slimane Muse\r\nLeikeli47 Eats Interview for Breakfast.\r\n\r\nYou may not recognize Leikeli47 on the street—in fact, nobody would. But you’ve likely heard her music. The rapper and producer, who wears a mask during public appearances, has maintained a low profile that has allowed her music—joyful, genre-bending hip-hop—to speak for itself. After spending years posting tracks online and subsisting on SoundCloud likes, the Brooklyn-based musician’s no-fucks-given exuberance caught the attention of Jay-Z in 2015 (the track in question, a warm weather anthem titled “Fuck the Summer Up,” was the namesake of his inaugural Tidal playlist). In 2017, Leikeli47 released her debut album, a hip-hop rule breaker titled Wash & Set, and quickly followed up with 2018’s critically-acclaimed Acrylic, which included the Issa Rae-approved banger “Girl Blunt.” This year, hot off the release of her new single “Chitty Bang,” Leikeli47 crossed paths with Celine’s creative director, Hedi Slimane. The photographer and designer was so captivated by the rapper’s sound and mystique that he couldn’t resist the urge to photograph her. To learn more about Celine’s latest muse, we sat down with Leikeli47 to discuss her journey from SoundCloud to festival stage, working with Hedi, and eating Interview for breakfast.', 9, 2, '2022-02-07 06:57:28'),
(8, 'Klein’s Approachable Avant-Garde\r\nFor her new album Harmattan, singer/producer Klein asked esteemed academic and poet Fred Moten to write the liner notes. The way she connected with Moten was slightly unusual. “Really and truly, he commented on one of my Youtube videos,” she says, laughing. “We got to talking, and I was like, ‘Do you want to write a little blurb?’ And some of the things he wrote I didn’t see in [the album] originally, so I was like ‘Yeah, I’m a decomposer!’” It’s a quirky yet completely on-brand story for the London-based musician, one that highlights her deep comfort within both music’s fringes and its mainstream.\r\n\r\nMoten isn’t the only creative type with whom Klein has collaborated over the last few years, and Harmattan is in some ways the result of Klein exploring her musical circle. “Unknown Opps” features saxophonist Keahnne Whitby and Khush Jandu Quiney, the latter of whom was in her band when she opened for Moor Mother in 2019. “I would literally just meet someone on Instagram and be like ‘Oh, you play! Cool, cool.’ So it was just natural, and we were just chilling until I asked if they want to be on my track.” Welsh opera singer Charlotte Church guested on “Skyfall” after introducing herself when Klein opened for Bjork on the Utopia tour. She describes her collaborations as genial: “A lot of people I work with are friends first, or just for fun. I’m shy, and I get nervous that I have nothing to bring to the table. But over time, I’ve gotten more confident. I don’t think I’m going to ruin the track anymore.”', 4, 2, '2022-02-07 19:52:26'),
(9, 'Life Lessons from André Leon Talley\r\n“Darling, clothes are not important in this pandemic. What’s important is your strength that comes from your faith, your values. All of that is very ingrained in you, so therefore you can survive.”\r\n\r\n(2020)\r\n\r\nWelcome to Life Lessons. Today, we mourn the loss of one of our own—the inimitable André Leon Talley. News of the trailblazing fashion editor’s passing came late on Tuesday night, sparking a flood of tearful tributes and joyful memorials in honor of this towering (six-foot-six) cultural icon. André began his storied career in the offices of this very publication—as a receptionist for Andy Warhol—and rose to claim the carefully gate-kept title of Creative Director and Editor at Large of Vogue not long thereafter. In the years since, André, a Black queer man raised in the Jim Crow South, relentlessly rewrote the fashion industry’s rules, dressing First Ladies, casting Naomi Campbell in a reimagined “Gone With the Wind” shoot for Vanity Fair, and carving out space in the magazine world’s highest echelons—all in his signature uniform of oversized furs and candy-colored kaftans. To mark an icon’s passing, we’re bringing together the brightest moments from our decades’ worth of interviews with André, courtesty of the likes of Carolina Herrera (1981), Michael Kors (2019), Gloria von Thurn und Taxis (2020), and Demna Gavasalia (2021). So sit back and grab a pen, darling—you just might learn a thing or two.', 4, 3, '2022-02-08 05:20:56'),
(65, 'IT security: Computer attacks with laser light\r\n\r\nComputer systems that are physically isolated from the outside world (air-gapped) can still be attacked. This is demonstrated by IT security experts. They show that data can be transmitted to light-emitting diodes of regular office devices using a directed laser. With this, attackers can secretly communicate with air-gapped computer systems over distances of several meters. In addition to conventional information and communication technology security, critical IT systems need to be protected optically as well.\r\n\r\nComputer systems that are physically isolated from the outside world (air-gapped) can still be attacked. This is demonstrated by IT security experts of the Karlsruhe Institute of Technology (KIT) in the LaserShark project. They show that data can be transmitted to light-emitting diodes of regular office devices using a directed laser. With this, attackers can secretly communicate with air-gapped computer systems over distances of several meters. In addition to conventional information and communication technology security, critical IT systems need to be protected optically as well.', 4, 1, '2022-02-16 19:39:53'),
(66, 'Music captivates listeners and synchronizes their brainwaves\r\n\r\nDespite the importance, it has been difficult to study engagement with music given the limits of self-report. This led Jens Madsen and Lucas Parra, from CCNY&amp;#39;s Grove School of Engineering, to measure the synchronization of brainwaves in an audience. When a listener is engaged with music, their neural responses are in sync with that of other listeners, thus inter-subject correlation of brainwaves is a measure of engagement.\r\n\r\nAccording to their findings, published in the latest issue of &amp;#34;Scientific Reports,&amp;#34; a listener&amp;#39;s engagement decreases with repetition of music, but only for familiar music pieces. However, unfamiliar musical styles can sustain an audience&amp;#39;s interest, in particular for individuals with some musical training.\r\n\r\n&amp;#34;Across repeated exposures to instrumental music, inter-subject correlation decreased for music written in a familiar style,&amp;#34; Parra and his collaborators write in &amp;#34;Scientific Reports.&amp;#34;\r\n\r\nIn addition, participants with formal musical training showed more inter-subject correlation, and sustained it across exposures to music in an unfamiliar style. This distinguishes music from other domains, where interest drops with repetition.\r\n\r\n&amp;#34;What is so cool about this, is that by measuring people&amp;#39;s brainwaves we can study how people feel about music and what makes it so special.&amp;#34; says Madsen.\r\n\r\nElizabeth Hellmuth Margulis and Rhimmon Simchy-Gross, both from the University of Arkansas, were among the other researchers. The study involved 60 graduate and undergraduate students from City College of New York and University of Arkansas.', 4, 1, '2022-02-16 19:47:12'),
(67, 'one more', 4, 2, '2022-02-16 20:00:33'),
(62, 'another science article', 4, 1, '2022-02-16 19:35:11'),
(63, 'A mathematical secret of lizard camouflage\r\n\r\nThe shape-shifting clouds of starling birds, the organization of neural networks or the structure of an anthill: nature is full of complex systems whose behaviors can be modeled using mathematical tools. The same is true for the labyrinthine patterns formed by the green or black scales of the ocellated lizard. A multidisciplinary team explains, thanks to a very simple mathematical equation, the complexity of the system that generates these patterns. This discovery contributes to a better understanding of the evolution of skin color patterns: the process allows for many different locations of green and black scales but always leads to an optimal pattern for the animal survival.', 4, 1, '2022-02-16 19:36:19'),
(64, 'Researchers design first-of-its-kind multichannel soft robotic armband that conveys artificial sensations of touch\r\n\r\nA new study could be a game changer for users of prosthetic hands who have long awaited advances in dexterity. Researchers examined if people could precisely control the grip forces applied to two different objects grasped simultaneously with a dexterous artificial hand. They designed a multichannel wearable soft robotic armband to convey artificial sensations of touch to the robotic hand users. Subjects were able to successfully grasp and transport two objects simultaneously with the dexterous artificial hand without breaking or dropping them, even when their vision of both objects was obstructed. The study is the first to show the feasibility of this complex simultaneous control task while integrating multiple channels of haptic/touch sensation feedback noninvasively.', 4, 1, '2022-02-16 19:38:56'),
(53, 'test mina profile', 9, 1, '2022-02-14 18:59:44'),
(58, 'test', 4, 1, '2022-02-16 19:24:19'),
(60, 'some science article ', 4, 1, '2022-02-16 19:34:21'),
(61, 'Climate change has likely begun to suffocate the world’s fisheries\r\n\r\nBy 2080, around 70 percent of the world&amp;#39;s oceans could be suffocating from a lack of oxygen as a result of climate change, potentially impacting marine ecosystems worldwide, according to a new study. The new models find mid-ocean depths that support many fisheries worldwide are already losing oxygen at unnatural rates and passed a critical threshold of oxygen loss in 2021.', 4, 1, '2022-02-16 19:34:56');

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'science'),
(2, 'music'),
(3, 'arts'),
(54, 'retest');

-- --------------------------------------------------------

--
-- Struttura della tabella `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(1024) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES
(3, 'test', 9, 4, '2022-02-08 06:10:57'),
(5, 'test another comment on another article test number 1', 8, 4, '2022-02-07 06:11:27'),
(36, 'retest', 49, 9, '2022-02-14 19:07:56'),
(39, 'test\r\n', 66, 4, '2022-02-16 20:27:42');

-- --------------------------------------------------------

--
-- Struttura della tabella `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateur'),
(42, 'moderateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Struttura della tabella `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `id_droits`) VALUES
(4, 'adminz', '$2y$10$LZ7LsZZmk8OKv/b0UYE7kes.6VlQZ02weR.h.xkIrQxYEI2KisE4q', 'adminz@adminz.io', 1337),
(9, 'mina', '$2y$10$qvzcV9MtUj.x6mKBddDVFO4mHqiRveYZgzBNCK/FX3a52e/o/cPia', 'mina@mina.com', 42),
(22, 'nami', '$2y$10$ckGx8JvzV7pmM70xRSOQweToC9P3V6gS2L2g1h0i9dVlpMEaZkkdK', 'nami@nami.io', 1337);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
