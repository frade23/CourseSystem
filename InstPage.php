<?php
/**
 * Created by PhpStorm.
 * User: ZhangHao
 * Date: 2019/12/3
 * Time: 13:22
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
            <!--          展示花名册          -->
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
                            <button type="button" class="btn btn-link" style="text-align:center" data-toggle="collapse" data-target="#<?php echo $row['courseID'];?>">查看花名册</button></td>
                    </tr>

                    <div id="<?php echo $row['courseID'];?>" class="collapse"></div>
                    <div class="container" >
                        <div id="<?php echo $row['courseID'];?>" class="collapse">
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
<!--        处理选课申请-->
        <?php

        if(isset($_POST['apl_agree']) && $_POST['apl_agree'] == "yes"){
            $apl_stu = $_POST['apl_stu'];
            $apl_courseID = $_POST['apl_courseID'];
            $apl_credit = $_POST['apl_credit'];
            $total_credit=($db->query("select total_credit from student  where stuID ='$apl_stu'")->fetch())['total_credit'];
            $total_credit=$total_credit+$apl_credit;
            $num=($db->query("select num from course where courseID ='$apl_courseID'")->fetch())['num'];
            $num =$num + 1;
//            事务处理TUDO
            $db->query("update  stu_applys set state='同意' where stuID='$apl_stu'and courseID='$apl_courseID'");
            $db->query("insert into stu_takes(courseID, stuID, dropped, grade)  values('$apl_courseID','$apl_stu','否','0') ");

            $db->query("update  student set total_credit ='$total_credit' where stuID ='$apl_stu'");
            $db->query("update  course set num = $num where courseID ='$apl_courseID'");


        }
        if(isset($_POST['apl_agree']) && $_POST['apl_agree'] == "no"){

            $apl_stu = $_POST['apl_stu'];
            $apl_courseID = $_POST['apl_courseID'];
            $db->query("update  stu_applys set state='不同意' where stuID='$apl_stu' and courseID='$apl_courseID'");
        }
        if(isset($_POST['apl_agree'])){
            echo "<script language=JavaScript> location.replace(location.href);</script>";
        }

        ?>

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

                    <td>
                        <form method="post" action="InstPage.php">
                            <input id="a" type="radio" name="apl_agree" value="yes" /> 同意<br />
                            <input id="a" type="radio" name="apl_agree" value="no" /> 拒绝<br />

                            <input type="hidden" name="apl_credit" value="<?php echo $course['credit'];?>">
                            <input type="hidden" name="apl_stu" value="<?php echo $stuID;?>">
                            <input type="hidden" name="apl_courseID" value="<?php echo $courseID;?>">
                            <input type="submit" value="提交">

                    </form>
                    </td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
<!--        开设课程-->
        <?php
//        事务处理
        if(isset($_POST['courseID_up'])){
//            echo "<script>alert('$exam_type')</script>";
            $courseID=$_POST['courseID_up'];
            $title =$_POST['title_up'];
            $credit =$_POST['credit_up'];
            $dept = $_POST['depart_up'];
            $expect_num=$_POST['expect_num_up'];
            $num = 0;
            $exam_type=$_POST['exam_type'];




            //插入课程
            $db->query("insert into course values('$courseID','$title','$workID','$credit','$dept','$expect_num','$exam_type','$num')");

            if($exam_type == "论文" ){

                $ddl = $_POST['ddl'];

                $theme=$_POST['theme'];
                $db->query("insert into paper values('$courseID','$theme',$ddl)");
            }
//            插入exam
            if($exam_type == "考试" && isset($_POST['examroom'])){
                $exam_building = $_POST['examroom'];
                $exam_day=$_POST['exam_day'];
                $exam_start=$_POST['exam_start'];
                $exam_end=$_POST['exam_end'];
                $db->query("insert into classroom_time(courseID, user_for, the_day, start_lesson, end_lesson, building_room)
                                        values('$courseID','考试','$exam_day','$exam_start','$exam_end','$exam_building')");
            }

//            插入上课时间
            $day = $_POST['day'];
            $start =$_POST['start'];
            $end = $_POST['end'];
            $building = $_POST['building'];
            $db->query("insert into classroom_time(courseID, user_for, the_day, start_lesson, end_lesson, building_room)
                                        values('$courseID','上课','$day','$start','$end','$building')");
            if(isset($_POST['day1'])){
                $day1 = $_POST['day1'];
                $start1 =$_POST['start1'];
                $end1 = $_POST['end1'];
                $building1 = $_POST['building1'];
                $db->query("insert into classroom_time(courseID, user_for, the_day, start_lesson, end_lesson, building_room)
                                        values('$courseID','上课','$day1','$start1','$end1','$building1')");
            }

            echo "<script language=JavaScript> location.replace(location.href);</script>";

        }

        ?>
        <div class="tab-pane fade" id="set-course">
            <form action="InstPage.php" method="post">
            <table align="center" class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
                <thead class="gridhead">


                    课程ID: <input type="text" name="courseID_up" ><br><br>
                    课程名: <input type="text" name="title_up" ><br><br>
                    学分：<input type="text" name="credit_up" ><br><br>
                    院系：<input type="text" name="depart_up" ><br><br>
                    期望学生数：<input type="text" name="expect_num_up" ><br><br>

                    <div id="class">
                        周<input name="day" type="text">
                        从第<input name="start" type="text">节课到
                        第<input name="end" type="text">节课<br>
                        地点：<input name="building" type="text"><br>
                    </div>
                    <input type="button" onclick="addnew()" value="添加新的上课时间地点"></input><br><br>
                    考试类型：

                    <select id="exam_type" name="exam_type" onchange="change()">
                        <option >选择考试类型</option>
                        <option value="考试" >考试</option>
                        <option value="论文" >论文</option>
                    </select><br>

                    <div id="exam"></div>
                    <div id="paper"></div>


                    <input type="submit" value="提交">


                <tbody>

                </tbody>
            </table>
            </form>
        </div>

        <form method="post" role="form" action="InstPage.php" enctype="multipart/form-data">
            <div class="tab-pane fade" id="score"><br>
                <div class="form-group">
                    <label for="inputfile">文件输入</label>
                    <input name="grade_file" type="file" id="grade_file">
                    <input type="submit" value="提交">
                </div>
            </div>
        </form>
<?php
        if(isset($_FILES['grade_file'])) {
            $_LANG['express_list']['courseID'] = 'courseID';
            $_LANG['express_list']['stuID'] = 'stuID';
            $_LANG['express_list']['grade'] = 'grade';

            $filesname = $_FILES['grade_file']['name'];

            /* 将文件按行读入数组，逐行进行解析 */
            $line_number = 0;
            $field_list = array_keys($_LANG['express_list']); // 字段列表
            $data = file($_FILES['grade_file']['tmp_name']);
            foreach ($data AS $line) {
                // 跳过第一行
                if ($line_number == 0) {
                    $line_number++;
                    continue;
                }

                // 初始化
                $arr = array();
                $buff = '';
                $quote = 0;
                $len = strlen($line);
                for ($i = 0; $i < $len; $i++) {
                    $char = $line[$i];

                    if ('\\' == $char) {
                        $i++;
                        $char = $line[$i];

                        switch ($char) {
                            case '"':
                                $buff .= '"';
                                break;
                            case '\'':
                                $buff .= '\'';
                                break;
                            case ',';
                                $buff .= ',';
                                break;
                            default:
                                $buff .= '\\' . $char;
                                break;
                        }
                    } elseif ('"' == $char) {
                        if (0 == $quote) {
                            $quote++;
                        } else {
                            $quote = 0;
                        }
                    } elseif (',' == $char) {
                        if (0 == $quote) {
                            if (!isset($field_list[count($arr)])) {
                                continue;
                            }
                            $field_name = $field_list[count($arr)];
                            $arr[$field_name] = trim($buff);
                            $buff = '';
                            $quote = 0;
                        } else {
                            $buff .= $char;
                        }
                    } else {
                        $buff .= $char;
                    }

                    if ($i == $len - 1) {
                        if (!isset($field_list[count($arr)])) {
                            continue;
                        }
                        $field_name = $field_list[count($arr)];
                        $arr[$field_name] = trim($buff);
                    }
                }
                $express_list[] = $arr;
            }

            // 根据导入数据格式 插入数据库中
            if (!empty($express_list)) {
                foreach ($express_list as $val) {

                    $db->query("update stu_takes set grade='$val[grade]' where stuID='$val[stuID]' and courseID='$val[courseID]' ");
                }
            }

        }
?>
    </div>

</div>

<label id="fuck"></label>


</body>

    <script src="InstPage.js" language="javascript"></script>
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