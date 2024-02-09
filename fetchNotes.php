<?php
include_once("connectDb.php");
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $sqlLstEtud = "select * from etudiant where cne in (select etudiant from notes where devoir='".$_COOKIE['dev']."');";
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
      $devoir        = $_PUT["devoir"];
      $cne          = $_PUT["cne"];
      $note         = $_PUT["note"];

      $sql= "insert into notes(etudiant, devoir, note) values (:cne, :devoir, :note)";
      $statement = $con->prepare($sql);
      $statement->bindParam(':cne', $cne);
      $statement->bindParam(':devoir', $devoir);
      $statement->bindParam(':note', $note);
      $statement->execute();
     }
?>