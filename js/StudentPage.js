function searchBasedID() {

}

function searchBasedCourse() {

}

function applyCourse() {

}

function dropCourse() {

}

function selectCourse(select_number, enu_number) {
    if (window.XMLHttpRequest)
    {
        // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        // IE6, IE5 浏览器执行代码
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }


    if (select_number >= enu_number){
        document.getElementById("select").innerHTML="选课申请";
        alert("选课人数已达上限，请进行选课申请");

    }
}

// $.ajax({
//     url:"server/ButtonServer.php", 			//the page containing php script
//     type: "POST", 				//request type
//     data:{action: n.value},
//     success:function(result){
//         alert(result);
//     }
// });
// function fun2(n) {
//     var url = "server/ButtonServer.php";
//     var data = {
//         action : n.value
//     };
//     jQuery.post(url, data, callback);
// }
// function callback(data) {
//     alert(data);
// }
