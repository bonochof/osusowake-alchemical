<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN>

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
<meta name="home" content="このページはトップページです">
<meta name="keyword" content="掲示板, MySQL, PHP">
<title>おすそわけ錬金術</title>
<link rel="stylesheet" href="./menu.css" type="text/css">
</head>
EOH;
echo $head;
echo "<body>";
// ロゴ
echo "<p><a href='menu.php' class='menu_back'>";
echo "<img src='images/logo.png' width='500px' height='200px' vspace='50' hspace='30' align='left'>";
echo "</a></p>";
// ログイン/ログアウト
echo "<div class='right'><p><form method='POST' action='auth.php'>";
if (empty($_SESSION["login"])) {
  echo "<input type='image' src='images/login.png' class='btn_black'>";
  echo "<input type='hidden' name='h' value='login'>";
} else {
  echo $_SESSION["login"]." さん こんにちは";
  echo "<input type='image' src='images/logout.png' class='btn_black'>";
  echo "<input type='hidden' name='h' value='logout'>";
}
echo "</form></p></div>";

try {
  // DB接続
  $s = new PDO("mysql:host=".$SERV.";dbname=".$DBNM.";charset=utf8", $USER, $PASS);
  // ページ分岐用変数
  $page = $_POST["h"];
  // ページ分岐
  switch("$page") {
  case "insert":   // メニュー登録フォームページ
    echo "<p><form method='post' action='menu.php'>";
    echo "<input type = 'text' name='menu_name'>";
    echo "<input type = 'text' name='menu_ing'>";
    echo "<input type = 'text' name='menu_amount'>";
    echo "<input type = 'text' name='menu_author'>";
    echo "<input type = 'text' name='menu_image'>";
    echo "<input type = 'text' name='menu_date'>";
    echo "<input type = 'submit' name='menu_insert' value='DBinsert'>";
    echo "<input type='hidden' name='h' value='DBinsert'>"; //move to DBinsert
    echo "</form></p>";
    break;
  case "DBinsert": // メニュー登録完了ページ
    $get_id = $s->query("select id from menu order by id desc limit 1");
    $lately_id = $get_id->fetch();
    $ins_id = $lately_id["id"]+1;
    $ins_name = $_POST["menu_name"];
    $ins_ing = $_POST["menu_ing"];
    $ins_amount = $_POST["menu_amount"];
    $ins_author = $_POST["menu_author"];
    $ins_image = $_POST["menu_image"];
    $ins_date = $_POST["menu_date"];
    $re = $s->query("insert into menu(id, name, ing, amount, author, image, date) values($ins_id, '$ins_name', '$ins_ing', $ins_amount, '$ins_author', '$ins_image', '$ins_date')");
    break;
  case "delete":   // メニュー削除ページ
    break;
  case "DBdelete": //メニュー削除完了ページ
    $del_id = $_POST["menu_id"];
    if (preg_match("/^[0-9]+$/", $del_id)) {
      $s->query("delete from osusowake where id=$del_id");
    }
    $re = $s->query("select * from osusowake order by menu_id");
    break;
  case "search": //メニュー検索ページ
    break;
  case "DBsearch": // メニュー検索完了ページ
    break;
  default:         // メニュー表示ページ
    echo "<p><form method='POST' action='menu.php'>";
    echo "<input type='hidden' name='h' value='search'>";
    echo "</form></p>";
    echo "<div align='center' class = 'menu'>";
    echo "<img src='images/img01.png' width='300' height='300' vspace='100' hspace='10' align='left'>";
    if (isset($_SESSION["login"])) {
      echo "<p><form method='POST' action='menu.php'>";
      echo "<div class='textbox'><input type='text' name='id'></div>";
      echo "<input type='image' value='削除' class='delete' align='right'>";
      echo "<input type='hidden' name='h' value='delete'>";
      echo "</form></p>";
      echo "<p><form method='POST' action='menu.php'>";
      echo "<div class='textbox'><input type='image' value='ins' class='insert' align='right'></div>";
      echo "<input type='hidden' name='h' value='insert'>";
      echo "</form></p>";
     /* echo "<p><form method='POST' action='menu.php'>";
      echo "<div class='textbox'><input type='image' value='ser' class='search' align='right'></div>";
      echo "<input type='hidden' name='h' value='search'>";
      echo "</form></p>";*/
    }
    echo "</div>";
    break;
  }
} catch(Exception $e) {
  var_dump($e);  
}

// クリスマス仕様
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
