function createChart(){
    var c = JSON.parse(document.getElementById("valCourse").value.replace("~", "'"));
    var ctxEnroll = document.getElementById("chartEnroll").getContext("2d");
    var semesters = [];
    var enrollments = [];
    var recommends = [];
    var workloads = [];

    for(var i = 0; i < c.infos.length; i++){
        var strSem = c.infos[i].semester.season == 0 ? "Fall" : "Spring";
        semesters.push(strSem + " " + c.infos[i].semester.year);
        enrollments.push(c.infos[i].enrollment);
        recommends.push(c.infos[i].recommend);
        workloads.push(c.infos[i].workload);
    }

    var enrollConfig = {
        type : "line",
        data : {
            labels : semesters,
            datasets : [{
                label : "Enrollment", 
                backgroundColor : "#FF0000",
                borderColor : "#FF0000",
                data : enrollments,
                fill : false
            }]
        },
        options : {
            responsive : false, 
        }
    }
    var enrollChart = new Chart(ctxEnroll, enrollConfig);

    var ctxRatings = document.getElementById("chartRatings").getContext("2d");
    var ratingsConfig = {
        type : "line",
        data : {
            labels : semesters,
            datasets : [{
                label : "Recommend",
                backgroundColor : "#00FF00",
                borderColor : "#00FF00",
                data : recommends,
                fill : false
            },
            {
                label : "Workload",
                backgroundColor : "#0000FF",
                borderColor : "#0000FF",
                data : workloads,
                fill : false
            }]
        },
        options : {
            responsive : false,
            scales :{ 
                yAxes : [{
                    display : true,
                    ticks : {
                        min : 1.0,
                        max : 5.5,
                        stepSize : 0.5
                    }
                }]
            }
        }
    }

    var chartRatings = new Chart(ctxRatings, ratingsConfig);
}