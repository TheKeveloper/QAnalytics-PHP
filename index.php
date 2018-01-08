<!DOCTYPE html>
<?php
    include("server/all.php");
    define("PER_PAGE", 25);
    $conn = new mysqli(SERVER_NAME, DB_USER, DB_PASS, DB_NAME);
    $courses = Course::get_courses_simple($conn);
    $conn->close();

    $page = $_GET["page"];
?>
<html>
<head>
    <title>Home</title>
    <script src = "<?php echo BASE_URL;?>/scripts/all.js"></script>
    <script src = "<?php echo BASE_URL;?>/scripts/index.js"></script>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/all.css"/>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/index.css"/>
</head>
<body>
    <a href = "index.php" id = "pageTitle">Q-Analytics</a>

    <div id = "header" align = "center">
        <a href = "index.php">Courses</a>
        <a href = "general.php">General</a>
        <a href = "departments.php">Department</a>
    </div>
	<div id="mainForm">
        <input type = "hidden" id = "valSearch" value = "<?php
        ?>"/>
        <div align = "center" id = "search">
            <input type = "text" id = "txtSearch" value = "<?php
            
            ?>"/>
            <button id = "btnSearch" onclick = "btnSearch_Click();">Search</input>
            <br/>
        </div>

        <div id = "nav" align = "center" >
            <a href = "<?php
            
            ?>" id = "linkPrev">Prev</a>
            <select id = "listPages" onchange = "listPages_SelectionChanged();">
                <?php
                    for($i = 0; $i < count($courses) / PER_PAGE; $i++){
                        echo "<option value = '$i'". ($i == $page ? "selected" : ""). ">$i</option>";
                    }
                ?>
            </select>
            <a href = "<?php
            
            ?>" id = "linkNext">Next</a>
        </div>

            <br/>
            <table id = "tblCourses">
                <?php
                    $startIndex = $page * PER_PAGE; 
                    $endIndex = $startIndex + PER_PAGE;
                    if($endIndex > count($courses)) $endIndex = count($courses); 
                    for($i = $startIndex; $i < $endIndex; $i++){
                        $cellCode = "<td class = 'cellCode' style='width:250px;'><a class = 'courseLink' href = '".BASE_URL."/courses.php?code=".str_replace(" ", "_", $courses[$i]->code)."'>".$courses[$i]->code."</a></td>";
                        
                        $cellName = "<td class = 'cellName'><a class = 'courseLink' href = '".BASE_URL."/courses.php?code=".str_replace(" ", "_", $courses[$i]->code)."'>".$courses[$i]->name."</a></td>";

                        $row = "<tr>$cellCode $cellName</tr>";
                        echo $row;
                    }
                    
                ?>
            </table>

    </div>

    <div id = "footer" align = "center">
        Created by <a href = "mailto:kevinbi@college.harvard.edu">Kevin Bi</a>.
    </div>
</body>
</html>
