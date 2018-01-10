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
    <title>Semesters</title>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/all.css"/>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/semesters.css"/>
    <script src = "<?php echo BASE_URL;?>/scripts/all.js"></script>
    <script type = "text/javascript" src = "<?php echo BASE_URL;?>/scripts/libraries/Chart.js"></script>
    <script type = "text/javascript" src = "<?php echo BASE_URL;?>/scripts/semesters.js"></script>
</head>
<body onload = "createChart()">
    <a href = "index.php" id = "pageTitle"><?php echo TITLE?></a>
    <div id = "header" align = "center">
        <a href = "semesters.php">Semesters</a>
        <a href = "index.php">Courses</a>
        <a href = "departments.php">Departments</a>
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

    <div id = "rankings">
        <h4 align = "center">Most Popular Courses</h4>
        <table id = "tblPopular">
            <?php
                usort($courses, function($a, $b){
                    return $b->infos[0]->enrollment - $a->infos[0]->enrollment;
                });

                for($i = 0; $i < 5; $i++){
                    $cellNum = "<td style='width:50px;'>" . ($i + 1) . ".</td>";
                    $link = "<a href = '" . BASE_URL . "/courses.php?code=" . $courses[$i]->code ."'/>";
                    $cellCode = "<td style='width: 150px;'>$link" . $courses[$i]->code . "</a></td>";
                    $cellEnroll = "<td style='width:60px'>" . $courses[$i]->infos[0]->enrollment . "</td><td>students</td>";

                    echo "<tr>$cellNum $cellCode $cellEnroll</tr>";
                }
            ?>
        </table>

        <h4 align = "center">Most Difficult Courses</h4>
        <table id = "tblWork">
            <?php
                usort($courses, function($a, $b){
                    return $b->infos[0]->workload - $a->infos[0]->workload;
                });

                for($i = 0; $i < 5; $i++){
                    $cellNum = "<td style='width:50px;'>" . ($i + 1) . ".</td>";
                    $link = "<a href = '" . BASE_URL . "/courses.php?code=" . $courses[$i]->code ."'/>";
                    $cellCode = "<td style='width:150px;'>$link" . $courses[$i]->code . "</a></td>";
                    $cellWork = "<td style = 'width: 60px'>" . $courses[$i]->infos[0]->workload . "</td><td>hrs</td>";
                    echo "<tr>$cellNum $cellCode $cellWork</tr>";
                }
            ?>
        </table>

        <h4 align = "center">Most Enjoyable Courses</h4>
        <table id = "tblDifferentials">
            <tr>
                <td/><td/>
                <td class = "rowheader" style="width:100px">Recommend</td>
                <td class = "rowheader" style="width:100px">Workload</td>
                <td class = "rowheader" style="width:100px">Enrollment</td>
            </tr>
            <?php
                usort($courses, function($a, $b){
                    
                    $adif = sqrt($a->infos[0]->enrollment) * ($a->infos[0]->recommend - $a->infos[0]->workload);
                    $bdif = sqrt($b->infos[0]->enrollment) * ($b->infos[0]->recommend - $b->infos[0]->workload);
                    return $bdif - $adif;
                });

                for($i = 0; $i < 15; $i++){
                    $cellNum = "<td style='width:50px;'>" . ($i + 1) . ".</td>";
                    $link = "<a href = '" . BASE_URL . "/courses.php?code=" . $courses[$i]->code ."'/>";
                    $cellCode = "<td style='width: 150px;'>$link" . $courses[$i]->code . "</a></td>";
                    $cellRecommend = "<td>" . $courses[$i]->infos[0]->recommend . "</td>";
                    $cellWork = "<td>" . $courses[$i]->infos[0]->workload . "</td>";
                    $cellEnrollment = "<td>" . $courses[$i]->infos[0]->enrollment. "</td>";

                    echo "<tr>$cellNum $cellCode $cellRecommend $cellWork $cellEnrollment</tr>";
                }
            ?>
        </table>
    </div>
    <div id = "footer" align = "center">
        <?php echo FOOTER ?>
    </div>
</body>
</html>
