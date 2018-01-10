function listSemesters_Selected(){
    var listSems= document.getElementById("listSemesters");

    window.location.href = getPath() + "/semesters.php?sem=" + listSems.selectedIndex;
}

function createChart(){
    var courses = JSON.parse(document.getElementById("valCourses").value);
    var codes = [];
    var enrollRec = [];
    var workRec = [];

    for(var i = 0; i < courses.length; i++){
        if(courses[i].infos != undefined && courses[i].infos[0].workload > 0){
            codes.push(courses[i].code);
            enrollRec.push({x: courses[i].infos[0].enrollment, y: courses[i].infos[0].recommend});
            workRec.push({x: courses[i].infos[0].workload, y: courses[i].infos[0].recommend});
        }
    }

    var enrollCtx = document.getElementById("chartEnroll").getContext("2d");
    var workCtx = document.getElementById("chartWork").getContext("2d");

    var enrollConfig = {
        type: "scatter",
        data: { 
            datasets: [{
                type: "scatter",
                label: "Enrollment vs. Recommend", 
                data: enrollRec,
                borderColor: "rgba(0, 0, 255, 0.4)",
                backgroundColor: "rgba(0, 0, 255, 0.2)"
            }]
        },
        options : {
            responsive : false, 
            tooltips: {
                callbacks : {
                    label : function(tooltipsItem, data){
                        var index = tooltipsItem.index;
                        return codes[index] + " (" + enrollRec[index].x + ", " + enrollRec[index].y + ")"
                    }
                }
            },
            scales : {
                yAxes : [{
                    display : true,
                    scaleLabel : {
                        display : true,
                        labelString : "Recommend"
                    }
                }],
                xAxes : [{
                    display : true,
                    scaleLabel : {
                        display : true,
                        labelString : "Enrollment"
                    }
                }]
            }
        }
    }

    var workConfig = {
        type: "scatter",
        data: { 
            datasets: [{
                type: "scatter",
                label: "Workload vs. Recommend",
                data: workRec,
                borderColor: "rgba(255, 0, 0, 0.4)",
                backgroundColor: "rgba(255, 0, 0, 0.2)"
            }]
        },
        options : {
            responsive : false,
            scales :{ 
                yAxes : [{
                    display : true,
                    ticks : {
                        min : 1.0,
                        max : 5.0,
                        stepSize : 0.5
                    },
                    scaleLabel : {
                        display : true,
                        labelString : "Recommend"
                    }
                }],
                xAxes : [{
                    display : true,
                    scaleLabel : {
                        display : true,
                        labelString : "Workload"
                    }
                }]
            },
            tooltips: {
                callbacks : {
                    label : function(tooltipsItem, data){
                        var index = tooltipsItem.index;
                        return codes[index] + " (" + workRec[index].x + ", " + workRec[index].y + ")"
                    }
                }
            }
        }
    }

    var enrollChart = new Chart(enrollCtx, enrollConfig);
    var lblEnrollReg = document.getElementById("lblEnrollReg");

    var workChart = new Chart(workCtx, workConfig);
    var lblWorkReg = document.getElementById("lblWorkReg");
}