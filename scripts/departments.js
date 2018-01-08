function createChart(){
    var dept = JSON.parse(document.getElementById("valDept").value);
    var ctxEnroll = document.getElementById("chartEnroll").getContext("2d");
    var semesters = [];
    var enrollments = [];
    var recommends = [];
    var workloads = [];

    for(var i = 0; i < dept.Infos.length; i++){
        var strSem = dept.Infos[i].Semester.Season == 0 ? "Fall" : "Spring";
        semesters.push(strSem + " " + dept.Infos[i].Semester.Year);
        enrollments.push(dept.Infos[i].AggregateEnrollment);
        recommends.push(dept.Infos[i].AvgRecommend);
        workloads.push(dept.Infos[i].AvgWorkload);
    }

    var enrollConfig = {
        type : "line",
        data : {
            labels : semesters,
            datasets : [{
                label : "Total Enrollment", 
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
                label : "Average Recommend",
                backgroundColor : "#00FF00",
                borderColor : "#00FF00",
                data : recommends,
                fill : false
            },
            {
                label : "Average Workload",
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