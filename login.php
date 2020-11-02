<?php
session_start();
if(isset($_SESSION['id'])){
    header("Location:mypage.php");
}
?>

<!doctype html>

<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>PHP中級課題</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <a href="http://PHP中級課題/mypage.php">ログイン</a>
        </header>
        <main>
            <form action = mypage.php method="post">
                <div class="mail">
                    <label>メールアドレス</label><br>
                    <input type="text" class="formbox" size="40" value="<?php echo $_COOKIE['mail']?>" name="mail">
                </div>
                
                <div class="password">
                    <label>パスワード</label><br>
                    <input type="text" class="formbox" size="40" value="<?php echo $_COOKIE['password']?>" name="password">
                </div>
                
                <div class="login_check">
                        <label><input type="checkbox" class="formbox" size="40" name="login_keep" value="login_keep"
                        <?php if(isset($_SESSION['mail'], $_SESSION['password'])){
                        echo "checked='checked'";
                        } 
                        ?>>ログイン状態を保持する</label>
                </div>
                
                <div class="login">
                    <input type="submit" class="login_button" size="35" value="ログイン">
                </div>
            </form>
        </main>
        <footer>
            ©️ 2018 InterNous.inc. All rights reserved
        </footer>
    </body>
</html>