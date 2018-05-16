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
	<?php echo GOOGLE_SCRIPTS ?>
	<title><?php echo $code;?></title>
	<link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/all.css"/>
	<link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/courses.css"/>
	<script src = "<?php echo BASE_URL;?>/scripts/all.js"></script>
	<script src = "<?php echo BASE_URL;?>/scripts/libraries/Chart.js"></script>
	<script src = "<?php echo BASE_URL;?>/scripts/courses.js"></script>
	<script src = "<?php echo BASE_URL;?>/scripts/index.js"></script>
</head>
<body onload = "createChart()">
	<?php echo HEADER ?>
	<?php authenticate(); ?>
	<div id="mainForm" align = "center">
		<div id = "lblTitle">
			<?php
				echo $course->code . "</br>" . $course->name . "<br/>";
			?>

			<a href = "<?php
				echo (str_replace("SEARCHQUERY", str_replace(" ", "", $course->code),"https://courses.my.harvard.edu/psp/courses/EMPLOYEE/EMPL/h/?tab=HU_CLASS_SEARCH&SearchReqJSON=%7B%22PageNumber%22%3A1%2C%22PageSize%22%3A%22%22%2C%22SortOrder%22%3A%5B%22IS_SCL_SUBJ_CAT%22%5D%2C%22Facets%22%3A%5B%5D%2C%22Category%22%3A%22HU_SCL_SCHEDULED_BRACKETED_COURSES%22%2C%22SearchPropertiesInResults%22%3Atrue%2C%22FacetsInResults%22%3Atrue%2C%22SaveRecent%22%3Atrue%2C%22TopN%22%3A%22%22%2C%22SearchText%22%3A%22SEARCHQUERY%22%7D"));
			?>" target="_blank">Search on my.harvard</a>
		</div>
	</div>
	<input type = "hidden" id = "valCourse" value = '<?php 
		echo str_replace("'", "~", json_encode($course, JSON_UNESCAPED_UNICODE));
	?>'/>
	<div id = "charts" align = "center">
		<canvas id = "chartEnroll" class = "chart" width = "800" height = "400"></canvas>
		<canvas id = "chartRatings" class = "chart" width = "800" height = "400"></canvas>
	</div>

	<div id = "footer" align = "center">
        <?php echo FOOTER ?>
    </div>
</body>
</html>
