<!DOCTYPE html>
<?php
    include("server/all.php");
?>
<html>
<head>
    <title>General</title>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/all.css"/>
    <script src = "<?php echo BASE_URL;?>/scripts/all.js"></script>
    <script type = "text/javascript" src = "<?php echo BASE_URL;?>/scripts/libraries/Chart.js"></script>
    <script type = "text/javascript" src = "<?php echo BASE_URL;?>/scripts/general.js"></script>
</head>
<body>
    <a href = "index.php" id = "pageTitle">Q-Analytics</a>
    <div id = "header" align = "center">
        <a href = "index.php">Courses</a>
        <a href = "general.php">General</a>
        <a href = "departments.php">Department</a>
    </div>
	<div id="mainForm"  align = "center">
        <select id = "listSemesters">
            <?php

            ?>
        </select>
    </div>
    
    <div id = "charts" align = "center">
    </div>
</body>
</html>
