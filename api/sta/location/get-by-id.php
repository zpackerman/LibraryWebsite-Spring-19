<?php
/**
* API end point returns a location based on ID as JSON
**/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../objects/location.php';

 $database = new Database();
 $db = $database->getConnection();
 $location = new Location($db);
 $result = $location->getById($_GET["id"]);
 $row = $result->fetch_assoc();

 $num = $result->num_rows;
 if($num>0) {
  $payload = array (
    "id" => $row["locAID"],
    "title" => $row["locTitle"],
    "dept" => $row["FK_deptID"]
  );
  http_response_code(200);
  echo json_encode($payload);
} else {
  // set response code - 404 Not found
   http_response_code(204);

   // tell the user no products found
   echo json_encode(
       array("message" => "No locations found with this ID.")
   );
}
 ?>
