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


-- DONNEES UTILISATEUR 
INSERT INTO utilisateur(identifiant, motPasse, role) values("admin", "admin", "admin");
INSERT INTO utilisateur(identifiant, motPasse, role) values("prof", "prof", "professeur");
INSERT INTO utilisateur(identifiant, motPasse, role) values("etudiant", "etudiant", "etudiant");

-- DONNEES CLASSE
insert into classe(idClasse, nomClasse, nbEtudiants, niveauClasse, descClasse) VALUES("svta", "SVT-A", 30, "1ère année Bac", "Classe Branche Science de vie et de terre Groupe A");
INSERT INTO `classe` (`id`, `idClasse`, `nomClasse`, `nbEtudiants`, `niveauClasse`, `descClasse`) VALUES
(1, 'svta', 'SVT-A', 30, '1ère année Bac', 'Classe Branche Science de vie et de terre Groupe A'),
(2, 'svtb', 'SVT-B', 34, 'BAC', 'Desription de la classe BAC'),
(4, 'pha', 'PHY-A', 30, '1ère année  Bac', 'Classe branche Physique Groupe A');
