<?php
	include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>To-Do List</title>
	<style>
		th {
		border:1px solid #C0C0C0;
		padding:5px;
		background:#D1D1D1;
		text-align: left;
		}

		td {
		border:1px solid #C0C0C0;
		padding:5px;
		background:#E8E8E8;
		}
		.title
		{
			text-align: left;
			font-size: 40px;
			font-family: Verdana, Geneva, sans-serif;
		}
		.nameButtons
		{
			margin-bottom: 10px;
		}

	</style>
</head>
<body>


<form method="GET">
	<input hidden name='user' value='Stuart'>
	
	<button class="nameButtons">Go to Stuart's Project List</button>
</form>

<form method="GET">
	<input hidden name='user' value='Tyler'>
	
	<button class="nameButtons">Go to Tyler's Project List</button>
</form>

<form method="GET">
	<input hidden name='user' value='Adam'>
	
	<button class="nameButtons">Go to Adam's Project List</button>
</form>

<form method="GET">
	<input hidden name='user' value='Lan'>
	
	<button class="nameButtons">Go to Lan's Project List</button>
</form>

<?php 

	#Author: Frank Ryan
	#Date: 6/26/2020

	try{

		#Retrieves the query paramter value "user" from the HTTP request, can be equal to "Stuart", "Tyler", "Adam", or "Lan"
		$memberName = @htmlspecialchars($_GET["user"]);

		#SQL statement that retrieves all data from the Members table based on the unique MemberName key
		$getMembers = "SELECT * FROM Members WHERE MemberName = '$memberName'";

		#Holds the retrieved query
		$resultMembers = mysqli_query($conn, $getMembers);

		#Used for handling if no data found inside query
		$resultMembersCheck = mysqli_num_rows($resultMembers);

		#If there is a result, $resultMembersCheck is greater than 0
		if($resultMembersCheck > 0)
		{

			#Creating table for member project list
			echo "<table width=100%>" . "<caption class='title'>" . $memberName . "'s Project List" . "</caption>" 
			. "<thead>" . "<tr>" . "<th>" . "Project" . "</th>" 
			. "<th>" . "Members" . "</th>" 
			. "<th>". "Estimated Hours" . "</th>"
			. "<th>" . "Actions" . "</th>" . "</tr>" . "</thead>";
		



			#$row is now an array of all results found from Members query, accessed as $row['Column Name']			
			$row = mysqli_fetch_assoc($resultMembers);
			
			#Checks if Member is listed to E-Commerce Website
			if($row['Ecommerce'] == TRUE)
			{
				#Creates new table row for e-commerce project
				echo "<tr>" . "<td>" . "E-Commerce Website" . "</td>";

				#getAssigned -> function that retrieves all members listed under a project and places them inside table
				getAssigned("Ecommerce", $conn);

				#getTotalHours -> function that retrieves all hours listed under a project and places them inside table
				$totalCount = getTotalHours("Ecommerce", $conn);

				
				#Creates button to view the project, sends query parameter 'Project' with 'E=Commerce Website' value to use in 
				echo "<td>" . "<form action = 'projects.php' method='post'>" 
				. "<input hidden name='Project' value='E-Commerce Website'>" . "<input hidden name='totalHours' value='" . $totalCount . "'>" 
				."<button>" . "View" . "</button>" .  "</form>" . "</tr>";
	
			}
			#Checks if Member is listed to Websocket Updates
			if($row['Websocket'] == TRUE)
			{
				#Similar to above documentation, fills in table for each project
				echo "<tr>" . "<td>" . "Websocket Updates" . "</td>";

				getAssigned("Websocket", $conn);

				$totalCount = getTotalHours("Websocket", $conn);

				#Creates button to view the project, sends query parameter 'Project' with 'Websocked Updates' value to use in
				echo "<td>" . "<form action = 'projects.php' method='post'>" 
				. "<input hidden name='Project' value='Websocket Updates'>"  . "<input hidden name='totalHours' value='" . $totalCount . "'>" 
				. "<button>" . "View" . "</button>" .  "</form>" . "</tr>";
	

			}
			#Checks if Member is listed to Angular Upgrades
			if($row['Angular'] == TRUE)
			{
				#Similar to above documentation, fills in table for each project
				echo "<tr>" . "<td>" . "Angular Upgrades" . "</td>";

				getAssigned("Angular", $conn);

				$totalCount = getTotalHours("Angular", $conn);

				#Creates button to view the project, sends query parameter 'Project' with 'Angular Upgrades' value to use in
				echo "<td>" . "<form action = 'projects.php' method='post'>" 
				. "<input hidden name='Project' value='Angular Upgrades'>"  . "<input hidden name='totalHours' value='" . $totalCount . "'>" 
				. "<button>" . "View" . "</button>" .  "</form>" . "</tr>";
	

			}						
			

		echo "</table>";
		
		}
	}
	catch(Exception $e)
	{
		echo "Error was found: " . $e;
	}
	

	


#getAssigned function -> used to retrieve all members listed for a project
#a_project -> contains String value of specific project
#a_connection -> contains connection to SQL database
function getAssigned($a_project, $a_connection)
{
	#String to hold all members of project
	$allMembers = "";


	if($a_project == "Ecommerce")
	{
		#Retrieves all members assigned to E-Commerce Website tasks, must be DISTINCT since one member can be assigned to many tasks
		$getEcommerceMembers = "SELECT DISTINCT Assigned FROM EcommerceProjects";

		#Holds the retrieved query
		$resultEcommerceMembers = mysqli_query($a_connection, $getEcommerceMembers);

		#Used for handling if no data found inside query
		$resultEcommerceCheck = mysqli_num_rows($resultEcommerceMembers);

		#If there is a result, $resultMembersCheck is greater than 0
		if($resultEcommerceCheck > 0)
		{

			#$row is now an array of all results found
			#This while loop continues retrieving query results for each row in the project table that was found
			while($row1 = mysqli_fetch_assoc($resultEcommerceMembers))
			{
				#Concatenates the $allMembers String with the newly found member name
				$allMembers .= $row1['Assigned'] .= ", ";
						
			}

			#Places completed member string inside table
			echo "<td>" . rtrim($allMembers, ", ") . "</td>";

		}
	}

	#Documentation is similar to above, this handles retreiving from the WebsocketProjects table
	else if($a_project == "Websocket")
	{
		$getWebsocketMembers = "SELECT DISTINCT Assigned FROM WebsocketProjects";


		$resultWebsocketMembers = mysqli_query($a_connection, $getWebsocketMembers);

		$resultWebsocketCheck = mysqli_num_rows($resultWebsocketMembers);

		if($resultWebsocketCheck > 0)
		{

						while($row1 = mysqli_fetch_assoc($resultWebsocketMembers))
			{
				$allMembers .= $row1['Assigned'] .= ", ";
						
			}

			echo "<td>" . rtrim($allMembers, ", ") . "</td>";

		}
	}


	#Documentation is similar to above, this handles retreiving from the AngularProjects table
	else if($a_project == "Angular")
	{
		$getAngularMembers = "SELECT DISTINCT Assigned FROM AngularProjects";


		$resultAngularMembers = mysqli_query($a_connection, $getAngularMembers);

		$resultAngularCheck = mysqli_num_rows($resultAngularMembers);

		if($resultAngularCheck > 0)
		{

			while($row1 = mysqli_fetch_assoc($resultAngularMembers))
			{
				$allMembers .= $row1['Assigned'] .= ", ";
						
			}

			echo "<td>" . rtrim($allMembers, ", ") . "</td>";

		}
	}

}

#getTotalHours function -> used to retrieve all hours listed for a project
#a_project -> contains String value of specific project
#a_connection -> contains connection to SQL database
function getTotalHours($project, $connection)
{
	#total hours varaible that will be incremented for each task inside project and placed inside table
	$totalCount = 0;

	if($project == "Ecommerce")
	{
		#Retrieves all hours assigned to E-Commerce Website tasks
		$getTotalHours = "SELECT Hours FROM EcommerceProjects";

		$resultHours = mysqli_query($connection, $getTotalHours);

		$resultHoursCheck = mysqli_num_rows($resultHours);

		if($resultHoursCheck > 0)
		{

			#$row is now an array of all results found
			#Each iteration is a newly found row, adds the hours for that new row into the totalCount variable
			while($row = mysqli_fetch_assoc($resultHours))
			{
				$totalCount += $row['Hours'];
			}

			#Places this final hours value inside table
			echo "<td>" . $totalCount . "</td>";

			return $totalCount;

		}
	}

	#Documentation is similar to above, this handles retreiving from the WebsocketProjects table
	else if($project == "Websocket")
	{
		$getTotalHours = "SELECT Hours FROM WebsocketProjects";

		$resultHours = mysqli_query($connection, $getTotalHours);

		$resultHoursCheck = mysqli_num_rows($resultHours);

		if($resultHoursCheck > 0)
		{

			while($row = mysqli_fetch_assoc($resultHours))
			{
				$totalCount += $row['Hours'];
			}

			echo "<td>" . $totalCount . "</td>";

			return $totalCount;
		}
	}

	#Documentation is similar to above, this handles retreiving from the WebsocketProjects table
	else if($project == "Angular")
	{
		$getTotalHours = "SELECT Hours FROM AngularProjects";

		$resultHours = mysqli_query($connection, $getTotalHours);

		$resultHoursCheck = mysqli_num_rows($resultHours);

		if($resultHoursCheck > 0)
		{

			while($row = mysqli_fetch_assoc($resultHours))
			{
				$totalCount += $row['Hours'];
			}

			echo "<td>" . $totalCount . "</td>";

			return $totalCount;
		}
	}

}



?>

</body>
</html>