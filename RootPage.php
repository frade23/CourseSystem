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
        <li class="active"><a href="#student" data-toggle="tab">学生</a></li>
        <li><a href="#instructor" data-toggle="tab">教师</a></li>
        <li><a href="#course" data-toggle="tab">课程</a></li>
        <li><a href="#add" data-toggle="tab">增添</a></li>
    </ul>

    <div id="myTab" class="tab-content">
        <div class="tab-pane fade in active" id="student">
            <h4>学生信息</h4>
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
                        <?php //处理PHP按钮点击事件?><!--   有余量-->
                        <a href="RootPage.php?id=<?php echo $stu_info['stuID']; ?>&select=del" onclick="return confirm('确认删除该学生吗？')">
                            <button type="button" class="btn btn-link">删除</button></a>
                    </td>
                <?php
                }

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
        <div class="tab-pane fade" id="instructor">
            <table align="center" class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
                <thead class="gridhead">
                <tr>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程ID</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程名称</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">学分</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">教师</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">周课时</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">已选/上限</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">教室上限</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">考试安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">操作</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="course">
            <table align="center" class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
                <thead class="gridhead">
                <tr>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程ID</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程名称</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">学分</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">教师</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">周课时</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">已选/上限</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">教室上限</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">考试安排</th>
                    <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">操作</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="add">

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
