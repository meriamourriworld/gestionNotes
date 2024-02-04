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
        if($row["role"]!="admin")
        {
          $output[] = array(
            "idUser"      => $row["idUser"],
            "identifiant" => $row["identifiant"],
            "motPasse"      => substr($row["motPasse"],0,10),
            "role"        => $row["role"],
            "nom"         => $nom,
            "prenom"      => $prenom,
        );
        }

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

      $sql= "update utilisateur set identifiant= :id, role=:role where idUser= :code";
      $stat = $con->prepare($sql);
      $stat->bindParam(':code', $code);
      $stat->bindParam(':id', $id);
      $stat->bindParam(':role', $role);
      $stat->execute();
     }
      //DELETE CODE
      if($_SERVER["REQUEST_METHOD"] == "DELETE") {
        parse_str(file_get_contents("php://input"), $_DELETE);
        $id = $_DELETE["idUser"];
        $role = $_DELETE["role"];
        //SETTING FOREIGN KEY TO NULL
        if($role == "professeur") {
            $sql = "UPDATE professeur SET profil = NULL WHERE profil = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } elseif($role == "etudiant") {
            $sql = "UPDATE etudiant SET profil = NULL WHERE profil = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        //DELETING ACCOUNT
        $sql = "DELETE FROM utilisateur WHERE idUser = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
?>