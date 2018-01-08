function createChart(){
    var enrollments = JSON.parse(document.getElementById("valEnrollments").value);
    var recommends = JSON.parse(document.getElementById("valRecommends").value);
    var workloads = JSON.parse(document.getElementById("valWorkloads").value);
    var regEnrollRec = JSON.parse(document.getElementById("valEnrollRec").value);
    var regWorkRec = JSON.parse(document.getElementById("valWorkRec").value);

    var enrollRec = [];
    var workRec = [];

    var eMax = 0;
    var wMax = 0;
    for(var i = 0; i < enrollments.length; i++){
        if(recommends[i] > 0) enrollRec.push({x: enrollments[i], y: recommends[i]});
        if(recommends[i] > 0 && workloads[i] > 0) workRec.push({x: workloads[i], y: recommends[i]});
        if(enrollments[i] > enrollments[eMax]) eMax = i;
        if(workloads[i] > workloads[wMax]) wMax = i;
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
            },{
                type:"line",
                label: "Regression Line",
                backgroundColor: "#FF0000",
                borderColor: "#FF0000",
                data:[
                    {x: 0, y: regEnrollRec.B},
                    {x: 1000, y: regEnrollRec.M * 1000 + regEnrollRec.B}
                ]
            }]
        }
    }

    var workConfig = {
        type: "scatter",
        data: { 
            datasets: [{
                type: "scatter",
                label: "Workload vs. Recommend",
                data: workRec,
            },{
                type:"line",
                label: "Regression Line",
                backgroundColor: "#FF0000",
                borderColor: "#FF0000",
                data:[
                    {x: 0, y: regWorkRec.B},
                    {x: workloads[wMax],y: regWorkRec.M * workloads[wMax] + regWorkRec.B}
                ]
            }]
        }
    }

    var enrollChart = new Chart(enrollCtx, enrollConfig);
    var lblEnrollReg = document.getElementById("lblEnrollReg");
    lblEnrollReg.innerHTML = "R: " + regEnrollRec.R + " Slope: " + regEnrollRec.M + " B: " + regEnrollRec.B;

    var workChart = new Chart(workCtx, workConfig);
    var lblWorkReg = document.getElementById("lblWorkReg");
    lblWorkReg.innerHTML = "R: " + regWorkRec.R + " Slope: " + regWorkRec.M + " B: " + regWorkRec.B;
}