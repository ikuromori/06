<?php
session_start();
$username = $_SESSION['name'];
if (isset($_SESSION['id'])) {
    $msg = 'こんにちは' . htmlspecialchars($username, \ENT_QUOTES, 'UTF-8') . 'さん';
    $link = '<a href="logout.php">ログアウト</a>';
} else {
    $msg = 'ログインしていません';
    $link = '<a href="login_form.php">ログイン</a>';
}
?>
<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>