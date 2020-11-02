<?php

mb_internal_encoding("utf8");

session_start();

try{
    $pdo = new PDO("mysql:dbname=kyousuke;host=localhost;","root","root");
}catch(PDOException $e){
    die("<p>申し訳ございません。現在サーバーが混み合っており一時的にログインできません。<br>しばらくしてから再度ログインしてください。</p><a href='http://localhost/PHP中級課題/login.php'>ログイン画面へ</a>");
}

$stmt = $pdo->prepare("update PHPkadai set name = ?, mail = ?, password = ?, comments = ? where id = ?");

$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
$stmt->bindValue(5,$_SESSION['id']);

$stmt->execute();

$stmt = $pdo->prepare("select * from PHPkadai where mail = ? && password = ?");

$stmt->bindValue(1,$_POST['mail']);
$stmt->bindValue(2,$_POST['password']);

$stmt->execute();

$pdo = NULL;

while($row = $stmt->fetch()){
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['password']  = $row['password'];
    $_SESSION['picture'] = $row['picture'];
    $_SESSION['comments'] = $row['comments'];
}

header("Location:http://localhost/PHP中級課題/mypage.php");

?>