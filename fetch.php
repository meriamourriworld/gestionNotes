<?php
include_once("connectDb.php");
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
      $sql = "SELECT * FROM utilisateur";
      $res = $con->query($sql);
      $output = array();

      while($row = $res->fetch(PDO::FETCH_ASSOC)) {
          $output[] = array(
              "idUser"      => $row["idUser"],
              "identifiant" => $row["identifiant"],
              "role"        => $row["role"],
          );
      }
      header("Content-Type: application/json");
      echo json_encode($output);
      exit;
    }
?>