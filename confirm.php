<?php
session_start();  

// CSRF対策
//     if (!isset($_POST['token']) || $_POST['token'] !== getToken()) {
//         exit('処理を正常に完了できませんでした');
//     }
  
if( isset($_POST['send']) ) {
    header('Location: complete.php');
        exit;
}
        
?>
 
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>お問い合わせ - 確認画面</title>
</head>
 
<body>
<h1>お問い合わせ - 確認画面</h1>
<br>
<form method="post" action="confirm.php">
    <p>名前（姓）<br><?php echo htmlspecialchars($_SESSION['last_name']); ?></p>
    <p>名前（名）<br><?php echo htmlspecialchars($_SESSION['first_name']); ?></p>
    <p>フリガナ（セイ）<br><?php echo htmlspecialchars($_SESSION['katakana_last_name']); ?></p>
    <p>フリガナ（メイ）<br><?php echo htmlspecialchars($_SESSION['katakana_first_name']); ?></p>
    <p>電話番号<br><?php echo htmlspecialchars($_SESSION['tel']); ?></p>
    <p>メールアドレス<br><?php echo htmlspecialchars($_SESSION['email']); ?></p>
    <p>確認用メールアドレス<br><?php echo htmlspecialchars($_SESSION['confirm_email']); ?></p>
    <p>お問い合わせ内容<br><?php echo htmlspecialchars($_SESSION['inquiry']); ?></p>
    <br>
    <input type="submit" name="send" value="送信">
</form>
<div><a href="index.php?action=rewrite">&laquo;&nbsp;修正する</a>
 
</body>
</html>