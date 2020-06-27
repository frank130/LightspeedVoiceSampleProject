
<?php
	include_once 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>

		header > h1 { display: inline-block; font-family: Verdana, Geneva, sans-serif;}
		header span { margin-left: 1200px; font-size: 25px; font-family: Verdana, Geneva, sans-serif;}


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

		

	</style>
</head>
<body>
	

	<?php

		#Author: Frank Ryan
		#Date: 6/27/2020

		#Retrieves the POST name value "Project" from the HTTP request, can be equal to "E-Commerce Website", "Websocket Updates", or "Angular Upgrades"
		$memberName = htmlspecialchars($_POST["Project"]);

		#Retrieves the POST name value "totalHours" that was queried inside the previous web page, holds the total hours of tasks
		$hours = htmlspecialchars($_POST["totalHours"]);

		$hours .= " hours";

		#Creating project title of webpage and placing total hours from each task as well
		echo "<header>" . "<h1>" . $memberName . "</h1>" 
		. "<span>" . $hours . "</span>" . "</header>";

		#Creation of table
		echo "<table width=100%>" 
		. "<thead>" . "<tr>" . "<th>" . "Task" . "</th>" 
		. "<th>" . "Assigned To" . "</th>" 
		. "<th>". "Estimated Hours" . "</th>"
		."</tr>" . "</thead>";


		#If the request is to the E-Commerce Website page
		if($memberName == "E-Commerce Website")
		{
			#Retrieves all data from the E-Commerce table and also handles any catches
			$getEcommerceTasks = "SELECT * FROM EcommerceProjects;";
			$resultTasks = mysqli_query($conn, $getEcommerceTasks);

			$resultTasksCheck = mysqli_num_rows($resultTasks);

			if($resultTasksCheck > 0)
			{
				#$row is now an array of all results found
				#Iterates for every row found inside database table, places onto HTML table
				while($row = mysqli_fetch_assoc($resultTasks))
				{
					echo "<tr>" . "<td>" . $row['ProjectName'] . "</td>" 
					. "<td>" . $row['Assigned'] . "</td>"
					. "<td>" . $row['Hours'] . "</td>" . "</tr>";
				
				}

			}
		}
		#If the request is to the Websocket Updates page
		#Similar documentation above
		else if($memberName == "Websocket Updates")
		{

			$getWebsocketTasks = "SELECT * FROM WebsocketProjects;";
			$resultTasks = mysqli_query($conn, $getWebsocketTasks);

			$resultTasksCheck = mysqli_num_rows($resultTasks);

			if($resultTasksCheck > 0)
			{
				while($row = mysqli_fetch_assoc($resultTasks))
				{
					echo "<tr>" . "<td>" . $row['ProjectName'] . "</td>" 
					. "<td>" . $row['Assigned'] . "</td>"
					. "<td>" . $row['Hours'] . "</td>" . "</tr>";
				
				}

			}
		}
		#If the request is to the Angular Upgrades page
		#Similar documentation above
		else if($memberName == "Angular Upgrades")
		{
			$getAngularTasks = "SELECT * FROM AngularProjects;";
			$resultTasks = mysqli_query($conn, $getAngularTasks);

			$resultTasksCheck = mysqli_num_rows($resultTasks);

			if($resultTasksCheck > 0)
			{
				while($row = mysqli_fetch_assoc($resultTasks))
				{
					echo "<tr>" . "<td>" . $row['ProjectName'] . "</td>" 
					. "<td>" . $row['Assigned'] . "</td>"
					. "<td>" . $row['Hours'] . "</td>" . "</tr>";
				
				}

			}
		}
		

		

		echo "</table>";

		#Creates back button based on web browser history
		echo "<button onclick='history.go(-1)'>" . "Back" . "</button>";



	?>




</body>
</html>