<!DOCTYPE html>
<?php
	include("server/all.php");
?>
<html>
    <head> 
        <title>FAQ</title>
        <script src = "<?php echo BASE_URL;?>/scripts/all.js"></script>
        <link rel = "stylesheet" type = "text/css" href = "<?php echo BASE_URL;?>/styles/all.css"/>
    </head>
    <?php echo HEADER ?>
    <h3>Where is the data from?</h3>
    <p>
        The data is retrieved from the <a href = "http://q.fas.harvard.edu" target="_blank">Harvard Q-Guide</a>.
    </p>
    <h3>Why are the hours weird after Fall 2014?</h3>
    <p>
        In Fall 2014, the Harvard Q-Guide changed its hour counting system from being on a 1 to 5 scale to being on a raw hours scale. In order to best represent the long term trend, we adjust the new values to fit in a 1 to 5 scale. However, some courses do not fit nicely into the 1 to 5 scale following Fall 2014, so there may seem to be abrupt changes in workload that do not in fact exist.
    </p>
    
    <h3>How are the most enjoyable classes determined?</h3>
    <p>
        The most enjoyable classes are determined based on the idea that workload should be minimized while the recommended rating should be maximized. However, the most enjoyable courses also takes into account course size, because extremely small courses are likely to be niche and not that enjoyable for the average student.
        <br/><br/>
        The courses are mathematically determined by maximizing the following value: <i>(Recommend - Workload) * Sqrt(Enrollment)</i>
        <br/>
        <br/>
        We take the square root of the enrollment to take class size into account but reduce the effect of extremely large class sizes.
    </p>

    <h3>I think this website is broken/this website needs more features! What should I do?</h3>
    <p>
        The code for this website is <a href = "https://github.com/TheKeveloper/QAnalytics-PHP" target="_blank">on Github</a>. Feel free to open an issue or fork the repository and create a pull request.
    </p>

    <h3>This website is terrible! What if I just want the data?</h3>
    <p>
        If you have a @college.harvard.edu email address, you can access the raw dataset in <a href = "https://docs.google.com/spreadsheets/d/1XPSSKI3-HSqMGgO_OXUNdNqcAmlym3seVUSk7G2-rb4/edit?usp=sharing" target="_blank"> a Google Spreadsheet. </a>
    </p>

    <div id = "footer" align = "center">
        <?php echo FOOTER ?>
    </div>

</html> 