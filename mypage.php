<?php
mb_internal_encoding("utf8");
session_start();

if(empty($_SESSION['id'])){

    try{
        $pdo = new PDO("mysql:dbname=kyousuke;host=localhost;","root","root");
    }catch(PDOException $e){
        die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスができません。<br>しばらくしてから再度ログインしてください。</p><a href='http://localhost/PHP中級課題/login.php'>ログイン画面へ</a>"
        );

    }

    $stmt = $pdo->prepare("select * from PHPkadai where mail = ? && password = ?");

    $stmt->bindValue(1,$_POST["mail"]);
    $stmt->bindValue(2,$_POST['password']);

    $stmt->execute();
    $pdo = NULL;

    while($row = $stmt->fetch()){
        $_SESSION['id']=$row['id'];
        $_SESSION['name']=$row['name'];
        $_SESSION['picture']=$row['picture'];
        $_SESSION['mail']=$row['mail'];
        $_SESSION['password']=$row['password'];
        $_SESSION['comments']=$row['comments'];
    }

    if(empty($_SESSION['id'])){
        header("Location:login_error.php");
    }
    if(!empty($_POST['login_keep'])){
        $_SESSION['login_keep']=$_POST['login_keep'];
    }
}

if(!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])){
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('login_keep',$_SESSION['login_keep'],time()+60*60*24*7);
}else if(empty($_SESSION['login_keep'])){
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('login_keep','',time()-1);
}

?>

<!doctype html>

<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>PHP中級課題</title>
        <link rel="stylesheet" type="text/css" href="mypage.css">
    </head>
    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <a href="http://localhost/PHP中級課題/log_out.php">ログアウト</a>
        </header>
        <main>
            <div class="box">
                <h2>会員情報</h2>
                <div class="hello">
                <p><?php echo "こんにちは！ ".$_SESSION['name']."さん";?></p>
                </div>
                
                <div class="jouhou">
                    
                    <div class="profile">
                    <p><img src="<?php echo $_SESSION['picture'];?>"></p>
                    </div>
                    
                    <div class="basic_info">
                    <p>氏名：<?php echo $_SESSION['name'];?></p><br>
                    <p>メール：<?php echo $_SESSION['mail'];?></p><br>
                    <p>パスワード：<?php echo $_SESSION['password'];?></p><br>
                    </div>
                    
                </div>
                
                <div class="comments">
                    <p><?php echo $_SESSION['comments'];?></p>
                </div>
                
                <form action="mypage_hensyu.php" method="post" class="form_center">
                    <input type="hidden" value="<?php echo rand(1,10);?>" name="from_mypage">
                    <div class="hensyu_button">
                        <input type="submit" class="submit_button" size="35" value="編集する"> 
                    </div>
                </form>
            </div>
        </main>
        
        <footer>
            ©️ 2018 InterNous.inc. All rights reserved
        </footer>
        
    </body>
</html>