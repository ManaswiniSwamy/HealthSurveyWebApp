<?php
include 'db_connection.php';
if(isset($_REQUEST))
{
$conn = OpenCon();
echo "Connected Successfully";

$inputFlatNumber = $_POST['inputFlatNumber'];
$sql = "INSERT INTO temp(inputFlatNumber) VALUES ('$inputFlatNumber')";
$result = mysqli_query($conn,$sql);
if($result) {
	echo "Flat number has been added as into the table successfully.";
}
}
CloseCon($conn);
?>
