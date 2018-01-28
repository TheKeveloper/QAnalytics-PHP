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

    define("GOOGLE_SCRIPTS",
    "<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-44600100-2\"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-44600100-2');
    </script>
    <meta name=\"google-signin-scope\" content=\"profile email\">
    <meta name=\"google-signin-client_id\" content=\"158812636692-v5gt6q9h1s8c664sflui9m92i2o144n7.apps.googleusercontent.com\">
    <script src=\"https://apis.google.com/js/platform.js\" async defer></script>");

    function authenticate(){
        if(isset($_COOKIE["email"]) && strpos($_COOKIE["email"], "harvard.edu")){

        }
        else{
            echo "
            <center>
            This website is only for Harvard students. Please sign into your harvard.edu email account to access.
            <br/>
            Don't worry, it's through Google. I promise I'm not saving your info.
            <br/>
            <br/>
            <div class='g-signin2' data-onsuccess='onSignIn' data-theme='dark'></div>
            </center>
            <script>
                function onSignIn(googleUser) {
                    // Useful data for your client-side scripts:
                    var profile = googleUser.getBasicProfile();
                    if(document.cookie.includes('email') == false){
                        if(profile.getEmail().includes('college.harvard.edu')){
                            document.cookie = 'email=' + profile.getEmail() + '; path=/';   
                        }
                        else{
                            gapi.auth2.getAuthInstance().disconnect();
                        }
                        location.reload(); 
                    }
                };
            </script>";
            exit();
        }
    }
?>