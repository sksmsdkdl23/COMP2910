<?php 
		
		/* passes session from home page
		session_start();
		
		$itemName = $_SESSION['itemName']; 
		*/
		// passing data by requerying server with get request
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
			$fruitList .= htmlentities("<li><a href='../item.php?squery=" . $Fruits['itemName'] . "'>" . $Fruits['itemName'] . "</a></li>\n");
		}
		while ($Vegetables = mysql_fetch_assoc($resultVegetables)){
			$vegetableList .= htmlentities("<li><a href='../item.php?squery=" . $Vegetables['itemName'] . "'>" . $Vegetables['itemName'] . "</a></li>\n");
		}

		while ($Dairy = mysql_fetch_assoc($resultDairies)){
			$dairyList .= htmlentities("<li><a href='../item.php?squery=" . $Dairy['itemName'] . "'>" . $Dairy['itemName'] . "</a></li>\n");
		}

		while ($Meats = mysql_fetch_assoc($resultMeats)){
			$meatList .= htmlentities("<li><a href='../item.php?squery=" . $Meats['itemName'] . "'>" . $Meats['itemName'] . "</a></li>\n");
		}

		while ($Grains = mysql_fetch_assoc($resultGrains)){
			$grainList .= htmlentities("<li><a href='../item.php?squery=" . $Grains['itemName'] . "'>" . $Grains['itemName'] . "</a></li>\n");
		}
		// example code for fruitlist, not working yet $fruitList = "<li><a href='fruits/" . $Fruits['itemName'] . "'</li>";
		// example html for fruit: <li><a href='fruits/apple.html'>Apple</a></li>
		// donn't make it refer to html pages, gonna try to make it refer to an item.php page that generates the page 
		// old fruit code "<li><a href='fruits/" . $Fruits['itemName'] . "'>" . $Fruits['itemName'] . "</a></li>\n"

		// Fetch rows:
		while ($Row = mysql_fetch_assoc($result)) {
		 
			$itemName = $Row['itemName'];
			$howToPreserve = $Row['howToPreserve'];
			$howToSave = $Row['howToSave'];
			$goingBad = $Row['howToTellIfGoingBad'];
			$recipes = $Row['recipes'];
			$image1 = $Row['image1'];
			$image2 = $Row['image2'];
			$image3 = $Row['image3'];
			$category = $Row['category'];
		 
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <style>
          .carousel-inner > .item > img,
          .carousel-inner > .item > a > img {
            width: 40%;
            margin: auto;
          }
          .myCarousel {
            margin: 50px 0;
          }
        </style>
    </head>
    <body>
      <div class="background item">
        <div id="mySidenav" class="sidenav visible-lg visible-md">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <a href="../index.php">Home</a>
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
            <a href="../affiliated/apps.php" id="affiliated">Affiliated Apps</a>
        </div>
        <span id="open" onclick="openNav()" class="visible-lg visible-md">&#9776;</span>
        
        <nav class="navbar topnav visible-sm visible-xs">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle topnavButton" data-toggle="collapse" data-target="#myNavbar">
                  &#9776;                 
              </button>
              <a class="navbar-brand" href="../index.php">PreservIt</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="active"><a href="../index.php">Home</a></li>
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
                    <a href="../affiliated/apps.php">Affiliated Apps</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
              <div id="imaginary_container">
                  <div class="input-group stylish-input-group">
					<form action="../item.php" method = "GET">
						<input type="text" class="form-control"  placeholder="Search" name="squery" >
					</form>
                      <span class="input-group-addon">
                          <button type="submit">
                              <image src="../image/search2.png" width="15" height="15" alt="submit">
                          </button>
                      </span>
                  </div>
              </div>
          </div>
      	</div>

        <script>
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
            
        <h1>
            <img src="../image/affiliated_logo.png" alt="Affiliated Logo" style="width:100%;height:auto;max-width:705px;max-height:128px;">
        </h1>
            
        <div class="info">
            <div class="row">
                <h3>
                <img src="food_notes.png" alt="Food Notes" style="width:100%;height:auto;max-width:304px;max-height:57px;">  
                </h3>
            </div>  
            <div class="row">
                <h3>Food Notes</h3>
            </div>
            <div class="row">
                <div class="paragraph">
                    <p>
                    A web application that allow you to keep track of your food waste in terms of money.<br>
                    You can enter your food items and checkoff the used ones at the end of a cycle.<br><br>
                    <a href="affiliated1.html">Link to Website</a>                
                    </p>
                </div>
            </div>
            
            <div class="row">
                <h3>
                <img src="wastebook.png" alt="WasteFood" style="width:100%;height:auto;max-width:100px">
                </h3>
            </div>
            <div class="row">
                <h3>Waste Book</h3>
            </div>
            <div class="row">
                <div class="paragraph">
                    <p>
                    A webapp that records the food you waste and provides statistics about it.<br>
                    You can input the food threw away, and the app gives useful rank/statistics about food waste.<br><br>
                    <a href="https://wastebook-2e70b.firebaseapp.com/">Link to Website</a>
                    </p>
                </div>
            </div>
                
            <div class="row">
                    <h3>
                    <img src="myfridge.png" alt="My Fridge" style="width:100%;height:auto;max-width:304px;max-height:57px;">  
                    </h3>
            </div>
            <div class="row">
                <h3>MyFridge</h3>
            </div>
            <div class="row">
                <div class="paragraph">
                    <p>
                    Keeps track of the food in your fridge, with email notifications for expiry dates.<br>
                    You can create and account and enter the food in your fridge as well as the expiry date. Then, you will receive 
                    a notification a couple days before your food is expired.<br><br>
                    <a href="https://myfridge-ff976.firebaseapp.com/login.html">Link to Website</a>
                    </p>
                </div>
            </div>
        </div>
      </div>
    </body>
	<?php 
	mysql_close($con);
	?>
	
</html>
