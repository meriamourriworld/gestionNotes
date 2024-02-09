<?php
include_once("connectDb.php");
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
      $sqlDev = "select idDev, titreDev, descDev, dateEcheance from devoir where matiere= '".$_COOKIE['idMat']."';";
      $resDev = $con->query($sqlDev);
      $output = array();
      while($row = $resDev->fetch(PDO::FETCH_ASSOC)) {
          $output[] = array(
            "idDev"         => $row["idDev"],
            "titreDev"        => $row["titreDev"],
            "descDev"   => $row["descDev"],
            "dateEcheance"       => $row["dateEcheance"],
        );
        }
      header("Content-Type: application/json");
      echo json_encode($output);
      exit;
    }

     //POST CODE
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $idDev        = $_POST["idDev"];
      $titreDev     = $_POST["titreDev"];
      $descDev      = $_POST["descDev"];
      $dateEcheance = $_POST["dateEcheance"];

      $sqlDev= "insert into devoir(idDev, titreDev, descDev, dateEcheance, matiere) 
                values(:idDev, :titreDev, :descDev, :dateEcheance, :matiere)";
      $statement = $con->prepare($sqlDev);

      $statement->bindParam(':idDev', $idDev);
      $statement->bindParam(':titreDev', $titreDev);
      $statement->bindParam(':descDev', $descDev);
      $statement->bindParam(':dateEcheance', $dateEcheance);
      $statement->bindParam(':matiere',$_COOKIE['idMat']);
      $statement->execute();
    }
     //PUT CODE
     if($_SERVER["REQUEST_METHOD"] == "PUT")
     {
      parse_str(file_get_contents("php://input"), $_PUT);
      $idDev        = $_PUT["idDev"];
      $titreDev     = $_PUT["titreDev"];
      $descDev      = $_PUT["descDev"];
      $dateEcheance = $_PUT["dateEcheance"];

      $sql= "update devoir set titreDev=:titreDev, descDev=:descDev,dateEcheance=:dateEcheance
                    where idDev = :idDev";
      $statement = $con->prepare($sql);
      $statement->bindParam(':idDev', $idDev);
      $statement->bindParam(':titreDev', $titreDev);
      $statement->bindParam(':descDev', $descDev);
      $statement->bindParam(':dateEcheance', $dateEcheance);
      $statement->execute();
     }
      //DELETE CODE
      if($_SERVER["REQUEST_METHOD"] == "DELETE") {
        parse_str(file_get_contents("php://input"), $_DELETE);
        
        $idDev = $_DELETE["idDev"];

        //SETTING FOREIGN KEY TO NULL
        $sql = "UPDATE etudiant SET classe = NULL WHERE classe = :idClasse";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idClasse', $idMat);
        $stmt->execute();

        //DELETING MATIERE
        $sqlDev = "DELETE FROM devoir WHERE idDev = :idDev";
        $stmt = $con->prepare($sqlDev);
        $stmt->bindParam(':idDev', $idDev);
        $stmt->execute();
    }
    
?>