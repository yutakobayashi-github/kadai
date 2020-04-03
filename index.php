<?php
 
session_start();  

if(isset($_POST['confirm'])){  
    $error_flg = false;
    
    // CSRF対策
    if (!isset($_POST['token']) || $_POST['token'] !== getToken()) {
        exit('処理を正常に完了できませんでした');
    }

    //バリデーション
    $last_name           = $_POST['last_name'];
    $first_name          = $_POST['first_name'];
    $katakana_last_name  = $_POST['katakana_last_name'];
    $katakana_first_name = $_POST['katakana_first_name'];
    $tel                 = $_POST['tel'];
    $email               = $_POST['email'];
    $confirm_email       = $_POST['confirm_email'];
    $inquiry             = $_POST['inquiry'];
    $error = array();
  
    if(!preg_match('/^[ァ-ヶｦ-ﾟー]+$/u', $katakana_last_name)){
	    //エラー処理
	    $error['katakana_last_name'] = "フリガナは全角カタカナのみでご入力下さい" ;
	    $error_flg = true;
    }
    
    if(!preg_match('/^[ァ-ヶｦ-ﾟー]+$/u', $katakana_first_name)){
	    //エラー処理
	    $error['katakana_first_name'] = "フリガナは全角カタカナのみでご入力下さい" ;
	    $error_flg = true;
    }
    
    if(!preg_match('/^0\d{8,10}$/', $tel)){
	    //エラー処理
	    $error['tel'] = "電話番号はハイフンを抜いてご入力下さい" ;
	    $error_flg = true;
    }
    
    if($email !== $confirm_email){
        $error['confirm_email'] = "メールアドレスが一致しません。" ;
        $error_flg = true;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'メールアドレスの形式が正しくありません';
        $error_flg = true;
    }
    
    //エラーが無ければ入力内容をセッションに保存して確認画面へ
    if (!$error_flg){
        $_SESSION = $_POST;
        header('Location: confirm.php');
        exit;
    }
}
 
// 書き直し
if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'rewrite'){
    $_POST = $_SESSION;
}

/**
 * CSRF対策用 トークンを取得
 */
function getToken()
{
    return hash('sha256', session_id());
}

?>
 
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>お問い合わせ - 入力画面</title>
</head>
 
<body>
<h1>お問い合わせ - 入力画面</h1>
<br>
<form method="post" action="index.php">
    <input type="hidden" name="token" value="<?php echo getToken(); ?>">
    <label>名前（姓）</label>
    <br>
    <input type="text" required name="last_name" vale="<?php if (isset($last_name)) echo htmlspecialchars($last_name); ?>">
    <br>
        
    <label>名前（名）</label>
    <br>
    <input type="text" required name="first_name" vale="<?php if (isset($first_name)) echo htmlspecialchars($first_name); ?>">
    <br>
        
    <label>フリガナ（セイ）</label>
    <p style="color: red"><?php if (isset($error['katakana_last_name'])) echo htmlspecialchars($error['katakana_last_name']); ?></p>
    <input type="text" required name="katakana_last_name" vale="<?php if (isset($katakana_last_name)) echo htmlspecialchars($katakana_last_name); ?>">
    <br>
        
    <label>フリガナ（メイ）</label>
    <p style="color: red"><?php if (isset($error['katakana_first_name'])) echo htmlspecialchars($error['katakana_first_name']); ?></p>
    <input type="text" required name="katakana_first_name" vale="<?php if (isset($katakana_first_name)) echo htmlspecialchars($katakana_first_name); ?>">
    <br>
        
    <label>電話番号</label>
    <p style="color: red"><?php if (isset($error['tel'])) echo htmlspecialchars($error['tel']); ?></p>
    <input type="text" required name="tel" vale="<?php if (isset($tel)) echo htmlspecialchars($tel); ?>">
    <br>
        
    <label>メールアドレス</label>
    <p style="color: red"><?php if (isset($error['email'])) echo htmlspecialchars($error['email']); ?></p></p>
    <input type="email" required name="email" vale="<?php if (isset($email)) echo htmlspecialchars($email); ?>">
    <br>
        
    <label>確認用メールアドレス</label>
    <p style="color: red"><?php if (isset($error['confirm_email'])) echo htmlspecialchars($error['confirm_email']); ?></p>
    <input type="email" required name="confirm_email" vale="<?php if (isset($confirm_email)) echo htmlspecialchars($confirm_email); ?>">
    <br>
        
    <label>お問い合わせ内容</label>
    <br>
    <textarea required name="inquiry" rows="10" cols="100"><?php if (isset($inquiry)) echo htmlspecialchars($inquiry); ?></textarea>
    <br>
        
    <input type="submit" name="confirm" value="確認">
</form>
 
</body>
</html>