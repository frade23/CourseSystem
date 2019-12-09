<?php
/**
 * Created by PhpStorm.
 * User: ZhangHao
 * Date: 2019/12/2
 * Time: 19:13
 */
session_start();
try{
    $db = new PDO("mysql:host=localhost;dbname=coursesystem", "root", "123456");
    $db -> exec('SET NAMES utf8');
}
catch (Exception $error){
    die("Connection failed:" . $error ->getMessage());
}

// 定义变量并设置为空值
$nameErr = $keyWordErr = $genderErr = $checkNumberErr = "";
$keyWord = $gender = $comment = $checkNumber = "";
$temp = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $passWord = $_POST['keyWord'];

    if (empty($name)){
        $nameErr = "用户名不能为空";
    } else if (empty($passWord)) {
        $keyWordErr = "密码不可以为空";
    }else{
        $user = $db ->query("SELECT ID FROM account WHERE ID='$name' AND  password='$passWord'");
        $type = $db ->query("SELECT type FROM account WHERE ID='$name' AND  password='$passWord'");
        $userNumber = count($user->fetchAll());
        $type = $type->fetch();
        if ($userNumber > 0){
            $_SESSION['login'] = 'true';
            $_SESSION['account'] = $_POST['name'];
            if ($type['type'] == "stu"){
                //如果是学生账号，登录学生界面
                header('Location:StudentPage.php');
                exit();
            }
            else if ($type['type'] == "ins"){
                //如果是教师账号，登录教师界面
                header('Location:InstPage.php');
                exit();
            }
            else if ($name == "root"){
                //如果是管理员账号，登录管理员界面
                header('Location:RootPage.php');
                exit();
            }

        } else if ($userNumber == 0) {
            $userName = $db ->query("SELECT * FROM account WHERE ID='$name'");
            $userNameNumber = count($userName->fetchAll());
            if ($userNameNumber == 0) {
                $nameErr = "用户不存在";
            }else{
                $keyWordErr = "密码不正确";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/Login.css"  media="all"/>
    <meta charset="UTF-8">
    <title>登录</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/Login.js"></script>
</head><br>
<h2>登录界面</h2><br>

<body class="container-fluid" >
<form class="row" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="col-sm-4"></div>
    <div id="div1" class="col-sm-3">
        <label>
            <input type="text" name="name" placeholder="请输入用户名：" id="user" class="form-block">
        </label>
        <span id="userTip">
            <?php echo $nameErr;?>
        </span><br>

        <label>
            <input type="password" id="password" placeholder="请输入密码：" name="keyWord">
        </label>
        <span id="passTip">
            <?php echo $keyWordErr;?>
        </span>


<!--    <div id="div1" class="col-sm-3">-->
        <button type="submit" class="btn btn-outline-secondary btn-block" value=""
                onclick="">登录</button>
        <button type="submit" class="btn btn-outline-secondary btn-block" value="" onclick="return check2()"
        <?php
        ?>
        >取消</button>
    </div>
</form>
</body>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>