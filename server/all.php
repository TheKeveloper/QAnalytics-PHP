<?php
    include_once("bootstrap.php");
    include_once("Course.php");
    include_once("Department.php");
    define("TITLE", "Q-Analytic");
    define("FOOTER", "Data from q.fas.harvard.edu <br/>
    <a href = \"https://docs.google.com/spreadsheets/d/1XPSSKI3-HSqMGgO_OXUNdNqcAmlym3seVUSk7G2-rb4/edit?usp=sharing\">Raw dataset</a><br/>
    Created by <a href = \"mailto:kevinbi@college.harvard.edu\">Kevin Bi</a>.");
    define("HEADER",
    "<a href = \"index.php\" id = \"pageTitle\">" . TITLE . "</a>

    <div id = \"header\" align = \"center\">
        <a href = \"semesters.php\">Semesters</a>
        <a href = \"index.php\">Courses</a>
        <a href = \"departments.php\">Departments</a>
        <a href = \"faq.php\">FAQ</a>
    </div>")
?>