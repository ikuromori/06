<?php
session_start();
$mail = $_POST["mail"];
$pass = $_POST["pass"];

try {
    $pdo = new PDO('mysql:dbname=gs1_db;charset=utf8;host=localhost', 'root', '');
}  catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
}


$stmt = $pdo->prepare("SELECT * FROM a_table WHERE mail = :mail");
$stmt->bindValue(':mail', $mail);
$stmt->execute();
$member = $stmt->fetch();

if ($pass === $member['pass']) {

    $_SESSION['id'] = $member['id'];
    $_SESSION['name'] = $member['name'];
    $msg = 'ログインしました。';
    $link = '<a href="index.php">ホーム</a>';
} else {
    $msg = 'メールアドレスもしくはパスワードが間違っています。';
    $link = '<a href="login.php">戻る</a>';
}
?>

<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>