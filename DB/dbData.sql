INSERT INTO Matiere(idMat, nomMat, objectifMat, coefMat) VALUES("MAT-101",
                           "Algebre",
                           "La matière d'algèbre de base a pour objectif d'initier les étudiants aux principes fondamentaux de l'algèbre, une branche des mathématiques essentielle à de nombreuses disciplines. Ce cours vise à fournir aux apprenants les compétences nécessaires pour comprendre et manipuler des concepts clés tels que les opérations sur les nombres, les équations, les fonctions, et les matrices. En posant les bases de l'algèbre, ce cours prépare les étudiants à aborder des domaines mathématiques plus avancés et à appliquer ces concepts dans divers contextes académiques et professionnels.",
                           7);
                           
INSERT INTO Matiere(idMat, nomMat, objectifMat, coefMat) VALUES("ANG-001",
                           "Anglais",
                           "L'étude de l'anglais vise à développer la maîtrise de la langue anglaise, tant à l'oral qu'à l'écrit. Les cours d'anglais fournissent des compétences linguistiques essentielles, telles que la grammaire, le vocabulaire et la prononciation. Ils encouragent également la compréhension de la littérature et de la culture anglaises, facilitant ainsi la communication globale dans le monde moderne.",
                           2);
                           
INSERT INTO Matiere(idMat, nomMat, objectifMat, coefMat) VALUES("SCI-200",
                           "Science",
                           "L'enseignement des Sciences de la Vie et de la Terre vise à explorer la diversité du monde vivant, comprendre les mécanismes biologiques et géologiques, ainsi que leur impact sur l'environnement. Cette matière offre des connaissances approfondies sur la biologie, l'écologie, la géologie, et d'autres aspects liés à la vie et à la Terre. Elle encourage le questionnement scientifique, le raisonnement critique et contribue à la sensibilisation aux enjeux environnementaux contemporains.",
                           7);

-- DONNEES CLASSE
insert into classe(idClasse, nomClasse, nbEtudiants, niveauClasse, descClasse) VALUES("svta", "SVT-A", 30, "1ère année Bac", "Classe Branche Science de vie et de terre Groupe A");
INSERT INTO `classe` (`idClasse`, `nomClasse`, `nbEtudiants`, `niveauClasse`, `descClasse`) VALUES
('svta', 'SVT-A', 30, '1ère année Bac', 'Classe Branche Science de vie et de terre Groupe A'),
('svtb', 'SVT-B', 34, 'BAC', 'Desription de la classe BAC'),
('pha', 'PHY-A', 30, '1ère année  Bac', 'Classe branche Physique Groupe A')
--DONNEES ETUDIANT
INSERT INTO `etudiant` (`cne`, `nomEtud`, `prenomEtud`, `dnEtud`, `adresseEtud`, `mailEtud`, `telEtud`, `photoEtud`, `classe`, `profil`) VALUES
('et-001', 'Layla', 'Selmame', '1989-08-15', 'Bd la résistance n566', 'l.selmame@gmail.com', '0670556644', NULL, 'svta', 3),
('et-002', 'Ait eljide', 'Hassan', '1988-02-10', 'Quartier al amal rue farah 5eme etg', NULL, '0655223311', NULL, 'svta', NULL),
('et-003', 'Erraji', 'Sabrine', '1990-05-25', 'Bd zerktouni n 62 3eme etg', NULL, '0755669900', NULL, 'svta', NULL),
('et-004', 'Abderrehmani', 'Sanae', NULL, 'Quartier Gauthier rue Chefchaoueni n 14', 'sanaa.abdrehmani@yahoo.fr', NULL, NULL, 'svta', NULL),
('et-005', 'Nabil', 'Alaoui', '1990-09-23', 'Bd sahil res. najihi 6eme etg', 'nab_alaoui@gmail.com', '0698256600', NULL, 'svta', NULL),
('et-006', 'Manouni', 'Soukaina', '1990-03-19', 'Quartier bernoussi rue des fleurs res saada', 's.manouni@yahoo.com', '0655447788', NULL, 'svtb', NULL),
('et-007', 'Amrani', 'Khalid', '1995-01-02', 'Bd Narjiss res samah 1er etg n 3', 'emrani.khalid@gmail.com', '0610000011', NULL, 'svtb', NULL),
('et-008', 'Sbai', 'Souad', '1990-07-18', 'Quartier Belvedere rue campiegne n48', 's.sbai@gmail.com', '0612222222', NULL, 'pha', NULL);

--DONNEES PROFESSEUR
INSERT INTO `professeur` (`idProf`, `nomProf`, `prenomProf`, `dateNaissance`, `adresseProf`, `mailProf`, `telProf`, `photoProf`, `matiere`, `profil`) VALUES
('test001', 'Mohamed', 'Chafik', '1951-01-21', '', 'mohamedchafik@yahoo.fr', '', NULL, 'MAT-101', 2),
('test002', 'Mohamed', 'Najib', '0000-00-00', 'rés. atlas Hay Atlas Fès', '', '', NULL, 'SCI-200', NULL),
('test003', 'said', 'chakib', '1963-08-14', '252 Hay Saada Fes', 'saidchakib@gmail.com', '0672222222', NULL, 'MAT-101', NULL),
( 'ins001', 'samir', 'alaoui', '1969-04-23', '', 'samiralaoui@yahoo.com', '0644557788', NULL, 'MAT-101', NULL);

--DONNEES DEVOIR
INSERT INTO `devoir` (`idDev`, `titreDev`, `descDev`, `dateEcheance`, `matiere`) VALUES
('D-AN-001', 'Writing about human rights', 'this is a test devoir inserting', '2024-02-04', 'ANG-001'),
('DV-ANG-002', 'Oral about social reforms', 'This is a second homework(Oral about social reforms from your point of view) ', '2024-02-01', 'ANG-001'),
('D-MAT-1010', 'Devoir Math algèbre', 'Devoir portant sur les fonctions deuxième et troisième degré.', '2024-02-10', 'MAT-101'),
('D-MAT-1011', 'Devoir numéro 2', 'Devoir de Math portant sur les limites', '2024-02-10', 'MAT-101'),
( 'D-MAT-1012', 'Devoir MAT 1012', 'test devoir test', '2024-02-25', 'MAT-101');

--DONNEES CLASSE PROF

INSERT INTO `classeprof` (`classe`, `professeur`) VALUES
('svtb', 'pr-NAM'),
('svta', 'pr-CHAS'),
('svta', 'pr-CHAM');

--DONNEES UTILISATEUR
INSERT INTO `utilisateur` (`identifiant`, `motPasse`, `role`) VALUES
('admin', '$2y$10$sxuvls.3AlrUSDKaZsnbQOS9J5B6tiHWbfpvyJZzZ6ziv4igmC5yK', 'admin'),
('CHAM', '$2y$10$E8J65KaHLDMyCybKl7yXf.Qx8kCXEXAm/FuzNKXTEV7vJFjrFxNbe', 'professeur'),
('etudiant', '$2y$10$pdqvrabIFIxrDh/uwEb5IOc8c2tEs/F5z6QBQv4eASdNB9VaKSbdm', 'etudiant'),
( 'NAM', '$2y$10$P5eyGXrCbqAhHgo1ZmOINeAjtmbuXiQSERzb2Tqb/u9lmJ12Fn1V.', 'professeur');