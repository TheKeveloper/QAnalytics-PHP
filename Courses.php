<!DOCTYPE html>
<?php
    include("server/all.php");
?>
<html>
<head>
	<title>Courses</title>
	<link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/all.css"/>
	<link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/course.css"/>
	<script src = "<?php echo BASE_URL;?>/scripts/all.js"></script>
	<script src = "<?php echo BASE_URL;?>/scripts/libraries/Chart.js"></script>
	<script src = "<?php echo BASE_URL;?>/scripts/courses.js"></script>
	<script src = "<?php echo BASE_URL;?>/scripts/index.js"></script>
</head>
<body onload = "createChart()">
	<a href = "index.php" id = "pageTitle">Q-Analytics</a>
	<div id = "header" align = "center">
		<a href = "index.php">Courses</a>
		<a href = "general.php">General</a>
		<a href = "departments.php">Department</a>
	</div>
	
	<div id="mainForm" align = "center">
		<div id = "lblTitle">
			<?php

			?>
		</div>
	</div>
	<input type = "hidden" id = "valCourse" value = "<?php 
	
	?>"/>
	<div id = "charts" align = "center">
		<canvas id = "chartEnroll" class = "chart" width = "800" height = "400"></canvas>
		<canvas id = "chartRatings" class = "chart" width = "800" height = "400"></canvas>
	</div>

</body>
</html>
