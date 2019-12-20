var mysql = require('mysql');
var connection = mysql.createConnection({
    host     : 'localhost',
    user     : 'root',
    password : '123456',
    port: '3306',
    database: 'coursesystem'
});
function change() {
    var select = document.all['exam_type'].value;
    if(select == "考试"){
        exam();
    }
    if(select == "论文"){
        paper();
    }
}
function exam() {
    var paper = document.getElementById("paper");
    paper.innerHTML="";

    var exam = document.getElementById("exam");

    var examroom = document.createElement("input");
    var lableroom = document.createElement("lable");
    lableroom.innerText="请填写考试地点：";
    examroom.type = "text";
    examroom.name = "examroom";
    exam.appendChild(lableroom);
    exam.appendChild(examroom);

    exam.appendChild(document.createElement("br"));

    var labletime = document.createElement("lable");
    labletime.innerText="请填写考试时间 [ 按照周几、开始为第几节、结束为第几节填写 ] ：";
    exam.appendChild(labletime);

    var examtime_day = document.createElement("input");
    examtime_day.type = "text";
    examtime_day.name = "exam_day";
    exam.appendChild(examtime_day);

    var examtime_start = document.createElement("input");
    examtime_start.type = "number";
    examtime_start.name = "exam_start";
    exam.appendChild(examtime_start);

    var examtime_end = document.createElement("input");
    examtime_end.type = "number";
    examtime_end.name = "exam_end";
    exam.appendChild(examtime_end);



}



function paper() {

    var exam = document.getElementById("exam");
    exam.innerHTML="";

    var paper = document.getElementById("paper");

    var theme = document.createElement("input");
    theme.type = "text";
    theme.name = "theme";
    var labletheme = document.createElement("lable");
    labletheme.innerText="请填写论文主题：";

    paper.appendChild(labletheme);
    paper.appendChild(theme);


    var labletime = document.createElement("lable");
    labletime.innerText="请输入ddl时间（格式为YYYYMMDD）：";

    var ddl = document.createElement("input");
    ddl.type = "date";
    ddl.name = "ddl";


    paper.appendChild(labletime);
    paper.appendChild(ddl);


}
var count = 0;
function addnew() {
    // if(count > 0){
    //     addnewer();
    //     return
    // }
    // count++;
    var cl = document.getElementById("class");
    var labletime = document.createElement("lable");
    labletime.innerText="请填写上课时间与地点 [ 按照周几、开始为第几节、结束为第几节、地点在哪来进行填写 ] ：";
    cl.appendChild(labletime);

    var classtime_day = document.createElement("input");
    classtime_day.type = "text";
    classtime_day.name = "day1";
    cl.appendChild(classtime_day);

    var classtime_start = document.createElement("input");
    classtime_start.type = "number";
    classtime_start.name = "start1";
    cl.appendChild(classtime_start);

    var classtime_end = document.createElement("input");
    classtime_end.type = "number";
    classtime_end.name = "end1";
    cl.appendChild(classtime_end);
    cl.appendChild(document.createElement("br"));

    var classtime_building = document.createElement("input");
    classtime_building.type = "text";
    classtime_building.name = "building1";
    cl.appendChild(classtime_building);
    cl.appendChild(document.createElement("br"));
}