<?php
    include_once("bootstrap.php");
    include_once("Course.php");
    include_once("Department.php");
    define("TITLE", "Q-Analytic");
    define("FOOTER", "Data from <a href = \"http://q.fas.harvard.edu\" target=\"_blank\">q.fas.harvard.edu </a><br/>
    <a href = \"https://docs.google.com/spreadsheets/d/1XPSSKI3-HSqMGgO_OXUNdNqcAmlym3seVUSk7G2-rb4/edit?usp=sharing\" target=\"_blank\">Raw dataset</a><br/>
    Created by <a href = \"mailto:kevinbi@college.harvard.edu\">Kevin Bi</a>.");
    define("HEADER",
    "<a href = \"index.php\" id = \"pageTitle\">" . TITLE . "</a>

    <div id = \"header\" align = \"center\">
        <a href = \"semesters.php\">Semesters</a>
        <a href = \"index.php\">Courses</a>
        <a href = \"departments.php\">Departments</a>
        <a href = \"faq.php\">FAQ</a>
    </div>");

    define("GOOGLE_ANALYTICS",
    "<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-44600100-2\"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-44600100-2');
    </script>");
?>