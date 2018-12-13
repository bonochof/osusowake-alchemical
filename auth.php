<?php
session_start();
require_once("conf/config.php");
echo "<html>";
$head = <<<EOH
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta http-equiv="Content-Language" content="ja">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="home" content="このページはセッション処理用ページです">
<meta name="keyword" content="掲示板, MySQL, PHP">
<title>おすそわけ錬金術</title>
<link rel="stylesheet" href="./menu.css" type="text/css">
</head>
EOH;
echo $head;
echo "<body>";
echo "<p><a href='menu.php' class='menu_back'>";
echo "<img src='logo.png' width='500px' height='200px' vspace='50' hspace='30' align='left'>";
echo "</a></p>";
$h_d = $_POST["h"];
echo "<form method='POST' action='auth.php'>";
switch($h_d){
case "judge":
  if($_POST["id"] === $SESSID and $_POST["pwd"] === $SESSPWD){
    echo "ログイン成功";
    $_SESSION["login"] = $SESSID;
    break;
  }
  else{
    echo "IDまたはパスワードが違います";
  }
case "login":
  echo "<table class='login'><tr><td>ID</td><td><input type='text' name='id'></td></tr>";
  echo "<tr><td>パスワード</td><td><input type='password' name='pwd'></td></tr></table>";
  echo "<input type='image' value='ログイン' class='btn'>";
  echo "<input type='hidden' name='h' value='judge'>";
  break;
case "logout":
  echo "ログアウトしました";
  $_SESSION = array();
  session_destroy();
  break;
}
echo "</form>";
echo "<p><a href='auth.php'></p>";
echo "<br><a href='menu.php' class='btn_blue'>トップメニューに戻ります</a>";
echo "</body>";
echo "</html>";
?>
