<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN>

<?php
session_start();
echo "<html>";
$head = <<<EOH
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta http-equiv="Content-Language" content="ja">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="home" content="このページはトップページです">
<meta name="keyword" content="掲示板, MySQL, PHP">
<title>おすそわけ錬金術</title>
<link rel="stylesheet" href="./menu.css" type="text/css">
</head>
EOH;
echo $head;
echo "<body>";
echo "<p><h1>おすそわけ錬金術</h1></p>";
echo "<div class=logo><img src='img01.png' width='300' height='150'></div>";
echo "<div class='right'><p><form method='POST' action='auth.php'>";
if(empty($_SESSION["login"])){
  echo "<input type='image' value='ログイン' class='btn_black'>";
  echo "<input type='hidden' name='h' value='login'>";
}
else{
  echo $_SESSION["login"]." さん こんにちは<br>";
  echo "<input type='image' value='ログアウト' class='btn_black'>";
  echo "<input type='hidden' name='h' value='logout'>";
}
echo "</form></p></div>";
echo "<p><form method='POST' action='syori.php'>";
/*echo "<input type='image' value='メッセージ表示' class='btn_blue'>";*/
echo "<input type='hidden' name='h' value='sel'>";
echo "</form></p>";
echo "<hr>";
/*if(empty($_SESSION["login"])){
  echo "<p>メッセージを送信するにはログインしてください</p>";
}
else{
  echo "<p><form method='POST' action='syori.php'>";
  echo "<div>名前　<input type='text' name='a1'></div>";
  echo "<div class='textbox'>メッセージ　<input type='text' name='a2' size=150></div>";
  echo "<input type='image' value='メッセージ送信' class='btn_blue'>";
  echo "<input type='hidden' name='h' value='ins'>";
  echo "</form></p>";
}*/
/*echo "<hr>";
if(empty($_SESSION["login"])){
  echo "<p>メッセージを削除するにはログインしてください</p>";
}else{
  echo "<p><form method='POST' action='syori.php'>";
  echo "<div class='textbox'><input type='text' name='b1'></div>";
  echo "<input type='image' value='指定番号削除' class='btn_blue'>";
  echo "<input type='hidden' name='h' value='del'>";
  echo "</form></p>";
}*/

//echo "<hr>";
//echo "<p><form method='POST' action='syori.php'>";
//echo "<div class='textbox'><input type='text' name='c1'></div>";
//echo "<input type='radio' name='c2' value='and' checked>AND <input type='radio' name='c2' value='or'>OR<br>";
//echo "<input type='image' value='キーワード検索' class='btn_blue'>";
//echo "<input type='hidden' name='h' value='ser'>";
//echo "</form></p>";
//echo "<hr>";
//echo "<p><form method='POST' action='syori.php'>";
//echo "<input type='image' value='テーブル再構築' class='btn_red'>";
//echo "<input type='hidden' name='h' value='reb'>";
//echo "</form></p>";

echo "<div align='center' class = 'menu'>";
echo "<img src='img01.png' width='300' height='300' vspace='50' hspace='30' align='left'></div>";
echo "<section id='sakura'>";
echo "<div class='inner'>";
echo "<div class='flake1'></div>";
echo "<div class='flake2'></div>";
echo "<div class='flake3'></div>";
echo "<div class='flake4'></div>";
echo "<div class='flake5'></div>";
echo "<div class='flake6'></div>";
echo "<div class='flake7'></div>";
echo "<div class='flake8'></div>";
echo "</div>";

echo "<div class='inner2'>";
echo "<div class='flake9'></div>";
echo "<div class='flake10'></div>";
echo "<div class='flake11'></div>";
echo "<div class='flake12'></div>";
echo "</div>";
echo "</section>";

echo "</body>";
echo "</html>";
?>
