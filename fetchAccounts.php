<?php
include_once("connectDb.php");
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
      $sql = "select idUser, identifiant, motPasse, role, nomProf,prenomProf, nomEtud, prenomEtud 
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
            "motPasse"      => substr($row["motPasse"],0,8),
            "role"        => $row["role"],
            "nom"         => $nom,
            "prenom"      => $prenom,

        );
    }
      header("Content-Type: application/json");
      echo json_encode($output);
      exit;
    }

     //POST CODE
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $id = $_POST["identifiant"];
      $pass = password_hash($_POST["motPasse"], PASSWORD_DEFAULT);
      $role = $_POST["role"];
      
      $sql= "insert into utilisateur(identifiant, motPasse, role) values(:id, :pass, :role)";
      $statement = $con->prepare($sql);

      $statement->bindParam(':id', $id);
      $statement->bindParam(':pass', $pass);
      $statement->bindParam(':role', $role);
      $statement->execute();
    }
     //PUT CODE
     if($_SERVER["REQUEST_METHOD"] == "PUT")
     {
      parse_str(file_get_contents("php://input"), $_PUT);
      $code = $_PUT["idUser"];
      $id = $_PUT["identifiant"];
      $role = $_PUT["role"];
        if($role != "admin")
        {
          $sql= "update utilisateur set identifiant= :id, role=:role where idUser= :code";
          $stat = $con->prepare($sql);
          $stat->bindParam(':code', $code);
          $stat->bindParam(':id', $id);
          $stat->bindParam(':role', $role);
          $stat->execute();
        }
     }
?>