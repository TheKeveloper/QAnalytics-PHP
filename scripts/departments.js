function listDepts_Selected(){
    var listDepts = document.getElementById("listDepts");
    var dept = listDepts.options[listDepts.selectedIndex].value;

    window.location.href = getPath() + "/departments.php?dept=" + dept;
}

function createChart(){
    var dept = JSON.parse(document.getElementById("valDept").value);
    var ctxEnroll = document.getElementById("chartEnroll").getContext("2d");
    var semesters = [];
    var enrollments = [];
    var recommends = [];
    var workloads = [];

    for(var i = 0; i < dept.infos.length; i++){
        var strSem = dept.infos[i].semester.season == 0 ? "Fall" : "Spring";
        semesters.push(strSem + " " + dept.infos[i].semester.year);
        enrollments.push(dept.infos[i].enrollment);
        recommends.push(dept.infos[i].recommend);
        workloads.push(dept.infos[i].workload);
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
            tooltips: {
                callbacks : {
                    label : function(tooltipsItem, data){
                        var index = tooltipsItem.index; 
                        var dataset = tooltipsItem.datasetIndex;
                        if(dataset === 0){
                            return "Recommend: " + recommends[index];
                        }
                        else if(dataset === 1){
                            if(dept.infos[index].rawWorkload > 0){
                                return "Workload: " + workloads[index] + ", " + dept.infos[index].rawWorkload + " (raw hours)";
                            }
                            else{
                                return "Workload: " + workloads[index];
                            }
                        }
                        else{
                            return "Error displaying label";
                        }
                    }
                }
            },
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