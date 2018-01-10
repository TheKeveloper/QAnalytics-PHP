<!DOCTYPE html>
<?php
	include("server/all.php");
	$code = str_replace("_", " ", $_GET["code"]);
	$course = new Course($code);

	$conn = new mysqli(SERVER_NAME, DB_USER, DB_PASS, DB_NAME);
	$course->load($conn);
	$conn->close();
?>
<html>
<head>
	<title><?php echo $code;?></title>
	<link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/all.css"/>
	<link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/courses.css"/>
	<script src = "<?php echo BASE_URL;?>/scripts/all.js"></script>
	<script src = "<?php echo BASE_URL;?>/scripts/libraries/Chart.js"></script>
	<script src = "<?php echo BASE_URL;?>/scripts/courses.js"></script>
	<script src = "<?php echo BASE_URL;?>/scripts/index.js"></script>
</head>
<body onload = "createChart()">
	<a href = "index.php" id = "pageTitle"><?php echo TITLE?></a>
	<div id = "header" align = "center">
		<a href = "semesters.php">Semesters</a>
		<a href = "index.php">Courses</a>
		<a href = "departments.php">Departments</a>
	</div>
	
	<div id="mainForm" align = "center">
		<div id = "lblTitle">
			<?php
				echo $course->code . "</br>" . $course->name . "<br/>";
			?>
		</div>
	</div>
	<input type = "hidden" id = "valCourse" value = '<?php 
		echo str_replace("'", "~", json_encode($course, JSON_UNESCAPED_UNICODE));
	?>'/>
	<div id = "charts" align = "center">
		<canvas id = "chartEnroll" class = "chart" width = "800" height = "400"></canvas>
		<canvas id = "chartRatings" class = "chart" width = "800" height = "400"></canvas>
	</div>

</body>
</html>
