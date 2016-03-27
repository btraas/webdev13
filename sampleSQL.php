<?php
$link = new mysqli("bcitdevcom.ipagemysql.com",
"comp15362014", "2014-1536")
or die("Could not connect: " . $link->connect_error());
print ("Connected successfully<br>");
$link->select_db("1536forum");
$query = "SELECT * FROM members";
$result = $link->query($query);
while ($row = $result->fetch_assoc()) { // get a row
$lastName = $row['lastname']; // get last name
$firstName = $row['firstname']; // get first name
echo $lastName . ", " . $firstName . "<br>"; }
$link->close();
?>
