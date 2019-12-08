<?php
//session_start();
//
//try{
//    $db = new PDO("mysql:host=localhost;dbname=coursesystem", "root", "123456");//数据库名字为courseSystem
//    $db -> exec('SET NAMES utf8');
//}
//catch (Exception $error){
//    die("Connection failed:" . $error ->getMessage());
//}

//导航栏的变化
//$nb1 = "登录";
//$nb2 = "注册";
//
//if (isset($_GET['$login'])){
//    $_SESSION['login'] = $_GET['$login'];
//}
//
//if (isset($_SESSION['login']) && $_SESSION['login'] === 'true'){
//    $nb1 = $_SESSION['nb1'];
//    $nb2 = $_SESSION['nb2'] = "登出";
//}
//else{
//    $_SESSION['nb1'] = "登录";
//    $_SESSION['nb2'] = "注册";
//}
//
//if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
//    $balanceData = $db->query("SELECT * FROM course WHERE name='$nb1'");
//    while ($row = $balanceData->fetch()) {
//        $balance = $row['balance'];
//        $name = $row['name'];
//        $tel = $row['tel'];
//        $email = $row['email'];
//        $address = $row['address'];
//    }
////    $productData = $db->query("SELECT * FROM artworks WHERE name='$nb1'");
////    while ($row1 = $productData->fetch()){
////        $title = $row['title'];
////    }
//}
//else{
//    header('Location:Login.php');
//}
//?>

<!DOCTYPE html>
<html lang="en">
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
    <a class="btn btn-default" href="Login.php" role="button" style="float:right; margin-right:30px;margin-bottom: 10px ">登出</a><br>
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

<ul id="myTab" class="nav nav-tabs">
    <li class="active">
        <a href="#ableSelected" data-toggle="tab">
            可选课程
        </a>
    </li>
    <li><a href="#selected" data-toggle="tab">已选课程</a></li>
    <li><a href="#already-finish" data-toggle="tab">已修课程</a></li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="ableSelected">
        <h4>选课列表</h4>
        <form class="form-search">
            <label>
                <input class="input-medium search-query" type="text">
            </label>
            <button type="submit" class="btn" contenteditable="true" onclick="searchBasedID()">按课程ID查找</button>
            <button type="submit" class="btn" contenteditable="true" onclick="searchBasedCourse()">按课程名查找</button>
        </form>
        <table class="table table-hover table-condensed table-bordered" style="width:100%;text-align:center;table-layout: fixed;">
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
            <tr>
                <td style="text-align:center;"></td>
                <td style="text-align:center;"></td>
                <td style="text-align:center;"></td>
                <td style="text-align:center;"></td>
                <td style="text-align:center;"></td>
                <td style="text-align:center;"></td>
                <td style="text-align:center;"></td>
                <td style="text-align:center;"></td>

                <td><button type="button" class="btn btn-link" style="text-align:center;" onclick="selectCourse()">选课</button></td>
            </tr>
<!--            --><?php
//            $users = $db->query("SELECT * FROM users WHERE name='$name'");
//            while ($row = $users->fetch()){
//                $userID = $row['userID'];
//            }
//
//            $orders = $db->query("SELECT * FROM orders WHERE ownerID='$userID'");
//            $orders2 = $db->query("SELECT * FROM artworks WHERE ownerName='$userID'");
//
//            while ($row = $orders->fetch()){
//                $orderID = $row['orderID'];
//                $sum = $row['sum'];
//                $timeCreated = $row['timeCreated'];
//
//                echo "<tr>
//                                <td>订单编号：$orderID</td>
//
//                                <td>购买人：";
//                echo $name."</td>
//                                <td>订单时间：$timeCreated</td>
//                                <td>订单总额：$sum</td>
//                            </tr>";
//            }
//                ?>
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
                <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">教师</th>
                <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">周课时</th>
                <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">已选/上限</th>
                <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">课程安排</th>
                <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">考试安排</th>
                <th style="width:99px;;height:20px;background:#c7dbff;text-align:center;">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
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
