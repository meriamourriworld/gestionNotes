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

       //Liste de tous les étudiants des différentes classes attribuées au professeur
       $sqlLstEtud = "select * from etudiant where classe in (select classe from classeprof where professeur='".$_COOKIE["currentMatricule"]."') order by classe;";
       $sqlLstEtudRes = $con->query($sqlLstEtud);
       while($row = $sqlLstEtudRes->fetch(PDO::FETCH_ASSOC))
       {
        $req = "insert into notes(etudiant, devoir) values('".$row["cne"]."', '".$idDev."');";
        $con->exec($req);
       }
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
        $sql = "DELETE FROM notes WHERE devoir = :idDev";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idDev', $idDev);
        $stmt->execute();

        //DELETING MATIERE
        $sqlDev = "DELETE FROM devoir WHERE idDev = :idDev";
        $stmt = $con->prepare($sqlDev);
        $stmt->bindParam(':idDev', $idDev);
        $stmt->execute();
    }
    
?>