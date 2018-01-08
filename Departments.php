<!DOCTYPE html>
<?php
	include("server/all.php");
	
	$dept_name = $_GET["dept"];
	if($dept_name == null){
		$dept_name = "AESTHINT";
	}
	$conn = new mysqli(SERVER_NAME, DB_USER, DB_PASS, DB_NAME);
	$depts = getDepartments($conn);
	$dept = new Department($dept_name);
	$dept->load($conn);
	$conn->close();
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
	<a href = "semesters.php">Semesters</a>
	<a href = "index.php">Courses</a>
	<a href = "departments.php">Departments</a>
	</div>
	<div id="mainForm" align = "center">
		<select id = "listDepts" align = "center" onchange="listDepts_Selected();">	
			<?php
				foreach($depts as $d){
					$selected = $d == $dept_name ? "selected" : "";
					echo "<option value = '$d' $selected>$d</option>";
				}
			?>
		</select>

		<input type = "hidden" id = "valDept" value = '<?php
			echo json_encode($dept);
		?>'/>
	</div>
    <div id = "charts" align = "center">
		<canvas id = "chartEnroll" width = "800" height = "400"></canvas>
		<canvas id = "chartRatings" width = "800" height = "400"></canvas>
	</div>
</body>
</html>
