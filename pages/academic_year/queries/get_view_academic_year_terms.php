<?php   require_once "../../../resources/fxn/config.php";

$year_id = $_GET['year_id'];

$query = "SELECT ty.term_year_id, t.name, ty.created_at, 
          tbl_user.username as created_by, ty.status
          FROM ACADEMIC_TERMS ty 
          LEFT JOIN ACADEMIC_YEAR t ON t.id = ty.term_id
          WHERE academic_id=:year_id";


$sql = $dbh->prepare($query);

$sql->bindParam(":year_id", $year_id, PDO::PARAM_STR);
$sql->execute();

$result = $sql->fetchAll(PDO::FETCH_OBJ);

echo json_encode($result);

?>