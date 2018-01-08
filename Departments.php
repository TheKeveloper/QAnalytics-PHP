<!DOCTYPE html>
<?php
    include("server/all.php");
?>
<html>
<head>
	<title>Departments</title>
	<link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/all.css"/>
	<script src = "<?php echo BASE_URL;?>/scripts/all.js"></script>
	<script type = "text/javascript" src = "<?php echo BASE_URL;?>/scripts/libraries/Chart.js"></script>
	<script type = "text/javascript" src = "<?php echo BASE_URL;?>/scripts/departments.js"></script>
</head>
<body onload = "createChart();">
	<a href = "index.php" id = "pageTitle">Q-Analytics</a>
	<div id = "header" align = "center">
		<a href = "index.php">Courses</a>
		<a href = "general.php">General</a>
		<a href = "departments.php">Department</a>
	</div>
	<div id="mainForm" align = "center">
		<select id = "listDepts" align = "center">	
			<?php

			?>
		</select>

		<input type = "hidden" id = "valDept" value = "<?php
		
		?>"/>
	</div>
    <div id = "charts" align = "center">
		<canvas id = "chartEnroll" width = "800" height = "400"></canvas>
		<canvas id = "chartRatings" width = "800" height = "400"></canvas>
	</div>
</body>
</html>
