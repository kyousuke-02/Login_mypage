<?php

mb_internal_encoding("uft8");

session_start();

if(!isset($_POST['from_mypage'])){
header("Location:login_error.php");
}

?>

<!doctype html>

<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>PHP中級課題</title>
        <link rel="stylesheet" type="text/css" href="mypage_hensyu.css">
    </head>
    <body>
        <header>
            <img src="4eachblog_logo.jpg">
        </header>
        <main>
            <div class="box">
                <h2>会員情報</h2>
                <div class="hello">
                    <p><?php echo "こんにちは！　".$_SESSION['name']."さん";?></p>
                </div>
                
                <div class="profile">
                    <img src="<?php echo $_SESSION['picture'];?>">
                </div>
                
                <form action="mypage_update.php" method="post">
                    <div class="jouhou">
                        <div class="basic_info">
                            <p>氏名：<input type="text" size="35" value="<?php echo $_SESSION['name'];?>" name="name"></p><br>
                            <p>メール：<input type="text" size="35" value="<?php echo $_SESSION['mail'];?>" name="mail"></p><br>
                            <p>パスワード：<input type="text" size="35" value="<?php echo $_SESSION['password'];?>" name="password"></p><br>

                        </div>
                    </div>

                    <div class="comments">
                        <p><textarea row="5" cols="45" name="comments"><?php echo $_SESSION['comments'];?></textarea></p>
                    </div>
                    
                    <div class="toroku">
                        <input type="submit" class="submit_button" size="50" value="この内容で登録する">
                    </div>
                </form>
                
            </div>
        </main>
        <footer>
            ©️ 2018 InterNous.inc. All rights reserved
        </footer>
    </body>
</html>