<?php require_once "../../../resources/fxn/config.php";

$year_id = $_GET['year_id'];

$query = "SELECT academic_name, created_at, isActive
          FROM ACADEMIC_YEAR 
          WHERE academic_id =:academic_id";

$sql = $dbh->prepare($query);

$sql->bindParam(":academic_id", $year_id, PDO::PARAM_STR);

$sql->execute();

$result = $sql->fetchAll(PDO::FETCH_OBJ);

echo json_encode($result);

?>