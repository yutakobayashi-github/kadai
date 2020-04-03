<?php
session_start();  
?>
<!DOCTYPE html>
<html>
<head>
    <title>お問い合わせ - 完了画面</title>
</head>
 
<body>
<h1>お問い合わせ完了</h1>
<br>
<p>お問い合わせ内容を受け付けました。</p>
<br>

<p>名前（姓）</p><?php var_dump($_SESSION['last_name']); ?><br>
<p>名前（名）</p><?php var_dump($_SESSION['first_name']); ?><br>
<p>フリガナ（セイ）</p><?php var_dump($_SESSION['katakana_last_name']); ?><br>
<p>フリガナ（メイ）</p><?php var_dump($_SESSION['katakana_first_name']); ?><br>
<p>電話番号</p><?php var_dump($_SESSION['tel']); ?><br>
<p>メールアドレス</p><?php var_dump($_SESSION['email']); ?><br>
<p>確認用メールアドレス</p><?php var_dump($_SESSION['confirm_email']); ?><br>
<p>お問い合わせ内容</p><?php var_dump($_SESSION['inquiry']); ?><br>

</body>
</html>