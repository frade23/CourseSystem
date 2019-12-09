<?php
/**
 * Created by PhpStorm.
 * User: ZhangHao
 * Date: 2019/12/3
 * Time: 13:22
 */
session_start();

try{
    $db = new PDO("mysql:host=localhost;dbname=coursesystem", "root", "");//数据库名字为courseSystem
    $db -> exec('SET NAMES utf8');
}
catch (Exception $error){
    die("Connection failed:" . $error ->getMessage());
}
// $_SESSION['workID']='SOFT-123';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/StudentPage.css" media="all"/>
    <meta charset="UTF-8">
    <title>教师界面</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/InstPage.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body class="container-fluid">
<div><p>&nbsp;</p>
    <h2>教师界面</h2><br>
    <?php
    $_SESSION['account']='SOFT-123';
    $workID=$_SESSION['account'];
    $inst = $db ->query("SELECT * FROM instructor WHERE workID='$workID'") ->fetch();
    $name = $inst['name'];
    $workID =$inst['workID'];
    $dept =$inst['department'];
    ?>

    <label><?php echo $workID; ?></label>
    <label><?php echo $name; ?></label>
    <label><?php echo $dept; ?></label>


    <form class="form-search">
        <label>
            <input class="input-medium search-query" style="margin-left: 30px" type="text">
        </label>
        <button type="submit" class="btn" contenteditable="true" onclick="">查找</button>
        <a class="btn btn-default" style="float: right; margin-right: 30px" href="Login.php" role="button">登出</a>
    </form>
</div>

<div style="margin: 25px"><ul id="myTab" class="nav nav-tabs">
        <li>
            <a href="#membership" data-toggle="tab">花名册</a>
        </li>
        <li><a href="#solve-apply" data-toggle="tab">处理申请</a></li>
        <li><a href="#set-course" data-toggle="tab">开设课程</a></li>
        <li><a href="#score" data-toggle="tab">登分</a></li>
    </ul>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade" id="membership">
            <!--          to do：展示花名册          -->
            <table align="center" class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
                <thead class="gridhead">
                <tr>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程ID</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程名称</th>
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
                $result=$db->query("SELECT * from course where workID='$workID'");

                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $courseID=$row["courseID"];
                    $classes=$db->query("SELECT the_day,start_lesson,end_lesson,building_room from classroom_time where courseID='$courseID' and user_for='上课'");
                    $class_msg="第1~17周：\n";
                    $keshi=0;

                while($class = $classes->fetch(PDO::FETCH_ASSOC)){
                    $class_msg .= "周".$class["the_day"]." 第 ".$class["start_lesson"]." ~ ".$class["end_lesson"]." 节 ，地点 ：".$class["building_room"]."\n";
                    $keshi += 2;
                }

                    $test_msg ="";
                if($row["exam_type"]=='考试'){

                    $test=$db->query("SELECT the_day,start_lesson,end_lesson,building_room from classroom_time where courseID='$courseID' and user_for='考试'")->fetch();

                    $test_msg .= "考试；第18周，周".$test["the_day"]." 第 ".$test["start_lesson"]." ~ ".$test["end_lesson"]." 节 ，地点 ：".$test["building_room"]."\n";
                }else{
                    $test=$db->query("SELECT * from paper where courseID='$courseID'")->fetch();
                    $test_msg .= "论文；主题： ".$test["theme"]."\nddl ：".$test["ddl"];
                }

                $stu_takes=$db->query("SELECT * from stu_takes where courseID='$courseID' and dropped='否' ");
                $count=0;
                $stu_msg="";
                while($stu_take=$stu_takes->fetch()){
                    $count++;
                    $stuID=$stu_take["stuID"];
                    $stu=$db->query("SELECT stuID,name,department from student where stuID='$stuID'")->fetch();
                    $stu_msg.="     学号：".$stu["stuID"];
                    $stu_msg.="                  姓名:".$stu["name"];
                    $stu_msg.="                  专业：".$stu["department"];
                    $stu_msg.="\n";
                }
                ?>
                    <tr>
                        <td><?php echo $row["courseID"];?></td>
                        <td><?php echo $row["title"];?></td>
                        <td><?php echo $row["credit"];?></td>
                        <td><?php echo $name;?></td>
                        <td><?php echo $keshi;?></td>
                        <td><?php echo $count."/".$row["expect_num"];?></td>
                        <td><?php echo $class_msg;?></td>
                        <td><?php echo $test_msg;?></td>
                        <td>
                            <button type="button" class="btn btn-link" style="text-align:center" data-toggle="collapse" data-target="#stu_msg">查看花名册</button></td>
                    </tr>

                    <div id="stu_msg" class="collapse"></div>
                    <div class="container" >
                        <div id="stu_msg" class="collapse">
                            <textarea class="form-control" rows="10" readonly="readonly">
                            <?php echo "---------------------------------------------------------------------------".$row["title"]."------学生名单 ---------------------------------------------------------------------------\n"
                                        .$stu_msg;?>
                        </textarea>
                        </div>
                    </div>
                    <?php
                }
                ?>

                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="solve-apply">
            <table align="center" class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
                <thead class="gridhead">
                <tr>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程ID</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程名称</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">学号</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">姓名</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">专业</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">已选/上限</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">教室上限</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">申请理由</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">申请时间</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">操作</th>
                </thead>
                <tbody>
                <?php
                $result=$db->query("SELECT * from stu_applys where workID='$workID'and state='未处理'");

                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $courseID = $row['courseID'];
                    $stuID = $row['stuID'];
                    $course=$db->query("SELECT * from course where courseID='$courseID'")->fetch();
                    $stu=$db->query("SELECT * from student where stuID='$stuID'")->fetch();
                    $max_num=$db->query("SELECT min(max_num) from classroom_time natural join classroom where courseID='$courseID' and user_for= '上课' ")->fetch();


                ?>
                <tr>
                    <td style="text-align:center;"><?php echo $courseID;?></td>
                    <td style="text-align:center;"><?php echo $course['title'];?></td>
                    <td style="text-align:center;"><?php echo $stu['stuID'];?></td>
                    <td style="text-align:center;"><?php echo $stu['name'];?></td>
                    <td style="text-align:center;"><?php echo $stu['department'];?></td>
                    <td style="text-align:center;"><?php echo $course['num']."/".$course['expect_num'];?></td>
                    <td style="text-align:center;"><?php echo $max_num[0];?></td>
                    <td style="text-align:center;"><?php echo $row['message'];?></td>
                    <td style="text-align:center;"><?php echo $row['upload_time'];?></td>

                    <td><button type="button" class="btn btn-link" style="text-align:center;" onclick="agree_apply($courseID,$stuID)">同意</button>
                        <button type="button" class="btn btn-link" style="text-align:center;" onclick="">拒绝</button></td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="set-course">
            <table align="center" class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
                <thead class="gridhead">
                <tr>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程ID</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程名称</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">学分</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">周课时</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">已选/上限</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">考试安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">操作</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="score"><br>
            <div class="form-group">
                <label for="inputfile">文件输入</label>
                <input type="file" id="inputfile">
            </div>
        </div>
    </div>
</div>

<label id="fuck"></label>


</body>

    <script src="InstPage.js"></script>
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