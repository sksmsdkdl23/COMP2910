<?php 

/*
** Connect to database:
*/

// Connect to the database (host, username, password)
if ($_GET == null)
	$squery = "apple";
	
$squery = htmlspecialchars($_GET['squery']);

$con = mysql_connect('localhost:3306','sadapaac_student','fireflies131') 
    or die('Could not connect to the server!');

// Select a database:
mysql_select_db('sadapaac_preservit') 
    or die('Could not select a database.');
 
// Example query: (TOP 10 equal LIMIT 0,10 in MySQL)
// Query we need: (SELECT * FROM foodItem WHERE itemName LIKE ('%$userinput%');
$SQL = "SELECT * FROM foodItem WHERE itemName LIKE ('$squery%')";
$SQLFruit = "SELECT * FROM foodItem WHERE category = 'fruit'";
 
// Execute query:
$result = mysql_query($SQL) 
    or die('A error occured: ' . mysql_error());

$resultFruit = mysql_query($SQLFruit)
	or die ('A error occured: ' . mysql_error());
	
$fruitList;
 
// Get result count:
$Count = mysql_num_rows($result);
print "Showing $count rows:<hr/>\n\n";
 
// Generate category items Fruit
while ($Fruits = mysql_fetch_assoc($resultFruit)){
	$fruitList .= htmlentities("<li><a href='fruits/" . $Fruits['itemName'] . "'>" . $Fruits['itemName'] . "</li>\n");
}
// example code for fruitlist, not working yet $fruitList = "<li><a href='fruits/" . $Fruits['itemName'] . "'</li>";
// example html for fruit: <li><a href='fruits/apple.html'>Apple</a></li>

// Fetch rows:
while ($Row = mysql_fetch_assoc($result)) {
 
    $itemName = $Row['itemName'] . "\n";
	$howToPreserve = $Row['howToPreserve'];
	$howToSave = $Row['howToSave'];
	$goingBad = $Row['howToTellIfGoingBad'];
	$recipes = $Row['recipes'];
 
}
$htmlfruitList = html_entity_decode($fruitList);

include 'header.html';
include 'searchform.html';
include 'body.html';
echo 
"<ul>
<li>$itemName -- $howToPreserve -- $howToSave -- $goingBad --  $recipes -- $fruitList -- $resultFruit</li>
</ul>"
;

mysql_close($con);
include 'footer.html';
?>
