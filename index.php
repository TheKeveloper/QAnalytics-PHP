<!DOCTYPE html>
<?php
    include("server/all.php");
    define("PER_PAGE", 25);
    $conn = new mysqli(SERVER_NAME, DB_USER, DB_PASS, DB_NAME);
    $page = $_GET["page"];
    $search = $_GET["search"];
    if($search == null){
        $search = "";
    }
    $search = str_replace("_", " ", $search);
    $courses = Course::search_courses($conn, $search);
    $conn->close();

    $pageMax = ceil(count($courses) / 25.0) - 1;

?>
<html>
<head>
    <title><?php echo TITLE?></title>
    <script src = "<?php echo BASE_URL;?>/scripts/all.js"></script>
    <script src = "<?php echo BASE_URL;?>/scripts/index.js"></script>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/all.css"/>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/index.css"/>
</head>
<body>
    <a href = "index.php" id = "pageTitle"><?php echo TITLE?></a>

    <div id = "header" align = "center">
        <a href = "semesters.php">Semesters</a>
        <a href = "index.php">Courses</a>
        <a href = "departments.php">Departments</a>
    </div>
	<div id="mainForm">
        <input type = "hidden" id = "valSearch" value = "<?php
            echo $search;
        ?>"/>
        <div align = "center" id = "search" >
            <input type = "text" id = "txtSearch" onkeypress= "txtSearch_Key(event);" value = "<?php
                echo $search;
            ?>"/>
            <input type ="button" id = "btnSearch" onclick = "btnSearch_Click();" value = "Search"></input>
            <br/>
        </div>

        <div id = "nav" align = "center" >
            <a href = "<?php
                $prev = $page - 1;
                if($prev < 0){
                    echo "\" style=\"visibility: hidden\"";
                }
                else{
                    echo BASE_URL . "/index.php?page=$prev&search=$search";
                }
            ?>" id = "linkPrev">Prev</a>
            <select id = "listPages" onchange = "listPages_SelectionChanged();">
                <?php
                    for($i = 0; $i <= $pageMax; $i++){
                        echo "<option value = '$i'". ($i == $page ? "selected" : ""). ">$i</option>";
                    }
                ?>
            </select>
            <a href = "<?php
                $next = $page + 1;
                if($next > $pageMax){
                    echo "\" style=\"visibility: hidden\"";
                }
                else{
                    echo BASE_URL . "/index.php?page=$next&search=$search";
                }
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
        <?php echo FOOTER ?>
    </div>
</body>
</html>
