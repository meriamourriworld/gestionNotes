<?php
include_once("connectDb.php");
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
      $sql = "select  id,idProf,nomProf,prenomProf,dateNaissance,adresseProf,mailProf,telProf,photoProf,matiere,profil from professeur;";
      $res = $con->query($sql);
      $output = array();
      while($row = $res->fetch(PDO::FETCH_ASSOC)) {
          $output[] = array(
            "id"            => $row["id"],
            "idProf"         => $row["idProf"],
            "nomProf"        => $row["nomProf"],
            "prenomProf"   => $row["prenomProf"],
            "dateNaissance"       => $row["dateNaissance"],
            "adresseProf"       => $row["adresseProf"],
            "mailProf"       => $row["mailProf"],
            "telProf"       => $row["telProf"],
            "photoProf"       => base64_encode($row["photoProf"]),
            "matiere"       => $row["matiere"],
            "profil"       => $row["profil"],
        );
        }
      header("Content-Type: application/json");
      echo json_encode($output);
      exit;
    }

     //POST CODE
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $idProf          = $_POST["idProf"];
        $nomProf         = $_POST["nomProf"];
        $prenomProf      = $_POST["prenomProf"];
        $dateNaissance   = $_POST["dateNaissance"];
        $adresseProf     = $_POST["adresseProf"];
        $mailProf        = $_POST["mailProf"];
        $telProf         = $_POST["telProf"];
        $photoProf       = $_POST["photoProf"];
        $matiere         = $_POST["matiere"];
        $profil          = $_POST["profil"];

      $sql= "insert into professeur(idProf,nomProf,prenomProf,dateNaissance,adresseProf,mailProf,telProf,photoProf,matiere,profil)
             values( :idProf, :nomProf, :prenomProf, :dateNaissance, :adresseProf, :mailProf, :telProf, :photoProf, :matiere, :profil)";
      $statement = $con->prepare($sql);

      $stat->bindParam(':idProf', $idProf);
      $stat->bindParam(':nomProf', $nomProf);
      $stat->bindParam(':prenomProf', $prenomProf);
      $stat->bindParam(':dateNaissance', $dateNaissance);
      $stat->bindParam(':adresseProf', $adresseProf);
      $stat->bindParam(':mailProf', $mailProf);
      $stat->bindParam(':telProf', $telProf);
      $stat->bindParam(':photoProf', $photoProf);
      $stat->bindParam(':matiere', $matiere);
      $stat->bindParam(':profil', $profil, PDO::PARAM_INT);
      $statement->execute();
    }

     //PUT CODE
     if($_SERVER["REQUEST_METHOD"] == "PUT")
     {
      parse_str(file_get_contents("php://input"), $_PUT);
      $image = file_get_contents($_PUT["photoProf"]); 
      $image = addslashes($image); 
  
      $idProf          = $_PUT["idProf"];
      $nomProf         = $_PUT["nomProf"];
      $prenomProf      = $_PUT["prenomProf"];
      $dateNaissance   = $_PUT["dateNaissance"];
      $adresseProf     = $_PUT["adresseProf"];
      $mailProf        = $_PUT["mailProf"];
      $telProf         = $_PUT["telProf"];
      $photoProf       = $image;
      $matiere         = $_PUT["matiere"];
      $profil          = $_PUT["profil"];


      $sql= "update professeur set nomProf=:nomProf, prenomProf=:prenomProf, dateNaissance=:dateNaissance,
            adresseProf=:adresseProf, mailProf=:mailProf, telProf=:telProf,  matiere=:matiere, profil=:profil
             where idProf = :idProf";

      $stat = $con->prepare($sql);
      $stat->bindParam(':idProf', $idProf);
      $stat->bindParam(':nomProf', $nomProf);
      $stat->bindParam(':prenomProf', $prenomProf);
      $stat->bindParam(':dateNaissance', $dateNaissance);
      $stat->bindParam(':adresseProf', $adresseProf);
      $stat->bindParam(':mailProf', $mailProf);
      $stat->bindParam(':telProf', $telProf);
      $stat->bindParam(':photoProf', $photoProf);
      $stat->bindParam(':matiere', $matiere);
      $stat->bindParam(':profil', $profil, PDO::PARAM_INT);
      $stat->execute();
     }


      //DELETE CODE
      if($_SERVER["REQUEST_METHOD"] == "DELETE") {
        parse_str(file_get_contents("php://input"), $_DELETE);
        
        $idProf = $_DELETE["idProf"];

        //SETTING FOREIGN KEY TO NULL
        $sql = "DELETE FROM classeprof WHERE professeur = :idProf";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idProf', $idProf);
        $stmt->execute();

        //DELETING MATIERE
        $sql = "DELETE FROM professeur WHERE idProf = :idProf";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idProf', $idProf);
        $stmt->execute();
    }
    
?>