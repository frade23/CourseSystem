<?php
session_start();

try{
    $db = new PDO("mysql:host=localhost;dbname=coursesystem", "root", "123456");//数据库名字为courseSystem
    $db -> exec('SET NAMES utf8');
}
catch (Exception $error){
    die("Connection failed:" . $error ->getMessage());
}

//导航栏的变化
$account = "登录";
$nb2 = "";

if (isset($_GET['$login'])){
    $_SESSION['login'] = $_GET['$login'];
}

if (isset($_SESSION['login']) && $_SESSION['login'] === 'true'){
    $account = $_SESSION['account'];
    $nb2 = $_SESSION['nb2'] = "登出";
}

$stuInfos = $db ->query("SELECT * FROM student WHERE stuID =  '$account'");
$stuInfoRow = $stuInfos->fetch(PDO::FETCH_ASSOC);
$stuName = $stuInfoRow["name"];
?>

<!DOCTYPE html>
<html lang="en" xmlns:align="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/StudentPage.css" media="all"/>
    <meta charset="UTF-8">
    <title>选课</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/StudentPage.js"></script>
</head>

<body class="container-fluid">
<div><p>&nbsp;</p>
    <h2>学生界面</h2>
    <span>
        <a class="btn btn-light" href="StudentPage.php"  style="float:right; margin-right:60px;margin-bottom: 10px ">
        <?php echo $account. "&nbsp;" .$stuName;?></a></span>
    <a class="btn btn-default" href="Login.php" role="button" style="float:right; margin-right:30px;margin-bottom: 10px ">
        <?php echo $nb2;?></a><br>
    <table align="center" class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
        <thead class="gridhead">
        <tr>
            <th style="width:55px">
                <div style="width:0px;height:0px;border-top:30px #C7DBFF solid;border-left:79px #DEEDF7 solid; position:relative;">
                    <span style="width:42px;text-align:center;position:absolute;top:-30px;left:-40px;">星期</span>
                    <span style="width:42px;text-align:center;position:absolute;top:-18px;left:-80px;">小节</span></div>
            </th>
            <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">星期日</th>
            <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">星期一</th>
            <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">星期二</th>
            <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">星期三</th>
            <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">星期四</th>
            <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">星期五</th>
            <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">星期六</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">第一节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="1" weekday="7"><br></td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="1" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="1" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="1" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="1" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="1" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="1" weekday="6">&nbsp;</td>
        </tr>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">第二节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="2" weekday="7">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="2" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="2" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="2" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="2" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="2" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="2" weekday="6">&nbsp;</td>
        </tr>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">第三节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="3" weekday="7">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="3" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="3" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="3" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="3" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="3" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="3" weekday="6">&nbsp;</td>
        </tr>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">第四节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="4" weekday="7">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="4" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="4" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="4" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="4" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="4" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="4" weekday="6">&nbsp;</td>
        </tr>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">第五节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="5" weekday="7">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="5" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="5" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="5" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="5" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="5" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="5" weekday="6">&nbsp;</td>
        </tr>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">第六节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="6" weekday="7">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="6" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="6" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="6" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="6" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="6" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="6" weekday="6">&nbsp;</td>
        </tr>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">第七节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="7" weekday="7">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="7" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="7" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="7" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="7" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="7" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="7" weekday="6">&nbsp;</td>
        </tr>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">第八节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="8" weekday="7">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="8" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="8" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="8" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="8" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="8" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="8" weekday="6">&nbsp;</td>
        </tr>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">第九节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="9" weekday="7">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="9" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="9" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="9" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="9" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="9" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="9" weekday="6">&nbsp;</td>
        </tr>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">第十节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="10" weekday="7">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="10" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="10" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="10" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="10" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="10" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="10" weekday="6">&nbsp;</td>
        </tr>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">十一节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="11" weekday="7">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="11" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="11" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="11" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="11" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="11" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="11" weekday="6">&nbsp;</td>
        </tr>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">十二节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="12" weekday="7">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="12" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="12" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="12" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="12" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="12" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="12" weekday="6">&nbsp;</td>
        </tr>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">十三节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="13" weekday="7">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="13" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="13" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="13" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="13" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="13" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="13" weekday="6">&nbsp;</td>
        </tr>
        <tr>
            <th style="width:99px;;height:20px;background:#DEEDF7;text-align:center;">十四节</th>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="14" weekday="7">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="14" weekday="1">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="14" weekday="2">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="14" weekday="3">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="14" weekday="4">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="14" weekday="5">&nbsp;</td>
            <td class="electableCell" style="width:99px;;height:20px;text-align:center;" unit="14" weekday="6">&nbsp;</td>
        </tr>
        </tbody>
    </table>
</div>

<div>
    <ul id="myTab" class="nav nav-tabs">
        <li class="active">
            <a href="#ableSelected" data-toggle="tab">
                可选课程
            </a>
        </li>
        <li><a href="#selected" data-toggle="tab">已选课程</a></li>
        <li><a href="#already-apply" data-toggle="tab">已申请课程</a></li>
        <li><a href="#already-finish" data-toggle="tab">已修课程</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="ableSelected">
            <h4>选课列表</h4>
            <form class="form-search" action="StudentPage.php" method="get">
                <label>
                    <input class="input-medium search-query" type="text" name="title" placeholder="输入课程名或ID搜索课程" value="">
                    <?php ?>
                </label>
                <!--            <button type="submit" class="btn" contenteditable="true" onclick="searchBasedID()">按课程ID查找</button>-->
                <input type="submit" class="btn" value="搜索">
            </form>
            <table class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
                <thead class="gridhead">
                <tr>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程ID</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程名称</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">学院</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">学分</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">教师</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">周课时</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">已选/上限</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">考试安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {
                    header('Location:Login.php');
                }

                if (isset($_GET['title']) && $_GET['title'] != ""){
                    $title = $_GET['title'];
                    $courseInfo = $db ->query("SELECT * FROM course natural join instructor WHERE title like '$title%' or courseID like '$title%'");//匹配包含$title的字符串

                    $courseID = $courseTitle = $credit = $department = $already_num = $exam_type = "";
                    $insName = "";
                    $select_num = $expect_num = 0;
                    while($rows = $courseInfo ->fetch()){
                        $keshi = 0;//周课时

                        $courseID = $rows['courseID'];
                        $courseTakes = $db->query("select * from stu_takes where stuID = '$account' and dropped='否' and courseID='$courseID'");
                        if ($courseTakes->fetch())
                            continue; //实现已选的课不展示


                        $classes=$db->query("SELECT the_day,start_lesson,end_lesson,building_room from classroom_time where courseID='$courseID' and user_for='上课'");
                        $class_msg="第1~17周：\n";
                        while($class = $classes->fetch(PDO::FETCH_ASSOC)){
                            $class_msg .= "周".$class["the_day"]." 第 ".$class["start_lesson"]." ~ ".$class["end_lesson"]." 节 ，地点 ：".$class["building_room"]."; ";
                            $keshi += $class['end_lesson']-$class['start_lesson']+1;
                        }

                        $test_msg ="";
                        if($rows["exam_type"]=='考试'){

                            $test=$db->query("SELECT the_day,start_lesson,end_lesson,building_room from classroom_time where courseID='$courseID' and user_for='考试'")->fetch();

                            $test_msg .= "考试；第18周，周".$test["the_day"]." 第 ".$test["start_lesson"]." ~ ".$test["end_lesson"]." 节 ，地点 ：".$test["building_room"]."\n";
                        }else{
                            $test=$db->query("SELECT * from paper where courseID='$courseID'")->fetch();
                            $test_msg .= "论文；主题： ".$test["theme"]."\nddl ：".$test["ddl"];
                        }


                        $courseTitle = $rows['title'];
                        $credit = $rows['credit'];
                        $department = $rows['department'];
                        $expect_num = $rows['expect_num'];
                        $exam_type = $rows['exam_type'];
                        $insName = $rows['name'];
                        $select_num = $rows['num'];?>

                        <!--//                    $stu_takes=$db->query("SELECT * from stu_takes where courseID='$courseID' and dropped='否' ");-->
                        <!--//                    $count=0;-->
                        <!--//                    while($stu_take=$stu_takes->fetch()){-->
                        <!--//                        $count++;-->
                        <!--//                    }-->
                        <!--                    //展示搜索出来的课程信息-->
                        <tr>
                        <td style="text-align:center;"><?php echo $courseID; ?></td>
                        <td style="text-align:center;"><?php echo $courseTitle; ?></td>
                        <td style="text - align:center;"><?php echo $department; ?></td>
                        <td style="text-align:center;"><?php echo $credit; ?></td>
                        <td style="text-align:center;"><?php echo $insName; ?></td>
                        <td style="text-align:center;"><?php echo $keshi; ?></td>
                        <td style="text-align:center;"><?php echo $select_num."/".$expect_num; ?></td>
                        <td style="text-align:center;"><?php echo $class_msg; ?></td>
                        <td style="text-align:center;"><?php echo $test_msg; ?></td>
                        <td>
                        <?php if ($select_num < $expect_num){ //处理PHP按钮点击事件?><!--   有余量-->
                            <a href="StudentPage.php?id=<?php echo $courseID; ?>&select=sel" onclick="return confirm('确认选这门课吗？')">
                                <button type="button" class="btn btn-link">选课</button>
                            </a>
                        <?php } else {?>
                            <a href="StudentPage.php?id=<?php echo $courseID; ?>&select=apply" onclick="return confirm('是否进行选课申请?')">
                                <button type="button" class="btn btn-link">选课申请</button>
                            </a></td>
                            </tr><?php }?>

                        <?php

                    }
                }   ?>
                <tr>
                    <?php //选课
                    if(isset($_GET['select']) and isset($_GET['id'])){
                        $course_selectingID = $_GET['id'];
                        if ($_GET['select'] == "sel"){
                            $selecting_class_infos = $db->query("select * from course natural join classroom_time where courseID='$course_selectingID' and user_for='上课'");
                            $selecting_exam_infos = $db->query("select * from course natural join classroom_time where courseID='$course_selectingID' and user_for='考试'");
                            $my_class_infos = $db->query("select * from stu_takes natural join course natural join classroom_time where user_for='上课' and dropped = '否'");
                            $my_exam_infos = $db->query("select * from stu_takes natural join course natural join classroom_time where user_for='考试'and dropped='否'");
                            $flag = true;
                            $mesg = "";
                            while ($selecting_class_info = $selecting_class_infos->fetch()){
                                while ($my_class_info = $my_class_infos->fetch()){
                                    if ($selecting_class_info['the_day'] != $my_class_info['the_day']
                                        or ($selecting_class_info['start_lesson']> $my_class_info['end_lesson'])
                                        or $selecting_class_info['end_lesson'] < $my_class_info['start_lesson'])
                                        continue;
                                    else {
                                        $mesg = "选课失败，与已有课程上课时间冲突";
                                        echo "<script>alert(".$mesg.")</script>";
                                        $flag = false;
                                    }
                                }
                            }
                            while ($selecting_exam_info=$selecting_exam_infos->fetch()){
                                while ($my_exam_info = $my_exam_infos->fetch()){
                                    if ($selecting_exam_info['the_day'] != $my_exam_info['the_day']
                                        or ($selecting_exam_info['start_lesson']> $my_exam_info['end_lesson'])
                                        or $selecting_exam_info['end_lesson'] < $my_exam_info['start_lesson'])
                                        continue;
                                    else {
                                        $mesg = "选课失败，与已有课程考试时间冲突";
                                        echo "<script>alert(".$mesg.")</script>";
                                        $flag = false;
                                    }
                                }
                            }
                            if ($flag){
                                if ($db->query("select dropped from stu_takes where courseID='$course_selectingID' and stuID='$account'")->fetch()['dropped']=="是")
                                    $db->query("update stu_takes set dropped='否' where courseID='$course_selectingID' and stuID='$account'");
                                else $db->query("insert into stu_takes (courseID, stuID, dropped, grade) values ('$course_selectingID', '$account', '否', '0')");
                                $selecting_courses = $db->query("select credit from course where courseID='$course_selectingID'")->fetch();
                                $credit_selecting = $selecting_courses['credit'];
                                $db->query("update course set num=num+1 where courseID='$course_selectingID'");
                                $db->query("update student set total_credit=total_credit+$credit_selecting where stuID='$account'");
                                $mesg = "选课成功!!";
                                echo "<script>alert(".$mesg.")</script>";
                            }
                        }
                    } ?>

                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="selected">
            <table align="center" class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
                <thead class="gridhead">
                <tr>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程ID</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程名称</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">学分</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">学院</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">教师</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">周课时</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">已选/上限</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">考试安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $flag_drop = true;
                if(isset($_GET['select']) and isset($_GET['cid'])){
                    if ($_GET['select']=="dropped"){
                        $course_takenID = $_GET['cid'];
                        $db->query("update stu_takes set dropped='是' where courseID='$course_takenID' and stuID='$account'");
                        $dropping_courses = $db->query("select credit from course where courseID='$course_takenID'")->fetch();
                        $credit_dropping = $dropping_courses['credit'];
                        $db->query("update course set num = num-1 where courseID='$course_takenID'");
                        $db->query("update student set total_credit = total_credit-$credit_dropping where stuID='$account'");
                        $flag_drop = false;
                        $mesg = "退课成功";
                        echo "<script>alert(".$mesg.")</script>";
                        echo $flag_drop;
                    }
                } ?>

                <?php
                if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {
                    header('Location:Login.php');
                }

                $courseInfos = $db ->query("SELECT * FROM stu_takes natural join course natural join instructor WHERE stuID='$account' and dropped='否'");//匹配包含$title的字符串

                $courseID_taken = $courseTitle_taken = $credit_taken = $department_taken = $already_num_taken = $exam_type_taken = "";
                $insName_taken = "";
                $select_num_taken = $expect_num_taken = 0;
                while($rows_taken = $courseInfos ->fetch()){
                    $keshi_taken = 0;//周课时

                    $courseID_taken = $rows_taken['courseID'];
                    $classes_taken=$db->query("SELECT the_day,start_lesson,end_lesson,building_room from classroom_time where courseID='$courseID_taken' and user_for='上课'");
                    $class_msg_taken="第1~17周：\n";
                    while($class_taken = $classes_taken->fetch(PDO::FETCH_ASSOC)){
                        $class_msg_taken .= "周".$class_taken["the_day"]." 第 ".$class_taken["start_lesson"]." ~ ".$class_taken["end_lesson"]." 节 ，地点 ：".$class_taken["building_room"]."; ";
                        $keshi_taken += $class_taken['end_lesson']-$class_taken['start_lesson']+1;
                    }

                    $test_msg_taken ="";
                    if($rows_taken["exam_type"]=='考试'){

                        $test_taken=$db->query("SELECT the_day,start_lesson,end_lesson,building_room from classroom_time where courseID='$courseID_taken' and user_for='考试'")->fetch();

                        $test_msg_taken .= "考试；第18周，周".$test_taken["the_day"]." 第 ".$test_taken["start_lesson"]." ~ ".$test_taken["end_lesson"]." 节 ，地点 ：".$test_taken["building_room"]."\n";
                    }else{
                        $test_taken=$db->query("SELECT * from paper where courseID='$courseID_taken'")->fetch();
                        $test_msg_taken .= "论文；主题： ".$test_taken["theme"]."\nddl ：".$test_taken["ddl"];
                    }


                    $courseTitle_taken = $rows_taken['title'];
                    $credit_taken = $rows_taken['credit'];
                    $department_taken = $rows_taken['department'];
                    $expect_num_taken = $rows_taken['expect_num'];
                    $exam_type_taken = $rows_taken['exam_type'];
                    $insName_taken = $rows_taken['name'];
                    $select_num_taken = $rows_taken['num'];?>

                    <!--//                    $stu_takes=$db->query("SELECT * from stu_takes where courseID='$courseID' and dropped='否' ");-->
                    <!--//                    $count=0;-->
                    <!--//                    while($stu_take=$stu_takes->fetch()){-->
                    <!--//                        $count++;-->
                    <!--//                    }-->
                    <!--                    //展示搜索出来的课程信息-->
                    <tr>
                    <td style="text-align:center;"><?php echo $courseID_taken; ?></td>
                    <td style="text-align:center;"><?php echo $courseTitle_taken; ?></td>
                    <td style="text - align:center;"><?php echo $department_taken; ?></td>
                    <td style="text-align:center;"><?php echo $credit_taken; ?></td>
                    <td style="text-align:center;"><?php echo $insName_taken; ?></td>
                    <td style="text-align:center;"><?php echo $keshi_taken; ?></td>
                    <td style="text-align:center;"><?php echo $select_num_taken."/".$expect_num_taken; ?></td>
                    <td style="text-align:center;"><?php echo $class_msg_taken; ?></td>
                    <td style="text-align:center;"><?php echo $test_msg_taken; ?></td>
                    <td>
                    <?php if ($select_num_taken > 0){//处理PHP按钮点击事件?>
                        <a href="StudentPage.php?cid=<?php echo $courseID_taken; ?>&select=dropped" onclick="return confirm('确认退这门课吗？')">
                            <button type="button" class="btn btn-link">退课</button>
                        </a><?php }?></td>
                        </tr>

                    <?php

                }
                   ?>
                <tr>

                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="already-apply">
            <table align="center" class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
                <thead class="gridhead">
                <tr>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程ID</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程名称</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">学分</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">学院</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">教师</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">周课时</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">已选/上限</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">考试安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php

                ?>
                <tr>
                    <td style="text-align:center;"></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:center;"></td>

                    <td><button type="button" class="btn btn-link" style="text-align:center;" onclick="dropCourse()">退课</button></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="already-finish">
            <table align="center" class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
                <thead class="gridhead">
                <tr>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程ID</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程名称</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">学分</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">教师</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">周课时</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">考试安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">成绩</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>

<!--导入资源-->
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
