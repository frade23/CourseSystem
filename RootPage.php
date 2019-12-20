<?php
/**
 * Created by PhpStorm.
 * User: ZhangHao
 * Date: 2019/12/3
 * Time: 16:25
 */

//使用session_start共享变量
session_start();
//连接数据库
try{
    $db = new PDO("mysql:host=localhost;dbname=coursesystem", "root", "123456");//数据库名字为courseSystem
    $db -> exec('SET NAMES utf8');
}
catch (Exception $error){
    die("Connection failed:" . $error ->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/StudentPage.css" media="all"/>
    <meta charset="UTF-8">
    <title>管理员界面</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/RootPage.js"></script>
</head>
<body class="container-fluid">
<div><p>&nbsp;</p>
    <h2>管理员界面</h2><br>

    <form class="form-search" method="get" action="RootPage.php">
        <label>
            <input class="input-medium search-query" style="margin-left: 30px" type="text" name="search">
        </label>
        <input type="submit" class="btn btn-light" onclick="" value="查找">
        <a class="btn btn-default" style="float: right; margin-right: 30px" href="Login.php" role="button">登出</a>
        <span>
        <a class="btn btn-light" href="RootPage.php"  style="float:right; margin-right:60px;margin-bottom: 10px ">root</a></span>
    </form>
</div>

<div style="margin: 25px"><ul id="myTab" class="nav nav-tabs">
        <li><a href="#student" data-toggle="tab">学生</a></li>
        <li><a href="#instructor" data-toggle="tab">教师</a></li>
        <li><a href="#course" data-toggle="tab">课程</a></li>
        <li><a href="#add" data-toggle="tab">增添学生</a></li>
        <li><a href="#add_ins" data-toggle="tab">增添教师</a></li>
        <li><a href="#add_course" data-toggle="tab">增添课程</a></li>
    </ul>

    <div id="myTab" class="tab-content">
        <div class="tab-pane fade in active" id="student"><br>
            <legend>学生信息</legend>
            <table align="center" class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
                <thead class="gridhead">
                <tr>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">学号</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">姓名</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">院系</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $search = "";
                if (isset($_GET['search'])){
                    $search = $_GET['search'];
                }
                $stu_infos = $db->query("select * from student where stuID like '$search%' or name like '$search%'");
                while ($stu_info = $stu_infos->fetch()){
                    ?>
                <tr>
                    <td style="text-align:center;"><?php echo $stu_info['stuID']; ?></td>
                    <td style="text-align:center;"><?php echo $stu_info['name']; ?></td>
                    <td style="text - align:center;"><?php echo $stu_info['department']; ?></td>
                    <td>
                        <?php //处理PHP按钮点击事件?>
                        <a href="RootPage.php?id=<?php echo $stu_info['stuID']; ?>&select=del" onclick="return confirm('确认删除该学生吗？')">
                            <button type="button" class="btn btn-link">删除</button></a>
                    </td>
                <?php
                }

                //删除学生
                if (isset($_GET['id']) and isset($_GET['select'])){
                    if ($_GET['select'] == "del"){
                        $db->query("start");
                        $stu_id = $_GET['id'];
                        $r = $db->query("delete from student where stuID='$stu_id'");
                        if ($r){
                            $db->query("commit");
                            $_SESSION['mesg'] = "删除成功";
                        }else{
                            $db->query("rollback");
                            $_SESSION['mesg'] = "提交失败";
                        }
                        $db->query("end");
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="instructor"><br>
            <legend>教师信息</legend>
            <table align="center" class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
                <thead class="gridhead">
                <tr>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">工号</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">姓名</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">院系</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $ins_infos = $db->query("select * from instructor where workID like '$search%' or name like '$search%'");
                while ($ins_info = $ins_infos->fetch()){
                ?>
                <tr>
                    <td style="text-align:center;"><?php echo $ins_info['workID']; ?></td>
                    <td style="text-align:center;"><?php echo $ins_info['name']; ?></td>
                    <td style="text-align:center;"><?php echo $ins_info['department']; ?></td>
                    <td>
                        <?php //处理PHP按钮点击事件?>
                        <a href="RootPage.php?id=<?php echo $ins_info['workID']; ?>&select=del_ins" onclick="return confirm('确认删除该教师吗？')">
                            <button type="button" class="btn btn-link">删除</button></a>
                    </td>
                    <?php
                    }

                    //删除教师
                    if (isset($_GET['id']) and isset($_GET['select'])){
                        if ($_GET['select'] == "del_ins"){
                            $db->query("start");
                            $ins_id = $_GET['id'];
                            $r = $db->query("delete from instructor where workID='$ins_id'");
                            if ($r){
                                $db->query("commit");
                                $_SESSION['mesg'] = "删除成功";
                            }else{
                                $db->query("rollback");
                                $_SESSION['mesg'] = "提交失败";
                            }
                            $db->query("end");
                        }
                    }?>

                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="course"><br>
            <legend>课程信息</legend>
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
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">教室上限</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">考试安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $course_infos = $db->query("select * from course natural join instructor where courseID like '$search%' or title like '$search%'");
                while ($course_info = $course_infos->fetch()){
                $keshi = $max_num = 0;//周课时
                $courseID = $course_info['courseID'];
                $classes=$db->query("SELECT the_day,start_lesson,end_lesson,building_room from classroom_time where courseID='$courseID' and user_for='上课'");
                $class_msg="第1~17周：\n";
                while($class = $classes->fetch(PDO::FETCH_ASSOC)){
                    $class_msg .= "周".$class["the_day"]." 第 ".$class["start_lesson"]." ~ ".$class["end_lesson"]." 节 ，地点 ：".$class["building_room"]."; ";
                    $keshi += $class['end_lesson']-$class['start_lesson']+1;
                    $building_room = $class['building_room'];
                    $building_row = $db->query("select max_num from classroom where building_room='$building_room'")->fetch();
                    $max_num = $building_row['max_num'];
                }

                $test_msg ="";
                if($course_info["exam_type"]=='考试'){

                    $test=$db->query("SELECT the_day,start_lesson,end_lesson,building_room from classroom_time where courseID='$courseID' and user_for='考试'")->fetch();

                    $test_msg .= "考试；第18周，周".$test["the_day"]." 第 ".$test["start_lesson"]." ~ ".$test["end_lesson"]." 节 ，地点 ：".$test["building_room"]."\n";
                }else{
                    $test=$db->query("SELECT * from paper where courseID='$courseID'")->fetch();
                    $test_msg .= "论文；主题： ".$test["theme"]."\nddl ：".$test["ddl"];
                }

                //删除课程
                if (isset($_GET['id']) and isset($_GET['select'])){
                    if ($_GET['select'] == "del_cos"){
                        $db->query("start");
                        $course_id = $_GET['id'];
                        $r = $db->query("delete from course where courseID='$course_id'");
                        if ($r){
                            $db->query("commit");
                            $_SESSION['mesg'] = "删除成功";
                        }else{
                            $db->query("rollback");
                            $_SESSION['mesg'] = "提交失败";
                        }
                        $db->query("end");
                        echo "<script language=JavaScript> location.replace(location.href);</script>";
                    }
                }
                //展示课程?>
                <tr>
                    <td style="text-align:center;"><?php echo $courseID; ?></td>
                    <td style="text-align:center;"><?php echo $course_info['title']; ?></td>
                    <td style="text-align:center;"><?php echo $course_info['credit']; ?></td>
                    <td style="text-align:center;"><?php echo $course_info['department']; ?></td>
                    <td style="text-align:center;"><?php echo $course_info['name']; ?></td>
                    <td style="text-align:center;"><?php echo $keshi; ?></td>
                    <td style="text-align:center;"><?php echo $course_info['num']."/".$course_info['expect_num']; ?></td>
                    <td style="text-align:center;"><?php echo $max_num; ?></td>
                    <td style="text-align:center;"><?php echo $class_msg; ?></td>
                    <td style="text-align:center;"><?php echo $test_msg; ?></td>
                    <td>
                        <?php //处理PHP按钮点击事件?>
                        <a href="RootPage.php?id=<?php echo $courseID; ?>&select=del_cos" onclick="return confirm('确认删除该课程吗？')">
                            <button type="button" class="btn btn-link">删除</button></a>
                    </td>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        //增添学生
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (!empty($_POST['name'])){
                $name = $_POST['name'];
                $stuID = $_POST['stuID'];
                $password = $_POST['password'];
                $department = $_POST['department'];
                $db->query("start");
                $r2 = $db->query("insert into account values ('$stuID', '$password', 'stu')");
                $r1 = $db->query("insert into student (stuID, name, department) VALUES ('$stuID','$name','$department')");
                if ($r1 and $r2){
                    $db->query("commit");
                    echo "<script>alert('增添成功')</script>";
                }else{
                    $db->query("rollback");
                    echo "<script>alert('提交失败')</script>";
                }
                $db->query("end");

                echo "<script language=JavaScript> location.replace(location.href);</script>";
            }
        }
        ?>
        <div class="tab-pane fade container" id="add">
            <div class="row">
                <div class="col-md-3 column"> <br>
                    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <legend>增添学生</legend>
                        <div class="form-group">
                            <label for="exampleInput">姓名</label>
                            <input type="text" class="form-control" id="exampleInput" name="name" />
                        </div>
                        <div class="form-group">
                            <label for="InputPassword1">学号</label>
                            <input type="text" class="form-control" id="InputPassword1" name="stuID" />
                        </div>
                        <div class="form-group">
                            <label for="Password1">密码</label>
                            <input type="text" class="form-control" id="Password1" name="password" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">院系</label>
                            <input type="text" class="form-control" id="exampleInputPassword2" name="department"/>
                        </div>
                        <button type="submit" class="btn btn-default">提交</button>
                    </form>
                </div>
                <div class="col-md-1 column"></div>

            </div>
        </div>

        <div class="tab-pane fade container" id="add_ins"><br><?php
            //增添教师
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (!empty($_POST['name_ins'])){
                $name = $_POST['name_ins'];
                $workID = $_POST['workID'];
                $password = $_POST['password_ins'];
                $department = $_POST['department_ins'];
                $db->query("start");

                $r2 = $db->query("insert into account values ('$workID', '$password', 'ins')");
                $r1 = $db->query("insert into instructor (workID, name, department) VALUES ('$workID','$name','$department')");
                if ($r1 and $r2){
                    $db->query("commit");
                    echo "<script>alert('增添成功')</script>";
                }else{
                    $db->query("rollback");
                    echo "<script>alert('提交失败')</script>";
                }
                $db->query("end");

                echo "<script language=JavaScript> location.replace(location.href);</script>";
                }
            }
            ?>
            <div class="col-md-3 column"> <br>
                <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <legend>增添教师</legend>
                    <div class="form-group">
                        <label for="exampleInputEmail1">姓名</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="name_ins" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">工号</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="workID" />
                    </div>
                    <div class="form-group">
                        <label for="Password1">密码</label>
                        <input type="text" class="form-control" id="Password1" name="password_ins" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword2">院系</label>
                        <input type="text" class="form-control" id="exampleInputPassword2" name="department_ins"/>
                    </div>
                    <button type="submit" class="btn btn-default">提交</button>
                </form>
            </div>
            <div class="col-md-1 column"></div>
        </div>
        <div class="tab-pane fade" id="add_course">
            <!--                添加课程-->
            <?php
            //        事务处理
            if(isset($_POST['courseID_up'])){
//            echo "<script>alert('$exam_type')</script>";
                $courseID=$_POST['courseID_up'];
                $title =$_POST['title_up'];
                $workID = $_POST['workID_up'];
                $credit =$_POST['credit_up'];
                $dept = $_POST['depart_up'];
                $expect_num=$_POST['expect_num_up'];
                $num = 0;
                $exam_type=$_POST['exam_type'];


                //事务处理
                $db->query("BEGIN");
                //插入课程
                $r1 = true;
                $r2 = true;
                $r3 = true;
                $r4 = true;
                $r5 = true;
//            $r6 = true;
                $r1 = $db->query("insert into course values('$courseID','$title','$workID','$credit','$dept','$expect_num','$exam_type','$num')");

                if($exam_type == "论文" ){

                    $ddl = $_POST['ddl'];

                    $theme=$_POST['theme'];
                    $r2 = $db->query("insert into paper values('$courseID','$theme',$ddl)");
                }
//            插入exam，考虑考试时间冲突
                if($exam_type == "考试" && isset($_POST['examroom'])){
                    $exam_building = $_POST['examroom'];
                    $exam_day=$_POST['exam_day'];
                    $exam_start=$_POST['exam_start'];
                    $exam_end=$_POST['exam_end'];

                    $exam_congestion = false;
                    $max_num=$db->query("select max_num from classroom where building_room= '$exam_building'")->fetch();
                    if($max_num['max_num'] < $expect_num ){
                        $db->query("ROLLBACK");
                        $con_msg='考试教室'.$exam_building.'仅能容纳'.$max_num['max_num'].'人，大于期望人数'.$expect_num.'人';
                        echo "<script>alert('$con_msg')</script>";
                    }

                    $exams = $db->query("select start_lesson,end_lesson from classroom_time where user_for='考试' and the_day='$exam_day' and building_room='$exam_building'");

                    while ($row = $exams->fetch()){
                        if(($row['start_lesson'] - $exam_end)*($row['end_lesson'] - $exam_start) <= 0){
                            $exam_congestion = true;
                            $start_congestion = $row['start_lesson'];
                            $end_congestion = $row['end_lesson'];                    }
                    }
                    if($exam_congestion){
                        $db->query("ROLLBACK");
                        $con_msg='考试时间地点存在冲突: 当天该教室第'.$start_congestion.'到第'.$end_congestion.'节课已有考试';
                        echo "<script>alert('$con_msg')</script>";
                    }
                    $r3 = $db->query("insert into classroom_time(courseID, user_for, the_day, start_lesson, end_lesson, building_room)
                                        values('$courseID','考试','$exam_day','$exam_start','$exam_end','$exam_building')");
                }

//            插入上课时间
                $day = $_POST['day'];
                $start =$_POST['start'];
                $end = $_POST['end'];
                $building = $_POST['building'];
//          考察期望人数是否符合教室容量
                $max_num=$db->query("select max_num from classroom where building_room= '$building'")->fetch();
                if($max_num['max_num'] < $expect_num ){
                    $db->query("ROLLBACK");
                    $con_msg='考试教室'.$building.'仅能容纳'.$max_num['max_num'].'人，大于期望人数'.$expect_num.'人';
                    echo "<script>alert('$con_msg')</script>";
                }
//          考察教师是否在同一时间有多门课程
                $time_congestion=false;
                $times = $db->query("select start_lesson,end_lesson from classroom_time natural join course where user_for='上课' and the_day='$day' and workID = '$workID'");

                while ($row = $times->fetch()){
                    if(($row['start_lesson'] - $end)*($row['end_lesson'] - $start)<= 0){
                        $time_congestion = true;
                        $time_start_congestion = $row['start_lesson'];
                        $time_end_congestion = $row['end_lesson'];                    }
                }
                if($time_congestion){
                    $db->query("ROLLBACK");
                    $con_msg='上课时间存在冲突: 当天您第'.$time_start_congestion.'到第'.$time_end_congestion.'节课已有课程';
                    echo "<script>alert('$con_msg')</script>";
                }


//          考察同一时间地点是否有其他课程
                $classes = $db->query("select start_lesson,end_lesson from classroom_time where user_for='上课' and the_day='$day' and building_room='$building'");
                $class_congestion=false;

                while ($row = $classes->fetch()){
                    if(($row['start_lesson'] - $end)*($row['end_lesson'] - $start) <= 0){
                        $class_congestion = true;
                        $class_start_congestion = $row['start_lesson'];
                        $class_end_congestion = $row['end_lesson'];                    }
                }
                if($class_congestion){
                    $db->query("ROLLBACK");
                    $con_msg='上课时间存在冲突: 当天该教室第'.$class_start_congestion.'到第'.$class_end_congestion.'节课已有课程';
                    echo "<script>alert('$con_msg')</script>";
                }

                $r4 = $db->query("insert into classroom_time(courseID, user_for, the_day, start_lesson, end_lesson, building_room)
                                        values('$courseID','上课','$day','$start','$end','$building')");
                if(isset($_POST['day1'])){
                    $day1 = $_POST['day1'];
                    $start1 =$_POST['start1'];
                    $end1 = $_POST['end1'];
                    $building1 = $_POST['building1'];

                    $max_num=$db->query("select max_num from classroom where building_room= '$building1'")->fetch();
                    if($max_num['max_num'] < $expect_num ){
                        $db->query("ROLLBACK");
                        $con_msg='考试教室'.$building1.'仅能容纳'.$max_num['max_num'].'人，大于期望人数'.$expect_num.'人';
                        echo "<script>alert('$con_msg')</script>";
                    }


                    //          考察教室是否在同一时间有多门课程
                    $time1_congestion=false;
                    $times = $db->query("select start_lesson,end_lesson from classroom_time natural join course where user_for='上课' and the_day='$day1' and workID = '$workID'");
                    while ($row = $times->fetch()){
                        if(($row['start_lesson'] - $end1)*($row['end_lesson'] - $start1) <= 0){
                            $time1_congestion = true;
                            $time1_start_congestion = $row['start_lesson'];
                            $time1_end_congestion = $row['end_lesson'];                    }
                    }
                    if($time1_congestion){
                        $db->query("ROLLBACK");
                        $con_msg='上课时间存在冲突: 当天您第'.$time1_start_congestion.'到第'.$time1_end_congestion.'节课已有课程';
                        echo "<script>alert('$con_msg')</script>";
                    }

                    $classes = $db->query("select start_lesson,end_lesson from classroom_time where user_for='上课' and the_day='$day1' and building_room='$building1'");
                    $class1_congestion = false;
                    while ($row = $classes->fetch()){
                        if(($row['start_lesson'] - $end1)*($row['end_lesson'] - $start1) <= 0){
                            $class1_congestion = true;
                            $class_start_congestion = $row['start_lesson'];
                            $class_end_congestion = $row['end_lesson'];
                        }
                    }
                    if($class1_congestion){
                        $db->query("ROLLBACK");
                        $con_msg='上课时间地点存在冲突: 当天该教室第'.$class_start_congestion.'到第'.$class_end_congestion.'节课已有课程';
                        echo "<script>alert('$con_msg')</script>";
                    }

                    $r5 = $db->query("insert into classroom_time(courseID, user_for, the_day, start_lesson, end_lesson, building_room)
                                        values('$courseID','上课','$day1','$start1','$end1','$building1')");

                }

                if($r1 && $r2 && $r3 && $r4 && $r5 ){
                    $db->query("COMMIT");
                    echo "<script>alert('提交成功')</script>";
                }else{
                    $db->query("ROLLBACK");
                    echo "<script>alert('提交失败')</script>";
                }
                $db->query("END");

                echo "<script language=JavaScript> location.replace(location.href);</script>";

            }?>

            <div class=""><br>
                <form action="RootPage.php" method="post">
                    <legend>增添课程</legend>
                    <table align="center" class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
                        <thead class="gridhead">


                        课程ID: <input type="text" name="courseID_up" ><br><br>
                        课程名: <input type="text" name="title_up" ><br><br>
                        教师工号：<input type="text" name="workID_up" ><br><br>
                        学分：<input type="number" name="credit_up" ><br><br>
                        院系：<input type="text" name="depart_up" ><br><br>
                        期望学生数：<input type="number" name="expect_num_up" ><br><br>

                        <div id="class">
                            周<input name="day" type="text">
                            从第<input name="start" type="number">节课到
                            第<input name="end" type="number">节课<br>
                            地点：<input name="building" type="text"><br>
                        </div>
                        <input type="button" class="btn btn-default" onclick="addnew()" value="添加新的上课时间地点"><br><br>
                        考试类型：

                        <select id="exam_type_root" name="exam_type" onchange="change()">
                            <option >选择考试类型</option>
                            <option value="考试" >考试</option>
                            <option value="论文" >论文</option>
                        </select><br>

                        <div id="exam_root"></div>
                        <div id="paper_root"></div>


                        <input type="submit" class="btn btn-default" value="提交">


                        <tbody>

                        </tbody>
                    </table>
                </form>
            </div>
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
