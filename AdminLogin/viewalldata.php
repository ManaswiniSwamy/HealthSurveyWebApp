<?php
// Include database connection file
include "db_connection.php";
if(isset($_REQUEST))
{
$conn = OpenCon();
$sql = "SELECT
    t.inputFamilyPhoneNumber,
    t.inputFamilyWhatsAppNumber,
    t.inputFlatNumber,
    t.inputAddress,
    t.inputAddress2,
    t.inputCity,
    t.inputZip,
    inputName,
    inputAge,
    inputGender,
    inputPhoneNumber,
    inputWhatsAppNumber,
    pregnantWoman,
    diabetes,
    hypertension,
    tuberculosis,
    cancer,
    dialysis,
    stroke,
    hivPositive,
    organTransplant,
    otherDiseases,
    inputOtherHealthIssue
FROM
    temp t JOIN family_member_table fmt ON
    t.inputFamilyPhoneNumber = fmt.inputFamilyPhoneNumber";

if (!$result = mysqli_query($conn, $sql)) {
    exit(mysqli_error($conn));
}

$users = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=FamilyMembersData.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('FamilyPhoneNumber','FamilyWhatsAppNumber','FlatNumber','Address','Address2','City','Zip','Name','Age','Gender','PhoneNumber','WhatsAppNumber','PregnantWoman','Diabetes','Hypertension','Tuberculosis','Cancer','Dialysis','Stroke','HivPositive','OrganTransplant','OtherDiseases','InputOtherHealthIssue'));

if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}
}
CloseCon($conn);
?>

