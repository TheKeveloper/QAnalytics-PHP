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
        The data is retrieved from the <a href = "http://q.fas.harvard.edu">Harvard Q-Guide</a>.
    </p>
    <h3>Why are the hours weird after Fall 2014?</h3>
    <p>
        In Fall 2014, the Harvard Q-Guide changed its hour counting system from being on a 1 to 5 scale, 
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

</html> 