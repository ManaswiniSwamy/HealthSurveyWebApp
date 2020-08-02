<?php
// Include database connection file
include "db_connection.php";
if(isset($_REQUEST))
{
$conn = OpenCon();
$sqlhousehelp = "SELECT
	t.inputFamilyPhoneNumber,
    t.inputFamilyWhatsAppNumber,
    t.inputFlatNumber,
    t.inputAddress,
    t.inputAddress2,
    t.inputCity,
    t.inputZip,
    inputNameHouseholdHelp,
    inputPhoneNumberHouseholdHelp,
    inputAddressHouseholdHelp
    FROM 
    temp t JOIN household_help_table hht ON
    t.inputFamilyPhoneNumber =  hht.inputFamilyPhoneNumber;";

if (!$result = mysqli_query($conn, $sqlhousehelp)) {
    exit(mysqli_error($conn));
}

$users = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=HouseholdHelpData.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('FamilyPhoneNumber','FamilyWhatsAppNumber','FlatNumber','Address','Address2','City','Zip','NameHouseholdHelp','PhoneNumberHouseholdHelp','AddressHouseholdHelp'));

if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}
}
CloseCon($conn);
?>