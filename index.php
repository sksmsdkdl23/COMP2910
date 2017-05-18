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
$SQLFruit = "SELECT * FROM foodItem WHERE category = 'fruits'";
$SQLDairy = "SELECT * FROM foodItem WHERE category = 'dairy'";
$SQLGrains = "SELECT * FROM foodItem WHERE category = 'grains'";
$SQLVegetables = "SELECT * FROM foodItem WHERE category = 'vegetables'";
$SQLMeats = "SELECT * FROM foodItem WHERE category = 'meats'";
 
// Execute query:
$result = mysql_query($SQL) 
    or die('A error occured: ' . mysql_error());

$resultFruit = mysql_query($SQLFruit)
	or die ('A error occured: ' . mysql_error());
	
$resultVegetables = mysql_query($SQLVegetables)
	or die ('A error occured: ' . mysql_error());
	
$resultDairies = mysql_query($SQLDairy)
	or die ('A error occured: ' . mysql_error());
	
$resultMeats = mysql_query($SQLMeats)
	or die ('A error occured: ' . mysql_error());
	
$resultGrains = mysql_query($SQLGrains)
	or die ('A error occured: ' . mysql_error());
	
$fruitList;
$vegetableList;
$dairyList;
$meatList;
$grainList;
 

 
// Generate category items Fruit
while ($Fruits = mysql_fetch_assoc($resultFruit)){
	$fruitList .= htmlentities("<li><a href='item.php?squery=" . $Fruits['itemName'] . "'>" . $Fruits['itemName'] . "</a></li>\n");
}

while ($Vegetables = mysql_fetch_assoc($resultVegetables)){
	$vegetableList .= htmlentities("<li><a href='item.php?squery=" . $Vegetables['itemName'] . "'>" . $Vegetables['itemName'] . "</a></li>\n");
}

while ($Dairy = mysql_fetch_assoc($resultDairies)){
	$dairyList .= htmlentities("<li><a href='item.php?squery=" . $Dairy['itemName'] . "'>" . $Dairy['itemName'] . "</a></li>\n");
}

while ($Meats = mysql_fetch_assoc($resultMeats)){
	$meatList .= htmlentities("<li><a href='item.php?squery=" . $Meats['itemName'] . "'>" . $Meats['itemName'] . "</a></li>\n");
}

while ($Grains = mysql_fetch_assoc($resultGrains)){
	$grainList .= htmlentities("<li><a href='item.php?squery=" . $Fruits['itemName'] . "'>" . $Grains['itemName'] . "</a></li>\n");
}
// example code for fruitlist, not working yet $fruitList = "<li><a href='fruits/" . $Fruits['itemName'] . "'</li>";
// example html for fruit: <li><a href='fruits/apple.html'>Apple</a></li>
// donn't make it refer to html pages, gonna try to make it refer to an item.php page that generates the page 
// old fruit code "<li><a href='fruits/" . $Fruits['itemName'] . "'>" . $Fruits['itemName'] . "</a></li>\n"

// Fetch rows:
while ($Row = mysql_fetch_assoc($result)) {
 
    $itemName = $Row['itemName'] . "\n";
	$howToPreserve = $Row['howToPreserve'];
	$howToSave = $Row['howToSave'];
	$goingBad = $Row['howToTellIfGoingBad'];
	$recipes = $Row['recipes'];
 
}
$htmlfruitlist = html_entity_decode($fruitList);
$htmlvegetablelist = html_entity_decode($vegetableList);
$htmlmeatlist = html_entity_decode($meatList);
$htmldairylist = html_entity_decode($dairyList);
$htmlgrainlist = html_entity_decode($grainList);

?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Preserve.it</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
      <div class="background" id="main">
        <div id="mySidenav" class="sidenav visible-lg visible-md">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <a href="index.php">Home</a>
          <a href="#" id="fruit">Fruit</a>
          <div id="items1" class="items">
            <ul>
              <?php echo "$htmlfruitlist"; ?>
            </ul>
          </div>
          <a href="#" id="meat">Meat</a>
          <div id="items2" class="items">
            <ul>
              <?php echo "$htmlmeatlist"; ?>
            </ul>
          </div>
          <a href="#" id="vegetable">Vegetables</a>
          <div id="items3" class="items">
            <ul>
              <?php echo "$htmlvegetablelist"; ?>
            </ul>
          </div>
          <a href="#" id="dairy">Dairy</a>
          <div id="items4" class="items">
            <ul>
              <?php echo "$htmldairylist"; ?>
            </ul>
          </div>
          <a href="#" id="grain">Grains</a>
          <div id="items5" class="items">
            <ul>
              <?php echo "$htmlgrainlist"; ?>
            </ul>
          </div>
            <a href="affiliated/apps.php" id="affiliated">Affiliated Apps</a>
          
        </div>
        <span id="open" onclick="openNav()" class="visible-lg visible-md">&#9776;</span>
        
        <nav class="navbar topnav visible-sm visible-xs">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle topnavButton" data-toggle="collapse" data-target="#myNavbar">
                  &#9776;                 
              </button>
              <a class="navbar-brand" href="index.php">PreservIt</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Fruits <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <?php echo "$htmlfruitlist"; ?>
                  </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Vegetables <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <?php echo "$htmlvegetablelist"; ?>
                  </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Dairy <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <?php echo "$htmldairylist"; ?>
                  </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Meats <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <?php echo "$htmlmeatlist"; ?>
                  </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Grains <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <?php echo "$htmlgrainlist"; ?>
                  </ul>
                </li>
                <li class="">
                    <a href="affiliated/apps.php">Affiliated Apps</a>
                </li>
                  
              </ul>
            </div>
          </div>
        </nav>

        <div id="title" class="row">
          <h1 class="">
            <img src="image/logo.png" alt="PreservIT Logo" style="width:90%;height:auto;max-width:705px;max-height:128px;">
          </h1>
        </div>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
              <div id="imaginary_container">
                  <div class="input-group stylish-input-group">
                      <form action="item.php" method = "GET">
						<input type="text" class="form-control"  placeholder="Search" name="squery" >
					  </form>
                      <span class="input-group-addon">
                          <button type="submit">
                              <image src="image/search2.png" width="15" height="15" alt="submit">
                          </button>
                      </span>
                  </div>
              </div>
          </div>
      	</div>

        <script>
          $('.nav li a').click(function() {
            $('.nav li a').css("background-color", "transparent");
          });

          $('#fruit').click(function() {
            if ($('#items1').is(":visible") == false) {
              $('#items2').hide("slow");
              $('#items3').hide("slow");
              $('#items4').hide("slow");
              $('#items5').hide("slow");
              $('#items1').show("slow");
              document.getElementById("mySidenav").style.width = "150px";
            } else if($('#items1').is(":visible") == true) {
              $('#items1').hide("slow");
            }
          });

          $('#meat').click(function() {
            if ($('#items2').is(":visible") == false) {
              $('#items1').hide("slow");
              $('#items3').hide("slow");
              $('#items4').hide("slow");
              $('#items5').hide("slow");
              $('#items2').show("slow");
              document.getElementById("mySidenav").style.width = "150px";
            } else if($('#items2').is(":visible") == true) {
              $('#items2').hide("slow");
            }
          });

          $('#vegetable').click(function() {
            if ($('#items3').is(":visible") == false) {
              $('#items2').hide("slow");
              $('#items1').hide("slow");
              $('#items4').hide("slow");
              $('#items5').hide("slow");
              $('#items3').show("slow");
              document.getElementById("mySidenav").style.width = "150px";
            } else if($('#items3').is(":visible") == true) {
              $('#items3').hide("slow");
            }
          });

          $('#dairy').click(function() {
            if ($('#items4').is(":visible") == false) {
              $('#items2').hide("slow");
              $('#items3').hide("slow");
              $('#items1').hide("slow");
              $('#items5').hide("slow");
              $('#items4').show("slow");
              document.getElementById("mySidenav").style.width = "150px";
            } else if($('#items4').is(":visible") == true) {
              $('#items4').hide("slow");
            }
          });
          
          $('#grain').click(function() {
            if ($('#items5').is(":visible") == false) {
              $('#items2').hide("slow");
              $('#items3').hide("slow");
              $('#items4').hide("slow");
              $('#items1').hide("slow");
              $('#items5').show("slow");
              document.getElementById("mySidenav").style.width = "150px";
            } else if($('#items5').is(":visible") == true) {
              $('#items5').hide("slow");
            }
          });
        
          function openNav() {
            document.getElementById("mySidenav").style.width = "150px";
          }
          function closeNav() {
            if ($('.items').is(":visible") == true) {
              $('.items').hide("fast");
            }
            document.getElementById("mySidenav").style.width = "0";
          }
        </script>
      </div>
    </body>
<?php
	mysql_close($con);
?>
</html>
