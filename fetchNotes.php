<?php
include_once("connectDb.php");
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $sqlLstEtud = "select * from etudiant where cne in (select etudiant from notes where note is null and devoir='".$_COOKIE['dev']."');";
        $sqlLstEtudRes = $con->query($sqlLstEtud);
      $output = array();
      while($row = $sqlLstEtudRes->fetch(PDO::FETCH_ASSOC)) {
          $output[] = array(
            "cne"         => $row["cne"],
            "nomEtud"        => $row["nomEtud"],
            "prenomEtud"   => $row["prenomEtud"],
            "classe"       => $row["classe"],
        );
        }
      header("Content-Type: application/json");
      echo json_encode($output);
      exit;
    }

     //PUT CODE
     if($_SERVER["REQUEST_METHOD"] == "PUT")
     {
      parse_str(file_get_contents("php://input"), $_PUT);
      $devoir        = $_COOKIE["dev"];
      $cne          = $_PUT["cne"];
      $note         = $_PUT["note"];

      $sql= "update notes set note= :note where etudiant = :etudiant and devoir= :devoir;";
      $statement = $con->prepare($sql);
      $statement->bindParam(':etudiant', $cne);
      $statement->bindParam(':devoir', $devoir);
      $statement->bindParam(':note', $note);
      $statement->execute();
     }
?>