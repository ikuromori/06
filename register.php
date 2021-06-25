<?php

$name = $_POST["name"];
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

if ($member['mail'] === $mail) {
    $msg = '同じメールアドレスが存在します。';
    $link = '<a href="signup.php">戻る</a>';
 }else{
	$stmt = $pdo->prepare("INSERT INTO a_table(id, name, mail, pass)VALUES(NULL, :name, :mail, :pass)");
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
    $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
    $stmt->execute();
    $msg = '会員登録が完了しました'; 
	$link = '<a href="login_form.php">ログインへ</a>'; 
 }

?>


<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>