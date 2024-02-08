<?php
include_once("connectDb.php");
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
      $sql = "select  id, cne, nomEtud,prenomEtud,dnEtud,adresseEtud,mailEtud,telEtud,photoEtud, classe,profil from etudiant;";
      $res = $con->query($sql);
      $output = array();
      while($row = $res->fetch(PDO::FETCH_ASSOC)) {
          $output[] = array(
            "id"            => $row["id"],
            "cne"         => $row["cne"],
            "nomEtud"        => $row["nomEtud"],
            "prenomEtud"   => $row["prenomEtud"],
            "dnEtud"       => $row["dnEtud"],
            "adresseEtud"       => $row["adresseEtud"],
            "mailEtud"       => $row["mailEtud"],
            "telEtud"       => $row["telEtud"],
            "photoEtud"       => base64_encode($row["photoEtud"]),
            "classe"       => $row["classe"],
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
        $cne             = $_POST["cne"];
        $nomEtud         = $_POST["nomEtud"];
        $prenomEtud      = $_POST["prenomEtud"];
        $dnEtud          = $_POST["dnEtud"];
        $adresseEtud     = $_POST["adresseEtud"];
        $mailEtud        = $_POST["mailEtud"];
        $telEtud         = $_POST["telEtud"];
        $photoEtud       = file_get_contents($_FILES['photoEtud']['tmp_name']); 
        $classe         = $_POST["classe"];
        $profil          = $_POST["profil"];

      $sql= "insert into etudiant(cne, nomEtud,prenomEtud,dnEtud,adresseEtud,mailEtud,telEtud,photoEtud, classe,profil)
             values( :cne, :nomEtud, :prenomProf, :dateNaissance, :adresseProf, :mailProf,  :telProf, :photoEtud, :classe, :profil)";
      $stat = $con->prepare($sql);

      $stat->bindParam(':cne', $cne);
      $stat->bindParam(':nomEtud', $nomEtud);
      $stat->bindParam(':prenomEtud', $prenomEtud);
      $stat->bindParam(':dnEtud', $dnEtud);
      $stat->bindParam(':adresseEtud', $adresseEtud);
      $stat->bindParam(':mailEtud', $mailEtud);
      $stat->bindParam(':telEtud', $telEtud);
      $stat->bindParam(':photoEtud', $photoEtud);
      $stat->bindParam(':classe', $classe);
      $stat->bindParam(':profil', $profil);
      $stat->execute();
      header("location:gestionEtudiants.php");
    }
      //DELETE CODE
      if($_SERVER["REQUEST_METHOD"] == "DELETE") {
        parse_str(file_get_contents("php://input"), $_DELETE);
        
        $cne = $_DELETE["cne"];
        //SETTING FOREIGN KEY TO NULL
        $sql = "DELETE FROM notes WHERE etudiant = :cne";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':cne', $cne);
        $stmt->execute();

        //DELETING MATIERE
        $sql = "DELETE FROM etudiant WHERE cne = :cne";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':cne', $cne);
        $stmt->execute();
    }
    
?>