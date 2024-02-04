<?php
include_once("connectDb.php");
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
      $sql = "select  id, idClasse, nomClasse, nbEtudiants, niveauClasse, descClasse from classe;";
      $res = $con->query($sql);
      $output = array();
      while($row = $res->fetch(PDO::FETCH_ASSOC)) {
          $output[] = array(
            "id"            => $row["id"],
            "idClasse"         => $row["idClasse"],
            "nomClasse"        => $row["nomClasse"],
            "nbEtudiants"   => $row["nbEtudiants"],
            "niveauClasse"       => $row["niveauClasse"],
            "descClasse"       => $row["descClasse"],
        );
        }
      header("Content-Type: application/json");
      echo json_encode($output);
      exit;
    }

     //POST CODE
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $idClasse = $_POST["idClasse"];
      $nomClasse = $_POST["nomClasse"];
      $nbEtudiants = $_POST["nbEtudiants"];
      $niveauClasse = $_POST["niveauClasse"];
      $descClasse = $_POST["descClasse"];

      $sql= "insert into classe(idClasse, nomClasse, nbEtudiants, niveauClasse, descClasse) 
                values(:idClasse, :nomClasse, :nbEtudiants, :niveauClasse, :descClasse)";
      $statement = $con->prepare($sql);

      $statement->bindParam(':idClasse', $idClasse);
      $statement->bindParam(':nomClasse', $nomClasse);
      $statement->bindParam(':nbEtudiants', $nbEtudiants, PDO::PARAM_INT);
      $statement->bindParam(':niveauClasse', $niveauClasse);
      $statement->bindParam(':descClasse', $descClasse);
      $statement->execute();
    }
     //PUT CODE
     if($_SERVER["REQUEST_METHOD"] == "PUT")
     {
      parse_str(file_get_contents("php://input"), $_PUT);
      $idClasse = $_PUT["idClasse"];
      $nomClasse = $_PUT["nomClasse"];
      $nbEtudiants = $_PUT["nbEtudiants"];
      $niveauClasse = $_PUT["niveauClasse"];
      $descClasse = $_PUT["descClasse"];

      $sql= "update classe set nomClasse=:nomClasse, nbEtudiants=:nbEtudiants,niveauClasse=:niveauClasse, descClasse=:descClasse 
                    where idClasse = :idClasse";
      $statement = $con->prepare($sql);
      $statement->bindParam(':idClasse', $idClasse);
      $statement->bindParam(':nomClasse', $nomClasse);
      $statement->bindParam(':nbEtudiants', $nbEtudiants, PDO::PARAM_INT);
      $statement->bindParam(':niveauClasse', $niveauClasse);
      $statement->bindParam(':descClasse', $descClasse);
      $statement->execute();
     }
      //DELETE CODE
      if($_SERVER["REQUEST_METHOD"] == "DELETE") {
        parse_str(file_get_contents("php://input"), $_DELETE);
        
        $idClasse = $_DELETE["idClasse"];

        //SETTING FOREIGN KEY TO NULL
        $sql = "UPDATE etudiant SET classe = NULL WHERE classe = :idClasse";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idClasse', $idMat);
        $stmt->execute();

        //DELETING MATIERE
        $sql = "DELETE FROM classe WHERE idClasse = :idClasse";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idClasse', $idClasse);
        $stmt->execute();
    }
    
?>