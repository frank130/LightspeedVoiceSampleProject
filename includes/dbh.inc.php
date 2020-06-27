
<?php
	#Author: Frank Ryan
	#Date: 6/27/2020
	#Creates connection to Database stored at $conn, using the XAMPP development environment
	#Using the phpMyAdmin database server, database name is "test"
	$dbServername = "";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "test";

	$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);


#Creation of all tables inside database
#Used to initialize data, comment out if database does not need to be populated

$createMembers = "CREATE TABLE Members (
	MemberName VARCHAR(30) PRIMARY KEY,
	Ecommerce BOOLEAN,
	Websocket BOOLEAN,
	Angular BOOLEAN
)";

$createEcommerce = "CREATE TABLE EcommerceProjects (
	ProjectName VARCHAR(50) PRIMARY KEY,
	Assigned VARCHAR(50),
	Hours int(9)
)";

$createWebsocket = "CREATE TABLE WebsocketProjects (
	ProjectName VARCHAR(50) PRIMARY KEY,
	Assigned VARCHAR(50),
	Hours int(9)
)";

$createAngular = "CREATE TABLE AngularProjects (
	ProjectName VARCHAR(50) PRIMARY KEY,
	Assigned VARCHAR(50),
	Hours int(9)
)";


if ($conn->query($createMembers) === TRUE) {
  #echo "Table Members created successfully";
} else {
  #echo "Error creating table: " . $conn->error;
}
if ($conn->query($createEcommerce) === TRUE) {
  #echo "Table EcommerceProjects created successfully";
} else {
  #echo "Error creating table: " . $conn->error;
}
if ($conn->query($createWebsocket) === TRUE) {
  #echo "Table WebsocketProjects created successfully";
} else {
  #echo "Error creating table: " . $conn->error;
}
if ($conn->query($createAngular) === TRUE) {
  #echo "Table AngularProjects created successfully";
} else {
  #echo "Error creating table: " . $conn->error;
}


#Insert statements to populate tables, again, comment out if already populated

$insertStuart = "INSERT INTO Members (MemberName, Ecommerce, Websocket, Angular)
	VALUES ('Stuart', FALSE, TRUE, TRUE)";
if ($conn->query($insertStuart) === TRUE) {
  #echo "Inserted Stuart successfully";
} else {
  #echo "Error inserting: " . $conn->error;
}

$insertTyler = "INSERT INTO Members (MemberName, Ecommerce, Websocket, Angular)
	VALUES ('Tyler', TRUE, FALSE, FALSE)";
if ($conn->query($insertTyler) === TRUE) {
  #echo "Inserted Tyler successfully";
} else {
  #echo "Error inserting: " . $conn->error;
}

$insertAdam = "INSERT INTO Members (MemberName, Ecommerce, Websocket, Angular)
	VALUES ('Adam', TRUE, FALSE, FALSE)";
if ($conn->query($insertAdam) === TRUE) {
  #echo "Inserted Adam successfully";
} else {
  #echo "Error inserting: " . $conn->error;
}

$insertLan= "INSERT INTO Members (MemberName, Ecommerce, Websocket, Angular)
	VALUES ('Lan', FALSE, FALSE, TRUE)";
if ($conn->query($insertLan) === TRUE) {
  #echo "Inserted Lan successfully";
} else {
  #echo "Error inserting: " . $conn->error;
}

$insertProductPages= "INSERT INTO EcommerceProjects (ProjectName, Assigned, Hours)
	VALUES ('Product Pages', 'Adam', 5)";
if ($conn->query($insertProductPages) === TRUE) {
  #echo "Inserted Product Pages successfully";
} else {
  #echo "Error inserting: " . $conn->error;
}

$insertShoppingCart= "INSERT INTO EcommerceProjects (ProjectName, Assigned, Hours)
	VALUES ('Shopping Cart', 'Tyler', 10)";
if ($conn->query($insertShoppingCart) === TRUE) {
  #echo "Inserted Shopping Cart successfully";
} else {
 # echo "Error inserting: " . $conn->error;
}

$insertMyAccount= "INSERT INTO EcommerceProjects (ProjectName, Assigned, Hours)
	VALUES ('My Account', 'Adam', 5)";
if ($conn->query($insertMyAccount) === TRUE) {
  #echo "Inserted My Account successfully";
} else {
 # echo "Error inserting: " . $conn->error;
}


$insertAddSocket= "INSERT INTO WebsocketProjects (ProjectName, Assigned, Hours)
	VALUES ('Add To Socket.IO', 'Stuart', 2)";
if ($conn->query($insertAddSocket) === TRUE) {
#  echo "Inserted Add Socket successfully";
} else {
 # echo "Error inserting: " . $conn->error;
}

$insertEnableBroadcasting= "INSERT INTO WebsocketProjects (ProjectName, Assigned, Hours)
	VALUES ('Enable Broadcasting', 'Stuart', 5)";
if ($conn->query($insertEnableBroadcasting) === TRUE) {
 # echo "Inserted Enable Broadcasting successfully";
} else {
#  echo "Error inserting: " . $conn->error;
}

$insertAdjustInterface= "INSERT INTO WebsocketProjects (ProjectName, Assigned, Hours)
	VALUES ('Adjust Interface', 'Stuart', 3)";
if ($conn->query($insertAdjustInterface) === TRUE) {
 # echo "Inserted Adjust Interface successfully";
} else {
#  echo "Error inserting: " . $conn->error;
}


$insertUpgradeAngular= "INSERT INTO AngularProjects (ProjectName, Assigned, Hours)
	VALUES ('Upgrade Angular', 'Lan', 15)";
if ($conn->query($insertUpgradeAngular) === TRUE) {
  #echo "Inserted Upgrade Angular successfully";
} else {
#  echo "Error inserting: " . $conn->error;
}

$insertFixBroken= "INSERT INTO AngularProjects (ProjectName, Assigned, Hours)
	VALUES ('Fix Broken Things', 'Stuart', 10)";
if ($conn->query($insertFixBroken) === TRUE) {
 # echo "Inserted Fix Broken Things successfully";
} else {
 # echo "Error inserting: " . $conn->error;
}

$insertTest= "INSERT INTO AngularProjects (ProjectName, Assigned, Hours)
	VALUES ('Test', 'Lan', 10)";
if ($conn->query($insertTest) === TRUE) {
#  echo "Inserted Test successfully";
} else {
 # echo "Error inserting: " . $conn->error;
}

?>