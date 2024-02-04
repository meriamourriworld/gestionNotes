<?php
include_once("connectDb.php");
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
      $sql = "select id, idMat, nomMat, objectifMat, coefMat from matiere;";
      $res = $con->query($sql);
      $output = array();
      while($row = $res->fetch(PDO::FETCH_ASSOC)) {
          $output[] = array(
            "id"            => $row["id"],
            "idMat"         => $row["idMat"],
            "nomMat"        => $row["nomMat"],
            "objectifMat"   => $row["objectifMat"],
            "coefMat"       => $row["coefMat"],
        );
        }
      header("Content-Type: application/json");
      echo json_encode($output);
      exit;
    }

     //POST CODE
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $idMat = $_POST["idMat"];
      $nomMat = $_POST["nomMat"];
      $objectifMat = $_POST["objectifMat"];
      $coefMat = $_POST["coefMat"];

      $sql= "insert into matiere( idMat, nomMat, objectifMat, coefMat) values(:idMat, :nomMat, :objectifMat, :coefMat)";
      $statement = $con->prepare($sql);

      $statement->bindParam(':idMat', $idMat);
      $statement->bindParam(':nomMat', $nomMat);
      $statement->bindParam(':objectifMat', $objectifMat);
      $statement->bindParam(':coefMat', $coefMat, PDO::PARAM_INT);
      $statement->execute();
    }
     //PUT CODE
     if($_SERVER["REQUEST_METHOD"] == "PUT")
     {
      parse_str(file_get_contents("php://input"), $_PUT);
      $idMat = $_PUT["idMat"];
      $nomMat = $_PUT["nomMat"];
      $objectifMat = $_PUT["objectifMat"];
      $coefMat = $_PUT["coefMat"];

      $sql= "update matiere set nomMat=:nomMat, objectifMat=:objectifMat, coefMat=:coefMat where idMat = :idMat";
      $stat = $con->prepare($sql);
      $stat->bindParam(':idMat', $idMat);
      $stat->bindParam(':nomMat', $nomMat);
      $stat->bindParam(':objectifMat', $objectifMat);
      $stat->bindParam(':coefMat', $coefMat, PDO::PARAM_INT);
      $stat->execute();
     }
      //DELETE CODE
      if($_SERVER["REQUEST_METHOD"] == "DELETE") {
        parse_str(file_get_contents("php://input"), $_DELETE);
        
        $idMat = $_DELETE["idMat"];

        //SETTING FOREIGN KEY TO NULL
        $sql = "UPDATE professeur SET matiere = NULL WHERE matiere = :idMat";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idMat', $idMat);
        $stmt->execute();

        //DELETING MATIERE
        $sql = "DELETE FROM matiere WHERE idMat = :idMat";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idMat', $idMat);
        $stmt->execute();
    }
    
?>