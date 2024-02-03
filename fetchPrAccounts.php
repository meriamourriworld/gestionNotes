<?php
include_once("connectDb.php");
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
      $sql = "select id,idProf, nomProf, prenomProf, matiere,profil
                from professeur 
                where profil IS NULL;";
      $res = $con->query($sql);
      $output = array();
      while($row = $res->fetch(PDO::FETCH_ASSOC)) {
          $output[] = array(
            "id"            => $row["id"],
            "idProf"        => $row["idProf"],
            "nomProf"       => $row["nomProf"],
            "prenomProf"    => $row["prenomProf"],
            "matiere"       => $row["matiere"],
            "profil"        => $row["profil"],
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
      $code = $_PUT["id"];
      $profil = $_PUT["profil"];

      $sql= "update professeur set profil= :profil where id= :code";
      $stat = $con->prepare($sql);
      $stat->bindParam(':code', $code);
      $stat->bindParam(':profil', $profil);
      $stat->execute();
     }
    
?>