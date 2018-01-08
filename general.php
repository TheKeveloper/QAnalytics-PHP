<!DOCTYPE html>
<?php
    include("server/all.php");

    $sem_index = $_GET["sem"];
    if($sem_index == null){
        $sem_index = 0;
    }
    $conn = new mysqli(SERVER_NAME, DB_USER, DB_PASS, DB_NAME);
    $semesters = array_reverse(get_semesters($conn));
    $courses = load_semester($conn, $semesters[$sem_index]);
    $conn->close();
    
?>
<html>
<head>
    <title>General</title>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/all.css"/>
    <script src = "<?php echo BASE_URL;?>/scripts/all.js"></script>
    <script type = "text/javascript" src = "<?php echo BASE_URL;?>/scripts/libraries/Chart.js"></script>
    <script type = "text/javascript" src = "<?php echo BASE_URL;?>/scripts/general.js"></script>
</head>
<body onload = "createChart()">
    <a href = "index.php" id = "pageTitle">Q-Analytics</a>
    <div id = "header" align = "center">
        <a href = "index.php">Courses</a>
        <a href = "general.php">General</a>
        <a href = "departments.php">Department</a>
    </div>
	<div id="mainForm"  align = "center">
        <select id = "listSemesters" onchange = "listSemesters_Selected();">
            <?php
                for($i = 0; i < count($semesters); $i++){
                    $selected = $i == $sem_index ? "selected" : "";
                    if($semesters[$i] == null){
                        break;
                    }
                    echo "<option $selected>" . $semesters[$i]->toStr() . "</option>";
                }
            ?>
        </select>

        <input type = "hidden" id = "valCourses" value = '<?php
            echo "[" . json_encode($courses[0]);
            for($i = 1; $i < count($courses); $i++){
                echo ", " . json_encode($courses[$i]);
            }
            echo "]";
        ?>'/>
    </div>
    
    <div id = "charts" align = "center">
        <canvas id = "chartEnroll" width = "800" height = "400"></canvas> <br/>
        <canvas id = "chartWork" width = "800" height = "400"></canvas> <br/>
    </div>
</body>
</html>
