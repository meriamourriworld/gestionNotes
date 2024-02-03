<?php
include_once("connectDb.php");
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
      $sql = "select idUser, identifiant, role, nomProf,prenomProf, nomEtud, prenomEtud 
                from utilisateur LEFT JOIN professeur
                ON utilisateur.idUser = professeur.profil
                LEFT JOIN etudiant
                ON utilisateur.idUser = etudiant.profil;";
      $res = $con->query($sql);
      $output = array();
      while($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $nom="";
        $prenom="";
        if($row["role"] == "professeur"){$nom=$row["nomProf"];$prenom=$row["prenomProf"];}
        if($row["role"] == "etudiant"){$nom=$row["nomEtud"];$prenom=$row["prenomEtud"];}
        $output[] = array(
            "idUser"      => $row["idUser"],
            "identifiant" => $row["identifiant"],
            "role"        => $row["role"],
            "nom"         => $nom,
            "prenom"      => $prenom
        );
    }
    
      header("Content-Type: application/json");
      echo json_encode($output);
      exit;
    }
?>