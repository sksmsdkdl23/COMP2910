<?php 

/*
** Connect to database:
*/

// Connect to the database (host, username, password)
$con = mysql_connect('localhost:3306','sadapaac_student','fireflies131') 
    or die('Could not connect to the server!');

// Select a database:
mysql_select_db('sadapaac_preservit') 
    or die('Could not select a database.');
 
// Example query: (TOP 10 equal LIMIT 0,10 in MySQL)
$SQL = "SELECT * FROM foodItem WHERE itemName = 'banana';";
 
// Execute query:
$result = mysql_query($SQL) 
    or die('A error occured: ' . mysql_error());
 
// Get result count:
$Count = mysql_num_rows($result);
print "Showing $count rows:<hr/>\n\n";
 
// Fetch rows:
while ($Row = mysql_fetch_assoc($result)) {
 
    $itemName = $Row['itemName'] . "\n";
	$howToPreserve = $Row['howToPreserve'];
	$howToSave = $Row['howToSave'];
	$goingBad = $Row["howToTellIfGoingBad"];
	$recipes = $Row["recipes"];
 
}
 

include 'header.html';

echo 
"<ul>
<li>$itemName -- $howToPreserve -- $howToSave -- $goingBad --  $recipes</li>
</ul>";

mysql_close($con);
include 'footer.html';
?>
