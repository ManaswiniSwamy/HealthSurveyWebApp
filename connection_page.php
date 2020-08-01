<?php
include 'db_connection.php';
if(isset($_REQUEST))
{
$conn = OpenCon();
echo "Connected Successfully";

$extraHouseHelpCount = $_POST['extraHouseHelpCount'];

// Family level details.
$inputFlatNumber = $_POST['inputFlatNumber'];
$inputAddress = $_POST['inputAddress'];
$inputAddress2 = $_POST['inputAddress2'];
$inputCity = $_POST['inputCity'];
$inputZip = $_POST['inputZip'];
$inputFamilyPhoneNumber = $_POST['inputFamilyPhoneNumber']; // PK
$inputFamilyWhatsAppNumber = $_POST['inputFamilyWhatsAppNumber'];

$sql = "INSERT INTO temp(inputFlatNumber,inputAddress,inputAddress2,inputCity,inputZip,inputFamilyPhoneNumber,inputFamilyWhatsAppNumber) VALUES ('$inputFlatNumber', '$inputAddress', '$inputAddress2', '$inputCity', '$inputZip', '$inputFamilyPhoneNumber', '$inputFamilyWhatsAppNumber')";

$result = mysqli_query($conn,$sql);
if($result) {
	echo "Family details have been appended successfully.";
} else echo mysqli_error($conn);

// Family member specific details
// Count of the total number of family members.
$extraPersonCount = $_POST['extraPersonCount'];
$resultFamilyMembers = true;
for ($extraPersonIndex = 0; $extraPersonIndex < $extraPersonCount; $extraPersonIndex++) {
  $inputName = ($extraPersonIndex == 0) ? $_POST['inputName'] : $_POST['inputName'.$extraPersonIndex];
  $inputAge = ($extraPersonIndex == 0) ? $_POST['inputAge'] : $_POST['inputAge'.$extraPersonIndex];
  $inputGender = ($extraPersonIndex == 0) ? $_POST['gender'] : $_POST['gender'.$extraPersonIndex];
  $inputPhoneNumber = ($extraPersonIndex == 0) ? (isset($_POST['inputPhoneNumber']) ? $_POST['inputPhoneNumber']:"") : (isset($_POST["inputPhoneNumber".$extraPersonIndex]) ? $_POST["inputPhoneNumber".$extraPersonIndex] : "");
  $inputWhatsAppNumber = ($extraPersonIndex == 0) ? (isset($_POST['inputWhatsAppNumber']) ? $_POST['inputWhatsAppNumber']:""): (isset($_POST['inputWhatsAppNumber'.$extraPersonIndex]) ? $_POST['inputWhatsAppNumber'.$extraPersonIndex] : "");
  $otherDiseases = ($extraPersonIndex == 0) ? $_POST['otherDiseases'] : $_POST['otherDiseases'.$extraPersonIndex];
  $inputOtherHealthIssue = ($extraPersonIndex == 0) ? (isset($_POST['inputOtherHealthIssue']) ? $_POST['inputOtherHealthIssue'] : "" ): (isset($_POST['inputOtherHealthIssue'.$extraPersonIndex]) ? $_POST['inputOtherHealthIssue'.$extraPersonIndex] : "" );
  $diseases = ($extraPersonIndex == 0) ? ( isset( $_POST['diseases']) ? $_POST['diseases']:[]) : (isset($_POST['diseases'.$extraPersonIndex]) ? $_POST['diseases'.$extraPersonIndex] :[] );
  $pregnantWoman = 0;
  $diabetes = 0;
  $hypertension = 0;
  $tuberculosis = 0;
  $cancer = 0;
  $dialysis = 0;
  $stroke = 0;
  $hivPositive = 0;
  $organTransplant = 0;
  foreach ($diseases as $key => $value) {
  	echo $value;
  	echo "      nnnnnn";
  	if($value == "pregnantWoman") $pregnantWoman = 1;
  	else if($value == "diabetes") $diabetes = 1;
  	else if($value == "hypertension") $hypertension = 1;
  	else if($value == "tuberculosis") $tuberculosis = 1;
  	else if($value == "cancer") $cancer = 1;
  	else if($value == "dialysis") $dialysis = 1;
  	else if($value == "stroke") $stroke = 1;
  	else if($value == "hivPositive") $hivPositive = 1;
  	else if($value == "organTransplant") $organTransplant = 1;
  }
  $sql = "INSERT INTO family_member_table(inputName, inputAge, inputGender, inputPhoneNumber, inputWhatsAppNumber, otherDiseases, inputOtherHealthIssue, inputFamilyPhoneNumber, pregnantWoman, diabetes, hypertension,tuberculosis, cancer, dialysis, stroke, hivPositive, organTransplant) VALUES ('$inputName', '$inputAge', '$inputGender', '$inputPhoneNumber', '$inputWhatsAppNumber', '$otherDiseases', '$inputOtherHealthIssue', '$inputFamilyPhoneNumber', '$pregnantWoman', '$diabetes', '$hypertension', '$tuberculosis', '$cancer', '$dialysis', '$stroke', '$hivPositive', '$organTransplant')";
  $result = mysqli_query($conn,$sql);
  if($result) {
	echo "Family member details have been appended successfully.";
	}
else echo mysqli_error($conn);
}

echo $extraHouseHelpCount;
}
CloseCon($conn);
?>
